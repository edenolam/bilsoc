DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind111
$$

CREATE PROCEDURE apa2cons_ind111(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind111;
  CREATE TEMPORARY TABLE temp_apa2cons_ind111 (INDEX(Q3))
    ENGINE = MEMORY
    AS (
      SELECT
        bsa.ID_GRAD AS Q3,
        bsa.CD_SEXE AS Q1,
        bsa.BL_TEMPCOMP AS Q11_1,
        rtnc.CD_TEMPNONCOMP AS Q11_2 # TNC001=Moins de 17h30, TNC002=Entre 17h30 et moins de 28h, TNC003=28h et plus
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        LEFT OUTER JOIN ref_temps_non_complet AS rtnc ON bsa.ID_TEMPNONCOMP = rtnc.ID_TEMPNONCOMP # Q11.2
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND bsa.BL_AGENREMU3112 = 1   # Q4.1
        AND rs.CD_STAT IN ('TITU', 'STAG')    # Q2
        AND bsa.ID_GRAD IS NOT NULL
    );

  ### Remplissage de 1.1.1
  INSERT INTO ind_111 (ID_BILASOCICONS, ID_GRAD, R_1111, R_1112, R_1113, R_1114, R_1115, R_1116)
  SELECT idBilaSociCons, g.ID_GRAD,
    SUM(CASE WHEN t.Q11_1 = 1 THEN 1 ELSE 0 END) AS R_1111,
    SUM(CASE WHEN t.Q11_1 = 0 AND t.Q11_2 = 'TNC001' THEN 1 ELSE 0 END) AS R_1112,
    SUM(CASE WHEN t.Q11_1 = 0 AND t.Q11_2 = 'TNC002' THEN 1 ELSE 0 END) AS R_1113,
    SUM(CASE WHEN t.Q11_1 = 0 AND t.Q11_2 = 'TNC003' THEN 1 ELSE 0 END) AS R_1114,
    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS R_1115,
    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS R_1116
  FROM ref_grade g
	JOIN ref_cadre_emploi ce on ce.ID_CADREMPL = g.ID_CADREMPL
	JOIN ref_filiere f on f.ID_FILI = ce.ID_FILI
	LEFT JOIN temp_apa2cons_ind111 t ON t.Q3 = g.ID_GRAD
  WHERE g.bl_vali = 0
  GROUP BY idBilaSociCons, g.ID_GRAD
  ORDER BY f.ID_FILI, ce.ID_CADREMPL, g.ID_GRAD;
END
$$
