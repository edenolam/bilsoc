DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_ind711_714
$$

CREATE PROCEDURE apa2cons_ind711_714(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	declare vQ7111 int(11);
	declare vQ7112 int(11);
	declare vQ7122 int(11);
	declare vQ7131 int(11);
	declare vQ7132 int(11);
	declare vQ7133 int(11);
	declare vQS7141 int(11);
	declare vQS7142	int(11);
	declare vQP7143 int(11);
	declare vQP7144 int(11);
	declare vIdInfoCollAgen int(11);

#TODO

	SELECT BL_SUBVVERSCOMI, BL_COTISUBVCOMIINTER, BL_PRESSERVCOMSOC,
	                BL_PLACRESECREC, BL_AIDEFINAGARDENFA, BL_AUTRGARDENFA,
					BL_SANTCONVPARTI, BL_SANTCONTREGL, BL_PREVOCONVPARTI, BL_PREVOCONTREGL, ID_INFOCOLLAGEN
		INTO vQ7111, vQ7112, vQ7122,
		        vQ7131, vQ7132, vQ7133,
				vQS7141, vQS7142, vQP7143, vQP7144, vIdInfoCollAgen
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;
	
	UPDATE bilan_social_consolide set Q_7111 = vQ7111, Q_7122 = vQ7122,
	    Q_7131 = vQ7131, Q_7132 = vQ7132, Q_7133 = vQ7133,
		 Q_S7141 = vQS7141, Q_S7142 = vQS7142, Q_P7143 = vQP7143, Q_P7144 = vQP7144
	where ID_BILASOCICONS = idBilaSociCons;
	
        IF (vQ7111 IS NULL OR vQ7112 IS NULL)
            THEN
		UPDATE bilan_social_consolide set MOYENNE_IND711 = 0
		where ID_BILASOCICONS = idBilaSociCons;
	END IF;

     IF vQ7122 IS NULL
            THEN
		UPDATE bilan_social_consolide set MOYENNE_IND712 = 0
		where ID_BILASOCICONS = idBilaSociCons;
	END IF;

        IF (vQ7131 IS NULL OR  vQ7132 IS NULL OR vQ7133 IS NULL)
            THEN
		UPDATE bilan_social_consolide set MOYENNE_IND713 = 0
		where ID_BILASOCICONS = idBilaSociCons;
	END IF;
	
	insert into ind_7141(ID_BILASOCICONS, ID_CATE, R_71411, R_71412)
	select idBilaSociCons, c.id_cate, SUM(s.R_81411), SUM(p.R_81421)
	from ref_categorie c
		left join sante s on s.id_cate = c.id_cate and s.ID_INFOCOLLAGEN = vIdInfoCollAgen
		left join prevoyance p on p.id_cate = c.id_cate and p.ID_INFOCOLLAGEN = vIdInfoCollAgen
	where c.bl_vali = 0
	and p.ID_INFOCOLLAGEN = vIdInfoCollAgen 
	and s.ID_INFOCOLLAGEN = vIdInfoCollAgen
	GROUP BY idBilaSociCons, c.id_cate
	order by c.id_cate;
	
	insert into ind_7142(ID_BILASOCICONS, ID_CATE, R_71421, R_71422)
	select idBilaSociCons, c.id_cate, SUM(s.R_81412), SUM(p.R_81422)
	from ref_categorie c
		left join sante s on s.id_cate = c.id_cate and s.ID_INFOCOLLAGEN = vIdInfoCollAgen
		left join prevoyance p on p.id_cate = c.id_cate and p.ID_INFOCOLLAGEN = vIdInfoCollAgen
	where c.bl_vali = 0
	GROUP BY idBilaSociCons, c.id_cate
	order by c.id_cate;
	
	
	
	
	
END
$$
