DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind513
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind513
$$

CREATE PROCEDURE traitementDoublons_ind513(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid513 INT;
	DECLARE vkey varchar(50);
	DECLARE vkeyPrevious varchar(50);
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind513_cursor CURSOR FOR
		select id_513, concat(TYPE, '-', IFNULL(ID_EBCF,0)) from ind_513
		where id_bilasocicons = idBilaSociCons
		order by TYPE, ID_EBCF , id_513 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_513_delete;
	CREATE TEMPORARY TABLE temp_ind_513_delete (
		id513 int
	);

	SET vkeyPrevious = '-';

	OPEN ind513_cursor;
    ind_loop: LOOP

		FETCH ind513_cursor INTO vid513, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_513_delete (id513)
			VALUES (vid513);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind513_cursor;

	DELETE FROM ind_513
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_513_delete t WHERE t.id513 = ind_513.id_513);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind513()
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
            (select id_bilasocicons, IFNULL(ID_EBCF,0), TYPE, count(*)
            from ind_513
            group by id_bilasocicons, IFNULL(ID_EBCF,0), TYPE
            having count(*)>1
            order by id_bilasocicons, TYPE,   IFNULL(ID_EBCF,0)) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind513(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
