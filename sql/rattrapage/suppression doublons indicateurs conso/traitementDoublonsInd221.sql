DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind221
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind221
$$

CREATE PROCEDURE traitementDoublons_ind221(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid221 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind221_cursor CURSOR FOR
		select id_221, ID_CYCLTRAV from ind_221
		where id_bilasocicons = idBilaSociCons
		order by ID_CYCLTRAV, id_221 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_221_delete;
	CREATE TEMPORARY TABLE temp_ind_221_delete (
		id221 int
	);

	SET vkeyPrevious = -1;

	OPEN ind221_cursor;
    ind_loop: LOOP

		FETCH ind221_cursor INTO vid221, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_221_delete (id221)
			VALUES (vid221);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind221_cursor;

	DELETE FROM ind_221
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_221_delete t WHERE t.id221 = ind_221.id_221);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind221()
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
            (select id_bilasocicons, ID_CYCLTRAV, count(*)
            from ind_221
            group by id_bilasocicons, ID_CYCLTRAV
            having count(*)>1
            order by id_bilasocicons, ID_CYCLTRAV) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind221(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
