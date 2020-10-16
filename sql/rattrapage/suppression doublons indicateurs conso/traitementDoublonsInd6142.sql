DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind6142
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind6142
$$

CREATE PROCEDURE traitementDoublons_ind6142(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid6142 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind6142_cursor CURSOR FOR
		select id_6142, ID_MOTI_SANC_DISC from ind_6142
		where id_bilasocicons = idBilaSociCons
		order by ID_MOTI_SANC_DISC, id_6142 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_6142_delete;
	CREATE TEMPORARY TABLE temp_ind_6142_delete (
		id6142 int
	);

	SET vkeyPrevious = -1;

	OPEN ind6142_cursor;
    ind_loop: LOOP

		FETCH ind6142_cursor INTO vid6142, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_6142_delete (id6142)
			VALUES (vid6142);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind6142_cursor;

	DELETE FROM ind_6142
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_6142_delete t WHERE t.id6142 = ind_6142.id_6142);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind6142()
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
            (select id_bilasocicons, ID_MOTI_SANC_DISC, count(*)
            from ind_6142
            group by id_bilasocicons, ID_MOTI_SANC_DISC
            having count(*)>1
            order by id_bilasocicons, ID_MOTI_SANC_DISC) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind6142(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
