DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind152
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind152
$$

CREATE PROCEDURE traitementDoublons_ind152(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid152 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind152_cursor CURSOR FOR
		select id_152, id_cadrempl from ind_152
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_152 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_152_delete;
	CREATE TEMPORARY TABLE temp_ind_152_delete (
		id152 int
	);

	SET vkeyPrevious = -1;

	OPEN ind152_cursor;
    ind_loop: LOOP

		FETCH ind152_cursor INTO vid152, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_152_delete (id152)
			VALUES (vid152);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind152_cursor;

	DELETE FROM ind_152
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_152_delete t WHERE t.id152 = ind_152.id_152);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind152()
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
            from ind_152
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

        call traitementDoublons_ind152(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
