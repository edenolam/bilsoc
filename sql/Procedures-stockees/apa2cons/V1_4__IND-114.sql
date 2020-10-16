DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind114
$$

CREATE PROCEDURE apa2cons_ind114(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire

  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind114N;
  CREATE TEMPORARY TABLE temp_apa2cons_ind114N (INDEX(Q13_1_N, Q3bis))
    ENGINE = MEMORY
    AS (
      	SELECT        
			ea.ID_FILI AS Q13_1_N,
			bsa.ID_CATE AS Q3bis,
			bsa.CD_SEXE AS Q1,
			sum(ea.NB_HEUR_ETPR) AS NB_N
		  FROM etpr_agent AS ea 
		  JOIN ref_statut AS rs ON ea.ID_STAT = rs.ID_STAT  # Q2  
		  JOIN bilan_social_agent AS bsa ON bsa.ID_BILASOCIAGEN = ea.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND rs.CD_STAT IN ('TITU', 'STAG')  # Q2
			AND ea.ID_FILI is not null
			AND bsa.ID_CATE in (1, 2 , 3)
		  GROUP BY ea.ID_FILI, bsa.ID_CATE, bsa.CD_SEXE
    );	

  ### Remplissage de 1.1.4
  INSERT INTO ind_114 (ID_BILASOCICONS, ID_FILI, ID_CATE, R_1143, R_1144)
  SELECT idBilaSociCons, f.id_fili, c.id_cate,
	SUM(CASE WHEN n.Q1 = 1 THEN n.NB_N ELSE 0 END) AS R_1143,
    SUM(CASE WHEN n.Q1 = 2 THEN n.NB_N ELSE 0 END) AS R_1144
  FROM ref_filiere f
  JOIN ref_categorie c
  LEFT JOIN temp_apa2cons_ind114N n on n.Q13_1_N = f.ID_FILI and n.Q3bis = c.ID_CATE
  WHERE f.BL_VALI = 0
  GROUP BY f.id_fili, c.id_cate
  ORDER BY f.id_fili, c.id_cate
  ;
  
END
$$
