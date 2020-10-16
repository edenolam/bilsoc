DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2113
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind2113
$$

CREATE PROCEDURE traitementDoublons_ind2113(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2113 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2113_cursor CURSOR FOR
		select id_2113, id_motiabse from ind_211_3
		where id_bilasocicons = idBilaSociCons
		order by id_motiabse, id_2113 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2113_delete;
	CREATE TEMPORARY TABLE temp_ind_2113_delete (
		id2113 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2113_cursor;
    ind_loop: LOOP

		FETCH ind2113_cursor INTO vid2113, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2113_delete (id2113)
			VALUES (vid2113);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2113_cursor;

	DELETE FROM ind_211_3
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2113_delete t WHERE t.id2113 = ind_211_3.id_2113);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2113()
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
            from ind_211_3
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

        call traitementDoublons_ind2113(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
