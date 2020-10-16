DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind122
$$

CREATE PROCEDURE apa2cons_ind122(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind122;
  CREATE TEMPORARY TABLE temp_apa2cons_ind122 (INDEX(Q2_8))
    ENGINE = MEMORY
    AS (
      SELECT
        bsa.ID_CADREMPL AS Q2_8,
        bsa.CD_SEXE AS Q1,
        bsa.BL_TEMPPLEIN AS Q12_1,
        rptp.CD_POURTEMPPART AS Q12_3 # Moins de 80%=PTPSP001, De 80% à moins de 90%=PTPSP002, 90% et plus=PTPSP003
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        LEFT OUTER JOIN ref_pourcentage_tempa_partiel AS rptp ON bsa.ID_POURTEMPPART = rptp.ID_POURTEMPPART # Q12.3
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND bsa.BL_AGENREMU3112 = 1         # Q4.1
        AND rs.CD_STAT IN ('CONTPERM')  	# Q2
        AND bsa.ID_CADREMPL IS NOT NULL
    );

  ### Remplissage de 1.2.2
  INSERT INTO ind_122 (ID_BILASOCICONS, ID_CADREMPL, R_1221, R_1222, R_1223, R_1224, R_1225, R_1226, R_1227, R_1228)
  SELECT idBilaSociCons, ce.ID_CADREMPL,
    SUM(CASE WHEN t.Q12_1 = 1 AND t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1221,
    SUM(CASE WHEN t.Q12_1 = 1 AND t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1221,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 1 AND t.Q12_3 = 'PTPSP001' THEN 1 ELSE 0 END) AS R_1223,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 2 AND t.Q12_3 = 'PTPSP001' THEN 1 ELSE 0 END) AS R_1224,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 1 AND t.Q12_3 = 'PTPSP002' THEN 1 ELSE 0 END) AS R_1225,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 2 AND t.Q12_3 = 'PTPSP002' THEN 1 ELSE 0 END) AS R_1226,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 1 AND t.Q12_3 = 'PTPSP003' THEN 1 ELSE 0 END) AS R_1227,
    SUM(CASE WHEN t.Q12_1 = 0 AND t.Q1 = 2 AND t.Q12_3 = 'PTPSP003' THEN 1 ELSE 0 END) AS R_1228
  FROM ref_cadre_emploi ce 
  LEFT JOIN temp_apa2cons_ind122 t ON t.Q2_8 = ce.ID_CADREMPL
  WHERE ce.BL_VALI = 0 
  GROUP BY idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;
END
$$
