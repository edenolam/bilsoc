--
-- Structure de la table `agirhe_absence`
--

DROP TABLE IF EXISTS `agirhe_absence`;
CREATE TABLE IF NOT EXISTS `agirhe_absence` (
  `id_agirhe_absence` int(10) NOT NULL,
  `agent_identifiant` int(10) DEFAULT NULL,
  `absence_code_agirhe` varchar(100) DEFAULT NULL,
  `absence_motif` varchar(100) DEFAULT NULL,
  `absence_jours_arret` int(10) DEFAULT NULL,
  `absence_date` date DEFAULT NULL,
  PRIMARY KEY (`id_agirhe_absence`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `agirhe_agent`
--

DROP TABLE IF EXISTS `agirhe_agent`;
CREATE TABLE IF NOT EXISTS `agirhe_agent` (
  `agent_identifiant` int(10) NOT NULL,
  `id_agirhe_collectivite` int(10) DEFAULT NULL,
  `agent_nom` varchar(100) DEFAULT NULL,
  `agent_prenom` varchar(100) DEFAULT NULL,
  `agent_genre` varchar(1) DEFAULT NULL,
  `agent_date_naissance` date DEFAULT NULL,
  `situation_remunere3112` tinyint(1) DEFAULT NULL,
  `situation_remunere_annee` tinyint(1) DEFAULT NULL,
  `situation_arrivee_periode` tinyint(1) DEFAULT NULL,
  `carriere_position_type_bs` varchar(50) DEFAULT NULL,
  `carriere_position_code_agirhe` int(10) DEFAULT NULL,
  `carriere_position_particuliere_code_bs` int(10) DEFAULT NULL,
  `carriere_qualite_statutaire_code_libelle` varchar(100) DEFAULT NULL,
  `carriere_grade_code_net` varchar(4) DEFAULT NULL,
  `carriere_duree_hebdo_type_tnc` varchar(100) DEFAULT NULL,
  `carriere_temps_travail_type_tp` varchar(100) DEFAULT NULL,
  `carriere_temps_travail_motif_tp` varchar(100) DEFAULT NULL,
  `situation_emploi_fonctionnel` tinyint(1) DEFAULT NULL,
  `carriere_emploi_fonctionnel_grade` varchar(4) DEFAULT NULL,
  `carriere_detachement_origine_fp` text,
  `carriere_motif_arrivee` text,
  `carriere_titularisation_date` date DEFAULT NULL,
  `carriere_stage_date` date DEFAULT NULL,
  `situation_titularisation_sauvadet` tinyint(1) DEFAULT NULL,
  `situation_depart_date` date DEFAULT NULL,
  `situation_depart_motif` varchar(100) DEFAULT NULL,
  `situation_mouvement_interne` tinyint(1) DEFAULT NULL,
  `carriere_cdi` tinyint(1) DEFAULT NULL,
  `carriere_cdd_type` varchar(100) DEFAULT NULL,
  `carriere_contrat_non_permanent` varchar(100) DEFAULT NULL,
  `carriere_contrat_date_debut` date DEFAULT NULL,
  `carriere_avancement_grade_date` date DEFAULT NULL,
  `carriere_position_date_debut` date DEFAULT NULL,
  `situation_promotion_annee` varchar(100) DEFAULT NULL,
  `metier_code_cnfpt` varchar(100) DEFAULT NULL,
  `cet_existance` tinyint(1) DEFAULT NULL,
  `cet_ouverture` tinyint(1) DEFAULT NULL,
  `cet_jours_cumuls` int(10) DEFAULT NULL,
  PRIMARY KEY (`agent_identifiant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `agirhe_collectivite`
--

DROP TABLE IF EXISTS `agirhe_collectivite`;
CREATE TABLE IF NOT EXISTS `agirhe_collectivite` (
  `id_agirhe_collectivite` int(10) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `siret` varchar(14) DEFAULT NULL,
  `cdg` int(10) DEFAULT NULL,
  `libelle_collectivite` varchar(255) DEFAULT NULL,
  `affiliation_cdg` int(11) DEFAULT NULL,
  `ct_cdg` int(11) DEFAULT NULL,
  `can_import` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_agirhe_collectivite`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `agirhe_formation`
--

DROP TABLE IF EXISTS `agirhe_formation`;
CREATE TABLE IF NOT EXISTS `agirhe_formation` (
  `id_agirhe_formation` int(10) NOT NULL,
  `agent_identifiant` int(10) DEFAULT NULL,
  `formation_organisme` varchar(100) DEFAULT NULL,
  `formation_type` varchar(100) DEFAULT NULL,
  `formation_date` date DEFAULT NULL,
  `formation_heures` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_agirhe_formation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ciril_agent`
--

DROP TABLE IF EXISTS `ciril_agent`;
CREATE TABLE IF NOT EXISTS `ciril_agent` (
  `identifiant_agent` int(11) NOT NULL,
  `identifiant_collectivite` int(11) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `sexe` tinyint(1) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `date_situation` date DEFAULT NULL,
  `agent_handicape` varchar(1) DEFAULT NULL,
  `situation_type_contrat` int(11) DEFAULT NULL,
  `type_temps_travail` int(11) DEFAULT NULL,
  `duree_travail_hebdo` int(11) DEFAULT NULL,
  `date_entree_collectivite` date DEFAULT NULL,
  `modalite_entree_collectivite` int(11) DEFAULT NULL,
  `date_sortie_collectivite` date DEFAULT NULL,
  `modalite_sortie_collectivite` int(11) DEFAULT NULL,
  `niveau_diplome` varchar(10) DEFAULT NULL,
  `metier` varchar(10) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`identifiant_agent`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ciril_collectivite`
--

DROP TABLE IF EXISTS `ciril_collectivite`;
CREATE TABLE IF NOT EXISTS `ciril_collectivite` (
  `identifiant_collectivite` int(11) NOT NULL,
  `date_extraction` date DEFAULT NULL,
  `affilie_cdg` tinyint(1) DEFAULT NULL,
  `commune_surclasse` tinyint(1) DEFAULT NULL,
  `ctp_propre` tinyint(4) DEFAULT NULL,
  `libelle_collectivite` varchar(100) DEFAULT NULL,
  `siret` varchar(14) DEFAULT NULL,
  `departement` int(11) DEFAULT NULL,
  `can_import` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`identifiant_collectivite`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ciril_formation`
--

DROP TABLE IF EXISTS `ciril_formation`;
CREATE TABLE IF NOT EXISTS `ciril_formation` (
  `id_ciril_formation` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant_agent` int(11) NOT NULL,
  `date_formation` date DEFAULT NULL,
  `nombre_jours` int(11) DEFAULT NULL,
  `organisme_formateur` varchar(10) DEFAULT NULL,
  `type_formation` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_ciril_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
COMMIT;
