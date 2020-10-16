ALTER TABLE bilan_social_agent ADD BL_CYCLTRAV TINYINT(1) DEFAULT NULL COMMENT 'Q24.1';

/* ref_cycle_travail */
INSERT INTO ref_cycle_travail (CD_CYCLTRAV, LB_CYCLTRAV, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, LB_GROUCYCLTRAV, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES ('CTT001d','Agents sur cycle hebdomadaire', 0, NOW(),'ADMIN', NOW() ,'admin' , 'Cycle hebdomadaire', NULL, 0, 11);
INSERT INTO ref_cycle_travail (CD_CYCLTRAV, LB_CYCLTRAV, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, LB_GROUCYCLTRAV, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES ('CTT004e','Cycle annuel', 0, NOW(),'ADMIN', NOW() ,'admin' , 'Cycle annuel', NULL, 0, 12);
INSERT INTO ref_cycle_travail (CD_CYCLTRAV, LB_CYCLTRAV, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, LB_GROUCYCLTRAV, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES ('CTT005b','Forfait', 0, NOW(),'ADMIN', NOW() , 'admin', NULL , NULL, 0, 13);

/* ref_stage_titularisation */
UPDATE ref_stage_titularisation SET LB_STAGTITU = 'Titularisations prononcées en application de l''article 38 de la loi n° 84-53 du 26 janvier 1984 (travailleurs en situation de handicap)' WHERE CD_STAGTITU = 'TS004';
UPDATE ref_stage_titularisation SET BL_VALI = 1 WHERE CD_STAGTITU = 'TS006';
UPDATE ref_stage_titularisation SET BL_VALI = 1 WHERE CD_STAGTITU = 'SAUVADET';

INSERT INTO ref_stage_titularisation (`CD_STAGTITU`, `LB_STAGTITU`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `CD_DGCL`, `BL_EXCLUTOTAL`, `NM_ORDRE`) VALUES ('TS007', 'Agents contractuels permanents (déjà présents) nommés stagiaires dans l''année 2019', 1, NOW(), 'ADMIN', NOW(), 'admin', NULL, 0, 8);
INSERT INTO ref_stage_titularisation (`CD_STAGTITU`, `LB_STAGTITU`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `CD_DGCL`, `BL_EXCLUTOTAL`, `NM_ORDRE`) VALUES ('TS008', 'Agents contractuels non permanents (déjà présents) nommés stagiaires dans l''année 2019', 1, NOW(), 'ADMIN', NOW(), 'admin', NULL, 0, 9);
INSERT INTO ref_stage_titularisation (`CD_STAGTITU`, `LB_STAGTITU`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `CD_DGCL`, `BL_EXCLUTOTAL`, `NM_ORDRE`) VALUES ('TS009', 'Agents contractuels (nouvel arrivant ou déjà présent) nommés stagiaires dans l''année 2019', 0, NOW(), 'ADMIN', NOW(), 'admin', NULL, 0, 10);
INSERT INTO ref_stage_titularisation (`CD_STAGTITU`, `LB_STAGTITU`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `CD_DGCL`, `BL_EXCLUTOTAL`, `NM_ORDRE`) VALUES ('TS010', 'dont ceux nommés dans le cadre de la loi du 12 mars 2012', 0, NOW(), 'ADMIN', NOW(), 'admin', NULL, 0, 11);

/* ref_emploi_non_permanent */
UPDATE ref_emploi_non_permanent SET LB_EMPLNONPERM = 'Import DGCL - Autres agents sur emploi non permanent (y compris collaborateurs de cabinet)' WHERE CD_EMPLNONPERM = 'EF999';
INSERT INTO ref_emploi_non_permanent (LB_EMPLNONPERM, CD_EMPLNONPERM, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, CD_MOTI_N4DS, BL_CDG, CD_MOTI_BC_CIRIL, CD_DGCL, BL_APA, BL_EXCLUTOTAL, NM_ORDRE) VALUES ('Vacataires (hors jury de concours)', 'EF014', 0, NOW(),'ADMIN', NOW() ,'admin' , NULL, 0, NULL, NULL, 1, 0, 16);
INSERT INTO ref_emploi_non_permanent (LB_EMPLNONPERM, CD_EMPLNONPERM, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, CD_MOTI_N4DS, BL_CDG, CD_MOTI_BC_CIRIL, CD_DGCL, BL_APA, BL_EXCLUTOTAL, NM_ORDRE) VALUES ('Personnes ayant bénéficié d''un emploi aidé', 'EF015', 0, NOW(),'ADMIN', NOW() ,'admin' , NULL, 0, NULL, NULL, 1, 0, 17);

/* ref_motif_depart */
UPDATE ref_motif_depart SET BL_VALI = 1 , NM_ORDRE = 23 WHERE CD_MOTIDEPA = 'MD006';
UPDATE ref_motif_depart SET NM_ORDRE = 8 WHERE CD_MOTIDEPA = 'MD007';
UPDATE ref_motif_depart SET NM_ORDRE = 10 WHERE CD_MOTIDEPA = 'MD008';
UPDATE ref_motif_depart SET NM_ORDRE = 11 WHERE CD_MOTIDEPA = 'MD009';
UPDATE ref_motif_depart SET BL_VALI = 1 , NM_ORDRE = 24 WHERE CD_MOTIDEPA = 'MD010';
UPDATE ref_motif_depart SET BL_VALI = 1 , NM_ORDRE = 25 WHERE CD_MOTIDEPA = 'MD011';
UPDATE ref_motif_depart SET NM_ORDRE = 14 WHERE CD_MOTIDEPA = 'MD012';
UPDATE ref_motif_depart SET NM_ORDRE = 17 WHERE CD_MOTIDEPA = 'MD013';
UPDATE ref_motif_depart SET NM_ORDRE = 18 WHERE CD_MOTIDEPA = 'MD014';
UPDATE ref_motif_depart SET NM_ORDRE = 19 WHERE CD_MOTIDEPA = 'DCD';
UPDATE ref_motif_depart SET NM_ORDRE = 20 WHERE CD_MOTIDEPA = 'MD016';
UPDATE ref_motif_depart SET NM_ORDRE = 21 WHERE CD_MOTIDEPA = 'MD017';
UPDATE ref_motif_depart SET NM_ORDRE = 22 WHERE CD_MOTIDEPA = 'MD018';
UPDATE ref_motif_depart SET NM_ORDRE = 12 WHERE CD_MOTIDEPA = 'MD019';
UPDATE ref_motif_depart SET BL_FONC = 0, NM_ORDRE = 9 WHERE CD_MOTIDEPA = 'MD020';
INSERT INTO ref_motif_depart (ID_STAT, CD_MOTIDEPA, LB_MOTIDEPA, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, BL_DEPATEMP, BL_DEPADEFI, CD_MOTI_N4DS, BL_DEPATEMPREMU, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL, 'MD021', 'Mise en disponibilité de droit', 0, NOW(), 'ADMIN', NOW(), 'admin', 1, 0, 1, 0, NULL, NULL, NULL, 0, 6);
INSERT INTO ref_motif_depart (ID_STAT, CD_MOTIDEPA, LB_MOTIDEPA, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, BL_DEPATEMP, BL_DEPADEFI, CD_MOTI_N4DS, BL_DEPATEMPREMU, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL, 'MD022', 'Mise en disponibiliè sur demande', 0, NOW(), 'ADMIN', NOW(), 'admin', 1, 0, 1, 0, NULL, NULL, NULL, 0, 7);
INSERT INTO ref_motif_depart (ID_STAT, CD_MOTIDEPA, LB_MOTIDEPA, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, BL_DEPATEMP, BL_DEPADEFI, CD_MOTI_N4DS, BL_DEPATEMPREMU, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL, 'MD023', 'Fin de contrat d''agent remplaçant article 3-1 (ne pas inclure les agents contractuels mis en stage dans l''année 2019)', 0, NOW(), 'ADMIN', NOW(), 'admin', 0, 1, 0, 1, NULL, NULL, NULL, 0, 15);
INSERT INTO ref_motif_depart (ID_STAT, CD_MOTIDEPA, LB_MOTIDEPA, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, BL_DEPATEMP, BL_DEPADEFI, CD_MOTI_N4DS, BL_DEPATEMPREMU, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL, 'MD024', 'Fin de contrat agent Hors remplaçant article 3-1 (ne pas inclure les agents contractuels mis en stage dans l''année 2019)', 0, NOW(), 'ADMIN', NOW(), 'admin', 0, 1, 0, 1, NULL, NULL, NULL, 0, 16);
INSERT INTO ref_motif_depart (ID_STAT, CD_MOTIDEPA, LB_MOTIDEPA, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, BL_DEPATEMP, BL_DEPADEFI, CD_MOTI_N4DS, BL_DEPATEMPREMU, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL, 'MD025', 'Agent pris en charge par le CNFPT ou le CDG', 0, NOW(), 'ADMIN', NOW(), 'admin', 1, 0, 0, 1, NULL, NULL, NULL, 0, 13);

/* ref_motif_arrivee */
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA022','Recrutement direct - Nouvel arrivant dans la collectivité', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 21);
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA023','Recrutement direct - Agent déjà présent en 2019 en tant que contractuel permanent', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 22);
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA024','Recrutement direct - Agent déjà présent en tant que contractuel non permanent', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 23);
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA025','Voie de concours, sélection pro - Lauréat nouvel arrivant dans la collectivité', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 24);
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA026','Voie de concours, sélection pro - Lauréat déjà présent en 2019 en tant que contractuel permanent', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 25);
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA027','Voie de concours, sélection pro - Lauréat déjà présent en 2019 en tant que contractuel non permanent', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 26);
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA028','Réintégration agent non rémunéré pendant la période d''absence - retour de disponibilité', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 27);
INSERT INTO ref_motif_arrivee (ID_STAT, CD_MOTIARRI, LB_MOTIARRI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FONC, BL_CONTPERM, CD_MOTI_N4DS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES (NULL,'MA029','Réintégration agent non rémunéré pendant la période d''absence - autres cas', 0, NOW(),'ADMIN', NOW() ,'admin' , 0, 0, NULL, NULL, 0, 28);

/* ref_type_mission_prevention */
UPDATE ref_type_mission_prevention SET LB_TYPEMISSPREV = 'Agents chargés des fonctions d''inspection en hygiène et sécurité dans la collectivité (ACFI) ***, titulaires ou contractuels, agents de la collectivité' WHERE CD_TYPEMISSPREV = 'MP003';
UPDATE ref_type_mission_prevention SET LB_TYPEMISSPREV = 'Médecins de prévention, titulaires ou contractuels, agents de la collectivité' WHERE CD_TYPEMISSPREV = 'MP004';

/* ref_inaptitude */
UPDATE ref_inaptitude SET NM_ORDRE = NM_ORDRE +1 WHERE CD_INAP in ('INAP003','INAP004','INAP005','INAP006','INAP007','INAP008','INAP009','INAP010');
INSERT INTO ref_inaptitude (CD_INAP, LB_INAP, BL_DEMA, BL_DECI, BL_VISUAGEN, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FILI, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES('INAP011', 'Période de préparation au reclassement acceptée au cours de l''année', 0, 1,0, 0, NOW(), 'ADMIN', NOW(), 'admin', 0, null, 0,12);
INSERT INTO ref_inaptitude (CD_INAP, LB_INAP, BL_DEMA, BL_DECI, BL_VISUAGEN, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FILI, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES('INAP012', 'Période de préparation au reclassement refusée au cours de l''année', 0, 1,0, 0, NOW(), 'ADMIN', NOW(), 'admin', 0, null, 0,13);
INSERT INTO ref_inaptitude (CD_INAP, LB_INAP, BL_DEMA, BL_DECI, BL_VISUAGEN, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FILI, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES('INAP013', 'Reclassement effectif au cours de l''année, suite à une période de préparation au reclassement', 0, 1,0, 0, NOW(), 'ADMIN', NOW(), 'admin', 0, null, 0,14);
INSERT INTO ref_inaptitude (CD_INAP, LB_INAP, BL_DEMA, BL_DECI, BL_VISUAGEN, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_FILI, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE) VALUES('INAP014', 'Proposition de période de préparation au reclassement au cours de l''année', 1, 0,0, 0, NOW(), 'ADMIN', NOW(), 'admin', 0, null, 0,3);

/* ref_avancement_promotion_concours */
UPDATE ref_avancement_promotion_concours SET BL_VALI = 1 WHERE CD_AVANPROMCONC IN ('APC001','APC002','APC003','APC004','APC005');

/* ref_motif_absence */
INSERT INTO ref_motif_absence (CD_MOTIABSE, LB_MOTIABSE , BL_ABSECOMP , BL_ABSEMEDI , BL_ABSEAUTRRAIS ,  BL_VALI , created_at , CD_UTILCREA , updated_at , CD_UTILMODI ,  BL_ABSAGE , CD_MOTI_N4DS , CD_DGCL, BL_EXCLUTOTAL , NM_ORDRE ) VALUES ('ABS0010','Pour présence parentale', 0, 0, 0, 0, NOW(),'ADMIN', null , null, 0 , null, 0, 0, 10);
INSERT INTO ref_motif_absence (CD_MOTIABSE, LB_MOTIABSE , BL_ABSECOMP , BL_ABSEMEDI , BL_ABSEAUTRRAIS ,  BL_VALI , created_at , CD_UTILCREA , updated_at , CD_UTILMODI ,  BL_ABSAGE , CD_MOTI_N4DS , CD_DGCL, BL_EXCLUTOTAL , NM_ORDRE ) VALUES ('ABS0011','Pour solidarité familiale', 0, 0, 0, 0, NOW(),'ADMIN', null , null, 0 , null, 0, 0, 11);

DROP TABLE ind_2151;
DROP TABLE ind_2152;
