DELETE FROM `acte_violence_physique` WHERE ID_ACTEVIOLPHYS IN (5,6,7,8)
DELETE FROM `ref_acte_violence_physique` WHERE `ref_acte_violence_physique`.`ID_ACTEVIOLPHYS` = 5;
DELETE FROM `ref_acte_violence_physique` WHERE `ref_acte_violence_physique`.`ID_ACTEVIOLPHYS` = 6;
DELETE FROM `ref_acte_violence_physique` WHERE `ref_acte_violence_physique`.`ID_ACTEVIOLPHYS` = 7;
DELETE FROM `ref_acte_violence_physique` WHERE `ref_acte_violence_physique`.`ID_ACTEVIOLPHYS` = 8;
DELETE FROM `ref_categorie` WHERE `ref_categorie`.`ID_CATE` = 9;