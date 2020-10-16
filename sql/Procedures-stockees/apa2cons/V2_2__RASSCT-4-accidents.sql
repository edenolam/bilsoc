DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_rassct_accident_by_types
$$

CREATE PROCEDURE apa2cons_rassct_accident_by_types(idBilaSociCons INT, idColl INT, idEnqu INT)
  COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
  SQL SECURITY DEFINER
  BEGIN
    
     declare vNB_ACCIDENTS_SURVENUS int(11);
    declare vNB_JOUR_ARRET_ACCIDENTS int(11);

    declare vACCIDENT_AVEC_ARRET_NATURE_LESION int(11);
    declare vACCIDENT_SANS_ARRET_NATURE_LESION int(11);
    declare vNB_JOURABSE_NATURE_LESION int(11);

    declare vNB_JOURABSE_SIEGE_LESION int(11);
    declare vNB_ACCIDENT_SIEGE_LESION int(11);


    declare vNB_ACCIDENT_ELEMENT_MATERIEL int(11);
    declare vNB_JOURABSE_ELEMENT_MATERIEL int(11);

    declare vNB_ACCIDENT_TYPE_ACTIVITE int(11);
    declare vNB_JOURABSE_TYPE_ACTIVITE int(11);

    #
    # Par types activité
    #
    DELETE FROM bsc_rassct_nb_accident_travail
    WHERE ID_BILASOCICONS = idBilaSociCons;

    # Comptage
    INSERT INTO bsc_rassct_nb_accident_travail (ID_BILASOCICONS,
                                          ID_TYPE_ACTIVITE, R_NB_ACCIDENTS_SURVENUS, R_NB_JOUR_ARRET_ACCIDENTS,
                                          FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, somme.id_type_activite_arret_travail , COALESCE(tmp.nb,0),COALESCE(somme.SUMM,0),1, NOW(), 'APA2CONS'
	FROM(	 
		 SELECT 
		 aaaN.id_type_activite_arret_travail, SUM(COALESCE(aaaN.NB_JOURABSE, 0)) AS SUMM
      	FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
											AND aaaN.id_type_activite_arret_travail IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                      AND rma.CD_DGCL IN ('3', # Pour accidents du travail imputables au service
                                                          '4') # Pour accidents du travail imputables au trajet
         	WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu
      GROUP BY aaaN.id_type_activite_arret_travail
			) somme 
			LEFT JOIN (SELECT aaaN1.id_type_activite_arret_travail, COUNT(COALESCE(aaaN1.ID_ABSEARREAGEN,0)) AS nb
					FROM bilan_social_agent AS bsa1
        			JOIN enquete enq1 ON bsa1.ID_ENQU = enq1.ID_ENQU
        			JOIN absence_arret_agent AS aaaN1 ON bsa1.ID_BILASOCIAGEN = aaaN1.ID_BILASOCIAGEN
                                           AND aaaN1.ANNEE_EVENEMENT = enq1.NM_ANNE     # 2017
											AND aaaN1.id_type_activite_arret_travail IS NOT NULL
        		JOIN ref_motif_absence rma1 ON aaaN1.ID_MOTIABSE = rma1.ID_MOTIABSE
                                      AND rma1.CD_DGCL IN ('3', '4')
                                      WHERE bsa1.ID_COLL = idColl
            AND bsa1.ID_ENQU = idEnqu
                                      GROUP BY aaaN1.id_type_activite_arret_travail
         ) AS tmp ON somme.id_type_activite_arret_travail = tmp.id_type_activite_arret_travail
;
      

        SELECT 
            COUNT(aaaN.ID_ABSEARREAGEN), 
            SUM(IFNULL(aaaN.NB_JOURABSE, 0))
        INTO vNB_ACCIDENTS_SURVENUS, vNB_JOUR_ARRET_ACCIDENTS
        FROM bilan_social_agent AS bsa
            JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
            JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN 
				#AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE 
				AND aaaN.id_type_activite_arret_travail IS NOT NULL
            JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE AND rma.CD_DGCL IN ('3', '4')
        WHERE bsa.ID_COLL = idColl AND bsa.ID_ENQU = idEnqu;
       

        IF vNB_ACCIDENTS_SURVENUS > 0 OR vNB_JOUR_ARRET_ACCIDENTS > 0 THEN
            UPDATE bilan_social_consolide SET BL_INCO_RASSCT_NB_ACCIDENT_TRAVAIL = '4', MOYENNE_RASSCT_NB_ACCIDENT_TRAVAIL = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
        END IF;




    #
    # Par nature des lésions
    #
    DELETE FROM bsc_rassct_nature_lesion
    WHERE ID_BILASOCICONS = idBilaSociCons;

    # Comptage
    INSERT INTO bsc_rassct_nature_lesion (ID_BILASOCICONS,
                                          ID_NATURE_LESION, R_NB_ACCIDENT_SANS_ARRET, R_NB_ACCIDENT_AVEC_ARRET, R_NB_JOUR_ARRET,
                                          FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons,
        aaaN.id_nature_lesion, SUM(IF( aaaN.ANNEE_EVENEMENT = enq.NM_ANNE, CASE aaaN.ACCIDENT_AVEC_ARRET WHEN 0 THEN 1 ELSE 0 END, 0)) AS nbAccidentAvecArret2017,  SUM( IF( aaaN.ANNEE_EVENEMENT = enq.NM_ANNE,CASE aaaN.ACCIDENT_AVEC_ARRET WHEN 0 THEN 0 ELSE 1 END,0)) AS nbAccidentSansArret2017, SUM(IFNULL(aaaN.NB_JOURABSE, 0)),
        1, NOW(), 'APA2CONS'
      FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
                                           # AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE     # 2017
											AND aaaN.id_nature_lesion IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                      AND rma.CD_DGCL IN ('3', # Pour accidents du travail imputables au service
                                                          '4') # Pour accidents du travail imputables au trajet
      WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu
      GROUP BY aaaN.id_nature_lesion;

        SELECT 
            SUM(CASE aaaN.ACCIDENT_AVEC_ARRET WHEN 0 THEN 1 ELSE 0 END), 
            SUM(CASE aaaN.ACCIDENT_AVEC_ARRET WHEN 0 THEN 0 ELSE 1 END), 
            SUM(IFNULL(aaaN.NB_JOURABSE, 0))
        INTO vACCIDENT_AVEC_ARRET_NATURE_LESION, vACCIDENT_SANS_ARRET_NATURE_LESION, vNB_JOURABSE_NATURE_LESION
        FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN 
		  #AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE     # 2017
											AND aaaN.id_nature_lesion IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                      AND rma.CD_DGCL IN ('3', # Pour accidents du travail imputables au service
                                                          '4') # Pour accidents du travail imputables au trajet
        WHERE bsa.ID_COLL = idColl AND bsa.ID_ENQU = idEnqu;
       

        IF vACCIDENT_AVEC_ARRET_NATURE_LESION > 0 OR vACCIDENT_SANS_ARRET_NATURE_LESION > 0 OR vNB_JOURABSE_NATURE_LESION > 0 THEN
            UPDATE bilan_social_consolide SET BL_INCO_RASSCT_NATURE_LESION = '4', MOYENNE_RASSCT_NATURE_LESION = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
        END IF;
    #
    # Par siège des lésions
    #
    DELETE FROM bsc_rassct_siege_lesion
    WHERE ID_BILASOCICONS = idBilaSociCons;

    # Comptage
    INSERT INTO bsc_rassct_siege_lesion (ID_BILASOCICONS,ID_SIEGE_LESION, R_NB_ACCIDENT, R_NB_JOUR_ARRET,
                                          FG_STAT, DT_CREA, CD_UTILCREA)
     SELECT idBilaSociCons, somme.id_siege_lesion , COALESCE(tmp.nb,0),COALESCE(somme.SUMM,0),1, NOW(), 'APA2CONS'
	FROM(	 
		 SELECT 
		 aaaN.id_siege_lesion, SUM(COALESCE(aaaN.NB_JOURABSE, 0)) AS SUMM
      	FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
											AND aaaN.id_siege_lesion IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                      AND rma.CD_DGCL IN ('3', # Pour accidents du travail imputables au service
                                                          '4') # Pour accidents du travail imputables au trajet
         	WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu
      GROUP BY aaaN.id_siege_lesion
			) somme 
			LEFT JOIN (SELECT aaaN1.id_siege_lesion, COUNT(COALESCE(aaaN1.ID_ABSEARREAGEN,0)) AS nb
					FROM bilan_social_agent AS bsa1
        			JOIN enquete enq1 ON bsa1.ID_ENQU = enq1.ID_ENQU
        			JOIN absence_arret_agent AS aaaN1 ON bsa1.ID_BILASOCIAGEN = aaaN1.ID_BILASOCIAGEN
                                           AND aaaN1.ANNEE_EVENEMENT = enq1.NM_ANNE     # 2017
											AND aaaN1.id_siege_lesion IS NOT NULL
        		JOIN ref_motif_absence rma1 ON aaaN1.ID_MOTIABSE = rma1.ID_MOTIABSE
                                      AND rma1.CD_DGCL IN ('3', '4')
                                      WHERE bsa1.ID_COLL = idColl
            AND bsa1.ID_ENQU = idEnqu
                                      GROUP BY aaaN1.id_siege_lesion
         ) AS tmp ON somme.id_siege_lesion = tmp.id_siege_lesion;
      
    SELECT 
        COUNT(aaaN.ID_ABSEARREAGEN), 
        SUM(IFNULL(aaaN.NB_JOURABSE, 0))
        INTO vNB_ACCIDENT_SIEGE_LESION, vNB_JOURABSE_SIEGE_LESION
        FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
		  # AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE     # 2017
											AND aaaN.id_nature_lesion IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                      AND rma.CD_DGCL IN ('3', # Pour accidents du travail imputables au service
                                                          '4') # Pour accidents du travail imputables au trajet
        WHERE bsa.ID_COLL = idColl AND bsa.ID_ENQU = idEnqu;
       
        IF vNB_ACCIDENT_SIEGE_LESION > 0 OR vNB_JOURABSE_SIEGE_LESION > 0 THEN
            UPDATE bilan_social_consolide SET BL_INCO_RASSCT_SIEGE_LESION = '4', MOYENNE_RASSCT_SIEGE_LESION = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
        END IF;


    #
    # Par éléments matériels
    #
    DELETE FROM bsc_rassct_element_materiel
    WHERE ID_BILASOCICONS = idBilaSociCons;
    
    # Comptage
  INSERT INTO bsc_rassct_element_materiel (ID_BILASOCICONS,
                                         ID_ELEMENT_MATERIEL, R_NB_ACCIDENT, R_NB_JOUR_ARRET,
                                         FG_STAT, DT_CREA, CD_UTILCREA)
      SELECT idBilaSociCons, somme.id_element_materiel , COALESCE(tmp.nb,0),COALESCE(somme.SUMM,0),1, NOW(), 'APA2CONS'
	FROM(	 
		 SELECT 
		 aaaN.id_element_materiel, SUM(COALESCE(aaaN.NB_JOURABSE, 0)) AS SUMM
      	FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
											AND aaaN.id_element_materiel IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE
                                      AND rma.CD_DGCL IN ('3', # Pour accidents du travail imputables au service
                                                          '4') # Pour accidents du travail imputables au trajet
         	WHERE bsa.ID_COLL = idColl
            AND bsa.ID_ENQU = idEnqu
      GROUP BY aaaN.id_element_materiel
			) somme 
			LEFT JOIN (SELECT aaaN1.id_element_materiel, COUNT(COALESCE(aaaN1.ID_ABSEARREAGEN,0)) AS nb
					FROM bilan_social_agent AS bsa1
        			JOIN enquete enq1 ON bsa1.ID_ENQU = enq1.ID_ENQU
        			JOIN absence_arret_agent AS aaaN1 ON bsa1.ID_BILASOCIAGEN = aaaN1.ID_BILASOCIAGEN
                                           AND aaaN1.ANNEE_EVENEMENT = enq1.NM_ANNE     # 2017
											AND aaaN1.id_element_materiel IS NOT NULL
        		JOIN ref_motif_absence rma1 ON aaaN1.ID_MOTIABSE = rma1.ID_MOTIABSE
                                      AND rma1.CD_DGCL IN ('3', '4')
                                      WHERE bsa1.ID_COLL = idColl
            AND bsa1.ID_ENQU = idEnqu
                                      GROUP BY aaaN1.id_element_materiel
         ) AS tmp ON somme.id_element_materiel = tmp.id_element_materiel
;

    SELECT 
        COUNT(aaaN.ID_ABSEARREAGEN), 
        SUM(IFNULL(aaaN.NB_JOURABSE, 0))
    INTO vNB_ACCIDENT_ELEMENT_MATERIEL, vNB_JOURABSE_ELEMENT_MATERIEL
    FROM bilan_social_agent AS bsa
        JOIN enquete enq ON bsa.ID_ENQU = enq.ID_ENQU
        JOIN absence_arret_agent AS aaaN ON bsa.ID_BILASOCIAGEN = aaaN.ID_BILASOCIAGEN
		   #AND aaaN.ANNEE_EVENEMENT = enq.NM_ANNE 
			AND aaaN.id_element_materiel IS NOT NULL
        JOIN ref_motif_absence rma ON aaaN.ID_MOTIABSE = rma.ID_MOTIABSE AND rma.CD_DGCL IN ('3','4') 
    WHERE bsa.ID_COLL = idColl AND bsa.ID_ENQU = idEnqu;
       
    IF vNB_ACCIDENT_ELEMENT_MATERIEL > 0 OR vNB_JOURABSE_ELEMENT_MATERIEL > 0 THEN
        UPDATE bilan_social_consolide SET BL_INCO_RASSCT_ELEMENT_MATERIEL = '4', MOYENNE_RASSCT_ELEMENT_MATERIEL = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;
  END
$$
