DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind222
$$

CREATE PROCEDURE apa2cons_ind222(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
	### Création et remplissage de la table temporaire
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind222;
	CREATE TEMPORARY TABLE temp_apa2cons_ind222 (INDEX(Q1))
		ENGINE = MEMORY
	AS (
		SELECT        
			bsa.CD_SEXE AS Q1,			
			act.contrainte_travail_id AS Q25
		FROM bilan_social_agent AS bsa   	
			JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
			LEFT JOIN Agent_ContraintesTravail act ON act.agent_id = bsa.ID_BILASOCIAGEN
		WHERE bsa.ID_COLL = idColl 
			AND bsa.ID_ENQU = idEnqu 
			AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM')  # Q2
			AND bsa.BL_AGENREMU3112 = 1         # Q4.1        
			AND bsa.BL_TEMPCOMP = 1             # Q11.1			
	);	
	
	### Remplissage 
	INSERT INTO ind_222 (ID_BILASOCICONS, ID_CONTTRAV, R_2221, R_2222)
	SELECT idBilaSociCons, ct.ID_CONTTRAV, 
		SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS R_2221,
		SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS R_2222			
	FROM ref_contrainte_travail ct
	LEFT JOIN temp_apa2cons_ind222 t on ct.ID_CONTTRAV = t.Q25
	WHERE ct.BL_VALI = 0
	GROUP BY idBilaSociCons, ct.ID_CONTTRAV
	ORDER BY ct.ID_CONTTRAV;
		
	
  
END
$$

