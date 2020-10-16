-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 26 fév. 2018 à 07:25
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bilan_social`
--

-- --------------------------------------------------------

--
-- Structure de la table `model_mail_interne_appli`
--

DROP TABLE IF EXISTS `model_mail_interne_appli`;
CREATE TABLE IF NOT EXISTS `model_mail_interne_appli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codeApp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `objet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3BF267E1B0B80D08` (`codeApp`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `model_mail_interne_appli`
--

INSERT INTO `model_mail_interne_appli` (`id`, `codeApp`, `objet`, `body`) VALUES
(8, 'VALIDEMODIF', 'Validation des modifications de compte', '<p>Bonjour,</p>\r\n\r\n<p>Le cdg&nbsp; __NAMECDG__ (__NAME__)&nbsp; a valid&eacute; votre demande de modification de compte.</p>\r\n\r\n<p>Cordialement,</p>\r\n\r\n<p>L&#39;&eacute;quipe Bilan Social</p>'),
(9, 'REFUSMODIF', 'Refus des modifications de compte', '<p>Bonjour,</p>\r\n\r\n<p>Le cdg&nbsp; __NAMECDG__ (__NAME__)&nbsp; a refus&eacute; votre demande de modification de compte.</p>\r\n\r\n<p>Cordialement,</p>\r\n\r\n<p>L&#39;&eacute;quipe Bilan Social</p>');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
