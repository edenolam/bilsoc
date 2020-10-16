DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind1513
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind1513
$$

CREATE PROCEDURE traitementDoublons_ind1513(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid1513 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind1513_cursor CURSOR FOR
		select id_1513, id_emplfonc from ind_151_3
		where id_bilasocicons = idBilaSociCons
		order by id_emplfonc, id_1513 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_1513_delete;
	CREATE TEMPORARY TABLE temp_ind_1513_delete (
		id1513 int
	);

	SET vkeyPrevious = -1;

	OPEN ind1513_cursor;
    ind_loop: LOOP

		FETCH ind1513_cursor INTO vid1513, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_1513_delete (id1513)
			VALUES (vid1513);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind1513_cursor;

	DELETE FROM ind_151_3
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_1513_delete t WHERE t.id1513 = ind_151_3.id_1513);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind1513()
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
            (select id_bilasocicons, ID_EMPLFONC, count(*)
            from ind_151_3
            group by id_bilasocicons, ID_EMPLFONC
            having count(*)>1
            order by id_bilasocicons, ID_EMPLFONC) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind1513(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
