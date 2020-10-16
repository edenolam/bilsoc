DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind144
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind144
$$

CREATE PROCEDURE traitementDoublons_ind144(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid144 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind144_cursor CURSOR FOR
		select id_144, id_posistat from ind_144
		where id_bilasocicons = idBilaSociCons
		order by id_posistat, id_144 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_144_delete;
	CREATE TEMPORARY TABLE temp_ind_144_delete (
		id144 int
	);

	SET vkeyPrevious = -1;

	OPEN ind144_cursor;
    ind_loop: LOOP

		FETCH ind144_cursor INTO vid144, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_144_delete (id144)
			VALUES (vid144);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind144_cursor;

	DELETE FROM ind_144
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_144_delete t WHERE t.id144 = ind_144.id_144);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind144()
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
            (select id_bilasocicons, ID_POSISTAT, count(*)
            from ind_144
            group by id_bilasocicons, ID_POSISTAT
            having count(*)>1
            order by id_bilasocicons, ID_POSISTAT) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind144(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
