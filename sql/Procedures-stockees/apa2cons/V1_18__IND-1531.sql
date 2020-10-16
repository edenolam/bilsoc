DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind1531
$$

CREATE PROCEDURE apa2cons_ind1531(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind1531;
  CREATE TEMPORARY TABLE temp_apa2cons_ind1531 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT        
        bsa.CD_SEXE AS Q1,
        bsa.BL_TEMPCOMP AS Q11_1,		
        bsa.ID_MOTIARRI AS Q5_4
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2        
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu        
        AND rs.CD_STAT IN ('CONTPERM')  # Q2
    );

  ### Remplissage de 1.5.3.1
  INSERT INTO ind_153_1 (ID_BILASOCICONS, ID_MOTIARRI, R_15311, R_15312, R_15313, R_15314)
  SELECT idBilaSociCons, ma.ID_MOTIARRI,
    SUM(CASE WHEN t.Q1 = '1' AND t.Q11_1 = 1 THEN 1 ELSE 0 END) AS R_15311,
	SUM(CASE WHEN t.Q1 = '2' AND t.Q11_1 = 1 THEN 1 ELSE 0 END) AS R_15312, 
	SUM(CASE WHEN t.Q1 = '1' AND t.Q11_1 = 0 THEN 1 ELSE 0 END) AS R_15313,
	SUM(CASE WHEN t.Q1 = '2' AND t.Q11_1 = 0 THEN 1 ELSE 0 END) AS R_15314 			
  FROM ref_motif_arrivee ma
  LEFT JOIN temp_apa2cons_ind1531 t on t.Q5_4 = ma.ID_MOTIARRI
  WHERE ma.bl_vali = 0
  GROUP BY idBilaSociCons, ma.ID_MOTIARRI
  ORDER BY ma.ID_MOTIARRI;
  
END
$$
