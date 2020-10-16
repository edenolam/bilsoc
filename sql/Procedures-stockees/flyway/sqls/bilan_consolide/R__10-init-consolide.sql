DELIMITER $$

DROP PROCEDURE IF EXISTS initialiser_bilan_consolide
$$

CREATE PROCEDURE initialiser_bilan_consolide(pIdColl INT, pIdEnqu INT, OUT pIdBilaSociCons INT)
  COMMENT 'Initialise un nouveau bilan consolidé pour une collectivité et une enquête données.'
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
  SQL SECURITY DEFINER
  BEGIN
    DECLARE idQuesCollCons INT;

    # Teste l'existance d'un consolidé
    SELECT ID_BILASOCICONS
    INTO pIdBilaSociCons
    FROM bilan_social_consolide
    WHERE ID_COLL = pIdColl
      AND ID_ENQU = pIdEnqu;

    IF pIdBilaSociCons IS NOT NULL THEN
      SIGNAL SQLSTATE '01000' SET MESSAGE_TEXT = 'Il y a déjà un bilan social consolidé pour cette collectivité.';
    END IF;

    INSERT INTO question_collectivite_consolide (CD_UTILCREA, created_at, ID_COLL, ID_ENQU, 
                                                 Q1, Q10, Q11, Q12, Q13, Q14, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9)
    VALUES ('SYSTEM', CURRENT_TIMESTAMP, pIdColl, pIdEnqu, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

    SET idQuesCollCons = LAST_INSERT_ID();

    INSERT INTO bilan_social_consolide (BL_VALI, CD_UTILCREA, DT_CREA, FG_STAT, ID_COLL, ID_ENQU, ID_QUESCOLLCONS,
                                        MOYENNE_IND110, MOYENNE_IND140,
                                        MOYENNE_IND150, MOYENNE_IND151, MOYENNE_IND1531, MOYENNE_IND1532, MOYENNE_IND158, MOYENNE_IND162, MOYENNE_IND171, MOYENNE_IND210, MOYENNE_IND214,
                                        MOYENNE_IND215, MOYENNE_IND221, MOYENNE_IND222, MOYENNE_IND223, MOYENNE_IND224, MOYENNE_IND225, MOYENNE_IND231, MOYENNE_IND311, MOYENNE_IND341,
                                        MOYENNE_IND342, MOYENNE_IND343, MOYENNE_IND413, MOYENNE_IND414, MOYENNE_IND422, MOYENNE_IND423, MOYENNE_IND611, MOYENNE_IND612, MOYENNE_IND613,
                                        MOYENNE_IND614, MOYENNE_IND711, MOYENNE_IND712, MOYENNE_IND713, MOYENNE_IND513)
    VALUES (0, 'SYSTEM', CURRENT_TIMESTAMP, 0, pIdColl, pIdEnqu, idQuesCollCons,
              100, 100,
              100, 100, 100, 100, 100, 100, 100, 100, 100,
              100, 100, 100, 100, 100, 100, 100, 100, 100,
              100, 100, 100, 100, 100, 100, 100, 100, 100,
              100, 100, 100, 100, 100);

    SET pIdBilaSociCons = LAST_INSERT_ID();
    
    SELECT pIdBilaSociCons;
  END
$$