/* Mise à jour du référentiel des types de CDD */
UPDATE ref_type_cdd SET LB_TYPECDD = CONCAT(LB_TYPECDD, ' - Remplaçants') WHERE CD_TYPECDD = 'CDD001';
UPDATE ref_type_cdd SET LB_TYPECDD = CONCAT(LB_TYPECDD, ' - Affectés sur un poste vacant') WHERE CD_TYPECDD = 'CDD002';
UPDATE ref_type_cdd SET LB_TYPECDD = CONCAT(LB_TYPECDD, ' - Pas de cadre d''emplois existant') WHERE CD_TYPECDD = 'CDD003';
UPDATE ref_type_cdd SET LB_TYPECDD = CONCAT(LB_TYPECDD, ' - Catégorie A selon les fonctions ou pour des besoins de service') WHERE CD_TYPECDD = 'CDD004';
UPDATE ref_type_cdd SET LB_TYPECDD = CONCAT(LB_TYPECDD, ' - Secrétaire de mairie dans les communes et groupements de communes de moins de 1000 habitants') WHERE CD_TYPECDD = 'CDD005';
UPDATE ref_type_cdd SET LB_TYPECDD = CONCAT(LB_TYPECDD, ' - Temps non complet des communes et groupements de communes de moins de 1000 hab., lorsque la quotité de temps de travail est inférieure à 50 %') WHERE CD_TYPECDD = 'CDD006';
UPDATE ref_type_cdd SET LB_TYPECDD = CONCAT(LB_TYPECDD, ' - Communes de moins de 2000 hab. et groupements de communes de moins de 10 000 hab. dont la création ou la suppression dépend de la décision d''une autorité qui s''impose à la collectivité') WHERE CD_TYPECDD = 'CDD007';