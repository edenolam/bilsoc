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
-- Structure de la table `ref_famille_metier`
--

CREATE TABLE IF NOT EXISTS `ref_famille_metier` (
  `ID_FAMILLE_METIER` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `ID_DOMAINE_PROFESSIONNEL` int(11) unsigned NULL,
  `CD_FAMILLE_METIER` varchar(10) DEFAULT NULL,
  `LB_FAMILLE_METIER` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `CD_UTILCREA` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`ID_FAMILLE_METIER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Famille de métiers' AUTO_INCREMENT=8 ;

--
-- Contenu de la table `ref_famille_metier`
--

INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (1,'FM001', 'Direction générale', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (1,'FM002', 'Affaires générales', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (1,'FM003', 'Affaires juridiques', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (1,'FM004', 'Finances', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (1,'FM005', 'Ressources humaines', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (1,'FM006', 'Systèmes d''information et TIC', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (1,'FM007', 'Communication', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (2,'FM008', 'Développement territorial', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (2,'FM009', 'Environnement', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (2,'FM010', 'Urbanisme et aménagement', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (2,'FM011', 'Transports et déplacements', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (2,'FM012', 'Formation professionnelle', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (2,'FM013', 'Habitat et logement', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM014', 'Entretien et services généraux', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM015', 'Atelier et véhicules', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM016', 'Imprimerie', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM017', 'Infrastructures', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM018', 'Espaces verts et paysage', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM019', 'Patrimoine bâti', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM020', 'Propreté et déchets', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (3,'FM021', 'Eau et assainissement', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM022', 'Social', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM023', 'Education et animation', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM024', 'Restauration collective', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM025', 'Santé', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM026', 'Laboratoires', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM027', 'Population et funéraire', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM028', 'Services culturels', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM029', 'Arts et techniques du spectacle', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM030', 'Bibliothèques et centres documentaires', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM031', 'Enseignements artistiques', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM032', 'Etablissements et services patrimoniaux', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (4,'FM033', 'Sports', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (5,'FM034', 'Prévention et sécurité', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (5,'FM035', 'Incendie et secours', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (7,'FM036', 'Management supérieur', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (7,'FM037', 'Management intermédiaire', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_famille_metier(ID_DOMAINE_PROFESSIONNEL, CD_FAMILLE_METIER, LB_FAMILLE_METIER, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES (7,'FM038', 'Management de proximité', 0, 'ADMIN', now(), 'ADMIN', now());


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
