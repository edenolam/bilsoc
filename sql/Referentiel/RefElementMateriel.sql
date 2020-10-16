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
-- Structure de la table `ref_element_materiel`
--

CREATE TABLE IF NOT EXISTS `ref_element_materiel` (
  `ID_ELEMENT_MATERIEL` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `CD_ELEMENT_MATERIEL` varchar(10) DEFAULT NULL,
  `LB_ELEMENT_MATERIEL` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `CD_UTILCREA` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_ELEMENT_MATERIEL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Eléments matériels' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ref_element_materiel`
--

INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM001', 'Objets ou personnes en cours de manipulation ou transport manuel', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM002', 'Chutes de plain-pied', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM003', 'Objets, masses, particules en mouvement accidentel', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM004', 'Chutes avec dénivellation', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM005', 'Véhicules et engins', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM006', 'Outils à main', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM007', 'Agression - Violence', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM008', 'Accessoire de levage, amarrage et préhension', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM009', 'Appareils de manutention et engins de levage', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM010', 'Matières explosives, inflammables ou dangereuses', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM011', 'Machines', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM012', 'Electricité', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM013', 'Outils souillés (sang, urine)', 0, now(), 'ADMIN', now(), 'ADMIN');
INSERT INTO ref_element_materiel(CD_ELEMENT_MATERIEL, LB_ELEMENT_MATERIEL, BL_VALIDE, created_at, cd_utilcrea, updated_at, cd_utilmodi) VALUES ('EM014', 'Autres', 0, now(), 'ADMIN', now(), 'ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
