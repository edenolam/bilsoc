---- Passer la procédure stockée suivante ----
-- 5211 --

save_data_agents_when_close_campagne  (dans le dossier sql/Procedures-stockees)
sp-DASHBOARD_cdg (dans le dossier sql/Procedures-stockees)

V1_57_HANDITORIAL (dans le dossier sql/Procedures-stockees/apa2cons)
V2_2__DGCL-1-jours-carence.sql (dans le dossier sql/Procedures-stockees/apa2cons)
apa_to_conso.sql (dans le dossier sql/Procedures-stockees/apa2cons)

historisation_aucun_changement.sql (dans le dossier sql/Procedures-stockees)
historisation_creation.sql (dans le dossier sql/Procedures-stockees)

apaExport.sql (dans le dossier sql/Procedures-stockees)

---- IMPORTANT ----

---- NE PAS OUBLIER DE PASSER LES RESTRICTIONS DES CLÉS ÉTRANGÈRES DE LA TABLE POOL_EXPORT EN CASCADE REMOVE AU LIEU DE RESTRICT (POOL_EXPORT) ----

ALTER TABLE `pool_export`
	DROP FOREIGN KEY `FK_9704690A27DA1639`,
	DROP FOREIGN KEY `FK_9704690ADA35649A`;
ALTER TABLE `pool_export`
	ADD CONSTRAINT `FK_9704690A27DA1639` FOREIGN KEY (`ID_TASK`) REFERENCES `bsltm_longtask_header` (`id`) ON DELETE CASCADE,
	ADD CONSTRAINT `FK_9704690ADA35649A` FOREIGN KEY (`ID_POOL`) REFERENCES `pool` (`ID_POOL`) ON DELETE CASCADE;

--- correction du nom de la colonne Bl_JOURS_CARENCE -> BL_JOURS_CARENCE

ALTER TABLE `bilan_social_agent_dgcl`
	CHANGE COLUMN `Bl_JOURS_CARENCE` `BL_JOURS_CARENCE` TINYINT(1) NULL DEFAULT NULL FIRST;

----
---- corection du nom de la colonne Bl_CREA -> BL_CREA

ALTER TABLE `ref_nature_maj`
	CHANGE COLUMN `Bl_CREA` `BL_CREA` INT(11) NULL DEFAULT NULL AFTER `CD_UTILMODI`;