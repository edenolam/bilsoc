DELIMITER $$

/*

Cette procédure stockée permet de mettre a jour les inits bilan social, dans le cas ou un consolide est present mais que le init soit toujours en position d'agent par agent avec un BL_CONS a 0

*/

DROP PROCEDURE IF EXISTS ratt_init_bs
$$

CREATE PROCEDURE ratt_init_bs()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    DECLARE vidIBS INT;
	
    DECLARE cursDone INT DEFAULT FALSE;

    DECLARE ind_cursor CURSOR FOR
		SELECT ID_INIT_BS
		FROM init_bilan_social ibs
		JOIN bilan_social_consolide bsc ON ibs.ID_ENQU = bsc.ID_ENQU AND ibs.ID_COLL = bsc.ID_COLL
		WHERE ibs.BL_CONS = 0 
		/*AND ibs.ID_COLL = 37125*/
		;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
	

    OPEN ind_cursor;
    ind_loop: LOOP
		
        FETCH ind_cursor INTO vidIBS;
		
        IF cursDone THEN
                LEAVE ind_loop;
        END IF;
		
		UPDATE init_bilan_social SET BL_CONS = 1 WHERE ID_INIT_BS = vidIBS;
       

    END LOOP;

    CLOSE ind_cursor;

END
$$

