DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_gpeec
$$

CREATE PROCEDURE apa2cons_gpeec(idBilaSociCons INT, idColl INT, idEnqu INT)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	/* Variable niveau de diplome */
	DECLARE vNbFemmes INT;
	DECLARE vNbHommes INT;
	/* Variable gpeec plus nbagents par spe et age */
	DECLARE vNbagents_gpeec_plus1 INT;
	DECLARE vNbagents_gpeec_plus2 INT;
	DECLARE vNbagents_gpeec_plus3 INT;
	DECLARE vNbagents_gpeec_plus4 INT;
	DECLARE vNbagents_gpeec_plus5 INT;
	DECLARE vNbagents_gpeec_plus6 INT;
	DECLARE vNbagents_gpeec_plus7 INT;
	DECLARE vNbagents_gpeec_plus8 INT;
	DECLARE vNbagents_gpeec_plus9 INT;
	DECLARE vNbagents_gpeec_plus10 INT;
	/* Variable gpeec plus nbagents par fonc et age */
	DECLARE vNbagents_gpeec1 INT;
	DECLARE vNbagents_gpeec2 INT;
	DECLARE vNbagents_gpeec3 INT;
	DECLARE vNbagents_gpeec4 INT;
	DECLARE vNbagents_gpeec5 INT;
	DECLARE vNbagents_gpeec6 INT;
	DECLARE vNbagents_gpeec7 INT;
	DECLARE vNbagents_gpeec8 INT;
	DECLARE vNbagents_gpeec9 INT;
	DECLARE vNbagents_gpeec10 INT;
	
	
  ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_gpeec_m;
  CREATE TEMPORARY TABLE temp_apa2cons_gpeec_m
    ENGINE = MEMORY
    AS (
      SELECT        
		CASE WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) < 25 
				THEN 1
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 25 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 29
				THEN 2
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 30
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 34
				THEN 3
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 35 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 39
				THEN 4
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 40 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 44
				THEN 5
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 45 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 49
				THEN 6
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 50 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 54
				THEN 7
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 55 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 59
				THEN 8
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 60 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 64
				THEN 9
			 ELSE 10 END AS ID_TRANAGE,
			 count(DISTINCT bsa.ID_BILASOCIAGEN) AS NB_FONC,
			 bsag.ID_METIER
      FROM bilan_social_agent AS bsa
        JOIN bilan_social_agent_gpeec AS bsag ON bsag.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
		AND bsa.LB_DATENAIS IS NOT NULL
	  GROUP BY bsa.lb_datenais, bsag.ID_METIER
		
    );
	

  ### Remplissage 
  INSERT INTO bsc_gpeec_nb_agents_titu_emp_perma_par_fonc_et_age (ID_BILASOCICONS,ID_METIER,R_NB_1,R_NB_2,R_NB_3,R_NB_4,R_NB_5,R_NB_6,R_NB_7,R_NB_8,R_NB_9,R_NB_10)
  SELECT idBilaSociCons, ma.ID_METIER, 
    SUM(CASE WHEN t.ID_TRANAGE = 1 THEN t.NB_FONC ELSE 0 END) AS R_NB_1,
	SUM(CASE WHEN t.ID_TRANAGE = 2 THEN t.NB_FONC ELSE 0 END) AS R_NB_2,
	SUM(CASE WHEN t.ID_TRANAGE = 3 THEN t.NB_FONC ELSE 0 END) AS R_NB_3,
	SUM(CASE WHEN t.ID_TRANAGE = 4 THEN t.NB_FONC ELSE 0 END) AS R_NB_4,
	SUM(CASE WHEN t.ID_TRANAGE = 5 THEN t.NB_FONC ELSE 0 END) AS R_NB_5,
	SUM(CASE WHEN t.ID_TRANAGE = 6 THEN t.NB_FONC ELSE 0 END) AS R_NB_6,
	SUM(CASE WHEN t.ID_TRANAGE = 7 THEN t.NB_FONC ELSE 0 END) AS R_NB_7,
	SUM(CASE WHEN t.ID_TRANAGE = 8 THEN t.NB_FONC ELSE 0 END) AS R_NB_8,
	SUM(CASE WHEN t.ID_TRANAGE = 9 THEN t.NB_FONC ELSE 0 END) AS R_NB_9,
	SUM(CASE WHEN t.ID_TRANAGE = 10 THEN t.NB_FONC ELSE 0 END) AS R_NB_10    
  FROM ref_metier ma 
  LEFT JOIN temp_apa2cons_gpeec_m t on t.ID_METIER = ma.ID_METIER
  GROUP BY idBilaSociCons, ma.ID_METIER
  ORDER BY ma.ID_METIER;
  
  SELECT
        SUM(CASE WHEN t.ID_TRANAGE = 1 THEN t.NB_FONC ELSE 0 END) AS R_NB_1,
	SUM(CASE WHEN t.ID_TRANAGE = 2 THEN t.NB_FONC ELSE 0 END) AS R_NB_2,
	SUM(CASE WHEN t.ID_TRANAGE = 3 THEN t.NB_FONC ELSE 0 END) AS R_NB_3,
	SUM(CASE WHEN t.ID_TRANAGE = 4 THEN t.NB_FONC ELSE 0 END) AS R_NB_4,
	SUM(CASE WHEN t.ID_TRANAGE = 5 THEN t.NB_FONC ELSE 0 END) AS R_NB_5,
	SUM(CASE WHEN t.ID_TRANAGE = 6 THEN t.NB_FONC ELSE 0 END) AS R_NB_6,
	SUM(CASE WHEN t.ID_TRANAGE = 7 THEN t.NB_FONC ELSE 0 END) AS R_NB_7,
	SUM(CASE WHEN t.ID_TRANAGE = 8 THEN t.NB_FONC ELSE 0 END) AS R_NB_8,
	SUM(CASE WHEN t.ID_TRANAGE = 9 THEN t.NB_FONC ELSE 0 END) AS R_NB_9,
	SUM(CASE WHEN t.ID_TRANAGE = 10 THEN t.NB_FONC ELSE 0 END) AS R_NB_10

    INTO vNbagents_gpeec1,vNbagents_gpeec2,vNbagents_gpeec3,vNbagents_gpeec4,vNbagents_gpeec5,vNbagents_gpeec6,vNbagents_gpeec7,vNbagents_gpeec8,vNbagents_gpeec9,vNbagents_gpeec10 
    FROM temp_apa2cons_gpeec_m t;
	
    IF vNbagents_gpeec1 > 0 OR vNbagents_gpeec2 > 0 OR vNbagents_gpeec3 > 0 OR vNbagents_gpeec4 > 0 OR vNbagents_gpeec5 > 0 OR vNbagents_gpeec6 > 0 OR vNbagents_gpeec7 > 0 OR vNbagents_gpeec8 > 0 OR vNbagents_gpeec9 > 0 OR vNbagents_gpeec10 > 0 THEN
            UPDATE bilan_social_consolide SET BL_INCO_GPEEC_NB_AGENTS_TIU_EMP_PERMA_PAR_FONC_ET_AGE = '4', MOYENNE_GPEEC_NB_AGENTS_TIU_EMP_PERMA_PAR_FONC_ET_AGE = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;
	
	
	
   ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_gpeec_s;
  CREATE TEMPORARY TABLE temp_apa2cons_gpeec_s
    ENGINE = MEMORY
    AS (
      SELECT        
		CASE WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) < 25 
				THEN 1
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 25 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 29
				THEN 2
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 30
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 34
				THEN 3
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 35 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 39
				THEN 4
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 40 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 44
				THEN 5
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 45 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 49
				THEN 6
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 50 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 54
				THEN 7
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 55 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 59
				THEN 8
			 WHEN   TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) >= 60 
				AND TIMESTAMPDIFF(YEAR, CONVERT(CONCAT(SUBSTRING( bsa.lb_datenais  , 4, 4), CONCAT('-', CONCAT(SUBSTRING('05/1955', 1, 2), '-15'))), DATE ), CURDATE()) <= 64
				THEN 9
			 ELSE 10 END AS ID_TRANAGE,
			 count(DISTINCT bsa.ID_BILASOCIAGEN) AS NB_FONC,
			 bsagp.ID_SPECIALITE
      FROM bilan_social_agent AS bsa
        JOIN bilan_social_agent_gpeec_plus AS bsagp ON bsagp.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
		AND bsa.LB_DATENAIS IS NOT NULL
	  GROUP BY bsa.lb_datenais, bsagp.ID_SPECIALITE
		
    );
	

  ### Remplissage 
  INSERT INTO bsc_gpeec_plus_nb_agents_par_spe_et_age (ID_BILASOCICONS,ID_SPECIALITE,R_NB_1,R_NB_2,R_NB_3,R_NB_4,R_NB_5,R_NB_6,R_NB_7,R_NB_8,R_NB_9,R_NB_10)
  SELECT idBilaSociCons, ma.ID_SPECIALITE, 
    SUM(CASE WHEN t.ID_TRANAGE = 1 THEN t.NB_FONC ELSE 0 END) AS R_NB_1,
	SUM(CASE WHEN t.ID_TRANAGE = 2 THEN t.NB_FONC ELSE 0 END) AS R_NB_2,
	SUM(CASE WHEN t.ID_TRANAGE = 3 THEN t.NB_FONC ELSE 0 END) AS R_NB_3,
	SUM(CASE WHEN t.ID_TRANAGE = 4 THEN t.NB_FONC ELSE 0 END) AS R_NB_4,
	SUM(CASE WHEN t.ID_TRANAGE = 5 THEN t.NB_FONC ELSE 0 END) AS R_NB_5,
	SUM(CASE WHEN t.ID_TRANAGE = 6 THEN t.NB_FONC ELSE 0 END) AS R_NB_6,
	SUM(CASE WHEN t.ID_TRANAGE = 7 THEN t.NB_FONC ELSE 0 END) AS R_NB_7,
	SUM(CASE WHEN t.ID_TRANAGE = 8 THEN t.NB_FONC ELSE 0 END) AS R_NB_8,
	SUM(CASE WHEN t.ID_TRANAGE = 9 THEN t.NB_FONC ELSE 0 END) AS R_NB_9,
	SUM(CASE WHEN t.ID_TRANAGE = 10 THEN t.NB_FONC ELSE 0 END) AS R_NB_10    
  FROM ref_specialite ma 
  LEFT JOIN temp_apa2cons_gpeec_s t on t.ID_SPECIALITE = ma.ID_SPECIALITE
  GROUP BY idBilaSociCons, ma.ID_SPECIALITE
  ORDER BY ma.ID_SPECIALITE;
  
  
  
  SELECT 	SUM(CASE WHEN t.ID_TRANAGE = 1 THEN t.NB_FONC ELSE 0 END) AS R_NB_1,
			SUM(CASE WHEN t.ID_TRANAGE = 2 THEN t.NB_FONC ELSE 0 END) AS R_NB_2,
			SUM(CASE WHEN t.ID_TRANAGE = 3 THEN t.NB_FONC ELSE 0 END) AS R_NB_3,
			SUM(CASE WHEN t.ID_TRANAGE = 4 THEN t.NB_FONC ELSE 0 END) AS R_NB_4,
			SUM(CASE WHEN t.ID_TRANAGE = 5 THEN t.NB_FONC ELSE 0 END) AS R_NB_5,
			SUM(CASE WHEN t.ID_TRANAGE = 6 THEN t.NB_FONC ELSE 0 END) AS R_NB_6,
			SUM(CASE WHEN t.ID_TRANAGE = 7 THEN t.NB_FONC ELSE 0 END) AS R_NB_7,
			SUM(CASE WHEN t.ID_TRANAGE = 8 THEN t.NB_FONC ELSE 0 END) AS R_NB_8,
			SUM(CASE WHEN t.ID_TRANAGE = 9 THEN t.NB_FONC ELSE 0 END) AS R_NB_9,
			SUM(CASE WHEN t.ID_TRANAGE = 10 THEN t.NB_FONC ELSE 0 END) AS R_NB_10
		  INTO vNbagents_gpeec_plus1,vNbagents_gpeec_plus2,vNbagents_gpeec_plus3,vNbagents_gpeec_plus4,vNbagents_gpeec_plus5,vNbagents_gpeec_plus6,vNbagents_gpeec_plus7,vNbagents_gpeec_plus8,vNbagents_gpeec_plus9,vNbagents_gpeec_plus10 
    FROM temp_apa2cons_gpeec_s t;
	
	IF vNbagents_gpeec_plus1 > 0 OR vNbagents_gpeec_plus2 > 0 OR vNbagents_gpeec_plus3 > 0 OR vNbagents_gpeec_plus4 > 0 OR vNbagents_gpeec_plus5 > 0 OR vNbagents_gpeec_plus6 > 0 OR vNbagents_gpeec_plus7 > 0 OR vNbagents_gpeec_plus8 > 0 OR vNbagents_gpeec_plus9 > 0 OR vNbagents_gpeec_plus10 > 0 THEN
		UPDATE bilan_social_consolide SET BL_INCO_GPEEC_PLUS_NB_AGENTS_PAR_SPE_ET_AGE = '4', MOYENNE_GPEEC_PLUS_NB_AGENTS_PAR_SPE_ET_AGE = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
	END IF;
  



 ### Création et remplissage de la table temporaire
  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_gpeec_domaine_diplome;
  CREATE TEMPORARY TABLE temp_apa2cons_gpeec_domaine_diplome
    ENGINE = MEMORY
    AS (
      SELECT        
		COALESCE(bsa.CD_SEXE, '-1') AS Q1,
                bsag.ID_DOMAINE_DIPLOME_GPEEC AS domaine_diplome
      FROM bilan_social_agent AS bsa
        JOIN bilan_social_agent_gpeec AS bsag ON bsag.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
        AND bsag.ID_DOMAINE_DIPLOME_GPEEC IS NOT NULL
		
    );

   INSERT INTO bsc_gpeec_niveau_diplome (ID_BILASOCICONS, ID_DOMAINE_DIPLOME, nbHommes, nbFemmes, DT_CREA, CD_UTILCREA)
    SELECT idBilaSociCons, 
           t.domaine_diplome,
          SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS nbHommes,
          SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS nbFemmes,
          NOW(),
          'apa2cons'
    FROM temp_apa2cons_gpeec_domaine_diplome t
    GROUP BY t.domaine_diplome;
	
	/* Gestion des bl inco et des moyennes */
	SELECT SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS nbHommes,
          SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS nbFemmes
		  INTO vNbFemmes, vNbHommes
    FROM temp_apa2cons_gpeec_domaine_diplome t;
	
	IF vNbFemmes > 0 OR vNbHommes > 0 THEN
		UPDATE bilan_social_consolide SET BL_INCO_GPEEC_NIVEAU_DIPLOME = '4', MOYENNE_GPEEC_NIVEAU_DIPLOME = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
	END IF;
	
	
 
END
$$

