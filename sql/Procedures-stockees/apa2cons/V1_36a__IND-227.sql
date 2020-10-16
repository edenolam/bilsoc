DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind227
$$

CREATE PROCEDURE apa2cons_ind227(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
	
	declare vR2271 int(11);
	declare vR2272 int(11);

	SELECT R2271, R2272 INTO vR2271, vR2272
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	UPDATE bilan_social_consolide SET R_2271 = vR2271, R_2272 = vR2272
	WHERE ID_BILASOCICONS = idBilaSociCons;

  
END
$$

