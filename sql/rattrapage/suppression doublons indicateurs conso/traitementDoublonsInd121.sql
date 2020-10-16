DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind121
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind121
$$

CREATE PROCEDURE traitementDoublons_ind121(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid121 INT;
	DECLARE vidCadrempl INT;
	DECLARE vidCadremplPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind121_cursor CURSOR FOR
		select id_121, id_cadrempl from ind_121
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_121 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_121_delete;
	CREATE TEMPORARY TABLE temp_ind_121_delete (
		id121 int,
		id_cadrempl int
	);

	SET vidCadremplPrevious = -1;

	OPEN ind121_cursor;
    ind_loop: LOOP

		FETCH ind121_cursor INTO vid121, vidCadrempl;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vidCadremplPrevious = vidCadrempl THEN

			INSERT INTO temp_ind_121_delete (id121, id_cadrempl)
			VALUES (vid121, vidCadrempl);

		END IF;

		SET vidCadremplPrevious = vidCadrempl;

    END LOOP;

    CLOSE ind121_cursor;

	DELETE FROM ind_121
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_121_delete t WHERE t.id121 = ind_121.id_121);

END
$$

CREATE PROCEDURE traitementAllDoublons_ind121()
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
            (select id_bilasocicons, id_cadrempl, count(*)
            from ind_121
            group by id_bilasocicons, id_cadrempl
            having count(*)>1
            order by id_bilasocicons, id_cadrempl) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind121(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
