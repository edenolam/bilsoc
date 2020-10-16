DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind113
$$

CREATE PROCEDURE apa2cons_ind113(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  DROP TEMPORARY TABLE IF EXISTS temp_genre;
  CREATE TEMPORARY TABLE temp_genre (fg_genre int)
    ENGINE = MEMORY
    ;
  insert into temp_genre  values (1);
  insert into temp_genre  values (2);
  
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind113;
  CREATE TEMPORARY TABLE temp_apa2cons_ind113 (INDEX(Q3bis, Q1))
    ENGINE = MEMORY
    AS (
      SELECT
        bsa.ID_CATE AS Q3bis,
        bsa.CD_SEXE AS Q1,
        rtp.CD_TEMPPART AS Q12_2 # PARTAUTO=Temps partiel sur autorisation, PARTDROI=Temps partiel de droit
      FROM bilan_social_agent AS bsa
        JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
        JOIN ref_temps_partiel AS rtp ON bsa.ID_TEMPPART = rtp.ID_TEMPPART
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND bsa.BL_AGENREMU3112 = 1         # Q4.1
        AND rs.CD_STAT IN ('TITU', 'STAG')  # Q2
        AND bsa.BL_TEMPCOMP = 1             # Q11.1
        AND bsa.BL_TEMPPLEIN = 0            # Q12.1
    );

  ### Remplissage de 1.1.3
  INSERT INTO ind_113 (ID_BILASOCICONS, ID_CATE, FG_GENR, R_1131, R_1132)
  SELECT idBilaSociCons, c.ID_CATE, CASE WHEN g.fg_genre = 1 THEN 'H' ELSE 'F' END,
    SUM(CASE WHEN t.Q12_2 = 'PARTDROI' THEN 1 ELSE 0 END) AS R_1131,
    SUM(CASE WHEN t.Q12_2 = 'PARTAUTO' THEN 1 ELSE 0 END) AS R_1132
  FROM ref_categorie c  JOIN temp_genre g
	LEFT JOIN temp_apa2cons_ind113 t on t.Q3bis = c.ID_CATE AND g.fg_genre = t.Q1
  WHERE c.BL_VALI = 0
  GROUP BY idBilaSociCons, c.ID_CATE, g.fg_genre
  ORDER BY c.ID_CATE, g.fg_genre;
  
  
END
$$
