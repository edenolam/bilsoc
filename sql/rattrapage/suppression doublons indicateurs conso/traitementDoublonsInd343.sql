DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind344
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind344
$$

CREATE PROCEDURE traitementDoublons_ind344(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid344 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind344_cursor CURSOR FOR
		select id_344, id_cadrempl from ind_344
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_344 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_344_delete;
	CREATE TEMPORARY TABLE temp_ind_344_delete (
		id344 int
	);

	SET vkeyPrevious = -1;

	OPEN ind344_cursor;
    ind_loop: LOOP

		FETCH ind344_cursor INTO vid344, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_344_delete (id344)
			VALUES (vid344);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind344_cursor;

	DELETE FROM ind_344
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_344_delete t WHERE t.id344 = ind_344.id_344);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind344()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    DECLARE vid_bilasocicons INT;
    DECLARE cursDone INT DEFAULT FALSE;

    DECLARE ind_cursor CURSOR FOR
            select distinct req.id_bilasocicons
            from 
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from ind_344
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind344(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
