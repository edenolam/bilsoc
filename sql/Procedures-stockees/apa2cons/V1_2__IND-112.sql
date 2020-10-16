DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind112
$$

CREATE PROCEDURE apa2cons_ind112(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind112;
  CREATE TEMPORARY TABLE temp_apa2cons_ind112 (INDEX(Q2_8))
    ENGINE = MEMORY
    AS (
      SELECT
        bsa.ID_CADREMPL AS Q2_8,
        bsa.CD_SEXE AS Q1,
        bsa.BL_TEMPPLEIN AS Q12_1,
		bsa.BL_TEMPCOMP AS Q11_1,
        rptp.CD_POURTEMPPART AS Q12_3 # Moins de 80%=PTPSP001, De 80% à moins de 90%=PTPSP002, 90% et plus=PTPSP003
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        LEFT OUTER JOIN ref_pourcentage_tempa_partiel AS rptp ON bsa.ID_POURTEMPPART = rptp.ID_POURTEMPPART # Q12.3
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND bsa.BL_AGENREMU3112 = 1         # Q4.1
        AND rs.CD_STAT IN ('TITU', 'STAG')  # Q2
        AND bsa.ID_CADREMPL IS NOT NULL
		AND bsa.BL_TEMPCOMP = 1
		AND bsa.BL_TEMPPLEIN IS NOT NULL
    );

  ### Remplissage de 1.1.2
  INSERT INTO ind_112 (ID_BILASOCICONS, ID_CADREMPL, R_1121, R_1122, R_1123, R_1124, R_1125, R_1126, R_1127, R_1128)
  SELECT idBilaSociCons, ce.ID_CADREMPL,
    SUM(CASE WHEN t.Q12_1 = 1 AND t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1121,
    SUM(CASE WHEN t.Q12_1 = 1 AND t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1122,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 1 AND t.Q12_3 = 'PTPSP001' THEN 1 ELSE 0 END) AS R_1123,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 2 AND t.Q12_3 = 'PTPSP001' THEN 1 ELSE 0 END) AS R_1124,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 1 AND t.Q12_3 = 'PTPSP002' THEN 1 ELSE 0 END) AS R_1125,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 2 AND t.Q12_3 = 'PTPSP002' THEN 1 ELSE 0 END) AS R_1126,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 1 AND t.Q12_3 = 'PTPSP003' THEN 1 ELSE 0 END) AS R_1127,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 2 AND t.Q12_3 = 'PTPSP003' THEN 1 ELSE 0 END) AS R_1128
  FROM ref_cadre_emploi ce
	LEFT JOIN temp_apa2cons_ind112 t on t.Q2_8 = ce.ID_CADREMPL
  WHERE ce.bl_vali = 0
  GROUP BY idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;
  
END
$$
