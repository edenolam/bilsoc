DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind1512
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind1512
$$

CREATE PROCEDURE traitementDoublons_ind1512(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid1512 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind1512_cursor CURSOR FOR
		select id_1512, id_emplfonc from ind_151_2
		where id_bilasocicons = idBilaSociCons
		order by id_emplfonc, id_1512 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_1512_delete;
	CREATE TEMPORARY TABLE temp_ind_1512_delete (
		id1512 int
	);

	SET vkeyPrevious = -1;

	OPEN ind1512_cursor;
    ind_loop: LOOP

		FETCH ind1512_cursor INTO vid1512, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_1512_delete (id1512)
			VALUES (vid1512);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind1512_cursor;

	DELETE FROM ind_151_2
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_1512_delete t WHERE t.id1512 = ind_151_2.id_1512);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind1512()
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
            from ind_151_2
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

        call traitementDoublons_ind1512(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
