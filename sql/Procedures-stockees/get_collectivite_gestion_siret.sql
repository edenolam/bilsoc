/*
*	Précédure stockée permettant de récupérer les collectivités pour la gestion des sirets (admin)
*/
DELIMITER $$
DROP PROCEDURE IF EXISTS get_collectivite_gestion_siret $$
CREATE PROCEDURE get_collectivite_gestion_siret()
	BEGIN
		DROP TEMPORARY TABLE IF EXISTS not_proccessed;
		CREATE TEMPORARY TABLE IF NOT EXISTS not_proccessed (
			lbColl VARCHAR(255)
			, lbDepa VARCHAR(255)
			, cdDepa VARCHAR(255)
			, lbAdre VARCHAR(255)
			, lbVill VARCHAR(255)
			, ancienSiret VARCHAR(255)
			, nmSire VARCHAR(255)
			, INDEX(nmSire)
		);
		INSERT INTO not_proccessed  
			SELECT DISTINCT i0_.LB_COLL AS lbColl, d1_.LB_DEPA AS lbDepa, d1_.CD_DEPA AS cdDepa, i0_.LB_ADRE AS lbAdre, i0_.LB_VILL AS lbVill, i0_.ancienSiret  AS ancienSiret, i0_.NM_SIRE AS nmSire 
			FROM import_siret_historisation i0_ 
			INNER JOIN departement d1_ ON (d1_.CD_DEPA = i0_.ID_DEPA) 
			INNER JOIN cdg_departement c2_ ON (c2_.ID_DEPA = d1_.ID_DEPA AND c2_.FG_TYPE = 0) 
			INNER JOIN utilisateur_cdg u3_ ON (u3_.ID_CDG = c2_.ID_CDG) 
			WHERE i0_.BL_ERREUR = 0
		;
		#SELECT * FROM not_proccessed;
		#SELECT np.NM_SIRE FROM not_proccessed np ORDER BY np.NM_SIRE;
		DROP TEMPORARY TABLE IF EXISTS to_exclude;
		CREATE TEMPORARY TABLE IF NOT EXISTS to_exclude (
			ID_HISTCOLL VARCHAR(255)
			, INDEX(ID_HISTCOLL)
		);
		INSERT INTO to_exclude  
			SELECT DISTINCT hc.ID_HISTCOLL AS NM_SIRE
			FROM historique_collectivite hc
			WHERE hc.ID_NATURE_MAJ = 3 AND hc.ID_HISTCOLL IN (
				SELECT MAX(hc2.ID_HISTCOLL)
				FROM historique_collectivite hc2
				GROUP BY hc2.NM_NOUV_SIRE
			)
		;
		#SELECT * FROM to_exclude te ORDER BY te.ID_HISTCOLL;
		DROP TEMPORARY TABLE IF EXISTS to_get;
		CREATE TEMPORARY TABLE IF NOT EXISTS to_get (
			ID_HISTCOLL VARCHAR(255)
			, INDEX(ID_HISTCOLL)
		);
		INSERT INTO to_get  
			SELECT DISTINCT hc.ID_HISTCOLL AS NM_SIRE
			FROM historique_collectivite hc
			WHERE hc.ID_NATURE_MAJ = 1 AND hc.ID_HISTCOLL IN (
				SELECT MAX(hc2.ID_HISTCOLL)
				FROM historique_collectivite hc2
				GROUP BY hc2.NM_NOUV_SIRE
			)
		;
		#SELECT * FROM to_get tg ORDER BY tg.ID_HISTCOLL;
		DROP TEMPORARY TABLE IF EXISTS to_add;
		CREATE TEMPORARY TABLE IF NOT EXISTS to_add (
			lbColl VARCHAR(255)
			, lbDepa VARCHAR(255)
			, cdDepa VARCHAR(255)
			, lbAdre VARCHAR(255)
			, lbVill VARCHAR(255)
			, ancienSiret VARCHAR(255)
			, nmSire VARCHAR(255)
			, INDEX(nmSire)
		);
		INSERT INTO to_add  
		SELECT DISTINCT i0_.LB_COLL AS lbColl, d1_.LB_DEPA AS lbDepa, d1_.CD_DEPA AS cdDepa, i0_.LB_ADRE AS lbAdre, i0_.LB_VILL AS lbVill, hc.NM_ANCI_SIRE AS ancienSiret, i0_.NM_SIRE AS nmSire 
			FROM historique_collectivite hc
			INNER JOIN collectivite i0_ ON i0_.NM_SIRE = hc.NM_NOUV_SIRE
			INNER JOIN departement d1_ ON (d1_.ID_DEPA = i0_.ID_DEPA) 
			INNER JOIN cdg_departement c2_ ON (c2_.ID_DEPA = d1_.ID_DEPA AND c2_.FG_TYPE = 0) 
			INNER JOIN utilisateur_cdg u3_ ON (u3_.ID_CDG = c2_.ID_CDG)  
			WHERE hc.ID_NATURE_MAJ = 1 
				AND hc.NM_NOUV_SIRE NOT IN (SELECT np.nmSire FROM not_proccessed np)
				#AND hc.ID_HISTCOLL NOT IN (SELECT te.ID_HISTCOLL FROM to_exclude te)
				AND hc.ID_HISTCOLL IN (SELECT tg.ID_HISTCOLL FROM to_get tg)
			GROUP BY hc.NM_NOUV_SIRE ORDER BY hc.NM_NOUV_SIRE;
		SELECT * FROM not_proccessed
		UNION
		SELECT * FROM to_add;
	END
$$