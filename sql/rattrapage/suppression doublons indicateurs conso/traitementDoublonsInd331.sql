DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind331
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind331
$$

CREATE PROCEDURE traitementDoublons_ind331(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid331 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind331_cursor CURSOR FOR
		select id_331, ID_EMPLNONPERM from ind_331
		where id_bilasocicons = idBilaSociCons
		order by ID_EMPLNONPERM, id_331 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_331_delete;
	CREATE TEMPORARY TABLE temp_ind_331_delete (
		id331 int
	);

	SET vkeyPrevious = -1;

	OPEN ind331_cursor;
    ind_loop: LOOP

		FETCH ind331_cursor INTO vid331, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_331_delete (id331)
			VALUES (vid331);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind331_cursor;

	DELETE FROM ind_331
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_331_delete t WHERE t.id331 = ind_331.id_331);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind331()
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
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_331
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind331(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
