/* Script de mise à jour du référentiel des motifs d'absence afin de mettre à jour les codes N4DS associés pour l'import N4DS */

/* Pour maladie ordinaire */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '100' WHERE CD_MOTIABSE = 'ABS001';

/* Pour longue maladie, disponibilité d'office et grave maladie */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '106-113' WHERE CD_MOTIABSE = 'ABS002';

/* Pour accidents du travail imputables au service */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '110' WHERE CD_MOTIABSE = 'ABS003';

/* Pour accidents du travail imputables au trajet */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '105' WHERE CD_MOTIABSE = 'ABS004';

/* Pour maladie professionnelle, maladie imputable au service ou à caractère professionnel */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '107-108' WHERE CD_MOTIABSE = 'ABS005';

/* Pour maternité et adoption (1) */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '200-202' WHERE CD_MOTIABSE = 'ABS006';

/* Pour paternité, accueil de l'enfant et adoption  */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '201-203' WHERE CD_MOTIABSE = 'ABS007';

/* Pour maladie de longue durée */
UPDATE ref_motif_absence SET CD_MOTI_N4DS = '115' WHERE CD_MOTIABSE = 'ABS009';