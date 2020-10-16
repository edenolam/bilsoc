DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind431
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind431
$$

CREATE PROCEDURE traitementDoublons_ind431(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid431 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind431_cursor CURSOR FOR
		select id_431, ID_ACTEVIOLPHYS from ind_431
		where id_bilasocicons = idBilaSociCons
		order by ID_ACTEVIOLPHYS, id_431 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_431_delete;
	CREATE TEMPORARY TABLE temp_ind_431_delete (
		id431 int
	);

	SET vkeyPrevious = -1;

	OPEN ind431_cursor;
    ind_loop: LOOP

		FETCH ind431_cursor INTO vid431, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_431_delete (id431)
			VALUES (vid431);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind431_cursor;

	DELETE FROM ind_431
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_431_delete t WHERE t.id431 = ind_431.id_431);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind431()
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
            (select id_bilasocicons, ID_ACTEVIOLPHYS,  count(*)
            from ind_431
            group by id_bilasocicons, ID_ACTEVIOLPHYS
            having count(*)>1
            order by id_bilasocicons, ID_ACTEVIOLPHYS) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind431(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
