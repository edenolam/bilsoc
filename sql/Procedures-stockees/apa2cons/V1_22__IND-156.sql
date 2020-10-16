DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind156
$$

CREATE PROCEDURE apa2cons_ind156(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
 	# indicateur 156 etait anciennement 157  anciennement 158

  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind156;
  CREATE TEMPORARY TABLE temp_apa2cons_ind156 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT
        bsa.CD_SEXE AS Q1,
		bsa.ID_FILI AS Q3ter,
		c.CD_CATE AS Q3bis
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		LEFT JOIN ref_categorie AS c ON bsa.ID_CATE = c.ID_CATE  # Q3bis
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND rs.CD_STAT IN ('TITU', 'STAG')  # Q2
		AND bsa.BL_PROMAVANSTAGANNE = 1 #Q18
                AND EXISTS (SELECT 1
                            FROM Agent_AvancementPromotionsConcours AS aapc
                                JOIN ref_avancement_promotion_concours AS rpc ON aapc.id_avancement_promotion_concours = rpc.id_avanpromconc
                            WHERE aapc.agent_id = bsa.id_bilasociagen
                                AND rpc.cd_avanpromconc = 'APC002') #Ceci correspond à une avancé de grade
		AND bsa.ID_FILI is  not null
    );

  ### Remplissage de 1.5.8
  INSERT INTO ind_158 (ID_BILASOCICONS, ID_FILI, R_1581, R_1582, R_1583, R_1584, R_1585, R_1586, R_1587, R_1588)
  SELECT idBilaSociCons, f.ID_FILI,
	SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'A' THEN 1 ELSE 0 END) AS R_1581,
	SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'A' THEN 1 ELSE 0 END) AS R_1582,
	SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'B' THEN 1 ELSE 0 END) AS R_1583,
	SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'B' THEN 1 ELSE 0 END) AS R_1584,
	SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'C' THEN 1 ELSE 0 END) AS R_1585,
	SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'C' THEN 1 ELSE 0 END) AS R_1586,
	SUM(CASE WHEN t.Q1 = 1 AND t.Q3bis = 'AOTM' THEN 1 ELSE 0 END) AS R_1587,
	SUM(CASE WHEN t.Q1 = 2 AND t.Q3bis = 'AOTM' THEN 1 ELSE 0 END) AS R_1588
  FROM ref_filiere f
  LEFT JOIN temp_apa2cons_ind156 t on t.Q3ter = f.ID_FILI
  WHERE f.bl_vali = 0
  GROUP BY idBilaSociCons, f.ID_FILI
  ORDER BY f.ID_FILI;

  
END
$$
