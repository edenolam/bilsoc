DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind222
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind222
$$

CREATE PROCEDURE traitementDoublons_ind222(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid222 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind222_cursor CURSOR FOR
		select id_222, ID_CONTTRAV from ind_222
		where id_bilasocicons = idBilaSociCons
		order by ID_CONTTRAV, id_222 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_222_delete;
	CREATE TEMPORARY TABLE temp_ind_222_delete (
		id222 int
	);

	SET vkeyPrevious = -1;

	OPEN ind222_cursor;
    ind_loop: LOOP

		FETCH ind222_cursor INTO vid222, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_222_delete (id222)
			VALUES (vid222);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind222_cursor;

	DELETE FROM ind_222
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_222_delete t WHERE t.id222 = ind_222.id_222);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind222()
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
            (select id_bilasocicons, ID_CONTTRAV, count(*)
            from ind_222
            group by id_bilasocicons, ID_CONTTRAV
            having count(*)>1
            order by id_bilasocicons, ID_CONTTRAV) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind222(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
