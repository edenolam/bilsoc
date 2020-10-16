DELIMITER $$

DROP TRIGGER IF EXISTS `bilan_social_agent_ai_row`
$$

CREATE TRIGGER `bilan_social_agent_ai_row` AFTER INSERT ON `bilan_social_agent` FOR EACH ROW
  BEGIN
    #
    # Calcul du taux de remplissage du statut (duplication du trigger update)
    #
    
  END;
$$

DROP TRIGGER IF EXISTS `bilan_social_agent_bu_row`
$$

CREATE TRIGGER `bilan_social_agent_bu_row` BEFORE UPDATE ON `bilan_social_agent` FOR EACH ROW
  BEGIN
    #
    # Calcul du pourcentage de remplissage des groupes de questions
    #
    SET NEW.PC_FILLGROUP_FORMATION = ROUND(
        (
          CASE NEW.BL_FORMSUIV
          WHEN 1 THEN 1	# Oui
          # TODO Manque comptage de formation déclaré
          WHEN 0 THEN 2	# Non
          ELSE 0 END
          + CASE NEW.BL_VAE
            WHEN 1 THEN 1	# Oui
                        + CASE NEW.ID_EBCF WHEN NULL THEN 0 ELSE 1 END		# Repondu
            WHEN 0 THEN 2	# Non
            ELSE 0 END
          + CASE NEW.BL_BILACOMP
            WHEN 1 THEN 1
                        + CASE NEW.NB_BILACOMP WHEN NULL THEN 0 ELSE 1 END	# Repondu
                        + CASE NEW.BL_CONGFORM WHEN NULL THEN 0 ELSE 1 END	# Repondu
            WHEN 0 THEN 3	# Non
            ELSE 0 END
        ) * 100 / 7.0	# Nombre total de questions du groupe
    );
  END;
$$
