DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind113
$$


DROP PROCEDURE IF EXISTS traitementDoublons_ind113
$$

CREATE PROCEDURE traitementDoublons_ind113(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid113 INT;
	DECLARE vkey varchar(50);
	DECLARE vkeyPrevious varchar(50);
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind113_cursor CURSOR FOR
		select id_113, concat(id_cate, fg_genr) as vkey  from ind_113
		where id_bilasocicons = idBilaSociCons
		order by id_cate, fg_genr, id_113 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_113_delete;
	CREATE TEMPORARY TABLE temp_ind_113_delete (
		id113 int
	);

	SET vkeyPrevious = '-';

	OPEN ind113_cursor;
    ind_loop: LOOP

		FETCH ind113_cursor INTO vid113, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_113_delete (id113)
			VALUES (vid113);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind113_cursor;

	DELETE FROM ind_113
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_113_delete t WHERE t.id113 = ind_113.id_113);

END
$$

CREATE PROCEDURE traitementAllDoublons_ind113()
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
            (select id_bilasocicons, FG_GENR,ID_CATE, count(*)
            from ind_113
            group by id_bilasocicons, FG_GENR, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE,FG_GENR) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind113(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
