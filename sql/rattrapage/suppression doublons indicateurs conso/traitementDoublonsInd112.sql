DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind112
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind112
$$

CREATE PROCEDURE traitementDoublons_ind112(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    DECLARE vid112 INT;
    DECLARE vidCadrEmpl INT;
    DECLARE vidCadrEmplPrevious INT;
    DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind112_cursor CURSOR FOR
		select id_112, id_cadrempl from ind_112
		where id_bilasocicons = idBilaSociCons
		order by id_cadrempl, id_112 desc;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    DROP TEMPORARY TABLE IF EXISTS temp_ind_112_delete;
    CREATE TEMPORARY TABLE temp_ind_112_delete (
            id112 int,
            id_cadrempl int
    );

    SET vidCadrEmplPrevious = -1;

    OPEN ind112_cursor;
    ind_loop: LOOP

        FETCH ind112_cursor INTO vid112, vidCadrEmpl;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        IF vidCadrEmplPrevious = vidCadrEmpl THEN

            INSERT INTO temp_ind_112_delete (id112, id_cadrempl)
            VALUES (vid112, vidCadrEmpl);

        END IF;

        SET vidCadrEmplPrevious = vidCadrEmpl;

    END LOOP;

    CLOSE ind112_cursor;

    DELETE FROM ind_112
    WHERE id_bilasocicons = idBilaSociCons
    AND EXISTS (SELECT 1 FROM temp_ind_112_delete t WHERE t.id112 = ind_112.id_112);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind112()
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
            (select id_bilasocicons, id_cadrempl, count(*)
            from ind_112
            group by id_bilasocicons, id_cadrempl
            having count(*)>1
            order by id_bilasocicons, id_cadrempl) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind112(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
