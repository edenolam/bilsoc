DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind5113
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind5113
$$

CREATE PROCEDURE traitementDoublons_ind5113(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid5113 INT;
	DECLARE vkey varchar(50);
	DECLARE vkeyPrevious varchar(50);
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind5113_cursor CURSOR FOR
		select id_5113, concat(ID_CATE, '-', ID_FORM) from ind_5113
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, ID_FORM , id_5113 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_5113_delete;
	CREATE TEMPORARY TABLE temp_ind_5113_delete (
		id5113 int
	);

	SET vkeyPrevious = '-';

	OPEN ind5113_cursor;
    ind_loop: LOOP

		FETCH ind5113_cursor INTO vid5113, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_5113_delete (id5113)
			VALUES (vid5113);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind5113_cursor;

	DELETE FROM ind_5113
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_5113_delete t WHERE t.id5113 = ind_5113.id_5113);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind5113()
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
            (select id_bilasocicons, ID_CATE, ID_FORM, count(*)
            from ind_5113
            group by id_bilasocicons, ID_CATE, ID_FORM
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

        call traitementDoublons_ind5113(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
