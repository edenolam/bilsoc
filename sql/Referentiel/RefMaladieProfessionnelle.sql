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
-- Structure de la table `ref_maladie_professionnelle`
--

CREATE TABLE IF NOT EXISTS `ref_maladie_professionnelle` (
  `ID_MALADIE_PROFESSIONNELLE` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `CD_MALADIE_PROFESSIONNELLE` varchar(10) DEFAULT NULL,
  `LB_MALADIE_PROFESSIONNELLE` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `CD_UTILCREA` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_MALADIE_PROFESSIONNELLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Maladies professionnelles' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ref_maladie_professionnelle`
--

INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP1', 'Affections dues au plomb et à ses composés', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP30', 'Affections professionnelles consécutives à l''inhalation de poussières d''amiante', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP30bis', 'Cancer broncho-pulmonaire provoqué par l''inhalation de poussières d''amiante', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP40', 'Maladies dues aux bacilles tuberculeux et à certaines mycobactéries atypiques', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP42', 'Atteinte auditive provoquée par les bruits lésionnels', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP57A', 'Epaule', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP57B', 'Coude', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP57C', 'Poignet - Main et doigt', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP57DE', 'Affections périarticulaires provoquées par certains gestes et postures de travail (genou, cheville, pied)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP66', 'Rhinite et asthmes professionnels', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP69', 'Affections provoquées par les vibrations et les chocs transmis par certaines machines outils, outils et objets', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP97', 'Affections chroniques du rachis lombaire provoquées par des vibrations de basses et moyennes fréquences transmises au corps entier', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MP98', 'Affections chroniques du rachis lombaire provoquées par la manutention manuelle de charges lourdes', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_maladie_professionnelle(CD_MALADIE_PROFESSIONNELLE, LB_MALADIE_PROFESSIONNELLE, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('MPAutres', 'Maladies professionnelles liées aux risques psychosociaux (stress, dépression, "burnout"…)', 0, now(), 'ADMIN', now(), 'ADMIN');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
