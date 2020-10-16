DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2233
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind2233
$$

CREATE PROCEDURE traitementDoublons_ind2233(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2233 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2233_cursor CURSOR FOR
		select id_2233, ID_CATE from ind_2233
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_2233 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2233_delete;
	CREATE TEMPORARY TABLE temp_ind_2233_delete (
		id2233 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2233_cursor;
    ind_loop: LOOP

		FETCH ind2233_cursor INTO vid2233, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2233_delete (id2233)
			VALUES (vid2233);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2233_cursor;

	DELETE FROM ind_2233
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2233_delete t WHERE t.id2233 = ind_2233.id_2233);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2233()
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
            from ind_2233
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

        call traitementDoublons_ind2233(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
