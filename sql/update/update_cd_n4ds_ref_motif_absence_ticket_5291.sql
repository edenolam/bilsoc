/*
*	script sql de mise à jour du code n4ds du référentel motif absence "maladie ordianire" (ajout du code 118) (ticket #5291)
*	concerne les jours de carence
*/
UPDATE `bs`.`ref_motif_absence` SET `CD_MOTI_N4DS`='100-118' WHERE  `ID_MOTIABSE`='ABS001';