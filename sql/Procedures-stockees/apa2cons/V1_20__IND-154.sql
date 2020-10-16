DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind154
$$

CREATE PROCEDURE apa2cons_ind154(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind154;
  CREATE TEMPORARY TABLE temp_apa2cons_ind154 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT        
        bsa.CD_SEXE AS Q1,
		bsa.ID_STAGTITU AS Q17_1        
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2       
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu        
        AND rs.CD_STAT IN ('TITU', 'STAG')  # Q2		
		AND bsa.BL_AGENTITUSTAGANNE = 1 #Q17
		AND bsa.ID_STAGTITU is not null
    );
	
  ### Remplissage de 1.5.2
  INSERT INTO ind_154 (ID_BILASOCICONS, ID_STAGTITU, R_1541, R_1542)
  SELECT idBilaSociCons, st.ID_STAGTITU,    
	SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1541,
	SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1542
  FROM ref_stage_titularisation st
  LEFT JOIN temp_apa2cons_ind154 t on t.Q17_1 = st.ID_STAGTITU
  WHERE st.bl_vali = 0
  AND st.cd_stagtitu <> 'TS006'
  GROUP BY idBilaSociCons, st.ID_STAGTITU
  ORDER BY st.ID_STAGTITU;
  
  INSERT INTO ind_154 (ID_BILASOCICONS, ID_STAGTITU, R_1541, R_1542)
  SELECT idBilaSociCons, (SELECT ID_STAGTITU FROM ref_stage_titularisation WHERE CD_STAGTITU = 'TS006') AS ID_STAGTITU,    
	SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1541,
	SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1542
  FROM ref_stage_titularisation st
  LEFT JOIN temp_apa2cons_ind154 t on t.Q17_1 = st.ID_STAGTITU
  WHERE st.bl_vali = 0
	AND st.cd_stagtitu IN ('TS006','SAUVADET')
  GROUP BY idBilaSociCons, 'TS006';
  
END
$$
