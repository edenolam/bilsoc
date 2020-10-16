DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2123
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind2123
$$

CREATE PROCEDURE traitementDoublons_ind2123(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2123 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2123_cursor CURSOR FOR
		select id_2123, id_motiabse from ind_212_3
		where id_bilasocicons = idBilaSociCons
		order by id_motiabse, id_2123 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2123_delete;
	CREATE TEMPORARY TABLE temp_ind_2123_delete (
		id2123 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2123_cursor;
    ind_loop: LOOP

		FETCH ind2123_cursor INTO vid2123, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2123_delete (id2123)
			VALUES (vid2123);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2123_cursor;

	DELETE FROM ind_212_3
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2123_delete t WHERE t.id2123 = ind_212_3.id_2123);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2123()
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
            from ind_212_3
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

        call traitementDoublons_ind2123(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
