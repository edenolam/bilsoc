DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2122
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind2122
$$

CREATE PROCEDURE traitementDoublons_ind2122(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2122 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2122_cursor CURSOR FOR
		select id_2122, id_motiabse from ind_212_2
		where id_bilasocicons = idBilaSociCons
		order by id_motiabse, id_2122 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2122_delete;
	CREATE TEMPORARY TABLE temp_ind_2122_delete (
		id2122 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2122_cursor;
    ind_loop: LOOP

		FETCH ind2122_cursor INTO vid2122, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2122_delete (id2122)
			VALUES (vid2122);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2122_cursor;

	DELETE FROM ind_212_2
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2122_delete t WHERE t.id2122 = ind_212_2.id_2122);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2122()
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
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_212_2
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind2122(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
