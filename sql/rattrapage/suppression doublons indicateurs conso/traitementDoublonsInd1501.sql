DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind1501
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind1501
$$

CREATE PROCEDURE traitementDoublons_ind1501(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid1501 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind1501_cursor CURSOR FOR
		select id_1501, id_motidepa from ind_150_1
		where id_bilasocicons = idBilaSociCons
		order by id_motidepa, id_1501 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_1501_delete;
	CREATE TEMPORARY TABLE temp_ind_1501_delete (
		id1501 int
	);

	SET vkeyPrevious = -1;

	OPEN ind1501_cursor;
    ind_loop: LOOP

		FETCH ind1501_cursor INTO vid1501, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_1501_delete (id1501)
			VALUES (vid1501);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind1501_cursor;

	DELETE FROM ind_150_1
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_1501_delete t WHERE t.id1501 = ind_150_1.id_1501);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind1501()
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
            (select id_bilasocicons, ID_MOTIDEPA, count(*)
            from ind_150_1
            group by id_bilasocicons, ID_MOTIDEPA
            having count(*)>1
            order by id_bilasocicons, ID_MOTIDEPA) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind1501(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
