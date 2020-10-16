DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_rassct_maladie_pro_reconnue
$$

CREATE PROCEDURE apa2cons_rassct_maladie_pro_reconnue(idBilaSociCons INT, idColl INT, idEnqu INT)
  COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
  SQL SECURITY DEFINER
  BEGIN
    declare vNB_MALADIE_PRO_RECONNUES int(11);
    declare vNB_MALADIE_PRO_JOUR_ARRET int(11);

    # Purge (par sécurité)
    DELETE FROM bsc_rassct_nb_maladie_professionnelle
    WHERE ID_BILASOCICONS = idBilaSociCons;

    # Comptage
    INSERT INTO bsc_rassct_nb_maladie_professionnelle (ID_BILASOCICONS, ID_TYPE_ACTIVITE,
                                                       R_NB_MALADIE_PRO_RECONNUES, R_NB_JOUR_ARRET,
                                                       FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, aaaN.id_type_activite_maladie_pro,
        COUNT(aaaN.ID_ABSEARREAGEN), SUM(IFNULL(aaaN.NB_JOURABSE, 0)), 1, NOW(), 'APA2CONS'
      FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN 
          ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
          AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE     # 2017
          AND aaaN.id_type_activite_maladie_pro IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                    AND rma.CD_DGCL = '5' # Pour maladie professionnelle, maladie imputable au service ou à caractère professionnel
      WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu
      GROUP BY aaaN.id_type_activite_maladie_pro;

    SELECT
        COUNT(R_NB_MALADIE_PRO_RECONNUES), 
        COUNT(R_NB_JOUR_ARRET)
    INTO vNB_MALADIE_PRO_RECONNUES, vNB_MALADIE_PRO_JOUR_ARRET
    FROM bsc_rassct_nb_maladie_professionnelle 
      WHERE ID_BILASOCICONS = idBilaSociCons;
       
    IF vNB_MALADIE_PRO_RECONNUES > 0 OR vNB_MALADIE_PRO_JOUR_ARRET > 0 THEN
        UPDATE bilan_social_consolide SET BL_INCO_RASSCT_NB_MALADIE_PRO = '4', MOYENNE_RASSCT_NB_MALADIE_PRO = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;
  END
$$
