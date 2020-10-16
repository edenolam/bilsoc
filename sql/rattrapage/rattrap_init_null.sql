DELIMITER $$

DROP PROCEDURE IF EXISTS ratt_init_bs_not_exist
$$

CREATE PROCEDURE ratt_init_bs_not_exist()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vidColl INT;
	DECLARE vidEnqu INT;
	DECLARE vblApa INT;
	DECLARE vblCons INT;
    DECLARE cursDone INT DEFAULT FALSE;

    DECLARE ind_cursor CURSOR FOR
            SELECT DISTINCT ID_COLL, ID_ENQU 
			FROM historique_bilan_social hbs
			WHERE NOT EXISTS (
							SELECT 1 
							FROM init_bilan_social ibs
							WHERE ibs.ID_COLL = hbs.ID_COLL 
							AND ibs.ID_ENQU = hbs.ID_ENQU
										
			);

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
	

    OPEN ind_cursor;
    ind_loop: LOOP
		
        FETCH ind_cursor INTO vidColl, vidEnqu;
		
        IF cursDone THEN
                LEAVE ind_loop;
        END IF;
		
		SELECT 
			CASE
			  WHEN COUNT(1) >= 1 THEN 1 ELSE 0
			END
			INTO vblApa 
		FROM bilan_social_agent
		WHERE ID_COLL = vidColl
			AND ID_ENQU = vidEnqu;
			
		SELECT 
			CASE
			  WHEN COUNT(1) >= 1 THEN 1 ELSE 0
			END
			INTO vblCons 
		FROM bilan_social_consolide
		WHERE ID_COLL = vidColl
			AND ID_ENQU = vidEnqu;
			
		
		
		INSERT INTO init_bilan_social (BL_DECL_AGEN, BL_BS_EXIS, BL_APA, BL_CONS, DT_CREA, CD_UTILCREA, DT_MODI, CD_UTILMODI, ID_ENQU, ID_COLL, INIT_SOURCE, BL_LOCK)
		VALUES(1,0,vblApa,vblCons,NOW(), 'RATT', null, null, vidEnqu, vidColl, 'manu', 1 );
       

    END LOOP;

    CLOSE ind_cursor;

END
$$
