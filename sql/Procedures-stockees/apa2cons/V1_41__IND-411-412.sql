DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind411_412
$$

CREATE PROCEDURE apa2cons_ind411_412(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind411;
  CREATE TEMPORARY TABLE temp_apa2cons_ind411 
    ENGINE = MEMORY
    AS (
      SELECT
		bsa.ID_TYPEMISSPREV AS Q31_2  
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2        
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu        
        AND rs.CD_STAT IN ('TITU', 'STAG', 'CONTPERM')  # Q2   
		AND bsa.ID_TYPEMISSPREV is not null
    );
  
  INSERT INTO ind_411 (ID_BILASOCICONS, ID_TYPEMISSPREV, R_4111)
  SELECT idBilaSociCons, tmp.ID_TYPEMISSPREV, 
    SUM( CASE WHEN t.Q31_2  is not null THEN 1 ELSE 0 END ) AS R_4111    	
  FROM ref_type_mission_prevention tmp  
	LEFT JOIN temp_apa2cons_ind411 t on t.Q31_2 = tmp.ID_TYPEMISSPREV
  WHERE tmp.BL_VALI = 0
  GROUP BY idBilaSociCons, tmp.ID_TYPEMISSPREV
  ORDER BY tmp.ID_TYPEMISSPREV;
  
  
  INSERT INTO ind_412 (ID_BILASOCICONS, ID_ACTIONPREV, R_4121, R_4122, R_4123)
  SELECT idBilaSociCons,  ap.ID_ACTIONPREV, SUM(ap.R_5121), SUM(ap.R_5122), SUM(ap.nb_Agent)     
  FROM action_prevention ap  
	JOIN information_colectivite_agent ica on ica.ID_INFOCOLLAGEN = ap.ID_INFOCOLLAGEN
  WHERE ica.ID_COLL = idColl
  AND ica.ID_ENQU = idEnqu
  AND ap.ID_ACTIONPREV IS NOT NULL
  GROUP BY idBilaSociCons, ap.ID_ACTIONPREV
  ORDER BY ap.ID_ACTIONPREV;
  
  
END
$$
