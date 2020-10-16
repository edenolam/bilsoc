DELIMITER $$

DROP PROCEDURE IF EXISTS ratt_bs_valide_transmis
$$

CREATE PROCEDURE ratt_bs_valide_transmis()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    DECLARE vidBsc INT;
	
    DECLARE cursDone INT DEFAULT FALSE;

    DECLARE ind_cursor CURSOR FOR
        SELECT bsc.ID_BILASOCICONS
		FROM bilan_social_consolide bsc 
		JOIN  historique_bilan_social h0_ ON (h0_.ID_COLL = bsc.ID_COLL AND h0_.ID_ENQU = bsc.ID_ENQU AND h0_.DT_CHGT = (
		SELECT MAX(h15_.DT_CHGT) AS dctrn__2 
		FROM historique_bilan_social h15_ 
		WHERE h15_.ID_COLL = bsc.ID_COLL AND h15_.ID_ENQU = bsc.ID_ENQU)
		) 
		WHERE h0_.FG_STAT = 1 AND bsc.FG_STAT = 2;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
	

    OPEN ind_cursor;
    ind_loop: LOOP
		
        FETCH ind_cursor INTO vidBsc;
		
        IF cursDone THEN
                LEAVE ind_loop;
        END IF;
		
		UPDATE bilan_social_consolide SET FG_STAT = 1 WHERE ID_BILASOCICONS = vidColl;
       

    END LOOP;

    CLOSE ind_cursor;

END
$$

