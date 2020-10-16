DELIMITER $$

DROP PROCEDURE IF EXISTS historisation_init_erreur
$$

CREATE PROCEDURE historisation_init_erreur()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
		
	UPDATE import_siret_historisation SET BL_ERREUR = 0, LB_ERREUR = NULL;
	
	UPDATE import_siret_historisation  i
	SET i.BL_ERREUR = 1, i.LB_ERREUR = 'Collectivite inconnue'
	WHERE i.ID_COLL is not null
	AND NOT EXISTS (SELECT 1 FROM collectivite c WHERE c.ID_COLL = i.ID_COLL);

	UPDATE import_siret_historisation  i
	SET i.BL_ERREUR = 1, i.LB_ERREUR = 'Departement inconnu'
	WHERE NOT EXISTS (SELECT 1 FROM departement d WHERE d.CD_DEPA = i.ID_DEPA);
  
END
$$
