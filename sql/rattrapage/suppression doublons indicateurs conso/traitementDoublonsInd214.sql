DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind214
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind214
$$

CREATE PROCEDURE traitementDoublons_ind214(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid214 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind214_cursor CURSOR FOR
		select id_214, ID_CATE from ind_214
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_214 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_214_delete;
	CREATE TEMPORARY TABLE temp_ind_214_delete (
		id214 int
	);

	SET vkeyPrevious = -1;

	OPEN ind214_cursor;
    ind_loop: LOOP

		FETCH ind214_cursor INTO vid214, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_214_delete (id214)
			VALUES (vid214);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind214_cursor;

	DELETE FROM ind_214
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_214_delete t WHERE t.id214 = ind_214.id_214);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind214()
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
            from ind_214
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

        call traitementDoublons_ind214(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
