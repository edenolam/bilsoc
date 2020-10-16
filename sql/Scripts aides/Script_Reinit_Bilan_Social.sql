/******** Script permettant de vider des tables de la base de donénes du bilan social ************/
/* Vider les tables liées à la saisie du consolidé */

DELETE FROM ind_110_1;
DELETE FROM ind_110_2;
DELETE FROM ind_110_3;
DELETE FROM ind_111;
DELETE FROM ind_112;
DELETE FROM ind_113;
DELETE FROM ind_114;
DELETE FROM ind_121;
DELETE FROM ind_122;
DELETE FROM ind_123;
DELETE FROM ind_124;
DELETE FROM ind_132;
DELETE FROM ind_141;
DELETE FROM ind_1311;
DELETE FROM ind_1312;
DELETE FROM incoherencelog;
DELETE FROM ind_142;
DELETE FROM ind_143;
DELETE FROM ind_144;
DELETE FROM ind_150_1;
DELETE FROM ind_150_2;
DELETE FROM ind_151_1;
DELETE FROM ind_151_2;
DELETE FROM ind_151_3;
DELETE FROM ind_152;
DELETE FROM ind_153_1;
DELETE FROM ind_154;
DELETE FROM ind_155;
DELETE FROM ind_156;
DELETE FROM ind_158;
DELETE FROM ind_161;
DELETE FROM ind_171;
DELETE FROM ind_211_1;
DELETE FROM ind_211_2;
DELETE FROM ind_211_3;
DELETE FROM ind_212_1;
DELETE FROM ind_212_2;
DELETE FROM ind_212_3;
DELETE FROM ind_213_1;
DELETE FROM ind_213_2;
DELETE FROM ind_213_3;
DELETE FROM ind_214;
DELETE FROM ind_221;
DELETE FROM ind_222;
DELETE FROM ind_224;
DELETE FROM ind_231;
DELETE FROM ind_311;
DELETE FROM ind_321;
DELETE FROM ind_331;
DELETE FROM ind_344;
DELETE FROM ind_411;
DELETE FROM ind_412;
DELETE FROM ind_421;
DELETE FROM ind_422;
DELETE FROM ind_423;
DELETE FROM ind_423Fili;
DELETE FROM ind_424;
DELETE FROM ind_431;
DELETE FROM ind_1532;
DELETE FROM ind_1612;
DELETE FROM ind_2151;
DELETE FROM ind_2152;
DELETE FROM ind_2231;
DELETE FROM ind_2232;
DELETE FROM ind_2233;
DELETE FROM ind_5111;
DELETE FROM ind_5112;
DELETE FROM ind_5113;
DELETE FROM ind_5121;
DELETE FROM ind_5122;
DELETE FROM ind_513;
DELETE FROM ind_513;
DELETE FROM ind_613;
DELETE FROM ind_6141;
DELETE FROM ind_6142;
DELETE FROM ind_7141;
DELETE FROM ind_7142;
DELETE FROM bsc_gpeec_nb_agents_titu_emp_perma_par_fonc_et_age;
DELETE FROM bsc_gpeec_plus_nb_agents_par_spe_et_age;
DELETE FROM bsc_handitorial_anciennete_agents;
DELETE FROM bsc_handitorial_articles;
DELETE FROM bsc_handitorial_avis_inaptitudes;
DELETE FROM bsc_handitorial_avis_inaptitudes_avant;
DELETE FROM bsc_handitorial_cadre_emplois;
DELETE FROM bsc_handitorial_derniers_diplomes;
DELETE FROM bsc_handitorial_mesure_inaptitudes;
DELETE FROM bsc_handitorial_mesure_inaptitudes_avant;
DELETE FROM bsc_handitorial_metiers;
DELETE FROM bsc_handitorial_mode_entrees;
DELETE FROM bsc_handitorial_mode_sorties_non_titulaire;
DELETE FROM bsc_handitorial_mode_sorties_titulaire;
DELETE FROM bsc_handitorial_nature_handicaps;
DELETE FROM bsc_handitorial_questions_boeths;
DELETE FROM bsc_handitorial_questions_generales;
DELETE FROM bsc_handitorial_statut_agents;
DELETE FROM bsc_handitorial_temps_complets;
DELETE FROM bsc_handitorial_temps_pleins;
DELETE FROM bsc_rassct_accident_travail;
DELETE FROM bsc_rassct_autres_mesures;
DELETE FROM bsc_rassct_element_materiel;
DELETE FROM bsc_rassct_maladie_pro_carac_pro;
DELETE FROM bsc_rassct_nature_lesion;
DELETE FROM bsc_rassct_nb_accident_travail;
DELETE FROM bsc_rassct_nb_maladie_professionnelle;
DELETE FROM bsc_rassct_predictions_autres_mesures;
DELETE FROM bsc_rassct_prevision_formation_sante_travail;
DELETE FROM bsc_rassct_realisation_formation_sante_travail;
DELETE FROM bsc_rassct_siege_lesion;
DELETE FROM bilan_social_consolide;
DELETE FROM question_collectivite_consolide;

/* Vider les tables liées à l'agent par agent */
DELETE FROM infocoll_132;
DELETE FROM prevoyance;
DELETE FROM absence_arret_agent;
DELETE FROM acte_violence_physique;
DELETE FROM action_prevention;
DELETE FROM Agent_ContraintesTravail;
DELETE FROM Agent_Remuneration_Fonctionnaire;
DELETE FROM Agent_Remuneration_Contractuel_Permanent;
DELETE FROM Agent_Remuneration_Contractuel_Non_Permanent;
DELETE FROM BILAN_Q30_ALERTE;
DELETE FROM conflit_travail;
DELETE FROM etpr_114_annee_precedente;
DELETE FROM etpr_124_annee_precedente;
DELETE FROM etpr_131_annee_precedente;
DELETE FROM etpr_agent;
DELETE FROM formation_agent;
DELETE FROM heure_remu_total_agent;
DELETE FROM heu_comp_rea_rem_agent;
DELETE FROM heu_supp_rea_rem_agent;
DELETE FROM remu_annu_bru_heu_supp_agent;
DELETE FROM remu_annu_bru_nbi_agent;
DELETE FROM remu_annu_bru_prim_agent;
DELETE FROM sante;
DELETE FROM historique_bilan_social;
DELETE FROM bilan_social_agent_gpeec;
DELETE FROM bilan_social_agent_gpeec_plus;
DELETE FROM Bilan_Social_Agent_Handitorial;
DELETE FROM Bilan_Social_Agent_Rassct;
DELETE FROM remuneration_globale_agent;
DELETE FROM bilan_social_agent;
DELETE FROM information_colectivite_agent;
DELETE FROM information_generale;
DELETE FROM init_bilan_social;
DELETE FROM IMPORT;

/* Vider les tables enquete / campagne */
DELETE FROM COLLECTIVITE_MODELE_ANALYSE;
DELETE FROM modele_analyse;
DELETE FROM demande_analyse;
DELETE FROM analyse;
DELETE FROM relance;
DELETE FROM cdg_departements_enquetes;
DELETE FROM enquete_collectivite;
DELETE FROM enquete;
DELETE FROM campagne;

/* Vider les tables temporaires base carrière */
DELETE FROM agirhe_absence;
DELETE FROM agirhe_formation;
DELETE FROM agirhe_agent;
DELETE FROM agirhe_collectivite;
DELETE FROM ciril_agent;
DELETE FROM ciril_collectivite;
DELETE FROM ciril_formation;


/* Vider les tables annexes */
DELETE FROM cdg_departement_fichier;
DELETE FROM CDG_DEPARTEMENTS_ACTUALITES;
DELETE FROM CDG_ACTUALITES;
DELETE FROM actualite;
DELETE FROM collectivite_draft;
DELETE FROM fichier;
DELETE FROM model_mail_cdg;
DELETE FROM model_mail;
DELETE FROM parametrage_affichage_collectivite;


/* Vider les tables des historiques */
DELETE FROM historique_collectivite;
DELETE FROM historique_connexion;
DELETE FROM historique_echange;
DELETE FROM Historique_question_collectivite;


/* Vider les tables contacts */
DELETE FROM collectivite_contact;
DELETE FROM cdg_contact;

/* Vider les tables utilisateurs */
DELETE FROM utilisateur_droits;
DELETE FROM utilisateur_cdg;
DELETE FROM utilisateur;
DELETE FROM collectivite;
DELETE FROM cdg_departement;

/* Tables à supprimer de la base de données */
DROP TABLE mode_saisie_enquete;
DROP TABLE module_enquete;
DROP TABLE social;
DROP TABLE socialStep2;
DROP TABLE type_import;
DROP TABLE utilisateur_draft;

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
TRUNCATE TABLE model_mail;
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
TRUNCATE TABLE utilisateur_droits;
/* Il faut le faire par le phpmyadmin pour vider la table utilisateur_cdg, utilisateur, collectivite, cdg_departement */
TRUNCATE TABLE utilisateur_cdg;
TRUNCATE TABLE utilisateur;
TRUNCATE TABLE collectivite;
TRUNCATE TABLE cdg_departement;

SET FOREIGN_KEY_CHECKS=1;

-- Mettre le mot de passe siret à toutes les collectivités (Environnement de recette uniquement)
UPDATE utilisateur SET `PASSWORD` = '$2y$10$vMlQaqZbWU.UsPAwVA3D/eQz.c5Bs7stArjtn99bJS3sPaICRKpoy' WHERE ID_COLL IS NOT NULL;

-- Mettre le mot de passe cdg à tous les CDG (Environnement de recette uniquement)
UPDATE utilisateur SET `PASSWORD` = '$2y$10$CRJ5EeMVYsWg3zhmmI0uiOI.WUPYNoW7PI3Htufw4CmDDZoaeKioa' WHERE ID_COLL IS NULL AND USERNAME != 'admin';

-- Mettre à jour le mot de passe pour l'administrateur Cig+2017 (Uniquement sur l'environnement de recette)
UPDATE utilisateur SET `PASSWORD` = '$2y$10$WSMq8gGapGZTV6RDcuSCQedbAFmEbMTMMdZLgGNtnHY6vDN4EfA6e' WHERE USERNAME = 'admin';
