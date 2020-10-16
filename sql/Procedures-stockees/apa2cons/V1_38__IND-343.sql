DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind343
$$

CREATE PROCEDURE apa2cons_ind343(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vQ343 int(11);


	SELECT MPCCM
	INTO vQ343
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	UPDATE bilan_social_consolide SET Q_343 = vQ343
	WHERE ID_BILASOCICONS = idBilaSociCons; 

	
END
$$
