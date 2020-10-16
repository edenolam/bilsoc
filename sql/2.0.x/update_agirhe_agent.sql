ALTER TABLE `agirhe_agent` CHANGE `carriere_position_particuliere_code_bs` `carriere_position_particuliere_code_bs` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `agirhe_agent`
  DROP `cet_existance`,
  DROP `cet_ouverture`,
  DROP `cet_jours_cumuls`;