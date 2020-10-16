DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind7141
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind7141
$$

CREATE PROCEDURE traitementDoublons_ind7141(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid7141 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind7141_cursor CURSOR FOR
		select id_7141, ID_CATE from ind_7141
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_7141 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_7141_delete;
	CREATE TEMPORARY TABLE temp_ind_7141_delete (
		id7141 int
	);

	SET vkeyPrevious = -1;

	OPEN ind7141_cursor;
    ind_loop: LOOP

		FETCH ind7141_cursor INTO vid7141, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_7141_delete (id7141)
			VALUES (vid7141);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind7141_cursor;

	DELETE FROM ind_7141
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_7141_delete t WHERE t.id7141 = ind_7141.id_7141);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind7141()
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
            from ind_7141
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

        call traitementDoublons_ind7141(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$

