DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind231
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind231
$$

CREATE PROCEDURE traitementDoublons_ind231(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid231 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind231_cursor CURSOR FOR
		select id_231, ordre from ind_231
		where id_bilasocicons = idBilaSociCons
		order by ordre, id_231 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_231_delete;
	CREATE TEMPORARY TABLE temp_ind_231_delete (
		id231 int
	);

	SET vkeyPrevious = -1;

	OPEN ind231_cursor;
    ind_loop: LOOP

		FETCH ind231_cursor INTO vid231, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_231_delete (id231)
			VALUES (vid231);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind231_cursor;

	DELETE FROM ind_231
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_231_delete t WHERE t.id231 = ind_231.id_231);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind231()
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
            (select id_bilasocicons, CD_DEMA, count(*)
            from ind_231
            group by id_bilasocicons, CD_DEMA
            having count(*)>1
            order by id_bilasocicons, CD_DEMA) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind231(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
