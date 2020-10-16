/* TRUNCATE TABLE */
/* Vider les tables liées à la saisie du consolidé */

SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE ind_110_1;
TRUNCATE TABLE ind_110_2;
TRUNCATE TABLE ind_110_3;
TRUNCATE TABLE ind_111;
TRUNCATE TABLE ind_112;
TRUNCATE TABLE ind_113;
TRUNCATE TABLE ind_114;
TRUNCATE TABLE ind_121;
TRUNCATE TABLE ind_122;
TRUNCATE TABLE ind_123;
TRUNCATE TABLE ind_124;
TRUNCATE TABLE ind_132;
TRUNCATE TABLE ind_141;
TRUNCATE TABLE ind_1311;
TRUNCATE TABLE ind_1312;
TRUNCATE TABLE incoherencelog;
TRUNCATE TABLE ind_142;
TRUNCATE TABLE ind_143;
TRUNCATE TABLE ind_144;
TRUNCATE TABLE ind_150_1;
TRUNCATE TABLE ind_150_2;
TRUNCATE TABLE ind_151_1;
TRUNCATE TABLE ind_151_2;
TRUNCATE TABLE ind_151_3;
TRUNCATE TABLE ind_152;
TRUNCATE TABLE ind_153_1;
TRUNCATE TABLE ind_154;
TRUNCATE TABLE ind_155;
TRUNCATE TABLE ind_156;
TRUNCATE TABLE ind_158;
TRUNCATE TABLE ind_161;
TRUNCATE TABLE ind_171;
TRUNCATE TABLE ind_211_1;
TRUNCATE TABLE ind_211_2;
TRUNCATE TABLE ind_211_3;
TRUNCATE TABLE ind_212_1;
TRUNCATE TABLE ind_212_2;
TRUNCATE TABLE ind_212_3;
TRUNCATE TABLE ind_213_1;
TRUNCATE TABLE ind_213_2;
TRUNCATE TABLE ind_213_3;
TRUNCATE TABLE ind_214;
TRUNCATE TABLE ind_221;
TRUNCATE TABLE ind_222;
TRUNCATE TABLE ind_224;
TRUNCATE TABLE ind_231;
TRUNCATE TABLE ind_311;
TRUNCATE TABLE ind_321;
TRUNCATE TABLE ind_331;
TRUNCATE TABLE ind_344;
TRUNCATE TABLE ind_411;
TRUNCATE TABLE ind_412;
TRUNCATE TABLE ind_421;
TRUNCATE TABLE ind_422;
TRUNCATE TABLE ind_423;
TRUNCATE TABLE ind_423Fili;
TRUNCATE TABLE ind_424;
TRUNCATE TABLE ind_431;
TRUNCATE TABLE ind_1532;
TRUNCATE TABLE ind_1612;
TRUNCATE TABLE ind_2151;
TRUNCATE TABLE ind_2152;
TRUNCATE TABLE ind_2231;
TRUNCATE TABLE ind_2232;
TRUNCATE TABLE ind_2233;
TRUNCATE TABLE ind_5111;
TRUNCATE TABLE ind_5112;
TRUNCATE TABLE ind_5113;
TRUNCATE TABLE ind_5121;
TRUNCATE TABLE ind_5122;
TRUNCATE TABLE ind_513;
TRUNCATE TABLE ind_513;
TRUNCATE TABLE ind_613;
TRUNCATE TABLE ind_6141;
TRUNCATE TABLE ind_6142;
TRUNCATE TABLE ind_7141;
TRUNCATE TABLE ind_7142;
TRUNCATE TABLE bsc_gpeec_nb_agents_titu_emp_perma_par_fonc_et_age;
TRUNCATE TABLE bsc_handitorial_anciennete_agents;
TRUNCATE TABLE bsc_handitorial_articles;
TRUNCATE TABLE bsc_handitorial_avis_inaptitudes;
TRUNCATE TABLE bsc_handitorial_avis_inaptitudes_avant;
TRUNCATE TABLE bsc_handitorial_cadre_emplois;
TRUNCATE TABLE bsc_handitorial_derniers_diplomes;
TRUNCATE TABLE bsc_handitorial_mesure_inaptitudes;
TRUNCATE TABLE bsc_handitorial_mesure_inaptitudes_avant;
TRUNCATE TABLE bsc_handitorial_metiers;
TRUNCATE TABLE bsc_handitorial_mode_entrees;
TRUNCATE TABLE bsc_handitorial_mode_sorties_non_titulaire;
TRUNCATE TABLE bsc_handitorial_mode_sorties_titulaire;
TRUNCATE TABLE bsc_handitorial_nature_handicaps;
TRUNCATE TABLE bsc_handitorial_questions_boeths;
TRUNCATE TABLE bsc_handitorial_questions_generales;
TRUNCATE TABLE bsc_handitorial_statut_agents;
TRUNCATE TABLE bsc_handitorial_temps_complets;
TRUNCATE TABLE bsc_handitorial_temps_pleins;
TRUNCATE TABLE bsc_rassct_accident_travail;
TRUNCATE TABLE bsc_rassct_autres_mesures;
TRUNCATE TABLE bsc_rassct_element_materiel;
TRUNCATE TABLE bsc_rassct_maladie_pro_carac_pro;
TRUNCATE TABLE bsc_rassct_nature_lesion;
TRUNCATE TABLE bsc_rassct_nb_accident_travail;
TRUNCATE TABLE bsc_rassct_nb_maladie_professionnelle;
TRUNCATE TABLE bsc_rassct_predictions_autres_mesures;
TRUNCATE TABLE bsc_rassct_prevision_formation_sante_travail;
TRUNCATE TABLE bsc_rassct_realisation_formation_sante_travail;
TRUNCATE TABLE bsc_rassct_siege_lesion;
/* Il faut le faire par l'application pour vider la table bilan_social_consolide et question_collectivite_consolide */
TRUNCATE TABLE bilan_social_consolide;
TRUNCATE TABLE question_collectivite_consolide;

/* Vider les tables liées à l'agent par agent */
TRUNCATE TABLE infocoll_132;
TRUNCATE TABLE prevoyance;
TRUNCATE TABLE absence_arret_agent;
TRUNCATE TABLE acte_violence_physique;
TRUNCATE TABLE action_prevention;
TRUNCATE TABLE Agent_ContraintesTravail;
TRUNCATE TABLE Agent_Remuneration_Fonctionnaire;
TRUNCATE TABLE Agent_Remuneration_Contractuel_Permanent;
TRUNCATE TABLE Agent_Remuneration_Contractuel_Non_Permanent;
TRUNCATE TABLE BILAN_Q30_ALERTE;
TRUNCATE TABLE conflit_travail;
TRUNCATE TABLE etpr_114_annee_precedente;
TRUNCATE TABLE etpr_124_annee_precedente;
TRUNCATE TABLE etpr_131_annee_precedente;
TRUNCATE TABLE etpr_agent;
TRUNCATE TABLE formation_agent;
TRUNCATE TABLE heure_remu_total_agent;
TRUNCATE TABLE heu_comp_rea_rem_agent;
TRUNCATE TABLE heu_supp_rea_rem_agent;
TRUNCATE TABLE remu_annu_bru_heu_supp_agent;
TRUNCATE TABLE remu_annu_bru_nbi_agent;
TRUNCATE TABLE remu_annu_bru_prim_agent;
TRUNCATE TABLE sante;
TRUNCATE TABLE historique_bilan_social;
TRUNCATE TABLE bilan_social_agent_gpeec;
TRUNCATE TABLE Bilan_Social_Agent_Handitorial;
TRUNCATE TABLE Bilan_Social_Agent_Rassct;
TRUNCATE TABLE remuneration_globale_agent;
/* Il faut le faire par le phpmyadmin pour vider la table bilan_social_agent, information_colectivite_agent, information_generale */
TRUNCATE TABLE bilan_social_agent;
TRUNCATE TABLE information_colectivite_agent;
TRUNCATE TABLE information_generale;
TRUNCATE TABLE init_bilan_social;
TRUNCATE TABLE IMPORT;

/* Vider les tables enquete / campagne */
TRUNCATE TABLE COLLECTIVITE_MODELE_ANALYSE;
TRUNCATE TABLE demande_analyse;
TRUNCATE TABLE analyse;
TRUNCATE TABLE relance;
TRUNCATE TABLE cdg_departements_enquetes;
TRUNCATE TABLE enquete_collectivite;
/* Il faut le faire par le phpmyadmin pour vider la table enquete, campagne */
TRUNCATE TABLE modele_analyse;
TRUNCATE TABLE enquete;
TRUNCATE TABLE campagne;

/* Vider les tables temporaires base carrière */
TRUNCATE TABLE agirhe_absence;
TRUNCATE TABLE agirhe_formation;
TRUNCATE TABLE agirhe_agent;
TRUNCATE TABLE agirhe_collectivite;
TRUNCATE TABLE ciril_agent;
TRUNCATE TABLE ciril_collectivite;
TRUNCATE TABLE ciril_formation;


/* Vider les tables annexes */
TRUNCATE TABLE cdg_departement_fichier;
TRUNCATE TABLE CDG_DEPARTEMENTS_ACTUALITES;
TRUNCATE TABLE CDG_ACTUALITES;
/* Il faut le faire par le phpmyadmin pour vider la table actualite */
TRUNCATE TABLE actualite;
TRUNCATE TABLE collectivite_draft;
/* Il faut le faire par le phpmyadmin pour vider la table fichier */
TRUNCATE TABLE fichier;
TRUNCATE TABLE model_mail_cdg;
TRUNCATE TABLE parametrage_affichage_collectivite;

/* Vider les tables des historiques */
TRUNCATE TABLE historique_collectivite;
TRUNCATE TABLE historique_connexion;
TRUNCATE TABLE historique_echange;
TRUNCATE TABLE Historique_question_collectivite;


/* Vider les tables contacts */
TRUNCATE TABLE collectivite_contact;
TRUNCATE TABLE cdg_contact;

/* Vider les tables utilisateurs */
/* Il faut le faire par le phpmyadmin pour vider la table utilisateur_cdg, utilisateur, collectivite, cdg_departement */

SET FOREIGN_KEY_CHECKS=1;

-- Mettre le mot de passe siret à toutes les collectivités (Environnement de recette uniquement)
UPDATE utilisateur 
SET `PASSWORD` = '$2y$10$vMlQaqZbWU.UsPAwVA3D/eQz.c5Bs7stArjtn99bJS3sPaICRKpoy',
	FG_BLOCAGE = 0,
	NM_ERRECONN = 0,
	FG_STAT = 1,
	DT_LASTCONN = NULL,
	email = NULL
WHERE ID_COLL IS NOT NULL;

UPDATE utilisateur 
SET FG_BLOCAGE = 0,
	NM_ERRECONN = 0,
	DT_LASTCONN = NULL
WHERE USERNAME != 'admin';

-- Mettre le mot de passe cdg à tous les CDG (Environnement de recette uniquement)
UPDATE utilisateur SET `PASSWORD` = '$2y$10$CRJ5EeMVYsWg3zhmmI0uiOI.WUPYNoW7PI3Htufw4CmDDZoaeKioa' WHERE ID_COLL IS NULL AND USERNAME != 'admin';

-- Mettre à jour le mot de passe pour l'administrateur Cig+2017 (Uniquement sur l'environnement de recette)
UPDATE utilisateur SET `PASSWORD` = '$2y$10$WSMq8gGapGZTV6RDcuSCQedbAFmEbMTMMdZLgGNtnHY6vDN4EfA6e' WHERE USERNAME = 'admin';
