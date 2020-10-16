DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind141
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind141
$$

CREATE PROCEDURE traitementDoublons_ind141(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid141 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind141_cursor CURSOR FOR
		select id_141, id_posistat from ind_141
		where id_bilasocicons = idBilaSociCons
		order by id_posistat, id_141 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_141_delete;
	CREATE TEMPORARY TABLE temp_ind_141_delete (
		id141 int
	);

	SET vkeyPrevious = -1;

	OPEN ind141_cursor;
    ind_loop: LOOP

		FETCH ind141_cursor INTO vid141, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_141_delete (id141)
			VALUES (vid141);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind141_cursor;

	DELETE FROM ind_141
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_141_delete t WHERE t.id141 = ind_141.id_141);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind141()
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
            from ind_141
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

        call traitementDoublons_ind141(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
