DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind425
$$

CREATE PROCEDURE apa2cons_ind425(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vQ425  int(11);

	SELECT  Q425
	INTO vQ425
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	UPDATE bilan_social_consolide SET Q_425 = vQ425
	WHERE ID_BILASOCICONS = idBilaSociCons; 
	
	
	
END
$$
