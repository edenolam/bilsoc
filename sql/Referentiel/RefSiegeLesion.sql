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
-- Structure de la table `ref_siege_lesion`
--

CREATE TABLE IF NOT EXISTS `ref_siege_lesion` (
  `ID_SIEGE_LESION` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `CD_SIEGE_LESION` varchar(10) DEFAULT NULL,
  `LB_SIEGE_LESION` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `CD_UTILCREA` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_SIEGE_LESION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Siège des lésions' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ref_siege_lesion`
--

INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL001', 'Main', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL002', 'Colonne vertébrale (cervicale, dorsale, lombaire, sacrum, coccyx)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL003', 'Pied', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL004', 'Membre inférieur (hanche, cuisse, genou, jambe, cheville, cou-de-pied)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL005', 'Tête (yeux exceptés)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL006', 'Membre supérieur (épaule, bras, coude, avant-bras, poignet) compris)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL007', 'Yeux', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL008', 'Tronc (thorax, abdomen, région lombaire, bassin, périnée, organes génitaux)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL009', 'Localisation multiple', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_siege_lesion(CD_SIEGE_LESION, LB_SIEGE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('SL010', 'Autres', 0, now(), 'ADMIN', now(), 'ADMIN');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
