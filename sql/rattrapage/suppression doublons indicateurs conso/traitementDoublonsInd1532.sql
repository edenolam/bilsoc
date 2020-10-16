DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind1532
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind1532
$$

CREATE PROCEDURE traitementDoublons_ind1532(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid1532 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind1532_cursor CURSOR FOR
		select id_1532, id_cadrempl from ind_1532
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_1532 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_1532_delete;
	CREATE TEMPORARY TABLE temp_ind_1532_delete (
		id1532 int
	);

	SET vkeyPrevious = -1;

	OPEN ind1532_cursor;
    ind_loop: LOOP

		FETCH ind1532_cursor INTO vid1532, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_1532_delete (id1532)
			VALUES (vid1532);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind1532_cursor;

	DELETE FROM ind_1532
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_1532_delete t WHERE t.id1532 = ind_1532.id_1532);

END
$$

CREATE PROCEDURE traitementAllDoublons_ind1532()
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
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from ind_1532
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind1532(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
