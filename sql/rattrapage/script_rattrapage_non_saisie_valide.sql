DELIMITER $$

DROP PROCEDURE IF EXISTS ratt_historique_non_saisi_a_valide
$$

CREATE PROCEDURE ratt_historique_non_saisi_a_valide()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    DECLARE vidHBS INT;
	
    DECLARE cursDone INT DEFAULT FALSE;

    DECLARE ind_cursor CURSOR FOR
        SELECT hbs.ID_HISTBILASOCI FROM collectivite c 
        JOIN historique_bilan_social hbs ON (hbs.ID_COLL = c.ID_COLL AND hbs.DT_CHGT = (
                        SELECT MAX(h15_.DT_CHGT) AS dctrn__2 
                        FROM historique_bilan_social h15_ 
                        WHERE h15_.ID_COLL = c.ID_COLL
                        )  
                )   
        JOIN bilan_social_consolide bsc ON hbs.ID_ENQU = bsc.ID_ENQU AND bsc.ID_COLL = hbs.ID_COLL
        WHERE bsc.FG_STAT = 2 AND hbs.FG_STAT = 7;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
	

    OPEN ind_cursor;
    ind_loop: LOOP
		
        FETCH ind_cursor INTO vidHBS;
		
        IF cursDone THEN
                LEAVE ind_loop;
        END IF;
		
		UPDATE historique_bilan_social SET FG_STAT = 2 WHERE ID_HISTBILASOCI = vidHBS;
       

    END LOOP;

    CLOSE ind_cursor;

END
$$

