/* Il faut le faire par le phpmyadmin */
/* ATTENTION a FAIRE ABSOLUMENT AVANT le truncate de la table bilan_social_agent */
DELETE s FROM sauvegarde_donnees_agents s
INNER JOIN bilan_social_agent bsa ON (s.LB_NOM = bsa.LB_NOM AND s.LB_PRENOM = bsa.LB_PREN AND s.DATE_NAISSANCE = bsa.LB_DATENAIS AND s.ID_COLL = bsa.ID_COLL);
 INSERT INTO sauvegarde_donnees_agents (LB_NOM, LB_PRENOM, DATE_NAISSANCE, 
    ID_METIER, ID_DOMAINE_DIPLOME_GPEEC, ID_CATEGORIE_BOETH, 
    ID_NATURE_HANDICAP_BOETH, ID_MESURE_INAPTITUDE_ENCOURS_ANNNE, 
    ID_MESURE_INAPTITUDE_AVANT_ANNNE, BL_AVIS_INAPTITUDE_EN_COURS,
    ID_INAPTITUDE_ENCOURS_ANNNE, BL_AVIS_INAPTITUDE_AVANT, ID_INAPTITUDE_AVANT_ANNNE, ID_ENQU, ID_COLL, ID_SPECIALITE)
    SELECT bs.LB_NOM, bs.LB_PREN, LB_DATENAIS, gpeec.ID_METIER, gpeec.ID_DOMAINE_DIPLOME_GPEEC, 
    hand.id_categorie_boeth, hand.id_nature_handicap_boeth, 
    hand.id_mesure_inaptitude_encours_annne, hand.id_mesure_inaptitude_avant_annne, hand.bl_avis_inaptitude_en_cours, 
    hand.id_inaptitude_encours_annne, hand.bl_avis_inaptitude_avant, hand.id_inaptitude_avant_annne, bs.ID_ENQU, bs.ID_COLL, gpeecplus.ID_SPECIALITE
    FROM bilan_social_agent bs
    JOIN Bilan_Social_Agent_Handitorial hand ON bs.ID_BILASOCIAGEN = hand.ID_BILASOCIAGEN
    JOIN bilan_social_agent_gpeec gpeec ON bs.ID_BILASOCIAGEN = gpeec.ID_BILASOCIAGEN
    JOIN bilan_social_agent_gpeec_plus gpeecplus ON bs.ID_BILASOCIAGEN = gpeecplus.ID_BILASOCIAGEN
    JOIN enquete e ON bs.ID_ENQU = e.ID_ENQU
    JOIN campagne c ON e.ID_CAMP = c.ID_CAMP;
/* Vérifier que des données existent bien en BDD dans sauvegarde_donnees_agents

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
TRUNCATE TABLE ind_343;
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
TRUNCATE TABLE bsc_gpeec_niveau_diplome;
TRUNCATE TABLE bsc_gpeec_plus_nb_agents_par_spe_et_age;
TRUNCATE TABLE bilan_social_agent_gpeec_plus;
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
TRUNCATE TABLE bsc_handitorial_inapt_et_recla_metiers;
TRUNCATE TABLE bsc_handitorial_inapt_et_recla_cadre_emplois;
TRUNCATE TABLE bsc_handitorial_inapt_et_recla_temps_complets;
TRUNCATE TABLE bsc_handitorial_inaptitude_et_reclassement;
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
TRUNCATE TABLE bsc_rassct_information_collectivite;
TRUNCATE TABLE bsc_dgcl_jours_carence_contractuel;
TRUNCATE TABLE bsc_dgcl_jours_carence_titulaire;
/* Il faut le faire par l'application pour vider la table bilan_social_consolide et question_collectivite_consolide */
DELETE FROM bilan_social_consolide;
DELETE FROM question_collectivite_consolide;

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
TRUNCATE TABLE bilan_social_agent_dgcl;
TRUNCATE TABLE sanction_disciplinaire_agent;
TRUNCATE TABLE Agent_AvancementPromotionsConcours;
TRUNCATE TABLE motif_sanction_disciplinaire_agent;
/* Il faut le faire par le phpmyadmin pour vider la table bilan_social_agent, information_colectivite_agent, information_generale */
DELETE FROM bilan_social_agent;
DELETE FROM information_colectivite_agent;
DELETE FROM information_generale;
DELETE FROM init_bilan_social;

/* vider les tables liés aux enquetes */
TRUNCATE TABLE cdg_departements_enquetes;
DELETE FROM enquete_collectivite;
TRUNCATE TABLE departements_enquetes;

/* Vider les tables temporaires base carrière */
TRUNCATE TABLE agirhe_absence;
TRUNCATE TABLE agirhe_formation;
TRUNCATE TABLE agirhe_agent;
TRUNCATE TABLE agirhe_collectivite;
TRUNCATE TABLE ciril_agent;
TRUNCATE TABLE ciril_collectivite;
TRUNCATE TABLE ciril_formation;

/* Vider les tables annexes */
TRUNCATE TABLE collectivite_draft;