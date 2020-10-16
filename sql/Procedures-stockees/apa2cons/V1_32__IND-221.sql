DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind221
$$

CREATE PROCEDURE apa2cons_ind221(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
	### Création et remplissage de la table temporaire
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind221;
	CREATE TEMPORARY TABLE temp_apa2cons_ind221 (INDEX(Q1))
		ENGINE = MEMORY
	AS (
		SELECT        
			bsa.CD_SEXE AS Q1,
			bsa.ID_CYCLTRAV AS Q24			
		FROM bilan_social_agent AS bsa   	
			JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		WHERE bsa.ID_COLL = idColl 
			AND bsa.ID_ENQU = idEnqu 
			AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM')  # Q2
			AND bsa.BL_AGENREMU3112 = 1         # Q4.1        
			AND bsa.BL_TEMPCOMP = 1             # Q11.1			
	);	
	
	### Remplissage 
	INSERT INTO ind_221 (ID_BILASOCICONS, ID_CYCLTRAV, R_2211, R_2212)
	SELECT idBilaSociCons, ct.ID_CYCLTRAV, 
		SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS R_22111,
		SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS R_22112			
	FROM ref_cycle_travail ct
	LEFT JOIN temp_apa2cons_ind221 t on ct.ID_CYCLTRAV = t.Q24
	WHERE ct.BL_VALI = 0
	GROUP BY idBilaSociCons, ct.ID_CYCLTRAV
	ORDER BY ct.LB_GROUCYCLTRAV DESC, ct.ID_CYCLTRAV;
		
	
  
END
$$

