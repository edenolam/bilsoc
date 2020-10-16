-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 22 Novembre 2017 à 15:15
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
-- Structure de la table `inaptitude`
--

CREATE TABLE IF NOT EXISTS `ref_inaptitude_boeth` (
  `id_inaptitude_boeth` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `cd_inaptitude_boeth` varchar(10) DEFAULT NULL,
  `lb_inaptitude_boeth` varchar(255) NOT NULL,
  `bl_valide` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `cd_utilcrea` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `cd_utilmodi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_inaptitude_boeth`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Inaptitude prononcée (B5-1, B5-2)' AUTO_INCREMENT=4 ;

--
-- Contenu de la table `inaptitude`
--

INSERT INTO `ref_inaptitude_boeth` (`cd_inaptitude_boeth`, `lb_inaptitude_boeth`, `bl_valide`, `created_at`, `cd_utilcrea`, `updated_at`, `cd_utilmodi`) VALUES
('TEMP', 'Inaptitude temporaire', 0, now(), 'ADMIN', now(), 'ADMIN'),
('DSF', 'Inaptitude définitive à ses fonctions', 0, now(), 'ADMIN', now(), 'ADMIN'),
('DTF', 'Inaptitude définitive à toutes fonctions', 0, now(), 'ADMIN', now(), 'ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
