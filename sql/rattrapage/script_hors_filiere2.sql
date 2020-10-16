
INSERT INTO ref_filiere(CD_FILI, LB_FILI, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_CONS, BL_EMPFONC, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE)
VALUES ('HH', 'Hors filière', 1, now(), 'ADMIN', now(), 'ADMIN', 1, 0, null,0 ,13);


INSERT INTO ref_categorie(CD_CATE, LB_CATE, BL_VALI, created_at, CD_UTILCREA, updated_at, CD_UTILMODI, BL_CONS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE)
VALUES ('HH', 'Hors filière', 1, now(), 'ADMIN', now(), 'ADMIN', 1, null,0,6);


INSERT INTO ref_cadre_emploi(CD_CADREMPL, LB_CADREMPL, BL_VALI, CD_UTILCREA, CD_UTILMODI, ID_FILI, ID_CATE, BL_CONS, CD_DGCL, BL_EXCLUTOTAL, NM_ORDRE)
VALUES ('CE061', 'Hors filières (pour les agents non permanents)', 0, 'ADMIN', 'ADMIN', 13, 6, 1, 'HH', 0, 61);


