DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind210
$$

CREATE PROCEDURE apa2cons_ind210(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vR2102 int(11);
	declare vR2103 int(11);
	declare vR2104 int(11);


	SELECT R2102, R2103, R2104 INTO vR2102,vR2103,vR2104
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	UPDATE bilan_social_consolide set R_2102 = vR2102, R_2103 = vR2103, R_2104 = vR2104
	where ID_BILASOCICONS = idBilaSociCons;
	
END
$$
