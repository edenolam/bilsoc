DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_bsc`$$

CREATE PROCEDURE `conso_set0_bsc`(IN `param_idBilaSociCons` INT, IN `param_blAffiColl` BOOLEAN)
BEGIN


UPDATE bilan_social_consolide

  SET Q_132 = 0, Q_161 = 0, R_16211 = 0, R_16212 = 0, R_16213 = 0, R_16214 = 0, R_16221 = 0, R_16222 = 0, R_16223 = 0, Q_2151 = 0, Q_2152 = 0, Q_224 = 0, Q_225 = 0, Q_3411 = 0, Q_3421 = 0,
        Q_3422 = 0, Q_344 = 0, R_3451 = 0, R_3452 = 0, R_3453 = 0, R_5141 = 0, R_5142 = 0, R_3411 = 0, Q_3412 = 0,  R_3412 = 0, Q_3423 = 0, R_342 = 0, R_4131 = 0, Q_414 = 0, R_4141 = 0, R_4142 = 0, Q_415 = 0, Q_4161 = 0, Q_4162 = 0,  Q_4163 = 0, Q_417 = 0, Q_431 = 0, R_5143 = 0,
        R_5144 = 0, R_6111 = 0, R_6112 = 0, Q_6113 = 0, R_6113 = 0, Q_6114 = 0, R_6114 = 0, R_6121 = 0, R_6122 = 0, R_6123 = 0, R_6124 = 0, R_6125 = 0, R_6126 = 0, Q_613 = 0, Q_7111 = 0, Q_7112 = 0, Q_712 = 0, Q_7131 = 0, Q_7132 = 0, Q_7133 = 0, Q_S7141 = 0,
        Q_S7142 = 0, Q_P7143 = 0, Q_P7144 = 0, Q_421 = 0, R_421 = 0, Q_422 = 0, R_71411 = 0, R_2101 = 0, R_2102 = 0, R_71412 = 0, R_71421 = 0, R_71422 = 0, Q_HANDI_B22 = 0,
        Q_HANDI_B23 = 0, Q_HANDI_B41A = 0, Q_HANDI_B41B = 0,
        BL_INCO_EFF = 4, BL_INCO_IND110 = 0, MOYENNE_IND110 = 0,
        BL_INCO_IND111 = 0, MOYENNE_IND111 = 0,
        BL_INCO_IND112 = 0, MOYENNE_IND112 = 0,
        BL_INCO_IND113 = 0, MOYENNE_IND113 = 0,
        BL_INCO_IND114 = 0, MOYENNE_IND114 = 0,
        BL_INCO_IND121 = 0, MOYENNE_IND121 = 0,
        BL_INCO_IND122 = 0, MOYENNE_IND122 = 0,
        BL_INCO_IND123 = 0, MOYENNE_IND123 = 0,
        BL_INCO_IND124 = 0, MOYENNE_IND124 = 0,
        BL_INCO_IND131 = 0, MOYENNE_IND131 = 0,
        BL_INCO_IND132 = 4, MOYENNE_IND132 = 100,
        BL_INCO_IND140 = 4, MOYENNE_IND140 = 100,
        BL_INCO_TPSTRAV = 4, BL_INCO_IND211 = 0, MOYENNE_IND211 = 0,
        BL_INCO_IND212 = 0, MOYENNE_IND212 = 0,
        BL_INCO_IND213 = 0, MOYENNE_IND213 = 0,
        BL_INCO_IND214 = 0, MOYENNE_IND214 = 0,
        BL_INCO_IND215 = 0, MOYENNE_IND215 = 0,
        BL_INCO_IND221 = 0, MOYENNE_IND221 = 0,
        BL_INCO_IND222 = 0, MOYENNE_IND222 = 0,
        BL_INCO_IND223 = 0, MOYENNE_IND223 = 0,
        BL_INCO_IND224 = 0, MOYENNE_IND224 = 0,
        BL_INCO_MOUV = 4, BL_INCO_IND150 = 0, MOYENNE_IND150 = 0,
        BL_INCO_IND151 = 0, MOYENNE_IND151 = 0,
        BL_INCO_IND152 = 0, MOYENNE_IND152 = 0,
        BL_INCO_IND1531 = 0, MOYENNE_IND1531 = 0,
        BL_INCO_IND1532 = 0, MOYENNE_IND1532 = 0,
        BL_INCO_IND154 = 0, MOYENNE_IND154 = 0,
        BL_INCO_IND155 = 0, MOYENNE_IND155 = 0,
        BL_INCO_IND156 = 0, MOYENNE_IND156 = 0,
        BL_INCO_IND158 = 0, MOYENNE_IND158 = 0,
        BL_INCO_IND161 = 0, MOYENNE_IND161 = 0,
        BL_INCO_IND162 = 4, MOYENNE_IND162 = 100,
        BL_INCO_IND171 = 0, MOYENNE_IND171 = 0,
        BL_INCO_IND225 = 4, MOYENNE_IND225 = 100,
        BL_INCO_IND231 = 0, MOYENNE_IND231 = 0,
        BL_INCO_CONDITIONS = 4, BL_INCO_IND411 = 4, MOYENNE_IND411 = 100,
        BL_INCO_IND413 = 4, MOYENNE_IND413 = 100,
        BL_INCO_IND414 = 4, MOYENNE_IND414 = 100,
        BL_INCO_IND423 = 4, MOYENNE_IND423 = 100,
        BL_INCO_IND424 = 4, MOYENNE_IND424 = 100,
        BL_INCO_IND431 = 4, MOYENNE_IND431 = 100,
        BL_INCO_REMU = 4, BL_INCO_IND311 = 0, MOYENNE_IND311 = 0,
        BL_INCO_IND321 = 0, MOYENNE_IND321 = 0,
        BL_INCO_IND331 = 0, MOYENNE_IND331 = 0,
        BL_INCO_IND341 = 4, MOYENNE_IND341 = 100,
        BL_INCO_IND342 = 4, MOYENNE_IND342 = 100,
        BL_INCO_IND344 = 4, MOYENNE_IND344 = 100,
        BL_INCO_IND345 = 0, MOYENNE_IND345 = 0,
        BL_INCO_IND5111 = 4, MOYENNE_IND5111 = 100,
        BL_INCO_IND5112 = 4, MOYENNE_IND5112 = 100,
        BL_INCO_IND5113 = 4, MOYENNE_IND5113 = 100,
        BL_INCO_FORM = 4, BL_INCO_IND514 = 4, MOYENNE_IND514 = 100,
        BL_INCO_DROIT = 4, BL_INCO_IND614 = 4, MOYENNE_IND614 = 100,
        BL_INCO_IND612 = 0, MOYENNE_IND612 = 0,
        BL_INCO_IND613 = 0, MOYENNE_IND613 = 0,
        BL_INCO_IND711 = 0, MOYENNE_IND711 = 0,
        BL_INCO_IND712 = 0, MOYENNE_IND712 = 0,
        BL_INCO_IND713 = 0, MOYENNE_IND713 = 0,
        BL_INCO_IND714 = 0, MOYENNE_IND714 = 0,
        BL_INCO_IND421 = 4, MOYENNE_IND421 = 100,
        BL_INCO_IND422 = 4, MOYENNE_IND422 = 100,
        BL_INCO_IND210 = 4, MOYENNE_IND210 = 100,
        BL_INCO_IND512 = 4, MOYENNE_IND512 = 100,
        BL_INCO_IND513 = 4, MOYENNE_IND513 = 100,
        BL_INCO_RASSCT = 4, BL_INCO_RASSCT_ACCIDENT_TRAVAIL = 4, MOYENNE_RASSCT_ACCIDENT_TRAVAIL = 100,
        BL_INCO_RASSCT_REALISATION_FORMATION_SANTE_TRAVAIL = 4, MOYENNE_RASSCT_REALISATION_FORMATION_SANTE_TRAVAIL = 100,
        BL_INCO_RASSCT_AUTRES_MESURES = 4, MOYENNE_RASSCT_AUTRES_MESURES = 100,
        BL_INCO_RASSCT_PREVISION_FORMATION_SANTE_TRAVAIL = 4, MOYENNE_RASSCT_PREVISION_FORMATION_SANTE_TRAVAIL = 100,
        BL_INCO_RASSCT_PREDICTIONS_AUTRES_MESURES = 4, MOYENNE_RASSCT_PREDICTIONS_AUTRES_MESURES = 100,
        BL_INCO_RASSCT_NB_MALADIE_PRO = 4, MOYENNE_RASSCT_NB_MALADIE_PRO = 100,
        BL_INCO_RASSCT_NB_ACCIDENT_TRAVAIL = 4, MOYENNE_RASSCT_NB_ACCIDENT_TRAVAIL = 100,
        BL_INCO_RASSCT_NATURE_LESION = 4, MOYENNE_RASSCT_NATURE_LESION = 100,
        BL_INCO_RASSCT_SIEGE_LESION = 4, MOYENNE_RASSCT_SIEGE_LESION = 100,
        BL_INCO_RASSCT_ELEMENT_MATERIEL = 4, MOYENNE_RASSCT_ELEMENT_MATERIEL = 100,
        BL_INCO_RASSCT_MALADIE_PRO_CARAC_PRO = 4, MOYENNE_RASSCT_MALADIE_PRO_CARAC_PRO = 100,
        BL_INCO_GPEEC = 4, BL_INCO_GPEEC_NB_AGENTS_TIU_EMP_PERMA_PAR_FONC_ET_AGE = 4, MOYENNE_GPEEC_NB_AGENTS_TIU_EMP_PERMA_PAR_FONC_ET_AGE = 100,
        BL_INCO_GPEEC_PLUS_NB_AGENTS_PAR_SPE_ET_AGE = 4, MOYENNE_GPEEC_PLUS_NB_AGENTS_PAR_SPE_ET_AGE = 100,
        BL_INCO_GPEEC_NIVEAU_DIPLOME = 4, MOYENNE_GPEEC_NIVEAU_DIPLOME = 100,
        BL_INCO_HANDITORIAL = 4, BL_INCO_HANDITORIAL_QUESTIONS_GENERALES = 4, MOYENNE_HANDITORIAL_QUESTIONS_GENERALES = 100,
        BL_INCO_HANDITORIAL_INAPTITUDE_ET_RECLASSEMENT = 4, BL_INCO_HANDITORIAL_INAPTITUDE_ET_RECLASSEMENT = 4, MOYENNE_HANDITORIAL_INAPTITUDE_ET_RECLASSEMENT = 100,
        BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = 4, MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = 100,
        BL_INCO_HANDITORIAL_NATURE_HANDICAPS = 4, MOYENNE_HANDITORIAL_NATURE_HANDICAPS = 100,
        BL_INCO_HANDITORIAL_AVIS_INAPTITUDES = 4, MOYENNE_HANDITORIAL_AVIS_INAPTITUDES = 100,
        BL_INCO_HANDITORIAL_CADRE_EMPLOIS = 4, MOYENNE_HANDITORIAL_CADRE_EMPLOIS = 100,
        BL_INCO_HANDITORIAL_INAPT_ET_RECLA_CADRE_EMPLOIS = 4, MOYENNE_HANDITORIAL_INAPT_ET_RECLA_CADRE_EMPLOIS = 100,
        BL_INCO_HANDITORIAL_METIERS = 4, MOYENNE_HANDITORIAL_METIERS = 100,
        BL_INCO_HANDITORIAL_INAPT_ET_RECLA_METIERS = 4, MOYENNE_HANDITORIAL_INAPT_ET_RECLA_METIERS = 100,
        BL_INCO_HANDITORIAL_TEMPS_COMPLETS = 4, MOYENNE_HANDITORIAL_TEMPS_COMPLETS = 100,
        BL_INCO_HANDITORIAL_INAPT_ET_RECLA_TEMPS_COMPLETS = 4, MOYENNE_HANDITORIAL_INAPT_ET_RECLA_TEMPS_COMPLETS = 100
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  IF param_blAffiColl = 1 THEN
  UPDATE bilan_social_consolide
    SET BL_INCO_IND611 = 0, MOYENNE_IND611 = 0
    WHERE ID_BILASOCICONS = param_idBilaSociCons;
  ELSEIF param_blAffiColl = 0 THEN
  UPDATE bilan_social_consolide
    SET BL_INCO_IND611 = 4, MOYENNE_IND611 = 100
    WHERE ID_BILASOCICONS = param_idBilaSociCons;
  END IF;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind111`$$

CREATE PROCEDURE `conso_set0_ind111`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_111
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_111 (ID_BILASOCICONS, ID_GRAD, R_1111, R_1112, R_1113, R_1114, R_1115, R_1116)
  SELECT param_idBilaSociCons, g.ID_GRAD,
    0 AS R_1111,
    0 AS R_1112,
    0 AS R_1113,
    0 AS R_1114,
    0 AS R_1115,
    0 AS R_1116
  FROM ref_grade g
  WHERE g.bl_vali = 0
  GROUP BY param_idBilaSociCons, g.ID_GRAD
  ORDER BY g.ID_GRAD;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_every_fields`$$

CREATE PROCEDURE `conso_set0_every_fields`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT, IN `param_blAffiColl` BOOLEAN, IN `param_idColl` INT)
BEGIN

CALL conso_set0_questionc_coll(param_idBilaSociCons, param_idEnqu, param_idColl);
CALL conso_set0_bsc(param_idBilaSociCons, param_blAffiColl);
CALL conso_set0_ind110(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind111(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind112(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind113(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind114(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind121(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind122(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind123(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind124(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind131(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind132(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind141(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind142(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind143(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind144(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind150(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind151(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind152(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind153(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind154(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind155(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind156(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind158(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind161(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind171(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind211(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind212(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind213(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind214(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind215(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind221(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind222(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind223(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind224(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind311(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind321(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind331(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind344(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind411(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind421(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind422(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind423(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind424(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind431(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind511(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind512(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind513(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind613(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind614(param_idBilaSociCons, param_idEnqu);
CALL conso_set0_ind714(param_idBilaSociCons, param_idEnqu);

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind113`$$

CREATE PROCEDURE `conso_set0_ind113`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN
  DROP TEMPORARY TABLE IF EXISTS temp_genre;
  CREATE TEMPORARY TABLE temp_genre (fg_genre int)
    ENGINE = MEMORY
    ;
  insert into temp_genre  values (1);
  insert into temp_genre  values (2);

  ### Remplissage de 1.1.3
  DELETE FROM ind_113
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_113 (ID_BILASOCICONS, ID_CATE, FG_GENR, R_1131, R_1132)
  SELECT param_idBilaSociCons, c.ID_CATE, CASE WHEN g.fg_genre = 1 THEN 'H' ELSE 'F' END,
    0 AS R_1131,
    0 AS R_1132
  FROM ref_categorie c  JOIN temp_genre g
  WHERE c.BL_VALI = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE, g.fg_genre
  ORDER BY c.ID_CATE, g.fg_genre;


END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind110`$$

CREATE PROCEDURE `conso_set0_ind110`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_110_1
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_110_1 (ID_BILASOCICONS, ID_EMPLFONC, R_1101, R_1102, R_1103, R_1104, R_1105, R_1106, R_1107, R_1108, R_1109, R_1110)
  SELECT param_idBilaSociCons, ef.ID_EMPLFONC,
    0 AS R_1101,
    0 AS R_1102,
    0 AS R_1103,
    0 AS R_1104,
    0 AS R_1105,
    0 AS R_1106,
    0 AS R_1107,
    0 AS R_1108,
    0 AS R_1109,
    0 AS R_1110
  FROM ref_emploi_fonctionnel ef
  WHERE ef.bl_vali = 0
  GROUP BY param_idBilaSociCons, ef.ID_EMPLFONC
  ORDER BY ef.ID_EMPLFONC;

  DELETE FROM ind_110_2
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_110_2 (ID_BILASOCICONS, ID_EMPLFONC, R_1101, R_1102, R_1103, R_1104, R_1105, R_1106, R_1107, R_1108, R_1109, R_1110)
  SELECT param_idBilaSociCons, ef.ID_EMPLFONC,
    0 AS R_1101,
    0 AS R_1102,
    0 AS R_1103,
    0 AS R_1104,
    0 AS R_1105,
    0 AS R_1106,
    0 AS R_1107,
    0 AS R_1108,
    0 AS R_1109,
    0 AS R_1110
  FROM ref_emploi_fonctionnel ef
  WHERE ef.bl_vali = 0
  GROUP BY param_idBilaSociCons, ef.ID_EMPLFONC
  ORDER BY ef.ID_EMPLFONC;

  DELETE FROM ind_110_3
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_110_3 (ID_BILASOCICONS, ID_EMPLFONC, R_1101, R_1102)
  SELECT param_idBilaSociCons, ef.ID_EMPLFONC,
    0 AS R_1101,
    0 AS R_1102
  FROM ref_emploi_fonctionnel ef
  WHERE ef.bl_vali = 0
  GROUP BY param_idBilaSociCons, ef.ID_EMPLFONC
  ORDER BY ef.ID_EMPLFONC;


END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind112`$$

CREATE PROCEDURE `conso_set0_ind112`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_112
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_112 (ID_BILASOCICONS, ID_CADREMPL, R_1121, R_1122, R_1123, R_1124, R_1125, R_1126, R_1127, R_1128)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_1121,
    0 AS R_1122,
    0 AS R_1123,
    0 AS R_1124,
    0 AS R_1125,
    0 AS R_1126,
    0 AS R_1127,
    0 AS R_1128
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind114`$$

CREATE PROCEDURE `conso_set0_ind114`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_114
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_114 (ID_BILASOCICONS, ID_FILI, R_1141, R_1142, R_1143, R_1144)
  SELECT param_idBilaSociCons, f.ID_FILI,
    0 AS R_1141,
    0 AS R_1142,
    0 AS R_1143,
    0 AS R_1144
  FROM ref_filiere f
  WHERE f.bl_vali = 0
  GROUP BY param_idBilaSociCons, f.ID_FILI
  ORDER BY f.ID_FILI;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind121`$$

CREATE PROCEDURE `conso_set0_ind121`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_121
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_121 (ID_BILASOCICONS, ID_CADREMPL, R_1211, R_1212, R_1213, R_1214, R_1215, R_1216, R_1217, R_1218, R_1219, R_12110, R_12111, R_12112, R_12113, R_12114, R_12115, R_12116, R_12117, R_12118)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_1211,
    0 AS R_1212,
    0 AS R_1213,
    0 AS R_1214,
    0 AS R_1215,
    0 AS R_1216,
    0 AS R_1217,
    0 AS R_1218,
    0 AS R_1219,
    0 AS R_12110,
    0 AS R_12111,
    0 AS R_12112,
    0 AS R_12113,
    0 AS R_12114,
    0 AS R_12115,
    0 AS R_12116,
    0 AS R_12117,
    0 AS R_12118
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind122`$$

CREATE PROCEDURE `conso_set0_ind122`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_122
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_122 (ID_BILASOCICONS, ID_CADREMPL, R_1221, R_1222, R_1223, R_1224, R_1225, R_1226, R_1227, R_1228)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_1221,
    0 AS R_1222,
    0 AS R_1223,
    0 AS R_1224,
    0 AS R_1225,
    0 AS R_1226,
    0 AS R_1227,
    0 AS R_1228
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind123`$$

CREATE PROCEDURE `conso_set0_ind123`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN
  DROP TEMPORARY TABLE IF EXISTS temp_genre;
  CREATE TEMPORARY TABLE temp_genre (fg_genre int)
    ENGINE = MEMORY
    ;
  insert into temp_genre  values (1);
  insert into temp_genre  values (2);

  ### Remplissage de 1.2.3
  DELETE FROM ind_123
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_123 (ID_BILASOCICONS, ID_CATE, FG_GENR, R_1231, R_1232)
  SELECT param_idBilaSociCons, c.ID_CATE, CASE WHEN g.fg_genre = 1 THEN 'H' ELSE 'F' END,
    0 AS R_1231,
    0 AS R_1232
  FROM ref_categorie c  JOIN temp_genre g
  WHERE c.BL_VALI = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE, g.fg_genre
  ORDER BY c.ID_CATE, g.fg_genre;


END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind124`$$

CREATE PROCEDURE `conso_set0_ind124`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_124
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_124 (ID_BILASOCICONS, ID_FILI, R_1241, R_1242, R_1243, R_1244)
  SELECT param_idBilaSociCons, f.ID_FILI,
    0 AS R_1241,
    0 AS R_1242,
    0 AS R_1243,
    0 AS R_1244
  FROM ref_filiere f
  WHERE f.bl_vali = 0
  GROUP BY param_idBilaSociCons, f.ID_FILI
  ORDER BY f.ID_FILI;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind131`$$

CREATE PROCEDURE `conso_set0_ind131`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN
  ### Remplissage de 1.3.1.1
  DELETE FROM ind_1311
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_1311 (ID_BILASOCICONS, ID_EMPLNONPERM, R_13111, R_13112, R_13113, R_13114)
	  SELECT param_idBilaSociCons, enp.ID_EMPLNONPERM,
		0 AS R_13111,
		0 AS R_13112,
		0 AS R_13123,
		0 AS R_13124
	  FROM ref_emploi_non_permanent enp
	  WHERE enp.BL_VALI = 0
	  GROUP BY enp.ID_EMPLNONPERM
	  ORDER BY enp.ID_EMPLNONPERM
  ;

  ### Remplissage de 1.3.1.2
  DELETE FROM ind_1312
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_1312 (ID_BILASOCICONS, ID_EMPLNONPERM, R_13121, R_13122, R_13123, R_13124)
  SELECT param_idBilaSociCons, enp.ID_EMPLNONPERM,
	0 AS R_13121,
	0 AS R_13122,
	0 AS R_13123,
    0 AS R_13124
  FROM ref_emploi_non_permanent enp
  WHERE enp.BL_VALI = 0
  GROUP BY enp.ID_EMPLNONPERM
  ORDER BY enp.ID_EMPLNONPERM
  ;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind132`$$

CREATE PROCEDURE `conso_set0_ind132`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_132
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  ### Remplissage de 1.3.1.2
  INSERT INTO ind_132 (ID_BILASOCICONS, R_1321_1, R_1322_1, R_1321_2, R_1322_2)
  VALUES (param_idBilaSociCons, 0, 0, 0, 0);

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind141`$$

CREATE PROCEDURE `conso_set0_ind141`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_141
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_141 (ID_BILASOCICONS, ID_POSISTAT, R_1411, R_1412)
  SELECT param_idBilaSociCons, ps.ID_POSISTAT,
    0 AS R_1411,
    0 AS R_1412
  FROM ref_position_statutaire ps
  WHERE ps.bl_vali = 0
  GROUP BY param_idBilaSociCons, ps.ID_POSISTAT
  ORDER BY ps.ID_POSISTAT;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind142`$$

CREATE PROCEDURE `conso_set0_ind142`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_142
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_142 (ID_BILASOCICONS, ID_POSISTAT, R_1421, R_1422, R_1423, R_1424, R_1425, R_1426)
  SELECT param_idBilaSociCons, ps.ID_POSISTAT,
    0 AS R_1421,
    0 AS R_1422,
    0 AS R_1423,
    0 AS R_1424,
    0 AS R_1425,
    0 AS R_1426
  FROM ref_position_statutaire ps
  WHERE ps.bl_vali = 0
  GROUP BY param_idBilaSociCons, ps.ID_POSISTAT
  ORDER BY ps.ID_POSISTAT;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind143`$$

CREATE PROCEDURE `conso_set0_ind143`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_143
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_143 (ID_BILASOCICONS, ID_POSISTAT, R_1431, R_1432, R_1433, R_1434)
  SELECT param_idBilaSociCons, ps.ID_POSISTAT,
    0 AS R_1431,
    0 AS R_1432,
    0 AS R_1433,
    0 AS R_1434
  FROM ref_position_statutaire ps
  WHERE ps.bl_vali = 0
  GROUP BY param_idBilaSociCons, ps.ID_POSISTAT
  ORDER BY ps.ID_POSISTAT;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind144`$$

CREATE PROCEDURE `conso_set0_ind144`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_144
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_144 (ID_BILASOCICONS, ID_POSISTAT, R_1441, R_1442)
  SELECT param_idBilaSociCons, ps.ID_POSISTAT,
    0 AS R_1441,
    0 AS R_1442
  FROM ref_position_statutaire ps
  WHERE ps.bl_vali = 0
  GROUP BY param_idBilaSociCons, ps.ID_POSISTAT
  ORDER BY ps.ID_POSISTAT;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind150`$$

CREATE PROCEDURE `conso_set0_ind150`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_150_1
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_150_1 (ID_BILASOCICONS, ID_MOTIDEPA, R_15011, R_15012, R_15013, R_15014, R_15015, R_15016, R_15017, R_15018)
  SELECT param_idBilaSociCons, md.ID_MOTIDEPA,
    0 AS R_15011,
    0 AS R_15012,
    0 AS R_15013,
    0 AS R_15014,
    0 AS R_15015,
    0 AS R_15016,
    0 AS R_15017,
    0 AS R_15018
  FROM ref_motif_depart md
  WHERE md.bl_vali = 0
  GROUP BY param_idBilaSociCons, md.ID_MOTIDEPA
  ORDER BY md.ID_MOTIDEPA;

  DELETE FROM ind_150_2
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_150_2 (ID_BILASOCICONS, ID_MOTIDEPA, R_15021, R_15022, R_15023, R_15024, R_15025, R_15026, R_15027, R_15028)
  SELECT param_idBilaSociCons, md.ID_MOTIDEPA,
    0 AS R_15021,
    0 AS R_15022,
    0 AS R_15023,
    0 AS R_15024,
    0 AS R_15025,
    0 AS R_15026,
    0 AS R_15027,
    0 AS R_15028
  FROM ref_motif_depart md
  WHERE md.bl_vali = 0
  GROUP BY param_idBilaSociCons, md.ID_MOTIDEPA
  ORDER BY md.ID_MOTIDEPA;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind151`$$

CREATE PROCEDURE `conso_set0_ind151`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_151_1
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_151_1 (ID_BILASOCICONS, ID_EMPLFONC, R_15111, R_15112, R_15113, R_15114, R_15115, R_15116, R_15117, R_15118)
  SELECT param_idBilaSociCons, ef.ID_EMPLFONC,
    0 AS R_15111,
    0 AS R_15112,
    0 AS R_15113,
    0 AS R_15114,
    0 AS R_15115,
    0 AS R_15116,
    0 AS R_15117,
    0 AS R_15118
  FROM ref_emploi_fonctionnel ef
  WHERE ef.bl_vali = 0
  GROUP BY param_idBilaSociCons, ef.ID_EMPLFONC
  ORDER BY ef.ID_EMPLFONC;

  DELETE FROM ind_151_2
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_151_2 (ID_BILASOCICONS, ID_EMPLFONC, R_15121, R_15122, R_15123, R_15124, R_15125, R_15126, R_15127, R_15128)
  SELECT param_idBilaSociCons, ef.ID_EMPLFONC,
    0 AS R_15121,
    0 AS R_15122,
    0 AS R_15123,
    0 AS R_15124,
    0 AS R_15125,
    0 AS R_15126,
    0 AS R_15127,
    0 AS R_15128
  FROM ref_emploi_fonctionnel ef
  WHERE ef.bl_vali = 0
  GROUP BY param_idBilaSociCons, ef.ID_EMPLFONC
  ORDER BY ef.ID_EMPLFONC;

  DELETE FROM ind_151_3
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_151_3 (ID_BILASOCICONS, ID_EMPLFONC, R_15131, R_15132)
  SELECT param_idBilaSociCons, ef.ID_EMPLFONC,
    0 AS R_15131,
    0 AS R_15132
  FROM ref_emploi_fonctionnel ef
  WHERE ef.bl_vali = 0
  GROUP BY param_idBilaSociCons, ef.ID_EMPLFONC
  ORDER BY ef.ID_EMPLFONC;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind152`$$

CREATE PROCEDURE `conso_set0_ind152`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_152
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_152 (ID_BILASOCICONS, ID_CADREMPL, R_1521, R_1522, R_1523, R_1524, R_1525, R_1526, R_1527, R_1528, R_1529, R_15210, R_15211, R_15212, R_15213, R_15214, R_15215, R_15216, R_15217, R_15218, R_15219, R_15220)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_1521,
    0 AS R_1522,
    0 AS R_1523,
    0 AS R_1524,
    0 AS R_1525,
    0 AS R_1526,
    0 AS R_1527,
    0 AS R_1528,
    0 AS R_1529,
    0 AS R_15210,
    0 AS R_15211,
    0 AS R_15212,
    0 AS R_15213,
    0 AS R_15214,
    0 AS R_15215,
    0 AS R_15216,
    0 AS R_15217,
    0 AS R_15218,
    0 AS R_15219,
    0 AS R_15220
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind153`$$

CREATE PROCEDURE `conso_set0_ind153`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_153_1
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_153_1 (ID_BILASOCICONS, ID_MOTIARRI, R_15311, R_15312, R_15313, R_15314)
  SELECT param_idBilaSociCons, ma.ID_MOTIARRI,
    0 AS R_15311,
    0 AS R_15312,
    0 AS R_15313,
    0 AS R_15314
  FROM ref_motif_arrivee ma
  WHERE ma.bl_vali = 0
  GROUP BY param_idBilaSociCons, ma.ID_MOTIARRI
  ORDER BY ma.ID_MOTIARRI;

  DELETE FROM ind_1532
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_1532 (ID_BILASOCICONS, ID_CADREMPL, R_15321, R_15322, R_15323, R_15324)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_15321,
	0 AS R_15322,
	0 AS R_15323,
	0 AS R_15324
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind154`$$

CREATE PROCEDURE `conso_set0_ind154`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_154
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_154 (ID_BILASOCICONS, ID_STAGTITU, R_1541, R_1542)
  SELECT param_idBilaSociCons, st.ID_STAGTITU,
    0 AS R_1541,
    0 AS R_1542
  FROM ref_stage_titularisation st
  WHERE st.bl_vali = 0
  GROUP BY param_idBilaSociCons, st.ID_STAGTITU
  ORDER BY st.ID_STAGTITU;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind155`$$

CREATE PROCEDURE `conso_set0_ind155`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_155
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_155 (ID_BILASOCICONS, ID_AVANPROMCONC, R_1551, R_1552)
  SELECT param_idBilaSociCons, apc.ID_AVANPROMCONC,
    0 AS R_1551,
    0 AS R_1552
  FROM 	ref_avancement_promotion_concours apc
  WHERE apc.bl_vali = 0
  GROUP BY param_idBilaSociCons, apc.ID_AVANPROMCONC
  ORDER BY apc.ID_AVANPROMCONC;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind156`$$

CREATE PROCEDURE `conso_set0_ind156`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_156
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_156 (ID_BILASOCICONS, ID_CATE, R_1561, R_1562)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_1561,
    0 AS R_1562
  FROM 	ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind158`$$

CREATE PROCEDURE `conso_set0_ind158`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_158
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_158 (ID_BILASOCICONS, ID_FILI, R_1581, R_1582, R_1583, R_1584, R_1585, R_1586, R_1587, R_1588)
  SELECT param_idBilaSociCons, f.ID_FILI,
    0 AS R_1581,
    0 AS R_1582,
    0 AS R_1583,
    0 AS R_1584,
    0 AS R_1585,
    0 AS R_1586,
    0 AS R_1587,
    0 AS R_1588
  FROM 	ref_filiere f
  WHERE f.bl_vali = 0
  GROUP BY param_idBilaSociCons, f.ID_FILI
  ORDER BY f.ID_FILI;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind161`$$

CREATE PROCEDURE `conso_set0_ind161`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_161
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_161 (ID_BILASOCICONS, ID_CATE, R_1611, R_1612, R_1613, R_1614)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_1611,
    0 AS R_1612,
    0 AS R_1613,
    0 AS R_1614
  FROM 	ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

  DELETE FROM ind_1612
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_1612 (ID_BILASOCICONS, R_16121, R_16122, R_16123, R_16124)
  VALUES (param_idBilaSociCons, 0, 0, 0, 0);

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind171`$$

CREATE PROCEDURE `conso_set0_ind171`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DROP TEMPORARY TABLE IF EXISTS temp_genre;
  CREATE TEMPORARY TABLE temp_genre (fg_genre int)
    ENGINE = MEMORY
    ;
  insert into temp_genre  values (1);
  insert into temp_genre  values (2);

  ### Remplissage
  DELETE FROM ind_171
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_171 (ID_BILASOCICONS, ID_TRANAGE, FG_GENR, R_1711, R_1712, R_1713)
  SELECT param_idBilaSociCons, ta.ID_TRANAGE, CASE WHEN g.fg_genre = 1 THEN 'H' ELSE 'F' END as FG_GENR,
    0 AS R_1711,
    0 AS R_1712,
	0 AS R_1713
  FROM ref_tranche_age ta  JOIN temp_genre g
  GROUP BY param_idBilaSociCons, ta.ID_TRANAGE, g.fg_genre
  ORDER BY g.fg_genre, ta.ID_TRANAGE;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind211`$$

CREATE PROCEDURE `conso_set0_ind211`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

    DELETE FROM ind_211_1
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

  ### Remplissage
  INSERT INTO ind_211_1 (ID_BILASOCICONS, ID_MOTIABSE, R_21111, R_21112, R_21113, R_21114, R_21115, R_21116)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21111,
    0 AS R_21112,
	0 AS R_21113,
	0 AS R_21114,
	0 AS R_21115,
	0 AS R_21116
  FROM ref_motif_absence ma
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.BL_ABSEAUTRRAIS DESC, ma.ID_MOTIABSE;


  DELETE FROM ind_211_2
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_211_2 (ID_BILASOCICONS, ID_MOTIABSE, R_21121, R_21122, R_21123, R_21124, R_21125, R_21126, R_21127, R_21128, R_21129, R_211210)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21121,
	0 AS R_21122,
	0 AS R_21123,
    0 AS R_21124,
	0 AS R_21125,
	0 AS R_21126,
	0 AS R_21127,
	0 AS R_21128,
	0 AS R_21129,
	0 AS R_211210
  FROM ref_motif_absence ma
  WHERE (ma.BL_ABSECOMP = 1 OR ma.BL_ABSEMEDI = 1)
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.ID_MOTIABSE;


  DELETE FROM ind_211_3
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_211_3 (ID_BILASOCICONS, ID_MOTIABSE, R_21131, R_21132, R_21133, R_21134, R_21135, R_21136, R_21137, R_21138, R_21139, R_211310)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21131,
	0 AS R_21132,
	0 AS R_21133,
	0 AS R_21134,
	0 AS R_21135,
	0 AS R_21136,
	0 AS R_21137,
    0 AS R_21138,
	0 AS R_21139,
	0 AS R_211310
  FROM ref_motif_absence ma
  WHERE (ma.BL_ABSECOMP = 1 OR ma.BL_ABSEMEDI = 1)
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.ID_MOTIABSE;



END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind212`$$

CREATE PROCEDURE `conso_set0_ind212`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

    DELETE FROM ind_212_1
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

  ### Remplissage
  INSERT INTO ind_212_1 (ID_BILASOCICONS, ID_MOTIABSE, R_21211, R_21212, R_21213, R_21214, R_21215, R_21216)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21211,
    0 AS R_21212,
	0 AS R_21213,
	0 AS R_21214,
	0 AS R_21215,
	0 AS R_21216
  FROM ref_motif_absence ma
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.BL_ABSEAUTRRAIS DESC, ma.ID_MOTIABSE;


  DELETE FROM ind_212_2
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_212_2 (ID_BILASOCICONS, ID_MOTIABSE, R_21221, R_21222, R_21223, R_21224, R_21225, R_21226, R_21227, R_21228, R_21229, R_212210)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21221,
	0 AS R_21222,
	0 AS R_21223,
    0 AS R_21224,
	0 AS R_21225,
	0 AS R_21226,
	0 AS R_21227,
	0 AS R_21228,
	0 AS R_21229,
	0 AS R_212210
  FROM ref_motif_absence ma
  WHERE (ma.BL_ABSECOMP = 1 OR ma.BL_ABSEMEDI = 1)
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.ID_MOTIABSE;


  DELETE FROM ind_212_3
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_212_3 (ID_BILASOCICONS, ID_MOTIABSE, R_21231, R_21232, R_21233, R_21234, R_21235, R_21236, R_21237, R_21238, R_21239, R_212310)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21231,
	0 AS R_21232,
	0 AS R_21233,
	0 AS R_21234,
	0 AS R_21235,
	0 AS R_21236,
	0 AS R_21237,
    0 AS R_21238,
	0 AS R_21239,
	0 AS R_212310
  FROM ref_motif_absence ma
  WHERE (ma.BL_ABSECOMP = 1 OR ma.BL_ABSEMEDI = 1)
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.ID_MOTIABSE;



END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind213`$$

CREATE PROCEDURE `conso_set0_ind213`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

    DELETE FROM ind_213_1
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

  ### Remplissage
  INSERT INTO ind_213_1 (ID_BILASOCICONS, ID_MOTIABSE, R_21311, R_21312, R_21313, R_21314, R_21315, R_21316)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21311,
    0 AS R_21312,
	0 AS R_21313,
	0 AS R_21314,
	0 AS R_21315,
	0 AS R_21316
  FROM ref_motif_absence ma
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.BL_ABSEAUTRRAIS DESC, ma.ID_MOTIABSE;


  DELETE FROM ind_213_2
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_213_2 (ID_BILASOCICONS, ID_MOTIABSE, R_21321, R_21322, R_21323, R_21324, R_21325, R_21326, R_21327, R_21328, R_21329, R_213210)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21321,
	0 AS R_21322,
	0 AS R_21323,
    0 AS R_21324,
	0 AS R_21325,
	0 AS R_21326,
	0 AS R_21327,
	0 AS R_21328,
	0 AS R_21329,
	0 AS R_213210
  FROM ref_motif_absence ma
  WHERE (ma.BL_ABSECOMP = 1 OR ma.BL_ABSEMEDI = 1)
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.ID_MOTIABSE;


  DELETE FROM ind_213_3
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_213_3 (ID_BILASOCICONS, ID_MOTIABSE, R_21331, R_21332, R_21333, R_21334, R_21335, R_21336, R_21337, R_21338, R_21339, R_213310)
  SELECT param_idBilaSociCons, ma.ID_MOTIABSE,
    0 AS R_21331,
	0 AS R_21332,
	0 AS R_21333,
	0 AS R_21334,
	0 AS R_21335,
	0 AS R_21336,
	0 AS R_21337,
    0 AS R_21338,
	0 AS R_21339,
	0 AS R_213310
  FROM ref_motif_absence ma
  WHERE (ma.BL_ABSECOMP = 1 OR ma.BL_ABSEMEDI = 1)
  GROUP BY param_idBilaSociCons, ma.ID_MOTIABSE
  ORDER BY ma.BL_ABSECOMP DESC,  ma.BL_ABSEMEDI DESC, ma.ID_MOTIABSE;



END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind214`$$

CREATE PROCEDURE `conso_set0_ind214`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_214
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_214 (ID_BILASOCICONS, ID_CATE, R_2141, R_2142)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_2141,
    0 AS R_2142
  FROM 	ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind215`$$

CREATE PROCEDURE `conso_set0_ind215`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_2151
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_2151 (ID_BILASOCICONS, ID_MOTIENTR, R_21511, R_21512)
  SELECT param_idBilaSociCons, me.ID_MOTIENTR,
    0 AS R_21511,
    0 AS R_21512
  FROM ref_motif_entretien me
  WHERE me.bl_vali = 0
  GROUP BY param_idBilaSociCons, me.ID_MOTIENTR
  ORDER BY me.ID_MOTIENTR;

  DELETE FROM ind_2152
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_2152 (ID_BILASOCICONS, ID_MOTIENTR, R_21521, R_21522)
  SELECT param_idBilaSociCons, me.ID_MOTIENTR,
    0 AS R_21521,
    0 AS R_21522
  FROM ref_motif_entretien me
  WHERE me.bl_vali = 0
  GROUP BY param_idBilaSociCons, me.ID_MOTIENTR
  ORDER BY me.ID_MOTIENTR;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind221`$$

CREATE PROCEDURE `conso_set0_ind221`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_221
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_221 (ID_BILASOCICONS, ID_CYCLTRAV, R_2211, R_2212)
  SELECT param_idBilaSociCons, c.ID_CYCLTRAV,
    0 AS R_2211,
    0 AS R_2212
  FROM 	ref_cycle_travail c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CYCLTRAV
  ORDER BY c.LB_CYCLTRAV DESC;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind222`$$

CREATE PROCEDURE `conso_set0_ind222`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_222
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_222 (ID_BILASOCICONS, ID_CONTTRAV, R_2221, R_2222)
  SELECT param_idBilaSociCons, ct.ID_CONTTRAV,
    0 AS R_2221,
    0 AS R_2222
  FROM 	ref_contrainte_travail ct
  WHERE ct.bl_vali = 0
  GROUP BY param_idBilaSociCons, ct.ID_CONTTRAV
  ORDER BY ct.ID_CONTTRAV;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind223`$$

CREATE PROCEDURE `conso_set0_ind223`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_2231
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_2231 (ID_BILASOCICONS, ID_CATE, R_22311, R_22312, R_22313, R_22314)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_22311,
    0 AS R_22312,
    0 AS R_22313,
    0 AS R_22314
  FROM ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

  DELETE FROM ind_2232
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_2232 (ID_BILASOCICONS, ID_CATE, R_22321, R_22322, R_22323, R_22324)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_22321,
    0 AS R_22322,
    0 AS R_22323,
    0 AS R_22324
  FROM ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

  DELETE FROM ind_2233
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_2233 (ID_BILASOCICONS, ID_CATE, R_22331, R_22332, R_22333, R_22334, R_22335, R_22336)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_22331,
    0 AS R_22332,
    0 AS R_22333,
    0 AS R_22334,
    0 AS R_22335,
    0 AS R_22336
  FROM ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind224`$$

CREATE PROCEDURE `conso_set0_ind224`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_224
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_224 (ID_BILASOCICONS, R_2241, R_2242, R_2243, R_2244, R_2245, R_2246, R_2247, R_2248)
  VALUES (param_idBilaSociCons, 0,0,0,0,0,0,0,0);

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind231`$$

CREATE PROCEDURE `conso_set0_ind231`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  ### Remplissage de 2.3.1
  DELETE FROM ind_231
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

    ### Remplissage 
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  VALUES (param_idBilaSociCons, 0, 0, 'DPR', 0);
  
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  VALUES (param_idBilaSociCons, 0, 0, 'DAC', 1);
  
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  VALUES (param_idBilaSociCons, 0, 0, 'PDS', 2);
  
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  VALUES (param_idBilaSociCons, 0, 0, 'MOQ', 3);
  
  INSERT INTO ind_231 (ID_BILASOCICONS, R_2311, R_2312, CD_DEMA, ORDRE)
  VALUES (param_idBilaSociCons, 0, 0, 'RTP', 4);
  
END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind311`$$

CREATE PROCEDURE `conso_set0_ind311`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_311
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_311 (ID_BILASOCICONS, ID_CATE, R_3111, R_3112, R_3113, R_3114, R_3115, R_3116, R_3117, R_3118, R_3119, R_31110)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_3111,
    0 AS R_3112,
    0 AS R_3113,
    0 AS R_3114,
    0 AS R_3115,
    0 AS R_3116,
    0 AS R_3117,
    0 AS R_3118,
    0 AS R_3119,
    0 AS R_31110
  FROM ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind321`$$

CREATE PROCEDURE `conso_set0_ind321`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_321
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_321 (ID_BILASOCICONS, ID_CATE, R_3211, R_3212, R_3213, R_3214, R_3215, R_3216)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_3211,
    0 AS R_3212,
    0 AS R_3213,
    0 AS R_3214,
    0 AS R_3215,
    0 AS R_3216
  FROM ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind331`$$

CREATE PROCEDURE `conso_set0_ind331`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_331
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_331 (ID_BILASOCICONS, ID_EMPLNONPERM, R_3311, R_3312)
  SELECT param_idBilaSociCons, enp.ID_EMPLNONPERM,
    0 AS R_3311,
    0 AS R_3312
  FROM ref_emploi_non_permanent enp
  WHERE enp.bl_vali = 0
  GROUP BY param_idBilaSociCons, enp.ID_EMPLNONPERM
  ORDER BY enp.ID_EMPLNONPERM;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind344`$$

CREATE PROCEDURE `conso_set0_ind344`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_344
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_344 (ID_BILASOCICONS, ID_CADREMPL, R_3441, R_3442, R_3443, R_3444)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_3441,
    0 AS R_3442,
    0 AS R_3443,
    0 AS R_3444
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind411`$$

CREATE PROCEDURE `conso_set0_ind411`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_411
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_411 (ID_BILASOCICONS, ID_TYPEMISSPREV, R_4111)
  SELECT param_idBilaSociCons, tmp.ID_TYPEMISSPREV,
    0 AS R_4111
  FROM ref_type_mission_prevention tmp
  WHERE tmp.bl_vali = 0
  GROUP BY param_idBilaSociCons, tmp.ID_TYPEMISSPREV
  ORDER BY tmp.ID_TYPEMISSPREV;

  DELETE FROM ind_412
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_412 (ID_BILASOCICONS, ID_ACTIONPREV, R_4121, R_4122, R_4123)
  SELECT param_idBilaSociCons, ap.ID_ACTIONPREV,
    0 AS R_4121,
    0 AS R_4122,
    0 AS R_4123
  FROM ref_action_prevention ap
  WHERE ap.bl_vali = 0
  GROUP BY param_idBilaSociCons, ap.ID_ACTIONPREV
  ORDER BY ap.ID_ACTIONPREV;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind421`$$

CREATE PROCEDURE `conso_set0_ind421`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_421
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_421 (ID_BILASOCICONS, ID_CADREMPL, R_4211, R_4212, R_4213, R_4214, R_4215, R_4216, R_4217, R_4218, R_4219, R_42110, R_42111, R_42112)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_4211,
    0 AS R_4212,
    0 AS R_4213,
    0 AS R_4214,
    0 AS R_4215,
    0 AS R_4216,
    0 AS R_4217,
    0 AS R_4218,
    0 AS R_4219,
    0 AS R_42110,
    0 AS R_42111,
    0 AS R_42112
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind422`$$

CREATE PROCEDURE `conso_set0_ind422`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_422
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_422 (ID_BILASOCICONS, ID_CADREMPL, R_4221, R_4222, R_4223, R_4224, R_4225, R_4226, R_4227, R_4228)
  SELECT param_idBilaSociCons, ce.ID_CADREMPL,
    0 AS R_4221,
    0 AS R_4222,
    0 AS R_4223,
    0 AS R_4224,
    0 AS R_4225,
    0 AS R_4226,
    0 AS R_4227,
    0 AS R_4228
  FROM ref_cadre_emploi ce
  WHERE ce.bl_vali = 0
  GROUP BY param_idBilaSociCons, ce.ID_CADREMPL
  ORDER BY ce.ID_CADREMPL;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind423`$$

CREATE PROCEDURE `conso_set0_ind423`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_423
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_423 (ID_BILASOCICONS, ID_INAP, R_4231)
  SELECT param_idBilaSociCons, i.ID_INAP,
    0 AS R_4231
  FROM ref_inaptitude i
  WHERE i.bl_vali = 0
  GROUP BY param_idBilaSociCons, i.ID_INAP
  ORDER BY i.ID_INAP;

  DELETE FROM ind_423Fili
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_423Fili (ID_BILASOCICONS, ID_FILI, R_4231Fili)
  SELECT param_idBilaSociCons, f.ID_FILI,
    0 AS R_4231Fili
  FROM ref_filiere f
  WHERE f.bl_vali = 0
  GROUP BY param_idBilaSociCons, f.ID_FILI
  ORDER BY f.ID_FILI;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind424`$$

CREATE PROCEDURE `conso_set0_ind424`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

DELETE FROM ind_424
WHERE ID_BILASOCICONS = param_idBilaSociCons;

  ### Remplissage de
  INSERT INTO ind_424 (ID_BILASOCICONS, R_TS4241,R_TS4242,R_TS4243,R_TS4244,R_TS4245,R_TS4246  , R_EMP4241, R_EMP4242, R_EMP4243, R_EMP4244, R_EMP4245, R_EMP4246)
  VALUES (param_idBilaSociCons, 0,0,0,0,0,0,0,0,0,0,0,0);


END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind431`$$

CREATE PROCEDURE `conso_set0_ind431`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_431
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_431 (ID_BILASOCICONS, ID_ACTEVIOLPHYS, R_4311, R_4312)
  SELECT param_idBilaSociCons, avp.ID_ACTEVIOLPHYS,
    0 AS R_4311,
    0 AS R_4312
  FROM ref_acte_violence_physique avp
  WHERE avp.bl_vali = 0
  GROUP BY param_idBilaSociCons, avp.ID_ACTEVIOLPHYS
  ORDER BY avp.ID_ACTEVIOLPHYS;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind511`$$

CREATE PROCEDURE `conso_set0_ind511`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

    DELETE FROM ind_5111
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

    INSERT INTO ind_5111 (ID_BILASOCICONS, ID_CATE, R_51111, R_51112, R_51113, R_51114)
    SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_51111,
    0 AS R_51112,
    0 AS R_51113,
    0 AS R_51114
    FROM ref_categorie c
    WHERE c.bl_vali = 0
    GROUP BY param_idBilaSociCons, c.ID_CATE
    ORDER BY c.ID_CATE;

    DELETE FROM ind_5112
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

    INSERT INTO ind_5112 (ID_BILASOCICONS, ID_CATE, ID_FORM , R_51121, R_51122, R_51123, R_51124, R_51125, R_51126, R_51127, R_51128)
    SELECT param_idBilaSociCons, c.ID_CATE, f.ID_FORM,
    0 AS R_51121,
    0 AS R_51122,
    0 AS R_51123,
    0 AS R_51124,
    0 AS R_51125,
    0 AS R_51126,
    0 AS R_51117,
    0 AS R_51128
    FROM ref_categorie c JOIN ref_formation f
    WHERE c.BL_VALI = 0
    AND f.BL_VALI = 0
    GROUP BY c.ID_CATE, f.ID_FORM
    ORDER BY c.ID_CATE, f.ID_FORM;

    DELETE FROM ind_5113
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

    INSERT INTO ind_5113 (ID_BILASOCICONS, ID_CATE, ID_FORM , R_51131, R_51132, R_51133, R_51134, R_51135, R_51136, R_51137, R_51138)
    SELECT param_idBilaSociCons, c.ID_CATE, f.ID_FORM,
    0 AS R_51131,
    0 AS R_51132,
    0 AS R_51133,
    0 AS R_51134,
    0 AS R_51135,
    0 AS R_51136,
    0 AS R_51137,
    0 AS R_51138
    FROM ref_categorie c JOIN ref_formation f
    WHERE c.BL_VALI = 0
    AND f.BL_VALI = 0
    GROUP BY c.ID_CATE, f.ID_FORM
    ORDER BY c.ID_CATE, f.ID_FORM;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind512`$$

CREATE PROCEDURE `conso_set0_ind512`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_5121
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_5121 (ID_BILASOCICONS, ID_EMPLNONPERM, R_51211, R_51212, R_51213, R_51214, R_51215, R_51216, R_51217, R_51218)
  SELECT param_idBilaSociCons, c.ID_EMPLNONPERM,
    0 AS R_51211,
    0 AS R_51212,
    0 AS R_51213,
    0 AS R_51214,
    0 AS R_51215,
    0 AS R_51216,
    0 AS R_51217,
    0 AS R_51218
  FROM ref_emploi_non_permanent c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_EMPLNONPERM
  ORDER BY c.ID_EMPLNONPERM;

  DELETE FROM ind_5122
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_5122 (ID_BILASOCICONS, ID_EMPLNONPERM, R_51221, R_51222)
  SELECT param_idBilaSociCons, c.ID_EMPLNONPERM,
    0 AS R_51221,
    0 AS R_51222
  FROM ref_emploi_non_permanent c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_EMPLNONPERM
  ORDER BY c.ID_EMPLNONPERM;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind513`$$

CREATE PROCEDURE `conso_set0_ind513`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

    DELETE FROM ind_513
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

    INSERT INTO ind_513 (ID_BILASOCICONS, ID_EBCF, TYPE, R_5131, R_5132, R_5133, R_5134)
    SELECT param_idBilaSociCons, ve.ID_EBCF, 1,
        0 AS R_5131,
        0 AS R_5132,
        0 AS R_5133,
        0 AS R_5134
    FROM ref_validation_experience ve
    WHERE ve.BL_VALI = 0
    GROUP BY param_idBilaSociCons, ve.ID_EBCF
    ORDER BY ve.ID_EBCF;

    INSERT INTO ind_513 (ID_BILASOCICONS, ID_EBCF, TYPE, R_5131, R_5132, R_5133, R_5134)
    VALUES (param_idBilaSociCons, null, 2, 0, 0, 0, 0);

    INSERT INTO ind_513 (ID_BILASOCICONS, ID_EBCF, TYPE, R_5131, R_5132, R_5133, R_5134)
    VALUES (param_idBilaSociCons, null, 3, 0, 0, 0, 0);

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind613`$$

CREATE PROCEDURE `conso_set0_ind613`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_613
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_613 (ID_BILASOCICONS, ID_MOTIGREV, R_6131, R_6132)
  SELECT param_idBilaSociCons, mg.ID_MOTIGREV,
    0 AS R_6131,
    0 AS R_6132
  FROM ref_motif_greve mg
  WHERE mg.bl_vali = 0
  GROUP BY param_idBilaSociCons, mg.ID_MOTIGREV
  ORDER BY mg.ID_MOTIGREV;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind614`$$

CREATE PROCEDURE `conso_set0_ind614`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_6141
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_6141 (ID_BILASOCICONS, ID_SANC_DISC, FG_GROUPE, R_61411)
  SELECT param_idBilaSociCons, sd.ID_SANC_DISC,
      CASE
          WHEN sd.BL_714_G1 = 1 THEN 1
      END,
      0 AS R_61411
    FROM ref_sanction_disciplinaire sd
    WHERE sd.bl_vali = 0
    AND sd.BL_714_G1=1
    UNION ALL
    SELECT param_idBilaSociCons, sd2.ID_SANC_DISC,
      CASE
          WHEN sd2.BL_714_G2 = 1 THEN 2
      END,
      0 AS R_61411
    FROM ref_sanction_disciplinaire sd2
    WHERE sd2.bl_vali = 0
    AND sd2.BL_714_G2=1
    UNION ALL
    SELECT param_idBilaSociCons, sd3.ID_SANC_DISC,
      CASE
          WHEN sd3.BL_714_G3 = 1 THEN 3
      END,
      0 AS R_61411
    FROM ref_sanction_disciplinaire sd3
    WHERE sd3.bl_vali = 0
    AND sd3.BL_714_G3=1
    UNION ALL
    SELECT param_idBilaSociCons, sd4.ID_SANC_DISC,
      CASE
          WHEN sd4.BL_714_G4 = 1 THEN 4
      END,
      0 AS R_61411
    FROM ref_sanction_disciplinaire sd4
    WHERE sd4.bl_vali = 0
    AND sd4.BL_714_G4=1
    UNION ALL
    SELECT param_idBilaSociCons, sd5.ID_SANC_DISC,
      CASE
          WHEN sd5.BL_714_G5 = 1 THEN 5
      END,
      0 AS R_61411
    FROM ref_sanction_disciplinaire sd5
    WHERE sd5.bl_vali = 0
    AND sd5.BL_714_G5=1
    UNION ALL
    SELECT param_idBilaSociCons, sd6.ID_SANC_DISC,
      CASE
          WHEN sd6.BL_714_G6 = 1 THEN 6
      END,
      0 AS R_61411
    FROM ref_sanction_disciplinaire sd6
    WHERE sd6.bl_vali = 0
    AND sd6.BL_714_G6=1;

    DELETE FROM ind_6142
    WHERE ID_BILASOCICONS = param_idBilaSociCons;

    INSERT INTO ind_6142 (ID_BILASOCICONS, ID_MOTI_SANC_DISC, R_61421)
    SELECT param_idBilaSociCons, msd.ID_MOTI_SANC_DISC,
      0 AS R_61421
    FROM 	ref_motif_sanction_disciplinaire msd
    WHERE msd.bl_vali = 0
    GROUP BY param_idBilaSociCons, msd.ID_MOTI_SANC_DISC
    ORDER BY msd.ID_MOTI_SANC_DISC;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_ind714`$$

CREATE PROCEDURE `conso_set0_ind714`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT)
BEGIN

  DELETE FROM ind_7141
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_7141 (ID_BILASOCICONS, ID_CATE, R_71411, R_71412)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_71411,
    0 AS R_71412
  FROM ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

  DELETE FROM ind_7142
  WHERE ID_BILASOCICONS = param_idBilaSociCons;

  INSERT INTO ind_7142 (ID_BILASOCICONS, ID_CATE, R_71421, R_71422)
  SELECT param_idBilaSociCons, c.ID_CATE,
    0 AS R_71421,
    0 AS R_71422
  FROM ref_categorie c
  WHERE c.bl_vali = 0
  GROUP BY param_idBilaSociCons, c.ID_CATE
  ORDER BY c.ID_CATE;

END$$
DELIMITER ;

DELIMITER $$

DROP PROCEDURE IF EXISTS `conso_set0_questionc_coll`$$

CREATE PROCEDURE `conso_set0_questionc_coll`(IN `param_idBilaSociCons` INT, IN `param_idEnqu` INT, IN `param_idColl` INT)
BEGIN
    DECLARE vID_QUESCOLLCONS INTEGER;

SELECT ID_QUESCOLLCONS
    INTO vID_QUESCOLLCONS
FROM bilan_social_consolide
WHERE ID_BILASOCICONS = param_idBilaSociCons;


UPDATE question_collectivite_consolide SET Q1 = 0, Q2 = 0, Q3 = 0, Q4 = 0, Q5 = 0, Q6 = 0, Q7 = 0, Q8 = 0, Q9 = 0, Q10 = 0, Q11 = 0, Q12 = 0, Q13 = 0, Q14 = 0
WHERE ID_QUESCOLLCONS = vID_QUESCOLLCONS;

END$$
DELIMITER ;
