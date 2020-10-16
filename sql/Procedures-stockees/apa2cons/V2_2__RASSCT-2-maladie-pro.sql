DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_rassct_maladie_pro_carac_pro
$$

CREATE PROCEDURE apa2cons_rassct_maladie_pro_carac_pro(idBilaSociCons INT, idColl INT, idEnqu INT)
  COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
  SQL SECURITY DEFINER
  BEGIN

    declare vNB_MALADIE_PRO_HOMMES int(11);
    declare vNB_MALADIE_PRO_FEMMES int(11);

    # Purge (par sécurité)
    DELETE FROM bsc_rassct_maladie_pro_carac_pro
    WHERE ID_BILASOCICONS = idBilaSociCons;

    # Comptage
    INSERT INTO bsc_rassct_maladie_pro_carac_pro (ID_BILASOCICONS, ID_MALADIE_PROFESSIONNELLE,
                                                  R_MP_1, R_MP_2,
                                                  FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, aaaN.id_maladie_professionnelle,
            SUM(CASE bsa.CD_SEXE WHEN 1 /* Homme */ THEN 1 ELSE 0 END), SUM(CASE bsa.CD_SEXE WHEN 1 THEN 0 ELSE 1 END),
            1, NOW(), 'APA2CONS'
      FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN 
          ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
          AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE     # 2017
          AND aaaN.id_maladie_professionnelle IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                    AND rma.CD_DGCL = '5' # Pour maladie professionnelle, maladie imputable au service ou à caractère professionnel
      WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu
      GROUP BY aaaN.id_maladie_professionnelle;

    SELECT
        COUNT(R_MP_1), 
        COUNT(R_MP_2)
    INTO vNB_MALADIE_PRO_HOMMES, vNB_MALADIE_PRO_FEMMES
    FROM bsc_rassct_maladie_pro_carac_pro 
      WHERE ID_BILASOCICONS = idBilaSociCons;
       
    IF vNB_MALADIE_PRO_HOMMES > 0 OR vNB_MALADIE_PRO_FEMMES > 0 THEN
        UPDATE bilan_social_consolide SET BL_INCO_RASSCT_MALADIE_PRO_CARAC_PRO = '4', MOYENNE_RASSCT_MALADIE_PRO_CARAC_PRO = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;

  END
$$
