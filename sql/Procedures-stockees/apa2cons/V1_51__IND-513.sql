DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind513
$$

CREATE PROCEDURE apa2cons_ind513(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
	### Création et remplissage de la table temporaire
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind513;
	CREATE TEMPORARY TABLE temp_apa2cons_ind513 (INDEX(Q1))
		ENGINE = MEMORY
	AS (
		SELECT        
			bsa.CD_SEXE AS Q1,
			rs.CD_STAT AS Q2,
			bsa.ID_EBCF AS Q34_2			
		FROM bilan_social_agent AS bsa   	
			JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		WHERE bsa.ID_COLL = idColl 
			AND bsa.ID_ENQU = idEnqu 			
			AND bsa.BL_VAE = 1         # Q34.1        
			
	);	
	
	### Remplissage 
	INSERT INTO ind_513 (ID_BILASOCICONS, ID_EBCF, TYPE, R_5131, R_5132, R_5133, R_5134)
	SELECT idBilaSociCons, ve.ID_EBCF, 1, 
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN 1 ELSE 0 END) AS R_5131,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN 1 ELSE 0 END) AS R_5132,
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('CONTPERM','CONTNONPERM') THEN 1 ELSE 0 END) AS R_5133,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('CONTPERM','CONTNONPERM') THEN 1 ELSE 0 END) AS R_5134
	FROM ref_validation_experience ve
	LEFT JOIN temp_apa2cons_ind513 t on ve.ID_EBCF = t.Q34_2
	WHERE ve.BL_VALI = 0
	GROUP BY idBilaSociCons, ve.ID_EBCF
	ORDER BY ve.ID_EBCF;
	
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind513bis;
	CREATE TEMPORARY TABLE temp_apa2cons_ind513bis (INDEX(Q1))
		ENGINE = MEMORY
	AS (
		SELECT        
			bsa.CD_SEXE AS Q1,
			rs.CD_STAT AS Q2,
			bsa.NB_BILACOMP AS Q35_2			 # Q35_2
		FROM bilan_social_agent AS bsa   	
			JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		WHERE bsa.ID_COLL = idColl 
			AND bsa.ID_ENQU = idEnqu 			
			AND bsa.BL_BILACOMP = 1         # Q35.1        			
	);	
	
	### Remplissage 
	INSERT INTO ind_513 (ID_BILASOCICONS, ID_EBCF, TYPE, R_5131, R_5132, R_5133, R_5134)
	SELECT idBilaSociCons, null, 2, 
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN t.Q35_2 ELSE 0 END) AS R_5131,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN t.Q35_2 ELSE 0 END) AS R_5132,
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('CONTPERM','CONTNONPERM') THEN t.Q35_2 ELSE 0 END) AS R_5133,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('CONTPERM','CONTNONPERM') THEN t.Q35_2 ELSE 0 END) AS R_5134
	FROM temp_apa2cons_ind513bis t;
	
	
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind513ter;
	CREATE TEMPORARY TABLE temp_apa2cons_ind513ter (INDEX(Q1))
		ENGINE = MEMORY
	AS (
		SELECT        
			bsa.CD_SEXE AS Q1,
			rs.CD_STAT AS Q2			
		FROM bilan_social_agent AS bsa   	
			JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		WHERE bsa.ID_COLL = idColl 
			AND bsa.ID_ENQU = idEnqu 			
			AND bsa.BL_CONGFORM = 1         	# Q36.1        			
	);	
	
	### Remplissage 
	INSERT INTO ind_513 (ID_BILASOCICONS, ID_EBCF, TYPE, R_5131, R_5132, R_5133, R_5134)
	SELECT idBilaSociCons, null, 3, 
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU','STAG') THEN 1 ELSE 0 END) AS R_5131,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU','STAG') THEN 1 ELSE 0 END) AS R_5132,
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('CONTPERM','CONTNONPERM') THEN 1 ELSE 0 END) AS R_5133,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('CONTPERM','CONTNONPERM') THEN 1 ELSE 0 END) AS R_5134
	FROM temp_apa2cons_ind513ter t;
	
	
	
  
END
$$

