DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind214
$$

CREATE PROCEDURE apa2cons_ind214(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN


  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind214;
  CREATE TEMPORARY TABLE temp_apa2cons_ind214 (INDEX(Q3bis))
    ENGINE = MEMORY
    AS (
      SELECT
		bsa.ID_CATE AS Q3bis,
		count(DISTINCT aaa.ID_BILASOCIAGEN) AS NB_AGENT,
		sum(aaa.NB_JOURABSE) AS NB_JOURABSE
      FROM bilan_social_agent AS bsa
		JOIN absence_arret_agent AS aaa  ON bsa.ID_BILASOCIAGEN = aaa.ID_BILASOCIAGEN
		JOIN ref_motif_absence AS rma ON aaa.ID_MOTIABSE = rma.ID_MOTIABSE
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND bsa.ID_CATE is not null			  # Q3bis
		AND bsa.BL_AGENABSE = 1         	# Q20.1
		AND rma.CD_MOTIABSE = 'ABS007'		# Paternite et adoption
	  GROUP BY bsa.ID_CATE
    );

  ### Remplissage
  INSERT INTO ind_214 (ID_BILASOCICONS, ID_CATE, R_2141, R_2142)
  SELECT idBilaSociCons, c.ID_CATE,
    t.NB_AGENT AS R_2141,
    t.NB_JOURABSE AS R_2142
  FROM ref_categorie c
  LEFT JOIN temp_apa2cons_ind214 t on t.Q3bis = c.ID_CATE
  WHERE c.BL_VALI = 0
  ORDER BY c.ID_CATE;


END
$$

