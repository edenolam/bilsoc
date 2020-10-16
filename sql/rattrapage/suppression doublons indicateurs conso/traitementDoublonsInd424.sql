DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind424
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind424
$$

CREATE PROCEDURE traitementDoublons_ind424(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

        DECLARE vfirst INT;
	DECLARE vkey INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind424_cursor CURSOR FOR
		select id_424 from ind_424
		where id_bilasocicons = idBilaSociCons
		order by id_424 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_424_delete;
	CREATE TEMPORARY TABLE temp_ind_424_delete (
		id424 int
	);

	SET vfirst = 1;

	OPEN ind424_cursor;
    ind_loop: LOOP

		FETCH ind424_cursor INTO vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vfirst != 1 THEN

			INSERT INTO temp_ind_424_delete (id424)
			VALUES (vkey);

		END IF;

		SET vfirst = 0;

    END LOOP;

    CLOSE ind424_cursor;

	DELETE FROM ind_424
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_424_delete t WHERE t.id424 = ind_424.id_424);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind424()
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
            (select id_bilasocicons,  count(*)
            from ind_424
            group by id_bilasocicons
            having count(*)>1
            order by id_bilasocicons) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind424(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
