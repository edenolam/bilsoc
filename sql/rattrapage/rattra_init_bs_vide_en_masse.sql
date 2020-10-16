DELIMITER $$

DROP PROCEDURE IF EXISTS ratt_init_source_bs_vide
$$

CREATE PROCEDURE ratt_init_source_bs_vide()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER

BEGIN
	DECLARE cursIdBS INT(11);
	
   
   DECLARE cursDone INT DEFAULT FALSE;
   DECLARE cursRattInitSource CURSOR FOR 
			SELECT ID_INIT_BS FROM init_bilan_social WHERE INIT_SOURCE IS NULL; 
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;
    OPEN cursRattInitSource;
    ratt_init_loop:LOOP
      FETCH cursRattInitSource
      INTO cursIdBS;
      IF cursDone
      THEN
        LEAVE ratt_init_loop;
      END IF;
	      UPDATE init_bilan_social SET CD_UTILMODI = 'RATT', INIT_SOURCE = 'bs-vide' WHERE ID_INIT_BS = cursIdBS;
    END LOOP;
    CLOSE cursRattInitSource;
  END
$$