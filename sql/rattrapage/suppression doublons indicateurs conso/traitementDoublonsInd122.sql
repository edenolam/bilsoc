DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind122
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind122
$$

CREATE PROCEDURE traitementDoublons_ind122(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid122 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind122_cursor CURSOR FOR
		select id_122, id_cadrempl from ind_122
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_122 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_122_delete;
	CREATE TEMPORARY TABLE temp_ind_122_delete (
		id122 int
	);

	SET vkeyPrevious = -1;

	OPEN ind122_cursor;
    ind_loop: LOOP

		FETCH ind122_cursor INTO vid122, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_122_delete (id122)
			VALUES (vid122);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind122_cursor;

	DELETE FROM ind_122
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_122_delete t WHERE t.id122 = ind_122.id_122);

END
$$

CREATE PROCEDURE traitementAllDoublons_ind122()
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
            (select id_bilasocicons, id_cadrempl, count(*)
            from ind_122
            group by id_bilasocicons, id_cadrempl
            having count(*)>1
            order by id_bilasocicons, id_cadrempl) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind122(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
