DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind6141
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind6141
$$

CREATE PROCEDURE traitementDoublons_ind6141(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid6141 INT;
	DECLARE vkey varchar(50);
	DECLARE vkeyPrevious varchar(50);
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind6141_cursor CURSOR FOR
		select id_6141, concat(FG_GROUPE, '-', IFNULL(ID_SANC_DISC,0)) from ind_6141
		where id_bilasocicons = idBilaSociCons
		order by FG_GROUPE, ID_SANC_DISC , id_6141 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_6141_delete;
	CREATE TEMPORARY TABLE temp_ind_6141_delete (
		id6141 int
	);

	SET vkeyPrevious = '-';

	OPEN ind6141_cursor;
    ind_loop: LOOP

		FETCH ind6141_cursor INTO vid6141, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_6141_delete (id6141)
			VALUES (vid6141);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind6141_cursor;

	DELETE FROM ind_6141
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_6141_delete t WHERE t.id6141 = ind_6141.id_6141);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind6141()
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
            (select id_bilasocicons, FG_GROUPE, IFNULL(ID_SANC_DISC,0), count(*)
            from ind_6141
            group by id_bilasocicons, FG_GROUPE, ID_SANC_DISC
            having count(*)>1
            order by id_bilasocicons, FG_GROUPE, ID_SANC_DISC) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind6141(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
