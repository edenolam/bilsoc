DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind158
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind158
$$

CREATE PROCEDURE traitementDoublons_ind158(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid158 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind158_cursor CURSOR FOR
		select id_158, ID_FILI from ind_158
		where id_bilasocicons = idBilaSociCons
		order by ID_FILI, id_158 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_158_delete;
	CREATE TEMPORARY TABLE temp_ind_158_delete (
		id158 int
	);

	SET vkeyPrevious = -1;

	OPEN ind158_cursor;
    ind_loop: LOOP

		FETCH ind158_cursor INTO vid158, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_158_delete (id158)
			VALUES (vid158);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind158_cursor;

	DELETE FROM ind_158
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_158_delete t WHERE t.id158 = ind_158.id_158);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind158()
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
            (select id_bilasocicons, ID_FILI, count(*)
            from ind_158
            group by id_bilasocicons, ID_FILI
            having count(*)>1
            order by id_bilasocicons, ID_FILI) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind158(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
