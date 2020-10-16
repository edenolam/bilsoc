DELIMITER $$

DROP PROCEDURE IF EXISTS historisation_aucun_changement
$$

CREATE PROCEDURE historisation_aucun_changement()
COMMENT ''
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
BEGIN
	
    INSERT INTO historique_collectivite (ID_COLL, ID_DEPA, ID_NATURE_MAJ, NM_NOUV_SIRE, NM_ANCI_SIRE, LB_TYPE_ARCH, CD_UTILCREA, DT_ARCH, DT_CREA)
	SELECT co.ID_COLL, dep.ID_DEPA, nmaj.ID_NATURE_MAJ, ish.NM_SIRE, ish.NM_SIRE, 'Vide', 'Import', CONVERT("2018-12-31", DATE), NOW()
	FROM import_siret_historisation ish 
	JOIN ref_nature_maj nmaj ON nmaj.CD_STAT = 'ac'
	JOIN departement dep ON dep.CD_DEPA = ish.ID_DEPA
	JOIN collectivite co ON co.ID_COLL = ish.ID_COLL
	WHERE ish.BL_ERREUR = 0 AND ish.Bl_ARCHI = 0 AND ish.MOTIF = 'vide';

	DELETE FROM import_siret_historisation WHERE BL_ERREUR = 0 AND Bl_ARCHI = 0 AND MOTIF = 'vide';
  
END
$$
