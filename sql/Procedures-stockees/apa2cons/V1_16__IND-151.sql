DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind151
$$

CREATE PROCEDURE apa2cons_ind151(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire  
  #TODO bug si un select ne renvoie rien
  
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1511;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1511 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.CD_SEXE AS Q1,
			ce.CD_CADREMPL AS CD_CADREMPL,
			bsa.id_emplfonc AS Q8_3
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  
		  JOIN ref_cadre_emploi AS ce ON bsa.ID_CADREMPL = ce.ID_CADREMPL		  
		  JOIN ref_fonction_publique AS fp ON bsa.ID_FONCPUBL = fp.ID_FONCPUBL
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND rs.CD_STAT IN ('TITU' , 'STAG')  # Q2
			AND fp.CD_FONCPUBL = 'FPT'
    );

	
  ### Remplissage de 1.5.1.1
  INSERT INTO ind_151_1 (ID_BILASOCICONS, ID_EMPLFONC, R_15111, R_15112, R_15113, R_15114, R_15115, R_15116, R_15117, R_15118, R_15119, R_151110)
  SELECT idBilaSociCons, ef.id_emplfonc, 
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE001' THEN 1 ELSE 0 END) AS R_15111,
    SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE001' THEN 1 ELSE 0 END) AS R_15112,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE002' THEN 1 ELSE 0 END) AS R_15113,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE002' THEN 1 ELSE 0 END) AS R_15114,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE006' THEN 1 ELSE 0 END) AS R_15115,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE006' THEN 1 ELSE 0 END) AS R_15116,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE007' THEN 1 ELSE 0 END) AS R_15117,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE007' THEN 1 ELSE 0 END) AS R_15118,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL not in ('CE001','CE002','CE006','CE007') THEN 1 ELSE 0 END) AS R_15119,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL not in ('CE001','CE002','CE006','CE007') THEN 1 ELSE 0 END) AS R_151110
  FROM ref_emploi_fonctionnel ef
  LEFT JOIN temp_apa2cons_ind1511 n on n.Q8_3 = ef.id_emplfonc   
  WHERE ef.BL_VALI = 0  
  GROUP BY ef.id_emplfonc
  ORDER BY ef.id_emplfonc
  ;


  
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1512;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1512 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.CD_SEXE AS Q1,
			ce.CD_CADREMPL AS CD_CADREMPL,
			bsa.id_emplfonc AS Q8_3
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  
		  JOIN ref_cadre_emploi AS ce ON bsa.ID_CADREMPL = ce.ID_CADREMPL		  
		  JOIN ref_fonction_publique AS fp ON bsa.ID_FONCPUBL = fp.ID_FONCPUBL
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND rs.CD_STAT IN ('TITU' , 'STAG')  # Q2
			AND fp.CD_FONCPUBL in ('FPE','FPH')
    );

	
  ### Remplissage de 1.5.1.2
  INSERT INTO ind_151_2 (ID_BILASOCICONS, ID_EMPLFONC, R_15121, R_15122, R_15123, R_15124, R_15125, R_15126, R_15127, R_15128, R_15129, R_151210)
  SELECT idBilaSociCons, ef.id_emplfonc, 
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE001' THEN 1 ELSE 0 END) AS R_15121,
    SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE001' THEN 1 ELSE 0 END) AS R_15122,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE002' THEN 1 ELSE 0 END) AS R_15123,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE002' THEN 1 ELSE 0 END) AS R_15124,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE006' THEN 1 ELSE 0 END) AS R_15125,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE006' THEN 1 ELSE 0 END) AS R_15126,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL = 'CE007' THEN 1 ELSE 0 END) AS R_15127,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL = 'CE007' THEN 1 ELSE 0 END) AS R_15128,
	SUM(CASE WHEN n.Q1 = 1 AND n.CD_CADREMPL not in ('CE001','CE002','CE006','CE007') THEN 1 ELSE 0 END) AS R_15129,
	SUM(CASE WHEN n.Q1 = 2 AND n.CD_CADREMPL not in ('CE001','CE002','CE006','CE007') THEN 1 ELSE 0 END) AS R_151210
  FROM ref_emploi_fonctionnel ef
  LEFT JOIN temp_apa2cons_ind1511 n on n.Q8_3 = ef.id_emplfonc   
  WHERE ef.BL_VALI = 0  
  GROUP BY ef.id_emplfonc
  ORDER BY ef.id_emplfonc
  ;

  
  
  
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1513;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1513 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.CD_SEXE AS Q1,			
			bsa.id_emplfonc AS Q8_3
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  		    		 
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND rs.CD_STAT IN ('CONTPERM')  # Q2			
    );

	
  ### Remplissage de 1.5.1.3
  INSERT INTO ind_151_3 (ID_BILASOCICONS, ID_EMPLFONC, R_15131, R_15132)
  SELECT idBilaSociCons, ef.id_emplfonc, 
	SUM(CASE WHEN n.Q1 = 1 THEN 1 ELSE 0 END) AS R_15131,
    SUM(CASE WHEN n.Q1 = 2 THEN 1 ELSE 0 END) AS R_15132
  FROM ref_emploi_fonctionnel ef
  LEFT JOIN temp_apa2cons_ind1511 n on n.Q8_3 = ef.id_emplfonc   
  WHERE ef.BL_VALI = 0  
  GROUP BY ef.id_emplfonc
  ORDER BY ef.id_emplfonc
  ;

  
  
  
END
$$
