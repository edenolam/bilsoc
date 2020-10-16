DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind150
$$

CREATE PROCEDURE apa2cons_ind150(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire  
  #TODO bug si un select ne renvoie rien
  
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1501;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1501 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.CD_SEXE AS Q1,
			c.CD_CATE AS CD_CATE,
			bsa.id_motidepa AS Q16			
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  
		  JOIN ref_categorie AS c ON bsa.ID_CATE = c.ID_CATE
		  JOIN ref_motif_depart AS rmd ON bsa.ID_MOTIDEPA = rmd.ID_MOTIDEPA  # Q2  
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND rs.CD_STAT IN ('TITU' , 'STAG')  # Q2				
			AND bsa.BL_AGENREMU3112 in (0,2)   # Q4.1
					  
    );

  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1502;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1502 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.CD_SEXE AS Q1,
			c.CD_CATE AS CD_CATE,
			bsa.id_motidepa AS Q16			
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  
		  JOIN ref_categorie AS c ON bsa.ID_CATE = c.ID_CATE
		  JOIN ref_motif_depart AS rmd ON bsa.ID_MOTIDEPA = rmd.ID_MOTIDEPA  # Q2  
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND rs.CD_STAT IN ('CONTPERM')  # Q2				
			AND bsa.BL_AGENREMU3112 in (0,2)   # Q4.1
					  
    );
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1502_last;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1502_last (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.CD_SEXE AS Q1,
			c.CD_CATE AS CD_CATE,
			rmd.id_motidepa AS Q16			
		  FROM bilan_social_agent AS bsa
		    JOIN ref_stage_titularisation AS st ON bsa.ID_STAGTITU = st.ID_STAGTITU   
		    JOIN ref_categorie AS c ON bsa.ID_CATE = c.ID_CATE
			, ref_motif_depart AS rmd
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_AGENTITUSTAGANNE = 1 #Q17
			AND st.cd_stagtitu IN ('TS006','SAUVADET') #Q17.1
			AND rmd.cd_motidepa = 'MD018' # On ne filtre pas sur le motif de depart, cela sert juste a recuperer le bon id_motidepa pour le reste des requetes et liens vers l application
			AND NOT EXISTS (SELECT 1 
							FROM etpr_agent eta
								JOIN ref_statut AS rs ON eta.ID_STAT = rs.ID_STAT
							WHERE id_bilasociagen = bsa.id_bilasociagen
								AND rs.CD_STAT = 'CONTNONPERM') #Q13
    );

	
  ### Remplissage de 1.5.0.1
  INSERT INTO ind_150_1 (ID_BILASOCICONS, ID_MOTIDEPA, R_15011, R_15012, R_15013, R_15017, R_15014, R_15015, R_15016, R_15018)
  SELECT idBilaSociCons, md.id_motidepa, 
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'A' THEN 1 ELSE 0 END) AS R_15011,
    SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'B' THEN 1 ELSE 0 END) AS R_15012,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'C' THEN 1 ELSE 0 END) AS R_15013,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'AOTM' THEN 1 ELSE 0 END) AS R_15017,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'A' THEN 1 ELSE 0 END) AS R_15014,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'B' THEN 1 ELSE 0 END) AS R_15015,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'C' THEN 1 ELSE 0 END) AS R_15016,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'AOTM' THEN 1 ELSE 0 END) AS R_15018
  FROM ref_motif_depart md
  LEFT JOIN temp_apa2cons_ind1501 n on n.Q16 = md.id_motidepa   
  WHERE md.BL_VALI = 0  
  GROUP BY md.id_motidepa
  ORDER BY md.bl_depadefi, md.id_motidepa
  ;

  ### Remplissage de 1.5.0.2
  INSERT INTO ind_150_2 (ID_BILASOCICONS, ID_MOTIDEPA, R_15021, R_15022, R_15023, R_15027,  R_15024, R_15025, R_15026, R_15028)
  SELECT idBilaSociCons, md.id_motidepa, 
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'A' THEN 1 ELSE 0 END) AS R_15021,
    SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'B' THEN 1 ELSE 0 END) AS R_15022,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'C' THEN 1 ELSE 0 END) AS R_15023,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'AOTM' THEN 1 ELSE 0 END) AS R_15027,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'A' THEN 1 ELSE 0 END) AS R_15024,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'B' THEN 1 ELSE 0 END) AS R_15025,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'C' THEN 1 ELSE 0 END) AS R_15026,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'AOTM' THEN 1 ELSE 0 END) AS R_15028
  FROM ref_motif_depart md
  LEFT JOIN temp_apa2cons_ind1502 n on n.Q16 = md.id_motidepa   
  WHERE md.BL_VALI = 0  
	AND md.cd_motidepa <> 'MD018'
  GROUP BY md.id_motidepa
  ORDER BY md.bl_depadefi, md.id_motidepa
  ;
  
  ### Remplissage de 1.5.0.2
  INSERT INTO ind_150_2 (ID_BILASOCICONS, ID_MOTIDEPA, R_15021, R_15022, R_15023, R_15027,  R_15024, R_15025, R_15026, R_15028)
  SELECT idBilaSociCons, md.id_motidepa, 
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'A' THEN 1 ELSE 0 END) AS R_15021,
    SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'B' THEN 1 ELSE 0 END) AS R_15022,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'C' THEN 1 ELSE 0 END) AS R_15023,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CATE = 'AOTM' THEN 1 ELSE 0 END) AS R_15027,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'A' THEN 1 ELSE 0 END) AS R_15024,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'B' THEN 1 ELSE 0 END) AS R_15025,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'C' THEN 1 ELSE 0 END) AS R_15026,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CATE = 'AOTM' THEN 1 ELSE 0 END) AS R_15028
  FROM ref_motif_depart md
  LEFT JOIN temp_apa2cons_ind1502_last n on n.Q16 = md.id_motidepa   
  WHERE md.BL_VALI = 0  
	AND md.cd_motidepa = 'MD018'
  GROUP BY md.id_motidepa
  ORDER BY md.bl_depadefi, md.id_motidepa
  ;

  
END
$$
