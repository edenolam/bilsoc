-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 22 Novembre 2017 à 15:13
-- Version du serveur: 5.5.24
-- Version de PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Structure de la table `ref_domaine_professionnel`
--

CREATE TABLE IF NOT EXISTS `ref_domaine_professionnel` (
  `ID_DOMAINE_PROFESSIONNEL` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `CD_DOMAINE_PROFESSIONNEL` varchar(10) DEFAULT NULL,
  `LB_DOMAINE_PROFESSIONNEL` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `CD_UTILCREA` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`ID_DOMAINE_PROFESSIONNEL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Domaine professionnel' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ref_domaine_professionnel`
--

INSERT INTO ref_domaine_professionnel(CD_DOMAINE_PROFESSIONNEL, LB_DOMAINE_PROFESSIONNEL, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES ('DM001', 'Pilotage et management des ressources', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_professionnel(CD_DOMAINE_PROFESSIONNEL, LB_DOMAINE_PROFESSIONNEL, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES ('DM002', 'Politiques d''aménagement et de développement territorial', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_professionnel(CD_DOMAINE_PROFESSIONNEL, LB_DOMAINE_PROFESSIONNEL, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES ('DM003', 'Interventions techniques', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_professionnel(CD_DOMAINE_PROFESSIONNEL, LB_DOMAINE_PROFESSIONNEL, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES ('DM004', 'Services à la population', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_professionnel(CD_DOMAINE_PROFESSIONNEL, LB_DOMAINE_PROFESSIONNEL, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES ('DM005', 'Sécurité', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_professionnel(CD_DOMAINE_PROFESSIONNEL, LB_DOMAINE_PROFESSIONNEL, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES ('DM006', 'Fiches fonctions', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_professionnel(CD_DOMAINE_PROFESSIONNEL, LB_DOMAINE_PROFESSIONNEL, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES ('DM007', 'Référentiel management / encadrement', 0, 'ADMIN', now(), 'ADMIN', now());


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
