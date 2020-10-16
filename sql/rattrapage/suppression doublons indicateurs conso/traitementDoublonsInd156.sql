DELIMITER $$


DROP PROCEDURE IF EXISTS traitementAllDoublons_ind156
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind156
$$

CREATE PROCEDURE traitementDoublons_ind156(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid156 INT;
	DECLARE vkey INT;
	DECLARE vkeyPrevious INT;
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind156_cursor CURSOR FOR
		select id_156, ID_CATE from ind_156
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, id_156 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_156_delete;
	CREATE TEMPORARY TABLE temp_ind_156_delete (
		id156 int
	);

	SET vkeyPrevious = -1;

	OPEN ind156_cursor;
    ind_loop: LOOP

		FETCH ind156_cursor INTO vid156, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_156_delete (id156)
			VALUES (vid156);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind156_cursor;

	DELETE FROM ind_156
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_156_delete t WHERE t.id156 = ind_156.id_156);

END
$$



CREATE PROCEDURE traitementAllDoublons_ind156()
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
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_156
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind156(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
