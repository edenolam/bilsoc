DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind217
$$

CREATE PROCEDURE apa2cons_ind217(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vQ2171 tinyint(1);
	declare vR2171 tinyint(1);
	declare vQ2172 tinyint(1);
	declare vR2172 tinyint(1);
	declare vQ2173 tinyint(1);
	declare vR2173 tinyint(1);
	declare vQ2174 tinyint(1);
	declare vR2174 tinyint(1);

	SELECT Q2171, R2171, Q2172, R2172, Q2173, R2173, Q2174, R2174
	    INTO vQ2171, vR2171, vQ2172, vR2172, vQ2173, vR2173, vQ2174, vR2174
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;

	UPDATE bilan_social_consolide set R_2171 = vQ2171, R_2172 = vR2171, R_2173 = vQ2172, R_2174 = vR2172,
	    R_2175 = vQ2173, R_2176 = vR2173, R_2177 = vQ2174, R_2178 = vR2174
	where ID_BILASOCICONS = idBilaSociCons;



END
$$

