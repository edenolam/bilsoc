DELIMITER $$

DROP PROCEDURE IF EXISTS ratt_check_status_non_saisie
$$

CREATE PROCEDURE ratt_check_status_non_saisie()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vidHist INT;
	
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

Un cas posait problème en formation a la date du 12/09/18 ID_COLL = 3858 (Suppression d une des derniere lignes en doublons ) 

*/
    DECLARE ind_cursor CURSOR FOR
			 SELECT hbs.ID_HISTBILASOCI FROM collectivite c 
 		JOIN bilan_social_agent bsa ON c.ID_COLL = bsa.ID_COLL
 		JOIN enquete e ON bsa.ID_ENQU = e.ID_ENQU
      JOIN historique_bilan_social hbs ON (hbs.ID_COLL = bsa.ID_COLL AND hbs.ID_HISTBILASOCI = (
                        SELECT MAX(h15_.ID_HISTBILASOCI) AS dctrn__2 
                        FROM historique_bilan_social h15_ 
                        WHERE h15_.ID_COLL = bsa.ID_COLL
                        GROUP BY h15_.ID_COLL
                        )  
                )
	   WHERE hbs.FG_STAT = 7 AND bsa.ID_BILASOCIAGEN IS NOT NULL AND e.FG_STAT NOT IN(3)
	   GROUP BY hbs.ID_HISTBILASOCI;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
	

    OPEN ind_cursor;
    ind_loop: LOOP
		
        FETCH ind_cursor INTO vidHist;
		
        IF cursDone THEN
                LEAVE ind_loop;
        END IF;
		
		DELETE FROM historique_bilan_social WHERE ID_HISTBILASOCI = vidHist;
       

    END LOOP;

    CLOSE ind_cursor;

END
$$

