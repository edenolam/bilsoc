DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind231
$$

CREATE PROCEDURE apa2cons_ind231(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	  
	  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind231;
  CREATE TEMPORARY TABLE temp_apa2cons_ind231 (INDEX(Q1)) 
    ENGINE = MEMORY
    AS (	
      SELECT        
		COALESCE(bsa.CD_SEXE, '-1') AS Q1,		
			bsa.NB_DEMAPART AS Q28_1, 
			bsa.NB_DEMAPARTACCE AS Q28_2, 
			bsa.NB_PREMDEMASATI AS Q28_3, 
			bsa.NB_MODIEMPLPERMTEMPCOMP AS Q28_4, 
			bsa.NB_AGENEMPLTEMPCOMPNONRENOU AS Q28_5 
      FROM bilan_social_agent AS bsa
        LEFT OUTER JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        LEFT OUTER JOIN ref_Type_Cdd AS rtc ON bsa.ID_TYPECDD = rtc.ID_TYPECDD		
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu	
-- 		AND bsa.BL_DEMAINAP = 1   #Q28
-- pas besoin d'utiliser cette condition, les champs sont vidé quand la reponse a la q28 est non
    );

  ### Remplissage 
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  SELECT idBilaSociCons, 
	SUM(CASE WHEN t.Q1 = 1 THEN t.Q28_1 ELSE 0 END) AS R_2311,
	SUM(CASE WHEN t.Q1 = 2 THEN t.Q28_1 ELSE 0 END) AS R_2312,
	'DPR',
	0
  FROM temp_apa2cons_ind231 t; 
  
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  SELECT idBilaSociCons, 
	SUM(CASE WHEN t.Q1 = 1 THEN t.Q28_2 ELSE 0 END) AS R_2311,
	SUM(CASE WHEN t.Q1 = 2 THEN t.Q28_2 ELSE 0 END) AS R_2312,
	'DAC',
	1
  FROM temp_apa2cons_ind231 t;   
  
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  SELECT idBilaSociCons, 
	SUM(CASE WHEN t.Q1 = 1 THEN t.Q28_3 ELSE 0 END) AS R_2311,
	SUM(CASE WHEN t.Q1 = 2 THEN t.Q28_3 ELSE 0 END) AS R_2312,
	'PDS',
	2
  FROM temp_apa2cons_ind231 t; 
  
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  SELECT idBilaSociCons, 
	SUM(CASE WHEN t.Q1 = 1 THEN t.Q28_4 ELSE 0 END) AS R_2311,
	SUM(CASE WHEN t.Q1 = 2 THEN t.Q28_4 ELSE 0 END) AS R_2312,
	'MOQ',
	3
  FROM temp_apa2cons_ind231 t; 
    
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  SELECT idBilaSociCons, 
	SUM(CASE WHEN t.Q1 = 1 THEN t.Q28_5 ELSE 0 END) AS R_2311,
	SUM(CASE WHEN t.Q1 = 2 THEN t.Q28_5 ELSE 0 END) AS R_2312,
	'RTP',
	4
  FROM temp_apa2cons_ind231 t; 
  
  
  
END
$$
