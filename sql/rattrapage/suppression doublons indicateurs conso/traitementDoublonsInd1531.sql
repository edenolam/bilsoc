DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind1531
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind1531
$$

CREATE PROCEDURE traitementDoublons_ind1531(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid1531 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind1531_cursor CURSOR FOR
		select id_1531, id_motiarri from ind_153_1
		where id_bilasocicons = idBilaSociCons
		order by id_motiarri, id_1531 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_1531_delete;
	CREATE TEMPORARY TABLE temp_ind_1531_delete (
		id1531 int
	);

	SET vkeyPrevious = -1;

	OPEN ind1531_cursor;
    ind_loop: LOOP

		FETCH ind1531_cursor INTO vid1531, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_1531_delete (id1531)
			VALUES (vid1531);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind1531_cursor;

	DELETE FROM ind_153_1
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_1531_delete t WHERE t.id1531 = ind_153_1.id_1531);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind1531()
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
            (select id_bilasocicons, ID_MOTIARRI, count(*)
            from ind_153_1
            group by id_bilasocicons, ID_MOTIARRI
            having count(*)>1
            order by id_bilasocicons, ID_MOTIARRI) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind1531(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
