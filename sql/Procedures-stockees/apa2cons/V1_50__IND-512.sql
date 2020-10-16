DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind512
$$

CREATE PROCEDURE apa2cons_ind512(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  
  
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind5121;
  CREATE TEMPORARY TABLE temp_apa2cons_ind5121 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT        
		COALESCE(bsa.CD_SEXE, '-1') AS Q1,		
		bsa.ID_EMPLNONPERM AS Q2_6,		
		rof.CD_ORGAFORM, 
		count(DISTINCT bsa.ID_BILASOCIAGEN) AS NB_AGEN,
		CASE WHEN fa.BL_CPF = 1 THEN count(DISTINCT bsa.ID_BILASOCIAGEN) ELSE 0 END AS NB_AGEN_CPF,
		sum(fa.NB_JOUR_FORM) AS NB_JOUR_FORM,
		SUM(CASE WHEN fa.BL_CPF = 1 THEN fa.NB_JOUR_FORM ELSE 0 END) AS NB_JOUR_FORM_CPF
      FROM bilan_social_agent AS bsa   		
		LEFT OUTER JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		JOIN formation_agent AS fa ON fa.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		JOIN ref_organisme_formation rof ON rof.ID_ORGAFORM = fa.ID_ORGAFORM
      WHERE bsa.ID_COLL = idColl 
        AND bsa.ID_ENQU = idEnqu 
		AND rs.CD_STAT =  'CONTNONPERM'
        AND bsa.BL_FORMSUIV = 1       				# Q33
		AND bsa.ID_EMPLNONPERM is not null			# Q2.6
	  GROUP BY Q1, Q2_6, CD_ORGAFORM
    );
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind5121_final;
    CREATE TEMPORARY TABLE temp_apa2cons_ind5121_final 
    ENGINE = MEMORY
    AS (
		SELECT idBilaSociCons, enp.ID_EMPLNONPERM, 
			SUM(CASE WHEN t.CD_ORGAFORM = 'ORG001' THEN t.NB_JOUR_FORM ELSE 0 END) AS R_51211,
			SUM(CASE WHEN t.CD_ORGAFORM = 'ORG002' THEN t.NB_JOUR_FORM ELSE 0 END) AS R_51212,
			SUM(CASE WHEN t.CD_ORGAFORM = 'ORG005' THEN t.NB_JOUR_FORM ELSE 0 END) AS R_51213,
			SUM(CASE WHEN t.CD_ORGAFORM = 'ORG004' THEN t.NB_JOUR_FORM ELSE 0 END) AS R_51214,
			SUM(t.NB_JOUR_FORM_CPF) AS R_51215		
	   FROM ref_emploi_non_permanent enp 
	   LEFT JOIN temp_apa2cons_ind5121 t on t.Q2_6 = enp.ID_EMPLNONPERM 
	   WHERE enp.BL_VALI = 0	  
	   GROUP BY enp.ID_EMPLNONPERM
	
	);
	
	
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind5122;
    CREATE TEMPORARY TABLE temp_apa2cons_ind5122 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT        
		bsa.ID_BILASOCIAGEN,
		COALESCE(bsa.CD_SEXE, '-1') AS Q1,		
		bsa.ID_EMPLNONPERM AS Q2_6,						
		CASE WHEN fa.BL_CPF = 1 THEN 1 ELSE 0 END AS AGEN_CPF			
      FROM bilan_social_agent AS bsa   		
		LEFT OUTER JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		JOIN formation_agent AS fa ON fa.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN		
      WHERE bsa.ID_COLL = idColl 
        AND bsa.ID_ENQU = idEnqu 
		AND rs.CD_STAT =  'CONTNONPERM'
        AND bsa.BL_FORMSUIV = 1       				# Q33
		AND bsa.ID_EMPLNONPERM is not null			# Q2.6
	  GROUP BY bsa.ID_BILASOCIAGEN, Q1, Q2_6
    );	
	
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind5122bis;
    CREATE TEMPORARY TABLE temp_apa2cons_ind5122bis (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT        		
		Q1,		
		Q2_6,
		count(1) AS NB_AGEN,
		sum(CASE WHEN AGEN_CPF = 1 THEN 1 ELSE 0 END ) AS NB_AGEN_CPF			
      FROM temp_apa2cons_ind5122 
	  GROUP BY  Q1, Q2_6
    );	
	
	
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind5122_final;
    CREATE TEMPORARY TABLE temp_apa2cons_ind5122_final 
    ENGINE = MEMORY
    AS (
		SELECT idBilaSociCons, enp.ID_EMPLNONPERM, 			
				SUM(CASE WHEN t.Q1 = 1 THEN t.NB_AGEN ELSE 0 END) AS R_51216,
				SUM(CASE WHEN t.Q1 = 2 THEN t.NB_AGEN ELSE 0 END) AS R_51217,
				SUM(t.NB_AGEN_CPF ) AS R_51218 
		  FROM ref_emploi_non_permanent enp 
		  LEFT JOIN temp_apa2cons_ind5122bis t on t.Q2_6 = enp.ID_EMPLNONPERM 
		  WHERE enp.BL_VALI = 0	  
		  GROUP BY enp.ID_EMPLNONPERM	
	);
	
	
	 INSERT INTO ind_5121 (ID_BILASOCICONS, ID_EMPLNONPERM, R_51211, R_51212, R_51213, R_51214, R_51215, R_51216, R_51217, R_51218)
	 SELECT idBilaSociCons, t1.ID_EMPLNONPERM, 
			t1.R_51211,
			t1.R_51212,
			t1.R_51213,
			t1.R_51214,
			t1.R_51215,
			t2.R_51216,
			t2.R_51217,
			t2.R_51218 
	  FROM temp_apa2cons_ind5121_final t1
	  JOIN temp_apa2cons_ind5122_final t2 on t2.ID_EMPLNONPERM = t1.ID_EMPLNONPERM 	  	  
	  ORDER BY t1.ID_EMPLNONPERM;
	  
	  INSERT INTO ind_5122 (ID_BILASOCICONS, ID_EMPLNONPERM, R_51221, R_51222)
	  SELECT idBilaSociCons, ID_EMPLNONPERM, 			
			R_51216,
			R_51217
	  FROM temp_apa2cons_ind5122_final	  	 
	  ORDER BY ID_EMPLNONPERM;
	
  
  
END
$$

