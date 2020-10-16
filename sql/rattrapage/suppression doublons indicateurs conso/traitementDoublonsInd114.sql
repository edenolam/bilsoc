DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind114
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind114
$$

CREATE PROCEDURE traitementDoublons_ind114(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid114 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind114_cursor CURSOR FOR
		select id_114, id_fili from ind_114
		where id_bilasocicons = idBilaSociCons
		order by id_fili, id_114 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_114_delete;
	CREATE TEMPORARY TABLE temp_ind_114_delete (
		id114 int
	);

	SET vkeyPrevious = -1;

	OPEN ind114_cursor;
    ind_loop: LOOP

		FETCH ind114_cursor INTO vid114, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_114_delete (id114)
			VALUES (vid114);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind114_cursor;

	DELETE FROM ind_114
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_114_delete t WHERE t.id114 = ind_114.id_114);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind114()
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
            from ind_114
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

        call traitementDoublons_ind114(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
