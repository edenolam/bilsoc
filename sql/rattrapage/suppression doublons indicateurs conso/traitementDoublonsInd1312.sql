DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind1312
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind1312
$$

CREATE PROCEDURE traitementDoublons_ind1312(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid1312 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind1312_cursor CURSOR FOR
		select id_1312, ID_EMPLNONPERM from ind_1312
		where id_bilasocicons = idBilaSociCons
		order by ID_EMPLNONPERM, id_1312 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_1312_delete;
	CREATE TEMPORARY TABLE temp_ind_1312_delete (
		id1312 int
	);

	SET vkeyPrevious = -1;

	OPEN ind1312_cursor;
    ind_loop: LOOP

		FETCH ind1312_cursor INTO vid1312, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_1312_delete (id1312)
			VALUES (vid1312);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind1312_cursor;

	DELETE FROM ind_1312
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_1312_delete t WHERE t.id1312 = ind_1312.id_1312);

END
$$

CREATE PROCEDURE traitementAllDoublons_ind1312()
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
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_1312
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind1312(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
