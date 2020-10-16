DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind412
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind412
$$

CREATE PROCEDURE traitementDoublons_ind412(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid412 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind412_cursor CURSOR FOR
		select id_412, ID_ACTIONPREV from ind_412
		where id_bilasocicons = idBilaSociCons
		order by ID_ACTIONPREV, id_412 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_412_delete;
	CREATE TEMPORARY TABLE temp_ind_412_delete (
		id412 int
	);

	SET vkeyPrevious = -1;

	OPEN ind412_cursor;
    ind_loop: LOOP

		FETCH ind412_cursor INTO vid412, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_412_delete (id412)
			VALUES (vid412);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind412_cursor;

	DELETE FROM ind_412
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_412_delete t WHERE t.id412 = ind_412.id_412);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind412()
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
            (select id_bilasocicons, ID_ACTIONPREV, count(*)
            from ind_412
            group by id_bilasocicons, ID_ACTIONPREV
            having count(*)>1
            order by id_bilasocicons, ID_ACTIONPREV) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind412(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
