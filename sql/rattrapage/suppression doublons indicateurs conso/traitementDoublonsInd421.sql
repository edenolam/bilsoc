DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind421
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind421
$$

CREATE PROCEDURE traitementDoublons_ind421(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid421 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind421_cursor CURSOR FOR
		select id_421, id_cadrempl from ind_421
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_421 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_421_delete;
	CREATE TEMPORARY TABLE temp_ind_421_delete (
		id421 int
	);

	SET vkeyPrevious = -1;

	OPEN ind421_cursor;
    ind_loop: LOOP

		FETCH ind421_cursor INTO vid421, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_421_delete (id421)
			VALUES (vid421);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind421_cursor;

	DELETE FROM ind_421
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_421_delete t WHERE t.id421 = ind_421.id_421);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind421()
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
            from ind_421
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

        call traitementDoublons_ind421(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
