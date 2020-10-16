DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind132
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind132
$$

CREATE PROCEDURE traitementDoublons_ind132(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

        DECLARE vfirst INT;
	DECLARE vkey INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind132_cursor CURSOR FOR
		select id_132 from ind_132
		where id_bilasocicons = idBilaSociCons
		order by id_132 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_132_delete;
	CREATE TEMPORARY TABLE temp_ind_132_delete (
		id132 int
	);

	SET vfirst = 1;

	OPEN ind132_cursor;
    ind_loop: LOOP

		FETCH ind132_cursor INTO vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vfirst != 1 THEN

			INSERT INTO temp_ind_132_delete (id132)
			VALUES (vkey);

		END IF;

		SET vfirst = 0;

    END LOOP;

    CLOSE ind132_cursor;

	DELETE FROM ind_132
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_132_delete t WHERE t.id132 = ind_132.id_132);

END
$$

CREATE PROCEDURE traitementAllDoublons_ind132()
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
            from ind_132
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

        call traitementDoublons_ind132(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
