DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_rassct_accident_travail
$$

CREATE PROCEDURE apa2cons_rassct_accident_travail(idBilaSociCons INT, idColl INT, idEnqu INT)
  COMMENT 'Compte le nombre d\'accident de travail en fonction du nombre de jours d\'arrêt associés.
  ATTENTION, tout est basé sur l\'ordre des INSERTIONS !!!'
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
  SQL SECURITY DEFINER
  BEGIN

    declare vNB_ACCIDENT_TRAVAIL_2016 int(11);
    declare vNB_ACCIDENT_TRAVAIL_2017 int(11);

    # Purge (par sécurité)
    DELETE FROM bsc_rassct_accident_travail
    WHERE ID_BILASOCICONS = idBilaSociCons;

    # Comptage des accidents sans arret (1ere ligne)
    INSERT INTO bsc_rassct_accident_travail (ID_BILASOCICONS, R_ACCIDENT_1, R_ACCIDENT_2, FG_STAT, DT_CREA, CD_UTILCREA)
    SELECT idBilaSociCons, COUNT(aaaNm1.ID_ABSEARREAGEN), COUNT(aaaN.ID_ABSEARREAGEN), 1, NOW(), 'APA2CONS'
    FROM bilan_social_agent AS bsa
      JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
      LEFT OUTER JOIN absence_arret_agent AS aaaNm1 ON bsa.ID_BILASOCIAGEN = aaaNm1.ID_BILASOCIAGEN
                                                       AND aaaNm1.ANNEE_EVENEMENT = enq.NM_ANNE - 1     # 2016
                                                       AND aaaNm1.ACCIDENT_AVEC_ARRET = 0
      LEFT OUTER JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
                                                     AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE             # 2017
                                                     AND aaaN.ACCIDENT_AVEC_ARRET = 0
    WHERE bsa.ID_COLL = idColl
      AND bsa.ID_ENQU = idEnqu;

    # Comptage des accidents avec 1..3 jours d'arret (2ieme ligne)
    INSERT INTO bsc_rassct_accident_travail (ID_BILASOCICONS, R_ACCIDENT_1, R_ACCIDENT_2, FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, COUNT(aaaNm1.ID_ABSEARREAGEN), COUNT(aaaN.ID_ABSEARREAGEN), 1, NOW(), 'APA2CONS'
      FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        LEFT OUTER JOIN absence_arret_agent AS aaaNm1 ON bsa.ID_BILASOCIAGEN = aaaNm1.ID_BILASOCIAGEN
                                                         AND aaaNm1.ANNEE_EVENEMENT = enq.NM_ANNE - 1     # 2016
                                                         AND aaaNm1.ACCIDENT_AVEC_ARRET = 1
                                                         AND aaaNm1.NB_JOURABSE BETWEEN 1 AND 3
        LEFT OUTER JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
                                                       AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE             # 2017
                                                       AND aaaN.ACCIDENT_AVEC_ARRET = 1
                                                       AND aaaN.NB_JOURABSE BETWEEN 1 AND 3
      WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu;

    # Comptage des accidents avec 4..21 jours d'arret (3ieme ligne)
    INSERT INTO bsc_rassct_accident_travail (ID_BILASOCICONS, R_ACCIDENT_1, R_ACCIDENT_2, FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, COUNT(aaaNm1.ID_ABSEARREAGEN), COUNT(aaaN.ID_ABSEARREAGEN), 1, NOW(), 'APA2CONS'
      FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        LEFT OUTER JOIN absence_arret_agent AS aaaNm1 ON bsa.ID_BILASOCIAGEN = aaaNm1.ID_BILASOCIAGEN
                                                         AND aaaNm1.ANNEE_EVENEMENT = enq.NM_ANNE - 1     # 2016
                                                         AND aaaNm1.ACCIDENT_AVEC_ARRET = 1
                                                         AND aaaNm1.NB_JOURABSE BETWEEN 4 AND 21
        LEFT OUTER JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
                                                       AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE             # 2017
                                                       AND aaaN.ACCIDENT_AVEC_ARRET = 1
                                                       AND aaaN.NB_JOURABSE BETWEEN 4 AND 21
      WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu;

    # Comptage des accidents avec 22..89 jours d'arret (4ieme ligne)
    INSERT INTO bsc_rassct_accident_travail (ID_BILASOCICONS, R_ACCIDENT_1, R_ACCIDENT_2, FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, COUNT(aaaNm1.ID_ABSEARREAGEN), COUNT(aaaN.ID_ABSEARREAGEN), 1, NOW(), 'APA2CONS'
      FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        LEFT OUTER JOIN absence_arret_agent AS aaaNm1 ON bsa.ID_BILASOCIAGEN = aaaNm1.ID_BILASOCIAGEN
                                                         AND aaaNm1.ANNEE_EVENEMENT = enq.NM_ANNE - 1     # 2016
                                                         AND aaaNm1.ACCIDENT_AVEC_ARRET = 1
                                                         AND aaaNm1.NB_JOURABSE BETWEEN 22 AND 89
        LEFT OUTER JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
                                                       AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE             # 2017
                                                       AND aaaN.ACCIDENT_AVEC_ARRET = 1
                                                       AND aaaN.NB_JOURABSE BETWEEN 22 AND 89
      WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu;

    # Comptage des accidents avec 90 ou plus jours d'arret (5ieme ligne)
    INSERT INTO bsc_rassct_accident_travail (ID_BILASOCICONS, R_ACCIDENT_1, R_ACCIDENT_2, FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, COUNT(aaaNm1.ID_ABSEARREAGEN), COUNT(aaaN.ID_ABSEARREAGEN), 1, NOW(), 'APA2CONS'
      FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        LEFT OUTER JOIN absence_arret_agent AS aaaNm1 ON bsa.ID_BILASOCIAGEN = aaaNm1.ID_BILASOCIAGEN
                                                         AND aaaNm1.ANNEE_EVENEMENT = enq.NM_ANNE - 1     # 2016
                                                         AND aaaNm1.ACCIDENT_AVEC_ARRET = 1
                                                         AND aaaNm1.NB_JOURABSE > 89
        LEFT OUTER JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
                                                       AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE             # 2017
                                                       AND aaaN.ACCIDENT_AVEC_ARRET = 1
                                                       AND aaaN.NB_JOURABSE > 89
      WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu;

    
    SELECT
        COUNT(R_ACCIDENT_1), 
        COUNT(R_ACCIDENT_2)
    INTO vNB_ACCIDENT_TRAVAIL_2016, vNB_ACCIDENT_TRAVAIL_2017
    FROM bsc_rassct_accident_travail 
      WHERE ID_BILASOCICONS = idBilaSociCons;
       
    IF vNB_ACCIDENT_TRAVAIL_2016 > 0 OR vNB_ACCIDENT_TRAVAIL_2017 > 0 THEN
        UPDATE bilan_social_consolide SET BL_INCO_RASSCT_ACCIDENT_TRAVAIL = '4', MOYENNE_RASSCT_ACCIDENT_TRAVAIL = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;

  END
$$
