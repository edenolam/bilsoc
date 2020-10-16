DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind7142
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind7142
$$

CREATE PROCEDURE traitementDoublons_ind7142(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid7142 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind7142_cursor CURSOR FOR
		select id_7142, ID_CATE from ind_7142
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_7142 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_7142_delete;
	CREATE TEMPORARY TABLE temp_ind_7142_delete (
		id7142 int
	);

	SET vkeyPrevious = -1;

	OPEN ind7142_cursor;
    ind_loop: LOOP

		FETCH ind7142_cursor INTO vid7142, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_7142_delete (id7142)
			VALUES (vid7142);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind7142_cursor;

	DELETE FROM ind_7142
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_7142_delete t WHERE t.id7142 = ind_7142.id_7142);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind7142()
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
            from ind_7142
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

        call traitementDoublons_ind7142(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$

