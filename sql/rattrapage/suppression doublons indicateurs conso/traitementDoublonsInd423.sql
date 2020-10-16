DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind423
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind423
$$

CREATE PROCEDURE traitementDoublons_ind423(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid423 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind423_cursor CURSOR FOR
		select id_423, ID_INAP from ind_423
		where id_bilasocicons = idBilaSociCons
		order by ID_INAP, id_423 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_423_delete;
	CREATE TEMPORARY TABLE temp_ind_423_delete (
		id423 int
	);

	SET vkeyPrevious = -1;

	OPEN ind423_cursor;
    ind_loop: LOOP

		FETCH ind423_cursor INTO vid423, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_423_delete (id423)
			VALUES (vid423);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind423_cursor;

	DELETE FROM ind_423
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_423_delete t WHERE t.id423 = ind_423.id_423);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind423()
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
            (select id_bilasocicons, ID_INAP, count(*)
            from ind_423
            group by id_bilasocicons, ID_INAP
            having count(*)>1
            order by id_bilasocicons, ID_INAP) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind423(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
