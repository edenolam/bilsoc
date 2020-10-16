DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind613
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind613
$$

CREATE PROCEDURE traitementDoublons_ind613(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid613 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind613_cursor CURSOR FOR
		select id_613, ID_MOTIGREV from ind_613
		where id_bilasocicons = idBilaSociCons
		order by ID_MOTIGREV, id_613 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_613_delete;
	CREATE TEMPORARY TABLE temp_ind_613_delete (
		id613 int
	);

	SET vkeyPrevious = -1;

	OPEN ind613_cursor;
    ind_loop: LOOP

		FETCH ind613_cursor INTO vid613, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_613_delete (id613)
			VALUES (vid613);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind613_cursor;

	DELETE FROM ind_613
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_613_delete t WHERE t.id613 = ind_613.id_613);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind613()
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
            (select id_bilasocicons, ID_MOTIGREV, count(*)
            from ind_613
            group by id_bilasocicons, ID_MOTIGREV
            having count(*)>1
            order by id_bilasocicons, ID_MOTIGREV) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind613(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$

