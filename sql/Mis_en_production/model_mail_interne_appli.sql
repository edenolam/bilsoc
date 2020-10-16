-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 11 déc. 2017 à 08:44
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

--
-- Déchargement des données de la table `model_mail_interne_appli`
--

INSERT INTO `model_mail_interne_appli` (`id`, `codeApp`, `objet`, `body`) VALUES
(1, 'TRANSBLC', 'Transmission d\'un bilan social.', '<p>La collectivit&eacute; __NAME__ a&nbsp;transmit sont bilan social.</p>'),
(2, 'NEWREPONSE', 'Réponse de votre centre de gestion', '<p>__QUESTION__</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>__REPONSE__&nbsp;</p>'),
(3, 'NEWQUESTIONCOLLECTIVITE', 'Nouvelle question d\'une collectivité', '<p>La collectivité __NAME__ vous a posé une question veuillez répondre a cette question dans votre espace historique des questions</p>'),
(4, 'NEWQUESTIONCDG', 'Nouvelle question de la part d\'un centre de gestion', '__QUESTION__'),
(5, 'VALIDEBLC', 'Validation du bilan social', '<p>Votre bilan social a &eacute;t&eacute; valid&eacute;.</p>'),
(6, 'REFUSBLC', 'Refus de votre bilan social', '<p>Votre bilan social a &eacute;t&eacute; refus&eacute;.</p>');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
