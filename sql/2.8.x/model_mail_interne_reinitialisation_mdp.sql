-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 13 juil. 2018 à 08:00
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bs`
--

--
-- Déchargement des données de la table `model_mail_interne_appli`
--

INSERT INTO `model_mail_interne_appli` (`id`, `codeApp`, `objet`, `body`) VALUES
(11, 'REINIT_MDP', 'Réinitialisation du mot de passe', '<p>Veuillez cliquer&nbsp;sur le lien suivant pour reinitialiser votre mot de passe :&nbsp;</p>\r\n\r\n<p>__URLREINIT__</p>');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
