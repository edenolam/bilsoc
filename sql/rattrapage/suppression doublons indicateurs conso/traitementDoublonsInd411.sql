DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind411
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind411
$$

CREATE PROCEDURE traitementDoublons_ind411(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid411 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind411_cursor CURSOR FOR
		select id_411, ID_TYPEMISSPREV from ind_411
		where id_bilasocicons = idBilaSociCons
		order by ID_TYPEMISSPREV, id_411 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_411_delete;
	CREATE TEMPORARY TABLE temp_ind_411_delete (
		id411 int
	);

	SET vkeyPrevious = -1;

	OPEN ind411_cursor;
    ind_loop: LOOP

		FETCH ind411_cursor INTO vid411, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_411_delete (id411)
			VALUES (vid411);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind411_cursor;

	DELETE FROM ind_411
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_411_delete t WHERE t.id411 = ind_411.id_411);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind411()
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
            (select id_bilasocicons, ID_TYPEMISSPREV, count(*)
            from ind_411
            group by id_bilasocicons, ID_TYPEMISSPREV
            having count(*)>1
            order by id_bilasocicons, ID_TYPEMISSPREV) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind411(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
