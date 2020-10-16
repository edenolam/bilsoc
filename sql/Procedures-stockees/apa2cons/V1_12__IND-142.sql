DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind142
$$

CREATE PROCEDURE apa2cons_ind142(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire  
  #TODO bug si un select ne renvoie rien  
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind142;
  CREATE TEMPORARY TABLE temp_apa2cons_ind142 (INDEX(Q_2_7_0bis, Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.ID_POSISTAT AS Q_2_7_0bis,
			bsa.CD_SEXE AS Q1,
			rs.CD_STAT AS Q2, 
			bsa.BL_EMPLFONC AS Q8_1,
			bsa.BL_STRUORIGPOSISTAT AS R2_7_BB,
			rso.CD_STRUORIG AS Q15_1,
			enp.CD_EMPLNONPERM AS Q2_6
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  
			LEFT JOIN ref_structure_origine as rso ON bsa.ID_STRUORIG = rso.ID_STRUORIG  #Q15.1
			LEFT JOIN ref_emploi_non_permanent as enp ON bsa.ID_EMPLNONPERM = enp.ID_EMPLNONPERM  #Q2.6				
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu			
			AND bsa.ID_POSISTAT is not null
			AND bsa.BL_POSIACTI = 0 #Q2.7.0		  
    );

  
	  ### Remplissage de 1.4.2
	  INSERT INTO ind_142 (ID_BILASOCICONS, ID_POSISTAT, R_1421, R_1422, R_1423, R_1424, R_1425, R_1426)
	  SELECT idBilaSociCons, ps.id_posistat
		, 
		SUM(CASE WHEN t.Q1 = 1 AND ps.cd_posistat != 'PS004' AND t.Q8_1 = 0 AND t.R2_7_BB = 1 THEN 1 ELSE 0 END) AS R_1421,
		SUM(CASE WHEN t.Q1 = 2 AND ps.cd_posistat != 'PS004' AND t.Q8_1 = 0 AND t.R2_7_BB = 1 THEN 1 ELSE 0 END) AS R_1422,
		SUM(CASE WHEN t.Q1 = 1 AND ps.cd_posistat != 'PS004' AND t.Q8_1 = 1 AND t.R2_7_BB = 1 AND t.Q15_1 = 'FPE' THEN 1 ELSE 0 END) AS R_1423,
		SUM(CASE WHEN t.Q1 = 2 AND ps.cd_posistat != 'PS004' AND t.Q8_1 = 1 AND t.R2_7_BB = 1 AND t.Q15_1 = 'FPE' THEN 1 ELSE 0 END) AS R_1424,
		SUM(CASE WHEN t.Q1 = 1 AND (ps.cd_posistat = 'PS004' OR (t.Q2 = 'CONTNONPERM' AND Q2_6 = 'EF001' AND t.Q15_1 = 'FPE')  )  THEN 1 ELSE 0 END) AS R_1425,
		SUM(CASE WHEN t.Q1 = 2 AND (ps.cd_posistat = 'PS004' OR (t.Q2 = 'CONTNONPERM' AND Q2_6 = 'EF001' AND t.Q15_1 = 'FPE')  )  THEN 1 ELSE 0 END) AS R_1426
	  FROM ref_position_statutaire ps
	  LEFT JOIN temp_apa2cons_ind142 t on t.Q_2_7_0bis = ps.id_posistat
	  WHERE ps.BL_VALI = 0
	  AND COALESCE(ps.bl_ind142,0) = 1 
	  GROUP BY ps.id_posistat
	  ORDER BY ps.id_grouposistat, ps.id_posistat
	  ;
  
  
  
END
$$
