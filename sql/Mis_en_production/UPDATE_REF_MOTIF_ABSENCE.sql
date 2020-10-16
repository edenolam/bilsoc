/* Mise à jour des Boolean au sein de la table ref_motif_absence */

/* Mise à jour du BL_ABSAGE pour savoir quels sont les motifs d'absence qui doivent apparaître au sein des tableaux des ages */
UPDATE ref_motif_absence SET BL_ABSAGE = 1 WHERE CD_MOTIABSE IN ('ABS001', 'ABS002', 'ABS003', 'ABS004', 'ABS005');

/* Mise à jour du BL_ABSECOMP pour les motifs d'absence compressible */
UPDATE ref_motif_absence SET BL_ABSECOMP = 1 WHERE CD_MOTIABSE IN ('ABS001', 'ABS003', 'ABS004');

/* Mise à jour du BL_ABSEMEDI pour les motifs d'absence médicale */
UPDATE ref_motif_absence SET BL_ABSECOMP = 1 WHERE CD_MOTIABSE IN ('ABS001', 'ABS002', 'ABS003', 'ABS004', 'ABS005');

/* Mise à jour du BL_ABSEAUTRRAIS pour les motifs d'absence autres raisons */
UPDATE ref_motif_absence SET BL_ABSECOMP = 1 WHERE CD_MOTIABSE IN ('ABS006', 'ABS007', 'ABS008');