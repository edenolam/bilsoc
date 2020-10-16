DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2232
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind2232
$$

CREATE PROCEDURE traitementDoublons_ind2232(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2232 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2232_cursor CURSOR FOR
		select id_2232, ID_CATE from ind_2232
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_2232 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2232_delete;
	CREATE TEMPORARY TABLE temp_ind_2232_delete (
		id2232 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2232_cursor;
    ind_loop: LOOP

		FETCH ind2232_cursor INTO vid2232, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2232_delete (id2232)
			VALUES (vid2232);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2232_cursor;

	DELETE FROM ind_2232
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2232_delete t WHERE t.id2232 = ind_2232.id_2232);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2232()
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
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_2232
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind2232(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
