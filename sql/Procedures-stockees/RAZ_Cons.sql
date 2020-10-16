SET GLOBAL log_bin_trust_function_creators = 1;

DELIMITER $$

DROP PROCEDURE IF EXISTS consolide_delete_value
$$

CREATE PROCEDURE consolide_delete_value(pIColl INT, pIdEnq INT)
  COMMENT ''
LANGUAGE SQL
MODIFIES SQL DATA
  SQL SECURITY DEFINER
  BEGIN
    DECLARE vIdBilasociCons INT;
	DECLARE vIdQuesCollCons INT;
	
	#Récupération de l identifiant pour le bilan_social_consolide
	SELECT id_bilasocicons
		INTO vIdBilasociCons
	FROM bilan_social_consolide
	WHERE id_coll = pIColl
		AND id_enqu = pIdEnq;
    
	#Récupération de l identifiant pour le question_collectivite_consolide
	SELECT id_quescollcons
		INTO vIdQuesCollCons
	FROM question_collectivite_consolide
	WHERE id_coll = pIColl
		AND id_enqu = pIdEnq;
		
	#Supression des valeurs de tous les "ind_xx" de bialn social
	DELETE FROM bsc_dgcl_jours_carence_titulaire WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_dgcl_jours_carence_contractuel WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_siege_lesion WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_realisation_formation_sante_travail WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_prevision_formation_sante_travail WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_predictions_autres_mesures WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_nb_maladie_professionnelle WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_nb_accident_travail WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_nature_lesion WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_maladie_pro_carac_pro WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_information_collectivite WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_element_materiel WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_autres_mesures WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_rassct_accident_travail WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_gpeec_plus_nb_agents_par_spe_et_age WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_gpeec_nb_agents_titu_emp_perma_par_fonc_et_age WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_gpeec_niveau_diplome WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_temps_pleins WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_temps_complets WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_inapt_et_recla_temps_complets WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_statut_agents WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_questions_generales WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_inaptitude_et_reclassement WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_questions_boeths WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_nature_handicaps WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_mode_sorties_titulaire WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_mode_sorties_non_titulaire WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_mode_entrees WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_metiers WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_inapt_et_recla_metiers WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_mesure_inaptitudes_avant WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_mesure_inaptitudes WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_derniers_diplomes WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_cadre_emplois WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_inapt_et_recla_cadre_emplois WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_avis_inaptitudes_avant WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_avis_inaptitudes WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_articles WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM bsc_handitorial_anciennete_agents WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_110_1 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_110_2 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_110_3 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_111 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_112 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_113 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_114 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_121 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_122 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_123 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_124 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_132 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_132_bis WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_141 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_142 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_143 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_144 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_150_1 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_150_2 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_151_1 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_151_2 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_151_3 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_152 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_153_1 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_1532 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_154 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_155 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_157 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_158 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_161 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_1311 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_1312 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_1612 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_171 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_211_1 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_211_2 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_211_3 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_212_1 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_212_2 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_212_3 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_213_1 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_213_2 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_213_3 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_214 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_215 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_216 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_221 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_222 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_224 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_231 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_311 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_321 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_331 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_343 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_344 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_411 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_412 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_421 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_422 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_423 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_423Fili WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_424 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_431 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_513 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_613 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_2231 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_2232 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_2233 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_2261 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_2262 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_2263 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_5111 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_5112 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_5113 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_5121 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_5122 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_6141 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_6142 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_6143 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_6144 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_7141 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM ind_7142 WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM `incoherencelog` 
	WHERE ID_BILASOCICONS = vIdBilasociCons;

	DELETE FROM `bilan_social_consolide` 
	WHERE ID_BILASOCICONS = vIdBilasociCons;
	
	#Supression de question_collectivite_consolide
	DELETE FROM `question_collectivite_consolide` 
	WHERE ID_QUESCOLLCONS = vIdQuesCollCons;
  END
$$