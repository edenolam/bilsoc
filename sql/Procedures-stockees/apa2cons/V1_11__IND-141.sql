DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind141
$$

CREATE PROCEDURE apa2cons_ind141(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind141;
  CREATE TEMPORARY TABLE temp_apa2cons_ind141 (INDEX(Q_2_7_0bis, Q1))
    ENGINE = MEMORY
    AS (
      	SELECT        
			bsa.ID_POSISTAT AS Q_2_7_0bis,
			bsa.CD_SEXE AS Q1
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2  			
		  WHERE bsa.ID_COLL = idColl
                        AND bsa.ID_ENQU = idEnqu
                        AND ((rs.CD_STAT IN ('TITU' , 'STAG', 'CONTPERM') AND bsa.ID_POSISTAT is not null)
                        OR bsa.BL_POSIACTI = 0) #Q2_7_0		  
    );






  ### Remplissage de 1.4.1
  INSERT INTO ind_141 (ID_BILASOCICONS, ID_POSISTAT, R_1411, R_1412)
  SELECT idBilaSociCons, ps.id_posistat,
          SUM(CASE WHEN n.Q1 = 1 THEN 1 ELSE 0 END) AS R_1411,
          SUM(CASE WHEN n.Q1 = 2 THEN 1 ELSE 0 END) AS R_1412
  FROM ref_position_statutaire ps
  LEFT JOIN temp_apa2cons_ind141 n on n.Q_2_7_0bis = ps.id_posistat
  WHERE ps.BL_VALI = 0
  AND COALESCE(ps.bl_ind142,0) = 0 AND  COALESCE(ps.bl_ind143,0) = 0 AND  COALESCE(ps.bl_ind144,0) = 0 
  GROUP BY ps.id_posistat
  ORDER BY ps.id_grouposistat, ps.id_posistat
  ;



UPDATE
    ind_141 AS ind
    JOIN (
        SELECT
            ind_temp.R_1411, ind_temp.R_1412, ind_temp.ID_BILASOCICONS
        FROM
            ind_141 ind_temp
        JOIN ref_position_statutaire ps ON  ind_temp.ID_POSISTAT = ps.ID_POSISTAT
        WHERE
            ps.CD_POSISTAT = "PS012"
            AND
            ind_temp.ID_BILASOCICONS = idBilaSociCons
    ) AS `src` ON src.ID_BILASOCICONS = ind.ID_BILASOCICONS


JOIN ref_position_statutaire ps ON  ind.ID_POSISTAT = ps.ID_POSISTAT

SET
    ind.R_1411 = src.R_1411 + ind.R_1411,
    ind.R_1412 = src.R_1412 + ind.R_1412
WHERE
    ps.CD_POSISTAT = "PS011"
    AND
    ind.ID_BILASOCICONS = idBilaSociCons
;

END
$$
