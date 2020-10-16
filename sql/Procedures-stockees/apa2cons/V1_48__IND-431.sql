DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind431
$$

CREATE PROCEDURE apa2cons_ind431(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	declare vQ431 tinyint(1);
	declare vQ432 int(11);
	declare vQ433 int(11);

	SELECT BL_ACTEVIOLPHYS, Q432, Q433 INTO vQ431, vQ432, vQ433
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	UPDATE bilan_social_consolide set Q_4311 = vQ431, Q_4312 = vQ432, Q_4313 = vQ433
	where ID_BILASOCICONS = idBilaSociCons;
		
	INSERT INTO ind_431(ID_BILASOCICONS, ID_ACTEVIOLPHYS, R_43111, R_43112, R_43121, R_43122, R_43131, R_43132)
	SELECT idBilaSociCons,  avp .ID_ACTEVIOLPHYS, SUM(avp.R_5311), SUM(avp.R_5312), SUM(avp.R_4313), SUM(avp.R_4314), SUM(avp.R_4315), SUM(avp.R_4316)
	FROM acte_violence_physique  avp 
		join information_colectivite_agent ica on ica.ID_INFOCOLLAGEN = avp.ID_INFOCOLLAGEN
	WHERE ica.ID_COLL = idColl
	AND ica.ID_ENQU = idEnqu
	GROUP BY idBilaSociCons,  avp .ID_ACTEVIOLPHYS
	ORDER BY avp.ID_ACTEVIOLPHYS;
	
	
END
$$
