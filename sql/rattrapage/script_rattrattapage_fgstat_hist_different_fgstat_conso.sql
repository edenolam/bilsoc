DELIMITER $$

DROP PROCEDURE IF EXISTS ratt_set_same_fgstat_conso_to_hist
$$

CREATE PROCEDURE ratt_set_same_fgstat_conso_to_hist()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vidHist INT;
	DECLARE vfgStatCons INT;
	DECLARE vidDepa INT;
	DECLARE vidColl INT;
	DECLARE vidEnqu INT;
    DECLARE cursDone INT DEFAULT FALSE;
/*

REQUETE DE CONTROLE - 
/!\ Si cette requete sort un ou des resultats, ces resultat on une date qui est mal enregistré, elle sera inferieur a un autre date avec un id plus elevé. 
/!\ a prendre en compte pour recuperer le derniere historique en fonction de la date ou de l id.

SELECT ID_HISTBILASOCI, id_coll, id_enqu
FROM historique_bilan_social hbs
WHERE EXISTS (SELECT 1 
				FROM historique_bilan_social hbs2
				WHERE hbs.ID_HISTBILASOCI >  hbs2.ID_HISTBILASOCI
				AND hbs.dt_chgt < hbs2.dt_chgt
				AND hbs.ID_COLL = hbs2.id_coll
				AND hbs.id_enqu = hbs2.id_enqu)



*/
    DECLARE ind_cursor CURSOR FOR
		SELECT hbs.ID_HISTBILASOCI, bsc.FG_STAT, hbs.ID_DEPA, hbs.ID_COLL, hbs.ID_ENQU
		FROM historique_bilan_social hbs
		JOIN (
			SELECT MAX(h15_.ID_HISTBILASOCI) AS ID_HISTBILASOCI 
			FROM historique_bilan_social h15_ 
			GROUP BY h15_.ID_COLL
		) last_histo ON last_histo.ID_HISTBILASOCI = hbs.ID_HISTBILASOCI
		JOIN bilan_social_consolide bsc ON bsc.ID_ENQU = hbs.ID_ENQU AND bsc.ID_COLL = hbs.ID_COLL
		WHERE bsc.FG_STAT <> hbs.FG_STAT;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
	

    OPEN ind_cursor;
    ind_loop: LOOP
		
        FETCH ind_cursor INTO vidHist,vfgStatCons,vidDepa,vidColl,vidEnqu;
		
        IF cursDone THEN
                LEAVE ind_loop;
        END IF;
		/*SELECT vfgStatCons,1,NOW(),vidDepa,vidColl,vidEnqu;*/
		INSERT INTO `historique_bilan_social` (`ID_HISTBILASOCI`, `FG_STAT`, `CD_TYPEBILASOCI`, `DT_CHGT`, `ID_DEPA`, `ID_COLL`, `ID_ENQU`) VALUES (null,vfgStatCons,1,NOW(),vidDepa,vidColl,vidEnqu);
		
       

    END LOOP;

    CLOSE ind_cursor;

END
$$

