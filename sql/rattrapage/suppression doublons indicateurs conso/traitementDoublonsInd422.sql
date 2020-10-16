DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind422
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind422
$$

CREATE PROCEDURE traitementDoublons_ind422(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid422 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind422_cursor CURSOR FOR
		select id_422, id_cadrempl from ind_422
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_422 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_422_delete;
	CREATE TEMPORARY TABLE temp_ind_422_delete (
		id422 int
	);

	SET vkeyPrevious = -1;

	OPEN ind422_cursor;
    ind_loop: LOOP

		FETCH ind422_cursor INTO vid422, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_422_delete (id422)
			VALUES (vid422);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind422_cursor;

	DELETE FROM ind_422
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_422_delete t WHERE t.id422 = ind_422.id_422);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind422()
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
            from ind_422
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

        call traitementDoublons_ind422(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
