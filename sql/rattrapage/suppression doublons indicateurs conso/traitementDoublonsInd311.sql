DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind311
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind311
$$

CREATE PROCEDURE traitementDoublons_ind311(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid311 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind311_cursor CURSOR FOR
		select id_311, ID_CATE from ind_311
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_311 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_311_delete;
	CREATE TEMPORARY TABLE temp_ind_311_delete (
		id311 int
	);

	SET vkeyPrevious = -1;

	OPEN ind311_cursor;
    ind_loop: LOOP

		FETCH ind311_cursor INTO vid311, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_311_delete (id311)
			VALUES (vid311);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind311_cursor;

	DELETE FROM ind_311
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_311_delete t WHERE t.id311 = ind_311.id_311);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind311()
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
            from ind_311
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

        call traitementDoublons_ind311(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
