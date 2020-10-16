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
-- Structure de la table `ref_nature_lesion`
--

CREATE TABLE IF NOT EXISTS `ref_nature_lesion` (
  `ID_NATURE_LESION` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `CD_NATURE_LESION` varchar(10) DEFAULT NULL,
  `LB_NATURE_LESION` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `CD_UTILCREA` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_NATURE_LESION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Nature des lésions' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ref_nature_lesion`
--

INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL001', 'Atteinte ostéo-articulaire et/ou musculaire (entorse, douleur d''effort, etc.)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL002', 'Contusion, hématome', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL003', 'Plaie', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL004', 'Fracture', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL005', 'Présence de corps étrangers', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL006', 'Intoxication par ingestion, par inhalation, par voie cutanée', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL007', 'Piqûre', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL008', 'Lésions internes', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL009', 'Brûlure physique, chimique', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL010', 'Atteintes sensorielles', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL011', 'Commotion, perte de connaissance', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL012', 'Lésions de nature multiple', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL013', 'Morsure', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL014', 'Réaction allergique ou inflammatoire cutanée ou muqueuse', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL015', 'Lésions nerveuses', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL016', 'Electrisation, électrocution', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL017', 'Gelure', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL018', 'Lésions potentiellement infectieuses dues aux produits biologiques', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL019', 'Amputation', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL020', 'Asphyxie', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_nature_lesion(CD_NATURE_LESION, LB_NATURE_LESION, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('NL021', 'Autre', 0, now(), 'ADMIN', now(), 'ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
