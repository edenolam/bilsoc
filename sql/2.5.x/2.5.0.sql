- Importer la procédure stockée : apa_to_conso.sql)
- Importer la procédure stockée : V1_53__IND-611-613.sql
- Importer la procédure stockée : V1_11__IND-141.sql
- Importer la procédure stockée : R__35-DGCL-export-process.sql
/* Script pour supprimer toutes les entrés dans la base de donnée de l'indicateur 331 pour être en accord au fichier DGCL ticket 4368 */

/*   /!\   Avoir l'accord de cédric avant d'éxécuter !!    */
DELETE ind_331 FROM `ind_331` JOIN ref_emploi_non_permanent r ON r.ID_EMPLNONPERM = ind_331.ID_EMPLNONPERM WHERE r.CD_EMPLNONPERM NOT IN('EF002','EF003','EF999')
