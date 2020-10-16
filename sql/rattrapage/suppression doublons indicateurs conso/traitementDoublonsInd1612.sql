DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind1612
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind1612
$$

CREATE PROCEDURE traitementDoublons_ind1612(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

        DECLARE vfirst INT;
	DECLARE vkey INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind1612_cursor CURSOR FOR
		select id_1612 from ind_1612
		where id_bilasocicons = idBilaSociCons
		order by id_1612 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_1612_delete;
	CREATE TEMPORARY TABLE temp_ind_1612_delete (
		id1612 int
	);

	SET vfirst = 1;

	OPEN ind1612_cursor;
    ind_loop: LOOP

		FETCH ind1612_cursor INTO vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vfirst != 1 THEN

			INSERT INTO temp_ind_1612_delete (id1612)
			VALUES (vkey);

		END IF;

		SET vfirst = 0;

    END LOOP;

    CLOSE ind1612_cursor;

	DELETE FROM ind_1612
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_1612_delete t WHERE t.id1612 = ind_1612.id_1612);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind1612()
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
            from ind_1612
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

        call traitementDoublons_ind1612(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
