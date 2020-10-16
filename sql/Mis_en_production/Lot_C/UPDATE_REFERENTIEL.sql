/* Mise à jour du référentiel des motifs de départs */
UPDATE ref_motif_depart SET BL_DEPATEMPREMU = 1 WHERE CD_MOTIDEPA = 'MD001';
UPDATE ref_motif_depart SET BL_DEPATEMPREMU = 1 WHERE CD_MOTIDEPA = 'MD002';
UPDATE ref_motif_depart SET BL_DEPATEMPREMU = 1 WHERE CD_MOTIDEPA = 'MD003';

/* Mise à jour du référentiel des mises en stage ou titularisations */
DELETE FROM ref_stage_titularisation WHERE CD_STAGTITU = 'SAUVADET';
INSERT INTO ref_stage_titularisation(CD_STAGTITU, LB_STAGTITU, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI)
	VALUES('TS006', 'Agents contractuels nommés stagiaires dans l''année 2017', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_stage_titularisation(CD_STAGTITU, LB_STAGTITU, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI)
	VALUES('SAUVADET', 'Agents contractuels nommés stagiaires dans l''année 2017 dans le cadre des sélections professionnelles de la loi du 12 mars 2012"', 0, now(), 'ADMIN', now(), 'ADMIN');

/* Insertion des mouvements internes dans le référentiel des mouvements internes */
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI001', 'Pas de mouvement interne', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI002', 'Retour suite à la mise à disposition dans une autre collectivité ou structure (ne prendre en compte que les mises à disposition complètes)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI003', 'Retour suite à une décharge totale de service pour exercice de mandats syndicaux (article 100)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI004', 'Retour suite à congés formation encore rémunéré par la collectivité (max 1 an)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI005', 'Retour suite à congés formation au-delà d''un an', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI006', 'Retour suite à un détachement dans une autre structure. Agents de la collectivité qui ont été détachés dans l''année N dans une autre structure (fonction publique d''Etat, fonction publique hospitalière)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI007', 'Retour suite à une mise en disponibilité', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI008', 'Retour suite à congés parental', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_mouvement_interne_annee (CD_MOUVINTEANNE, LB_MOUVINTEANNE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES('MI009', 'Retour suite à congés sans traitement (convenances personnelles, suivi de conjoint)', 0, now(), 'ADMIN', now(), 'ADMIN');

/* Nous relions les mouvements internes avec les status */
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,1);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,1);
INSERT INTO statut_Mouv_Inte_Anne VALUES(3,1);
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,2);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,2);
INSERT INTO statut_Mouv_Inte_Anne VALUES(3,2);
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,3);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,3);
INSERT INTO statut_Mouv_Inte_Anne VALUES(3,3);
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,4);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,4);
INSERT INTO statut_Mouv_Inte_Anne VALUES(3,4);
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,5);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,5);
INSERT INTO statut_Mouv_Inte_Anne VALUES(3,5);
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,6);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,6);
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,7);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,7);
INSERT INTO statut_Mouv_Inte_Anne VALUES(1,8);
INSERT INTO statut_Mouv_Inte_Anne VALUES(2,8);
INSERT INTO statut_Mouv_Inte_Anne VALUES(3,8);
INSERT INTO statut_Mouv_Inte_Anne VALUES(3,9);

/* Promotion avancement stage */
UPDATE ref_avancement_promotion_concours SET LB_AVANPROMCONC = 'Promotion interne au sein de la collectivité (choix)' WHERE CD_AVANPROMCONC = 'APC003';
UPDATE ref_avancement_promotion_concours SET LB_AVANPROMCONC = 'Réussite à un concours ayant entrainé "une nomination stagiaire"' WHERE CD_AVANPROMCONC = 'APC004';
INSERT INTO ref_avancement_promotion_concours(CD_AVANPROMCONC, LB_AVANPROMCONC, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI)
	VALUES('APC005', 'Promotion interne au sein de la collectivité (examen professionnel) ayant entraîné une "nomination stagiaire"', 0, now(), 'ADMIN', now(), 'ADMIN');
	
/* Mise à jour d'un élément du référentiel des organismes */
UPDATE ref_organisme_formation SET LB_ORGAFORM = 'Collectivité' WHERE CD_ORGAFORM = 'ORG005';

/* Modification des cycles de travail */
UPDATE ref_cycle_travail SET BL_VALI = 0 WHERE CD_CYCLTRAV IN ('CTT001', 'CTT004', 'CTT004b', 'CTT005');

/* Modification du BL_ACTI = 1 pour les collectivités qui l'ont à NULL */
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21380362000011';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21971133000015';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21972212100015';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21974020600012';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21973309400136';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21030229500014';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21150037600010';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21630381800019';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21430041000013';
UPDATE collectivite SET BL_ACTI = 1 WHERE NM_SIRE = '21730278500019';

/* Modification du référentiel des emplois non permanent */
UPDATE ref_emploi_non_permanent SET BL_CDG = 0 WHERE CD_EMPLNONPERM <> 'EF009';
UPDATE ref_emploi_non_permanent SET BL_CDG = 1 WHERE CD_EMPLNONPERM = 'EF009';