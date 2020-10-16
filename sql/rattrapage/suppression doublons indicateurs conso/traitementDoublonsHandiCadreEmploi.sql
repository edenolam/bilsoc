DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublonsHandiCadreEmploi
$$

DROP PROCEDURE IF EXISTS traitementDoublonsHandiCadreEmploi
$$

CREATE PROCEDURE traitementDoublonsHandiCadreEmploi(idBilaSociCons INT)
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
		select BSC_HANDITORIAL_CADRE_EMPLOIS, id_cadrempl from bsc_handitorial_cadre_emplois
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, BSC_HANDITORIAL_CADRE_EMPLOIS desc;

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

	DELETE FROM bsc_handitorial_cadre_emplois
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_handi_delete t WHERE t.id = bsc_handitorial_cadre_emplois.BSC_HANDITORIAL_CADRE_EMPLOIS);

END
$$


CREATE PROCEDURE traitementAllDoublonsHandiCadreEmploi()
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
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from bsc_handitorial_cadre_emplois
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublonsHandiCadreEmploi(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
