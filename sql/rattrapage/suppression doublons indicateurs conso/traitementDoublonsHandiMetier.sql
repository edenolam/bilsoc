DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublonsHandiMetier
$$

DROP PROCEDURE IF EXISTS traitementDoublonsHandiMetier
$$

CREATE PROCEDURE traitementDoublonsHandiMetier(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE hand_cursor CURSOR FOR
		select BSC_HANDITORIAL_METIERS, id_metier from bsc_handitorial_metiers
		where id_bilasocicons = idBilaSociCons
		order by id_metier, BSC_HANDITORIAL_METIERS desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_handi_delete;
	CREATE TEMPORARY TABLE temp_handi_delete (
		id int
	);

	SET vkeyPrevious = -1;

	OPEN hand_cursor;
    ind_loop: LOOP

		FETCH hand_cursor INTO vid, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_handi_delete (id)
			VALUES (vid);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE hand_cursor;

	DELETE FROM bsc_handitorial_metiers
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_handi_delete t WHERE t.id = bsc_handitorial_metiers.BSC_HANDITORIAL_METIERS);

END
$$


CREATE PROCEDURE traitementAllDoublonsHandiMetier()
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
            (select id_bilasocicons, ID_METIER, count(*)
            from bsc_handitorial_metiers
            group by id_bilasocicons, ID_METIER
            having count(*)>1
            order by id_bilasocicons, ID_METIER) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublonsHandiMetier(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
