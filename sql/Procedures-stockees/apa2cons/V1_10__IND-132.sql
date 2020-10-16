DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind132
$$

CREATE PROCEDURE apa2cons_ind132(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
  ### Création et remplissage de la table temporaire
    declare v132 tinyint(1);

    declare vR_13221_1 int(11);
    declare vR_13222_1 int(11);
    declare vR_13223_2 int(11);
    declare vR_13224_2 int(11);

  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_ind132;
  CREATE TEMPORARY TABLE temp_apa2cons_ind132 (INDEX(ID_INFOCOLLAGEN))
    ENGINE = MEMORY
    AS (
      	SELECT
			i.ID_INFOCOLLAGEN,
			i.ID_FILI,
			i.R_1321,
			i.R_1322,
			i.R_1323,
			i.R_1324
		  FROM infocoll_132 i
		  JOIN information_colectivite_agent ica ON ica.ID_INFOCOLLAGEN = i.ID_INFOCOLLAGEN
		  WHERE ica.ID_COLL = idColl
			AND ica.ID_ENQU = idEnqu

    );


  ### Remplissage de 1.3.1.2
  INSERT INTO ind_132 (ID_BILASOCICONS, ID_FILI, R_13211_1, R_13212_1, R_13213_2, R_13214_2)
  SELECT idBilaSociCons, i.ID_FILI,
			i.R_1321,
			i.R_1322,
			i.R_1323,
			i.R_1324
  FROM temp_apa2cons_ind132 i;



    SELECT bl_RecPersTemp, R_13221_1, R_13222_1, R_13223_2, R_13224_2 INTO v132, vR_13221_1, vR_13222_1, vR_13223_2, vR_13224_2
    FROM information_colectivite_agent
    WHERE ID_COLL = idColl
    AND ID_ENQU = idEnqu;

    UPDATE bilan_social_consolide set Q_132 = v132
    where ID_BILASOCICONS = idBilaSociCons;


    INSERT INTO ind_132_bis (ID_BILASOCICONS, R_13221_1, R_13222_1, R_13223_2, R_13224_2) VALUES( idBilaSociCons, vR_13221_1, vR_13222_1, vR_13223_2, vR_13224_2 );

END
$$
