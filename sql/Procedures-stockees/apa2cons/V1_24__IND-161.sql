DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind161
$$

CREATE PROCEDURE apa2cons_ind161(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vQ161 tinyint(1);

	SELECT Q3 INTO vQ161
	FROM information_generale
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	IF vQ161 is null THEN
		SET vQ161 = 0;
	END IF;
			
	UPDATE bilan_social_consolide SET Q_161 = vQ161
	WHERE ID_BILASOCICONS = idBilaSociCons;
	
	IF vQ161 = 1 THEN
	
		### Création et remplissage de la table temporaire
		DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind161;
		CREATE TEMPORARY TABLE temp_apa2cons_ind161 (INDEX(Q3bis, Q1))
			ENGINE = MEMORY
			AS (
			  SELECT
				bsa.ID_CATE AS Q3bis,
				bsa.CD_SEXE AS Q1,
				rs.CD_STAT AS Q2,
				enp.CD_EMPLNONPERM AS Q2_6
			  FROM bilan_social_agent AS bsa
				JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2        
				LEFT JOIN ref_emploi_non_permanent AS enp ON bsa.ID_EMPLNONPERM = enp.ID_EMPLNONPERM  # Q2.6
			  WHERE bsa.ID_COLL = idColl
				AND bsa.ID_ENQU = idEnqu
				AND bsa.BL_BOETH = 1 #Q19 agent est BOETH
			);

		### Remplissage 
		INSERT INTO ind_161 (ID_BILASOCICONS, ID_CATE, R_1611, R_1612, R_1613, R_1614)
		SELECT idBilaSociCons, c.ID_CATE,
			SUM(CASE WHEN t.Q2 in ('TITU','STAG') AND t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1611,
			SUM(CASE WHEN t.Q2 in ('TITU','STAG') AND t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1612,
			SUM(CASE WHEN t.Q2 = 'CONTPERM' AND t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1613,
			SUM(CASE WHEN t.Q2 = 'CONTPERM' AND t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1614
		FROM ref_categorie c
		LEFT JOIN temp_apa2cons_ind161 t on t.Q3bis = c.ID_CATE
		WHERE c.bl_vali = 0
		GROUP BY idBilaSociCons, c.ID_CATE
		ORDER BY c.ID_CATE;


		INSERT INTO ind_1612 (ID_BILASOCICONS, R_16121, R_16122, R_16123, R_16124)
		SELECT idBilaSociCons, 
			SUM(CASE WHEN t.Q2 = 'CONTNONPERM' AND t.Q1 = 1 THEN 1 ELSE 0 END) AS R_16121,
			SUM(CASE WHEN t.Q2 = 'CONTNONPERM' AND t.Q1 = 2 THEN 1 ELSE 0 END) AS R_16122,
			SUM(CASE WHEN t.Q2 = 'CONTNONPERM' AND t.Q1 = 1 AND t.Q2_6 = 'EF010' THEN 1 ELSE 0 END) AS R_16123,  # Q2_6 apprenti
			SUM(CASE WHEN t.Q2 = 'CONTNONPERM' AND t.Q1 = 2 AND t.Q2_6 = 'EF010' THEN 1 ELSE 0 END) AS R_16124   # Q2_6 apprenti
		FROM temp_apa2cons_ind161 t;
		
	END IF;
	
  
END
$$
