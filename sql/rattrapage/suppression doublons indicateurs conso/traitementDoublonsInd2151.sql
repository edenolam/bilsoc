DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2151
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind2151
$$

CREATE PROCEDURE traitementDoublons_ind2151(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2151 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2151_cursor CURSOR FOR
		select id_2151, ID_MOTIENTR from ind_2151
		where id_bilasocicons = idBilaSociCons
		order by ID_MOTIENTR, id_2151 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2151_delete;
	CREATE TEMPORARY TABLE temp_ind_2151_delete (
		id2151 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2151_cursor;
    ind_loop: LOOP

		FETCH ind2151_cursor INTO vid2151, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2151_delete (id2151)
			VALUES (vid2151);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2151_cursor;

	DELETE FROM ind_2151
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2151_delete t WHERE t.id2151 = ind_2151.id_2151);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2151()
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
            (select id_bilasocicons, ID_MOTIENTR, count(*)
            from ind_2151
            group by id_bilasocicons, ID_MOTIENTR
            having count(*)>1
            order by id_bilasocicons, ID_MOTIENTR) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind2151(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
