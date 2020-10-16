DELIMITER $$


DROP PROCEDURE IF EXISTS traitementPurgeDoublons;
$$

CREATE PROCEDURE traitementPurgeDoublons()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    DECLARE vid_bilasocicons INT;
    DECLARE cursDone INT DEFAULT FALSE;

    DECLARE ind_cursor CURSOR FOR
            select distinct id_bilasocicons
            from bilanSocialConsolideDoublon;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursDone = TRUE;

    OPEN ind_cursor;
    ind_loop: LOOP

        FETCH ind_cursor INTO vid_bilasocicons;

        IF cursDone THEN
                LEAVE ind_loop;
        END IF;

        call traitementDoublons_ind111(vid_bilasocicons);
        call traitementDoublons_ind112(vid_bilasocicons);
        call traitementDoublons_ind113(vid_bilasocicons);
        call traitementDoublons_ind114(vid_bilasocicons);
        call traitementDoublons_ind121(vid_bilasocicons);
        call traitementDoublons_ind122(vid_bilasocicons);
        call traitementDoublons_ind123(vid_bilasocicons);
        call traitementDoublons_ind124(vid_bilasocicons);
        call traitementDoublons_ind1311(vid_bilasocicons);
        call traitementDoublons_ind1312(vid_bilasocicons);
        call traitementDoublons_ind132(vid_bilasocicons);
        call traitementDoublons_ind141(vid_bilasocicons);
        call traitementDoublons_ind142(vid_bilasocicons);
        call traitementDoublons_ind143(vid_bilasocicons);
        call traitementDoublons_ind144(vid_bilasocicons);
        call traitementDoublons_ind1501(vid_bilasocicons);
        call traitementDoublons_ind1502(vid_bilasocicons);
        call traitementDoublons_ind1511(vid_bilasocicons);
        call traitementDoublons_ind1512(vid_bilasocicons);
        call traitementDoublons_ind1513(vid_bilasocicons);
        call traitementDoublons_ind152(vid_bilasocicons);
        call traitementDoublons_ind1531(vid_bilasocicons);
        call traitementDoublons_ind1532(vid_bilasocicons);
        call traitementDoublons_ind154(vid_bilasocicons);
        call traitementDoublons_ind155(vid_bilasocicons);
        call traitementDoublons_ind156(vid_bilasocicons);
        call traitementDoublons_ind158(vid_bilasocicons);
        call traitementDoublons_ind161(vid_bilasocicons);
        call traitementDoublons_ind1612(vid_bilasocicons);
        call traitementDoublons_ind171(vid_bilasocicons);
        call traitementDoublons_ind2111(vid_bilasocicons);
        call traitementDoublons_ind2112(vid_bilasocicons);
        call traitementDoublons_ind2113(vid_bilasocicons);
        call traitementDoublons_ind2121(vid_bilasocicons);
        call traitementDoublons_ind2122(vid_bilasocicons);
        call traitementDoublons_ind2123(vid_bilasocicons);
        call traitementDoublons_ind2131(vid_bilasocicons);
        call traitementDoublons_ind2132(vid_bilasocicons);
        call traitementDoublons_ind2133(vid_bilasocicons);
        call traitementDoublons_ind214(vid_bilasocicons);
        call traitementDoublons_ind2151(vid_bilasocicons);
        call traitementDoublons_ind2152(vid_bilasocicons);
        call traitementDoublons_ind221(vid_bilasocicons);
        call traitementDoublons_ind222(vid_bilasocicons);
        call traitementDoublons_ind2231(vid_bilasocicons);
        call traitementDoublons_ind2232(vid_bilasocicons);
        call traitementDoublons_ind2233(vid_bilasocicons);
        call traitementDoublons_ind224(vid_bilasocicons);
        call traitementDoublons_ind231(vid_bilasocicons);
        call traitementDoublons_ind311(vid_bilasocicons);
        call traitementDoublons_ind321(vid_bilasocicons);
        call traitementDoublons_ind331(vid_bilasocicons);
        call traitementDoublons_ind344(vid_bilasocicons);
        call traitementDoublons_ind411(vid_bilasocicons);
        call traitementDoublons_ind412(vid_bilasocicons);
        call traitementDoublons_ind421(vid_bilasocicons);
        call traitementDoublons_ind422(vid_bilasocicons);
        call traitementDoublons_ind423(vid_bilasocicons);
        call traitementDoublons_ind423Fili(vid_bilasocicons);
        call traitementDoublons_ind424(vid_bilasocicons);
        call traitementDoublons_ind431(vid_bilasocicons);
        call traitementDoublons_ind5111(vid_bilasocicons);
        call traitementDoublons_ind5112(vid_bilasocicons);
        call traitementDoublons_ind5113(vid_bilasocicons);
        call traitementDoublons_ind5121(vid_bilasocicons);
        call traitementDoublons_ind5122(vid_bilasocicons);
        call traitementDoublons_ind513(vid_bilasocicons);
        call traitementDoublons_ind613(vid_bilasocicons);
        call traitementDoublons_ind6141(vid_bilasocicons);
        call traitementDoublons_ind6142(vid_bilasocicons);
        call traitementDoublons_ind7141(vid_bilasocicons);
        call traitementDoublons_ind7142(vid_bilasocicons);
        call traitementDoublonsHandiCadreEmploi(vid_bilasocicons);
        call traitementDoublonsHandiMetier(vid_bilasocicons);
        call traitementDoublonsGpeecMetier(vid_bilasocicons);
        call traitementDoublonsGpeecSpecialite(vid_bilasocicons);

    END LOOP;

    CLOSE ind_cursor;

END
$$


#call traitementPurgeDoublons();