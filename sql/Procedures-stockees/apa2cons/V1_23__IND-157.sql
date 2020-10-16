DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind157
$$

CREATE PROCEDURE apa2cons_ind157(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

   DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind157;
  CREATE TEMPORARY TABLE temp_apa2cons_ind157 (INDEX(ID_INFOCOLLAGEN, ID_CATE))
    ENGINE = MEMORY
    AS (
      	SELECT
			i.ID_INFOCOLLAGEN,
			i.ID_CATE,
			i.R_1571,
			i.R_1572
		  FROM infocoll_157 i
		  JOIN information_colectivite_agent ica ON ica.ID_INFOCOLLAGEN = i.ID_INFOCOLLAGEN
		  WHERE ica.ID_COLL = idColl
			AND ica.ID_ENQU = idEnqu

    );


  ### Remplissage de 1.5.7
  INSERT INTO ind_157 (ID_BILASOCICONS, ID_CATE, R_1571, R_1572)
  SELECT idBilaSociCons, i.ID_CATE,
			i.R_1571,
			i.R_1572
  FROM temp_apa2cons_ind157 i;


  
END
$$
