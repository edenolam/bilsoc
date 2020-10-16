DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind611_613
$$

CREATE PROCEDURE apa2cons_ind611_613(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	declare vR6111 int(11);
	declare vR6112 int(11);
        declare vQ6113 int(11);
	declare vR6113 int(11);
	declare vQ6114 int(11);
	declare vR6114 int(11);
	declare vR6121 int(11);
	declare vR6122 int(11);
	declare vR6123 int(11);
	declare vR6124 int(11);
	declare vR6125 int(11);
	declare vR6126 int(11);
	declare vQ613  int(11);
	declare vIdInfoCollAgen int(11);

	declare vR6115   int(11);
	declare vR6116   int(11);
	declare vR6117   int(11);

	SELECT NB_REUNCT, NB_REUNCOMMIADMI, NB_REUNCHSCT, BL_CTSIEGMISSDEVO, NB_REUNCTMISSDEVO,
					NB_JOURAUTOSPEACCO,NB_JOURABSE,NB_HEURGLOB,NB_HEURDROISYND,NB_HEURUTIL,NB_PROTACCO, BL_GREV, ID_INFOCOLLAGEN,
					NB_REUNCOMMICONSU, NB_JOUR_ACT_REP , NB_JOUR_ACT_SEC
		INTO vR6111,vR6112,vR6113,vQ6114,vR6114,
					vR6121, vR6122, vR6123, vR6124, vR6125, vR6126, vQ613, vIdInfoCollAgen,
					vR6117, vR6115, vR6116
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;

        SELECT 
        CASE WHEN vR6113 IS NOT NULL 
               THEN  1
               ELSE  0
        END
        INTO vQ6113;

	UPDATE bilan_social_consolide set R_6111 = vR6111, R_6112 = vR6112, Q_6113 = vQ6113, R_6113 = vR6113, Q_6114 = vQ6114, R_6114 = vR6114,
									R_6121 = vR6121, R_6122 = vR6122, R_6123 = vR6123, R_6124 = vR6124, R_6125 = vR6125, R_6126 = vR6126, Q_613 = vQ613,
									R_6117 = vR6117, R_6115 = vR6115, R_6116 = vR6116
	where ID_BILASOCICONS = idBilaSociCons;
	
	
	insert into ind_613(ID_BILASOCICONS, ID_MOTIGREV, R_6132)
	select idBilaSociCons, ID_MOTIGREV, SUM(R_7131)
	from conflit_travail
	where ID_INFOCOLLAGEN = vIdInfoCollAgen
	GROUP BY idBilaSociCons, ID_MOTIGREV;
	
END
$$
