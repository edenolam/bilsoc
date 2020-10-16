DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind131
$$

CREATE PROCEDURE apa2cons_ind131(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  
  ### Remplissage de 1.3.1.1
  INSERT INTO ind_1311 (ID_BILASOCICONS, ID_EMPLNONPERM, R_13111, R_13112, R_13113, R_13114)
	  SELECT idBilaSociCons, enp.ID_EMPLNONPERM,  
		SUM(CASE WHEN rtype = '1112' AND t.Q1 = 1 THEN t.NB_1 ELSE 0 END) AS R_13111,
		SUM(CASE WHEN rtype = '1112' AND t.Q1 = 2 THEN t.NB_1 ELSE 0 END) AS R_13112,
		SUM(CASE WHEN rtype = '1314' AND t.Q1 = 1 THEN t.NB_1 ELSE 0 END) AS R_13123,
		SUM(CASE WHEN rtype = '1314' AND t.Q1 = 2 THEN t.NB_1 ELSE 0 END) AS R_13124
	  FROM ref_emploi_non_permanent enp
	  LEFT OUTER JOIN
		(
			SELECT DISTINCT
				bsa.id_bilasociagen,
				bsa.ID_EMPLNONPERM AS Q_N,
				bsa.CD_SEXE AS Q1,
				1 AS NB_1,
				'1112' AS rtype
			  FROM bilan_social_agent AS bsa 
			  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  		  
			  WHERE bsa.ID_COLL = idColl
				AND bsa.ID_ENQU = idEnqu
				AND bsa.BL_AGENREMU3112 = 1        # Q4.1
				AND rs.CD_STAT IN ('CONTNONPERM')  # Q2	
				AND bsa.ID_EMPLNONPERM is not null
			UNION ALL
			SELECT DISTINCT
				bsa.id_bilasociagen,
				ea.ID_EMPLNONPERM AS Q_N,
				bsa.CD_SEXE AS Q1,
				1 AS NB_1,
				'1314' AS rtype
			  FROM etpr_agent AS ea 
			  JOIN ref_statut AS rs ON ea.ID_STAT = rs.ID_STAT  # Q2  
			  JOIN bilan_social_agent AS bsa ON bsa.ID_BILASOCIAGEN = ea.ID_BILASOCIAGEN
			  WHERE bsa.ID_COLL = idColl
				AND bsa.ID_ENQU = idEnqu
				AND (bsa.BL_AGENREMU3112 = 1  OR bsa.BL_AGENREMUANNE = 1  )  # Q4.1 or Q4.2
				AND rs.CD_STAT IN ('CONTNONPERM')  # Q2	
				AND ea.ID_EMPLNONPERM is not null
		)
		t ON t.Q_N = enp.ID_EMPLNONPERM
	  WHERE enp.BL_VALI = 0
	  GROUP BY enp.ID_EMPLNONPERM
	  ORDER BY enp.ID_EMPLNONPERM
  ;
	
	
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1312N;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1312N (INDEX(Q_N, Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			ea.ID_EMPLNONPERM AS Q_N,
			bsa.CD_SEXE AS Q1,
			sum(ea.NB_HEUR_ETPR) AS NB_N
		  FROM etpr_agent AS ea 
		  JOIN ref_statut AS rs ON ea.ID_STAT = rs.ID_STAT  # Q2  
		  JOIN bilan_social_agent AS bsa ON bsa.ID_BILASOCIAGEN = ea.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND rs.CD_STAT IN ('CONTNONPERM')  # Q2	
			AND ea.ID_EMPLNONPERM is not null
		  GROUP BY ea.ID_EMPLNONPERM, bsa.CD_SEXE
    );

	
  ### Remplissage de 1.3.1.2
  INSERT INTO ind_1312 (ID_BILASOCICONS, ID_EMPLNONPERM,  R_13123, R_13124)
  SELECT idBilaSociCons, enp.ID_EMPLNONPERM,  
	SUM(CASE WHEN n.Q1 = 1 THEN n.NB_N ELSE 0 END) AS R_13123,
    SUM(CASE WHEN n.Q1 = 2 THEN n.NB_N ELSE 0 END) AS R_13124
  FROM ref_emploi_non_permanent enp 
  LEFT JOIN temp_apa2cons_ind1312N n on n.Q_N = enp.ID_EMPLNONPERM
  WHERE enp.BL_VALI = 0
  GROUP BY enp.ID_EMPLNONPERM
  ORDER BY enp.ID_EMPLNONPERM
  ;
  
END
$$
