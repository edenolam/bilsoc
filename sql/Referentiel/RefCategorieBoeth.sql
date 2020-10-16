-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 22 Novembre 2017 à 15:14
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
-- Structure de la table `boeth`
--

CREATE TABLE IF NOT EXISTS `ref_categorie_boeth` (
  `id_categorie_boeth` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `cd_categorie_boeth` varchar(10) DEFAULT NULL,
  `lb_categorie_boeth` varchar(255) NOT NULL,
  `bl_valide` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `cd_utilcrea` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `cd_utilmodi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie_boeth`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Liste BOETH (FIPHFP)' AUTO_INCREMENT=13 ;

--
-- Contenu de la table `boeth`
--

INSERT INTO `ref_categorie_boeth` (`cd_categorie_boeth`, `lb_categorie_boeth`, `bl_valide`, `created_at`, `cd_utilcrea`, `updated_at`, `cd_utilmodi`) VALUES
('TEMP', 'Agent bénéficiant d''une allocation temporaire d''invalidité ou d''une ATIACL', 0, now(), 'ADMIN', now(), 'ADMIN'),
('RECL', 'Agent reclassé', 0, now(), 'ADMIN', now(), 'ADMIN'),
('ORPH', 'Orphelin de guerre de - de 21 ans et mères veuves', 0, now(), 'ADMIN', now(), 'ADMIN'),
('POMP', 'Sapeur-pompier volontaire titulaire d''une allocation/rente', 0, now(), 'ADMIN', now(), 'ADMIN'),
('RENT', 'Titulaire "rente" d''accidents du travail ou maladies professionnelles si incapacité permanente supérieure à 10%', 0, now(), 'ADMIN', now(), 'ADMIN'),
('INVA', 'Titulaire de la carte d''invalidité', 0, '2013-01-04 11:48:53', 'ADMIN', '2013-01-04 11:48:53', 'ADMIN'),
('AAH', 'Titulaire de l''allocation adulte handicapé (AAH)', 0, now(), 'ADMIN', now(), 'ADMIN'),
('RESE', 'Titulaire d''un emploi réservé', 0, now(), 'ADMIN', now(), 'ADMIN'),
('PENS', 'Titulaire d''une pension d''invalidité si l''invalidité réduit d''au moins 2/3 de gain ou de travail', 0, now(), 'ADMIN', now(), 'ADMIN'),
('MILI', 'Titulaire d''une pension militaire d''invalidité', 0, now(), 'ADMIN', now(), 'ADMIN'),
('TRAV', 'Travailleur reconnu handicapé par la commission des droits et de l''autonomie des personnes handicapées (CDAPH, ex Cotorep)', 0, now(), 'ADMIN', now(), 'ADMIN'),
('VEUV', 'Veuves de guerre', 0, now(), 'ADMIN', now(), 'ADMIN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
