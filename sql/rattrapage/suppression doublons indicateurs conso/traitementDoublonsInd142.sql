DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind142
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind142
$$

CREATE PROCEDURE traitementDoublons_ind142(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid142 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind142_cursor CURSOR FOR
		select id_142, id_posistat from ind_142
		where id_bilasocicons = idBilaSociCons
		order by id_posistat, id_142 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_142_delete;
	CREATE TEMPORARY TABLE temp_ind_142_delete (
		id142 int
	);

	SET vkeyPrevious = -1;

	OPEN ind142_cursor;
    ind_loop: LOOP

		FETCH ind142_cursor INTO vid142, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_142_delete (id142)
			VALUES (vid142);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind142_cursor;

	DELETE FROM ind_142
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_142_delete t WHERE t.id142 = ind_142.id_142);

END
$$




CREATE PROCEDURE traitementAllDoublons_ind142()
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
            from ind_142
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

        call traitementDoublons_ind142(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
