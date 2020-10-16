DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind5122
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind5122
$$

CREATE PROCEDURE traitementDoublons_ind5122(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid5122 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind5122_cursor CURSOR FOR
		select id_5122, ID_EMPLNONPERM from ind_5122
		where id_bilasocicons = idBilaSociCons
		order by ID_EMPLNONPERM, id_5122 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_5122_delete;
	CREATE TEMPORARY TABLE temp_ind_5122_delete (
		id5122 int
	);

	SET vkeyPrevious = -1;

	OPEN ind5122_cursor;
    ind_loop: LOOP

		FETCH ind5122_cursor INTO vid5122, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_5122_delete (id5122)
			VALUES (vid5122);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind5122_cursor;

	DELETE FROM ind_5122
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_5122_delete t WHERE t.id5122 = ind_5122.id_5122);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind5122()
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
            from ind_5122
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

        call traitementDoublons_ind5122(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
