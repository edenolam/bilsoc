DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind2111
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind2111
$$

CREATE PROCEDURE traitementDoublons_ind2111(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid2111 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind2111_cursor CURSOR FOR
		select id_2111, id_motiabse from ind_211_1
		where id_bilasocicons = idBilaSociCons
		order by id_motiabse, id_2111 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_2111_delete;
	CREATE TEMPORARY TABLE temp_ind_2111_delete (
		id2111 int
	);

	SET vkeyPrevious = -1;

	OPEN ind2111_cursor;
    ind_loop: LOOP

		FETCH ind2111_cursor INTO vid2111, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_2111_delete (id2111)
			VALUES (vid2111);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind2111_cursor;

	DELETE FROM ind_211_1
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_2111_delete t WHERE t.id2111 = ind_211_1.id_2111);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind2111()
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
            from ind_211_1
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

        call traitementDoublons_ind2111(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
