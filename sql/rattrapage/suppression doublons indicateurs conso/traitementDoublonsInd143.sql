DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind143
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind143
$$

CREATE PROCEDURE traitementDoublons_ind143(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid143 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind143_cursor CURSOR FOR
		select id_143, id_posistat from ind_143
		where id_bilasocicons = idBilaSociCons
		order by id_posistat, id_143 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_143_delete;
	CREATE TEMPORARY TABLE temp_ind_143_delete (
		id143 int
	);

	SET vkeyPrevious = -1;

	OPEN ind143_cursor;
    ind_loop: LOOP

		FETCH ind143_cursor INTO vid143, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_143_delete (id143)
			VALUES (vid143);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind143_cursor;

	DELETE FROM ind_143
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_143_delete t WHERE t.id143 = ind_143.id_143);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind143()
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
            (select id_bilasocicons, ID_POSISTAT, count(*)
            from ind_143
            group by id_bilasocicons, ID_POSISTAT
            having count(*)>1
            order by id_bilasocicons, ID_POSISTAT) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind143(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
