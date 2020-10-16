/*
*	désarchivage de la ligne CTT005 (Autre cycle) pour le référentiel ref_cycle_travail
*/
UPDATE ref_cycle_travail
SET BL_VALI = 0
WHERE CD_CYCLTRAV = "CTT005";