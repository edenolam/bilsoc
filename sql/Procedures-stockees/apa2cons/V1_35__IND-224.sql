DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind224
$$

CREATE PROCEDURE apa2cons_ind224(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
	
	declare vQ224 tinyint(1);

	SELECT Q7 INTO vQ224
	FROM information_generale
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	IF vQ224 is null THEN
		SET vQ224 = 0;
	END IF;
			
	UPDATE bilan_social_consolide SET Q_224 = vQ224
	WHERE ID_BILASOCICONS = idBilaSociCons;
	
	IF vQ224 = 1 THEN
	
		### Création et remplissage de la table temporaire
		DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind224;
		CREATE TEMPORARY TABLE temp_apa2cons_ind224 (INDEX(Q1))
			ENGINE = MEMORY
		AS (
			SELECT        
				bsa.CD_SEXE AS Q1,				
				c.CD_CATE AS Q3bis
			FROM bilan_social_agent AS bsa   	
				JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2		
				JOIN ref_categorie AS c ON bsa.ID_CATE = c.ID_CATE  # Q3bis		
			WHERE bsa.ID_COLL = idColl 
				AND bsa.ID_ENQU = idEnqu 
				AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM')  # Q2
				AND bsa.BL_AGENREMU3112 = 1         # Q4.1        
				AND bsa.BL_TELETRAV = 1            		# Q27 
				AND bsa.ID_CATE is not null
		);	
		
		### Remplissage 
		INSERT INTO ind_224 (ID_BILASOCICONS, R_2241, R_2242, R_2243,R_2247, R_2244, R_2245, R_2246, R_2248)
		SELECT idBilaSociCons, 
			SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'A' THEN 1 ELSE 0 END) AS R_2241,
			SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'B' THEN 1 ELSE 0 END) AS R_2242,
			SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'C' THEN 1 ELSE 0 END) AS R_2243,
			SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'AOTM' THEN 1 ELSE 0 END) AS R_2247,
			SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'A' THEN 1 ELSE 0 END) AS R_2244,
			SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'B' THEN 1 ELSE 0 END) AS R_2245,
			SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'C' THEN 1 ELSE 0 END) AS R_2246,
			SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'AOTM' THEN 1 ELSE 0 END) AS R_2248
		FROM temp_apa2cons_ind224 t		
		;
		
	ELSE 
            INSERT INTO ind_224 (ID_BILASOCICONS, R_2241, R_2242, R_2243,R_2247, R_2244, R_2245, R_2246, R_2248, DT_CREA, CD_UTILCREA, DT_MODI) VALUES(idBilaSociCons, 0,0,0,0,0,0,0,0, NOW(), 'apa2cons', null);
	END IF;
		
  
END
$$

