DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind423
$$

CREATE PROCEDURE apa2cons_ind423(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  
  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind423_1;
  CREATE TEMPORARY TABLE temp_apa2cons_ind423_1
    ENGINE = MEMORY
    AS (
      SELECT       		
        bsa.ID_INAPDEMA AS R31_1,
		count(*) AS NB
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2        
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu        
		AND bsa.BL_DEMAINAP = 1 #Q32.1 
        AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM' )  # Q2        
		AND bsa.ID_INAPDEMA is not null 	#R31_1
	  GROUP BY bsa.ID_INAPDEMA
    );
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind423_2;
    CREATE TEMPORARY TABLE temp_apa2cons_ind423_2 
    ENGINE = MEMORY
    AS (
      SELECT       				
        bsa.ID_INAPDECI AS R32_2,
		count(*) AS NB
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2       
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu        
		AND bsa.BL_DECIINAP = 1   #Q32.2
        AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM' )  # Q2        
		AND bsa.ID_INAPDECI is not null 	#R32_1
	  GROUP BY bsa.ID_INAPDECI
    );
	
	
	DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind423_3;
    CREATE TEMPORARY TABLE temp_apa2cons_ind423_3 
    ENGINE = MEMORY
    AS (
      SELECT       				
        ri.ID_INAP AS R32_2,
		bsa.ID_FILI AS Q3ter,
		count(*) AS NB		
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        JOIN ref_inaptitude AS ri ON bsa.ID_INAPDECI = ri.ID_INAP
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu        
		AND bsa.BL_DECIINAP = 1   #Q32.2
        AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM' )  # Q2        
		AND ri.BL_FILI = 1
		AND bsa.ID_FILI is not null
		AND bsa.ID_INAPDECI is not null 	#R32_1
	  GROUP BY ri.ID_INAP, bsa.ID_FILI
    );

	  ### Remplissage de
	  INSERT INTO ind_423 (ID_BILASOCICONS, ID_INAP, R_4231)
	  SELECT idBilaSociCons, i.ID_INAP, 
			t.NB AS R_4231
	  FROM ref_inaptitude i  
		LEFT JOIN temp_apa2cons_ind423_1 t on t.R31_1 = i.ID_INAP 
	  WHERE i.BL_VALI = 0
	  AND i.BL_DEMA = 1
	  GROUP BY idBilaSociCons, i.ID_INAP
	  ORDER BY i.ID_INAP;

	  ### Remplissage de
	  INSERT INTO ind_423 (ID_BILASOCICONS, ID_INAP, R_4231)
	  SELECT idBilaSociCons, i.ID_INAP,    
				(CASE WHEN i.BL_FILI = 1 THEN NULL ELSE t.NB END) AS R_4231  		
	  FROM ref_inaptitude i  
		LEFT JOIN temp_apa2cons_ind423_2 t on t.R32_2 = i.ID_INAP 
	  WHERE i.BL_VALI = 0
	  AND i.BL_DECI = 1
	  GROUP BY idBilaSociCons, i.ID_INAP
	  ORDER BY i.ID_INAP;
  
	  ### Remplissage de
	  INSERT INTO ind_423Fili (ID_BILASOCICONS, ID_INAP, ID_FILI, R_4231Fili)
	  SELECT idBilaSociCons,  i.ID_INAP, f.ID_FILI,   
				t.NB AS R_4231Fili  
	  FROM ref_filiere f join ref_inaptitude i 		 
		LEFT JOIN temp_apa2cons_ind423_3 t on t.Q3ter = f.ID_FILI AND t.R32_2 = i.ID_INAP
	  WHERE f.BL_VALI = 0	
	  AND i.BL_VALI = 0	
	  AND i.BL_FILI = 1		  
	  GROUP BY idBilaSociCons, i.ID_INAP,  f.ID_FILI
	  ORDER BY i.ID_INAP, f.ID_FILI;  
  
END
$$
