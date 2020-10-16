DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind5111
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind5111
$$

CREATE PROCEDURE traitementDoublons_ind5111(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid5111 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind5111_cursor CURSOR FOR
		select id_5111, ID_CATE from ind_5111
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_5111 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_5111_delete;
	CREATE TEMPORARY TABLE temp_ind_5111_delete (
		id5111 int
	);

	SET vkeyPrevious = -1;

	OPEN ind5111_cursor;
    ind_loop: LOOP

		FETCH ind5111_cursor INTO vid5111, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_5111_delete (id5111)
			VALUES (vid5111);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind5111_cursor;

	DELETE FROM ind_5111
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_5111_delete t WHERE t.id5111 = ind_5111.id_5111);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind5111()
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
            (select id_bilasocicons, ID_CATE,  count(*)
            from ind_5111
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

        call traitementDoublons_ind5111(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
