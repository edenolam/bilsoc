DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind155
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind155
$$

CREATE PROCEDURE traitementDoublons_ind155(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid155 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind155_cursor CURSOR FOR
		select id_155, ID_AVANPROMCONC from ind_155
		where id_bilasocicons = idBilaSociCons
		order by ID_AVANPROMCONC, id_155 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_155_delete;
	CREATE TEMPORARY TABLE temp_ind_155_delete (
		id155 int
	);

	SET vkeyPrevious = -1;

	OPEN ind155_cursor;
    ind_loop: LOOP

		FETCH ind155_cursor INTO vid155, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_155_delete (id155)
			VALUES (vid155);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind155_cursor;

	DELETE FROM ind_155
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_155_delete t WHERE t.id155 = ind_155.id_155);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind155()
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
            (select id_bilasocicons, ID_AVANPROMCONC, count(*)
            from ind_155
            group by id_bilasocicons, ID_AVANPROMCONC
            having count(*)>1
            order by id_bilasocicons, ID_AVANPROMCONC) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind155(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
