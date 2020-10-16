DELIMITER $$

DROP PROCEDURE IF EXISTS traitementAllDoublons_ind111
$$

DROP PROCEDURE IF EXISTS traitementDoublons_ind111
$$

CREATE PROCEDURE traitementDoublons_ind111(idBilaSociCons INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    DECLARE vid111 INT;
    DECLARE vidGrad INT;
    DECLARE vidGradPrevious INT;
    DECLARE cursDone INT DEFAULT FALSE;

    DEClARE ind111_cursor CURSOR FOR
		select id_111, id_grad from ind_111
		where id_bilasocicons = idBilaSociCons
		order by id_grad, id_111 desc;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    DROP TEMPORARY TABLE IF EXISTS temp_ind_111_delete;
    CREATE TEMPORARY TABLE temp_ind_111_delete (
            id111 int,
            id_grad int
    );

    SET vidGradPrevious = -1;

    OPEN ind111_cursor;
    ind_loop: LOOP

        FETCH ind111_cursor INTO vid111, vidGrad;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        IF vidGradPrevious = vidGrad THEN

            INSERT INTO temp_ind_111_delete (id111, id_grad)
            VALUES (vid111, vidGrad);

        END IF;

        SET vidGradPrevious = vidGrad;

    END LOOP;

    CLOSE ind111_cursor;

    DELETE FROM ind_111
    WHERE id_bilasocicons = idBilaSociCons
    AND EXISTS (SELECT 1 FROM temp_ind_111_delete t WHERE t.id111 = ind_111.id_111);

END
$$


CREATE PROCEDURE traitementAllDoublons_ind111()
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
            (select id_bilasocicons, id_grad, count(*)
            from ind_111
            group by id_bilasocicons, id_grad
            having count(*)>1
            order by id_bilasocicons, id_grad) req;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        #select vid_bilasocicons;

        call traitementDoublons_ind111(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$
