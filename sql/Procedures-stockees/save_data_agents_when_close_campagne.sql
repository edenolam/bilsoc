DELIMITER $$

DROP PROCEDURE IF EXISTS `remove_old_bilan_social_agent` $$

CREATE PROCEDURE `remove_old_bilan_social_agent`(IN `param_idCampagne` INT)
BEGIN

    DELETE bsa FROM bilan_social_agent bsa
    JOIN enquete e ON bsa.ID_ENQU = e.ID_ENQU
    JOIN campagne c ON e.ID_CAMP = c.ID_CAMP
    WHERE c.ID_CAMP = `param_idCampagne`
    AND DATEDIFF(bsa.created_at, NOW()) > 730;
	
END $$

DELIMITER $$

DROP PROCEDURE IF EXISTS `clean_data_agents_table` $$

CREATE PROCEDURE `clean_data_agents_table`()
BEGIN

    DELETE s FROM sauvegarde_donnees_agents s
    INNER JOIN bilan_social_agent bsa ON (s.LB_NOM = bsa.LB_NOM AND s.LB_PRENOM = bsa.LB_PREN AND s.DATE_NAISSANCE = bsa.LB_DATENAIS);
	
END $$

DELIMITER $$
	
DROP PROCEDURE IF EXISTS `save_data_agents_when_closing_campagne`
$$

CREATE PROCEDURE `save_data_agents_when_closing_campagne`(IN `param_idCampagne` INT)
BEGIN

    INSERT INTO sauvegarde_donnees_agents (LB_NOM, LB_PRENOM, DATE_NAISSANCE, 
    ID_METIER, ID_DOMAINE_DIPLOME_GPEEC, ID_CATEGORIE_BOETH, 
    ID_NATURE_HANDICAP_BOETH, ID_MESURE_INAPTITUDE_ENCOURS_ANNNE, 
    ID_MESURE_INAPTITUDE_AVANT_ANNNE, BL_AVIS_INAPTITUDE_EN_COURS,
    ID_INAPTITUDE_ENCOURS_ANNNE, BL_AVIS_INAPTITUDE_AVANT, ID_INAPTITUDE_AVANT_ANNNE, ID_ENQU, ID_COLL, ID_SPECIALITE, BL_BOETH)
    SELECT bs.LB_NOM, bs.LB_PREN, LB_DATENAIS, gpeec.ID_METIER, gpeec.ID_DOMAINE_DIPLOME_GPEEC, 
    hand.id_categorie_boeth, hand.id_nature_handicap_boeth, 
    hand.id_mesure_inaptitude_encours_annne, hand.id_mesure_inaptitude_avant_annne, hand.bl_avis_inaptitude_en_cours, 
    hand.id_inaptitude_encours_annne, hand.bl_avis_inaptitude_avant, hand.id_inaptitude_avant_annne, bs.ID_ENQU, bs.ID_COLL, gpeecplus.ID_SPECIALITE, bs.BL_BOETH
    FROM bilan_social_agent bs
    LEFT JOIN Bilan_Social_Agent_Handitorial hand ON bs.ID_BILASOCIAGEN = hand.ID_BILASOCIAGEN
    LEFT JOIN bilan_social_agent_gpeec gpeec ON bs.ID_BILASOCIAGEN = gpeec.ID_BILASOCIAGEN
    LEFT JOIN bilan_social_agent_gpeec_plus gpeecplus ON bs.ID_BILASOCIAGEN = gpeecplus.ID_BILASOCIAGEN
    JOIN enquete e ON bs.ID_ENQU = e.ID_ENQU
    JOIN campagne c ON e.ID_CAMP = c.ID_CAMP
    WHERE c.ID_CAMP = `param_idCampagne`
    GROUP BY bs.ID_BILASOCIAGEN;
	
END $$
DELIMITER ;