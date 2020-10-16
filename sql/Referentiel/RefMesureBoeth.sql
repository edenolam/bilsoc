-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 22 Novembre 2017 à 15:16
-- Version du serveur: 5.5.24
-- Version de PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `handitorial_recette`
--

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

CREATE TABLE IF NOT EXISTS `ref_mesure_boeth` (
  `id_mesure_boeth` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `cd_mesure_boeth` varchar(10) DEFAULT NULL,
  `lb_mesure_boeth` varchar(255) NOT NULL,
  `bl_valide` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `cd_utilcrea` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `cd_utilmodi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mesure_boeth`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Mesures prises suite à une inaptitude prononcée' AUTO_INCREMENT=6 ;

--
-- Contenu de la table `mesure`
--

INSERT INTO `ref_mesure_boeth` (`cd_mesure_boeth`, `lb_mesure_boeth`, `bl_valide`, `created_at`, `cd_utilcrea`, `updated_at`, `cd_utilmodi`) VALUES
('REC', 'Reclassement', 0, now(), 'ADMIN', now(), 'ADMIN'),
('INV', 'Retraite pour invalidité', 0, now(), 'ADMIN', now(), 'ADMIN'),
('LICIP', 'Licenciement pour inaptitude physique', 0, now(), 'ADMIN', now(), 'ADMIN'),
('PAS', 'Pas de mesure encore associée ou dossier en cours d''étude', 0, now(), 'ADMIN', now(), 'ADMIN'),
('AMP', 'Aménagement de poste ou des conditions de travail', 0, now(), 'admin', now(), 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
