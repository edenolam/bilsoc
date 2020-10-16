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
-- Structure de la table `ref_type_activite`
--

CREATE TABLE IF NOT EXISTS `ref_type_activite` (
  `ID_TYPE_ACTIVITE` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `CD_TYPE_ACTIVITE` varchar(10) DEFAULT NULL,
  `LB_TYPE_ACTIVITE` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `CD_UTILCREA` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_TYPE_ACTIVITE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Types d''activités' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ref_type_activite`
--

INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA001', 'Entretien, nettoyage et rangement (des locaux notamment)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA002', 'Services aux personnes - Travail social (enfants, personnes âgées, accompagnement social, etc.)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA003', 'Travail administratif et services généraux', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA004', 'Intervention, secours, lutte contre l''incendie', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA005', 'Espaces verts', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA006', 'Collecte des ordures ménagères(collecte et traitement des déchets)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA007', 'Préparation, fermeture, rangement de chantiers (nettoiement voirie)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA008', 'Voirie - Chantiers (maintenance de la voirie)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA009', 'Réparation et fabrication (ateliers et opérations de maintenance des bâtiments, véhicules, etc.)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA010', 'Restauration', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA011', '(préparation et service)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA012', 'Entretien physique et sportif (activités sportives et de loisirs)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA013', 'Coordination, contrôle, surveillance, accueil (police, gardiennage, maintien de l''ordre)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA014', 'Maintenance eau et assainissement', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA015', 'Magasinage et stockage', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA016', 'Affaires culturelles(manifestations, fêtes, cérémonies et spectacles)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA017', 'Funéraires', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_type_activite(CD_TYPE_ACTIVITE, LB_TYPE_ACTIVITE, BL_VALIDE, created_at, CD_UTILCREA, updated_at, CD_UTILMODI) VALUES ('TA018', 'Autres activités', 0, now(), 'ADMIN', now(), 'ADMIN');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
