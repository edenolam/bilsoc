DELIMITER $$

DROP PROCEDURE IF EXISTS apa2cons_handitorial
$$
CREATE PROCEDURE `apa2cons_handitorial`(
	IN `idBilaSociCons` INT,
	IN `idColl` INT,
	IN `idEnqu` INT
)
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN

	declare vQA17 varchar(50);
	declare vQA3 tinyint(1);
	
	declare vQA511 int(11);
	declare vQA512 int(11);
	declare vQA513 int(11);
	declare vQA521 int(11);
	declare vQA522 int(11);
	declare vQA523 int(11);
	
	declare vQA6 tinyint(1);
	declare vRA61 int(11);
	
	declare vQA62 int(11);
	
	declare vQA7 tinyint(1);
	declare vRA71 int(11);
	
	declare vQA72 int(11);
	
	declare vQA8 tinyint(1);
	declare vRA81 int(11);
	
	declare vQA82 int(11);
	
	declare vRA9 int(11);
	declare vRA91 int(11);
	declare vRA10 int(11);
	declare vRA101 int(11);

	declare countQHandiB22 int(11);
	declare countQHandiB23 int(11);
	declare countQHandiB41A int(11);

        declare vCATEGORIE_H int(11);
	declare vCATEGORIE_F int(11);

        declare vNATURE_HANDICAP_H int(11);
	declare vNATURE_HANDICAP_F int(11);

        declare vMODE_ENTREE_H int(11);
	declare vMODE_ENTREE_F int(11);

        declare vSTATUT_AGENT_H int(11);
	declare vSTATUT_AGENT_F int(11);

	declare vDERNIER_DIPLOME_H int(11);
	declare vDERNIER_DIPLOME_F int(11);

	declare vMODE_SORTIE_TITULAIRE_H int(11);
	declare vMODE_SORTIE_TITULAIRE_F int(11);

	declare vARTICLE_H int(11);
	declare vARTICLE_F int(11);

	declare vMODE_SORTIE_NON_TITULAIRE_H int(11);
	declare vMODE_SORTIE_NON_TITULAIRE_F int(11);

	declare vAVIS_INAPTITUDE_H int(11);
	declare vAVIS_INAPTITUDE_F int(11);

	declare vMESURE_INAPTITUDE_H int(11);
	declare vMESURE_INAPTITUDE_F int(11);

	declare vAVIS_INAPTITUDE_AVANT_H int(11);
	declare vAVIS_INAPTITUDE_AVANT_F int(11);


	declare vMESURE_INAPTITUDE_AVANT_H int(11);
	declare vMESURE_INAPTITUDE_AVANT_F int(11);

	declare vMOINS_UN_AN_H int(11);
	declare vMOINS_UN_AN_F int(11);
	declare vENTRE_UN_ET_TROIS_H int(11);
	declare vENTRE_UN_ET_TROIS_F int(11);
	declare vENTRE_QUATRE_ET_SIX_H int(11);
	declare vENTRE_QUATRE_ET_SIX_F int(11);
	declare vENTRE_SEPT_ET_DOUZE_H int(11);
	declare vENTRE_SEPT_ET_DOUZE_F int(11);
	declare vPLUS_DOUZE_H int(11);
	declare vPLUS_DOUZE_F int(11);

	declare vCADRE_EMPLOI_H int(11);
	declare vCADRE_EMPLOI_F int(11);

	declare vMETIER_H int(11);
	declare vMETIER_F int(11);

	declare vTEMPS_COMPLET_H int(11);
	declare vTEMPS_COMPLET_F int(11);
	declare vTEMPS_NON_COMPLET_H int(11);
	declare vTEMPS_NON_COMPLET_F int(11);
        
	declare vTEMPS_PLEIN_H int(11);
	declare vTEMPS_PLEIN_F int(11);
	declare vTEMPS_PARTIEL_H int(11);
	declare vTEMPS_PARTIEL_F int(11);



	SELECT 
		HAND_OBLI_EMPL_TRAV, 
		HAND_MESURE_AMENA_POSTE_COND_TRAV, 
		HAND_NB_MESURE_AMENA_POSTE_COND_TRAV,
		HAND_MESURE_CHANG_AFFEC,
		HAND_NB_MESURE_CHANG_AFFEC,
		HAND_DISPO_OFFICE,
		HAND_NB_DISPO_OFFICE,
		HAND_NB_RECLA_DEMANDE,
		HAND_NB_DEM_RECLA_INAP_ACCI_TRAV_MALADIE_PRO,
		HAND_NB_RECLA_REAL,
		HAND_NB_REA_RECLA_INAP_ACCI_TRAV_MALADIE_PRO,
		HAND_MAIL_CORRES,
		HAND_NB_AVIS_INAP_TEMPO,
		HAND_NB_AVIS_INAP_DEF,
		HAND_NB_AVIS_INAP_DEF_TOUTES_FONCTIONS,
		HAND_NB_RECLA,
		HAND_NB_RETRAITE_INVAL,
		HAND_NB_LICENC_INAP_PHYSI,
		HAND_NB_MESURE_AMENA_POSTE_COND_TRAV_BOETH,
		HAND_NB_MESURE_CHANG_AFFEC_BOETH,
		HAND_NB_DISPO_OFFICE_BOETH
		
	INTO vQA3, vQA6, vRA61, vQA7, vRA71, vQA8, vRA81, vRA9, vRA91, vRA10, vRA101, vQA17,vQA511,vQA512,vQA513,vQA521,vQA522,vQA523,vQA62,vQA72,vQA82
	FROM information_colectivite_agent
	WHERE ID_COLL = idColl
	AND ID_ENQU = idEnqu;

	INSERT INTO bsc_handitorial_questions_generales (Q_A3, Q_A6, R_A61, Q_A7, R_A71, Q_A8, R_A81, R_A9, R_A91, R_A10, R_A101,Q_A17, Q_A511,	Q_A512,	Q_A513,	Q_A521,	Q_A522,	Q_A523,	Q_A62,	Q_A72,Q_A82,ID_BILASOCICONS)
	VALUES (vQA3, vQA6, vRA61, vQA7, vRA71, vQA8, vRA81, vRA9, vRA91, vRA10, vRA101, vQA17,vQA511,vQA512,vQA513,vQA521,vQA522,vQA523,vQA62,vQA72,vQA82,idBilaSociCons);
        SELECT vQA3, vQA6, vRA61, vQA7, vRA71, vQA8, vRA81, vRA9, vRA91, vRA10, vRA101,vQA17,vQA511,vQA512,vQA513,vQA521,vQA522,vQA523,vQA62,vQA72,vQA82;
    IF 
	vQA3 IS NOT NULL OR
	vQA6 IS NOT NULL OR
	vRA61 IS NOT NULL OR
	vQA7 IS NOT NULL OR
	vRA71 IS NOT NULL OR
	vQA8 IS NOT NULL OR
	vRA81 IS NOT NULL OR
	vRA9 IS NOT NULL OR
	vRA91 IS NOT NULL OR
	vRA10 IS NOT NULL OR
	vRA101 IS NOT NULL OR
	vQA17 IS NOT NULL OR
	vQA511 IS NOT NULL OR
	vQA512 IS NOT NULL OR
	vQA513 IS NOT NULL OR
	vQA521 IS NOT NULL OR
	vQA522 IS NOT NULL OR
	vQA523 IS NOT NULL OR
	vQA62 IS NOT NULL OR
	vQA72 IS NOT NULL OR
	vQA82 IS NOT NULL
	THEN
            UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_GENERALES = '4', MOYENNE_HANDITORIAL_QUESTIONS_GENERALES = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;



	SELECT COUNT(bl_avis_inaptitude_en_cours) INTO countQHandiB22
	FROM Bilan_Social_Agent_Handitorial bh
    JOIN bilan_social_agent b ON b.ID_BILASOCIAGEN = bh.ID_BILASOCIAGEN
    WHERE bl_avis_inaptitude_en_cours = 1
    AND b.ID_COLL = idColl
    AND b.ID_ENQU = idEnqu
    GROUP BY bl_avis_inaptitude_en_cours;

	SELECT COUNT(bl_avis_inaptitude_avant) INTO countQHandiB23
	FROM Bilan_Social_Agent_Handitorial bh
    JOIN bilan_social_agent b ON b.ID_BILASOCIAGEN = bh.ID_BILASOCIAGEN
    WHERE bl_avis_inaptitude_avant = 1
    AND b.ID_COLL = idColl
    AND b.ID_ENQU = idEnqu
    GROUP BY bl_avis_inaptitude_avant;

	SELECT COUNT(BL_AGENTITUSTAGANNE) INTO countQHandiB41A
	FROM bilan_social_agent b
    WHERE BL_AGENTITUSTAGANNE = 1
    AND b.ID_COLL = idColl
    AND b.ID_ENQU = idEnqu
    GROUP BY BL_AGENTITUSTAGANNE;


	UPDATE bilan_social_consolide
	SET Q_HANDI_B22 = (CASE WHEN countQHandiB22 > 0 THEN 1 ELSE 0 END),
	Q_HANDI_B23 = (CASE WHEN countQHandiB23 > 0 THEN 1 ELSE 0 END),
	Q_HANDI_B41A = (CASE WHEN countQHandiB41A > 0 THEN 1 ELSE 0 END)
	WHERE ID_BILASOCICONS = idBilaSociCons;

    IF countQHandiB22 > 0 OR countQHandiB23 > 0 OR countQHandiB41A > 0 THEN
            UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
    END IF;
        
  ### Création et remplissage de la table temporaire

  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_categorie_boeth;
  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_categorie_boeth (INDEX(Q1))
    ENGINE = MEMORY
	AS (
      SELECT
        bsa.CD_SEXE AS Q1,
		bsah.id_categorie_boeth AS Q17_1
      FROM bilan_social_agent AS bsa
		JOIN Bilan_Social_Agent_Handitorial AS bsah ON bsah.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
      WHERE bsa.ID_COLL = idColl
        AND bsa.ID_ENQU = idEnqu
		AND bsa.BL_BOETH = 1
    );

	  ### Remplissage de handitorial categorie boeth
	  INSERT INTO bsc_handitorial_questions_boeths (ID_BILASOCICONS, ID_CATEGORIE_BOETH, CATEGORIE_H, CATEGORIE_F)
	  SELECT idBilaSociCons,  cb.ID_CATEGORIE_BOETH,
		  SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS CATEGORIE_H,
		  SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS CATEGORIE_F
	  FROM ref_categorie_boeth cb
		LEFT JOIN temp_apa2cons_handitorial_categorie_boeth t ON cb.ID_CATEGORIE_BOETH = t.Q17_1
	  WHERE cb.bl_vali = 0
	  GROUP BY idBilaSociCons, cb.ID_CATEGORIE_BOETH
	  ORDER BY cb.ID_CATEGORIE_BOETH;

        SELECT
            SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vCATEGORIE_H,
            SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vCATEGORIE_F
        INTO vCATEGORIE_H,vCATEGORIE_F
        FROM ref_categorie_boeth cb
            LEFT JOIN temp_apa2cons_handitorial_categorie_boeth t ON cb.ID_CATEGORIE_BOETH = t.Q17_1
        WHERE cb.bl_vali = 0;

        IF vCATEGORIE_H > 0 OR vCATEGORIE_F > 0 THEN
            UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
        END IF;




	  ### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_nature_handicaps;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_nature_handicaps (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
		  bsah.id_nature_handicap_boeth AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN Bilan_Social_Agent_Handitorial AS bsah ON bsah.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial nature handicap boeth
		INSERT INTO bsc_handitorial_nature_handicaps (ID_BILASOCICONS, ID_NATURE_HANDICAP_BOETH, NATURE_HANDICAP_H, NATURE_HANDICAP_F)
		SELECT idBilaSociCons,  nhb.ID_NATURE_HANDICAP_BOETH,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS NATURE_HANDICAP_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS NATURE_HANDICAP_F
		FROM ref_nature_handicap_boeth nhb
		  LEFT JOIN temp_apa2cons_handitorial_nature_handicaps t ON nhb.ID_NATURE_HANDICAP_BOETH = t.Q17_1
		WHERE nhb.bl_vali = 0
		GROUP BY idBilaSociCons, nhb.ID_NATURE_HANDICAP_BOETH
		ORDER BY nhb.ID_NATURE_HANDICAP_BOETH;
                

            SELECT
                SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vNATURE_HANDICAP_H,
                SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vNATURE_HANDICAP_F
            INTO vCATEGORIE_H,vCATEGORIE_F
            FROM ref_nature_handicap_boeth nhb
		  LEFT JOIN temp_apa2cons_handitorial_nature_handicaps t ON nhb.ID_NATURE_HANDICAP_BOETH = t.Q17_1
            WHERE nhb.bl_vali = 0;

            IF vNATURE_HANDICAP_H > 0 OR vNATURE_HANDICAP_F > 0 THEN
                UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
            END IF;


                
		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_mode_entree;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_mode_entree (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
		  bsa.ID_MOTIARRI AS Q17_1
		  FROM bilan_social_agent AS bsa
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial mode entree
		INSERT INTO bsc_handitorial_mode_entrees (ID_BILASOCICONS, ID_MOTIARRI, MODE_ENTREE_H, MODE_ENTREE_F)
		SELECT idBilaSociCons,  rma.ID_MOTIARRI,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS MODE_ENTREE_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS MODE_ENTREE_F
		FROM ref_motif_arrivee rma
		  LEFT JOIN temp_apa2cons_handitorial_mode_entree t ON rma.ID_MOTIARRI = t.Q17_1
		WHERE rma.bl_vali = 0
		GROUP BY idBilaSociCons, rma.ID_MOTIARRI
		ORDER BY rma.ID_MOTIARRI;

        SELECT
            SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vMODE_ENTREE_H,
            SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vMODE_ENTREE_F
        INTO vMODE_ENTREE_H,vMODE_ENTREE_F
        FROM ref_motif_arrivee rma
            LEFT JOIN temp_apa2cons_handitorial_mode_entree t ON rma.ID_MOTIARRI = t.Q17_1
        WHERE rma.bl_vali = 0;

        IF vMODE_ENTREE_H > 0 OR vMODE_ENTREE_F > 0 THEN
            UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
        END IF;

		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_statut;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_statut (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
		  	bsa.ID_STAT AS Q17_1
		  FROM bilan_social_agent AS bsa
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial statut
		INSERT INTO bsc_handitorial_statut_agents (ID_BILASOCICONS, ID_STAT, STATUT_AGENT_H, STATUT_AGENT_F)
		SELECT idBilaSociCons,  rs.ID_STAT,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS STATUT_AGENT_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS STATUT_AGENT_F
		FROM ref_statut rs
		  LEFT JOIN temp_apa2cons_handitorial_statut t ON rs.ID_STAT = t.Q17_1
		WHERE rs.bl_vali = 0
		GROUP BY idBilaSociCons, rs.ID_STAT
		ORDER BY rs.ID_STAT;
                
            SELECT
                SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vSTATUT_AGENT_H,
                SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vSTATUT_AGENT_F
            INTO vSTATUT_AGENT_H,vSTATUT_AGENT_F
            FROM ref_statut rs
		  LEFT JOIN temp_apa2cons_handitorial_statut t ON rs.ID_STAT = t.Q17_1
            WHERE rs.bl_vali = 0;

            IF vSTATUT_AGENT_H > 0 OR vSTATUT_AGENT_F > 0 THEN
                UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
            END IF;
                
		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_derniers_diplomes;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_derniers_diplomes (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			bsag.id_domaine_diplome_gpeec AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN bilan_social_agent_gpeec AS bsag ON bsag.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial derniers diplomes
		INSERT INTO bsc_handitorial_derniers_diplomes (ID_BILASOCICONS, ID_DOMAINE_DIPLOME, DERNIER_DIPLOME_H, DERNIER_DIPLOME_F)
		SELECT idBilaSociCons,  rdd.ID_DOMAINE_DIPLOME,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS DERNIER_DIPLOME_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS DERNIER_DIPLOME_F
		FROM ref_domaine_diplome rdd
		  LEFT JOIN temp_apa2cons_handitorial_derniers_diplomes t ON rdd.ID_DOMAINE_DIPLOME = t.Q17_1
		WHERE rdd.bl_valide = 0
		GROUP BY idBilaSociCons, rdd.ID_DOMAINE_DIPLOME
		ORDER BY rdd.ID_DOMAINE_DIPLOME;
                
        SELECT
            SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vDERNIER_DIPLOME_H,
            SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vDERNIER_DIPLOME_F
        INTO vDERNIER_DIPLOME_H,vDERNIER_DIPLOME_F 
        FROM ref_domaine_diplome rdd
            LEFT JOIN temp_apa2cons_handitorial_derniers_diplomes t ON rdd.ID_DOMAINE_DIPLOME = t.Q17_1
        WHERE rdd.bl_valide = 0;
            IF vDERNIER_DIPLOME_H > 0 OR vDERNIER_DIPLOME_F > 0 THEN
                UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
            END IF;

		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_mode_sorties_titulaires;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_mode_sorties_titulaires (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			rs.CD_STAT AS Q2,
			bsa.ID_MOTIDEPA AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
			AND rs.CD_STAT = 'TITU'  # Q2
		);

		### Remplissage de handitorial motif départ si titulaire
		INSERT INTO bsc_handitorial_mode_sorties_titulaire (ID_BILASOCICONS, ID_MOTIDEPA, MODE_SORTIE_TITULAIRE_H, MODE_SORTIE_TITULAIRE_F)
		SELECT idBilaSociCons,  rmd.ID_MOTIDEPA,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS MODE_SORTIE_TITULAIRE_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS MODE_SORTIE_TITULAIRE_F
		FROM ref_motif_depart rmd
		  LEFT JOIN temp_apa2cons_handitorial_mode_sorties_titulaires t ON rmd.ID_MOTIDEPA = t.Q17_1
		WHERE rmd.bl_vali = 0
		GROUP BY idBilaSociCons, rmd.ID_MOTIDEPA
		ORDER BY rmd.ID_MOTIDEPA;

                SELECT
                    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vMODE_SORTIE_TITULAIRE_H,
                    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vMODE_SORTIE_TITULAIRE_F
                INTO vMODE_SORTIE_TITULAIRE_H,vMODE_SORTIE_TITULAIRE_F 
                FROM ref_motif_depart rmd
		  LEFT JOIN temp_apa2cons_handitorial_mode_sorties_titulaires t ON rmd.ID_MOTIDEPA = t.Q17_1
                WHERE rmd.bl_vali = 0;
                    IF vMODE_SORTIE_TITULAIRE_H > 0 OR vMODE_SORTIE_TITULAIRE_F > 0 THEN
                        UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                    END IF;


		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_mode_sorties_non_titulaires;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_mode_sorties_non_titulaires (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			rs.CD_STAT AS Q2,
			bsa.ID_MOTIDEPA AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN ref_statut AS rs ON bsa.ID_STAT = rs.ID_STAT  # Q2
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
			AND rs.CD_STAT IN ('STAG', 'CONTPERM', 'CONTNONPERM')  # Q2
		);

		### Remplissage de handitorial motif départ si non titulaire
		INSERT INTO bsc_handitorial_mode_sorties_non_titulaire (ID_BILASOCICONS, ID_MOTIDEPA, MODE_SORTIE_NON_TITULAIRE_H, MODE_SORTIE_NON_TITULAIRE_F)
		SELECT idBilaSociCons,  rmd.ID_MOTIDEPA,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS MODE_SORTIE_NON_TITULAIRE_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS MODE_SORTIE_NON_TITULAIRE_F
		FROM ref_motif_depart rmd
		  LEFT JOIN temp_apa2cons_handitorial_mode_sorties_non_titulaires t ON rmd.ID_MOTIDEPA = t.Q17_1
		WHERE rmd.bl_vali = 0
		GROUP BY idBilaSociCons, rmd.ID_MOTIDEPA
		ORDER BY rmd.ID_MOTIDEPA;
                
                SELECT
                    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vMODE_SORTIE_NON_TITULAIRE_H,
                    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vMODE_SORTIE_NON_TITULAIRE_F
                INTO vMODE_SORTIE_NON_TITULAIRE_H,vMODE_SORTIE_NON_TITULAIRE_F 
                FROM ref_motif_depart rmd
                    LEFT JOIN temp_apa2cons_handitorial_mode_sorties_non_titulaires t ON rmd.ID_MOTIDEPA = t.Q17_1
		WHERE rmd.bl_vali = 0;

                IF vMODE_SORTIE_NON_TITULAIRE_H > 0 OR vMODE_SORTIE_NON_TITULAIRE_F > 0 THEN
                    UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                END IF;

		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_articles;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_articles (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			bsa.ID_TYPECDD AS Q17_1
		  FROM bilan_social_agent AS bsa
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial articles
		INSERT INTO bsc_handitorial_articles (ID_BILASOCICONS, ID_TYPECDD, ARTICLE_H, ARTICLE_F)
		SELECT idBilaSociCons,  rtc.ID_TYPECDD,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS ARTICLE_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS ARTICLE_F
		FROM ref_Type_Cdd rtc
		  LEFT JOIN temp_apa2cons_handitorial_articles t ON rtc.ID_TYPECDD = t.Q17_1
		WHERE rtc.bl_vali = 0
		GROUP BY idBilaSociCons, rtc.ID_TYPECDD
		ORDER BY rtc.ID_TYPECDD;

                SELECT
                    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vARTICLE_H,
                    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vARTICLE_F
                INTO vARTICLE_H,vARTICLE_F
		FROM ref_Type_Cdd rtc
		  LEFT JOIN temp_apa2cons_handitorial_articles t ON rtc.ID_TYPECDD = t.Q17_1
		WHERE rtc.bl_vali = 0;

                IF vARTICLE_H > 0 OR vARTICLE_F > 0 THEN
                    UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                END IF;

		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_inaptitude_en_cours;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_inaptitude_en_cours (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			bsah.id_inaptitude_encours_annne AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN Bilan_Social_Agent_Handitorial AS bsah ON bsah.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial avis inaptitudes
		INSERT INTO bsc_handitorial_avis_inaptitudes (ID_BILASOCICONS, ID_INAPTITUDE_BOETH, AVIS_INAPTITUDE_H, AVIS_INAPTITUDE_F)
		SELECT idBilaSociCons,  rib.ID_INAPTITUDE_BOETH,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS AVIS_INAPTITUDE_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS AVIS_INAPTITUDE_F
		FROM ref_inaptitude_boeth rib
		  LEFT JOIN temp_apa2cons_handitorial_inaptitude_en_cours t ON rib.ID_INAPTITUDE_BOETH = t.Q17_1
		WHERE rib.bl_vali = 0
		GROUP BY idBilaSociCons, rib.ID_INAPTITUDE_BOETH
		ORDER BY rib.ID_INAPTITUDE_BOETH;
                

                SELECT
                    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vAVIS_INAPTITUDE_H,
                    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vAVIS_INAPTITUDE_F
                INTO vAVIS_INAPTITUDE_H,vAVIS_INAPTITUDE_F
		FROM ref_inaptitude_boeth rib
                    LEFT JOIN temp_apa2cons_handitorial_inaptitude_en_cours t ON rib.ID_INAPTITUDE_BOETH = t.Q17_1
		WHERE rib.bl_vali = 0;

                IF vAVIS_INAPTITUDE_H > 0 OR vAVIS_INAPTITUDE_F > 0 THEN
                    UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                END IF;




		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_mesure_inaptitude_en_cours;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_mesure_inaptitude_en_cours (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			bsah.id_mesure_inaptitude_encours_annne AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN Bilan_Social_Agent_Handitorial AS bsah ON bsah.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial mesure inaptitudes
		INSERT INTO bsc_handitorial_mesure_inaptitudes (ID_BILASOCICONS, ID_MESURE_BOETH, MESURE_INAPTITUDE_H, MESURE_INAPTITUDE_F)
		SELECT idBilaSociCons,  rmb.ID_MESURE_BOETH,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS MESURE_INAPTITUDE_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS MESURE_INAPTITUDE_F
		FROM ref_mesure_boeth rmb
		  LEFT JOIN temp_apa2cons_handitorial_mesure_inaptitude_en_cours t ON rmb.ID_MESURE_BOETH = t.Q17_1
		WHERE rmb.bl_vali = 0
		GROUP BY idBilaSociCons, rmb.ID_MESURE_BOETH
		ORDER BY rmb.ID_MESURE_BOETH;


                SELECT
                    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vMESURE_INAPTITUDE_H,
                    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vMESURE_INAPTITUDE_F
                INTO vMESURE_INAPTITUDE_H,vMESURE_INAPTITUDE_F
		FROM ref_mesure_boeth rmb
		  LEFT JOIN temp_apa2cons_handitorial_mesure_inaptitude_en_cours t ON rmb.ID_MESURE_BOETH = t.Q17_1
		WHERE rmb.bl_vali = 0;

                IF vMESURE_INAPTITUDE_H > 0 OR vMESURE_INAPTITUDE_F > 0 THEN
                    UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                END IF;

		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_inaptitude_avant;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_inaptitude_avant (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			bsah.id_inaptitude_avant_annne AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN Bilan_Social_Agent_Handitorial AS bsah ON bsah.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial avis inaptitudes
		INSERT INTO bsc_handitorial_avis_inaptitudes_avant (ID_BILASOCICONS, ID_INAPTITUDE_BOETH, AVIS_INAPTITUDE_AVANT_H, AVIS_INAPTITUDE_AVANT_F)
		SELECT idBilaSociCons,  rib.ID_INAPTITUDE_BOETH,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS AVIS_INAPTITUDE_AVANT_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS AVIS_INAPTITUDE_AVANT_F
		FROM ref_inaptitude_boeth rib
		  LEFT JOIN temp_apa2cons_handitorial_inaptitude_avant t ON rib.ID_INAPTITUDE_BOETH = t.Q17_1
		WHERE rib.bl_vali = 0
		GROUP BY idBilaSociCons, rib.ID_INAPTITUDE_BOETH
		ORDER BY rib.ID_INAPTITUDE_BOETH;

                SELECT
                    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vAVIS_INAPTITUDE_AVANT_H,
                    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vAVIS_INAPTITUDE_AVANT_F
                INTO vAVIS_INAPTITUDE_AVANT_H,vAVIS_INAPTITUDE_AVANT_F
		FROM ref_inaptitude_boeth rib
		  LEFT JOIN temp_apa2cons_handitorial_inaptitude_avant t ON rib.ID_INAPTITUDE_BOETH = t.Q17_1
		WHERE rib.bl_vali = 0;

                IF vAVIS_INAPTITUDE_AVANT_H > 0 OR vAVIS_INAPTITUDE_AVANT_F > 0 THEN
                    UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                END IF;

		### Création et remplissage de la table temporaire
	  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_mesure_inaptitude_avant;
	  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_mesure_inaptitude_avant (INDEX(Q1))
		ENGINE = MEMORY
	  AS (
		  SELECT
			bsa.CD_SEXE AS Q1,
			bsah.id_mesure_inaptitude_avant_annne AS Q17_1
		  FROM bilan_social_agent AS bsa
		  JOIN Bilan_Social_Agent_Handitorial AS bsah ON bsah.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		  WHERE bsa.ID_COLL = idColl
			AND bsa.ID_ENQU = idEnqu
			AND bsa.BL_BOETH = 1
		);

		### Remplissage de handitorial mesure inaptitudes
		INSERT INTO bsc_handitorial_mesure_inaptitudes_avant (ID_BILASOCICONS, ID_MESURE_BOETH, MESURE_INAPTITUDE_AVANT_H, MESURE_INAPTITUDE_AVANT_F)
		SELECT idBilaSociCons,  rmb.ID_MESURE_BOETH,
			SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS MESURE_INAPTITUDE_AVANT_H,
			SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS MESURE_INAPTITUDE_AVANT_F
		FROM ref_mesure_boeth rmb
		  LEFT JOIN temp_apa2cons_handitorial_mesure_inaptitude_avant t ON rmb.ID_MESURE_BOETH = t.Q17_1
		WHERE rmb.bl_vali = 0
		GROUP BY idBilaSociCons, rmb.ID_MESURE_BOETH
		ORDER BY rmb.ID_MESURE_BOETH;

                SELECT
                    SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vMESURE_INAPTITUDE_AVANT_H,
                    SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vMESURE_INAPTITUDE_AVANT_F
                INTO vMESURE_INAPTITUDE_AVANT_H,vMESURE_INAPTITUDE_AVANT_F
		FROM ref_mesure_boeth rmb
		  LEFT JOIN temp_apa2cons_handitorial_mesure_inaptitude_avant t ON rmb.ID_MESURE_BOETH = t.Q17_1
		WHERE rmb.bl_vali = 0;

                IF vMESURE_INAPTITUDE_AVANT_H > 0 OR vMESURE_INAPTITUDE_AVANT_F > 0 THEN
                    UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                END IF;             


		### Création et remplissage de la table temporaire
	    DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_anciennete;
	    CREATE TEMPORARY TABLE temp_apa2cons_handitorial_anciennete (INDEX(Q1))
	      ENGINE = MEMORY
	      AS (
	        SELECT
	          bsa.CD_SEXE AS Q1,
	  		bsa.DT_ARRISTAT,
	  		CASE WHEN   TIMESTAMPDIFF(YEAR, bsa.DT_ARRISTAT, CURDATE()) < 1
	  				THEN 1
	  			 WHEN   TIMESTAMPDIFF(YEAR, bsa.DT_ARRISTAT, CURDATE()) >= 1
	  				AND TIMESTAMPDIFF(YEAR, bsa.DT_ARRISTAT, CURDATE()) <= 3
	  				THEN 2
	  			 WHEN   TIMESTAMPDIFF(YEAR, bsa.DT_ARRISTAT, CURDATE()) >= 4
	  				AND TIMESTAMPDIFF(YEAR, bsa.DT_ARRISTAT, CURDATE()) <= 6
	  				THEN 3
	  			 WHEN   TIMESTAMPDIFF(YEAR, bsa.DT_ARRISTAT, CURDATE()) >= 7
	  				AND TIMESTAMPDIFF(YEAR, bsa.DT_ARRISTAT, CURDATE()) <= 12
	  				THEN 4
	  			 ELSE 5 END AS ID_ANCIENNETE
	        FROM bilan_social_agent AS bsa
	        WHERE bsa.ID_COLL = idColl
	          AND bsa.ID_ENQU = idEnqu
			  AND bsa.BL_BOETH = 1
			  AND bsa.DT_ARRISTAT IS NOT NULL
	      );

		  ### Remplissage
		  INSERT INTO bsc_handitorial_anciennete_agents (ID_BILASOCICONS,MOINS_UN_AN_H,MOINS_UN_AN_F,ENTRE_UN_ET_TROIS_H,ENTRE_UN_ET_TROIS_F,ENTRE_QUATRE_ET_SIX_H,ENTRE_QUATRE_ET_SIX_F,ENTRE_SEPT_ET_DOUZE_H,ENTRE_SEPT_ET_DOUZE_F, PLUS_DOUZE_H, PLUS_DOUZE_F)
		  SELECT idBilaSociCons,
		    SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 1 THEN 1 ELSE 0 END) AS MOINS_UN_AN_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 1 THEN 1 ELSE 0 END) AS MOINS_UN_AN_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 2 THEN 1 ELSE 0 END) AS ENTRE_UN_ET_TROIS_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 2 THEN 1 ELSE 0 END) AS ENTRE_UN_ET_TROIS_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 3 THEN 1 ELSE 0 END) AS ENTRE_QUATRE_ET_SIX_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 3 THEN 1 ELSE 0 END) AS ENTRE_QUATRE_ET_SIX_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 4 THEN 1 ELSE 0 END) AS ENTRE_SEPT_ET_DOUZE_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 4 THEN 1 ELSE 0 END) AS ENTRE_SEPT_ET_DOUZE_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 5 THEN 1 ELSE 0 END) AS PLUS_DOUZE_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 5 THEN 1 ELSE 0 END) AS PLUS_DOUZE_F
		  FROM temp_apa2cons_handitorial_anciennete t;
                  
                   SELECT
                        SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 1 THEN 1 ELSE 0 END) AS vMOINS_UN_AN_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 1 THEN 1 ELSE 0 END) AS vMOINS_UN_AN_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 2 THEN 1 ELSE 0 END) AS vENTRE_UN_ET_TROIS_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 2 THEN 1 ELSE 0 END) AS vENTRE_UN_ET_TROIS_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 3 THEN 1 ELSE 0 END) AS vENTRE_QUATRE_ET_SIX_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 3 THEN 1 ELSE 0 END) AS vENTRE_QUATRE_ET_SIX_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 4 THEN 1 ELSE 0 END) AS vENTRE_SEPT_ET_DOUZE_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 4 THEN 1 ELSE 0 END) AS vENTRE_SEPT_ET_DOUZE_F,
			SUM(CASE WHEN t.Q1 = 1 AND t.ID_ANCIENNETE = 5 THEN 1 ELSE 0 END) AS vPLUS_DOUZE_H,
			SUM(CASE WHEN t.Q1 = 2 AND t.ID_ANCIENNETE = 5 THEN 1 ELSE 0 END) AS vPLUS_DOUZE_F
                    INTO vMOINS_UN_AN_H,vMOINS_UN_AN_F,vENTRE_UN_ET_TROIS_H,vENTRE_UN_ET_TROIS_F,vENTRE_QUATRE_ET_SIX_H,vENTRE_QUATRE_ET_SIX_F,vENTRE_SEPT_ET_DOUZE_H,vENTRE_SEPT_ET_DOUZE_F,vPLUS_DOUZE_H,vPLUS_DOUZE_F
                    FROM temp_apa2cons_handitorial_anciennete t;

                    IF vMOINS_UN_AN_H > 0 OR vMOINS_UN_AN_F > 0 OR vENTRE_UN_ET_TROIS_H > 0 OR vENTRE_UN_ET_TROIS_F > 0 OR vENTRE_QUATRE_ET_SIX_H > 0 OR vENTRE_QUATRE_ET_SIX_F > 0 OR vENTRE_SEPT_ET_DOUZE_H > 0 OR vENTRE_SEPT_ET_DOUZE_F > 0 OR vPLUS_DOUZE_H > 0 OR vPLUS_DOUZE_F > 0 THEN
                        UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_QUESTIONS_BOETHS = '4', MOYENNE_HANDITORIAL_QUESTIONS_BOETHS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                    END IF;       



                  
		    ### Création et remplissage de la table temporaire
		    DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_cadre_emplois;
		    CREATE TEMPORARY TABLE temp_apa2cons_handitorial_cadre_emplois
		      ENGINE = MEMORY
		      AS (
		        SELECT
		          bsa.ID_CADREMPL AS Q3,
		          bsa.CD_SEXE AS Q1
		        FROM bilan_social_agent AS bsa
		        WHERE bsa.ID_COLL = idColl
		          AND bsa.ID_ENQU = idEnqu
		          AND bsa.ID_CADREMPL IS NOT NULL
				  AND bsa.BL_BOETH = 1
				  # GROUP BY bsa.ID_CADREMPL
		      );

		    ### Remplissage de handitorial cadre emplois
		    INSERT INTO bsc_handitorial_cadre_emplois (ID_BILASOCICONS, ID_CADREMPL, CADRE_EMPLOI_H, CADRE_EMPLOI_F)
		    SELECT idBilaSociCons, ce.ID_CADREMPL,
		      SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS CADRE_EMPLOI_H,
		      SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS CADRE_EMPLOI_F
		    FROM ref_cadre_emploi ce
		  	JOIN ref_filiere f on f.ID_FILI = ce.ID_FILI
		  	LEFT JOIN temp_apa2cons_handitorial_cadre_emplois t ON t.Q3 = ce.ID_CADREMPL
		    WHERE ce.bl_vali = 0
			GROUP BY idBilaSociCons, ce.ID_CADREMPL
		    ORDER BY ce.ID_CADREMPL;


                    SELECT
                        SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vCADRE_EMPLOI_H,
                        SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vCADRE_EMPLOI_F
                    INTO vCADRE_EMPLOI_H, vCADRE_EMPLOI_F
		    FROM ref_cadre_emploi ce
		  	JOIN ref_filiere f on f.ID_FILI = ce.ID_FILI
		  	LEFT JOIN temp_apa2cons_handitorial_cadre_emplois t ON t.Q3 = ce.ID_CADREMPL
		    WHERE ce.bl_vali = 0;

                    IF vCADRE_EMPLOI_H > 0 OR vCADRE_EMPLOI_F > 0 THEN
                        UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_CADRE_EMPLOIS = '4', MOYENNE_HANDITORIAL_CADRE_EMPLOIS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                    END IF;
                    

			### Création et remplissage de la table temporaire
		    DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_metiers;
		    CREATE TEMPORARY TABLE temp_apa2cons_handitorial_metiers
		      ENGINE = MEMORY
		      AS (
		        SELECT
		          bsag.ID_METIER AS Q3,
		          bsa.CD_SEXE AS Q1
		        FROM bilan_social_agent AS bsa
				JOIN bilan_social_agent_gpeec AS bsag ON bsag.ID_BILASOCIAGEN = bsa.ID_BILASOCIAGEN
		        WHERE bsa.ID_COLL = idColl
		          AND bsa.ID_ENQU = idEnqu
				  AND bsa.BL_BOETH = 1
		          AND bsag.ID_METIER IS NOT NULL
				  # GROUP BY bsag.ID_METIER
		      );

		    ### Remplissage de handitorial cadre emplois
		    INSERT INTO bsc_handitorial_metiers (ID_BILASOCICONS, ID_METIER, METIER_H, METIER_F)
		    SELECT idBilaSociCons, m.ID_METIER,
		      SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS METIER_H,
		      SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS METIER_F
			  FROM ref_metier m
  		    LEFT JOIN temp_apa2cons_handitorial_metiers t on t.Q3 = m.ID_METIER
  		    GROUP BY idBilaSociCons, m.ID_METIER
  		    ORDER BY m.ID_METIER;

                    SELECT
                        SUM(CASE WHEN t.Q1 = 1 THEN 1 ELSE 0 END) AS vMETIER_H,
                        SUM(CASE WHEN t.Q1 = 2 THEN 1 ELSE 0 END) AS vMETIER_F
                    INTO vMETIER_H, vMETIER_F
                    FROM temp_apa2cons_handitorial_metiers t;

                    IF vMETIER_H > 0 OR vMETIER_F > 0 THEN
                        UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_METIERS = '4', MOYENNE_HANDITORIAL_METIERS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                    END IF;


			### Création et remplissage de la table temporaire
		  DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_temps_complets;
		  CREATE TEMPORARY TABLE temp_apa2cons_handitorial_temps_complets (INDEX(Q1))
			ENGINE = MEMORY
		  AS (
			  SELECT
				bsa.CD_SEXE AS Q1,
				bsa.BL_TEMPCOMP AS Q17_1
			  FROM bilan_social_agent AS bsa
			  WHERE bsa.ID_COLL = idColl
				AND bsa.ID_ENQU = idEnqu
				AND bsa.BL_BOETH = 1
			);

			### Remplissage de handitorial temps complet
			INSERT INTO bsc_handitorial_temps_complets (ID_BILASOCICONS, TEMPS_COMPLET_H, TEMPS_COMPLET_F, TEMPS_NON_COMPLET_H, TEMPS_NON_COMPLET_F)
			SELECT idBilaSociCons,
				SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS TEMPS_COMPLET_H,
				SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS TEMPS_COMPLET_F,
				SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS TEMPS_NON_COMPLET_H,
				SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS TEMPS_NON_COMPLET_F
			FROM temp_apa2cons_handitorial_temps_complets t;
                        

                        SELECT
                            SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS vTEMPS_COMPLET_H,
                            SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS vTEMPS_COMPLET_F,
                            SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS vTEMPS_NON_COMPLET_H,
                            SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS vTEMPS_NON_COMPLET_F
                        INTO vTEMPS_COMPLET_H, vTEMPS_COMPLET_F, vTEMPS_NON_COMPLET_H, vTEMPS_NON_COMPLET_F
			FROM temp_apa2cons_handitorial_temps_complets t;
    
                        IF vTEMPS_COMPLET_H > 0 OR vTEMPS_COMPLET_F > 0 OR vTEMPS_NON_COMPLET_H > 0 OR vTEMPS_NON_COMPLET_F > 0 THEN
                            UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_TEMPS_COMPLETS = '4', MOYENNE_HANDITORIAL_TEMPS_COMPLETS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                        END IF;



			### Création et remplissage de la table temporaire
			DROP TEMPORARY TABLE IF EXISTS temp_apa2cons_handitorial_temps_plein;
			CREATE TEMPORARY TABLE temp_apa2cons_handitorial_temps_plein (INDEX(Q1))
			ENGINE = MEMORY
			AS (
			  SELECT
				bsa.CD_SEXE AS Q1,
				bsa.BL_TEMPPLEIN AS Q17_1
			  FROM bilan_social_agent AS bsa
			  WHERE bsa.ID_COLL = idColl
				AND bsa.ID_ENQU = idEnqu
				AND bsa.BL_BOETH = 1
			);
                        
                        

			### Remplissage de handitorial temps plein
			INSERT INTO bsc_handitorial_temps_pleins (ID_BILASOCICONS, TEMPS_PLEIN_H, TEMPS_PLEIN_F, TEMPS_PARTIEL_H, TEMPS_PARTIEL_F)
			SELECT idBilaSociCons,
				SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS TEMPS_PLEIN_H,
				SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS TEMPS_PLEIN_F,
				SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS TEMPS_PARTIEL_H,
				SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS TEMPS_PARTIEL_F
			FROM temp_apa2cons_handitorial_temps_plein t;
                        
                        SELECT
                            SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS vTEMPS_PLEIN_H,
                            SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 1 THEN 1 ELSE 0 END) AS vTEMPS_PLEIN_F,
                            SUM(CASE WHEN t.Q1 = 1 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS vTEMPS_PARTIEL_H,
                            SUM(CASE WHEN t.Q1 = 2 AND t.Q17_1 = 0 THEN 1 ELSE 0 END) AS vTEMPS_PARTIEL_F
                        INTO vTEMPS_PLEIN_H, vTEMPS_PLEIN_F, vTEMPS_PARTIEL_H, vTEMPS_PARTIEL_F
			FROM temp_apa2cons_handitorial_temps_plein t;

                        IF vTEMPS_PLEIN_H > 0 OR vTEMPS_PLEIN_F > 0 OR vTEMPS_PARTIEL_H > 0 OR vTEMPS_PARTIEL_F > 0 THEN
                            UPDATE bilan_social_consolide SET BL_INCO_HANDITORIAL_TEMPS_COMPLETS = '4', MOYENNE_HANDITORIAL_TEMPS_COMPLETS = '100' WHERE ID_BILASOCICONS = idBilaSociCons AND ID_ENQU = idEnqu AND ID_COLL = idColl;
                        END IF;


END
$$