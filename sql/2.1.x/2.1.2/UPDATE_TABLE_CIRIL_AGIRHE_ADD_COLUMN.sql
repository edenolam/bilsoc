ALTER TABLE `ciril_collectivite` ADD `file_key` VARCHAR(43) NOT NULL AFTER `can_import`, ADD INDEX `IDX_FILE_KEY` (`file_key`);
ALTER TABLE `ciril_agent` ADD `file_key` VARCHAR(43) NOT NULL AFTER `grade`, ADD INDEX `IDX_FILE_KEY` (`file_key`);
ALTER TABLE `agirhe_collectivite` ADD `file_key` VARCHAR(43) NOT NULL AFTER `can_import`, ADD INDEX `IDX_FILE_KEY` (`file_key`);
ALTER TABLE `agirhe_agent` ADD `file_key` VARCHAR(43) NOT NULL AFTER `metier_code_cnfpt`, ADD INDEX `IDX_FILE_KEY` (`file_key`)