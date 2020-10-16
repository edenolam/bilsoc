DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind224
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind224
$$

CREATE PROCEDURE traitementDoublons_ind224(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

        DECLARE vfirst INT;
	DECLARE vkey INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind224_cursor CURSOR FOR
		select id_224 from ind_224
		where id_bilasocicons = idBilaSociCons
		order by id_224 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_224_delete;
	CREATE TEMPORARY TABLE temp_ind_224_delete (
		id224 int
	);

	SET vfirst = 1;

	OPEN ind224_cursor;
    ind_loop: LOOP

		FETCH ind224_cursor INTO vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vfirst != 1 THEN

			INSERT INTO temp_ind_224_delete (id224)
			VALUES (vkey);

		END IF;

		SET vfirst = 0;

    END LOOP;

    CLOSE ind224_cursor;

	DELETE FROM ind_224
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_224_delete t WHERE t.id224 = ind_224.id_224);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind224()
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
            from ind_224
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

        call traitementDoublons_ind224(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
