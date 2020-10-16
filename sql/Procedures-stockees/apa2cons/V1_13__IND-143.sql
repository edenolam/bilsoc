DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind143
$$

CREATE PROCEDURE apa2cons_ind143(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  #TODO bug si un select ne renvoie rien
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind143;
  CREATE TEMPORARY TABLE temp_apa2cons_ind143 (INDEX(Q_2_7_0bis, Q1))
    ENGINE = MEMORY
    AS (
      	SELECT
			bsa.ID_POSISTAT AS Q_2_7_0bis,
			bsa.CD_SEXE AS Q1,
			rs.CD_STAT AS Q2
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.ID_POSISTAT is not null
			AND bsa.BL_POSIACTI = 0 #Q2.7.0		
    );


	  ### Remplissage de 1.4.3
	  INSERT INTO ind_143 (ID_BILASOCICONS, ID_POSISTAT, R_1431, R_1432, R_1433, R_1434)
	  SELECT idBilaSociCons, ps.id_posistat
		,
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('TITU', 'STAG') THEN 1 ELSE 0 END) AS R_1431,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('TITU', 'STAG') THEN 1 ELSE 0 END) AS R_1432,
		SUM(CASE WHEN t.Q1 = 1 AND t.Q2 in ('CONTPERM', 'CONTNONPERM') THEN 1 ELSE 0 END) AS R_1433,
		SUM(CASE WHEN t.Q1 = 2 AND t.Q2 in ('CONTPERM', 'CONTNONPERM') THEN 1 ELSE 0 END) AS R_1434
	  FROM ref_position_statutaire ps
	  LEFT JOIN temp_apa2cons_ind143 t on t.Q_2_7_0bis = ps.id_posistat
	  WHERE ps.BL_VALI = 0
	  AND COALESCE(ps.bl_ind143,0) = 1
	  GROUP BY ps.id_posistat
	  ORDER BY ps.id_grouposistat, ps.id_posistat
	  ;



END
$$
