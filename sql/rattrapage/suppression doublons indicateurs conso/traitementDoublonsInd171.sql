DELIMITER $$


DROP PROCEDURE IF EXISTS traitementAllDoublons_ind171
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind171
$$

CREATE PROCEDURE traitementDoublons_ind171(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	DECLARE vid171 INT;
	DECLARE vkey varchar(50);
	DECLARE vkeyPrevious varchar(50);
	DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind171_cursor CURSOR FOR
		select id_171, concat(id_tranage, fg_genr) as vkey  from ind_171
		where id_bilasocicons = idBilaSociCons
		order by fg_genr desc, id_tranage, id_171 desc;

	DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

	DROP TEMPORARY TABLE IF EXISTS temp_ind_171_delete;
	CREATE TEMPORARY TABLE temp_ind_171_delete (
		id171 int
	);

	SET vkeyPrevious = '-';

	OPEN ind171_cursor;
    ind_loop: LOOP

		FETCH ind171_cursor INTO vid171, vkey;

		IF cursDone THEN
			LEAVE ind_loop;
		END IF;

		IF vkeyPrevious = vkey THEN

			INSERT INTO temp_ind_171_delete (id171)
			VALUES (vid171);

		END IF;

		SET vkeyPrevious = vkey;

    END LOOP;

    CLOSE ind171_cursor;

	DELETE FROM ind_171
	WHERE id_bilasocicons = idBilaSociCons
	AND EXISTS (SELECT 1 FROM temp_ind_171_delete t WHERE t.id171 = ind_171.id_171);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind171()
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
            (select id_bilasocicons, FG_GENR, ID_TRANAGE,  count(*)
            from ind_171
            WHERE FG_GENR != 'E'
            group by id_bilasocicons, FG_GENR, ID_TRANAGE
            having count(*)>1
            order by id_bilasocicons, FG_GENR, ID_TRANAGE) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind171(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
