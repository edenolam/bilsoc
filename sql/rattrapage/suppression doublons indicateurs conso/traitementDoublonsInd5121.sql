DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind5121
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind5121
$$

CREATE PROCEDURE traitementDoublons_ind5121(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid5121 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind5121_cursor CURSOR FOR
		select id_5121, ID_EMPLNONPERM from ind_5121
		where id_bilasocicons = idBilaSociCons
		order by ID_EMPLNONPERM, id_5121 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_5121_delete;
	CREATE TEMPORARY TABLE temp_ind_5121_delete (
		id5121 int
	);

	SET vkeyPrevious = -1;

	OPEN ind5121_cursor;
    ind_loop: LOOP

		FETCH ind5121_cursor INTO vid5121, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_5121_delete (id5121)
			VALUES (vid5121);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind5121_cursor;

	DELETE FROM ind_5121
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_5121_delete t WHERE t.id5121 = ind_5121.id_5121);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind5121()
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
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_5121
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind5121(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
