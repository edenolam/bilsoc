DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind161
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind161
$$

CREATE PROCEDURE traitementDoublons_ind161(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid161 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind161_cursor CURSOR FOR
		select id_161, ID_CATE from ind_161
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_161 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_161_delete;
	CREATE TEMPORARY TABLE temp_ind_161_delete (
		id161 int
	);

	SET vkeyPrevious = -1;

	OPEN ind161_cursor;
    ind_loop: LOOP

		FETCH ind161_cursor INTO vid161, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_161_delete (id161)
			VALUES (vid161);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind161_cursor;

	DELETE FROM ind_161
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_161_delete t WHERE t.id161 = ind_161.id_161);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind161()
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
            from ind_161
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

        call traitementDoublons_ind161(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
