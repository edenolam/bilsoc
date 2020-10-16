DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind154
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind154
$$

CREATE PROCEDURE traitementDoublons_ind154(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid154 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind154_cursor CURSOR FOR
		select id_154, ID_STAGTITU from ind_154
		where id_bilasocicons = idBilaSociCons
		order by ID_STAGTITU, id_154 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_154_delete;
	CREATE TEMPORARY TABLE temp_ind_154_delete (
		id154 int
	);

	SET vkeyPrevious = -1;

	OPEN ind154_cursor;
    ind_loop: LOOP

		FETCH ind154_cursor INTO vid154, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_154_delete (id154)
			VALUES (vid154);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind154_cursor;

	DELETE FROM ind_154
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_154_delete t WHERE t.id154 = ind_154.id_154);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind154()
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
            (select id_bilasocicons, ID_STAGTITU, count(*)
            from ind_154
            group by id_bilasocicons, ID_STAGTITU
            having count(*)>1
            order by id_bilasocicons, ID_STAGTITU) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind154(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
