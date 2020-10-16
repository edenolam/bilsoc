DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind124
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind124
$$

CREATE PROCEDURE traitementDoublons_ind124(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid124 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind124_cursor CURSOR FOR
		select id_124, id_fili from ind_124
		where id_bilasocicons = idBilaSociCons
		order by id_fili, id_124 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_124_delete;
	CREATE TEMPORARY TABLE temp_ind_124_delete (
		id124 int
	);

	SET vkeyPrevious = -1;

	OPEN ind124_cursor;
    ind_loop: LOOP

		FETCH ind124_cursor INTO vid124, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_124_delete (id124)
			VALUES (vid124);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind124_cursor;

	DELETE FROM ind_124
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_124_delete t WHERE t.id124 = ind_124.id_124);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind124()
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
            from ind_124
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

        call traitementDoublons_ind124(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$

