DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind321
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind321
$$

CREATE PROCEDURE traitementDoublons_ind321(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid321 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind321_cursor CURSOR FOR
		select id_321, ID_CATE from ind_321
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_321 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_321_delete;
	CREATE TEMPORARY TABLE temp_ind_321_delete (
		id321 int
	);

	SET vkeyPrevious = -1;

	OPEN ind321_cursor;
    ind_loop: LOOP

		FETCH ind321_cursor INTO vid321, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_321_delete (id321)
			VALUES (vid321);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind321_cursor;

	DELETE FROM ind_321
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_321_delete t WHERE t.id321 = ind_321.id_321);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind321()
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
            from ind_321
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

        call traitementDoublons_ind321(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
