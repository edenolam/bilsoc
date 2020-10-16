DELIMITER $$

DROP TABLE IF EXISTS bilanSocialConsolideDoublon;
$$

CREATE TABLE bilanSocialConsolideDoublon (
    id_bilasocicons     int
)
$$

DROP PROCEDURE IF EXISTS traitementRecupDoublons;
$$

CREATE PROCEDURE traitementRecupDoublons()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, id_grad, count(*)
            from ind_111
            group by id_bilasocicons, id_grad
            having count(*)>1
            order by id_bilasocicons, id_grad) req;


    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, id_cadrempl, count(*)
            from ind_112
            group by id_bilasocicons, id_cadrempl
            having count(*)>1
            order by id_bilasocicons, id_cadrempl) req;


    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, FG_GENR,ID_CATE, count(*)
            from ind_113
            group by id_bilasocicons, FG_GENR, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE,FG_GENR) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_FILI, count(*)
            from ind_114
            group by id_bilasocicons, ID_FILI
            having count(*)>1
            order by id_bilasocicons, ID_FILI) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, id_cadrempl, count(*)
            from ind_121
            group by id_bilasocicons, id_cadrempl
            having count(*)>1
            order by id_bilasocicons, id_cadrempl) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, id_cadrempl, count(*)
            from ind_122
            group by id_bilasocicons, id_cadrempl
            having count(*)>1
            order by id_bilasocicons, id_cadrempl) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, FG_GENR,ID_CATE, count(*)
            from ind_123
            group by id_bilasocicons, FG_GENR, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE,FG_GENR) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_FILI, count(*)
            from ind_124
            group by id_bilasocicons, ID_FILI
            having count(*)>1
            order by id_bilasocicons, ID_FILI) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_1311
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_1312
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons,  count(*)
            from ind_132
            group by id_bilasocicons
            having count(*)>1
            order by id_bilasocicons) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_POSISTAT, count(*)
            from ind_141
            group by id_bilasocicons, ID_POSISTAT
            having count(*)>1
            order by id_bilasocicons, ID_POSISTAT) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_POSISTAT, count(*)
            from ind_142
            group by id_bilasocicons, ID_POSISTAT
            having count(*)>1
            order by id_bilasocicons, ID_POSISTAT) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_POSISTAT, count(*)
            from ind_143
            group by id_bilasocicons, ID_POSISTAT
            having count(*)>1
            order by id_bilasocicons, ID_POSISTAT) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_POSISTAT, count(*)
            from ind_144
            group by id_bilasocicons, ID_POSISTAT
            having count(*)>1
            order by id_bilasocicons, ID_POSISTAT) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIDEPA, count(*)
            from ind_150_1
            group by id_bilasocicons, ID_MOTIDEPA
            having count(*)>1
            order by id_bilasocicons, ID_MOTIDEPA) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIDEPA, count(*)
            from ind_150_2
            group by id_bilasocicons, ID_MOTIDEPA
            having count(*)>1
            order by id_bilasocicons, ID_MOTIDEPA) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLFONC, count(*)
            from ind_151_1
            group by id_bilasocicons, ID_EMPLFONC
            having count(*)>1
            order by id_bilasocicons, ID_EMPLFONC) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLFONC, count(*)
            from ind_151_2
            group by id_bilasocicons, ID_EMPLFONC
            having count(*)>1
            order by id_bilasocicons, ID_EMPLFONC) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLFONC, count(*)
            from ind_151_3
            group by id_bilasocicons, ID_EMPLFONC
            having count(*)>1
            order by id_bilasocicons, ID_EMPLFONC) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, id_cadrempl, count(*)
            from ind_152
            group by id_bilasocicons, id_cadrempl
            having count(*)>1
            order by id_bilasocicons, id_cadrempl) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIARRI, count(*)
            from ind_153_1
            group by id_bilasocicons, ID_MOTIARRI
            having count(*)>1
            order by id_bilasocicons, ID_MOTIARRI) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from ind_1532
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_STAGTITU, count(*)
            from ind_154
            group by id_bilasocicons, ID_STAGTITU
            having count(*)>1
            order by id_bilasocicons, ID_STAGTITU) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_AVANPROMCONC, count(*)
            from ind_155
            group by id_bilasocicons, ID_AVANPROMCONC
            having count(*)>1
            order by id_bilasocicons, ID_AVANPROMCONC) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_156
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_FILI, count(*)
            from ind_158
            group by id_bilasocicons, ID_FILI
            having count(*)>1
            order by id_bilasocicons, ID_FILI) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_161
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons,  count(*)
            from ind_1612
            group by id_bilasocicons
            having count(*)>1
            order by id_bilasocicons) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, FG_GENR, ID_TRANAGE,  count(*)
            from ind_171
            WHERE FG_GENR != 'E'
            group by id_bilasocicons, FG_GENR, ID_TRANAGE
            having count(*)>1
            order by id_bilasocicons, FG_GENR, ID_TRANAGE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_211_1
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_211_2
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_211_3
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_212_1
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_212_2
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_212_3
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_213_1
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_213_2
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIABSE, count(*)
            from ind_213_3
            group by id_bilasocicons, ID_MOTIABSE
            having count(*)>1
            order by id_bilasocicons, ID_MOTIABSE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_214
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIENTR, count(*)
            from ind_2151
            group by id_bilasocicons, ID_MOTIENTR
            having count(*)>1
            order by id_bilasocicons, ID_MOTIENTR) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIENTR, count(*)
            from ind_2152
            group by id_bilasocicons, ID_MOTIENTR
            having count(*)>1
            order by id_bilasocicons, ID_MOTIENTR) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CYCLTRAV, count(*)
            from ind_221
            group by id_bilasocicons, ID_CYCLTRAV
            having count(*)>1
            order by id_bilasocicons, ID_CYCLTRAV) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CONTTRAV, count(*)
            from ind_222
            group by id_bilasocicons, ID_CONTTRAV
            having count(*)>1
            order by id_bilasocicons, ID_CONTTRAV) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_2231
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_2232
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_2233
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons,  count(*)
            from ind_224
            group by id_bilasocicons
            having count(*)>1
            order by id_bilasocicons) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, CD_DEMA, count(*)
            from ind_231
            group by id_bilasocicons, CD_DEMA
            having count(*)>1
            order by id_bilasocicons, CD_DEMA) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_311
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_321
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_331
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from ind_344
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_TYPEMISSPREV, count(*)
            from ind_411
            group by id_bilasocicons, ID_TYPEMISSPREV
            having count(*)>1
            order by id_bilasocicons, ID_TYPEMISSPREV) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_ACTIONPREV, count(*)
            from ind_412
            group by id_bilasocicons, ID_ACTIONPREV
            having count(*)>1
            order by id_bilasocicons, ID_ACTIONPREV) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from ind_421
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from ind_422
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_INAP, count(*)
            from ind_423
            group by id_bilasocicons, ID_INAP
            having count(*)>1
            order by id_bilasocicons, ID_INAP) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_INAP, ID_FILI, count(*)
            from ind_423Fili
            group by id_bilasocicons, ID_INAP, ID_FILI
            having count(*)>1
            order by id_bilasocicons, ID_INAP) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons,  count(*)
            from ind_424
            group by id_bilasocicons
            having count(*)>1
            order by id_bilasocicons) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_ACTEVIOLPHYS,  count(*)
            from ind_431
            group by id_bilasocicons, ID_ACTEVIOLPHYS
            having count(*)>1
            order by id_bilasocicons, ID_ACTEVIOLPHYS) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE,  count(*)
            from ind_5111
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, ID_FORM, count(*)
            from ind_5112
            group by id_bilasocicons, ID_CATE, ID_FORM
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, ID_FORM, count(*)
            from ind_5113
            group by id_bilasocicons, ID_CATE, ID_FORM
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_5121
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_EMPLNONPERM, count(*)
            from ind_5122
            group by id_bilasocicons, ID_EMPLNONPERM
            having count(*)>1
            order by id_bilasocicons, ID_EMPLNONPERM) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, IFNULL(ID_EBCF,0), TYPE, count(*)
            from ind_513
            group by id_bilasocicons, IFNULL(ID_EBCF,0), TYPE
            having count(*)>1
            order by id_bilasocicons, TYPE,   IFNULL(ID_EBCF,0)) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTIGREV, count(*)
            from ind_613
            group by id_bilasocicons, ID_MOTIGREV
            having count(*)>1
            order by id_bilasocicons, ID_MOTIGREV) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, FG_GROUPE, IFNULL(ID_SANC_DISC,0), count(*)
            from ind_6141
            group by id_bilasocicons, FG_GROUPE, ID_SANC_DISC
            having count(*)>1
            order by id_bilasocicons, FG_GROUPE, ID_SANC_DISC) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_MOTI_SANC_DISC, count(*)
            from ind_6142
            group by id_bilasocicons, ID_MOTI_SANC_DISC
            having count(*)>1
            order by id_bilasocicons, ID_MOTI_SANC_DISC) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_7141
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CATE, count(*)
            from ind_7142
            group by id_bilasocicons, ID_CATE
            having count(*)>1
            order by id_bilasocicons, ID_CATE) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_CADREMPL, count(*)
            from bsc_handitorial_cadre_emplois
            group by id_bilasocicons, ID_CADREMPL
            having count(*)>1
            order by id_bilasocicons, ID_CADREMPL) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_METIER, count(*)
            from bsc_handitorial_metiers
            group by id_bilasocicons, ID_METIER
            having count(*)>1
            order by id_bilasocicons, ID_METIER) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_METIER, count(*)
            from bsc_gpeec_nb_agents_titu_emp_perma_par_fonc_et_age
            group by id_bilasocicons, ID_METIER
            having count(*)>1
            order by id_bilasocicons, ID_METIER) req;

    insert into bilanSocialConsolideDoublon
    select distinct req.id_bilasocicons
            from
            (select id_bilasocicons, ID_SPECIALITE, count(*)
            from bsc_gpeec_plus_nb_agents_par_spe_et_age
            group by id_bilasocicons, ID_SPECIALITE
            having count(*)>1
            order by id_bilasocicons, ID_SPECIALITE) req;

END
$$

#call traitementRecupDoublons();