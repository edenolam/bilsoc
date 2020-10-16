DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind155
$$

CREATE PROCEDURE apa2cons_ind155(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind155;
  CREATE TEMPORARY TABLE temp_apa2cons_ind155 (INDEX(Q1))
    ENGINE = MEMORY
    AS (
      SELECT
        bsa.CD_SEXE AS Q1,
		aapc.id_avancement_promotion_concours AS Q18_1
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        LEFT JOIN Agent_AvancementPromotionsConcours aapc ON aapc.agent_id = bsa.ID_BILASOCIAGEN #Q18_1
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND rs.CD_STAT IN ('TITU', 'STAG')  # Q2
		AND bsa.BL_PROMAVANSTAGANNE = 1 #Q18
		AND aapc.id_avancement_promotion_concours is not null
    );

  ### Remplissage de 1.5.5
  INSERT INTO ind_155 (ID_BILASOCICONS, ID_AVANPROMCONC, R_1551, R_1552)
  SELECT idBilaSociCons, apc.ID_AVANPROMCONC,    
	SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1551,
	SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1552
  FROM ref_avancement_promotion_concours apc
  LEFT JOIN temp_apa2cons_ind155 t on t.Q18_1 = apc.ID_AVANPROMCONC
  WHERE apc.bl_vali = 0
  GROUP BY idBilaSociCons, apc.ID_AVANPROMCONC
  ORDER BY apc.ID_AVANPROMCONC;

END
$$
