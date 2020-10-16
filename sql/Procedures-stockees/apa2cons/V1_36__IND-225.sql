DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind225
$$

CREATE PROCEDURE apa2cons_ind225(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
	
	declare vQ225 int(11);

	SELECT BL_CHARTEMP INTO vQ225
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	UPDATE bilan_social_consolide SET Q_225 = vQ225
	WHERE ID_BILASOCICONS = idBilaSociCons;
	
		
  
END
$$

