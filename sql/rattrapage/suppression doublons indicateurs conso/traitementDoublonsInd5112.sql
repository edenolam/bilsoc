DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind5112
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind5112
$$

CREATE PROCEDURE traitementDoublons_ind5112(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid5112 INT;
	DECLARE vkey varchar(50);
	DECLARE vkeyPrevious varchar(50);
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind5112_cursor CURSOR FOR
		select id_5112, concat(ID_CATE, '-', ID_FORM) from ind_5112
		where id_bilasocicons = idBilaSociCons
		order by ID_CATE, ID_FORM , id_5112 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_5112_delete;
	CREATE TEMPORARY TABLE temp_ind_5112_delete (
		id5112 int
	);

	SET vkeyPrevious = '-';

	OPEN ind5112_cursor;
    ind_loop: LOOP

		FETCH ind5112_cursor INTO vid5112, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_5112_delete (id5112)
			VALUES (vid5112);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind5112_cursor;

	DELETE FROM ind_5112
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_5112_delete t WHERE t.id5112 = ind_5112.id_5112);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind5112()
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
            from ind_5112
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

        call traitementDoublons_ind5112(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
