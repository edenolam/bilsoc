DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind423Fili
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind423Fili
$$

CREATE PROCEDURE traitementDoublons_ind423Fili(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid423Fili INT;
	DECLARE vkey varchar(50);
	DECLARE vkeyPrevious varchar(50);
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind423Fili_cursor CURSOR FOR
		select id_423Fili, concat(ID_INAP, '-', ID_FILI) from ind_423Fili
		where id_bilasocicons = idBilaSociCons
		order by ID_INAP, ID_FILI , id_423Fili desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_423Fili_delete;
	CREATE TEMPORARY TABLE temp_ind_423Fili_delete (
		id423Fili int
	);

	SET vkeyPrevious = '-';

	OPEN ind423Fili_cursor;
    ind_loop: LOOP

		FETCH ind423Fili_cursor INTO vid423Fili, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_423Fili_delete (id423Fili)
			VALUES (vid423Fili);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind423Fili_cursor;

	DELETE FROM ind_423Fili
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_423Fili_delete t WHERE t.id423Fili = ind_423Fili.id_423Fili);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind423Fili()
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
            (select id_bilasocicons, ID_INAP, ID_FILI, count(*)
            from ind_423Fili
            group by id_bilasocicons, ID_INAP, ID_FILI
            having count(*)>1
            order by id_bilasocicons, ID_INAP) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind423Fili(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$

