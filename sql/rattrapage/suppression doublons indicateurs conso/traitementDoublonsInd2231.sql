DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2231
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind2231
$$

CREATE PROCEDURE traitementDoublons_ind2231(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2231 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2231_cursor CURSOR FOR
		select id_2231, ID_CATE from ind_2231
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_2231 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2231_delete;
	CREATE TEMPORARY TABLE temp_ind_2231_delete (
		id2231 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2231_cursor;
    ind_loop: LOOP

		FETCH ind2231_cursor INTO vid2231, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2231_delete (id2231)
			VALUES (vid2231);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2231_cursor;

	DELETE FROM ind_2231
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2231_delete t WHERE t.id2231 = ind_2231.id_2231);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2231()
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
            from ind_2231
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

        call traitementDoublons_ind2231(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
