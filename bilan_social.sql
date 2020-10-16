-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Octobre 2017 à 09:39
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bilan_social`
--


--
-- Contenu de la table `campagne`
--

INSERT INTO `campagne` (`LB_CAMP`, `NM_ANNE`, `DT_DEBU`, `DT_CLOT`, `FG_STAT`, `DT_CREA`, `CD_UTILCREA`, `DT_MODI`, `CD_UTILMODI`, `ID_CAMP`) VALUES
('campagne 2018 / 2019', 2017, '2018-01-01 00:00:00', NULL, '1', '2017-09-26 15:25:34', '9', NULL, NULL, 5);

--
-- Contenu de la table `cdg`
--

INSERT INTO `cdg` (`LB_CDG`, `BL_AFFIESPAANAL`, `CD_UTILCREA`, `DT_CREA`, `CD_UTILMODI`, `DT_MODI`, `ID_CDG`) VALUES
('CDG de l\'Ain (01)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 1),
('CDG de l\'Aisne (02)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 2),
('CDG de l\'Allier (03)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 3),
('CDG des Alpes de Hautes Provence (04)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 4),
('CDG des Hautes-Alpes (05)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 5),
('CDG des Alpes Maritimes (06)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 6),
('CDG de l\'Ardèche (07)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 7),
('CDG des Ardennes (08)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 8),
('CDG de l\'Ariège (09)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 9),
('CDG de l\'Aube (10)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 10),
('CDG de l\'Aude (11)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 11),
('CDG de l\'Aveyron (12)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 12),
('CDG des Bouches du Rhône (13)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 13),
('CDG du Calvados (14)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 14),
('CDG du Cantal (15)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 15),
('CDG de Charente (16)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 16),
('CDG de Charente Maritime (17)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 17),
('CDG du Cher (18)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 18),
('CDG de la Correze (19)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 19),
('CDG de la Corse du Sud (2A)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 20),
('CDG de la Corse de la Haute Corse (2B)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 21),
('CDG de la Côte d\'Or (21)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 22),
('CDG des Côtes d\'Armor (22)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 23),
('CDG de la Creuse (23)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 24),
('CDG de la Dordogne (24)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 25),
('CDG du Doubs (25)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 26),
('CDG de la Drôme (26)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 27),
('CDG de l\'Eure (27)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 28),
('CDG d\'Eure-et-Loir (28)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 29),
('CDG du Finistère (29)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 30),
('CDG du Gard (30)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 31),
('CDG de la Haute-Garonne (31)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 32),
('CDG du Gers(32)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 33),
('CDG de la Gironde (33)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 34),
('CDG de l\'Hérault (34)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 35),
('CDG d\'Ille-et-vilaine (35)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 36),
('CDG de l\'Indre (36)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 37),
('CDG d\'Indre et Loire (37)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 38),
('CDG de l\'Isère (38)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 39),
('CDG du Jura (39)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 40),
('CDG des Landes (40)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 41),
('CDG de Loir-et-Cher (41)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 42),
('CDG de la Loire (42)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 43),
('CDG de la Haute-Loire (43)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 44),
('CDG de la Loire-Atlantique (44)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 45),
('CDG du Loiret(45)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 46),
('CDG du Lot (46)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 47),
('CDG du Lot-et-Garonne (47)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 48),
('CDG de la Lozère (48)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 49),
('CDG du Maine-et-Loire (49)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 50),
('CDG de la Manche (50)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 51),
('CDG de la Marne (51)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 52),
('CDG de la Haute-Marne (52)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 53),
('CDG de la Mayenne (53)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 54),
('CDG de la Meurthe-et-Moselle (54)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 55),
('CDG de la Meuse (55)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 56),
('CDG du Morbihan (56)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 57),
('CDG de la Moselle (57)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 58),
('CDG de la Nièvre (58)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 59),
('CDG du Nord (59)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 60),
('CDG de l\'Oise (60)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 61),
('CDG de l\'Orne (61)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 62),
('CDG du Pas-de-Calais (62)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 63),
('CDG du Puy-de-Dome (63)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 64),
('CDG des Pyrénées-Atlantiques (64)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 65),
('CDG des Hautes Pyrénées (65)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 66),
('CDG des Pyrénées-Orientales (66)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 67),
('CDG du Bas-Rhin (67)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 68),
('CDG du Haut-Rhin (68)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 69),
('CDG du Rhône (69)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 70),
('CDG de la Haute-Saône (70)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 71),
('CDG de la Saône-et-Loire (71)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 72),
('CDG de la Sarthe (72)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 73),
('CDG de la Savoie (73)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 74),
('CDG de la Haute-Savoie (74)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 75),
('CDG de la Seine-Maritime (76)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 76),
('CDG de la Seine-et-Marne (77)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 77),
('CDG des Deux-Sèvres (79)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 78),
('CDG de la Somme (80)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 79),
('CDG du Tarn (81)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 80),
('CDG du Tarn-et-Garonne (82)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 81),
('CDG du Var (83)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 82),
('CDG du Vaucluse (84)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 83),
('CDG de la Vendée (85)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 84),
('CDG de la Vienne (86)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 85),
('CDG de la Haute-Vienne (87)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 86),
('CDG des Vosges(88)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 87),
('CDG de l\'Yonne (89)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 88),
('CDG du Territoire de Belfort (90)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 89),
('CIG de la Grande Couronne (78-91-95)', NULL, 'ADMIN', '2017-09-01 13:39:48', 'ciggc', '2017-10-25 15:25:46', 90),
('CIG de la Petite Couronne (92-93-94)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 91),
('CDG de Guadeloupe (971)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 92),
('CDG de la Martinique (972)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 93),
('CDG de la Guyane (973)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 94),
('CDG de la Réunion (974)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 95),
('CDG de Mayotte (976)', NULL, 'ADMIN', '2017-09-01 13:39:48', NULL, NULL, 96);

--
-- Contenu de la table `cdg_departement`
--

INSERT INTO `cdg_departement` (`DATE_DEBUT`, `DATE_FIN`, `FG_TYPE`, `ID_CDG_DEPARTEMENT`, `ID_CDG`, `ID_DEPA`) VALUES
('1970-01-01', '2099-12-31', '', 1, 90, 78),
('1970-01-01', '2099-12-31', '1', 2, 90, 78);

--
-- Contenu de la table `collectivite`
--

INSERT INTO `collectivite` (`ID_CATE`, `LB_COLL`, `LB_ADRE`, `CD_POST`, `LB_VILL`, `CD_INSE`, `NM_SIRE`, `LB_TELE`, `LB_MAIL`, `NM_POPU_INSE`, `LB_CONT_COLL`, `BL_TRAN_BS`, `BL_SURCLAS_DEMO`, `NM_SURCLAS_DEMO`, `NM_STRAT_COLL`, `BL_CDG_COLL`, `LB_CONT_CDG`, `BL_AFFI_COLL`, `BL_CT_CDG`, `BL_COLL_DGCL`, `LB_ZONE_EMPL_COLL`, `NM_LOGE_OPHLM_ODHLM`, `BL_ACTI`, `BL_DISS`, `DT_DISS`, `BL_FUSI`, `BL_FIRSCONN`, `DT_FUSI`, `BL_ABSO`, `DT_ABSO`, `CD_UTILCREA`, `DT_CREA`, `CD_UTILMODI`, `DT_MODI`, `ID_COLL`, `ID_TYPE_COLL`, `ID_CDG_DEPARTEMENT`, `ID_DEPA`, `DT_POPU_INSE`, `BL_CHSCT`, `NM_SIRE_RATA`, `change_request`, `cdg_is_authorized_by_collectivity`, `CM_INFO_COMP`, `CM_MOTI`) VALUES
(4, 'Mairie d\'ABLIS', '8 Rue de la Mairie', '78660', 'ABLIS', NULL, '21780003600014', '0153698745', 'dupont_a@mail.com', NULL, 'Mme Dupont - Responsable formation', NULL, 1, 45, NULL, NULL, NULL, 1, 0, NULL, NULL, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:21:13', '21780003600014', '2017-10-18 09:05:18', 1, 1, 2, 78, NULL, 1, NULL, 1, 1, NULL, NULL),
(NULL, 'Mairie de VERSAILLES', '4 avenue de Paris', '78011', 'VERSAILLES Cedex', NULL, '21780646200016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:21:13', NULL, NULL, 2, 1, 2, 78, NULL, NULL, NULL, 0, 0, NULL, NULL),
(NULL, 'Centre Interdépartemental de Gestion de la Grande Couronne d\'Ile-de-France', '15 rue Boileau', '78008', 'VERSAILLES Cedex', '0147852369', '28780054400010', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:21:13', 'ciggc', '2017-10-16 13:53:33', 3, 18, 2, 78, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, 'Communauté d\'Agglomération Rochefort Océan', '3 Avenue Maurice Chupin', '17300', 'ROCHEFORT', NULL, '20004176200010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:21:13', NULL, NULL, 4, 10, 17, 17, NULL, NULL, '', NULL, NULL, NULL, NULL),
(NULL, 'MAIRIE DE CONCARNEAU', 'NULL', '29182', 'CONCARNEAU', NULL, '21290039300019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:21:13', NULL, NULL, 5, 1, 30, 29, NULL, NULL, '', NULL, NULL, NULL, NULL),
(NULL, 'Mairie d\'ABLISgh', '8 Rue de la Mairiegh', '78662', 'ABLISgh', '085520', '21780646200752', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2017-10-17 13:03:25', NULL, NULL, 12, 1, 9, 10, NULL, NULL, NULL, NULL, 0, 'eertezrt', 'Non existant dans la base INSEE'),
(NULL, 'Mairie d\'ABLISgh', '8 Rue de la Mairiegh', '78662', 'ABLISgh', '87452', '21780646200038', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2017-10-18 10:39:42', NULL, NULL, 22, 1, 4, 4, NULL, NULL, NULL, NULL, 0, 'hjggfds', 'Non existant dans la base INSEE'),
(NULL, 'rox oub', 'azerty', '91210', 'DRAVEIL', '784512', '21780646200218', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ciggc', '2017-10-18 11:59:39', NULL, NULL, 23, 1, 90, 5, NULL, NULL, NULL, NULL, 0, 'sqdfgt', 'Non existant dans la base INSEE'),
(NULL, 'sdfgert', 'qertert', '48512', 'rgretert', '485120', '20145369878550', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ciggc', '2017-10-23 07:58:35', NULL, NULL, 24, 1, 90, 11, NULL, NULL, NULL, NULL, 0, 'sxdcfvgh', 'Non existant dans la base INSEE');

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`CD_DEPA`, `LB_DEPA`, `CD_UTILCREA`, `DT_CREA`, `CD_UTILMODI`, `DT_MODI`, `ID_DEPA`) VALUES
('01', 'Ain', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 1),
('02', 'Aisne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 2),
('03', 'Allier', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 3),
('04', 'Alpes-de-Haute-Provence', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 4),
('05', 'Hautes-Alpes', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 5),
('06', 'Alpes-Maritimes', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 6),
('07', 'Ardèche', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 7),
('08', 'Ardennes', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 8),
('09', 'Ariège', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 9),
('10', 'Aube', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 10),
('11', 'Aude', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 11),
('12', 'Aveyron', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 12),
('13', 'Bouches-du-Rhône', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 13),
('14', 'Calvados', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 14),
('15', 'Cantal', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 15),
('16', 'Charente', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 16),
('17', 'Charente-Maritime', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 17),
('18', 'Cher', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 18),
('19', 'Corrèze', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 19),
('2A', 'Corse-du-Sud', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 20),
('2B', 'Haute-Corse', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 21),
('21', 'Côte-d\'Or', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 22),
('22', 'Côtes-d\'Armor', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 23),
('23', 'Creuse', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 24),
('24', 'Dordogne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 25),
('25', 'Doubs', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 26),
('26', 'Drôme', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 27),
('27', 'Eure', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 28),
('28', 'Eure-et-Loir', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 29),
('29', 'Finistère', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 30),
('30', 'Gard', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 31),
('31', 'Haute-Garonne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 32),
('32', 'Gers', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 33),
('33', 'Gironde', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 34),
('34', 'Hérault', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 35),
('35', 'Ille-et-Vilaine', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 36),
('36', 'Indre', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 37),
('37', 'Indre-et-Loire', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 38),
('38', 'Isère', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 39),
('39', 'Jura', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 40),
('40', 'Landes', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 41),
('41', 'Loir-et-Cher', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 42),
('42', 'Loire', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 43),
('43', 'Haute-Loire', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 44),
('44', 'Loire-Atlantique', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 45),
('45', 'Loiret', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 46),
('46', 'Lot', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 47),
('47', 'Lot-et-Garonne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 48),
('48', 'Lozère', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 49),
('49', 'Maine-et-Loire', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 50),
('50', 'Manche', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 51),
('51', 'Marne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 52),
('52', 'Haute-Marne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 53),
('53', 'Mayenne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 54),
('54', 'Meurthe-et-Moselle', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 55),
('55', 'Meuse', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 56),
('56', 'Morbihan', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 57),
('57', 'Moselle', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 58),
('58', 'Nièvre', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 59),
('59', 'Nord', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 60),
('60', 'Oise', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 61),
('61', 'Orne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 62),
('62', 'Pas-de-Calais', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 63),
('63', 'Puy-de-Dôme', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 64),
('64', 'Pyrénées-Atlantiques', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 65),
('65', 'Hautes-Pyrénées', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 66),
('66', 'Pyrénées-Orientales', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 67),
('67', 'Bas-Rhin', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 68),
('68', 'Haut-Rhin', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 69),
('69', 'Rhône', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 70),
('70', 'Haute-Saône', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 71),
('71', 'Saône-et-Loire', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 72),
('72', 'Sarthe', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 73),
('73', 'Savoie', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 74),
('74', 'Haute-Savoie', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 75),
('76', 'Seine-Maritime', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 76),
('77', 'Seine-et-Marne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 77),
('78', 'Yvelines', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 78),
('79', 'Deux-Sèvres', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 79),
('80', 'Somme', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 80),
('81', 'Tarn', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 81),
('82', 'Tarn-et-Garonne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 82),
('83', 'Var', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 83),
('84', 'Vaucluse', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 84),
('85', 'Vendée', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 85),
('86', 'Vienne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 86),
('87', 'Haute-Vienne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 87),
('88', 'Vosges', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 88),
('89', 'Yonne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 89),
('90', 'Territoire de Belfort', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 90),
('91', 'Essonne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 91),
('92', 'Hauts-de-Seine', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 92),
('93', 'Seine-Saint-Denis', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 93),
('94', 'Val-de-Marne', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 94),
('95', 'Val-d\'Oise', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 95),
('971', 'Guadeloupe', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 96),
('972', 'Martinique', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 97),
('973', 'Guyane', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 98),
('974', 'La Réunion', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 99),
('976', 'Mayotte', 'ADMIN', '2017-09-01 13:49:51', NULL, NULL, 100);

--
-- Contenu de la table `enquete`
--

INSERT INTO `enquete` (`ID_CAMP`, `LB_ENQU`, `CM_DESC`, `NM_ANNE`, `FG_STAT`, `DT_DEBU`, `DT_CLOT`, `BL_RELA`, `DT_RELA`, `BL_BL_CDG_COLL`, `DT_CREA`, `CD_UTILCREA`, `DT_MODI`, `CD_UTILMODI`, `BL_ID_TYPE_COLL`, `BL_ID_DEPA`, `BL_LB_COLL`, `BL_CD_POST`, `BL_LB_VILL`, `BL_CD_INSE`, `BL_NM_SIRE`, `BL_NM_POPU_INSE`, `BL_BL_SURCLAS_DEMO`, `BL_NM_STRAT_COLL`, `BL_BL_AFFI_COLL`, `BL_BL_CT_CDG`, `BL_CHSCT`, `BL_BL_COLL_DGCL`, `ID_ENQU`) VALUES
(5, 'Enquête 2018', 'Enquête pour les années 2018 / 2019', 2017, '3', '2018-01-01 00:00:00', '2017-10-11 12:59:43', NULL, NULL, 0, '2017-09-27 15:13:03', 'ciggc', NULL, NULL, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1),
(5, 'Enquête 2018', 'Enquête pour les années 2018 / 2019', 2017, '3', '2018-01-01 00:00:00', '2017-10-11 13:05:52', NULL, NULL, 0, '2017-10-11 13:03:09', 'ciggc', '2017-10-11 13:05:33', 'ciggc', 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 2),
(5, 'Enquête 2018', 'Enquête pour les années 2018 / 2019', 2017, '3', '2018-01-01 00:00:00', '2017-10-11 13:09:27', NULL, NULL, 0, '2017-10-11 13:08:23', 'ciggc', NULL, NULL, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 3),
(5, 'Enquête 2018', 'Enquête pour les années 2018 / 2019', 2017, '1', '2018-01-01 00:00:00', NULL, NULL, NULL, 0, '2017-10-11 13:10:41', 'ciggc', NULL, NULL, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 4);

--
-- Contenu de la table `ref_acte_violence_physique`
--

INSERT INTO `ref_acte_violence_physique` (`CD_ACTVIOLPHYS`, `LB_ACTVIOLPHYS`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_ACTEVIOLPHYS`) VALUES
('AVP001', 'Emanant du personnel avec arrêt de travail', 1, '2017-09-01 12:46:38', 'ADMIN', NULL, NULL, 1),
('AVP002', 'Emanant du personnel sans arrêt de travail', 1, '2017-09-01 12:46:38', 'ADMIN', NULL, NULL, 2),
('AVP003', 'Emanant des usagers avec arrêt de travail', 1, '2017-09-01 12:46:38', 'ADMIN', NULL, NULL, 3),
('AVP004', 'Emanant des usagers sans arrêt de travail', 1, '2017-09-01 12:46:38', 'ADMIN', NULL, NULL, 4);

--
-- Contenu de la table `ref_avancement_promotion_concours`
--

INSERT INTO `ref_avancement_promotion_concours` (`CD_AVANPROMCONC`, `LB_AVANPROMCONC`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_AVANPROMCONC`) VALUES
('APC001', 'Avancement d\'échelon', 1, '2017-09-01 12:43:41', 'ADMIN', NULL, NULL, 1),
('APC002', 'Avancement de grade', 1, '2017-09-01 12:43:41', 'ADMIN', NULL, NULL, 2),
('APC003', 'Promotion interne au sein de la collectivité', 1, '2017-09-01 12:43:41', 'ADMIN', NULL, NULL, 3),
('APC004', 'Réussite au concours dans un autre cadre d\'emplois ayant entrainé "une stagiairisation"', 1, '2017-09-01 12:43:41', 'ADMIN', NULL, NULL, 4);

--
-- Contenu de la table `ref_cadre_emploi`
--

INSERT INTO `ref_cadre_emploi` (`CD_CADREMPL`, `LB_CADREMPL`, `BL_VALI`, `CD_UTILCREA`, `CD_UTILMODI`, `ID_CADREMPL`, `ID_FILI`, `ID_CATE`, `BL_CONS`) VALUES
('CE001', 'Administrateur', 1, 'ADMIN', NULL, 1, 1, 1, 1),
('CE002', 'Attaché territorial', 1, 'ADMIN', NULL, 2, 1, 1, 1),
('CE003', 'Secrétaire de mairie', 1, 'ADMIN', NULL, 3, 1, 1, 1),
('CE004', 'Autres emplois administratifs', 1, 'ADMIN', NULL, 4, 1, 1, 0),
('CE005', 'Ingénieur territorial', 1, 'ADMIN', NULL, 5, 2, 1, 1),
('CE006', 'Autres emplois techniques', 1, 'ADMIN', NULL, 6, 2, 1, 0),
('CE007', 'Conservateur patrimoine', 1, 'ADMIN', NULL, 7, 3, 1, 1),
('CE008', 'Conservateur bibliothèques', 1, 'ADMIN', NULL, 8, 3, 1, 1),
('CE009', 'Attache de conservation du patrimoine', 1, 'ADMIN', NULL, 9, 3, 1, 1),
('CE010', 'Bibliothècaire', 1, 'ADMIN', NULL, 10, 3, 1, 1),
('CE011', 'Directeur etablissement enseignement artistique', 1, 'ADMIN', NULL, 11, 3, 1, 1),
('CE012', 'Professeur enseignement artistique', 1, 'ADMIN', NULL, 12, 3, 1, 1),
('CE013', 'Autres emplois culturels', 1, 'ADMIN', NULL, 13, 3, 1, 0),
('CE014', 'Conseiller activités physiques et sportives', 1, 'ADMIN', NULL, 14, 4, 1, 1),
('CE015', 'Autres emplois sportifs', 1, 'ADMIN', NULL, 15, 4, 1, 0),
('CE016', 'Conseiller socio educatif', 1, 'ADMIN', NULL, 16, 5, 1, 1),
('CE017', 'Autres emplois sociaux', 1, 'ADMIN', NULL, 17, 5, 1, 0),
('CE018', 'Médecin', 1, 'ADMIN', NULL, 18, 6, 1, 1),
('CE019', 'Psychologue', 1, 'ADMIN', NULL, 19, 6, 1, 1),
('CE020', 'Sage-femme', 1, 'ADMIN', NULL, 20, 6, 1, 1),
('CE021', 'Puéricultrice cadre de santé', 1, 'ADMIN', NULL, 21, 6, 1, 1),
('CE022', 'Puéricultrice ancien cadre d\'emploi', 1, 'ADMIN', NULL, 22, 6, 1, 1),
('CE023', 'Puéricultrice nouveau cadre d\'emploi', 1, 'ADMIN', NULL, 23, 6, 1, 1),
('CE024', 'Cadre de santé infirmier rééducateur et assistant médico technique', 1, 'ADMIN', NULL, 24, 6, 1, 1),
('CE025', 'infirmier en soins généraux', 1, 'ADMIN', NULL, 25, 6, 1, 1),
('CE026', 'Autres emplois médico sociaux', 1, 'ADMIN', NULL, 26, 6, 1, 0),
('CE027', 'Biologiste vétérinaire pharmacien', 1, 'ADMIN', NULL, 27, 7, 1, 1),
('CE028', 'Autres emplois médico techniques', 1, 'ADMIN', NULL, 28, 7, 1, 0),
('CE029', 'Directeur de police municipale', 1, 'ADMIN', NULL, 29, 8, 1, 1),
('CE030', 'Autres emplois police municipale', 1, 'ADMIN', NULL, 30, 8, 1, 0),
('CE031', 'Autres emplois animation', 1, 'ADMIN', NULL, 31, 9, 1, 0),
('CE032', 'Capitaines, commandants, Lieutenants-colonels, colonels sapeurs pompiers professionnels', 1, 'ADMIN', NULL, 32, 10, 1, 1),
('CE033', 'Médecins et pharmaciens sapeurs pompiers professionnels', 1, 'ADMIN', NULL, 33, 10, 1, 1),
('CE034', 'Infirmiers encadrement sapeurs pompiers professionnels', 1, 'ADMIN', NULL, 34, 10, 1, 1),
('CE035', 'Autres emplois incendie et secours', 1, 'ADMIN', NULL, 35, 10, 1, 0),
('CE036', 'Rédacteur', 1, 'ADMIN', NULL, 36, 1, 2, 1),
('CE037', 'Technicien territorial', 1, 'ADMIN', NULL, 37, 2, 2, 1),
('CE038', 'Assistant conservation patrimoine et bibliothèques', 1, 'ADMIN', NULL, 38, 3, 2, 1),
('CE039', 'Assistant enseignement artistique', 1, 'ADMIN', NULL, 39, 3, 2, 1),
('CE040', 'Edicateur activités physiques et sportives', 1, 'ADMIN', NULL, 40, 4, 2, 1),
('CE041', 'Assistant socio éducatif', 1, 'ADMIN', NULL, 41, 5, 2, 1),
('CE042', 'Educateur de jeunes enfants', 1, 'ADMIN', NULL, 42, 5, 2, 1),
('CE043', 'Moniteur éducateur et intervenant familial', 1, 'ADMIN', NULL, 43, 5, 2, 1),
('CE044', 'Infirmier', 1, 'ADMIN', NULL, 44, 6, 2, 1),
('CE045', 'Technicien paramédical', 1, 'ADMIN', NULL, 45, 7, 2, 1),
('CE046', 'Chef de service de police municipale', 1, 'ADMIN', NULL, 46, 8, 2, 1),
('CE047', 'Animateur', 1, 'ADMIN', NULL, 47, 9, 2, 1),
('CE048', 'Lieutenants sapeurs pompiers professionnels', 1, 'ADMIN', NULL, 48, 10, 2, 1),
('CE049', 'Infirmiers sapeurs pompiers professionnels', 1, 'ADMIN', NULL, 49, 10, 2, 1),
('CE050', 'Adjoint administratif', 1, 'ADMIN', NULL, 50, 1, 3, 1),
('CE051', 'Agent de maitrise', 1, 'ADMIN', NULL, 51, 2, 3, 1),
('CE052', 'Adjoint technique', 1, 'ADMIN', NULL, 52, 2, 3, 1),
('CE053', 'Adjoint technique des établissements d\'enseignement', 1, 'ADMIN', NULL, 53, 2, 3, 1),
('CE054', 'Adjoint du patrimoine', 1, 'ADMIN', NULL, 54, 3, 3, 1),
('CE055', 'Opérateur activités physiques et sportives', 1, 'ADMIN', NULL, 55, 4, 3, 1),
('CE056', 'Agent spécialisé des écoles maternelles', 1, 'ADMIN', NULL, 56, 5, 3, 1),
('CE057', 'Agent social', 1, 'ADMIN', NULL, 57, 5, 3, 1),
('CE058', 'Auxiliaire puériculture', 1, 'ADMIN', NULL, 58, 6, 3, 1),
('CE059', 'Auxiliaire soins', 1, 'ADMIN', NULL, 59, 6, 3, 1),
('CE060', 'Agent de police municipale', 1, 'ADMIN', NULL, 60, 8, 3, 1),
('CE061', 'Garde champêtre', 1, 'ADMIN', NULL, 61, 8, 3, 1),
('CE062', 'Adjoint animation', 1, 'ADMIN', NULL, 62, 9, 3, 1),
('CE063', 'Sous-officiers sapeurs pompiers professionnels', 1, 'ADMIN', NULL, 63, 10, 3, 1),
('CE064', 'Sapeurs et caporaux sapeurs pompiers professionnels', 1, 'ADMIN', NULL, 64, 10, 3, 1),
('CE065', 'Autres emplois hors filières', 1, 'ADMIN', NULL, 65, 11, 4, 0),
('CE066', 'Autres', 1, 'ADMIN', NULL, 66, 12, 4, 0);

--
-- Contenu de la table `ref_categorie`
--

INSERT INTO `ref_categorie` (`CD_CATE`, `LB_CATE`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_CATE`, `BL_CONS`) VALUES
('A', 'A', 1, '2017-09-01 12:37:51', 'ADMIN', NULL, NULL, 1, 1),
('B', 'B', 1, '2017-09-01 12:37:51', 'ADMIN', NULL, NULL, 2, 1),
('C', 'C', 1, '2017-09-01 12:37:51', 'ADMIN', NULL, NULL, 3, 1),
('INCONNUE', 'Inconnue', 1, '2017-09-01 12:37:51', 'ADMIN', NULL, NULL, 4, 0);

--
-- Contenu de la table `ref_contrainte_travail`
--

INSERT INTO `ref_contrainte_travail` (`CD_CONTTRAV`, `LB_CONTTRAV`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_CONTTRAV`) VALUES
('CPTT001', 'Horaires décalés', 1, '2017-09-01 12:44:22', 'ADMIN', NULL, NULL, 1),
('CPTT002', 'Travail de nuit', 1, '2017-09-01 12:44:22', 'ADMIN', NULL, NULL, 2),
('CPTT003', 'Travail le week-end', 1, '2017-09-01 12:44:22', 'ADMIN', NULL, NULL, 3),
('CTT001', 'Cycle hebdomadaire', 1, '2017-09-01 12:44:28', 'ADMIN', NULL, NULL, 4),
('CTT002', 'Cycle mensuel', 1, '2017-09-01 12:44:28', 'ADMIN', NULL, NULL, 5),
('CTT003', 'Cycle saisonnier', 1, '2017-09-01 12:44:28', 'ADMIN', NULL, NULL, 6),
('CTT004', 'Cycle annuel', 1, '2017-09-01 12:44:28', 'ADMIN', NULL, NULL, 7),
('CTT005', 'Autre cycle', 1, '2017-09-01 12:44:28', 'ADMIN', NULL, NULL, 8);

--
-- Contenu de la table `ref_cycle_travail`
--

INSERT INTO `ref_cycle_travail` (`CD_CYCLTRAV`, `LB_CYCLTRAV`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_CYCLTRAV`) VALUES
('CTT001', 'Cycle hebdomadaire', 1, '2017-09-04 12:24:18', 'ADMIN', NULL, NULL, 1),
('CTT002', 'Cycle mensuel', 1, '2017-09-04 12:24:18', 'ADMIN', NULL, NULL, 2),
('CTT003', 'Cycle saisonnier', 1, '2017-09-04 12:24:18', 'ADMIN', NULL, NULL, 3),
('CTT004', 'Cycle annuel', 1, '2017-09-04 12:24:18', 'ADMIN', NULL, NULL, 4),
('CTT005', 'Autre cycle', 1, '2017-09-04 12:24:18', 'ADMIN', NULL, NULL, 5);

--
-- Contenu de la table `ref_emploi_fonctionnel`
--

INSERT INTO `ref_emploi_fonctionnel` (`CD_EMPLFONC`, `LB_EMPLFONC`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_EMPLFONC`, `ID_FILI`) VALUES
('EF001', 'Directeur général des services ou directeur', 1, '2017-09-01 12:42:58', 'ADMIN', NULL, NULL, 1, NULL),
('EF002', 'Directeur général adjoint des services ou directeur adjoint', 1, '2017-09-01 12:42:58', 'ADMIN', NULL, NULL, 2, NULL),
('EF003', 'Directeur général des services techniques', 1, '2017-09-01 12:42:58', 'ADMIN', NULL, NULL, 3, NULL),
('EF004', 'Directeur des services techniques', 1, '2017-09-01 12:42:58', 'ADMIN', NULL, NULL, 4, NULL);

--
-- Contenu de la table `ref_emploi_non_permanent`
--

INSERT INTO `ref_emploi_non_permanent` (`LB_EMPLNONPERM`, `CD_EMPLNONPERM`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_EMPLNONPERM`, `CD_MOTI_N4DS`) VALUES
('Collaborateurs de cabinet (article 110 de la loi du 26 janvier 1984)\r\n', 'EF001', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 1, NULL),
('Assistants maternels', 'EF002', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 2, NULL),
('Assistants familiaux', 'EF003', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 3, NULL),
('Accueillants familiaux (Loi DALO de 2007)', 'EF004', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 4, NULL),
('Agents contractuels recrutés pour faire face à un accroissement temporaire d\'activité ou un accroissement saisonnier d\'activité (article 3 de la loi du 26 janvier 1984)', 'EF005', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 5, NULL),
('Contrat unique d\'insertion (CUI-CAE)', 'EF006', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 6, NULL),
('Emploi d\'avenir', 'EF007', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 7, NULL),
('Autre emploi aidé', 'EF008', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 8, NULL),
('Contractuels employés par les CDG et mis à disposition des collectivités ( A renseigner uniquement par les CDG )', 'EF009', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 9, NULL),
('Apprentis', 'EF010', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 10, NULL),
('Personnes bénéficiant d\'une rémunération accessoire autorisée par la réglementation sur le cumul des emplois', 'EF011', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 11, NULL),
('Autres (agents non classables dans les catégories précédentes)', 'EF012', 1, '2017-09-01 12:45:40', 'ADMIN', NULL, NULL, 12, NULL);

--
-- Contenu de la table `ref_filiere`
--

INSERT INTO `ref_filiere` (`CD_FILI`, `LB_FILI`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_FILI`, `BL_CONS`, `BL_EMPFONC`) VALUES
('AD', 'Administrative', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 1, 1, NULL),
('TE', 'Technique', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 2, 1, NULL),
('CU', 'Culturelle', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 3, 1, NULL),
('SP', 'Sportive', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 4, 1, NULL),
('SO', 'Sociale', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 5, 1, NULL),
('MS', 'Médico-sociale', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 6, 1, NULL),
('MT', 'Médico-technique', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 7, 1, NULL),
('PM', 'Police municipale', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 8, 1, NULL),
('AN', 'Animation', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 9, 1, NULL),
('IS', 'Incendie et secours', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 10, 1, NULL),
('EHF', 'Emplois hors filière', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 11, 0, NULL),
('AUT', 'Autres', 1, '2017-09-01 12:37:59', 'ADMIN', NULL, NULL, 12, 0, NULL);

--
-- Contenu de la table `ref_fonction_publique`
--

INSERT INTO `ref_fonction_publique` (`CD_FONCPUBL`, `LB_FONCPUBL`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_FONCPUBL`) VALUES
('FPE', 'Fonction publique d\'Etat', 1, '2017-09-01 12:42:50', 'ADMIN', NULL, NULL, 1),
('FPT', 'Fonction publique territoriale', 1, '2017-09-01 12:42:50', 'ADMIN', NULL, NULL, 2),
('FPH', 'Fonction publique hospitalière', 1, '2017-09-01 12:42:50', 'ADMIN', NULL, NULL, 3);

--
-- Contenu de la table `ref_formation`
--

INSERT INTO `ref_formation` (`CD_FORM`, `LB_FORM`, `BL_PREV`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_FORM`) VALUES
('F001', 'Préparations aux concours et examens d\'accès à la F.P.T.', NULL, 1, '2017-09-01 12:44:50', 'ADMIN', NULL, NULL, 1),
('F002', 'Formation prévue par les statuts particuliers dont formation d\'intégration', NULL, 1, '2017-09-01 12:44:50', 'ADMIN', NULL, NULL, 2),
('F004', 'Formation prévue par les statuts particuliers dont formation de professionnalisation', NULL, 1, '2017-09-01 12:44:50', 'ADMIN', NULL, NULL, 3),
('F005', 'Formation de perfectionnement', NULL, 1, '2017-09-01 12:44:50', 'ADMIN', NULL, NULL, 4),
('F006', 'Formation personnelle (hors congés formation)', NULL, 1, '2017-09-01 12:44:50', 'ADMIN', NULL, NULL, 5);

--
-- Contenu de la table `ref_grade`
--

INSERT INTO `ref_grade` (`CD_GRAD`, `LB_GRAD`, `BL_DETA`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_GRAD`, `ID_CADREMPL`, `BL_CONS`, `CD_MOTI_N4DS`) VALUES
('111', 'Administrateur général', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 1, 1, 1, NULL),
('112', 'Administrateur hors classe', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 2, 1, 1, NULL),
('113', 'Administrateur', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 3, 1, 1, NULL),
('114', 'Administrateur stagiaire', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 4, 1, 1, NULL),
('121', 'Directeur territorial', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 5, 2, 1, NULL),
('122', 'Attaché principal', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 6, 2, 1, NULL),
('123', 'Attaché territorial', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 7, 2, 1, NULL),
('124', 'Attaché', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 8, 2, 1, NULL),
('131', 'Secrétaire de mairie', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 9, 3, 1, NULL),
('AUT_1', 'Emploi spécifique A+ filière administrative', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 10, 4, 0, NULL),
('AUT_2', 'Emploi spécifique A filière administrative', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 11, 4, 0, NULL),
('AUT_3', 'Temps non complet inférieur à 17h30 A+ filière administrative ', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 12, 4, 0, NULL),
('AUT_4', 'Temps non complet inférieur à 17h30 A filière administrative', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 13, 4, 0, NULL),
('AUT_5', 'Contractuel sans référence à un cadre d emploi A+ filière administrative', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 14, 4, 0, NULL),
('AUT_6', 'Contractuel sans référence à un cadre d emploi A filière administrative', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 15, 4, 0, NULL),
('AUT_8', 'Contractuel CDI A+ filière administrative', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 16, 4, 0, NULL),
('AUT_9', 'Contractuel CDI A filière administrative', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 17, 4, 0, NULL),
('211', 'Ingénieur en chef de classe exceptionnelle', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 18, 5, 1, NULL),
('212', 'Ingénieur en chef de classe normale', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 19, 5, 1, NULL),
('214', 'Ingénieur principal', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 20, 5, 1, NULL),
('215', 'Ingénieur', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 21, 5, 1, NULL),
('213', 'Ingénieur en chef', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 22, 5, 1, NULL),
('AUT_10', 'Emploi spécifique A+ filière technique', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 23, 6, 0, NULL),
('AUT_11', 'Emploi spécifique A filière technique', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 24, 6, 0, NULL),
('AUT_12', 'Temps non complet inférieur à 17h30 A+ filière technique ', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 25, 6, 0, NULL),
('AUT_13', 'Temps non complet inférieur à 17h30 A filière technique ', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 26, 6, 0, NULL),
('AUT_14', 'Contractuel sans référence à un cadre d emploi A+ filière technique', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 27, 6, 0, NULL),
('AUT_15', 'Contractuel sans référence à un cadre d emploi A filière technique', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 28, 6, 0, NULL),
('AUT_16', 'Contractuel CDI A+ filière technique', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 29, 6, 0, NULL),
('AUT_17', 'Contractuel CDI A filière technique', NULL, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 30, 6, 0, NULL),
('311', 'Conservateur du patrimoine en chef', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 31, 7, 1, NULL),
('312', 'Conservateur du patrimoine', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 32, 7, 1, NULL),
('313', 'Conservateur du patrimoine stagiaire', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 33, 7, 1, NULL),
('321', 'Conservateur des bibliothèques en chef', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 34, 8, 1, NULL),
('322', 'Conservateur des bibliothèques', 1, 1, '2017-09-01 12:42:03', 'ADMIN', NULL, NULL, 35, 8, 1, NULL),
('323', 'Conservateur des bibliothèques stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 36, 8, 1, NULL),
('331', 'Attaché de conservation du patrimoine', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 37, 9, 1, NULL),
('332', 'Attaché de conservation du patrimoine stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 38, 9, 1, NULL),
('341', 'Bibliothécaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 39, 10, 1, NULL),
('342', 'Bibliothécaire stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 40, 10, 1, NULL),
('351', 'Directeur établissement enseignement artistique 1ère catégorie', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 41, 11, 1, NULL),
('352', 'Directeur établissement enseignement artistique 2ème  catégorie', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 42, 11, 1, NULL),
('353', 'Directeur établissement enseignement artistique stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 43, 11, 1, NULL),
('361', 'Professeur enseignement artistique hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 44, 12, 1, NULL),
('362', 'Professeur enseignement artistique classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 45, 12, 1, NULL),
('363', 'Professeur enseignement artistique stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 46, 12, 1, NULL),
('AUT_18', 'Emploi spécifique A+ filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 47, 13, 0, NULL),
('AUT_19', 'Emploi spécifique A filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 48, 13, 0, NULL),
('AUT_20', 'Temps non complet inférieur à 17h30 A+ filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 49, 13, 0, NULL),
('AUT_21', 'Temps non complet inférieur à 17h30 A filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 50, 13, 0, NULL),
('AUT_22', 'Contractuel sans référence à un cadre d emploi A+ filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 51, 13, 0, NULL),
('AUT_23', 'Contractuel sans référence à un cadre d emploi A filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 52, 13, 0, NULL),
('AUT_24', 'Contractuel CDI A+ filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 53, 13, 0, NULL),
('AUT_25', 'Contractuel CDI A filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 54, 13, 0, NULL),
('411', 'Conseiller activités physiques et sportives principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 55, 14, 1, NULL),
('412', 'Conseiller activités physiques et sportives principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 56, 14, 1, NULL),
('413', 'Conseiller activités physiques et sportives', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 57, 14, 1, NULL),
('414', 'Conseiller activités physiques et sportives stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 58, 14, 1, NULL),
('AUT_26', 'Emploi spécifique A+ filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 59, 15, 0, NULL),
('AUT_27', 'Emploi spécifique A filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 60, 15, 0, NULL),
('AUT_28', 'Temps non complet inférieur à 17h30 filière A+ sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 61, 15, 0, NULL),
('AUT_29', 'Temps non complet inférieur à 17h30 A filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 62, 15, 0, NULL),
('AUT_30', 'Contractuel sans référence à un cadre d emploi A+ filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 63, 15, 0, NULL),
('AUT_31', 'Contractuel sans référence à un cadre d emploi A filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 64, 15, 0, NULL),
('AUT_32', 'Contractuel CDI A+ filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 65, 15, 0, NULL),
('AUT_33', 'Contractuel CDI A filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 66, 15, 0, NULL),
('511', 'Conseiller socio éducatif supérieur', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 67, 16, 1, NULL),
('512', 'Conseiller socio éducatif', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 68, 16, 1, NULL),
('513', 'Conseiller socio éducatif stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 69, 16, 1, NULL),
('AUT_34', 'Emploi spécifique A+ filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 70, 17, 0, NULL),
('AUT_35', 'Emploi spécifique A filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 71, 17, 0, NULL),
('AUT_36', 'Temps non complet inférieur à 17h30 A+ filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 72, 17, 0, NULL),
('AUT_37', 'Temps non complet inférieur à 17h30 A filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 73, 17, 0, NULL),
('AUT_38', 'Contractuel sans référence à un cadre d emploi A+ filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 74, 17, 0, NULL),
('AUT_39', 'Contractuel sans référence à un cadre d emploi A filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 75, 17, 0, NULL),
('AUT_40', 'Contractuel CDI A+ filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 76, 17, 0, NULL),
('AUT_41', 'Contractuel CDI A filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 77, 17, 0, NULL),
('611', 'Médecin hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 78, 18, 1, NULL),
('612', 'Médecin 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 79, 18, 1, NULL),
('613', 'Médecin 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 80, 18, 1, NULL),
('614', 'Médecin stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 81, 18, 1, NULL),
('621', 'Psychologue hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 82, 19, 1, NULL),
('622', 'Psychologue classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 83, 19, 1, NULL),
('623', 'Psychologue stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 84, 19, 1, NULL),
('631', 'Sage femme classe exceptionnelle', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 85, 20, 1, NULL),
('632', 'Sage femme classe supérieure', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 86, 20, 1, NULL),
('633', 'Sage femme classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 87, 20, 1, NULL),
('634', 'Sage femme stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 88, 20, 1, NULL),
('641', 'Puéricultrice cadre de santé supérieur', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 89, 21, 1, NULL),
('642', 'Puéricultrice cadre de santé', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 90, 21, 1, NULL),
('643', 'Puéricultrice cadre de santé stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 91, 21, 1, NULL),
('651', 'Puéricultrice classe supérieure', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 92, 22, 1, NULL),
('652', 'Puéricultrice classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 93, 22, 1, NULL),
('653', 'Puéricultrice stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 94, 22, 1, NULL),
('65B4', 'Puéricultrice hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 95, 23, 1, NULL),
('65B5', 'Puéricultrice classe supérieure', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 96, 23, 1, NULL),
('65B6', 'Puéricultrice classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 97, 23, 1, NULL),
('65B7', 'Puéricultrice classe normale stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 98, 23, 1, NULL),
('661', 'Cadre de santé', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 99, 24, 1, NULL),
('662', 'Cadre de santé stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 100, 24, 1, NULL),
('671', 'Infirmier en soins généraux hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 101, 25, 1, NULL),
('672', 'Infirmier en soins généraux classe supérieure', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 102, 25, 1, NULL),
('673', 'Infirmier en soins généraux classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 103, 25, 1, NULL),
('674', 'Infirmier en soins généraux classe normale stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 104, 25, 1, NULL),
('AUT_42', 'Emploi spécifique A+ filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 105, 26, 0, NULL),
('AUT_43', 'Emploi spécifique A filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 106, 26, 0, NULL),
('AUT_44', 'Temps non complet inférieur à 17h30 A+ filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 107, 26, 0, NULL),
('AUT_45', 'Temps non complet inférieur à 17h30 A filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 108, 26, 0, NULL),
('AUT_46', 'Contractuel sans référence à un cadre d emploi A+ filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 109, 26, 0, NULL),
('AUT_47', 'Contractuel sans référence à un cadre d emploi A filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 110, 26, 0, NULL),
('AUT_48', 'Contractuel CDI A+ filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 111, 26, 0, NULL),
('AUT_49', 'Contractuel CDI A filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 112, 26, 0, NULL),
('711', 'Biologiste vétérinaire pharmacien classe exceptionnelle', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 113, 27, 1, NULL),
('712', 'Biologiste vétérinaire pharmacien hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 114, 27, 1, NULL),
('713', 'Biologiste vétérinaire pharmacien classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 115, 27, 1, NULL),
('714', 'Biologiste vétérinaire pharmacien classe normale stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 116, 27, 1, NULL),
('AUT_50', 'Emploi spécifique A+ filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 117, 28, 0, NULL),
('AUT_51', 'Emploi spécifique A filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 118, 28, 0, NULL),
('AUT_52', 'Temps non complet inférieur à 17h30 A+ filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 119, 28, 0, NULL),
('AUT_53', 'Temps non complet inférieur à 17h30 A filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 120, 28, 0, NULL),
('AUT_54', 'Contractuel sans référence à un cadre d emploi A+ filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 121, 28, 0, NULL),
('AUT_55', 'Contractuel sans référence à un cadre d emploi A filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 122, 28, 0, NULL),
('AUT_56', 'Contractuel CDI A+ filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 123, 28, 0, NULL),
('AUT_57', 'Contractuel CDI A filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 124, 28, 0, NULL),
('811', 'Directeur police municipale principal', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 125, 29, 1, NULL),
('812', 'Directeur police municipale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 126, 29, 1, NULL),
('813', 'Directeur police municipale stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 127, 29, 1, NULL),
('AUT_58', 'Emploi spécifique A+ filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 128, 30, 0, NULL),
('AUT_59', 'Emploi spécifique A filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 129, 30, 0, NULL),
('AUT_60', 'Temps non complet inférieur à 17h30 A+ filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 130, 30, 0, NULL),
('AUT_61', 'Temps non complet inférieur à 17h30 A filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 131, 30, 0, NULL),
('AUT_62', 'Contractuel sans référence à un cadre d emploi A+ filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 132, 30, 0, NULL),
('AUT_63', 'Contractuel sans référence à un cadre d emploi A filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 133, 30, 0, NULL),
('AUT_64', 'Contractuel CDI A+ filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 134, 30, 0, NULL),
('AUT_65', 'Contractuel CDI A filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 135, 30, 0, NULL),
('AUT_66', 'Emploi spécifique A+ filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 136, 31, 0, NULL),
('AUT_67', 'Emploi spécifique A filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 137, 31, 0, NULL),
('AUT_68', 'Temps non complet inférieur à 17h30 A+ filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 138, 31, 0, NULL),
('AUT_69', 'Temps non complet inférieur à 17h30 A filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 139, 31, 0, NULL),
('AUT_70', 'Contractuel sans référence à un cadre d emploi A+ filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 140, 31, 0, NULL),
('AUT_71', 'Contractuel sans référence à un cadre d emploi A filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 141, 31, 0, NULL),
('AUT_72', 'Contractuel CDI A+ filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 142, 31, 0, NULL),
('AUT_73', 'Contractuel CDI A filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 143, 31, 0, NULL),
('1011', 'Colonel sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 144, 32, 1, NULL),
('1012', 'Lieutenant colonel sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 145, 32, 1, NULL),
('1013', 'Commandant sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 146, 32, 1, NULL),
('1014', 'Capitaine sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 147, 32, 1, NULL),
('1021', 'Médecin et pharmacien sapeur pompier professionnel classe exceptionnelle', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 148, 33, 1, NULL),
('1022', 'Médecin et pharmacien sapeur pompier professionnel hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 149, 33, 1, NULL),
('1023', 'Médecin et pharmacien sapeur pompier professionnel 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 150, 33, 1, NULL),
('1024', 'Médecin et pharmacien sapeur pompier professionnel 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 151, 33, 1, NULL),
('1025', 'Médecin et pharmacien sapeur pompier professionnel stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 152, 33, 1, NULL),
('1041', 'Infirmier encadrement sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 153, 34, 1, NULL),
('1042', 'Infirmier encadrement sapeur pompier professionnel stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 154, 34, 1, NULL),
('AUT_74', 'Emploi spécifique A+ filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 155, 35, 0, NULL),
('AUT_75', 'Emploi spécifique A filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 156, 35, 0, NULL),
('AUT_76', 'Temps non complet inférieur à 17h30 A+ filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 157, 35, 0, NULL),
('AUT_77', 'Temps non complet inférieur à 17h30 A filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 158, 35, 0, NULL),
('AUT_78', 'Contractuel sans référence à un cadre d emploi A+ filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 159, 35, 0, NULL),
('AUT_79', 'Contractuel sans référence à un cadre d emploi A filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 160, 35, 0, NULL),
('AUT_80', 'Contractuel CDI A+ filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 161, 35, 0, NULL),
('AUT_81', 'Contractuel CDI A filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 162, 35, 0, NULL),
('141', 'Rédacteur principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 163, 36, 1, NULL),
('142', 'Rédacteur principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 164, 36, 1, NULL),
('144', 'Rédacteur', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 165, 36, 1, NULL),
('143', 'Rédacteur principal 2ème classe stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 166, 36, 1, NULL),
('145', 'Rédacteur stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 167, 36, 1, NULL),
('AUT_82', 'Emploi spécifique B filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 168, 4, 0, NULL),
('AUT_83', 'Temps non complet inférieur à 17h30 B filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 169, 4, 0, NULL),
('AUT_84', 'Contractuel sans référence à un cadre d\'emploi B filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 170, 4, 0, NULL),
('AUT_85', 'Contractuel CDI B filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 171, 4, 0, NULL),
('221', 'Technicien principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 172, 37, 1, NULL),
('222', 'Technicien principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 173, 37, 1, NULL),
('224', 'Technicien', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 174, 37, 1, NULL),
('223', 'Technicien principal 2ème classe stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 175, 37, 1, NULL),
('225', 'Technicien stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 176, 37, 1, NULL),
('AUT_86', 'Emploi spécifique B filière technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 177, 6, 0, NULL),
('AUT_87', 'Temps non complet inférieur à 17h30 B filière technique ', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 178, 6, 0, NULL),
('AUT_88', 'Contractuel sans référence à un cadre d emploi B filière technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 179, 6, 0, NULL),
('AUT_89', 'Contractuel CDI B filière technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 180, 6, 0, NULL),
('371', 'Assistant conservation patrimoine et bibliothèques principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 181, 38, 1, NULL),
('372', 'Assistant conservation patrimoine et bibliothèques principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 182, 38, 1, NULL),
('374', 'Assistant conservation patrimoine et biliothèques', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 183, 38, 1, NULL),
('373', 'Assistant conservation patrimoine et bibliothèques principal 2ème classe stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 184, 38, 1, NULL),
('375', 'Assistant conservation patrimoine et biliothèques stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 185, 38, 1, NULL),
('381', 'Assistant enseignement artistique principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 186, 39, 1, NULL),
('383', 'Assistant enseignement artistique principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 187, 39, 1, NULL),
('385', 'Assistant enseignement artistique', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 188, 39, 1, NULL),
('384', 'Assistant enseignement artistique principal 1ère classe stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 189, 39, 1, NULL),
('386', 'Assistant enseignement artistique stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 190, 39, 1, NULL),
('AUT_90', 'Emploi spécifique B filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 191, 13, 0, NULL),
('AUT_91', 'Temps non complet inférieur à 17h30 B filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 192, 13, 0, NULL),
('AUT_92', 'Contractuel sans référence à un cadre d emploi B filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 193, 13, 0, NULL),
('AUT_93', 'Contractuel CDI B filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 194, 13, 0, NULL),
('421', 'Educateur activités physiques et sportives principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 195, 40, 1, NULL),
('422', 'Educateur activités physiques et sportives principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 196, 40, 1, NULL),
('424', 'Educateur activités physiques et sportives', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 197, 40, 1, NULL),
('423', 'Educateur activités physiques et sportives principal 2ème classe stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 198, 40, 1, NULL),
('425', 'Educateur activités physiques et sportives stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 199, 40, 1, NULL),
('AUT_94', 'Emploi spécifique B filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 200, 15, 0, NULL),
('AUT_95', 'Temps non complet inférieur à 17h30 B filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 201, 15, 0, NULL),
('AUT_96', 'Contractuel sans référence à un cadre d emploi B filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 202, 15, 0, NULL),
('AUT_97', 'Contractuel CDI B filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 203, 15, 0, NULL),
('521', 'Assistant socio éducatif principal', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 204, 41, 1, NULL),
('522', 'Assistant socio éducatif', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 205, 41, 1, NULL),
('523', 'Assistant socio éducatif stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 206, 41, 1, NULL),
('531', 'Educateur de jeunes enfants principal', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 207, 42, 1, NULL),
('532', 'Educateur de jeunes enfants', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 208, 42, 1, NULL),
('533', 'Educateur de jeunes enfants stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 209, 42, 1, NULL),
('541', 'Moniteur éducateur et intervenant familial principal', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 210, 43, 1, NULL),
('542', 'Moniteur éducateur et intervenant familial', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 211, 43, 1, NULL),
('543', 'Moniteur éducateur et intervenant familial stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 212, 43, 1, NULL),
('AUT_95', 'Emploi spécifique B filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 213, 17, 0, NULL),
('AUT_96', 'Temps non complet inférieur à 17h30 B filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 214, 17, 0, NULL),
('AUT_97', 'Contractuel sans référence à un cadre d emploi B filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 215, 17, 0, NULL),
('AUT_98', 'Contractuel CDI B filière sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 216, 17, 0, NULL),
('681', 'Infirmier classe supérieure', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 217, 44, 1, NULL),
('682', 'Infirmier classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 218, 44, 1, NULL),
('683', 'Infirmier stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 219, 44, 1, NULL),
('AUT_99', 'Emploi spécifique B filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 220, 26, 0, NULL),
('AUT_100', 'Temps non complet inférieur à 17h30 B filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 221, 26, 0, NULL),
('AUT_101', 'Contractuel sans référence à un cadre d emploi B filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 222, 26, 0, NULL),
('AUT_102', 'Contractuel CDI B filière médico sociale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 223, 26, 0, NULL),
('721', 'Technicien paramédical classe supérieure', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 224, 45, 1, NULL),
('722', 'Technicien paramédical classe normale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 225, 45, 1, NULL),
('723', 'Technicien paramédical classe normale stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 226, 45, 1, NULL),
('AUT_103', 'Emploi spécifique B filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 227, 28, 0, NULL),
('AUT_104', 'Temps non complet inférieur à 17h30 B filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 228, 28, 0, NULL),
('AUT_105', 'Contractuel sans référence à un cadre d emploi B filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 229, 28, 0, NULL),
('AUT_106', 'Contractuel CDI B filière médico technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 230, 28, 0, NULL),
('821', 'Chef de service police municipale principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 231, 46, 1, NULL),
('822', 'Chef de service police municipale principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 232, 46, 1, NULL),
('823', 'Chef de service police municipale', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 233, 46, 1, NULL),
('AUT_107', 'Emploi spécifique B filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 234, 30, 0, NULL),
('AUT_108', 'Temps non complet inférieur à 17h30 B filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 235, 30, 0, NULL),
('AUT_109', 'Contractuel sans référence à un cadre d emploi B filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 236, 30, 0, NULL),
('AUT_110', 'Contractuel CDI B filière police municipale', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 237, 30, 0, NULL),
('911', 'Animateur principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 238, 47, 1, NULL),
('912', 'Animateur principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 239, 47, 1, NULL),
('914', 'Animateur', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 240, 47, 1, NULL),
('913', 'Animateur principal 2ème classe stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 241, 47, 1, NULL),
('915', 'Animateur stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 242, 47, 1, NULL),
('AUT_111', 'Emploi spécifique B filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 243, 31, 0, NULL),
('AUT_112', 'Temps non complet inférieur à 17h30 B filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 244, 31, 0, NULL),
('AUT_113', 'Contractuel sans référence à un cadre d emploi B filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 245, 31, 0, NULL),
('AUT_114', 'Contractuel CDI B filière animation', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 246, 31, 0, NULL),
('1031', 'Lieutenant sapeur pompier professionnel hors classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 247, 48, 1, NULL),
('1032', 'Lieutenant sapeur pompier professionnel 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 248, 48, 1, NULL),
('1033', 'Lieutenant sapeur pompier professionnels 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 249, 48, 1, NULL),
('1051', 'Infirmier sapeur pompier professionnel chef', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 250, 49, 1, NULL),
('1052', 'Infirmier sapeur pompier professionnel principal', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 251, 49, 1, NULL),
('1053', 'Infirmier sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 252, 49, 1, NULL),
('1054', 'Infirmier sapeur pompier professionnel stagiaire', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 253, 49, 1, NULL),
('AUT_115', 'Emploi spécifique B filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 254, 35, 0, NULL),
('AUT_116', 'Temps non complet inférieur à 17h30 B filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 255, 35, 0, NULL),
('AUT_117', 'Contractuel sans référence à un cadre d emploi B filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 256, 35, 0, NULL),
('AUT_118', 'Contractuel CDI B filière incendie et secours', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 257, 35, 0, NULL),
('151', 'Adjoint administratif principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 258, 50, 1, NULL),
('152', 'Adjoint administratif principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 259, 50, 1, NULL),
('153', 'Adjoint administratif 1ère classe ', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 260, 50, 1, NULL),
('154', 'Adjoint administratif 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 261, 50, 1, NULL),
('AUT_119', 'Emploi spécifique C filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 262, 4, 0, NULL),
('AUT_120', 'Temps non complet inférieur à 17h30 C filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 263, 4, 0, NULL),
('AUT_121', 'Contractuel sans référence à un cadre d emploi C filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 264, 4, 0, NULL),
('AUT_122', 'Contractuel CDI C filière administrative', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 265, 4, 0, NULL),
('231', 'Agent de maîtrise principal', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 266, 51, 1, NULL),
('232', 'Agent de maîtrise', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 267, 51, 1, NULL),
('241', 'Adjoint technique principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 268, 52, 1, NULL),
('242', 'Adjoint technique principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 269, 52, 1, NULL),
('243', 'Adjoint technique 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 270, 52, 1, NULL),
('244', 'Adjoint technique 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 271, 52, 1, NULL),
('251', 'Adjoint technique des établissements d\'enseignement principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 272, 53, 1, NULL),
('252', 'Adjoint technique des établissements d\'enseignement principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 273, 53, 1, NULL),
('253', 'Adjoint technique des établissements d\'enseignement 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 274, 53, 1, NULL),
('254', 'Adjoint technique des établissements d\'enseignement 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 275, 53, 1, NULL),
('AUT_123', 'Emploi spécifique C filière technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 276, 6, 0, NULL),
('AUT_124', 'Temps non complet inférieur à 17h30 C filière technique ', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 277, 6, 0, NULL),
('AUT_125', 'Contractuel sans référence à un cadre d emploi C filière technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 278, 6, 0, NULL),
('AUT_126', 'Contractuel CDI C filière technique', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 279, 6, 0, NULL),
('391', 'Adjoint patrimoine principal 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 280, 54, 1, NULL),
('392', 'Adjoint patrimoine principal 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 281, 54, 1, NULL),
('393', 'Adjoint patrimoine 1ère classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 282, 54, 1, NULL),
('394', 'Adjoint patrimoine 2ème classe', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 283, 54, 1, NULL),
('AUT_127', 'Emploi spécifique C filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 284, 13, 0, NULL),
('AUT_128', 'Temps non complet inférieur à 17h30 C filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 285, 13, 0, NULL),
('AUT_129', 'Contractuel sans référence à un cadre d emploi C filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 286, 13, 0, NULL),
('AUT_130', 'Contractuel CDI C filière culturelle', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 287, 13, 0, NULL),
('431', 'Opérateur activités physiques et sportives principal', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 288, 55, 1, NULL),
('432', 'Opérateur activités physiques et sportives qualifié', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 289, 55, 1, NULL),
('433', 'Opérateur activités physiques et sportives', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 290, 55, 1, NULL),
('434', 'Aide opérateur activités physiques et sportives', 1, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 291, 55, 1, NULL),
('AUT_131', 'Emploi spécifique C filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 292, 15, 0, NULL),
('AUT_132', 'Temps non complet inférieur à 17h30 C filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 293, 15, 0, NULL),
('AUT_133', 'Contractuel sans référence à un cadre d emploi C filière sportive', NULL, 1, '2017-09-01 12:42:04', 'ADMIN', NULL, NULL, 294, 15, 0, NULL),
('AUT_134', 'Contractuel CDI C filière sportive', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 295, 15, 0, NULL),
('551', 'Agent spécialisé des écoles maternelles principal 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 296, 56, 1, NULL),
('552', 'Agent spécialisé des écoles maternelles principal 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 297, 56, 1, NULL),
('553', 'Agent spécialisé des écoles maternelles 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 298, 56, 1, NULL),
('561', 'Agent social principal 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 299, 57, 1, NULL),
('562', 'Agent social principal 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 300, 57, 1, NULL),
('563', 'Agent social 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 301, 57, 1, NULL),
('564', 'Agent social 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 302, 57, 1, NULL),
('AUT_135', 'Emploi spécifique C filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 303, 17, 0, NULL),
('AUT_136', 'Temps non complet inférieur à 17h30 C filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 304, 17, 0, NULL),
('AUT_137', 'Contractuel sans référence à un cadre d emploi C filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 305, 17, 0, NULL),
('AUT_138', 'Contractuel CDI C filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 306, 17, 0, NULL),
('691', 'Auxiliaire puériculture principal 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 307, 58, 1, NULL),
('692', 'Auxiliaire puériculture principal 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 308, 58, 1, NULL),
('693', 'Auxiliaire puériculture 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 309, 58, 1, NULL),
('69Z1', 'Auxiliaire soins principal 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 310, 59, 1, NULL),
('69Z2', 'Auxiliaire soins principal 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 311, 59, 1, NULL),
('69Z3', 'Auxiliaire soins 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 312, 59, 1, NULL),
('AUT_139', 'Emploi spécifique C filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 313, 26, 0, NULL),
('AUT_140', 'Temps non complet inférieur à 17h30 C filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 314, 26, 0, NULL),
('AUT_141', 'Contractuel sans référence à un cadre d emploi C filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 315, 26, 0, NULL),
('AUT_142', 'Contractuel CDI C filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 316, 26, 0, NULL),
('AUT_143', 'Emploi spécifique C filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 317, 28, 0, NULL),
('AUT_144', 'Temps non complet inférieur à 17h30 C filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 318, 28, 0, NULL),
('AUT_145', 'Contractuel sans référence à un cadre d emploi C filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 319, 28, 0, NULL),
('AUT_146', 'Contractuel CDI C filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 320, 28, 0, NULL),
('831', 'Chef de police municipale', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 321, 60, 1, NULL),
('832', 'Brigadier chef principal', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 322, 60, 1, NULL),
('833', 'Brigadier', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 323, 60, 1, NULL),
('834', 'Gardien', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 324, 60, 1, NULL),
('841', 'Garde champêtre chef principal', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 325, 61, 1, NULL),
('842', 'Garde champêtre chef', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 326, 61, 1, NULL),
('843', 'Garde champêtre principal', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 327, 61, 1, NULL),
('AUT_147', 'Emploi spécifique C filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 328, 30, 0, NULL),
('AUT_148', 'Temps non complet inférieur à 17h30 C filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 329, 30, 0, NULL),
('AUT_149', 'Contractuel sans référence à un cadre d emploi C filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 330, 30, 0, NULL),
('AUT_150', 'Contractuel CDI C filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 331, 30, 0, NULL),
('921', 'Adjoint animation principal 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 332, 62, 1, NULL),
('922', 'Adjoint animation principal de 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 333, 62, 1, NULL),
('923', 'Adjoint animation 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 334, 62, 1, NULL),
('924', 'Adjoint animation 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 335, 62, 1, NULL),
('AUT_151', 'Emploi spécifique C filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 336, 31, 0, NULL),
('AUT_152', 'Temps non complet inférieur à 17h30 C filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 337, 31, 0, NULL),
('AUT_153', 'Contractuel sans référence à un cadre d emploi C filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 338, 31, 0, NULL),
('AUT_154', 'Contractuel CDI C filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 339, 31, 0, NULL),
('1061', 'Adjudant sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 340, 63, 1, NULL),
('1062', 'Sergent sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 341, 63, 1, NULL),
('1071', 'Caporal chef sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 342, 64, 1, NULL),
('1072', 'Caporal sapeur pompier professionnel', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 343, 64, 1, NULL),
('1073', 'Sapeur sapeur pompier professionnel 1ère classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 344, 64, 1, NULL),
('1074', 'Sapeur pompier professionnel 2ème classe', 1, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 345, 64, 1, NULL),
('AUT_154', 'Emploi spécifique C filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 346, 35, 0, NULL),
('AUT_155', 'Temps non complet inférieur à 17h30 C filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 347, 35, 0, NULL),
('AUT_156', 'Contractuel sans référence à un cadre d emploi C filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 348, 35, 0, NULL),
('AUT_157', 'Contractuel CDI C filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 349, 35, 0, NULL),
('AUT_158', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière administrative', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 350, 4, 0, NULL),
('AUT_159', 'Agent sur contrat unique d\'insertion (CUI CAE) filière administrative', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 351, 4, 0, NULL),
('AUT_160', 'Agent sur contrat emploi d avenir filière administrative', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 352, 4, 0, NULL),
('AUT_161', 'Agent sur PACTE filière administrative', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 353, 4, 0, NULL),
('AUT_162', 'Agent sur emploi à statut inconnu filière administrative', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 354, 4, 0, NULL),
('AUT_163', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 355, 6, 0, NULL),
('AUT_164', 'Agent sur contrat unique d\'insertion (CUI CAE) filière technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 356, 6, 0, NULL),
('AUT_165', 'Agent sur contrat emploi d avenir filière technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 357, 6, 0, NULL),
('AUT_166', 'Agent sur PACTE filière technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 358, 6, 0, NULL),
('AUT_167', 'Agent sur emploi à statut inconnu filière technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 359, 6, 0, NULL),
('AUT_168', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière culturelle', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 360, 13, 0, NULL),
('AUT_169', 'Agent sur contrat unique d\'insertion (CUI CAE) filière culturelle', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 361, 13, 0, NULL),
('AUT_170', 'Agent sur contrat emploi d avenir filière culturelle', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 362, 13, 0, NULL),
('AUT_171', 'Agent sur PACTE filière culturelle', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 363, 13, 0, NULL),
('AUT_172', 'Agent sur emploi à statut inconnu filière culturelle', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 364, 13, 0, NULL),
('AUT_173', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière sportive', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 365, 15, 0, NULL),
('AUT_174', 'Agent sur contrat unique d\'insertion (CUI CAE) filière sportive', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 366, 15, 0, NULL),
('AUT_175', 'Agent sur contrat emploi d avenir filière sportive', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 367, 15, 0, NULL),
('AUT_176', 'Agent sur PACTE filière sportive', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 368, 15, 0, NULL),
('AUT_177', 'Agent sur emploi à statut inconnu filière sportive', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 369, 15, 0, NULL),
('AUT_178', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 370, 17, 0, NULL),
('AUT_179', 'Agent sur contrat unique d\'insertion (CUI CAE) filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 371, 17, 0, NULL),
('AUT_180', 'Agent sur contrat emploi d avenir filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 372, 17, 0, NULL),
('AUT_181', 'Agent sur PACTE filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 373, 17, 0, NULL),
('AUT_182', 'Agent sur emploi à statut inconnu filière sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 374, 17, 0, NULL),
('AUT_183', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 375, 26, 0, NULL),
('AUT_184', 'Agent sur contrat unique d\'insertion (CUI CAE) filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 376, 26, 0, NULL),
('AUT_185', 'Agent sur contrat emploi d avenir filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 377, 26, 0, NULL),
('AUT_186', 'Agent sur PACTE filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 378, 26, 0, NULL),
('AUT_187', 'Agent sur emploi à statut inconnu filière médico sociale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 379, 26, 0, NULL),
('AUT_188', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 380, 28, 0, NULL),
('AUT_189', 'Agent sur contrat unique d\'insertion (CUI CAE) filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 381, 28, 0, NULL),
('AUT_190', 'Agent sur contrat emploi d avenir filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 382, 28, 0, NULL),
('AUT_191', 'Agent sur PACTE filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 383, 28, 0, NULL),
('AUT_192', 'Agent sur emploi à statut inconnu filière médico technique', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 384, 28, 0, NULL),
('AUT_193', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 385, 30, 0, NULL),
('AUT_194', 'Agent sur contrat unique d\'insertion (CUI CAE) filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 386, 30, 0, NULL),
('AUT_195', 'Agent sur contrat emploi d avenir filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 387, 30, 0, NULL),
('AUT_196', 'Agent sur PACTE filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 388, 30, 0, NULL),
('AUT_197', 'Agent sur emploi à statut inconnu filière police municipale', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 389, 30, 0, NULL);
INSERT INTO `ref_grade` (`CD_GRAD`, `LB_GRAD`, `BL_DETA`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_GRAD`, `ID_CADREMPL`, `BL_CONS`, `CD_MOTI_N4DS`) VALUES
('AUT_198', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 390, 31, 0, NULL),
('AUT_199', 'Agent sur contrat unique d\'insertion (CUI CAE) filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 391, 31, 0, NULL),
('AUT_200', 'Agent sur contrat emploi d avenir filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 392, 31, 0, NULL),
('AUT_201', 'Agent sur PACTE filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 393, 31, 0, NULL),
('AUT_202', 'Agent sur emploi à statut inconnu filière animation', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 394, 31, 0, NULL),
('AUT_203', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 395, 35, 0, NULL),
('AUT_204', 'Agent sur contrat unique d\'insertion (CUI CAE) filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 396, 35, 0, NULL),
('AUT_205', 'Agent sur contrat emploi d avenir filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 397, 35, 0, NULL),
('AUT_206', 'Agent sur PACTE filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 398, 35, 0, NULL),
('AUT_207', 'Agent sur emploi à statut inconnu filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 399, 35, 0, NULL),
('AUT_207', 'Fonctionnaire ou contractuel non classable dans une filière', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 400, 65, 0, NULL),
('AUT_208', 'Collaborateur de cabinet', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 401, 65, 0, NULL),
('AUT_209', 'Assistante maternelle', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 402, 65, 0, NULL),
('AUT_210', 'Agent territorial de Mayotte', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 403, 65, 0, NULL),
('AUT_211', 'Ouvrier territorial de Mayotte', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 404, 65, 0, NULL),
('AUT_212', 'Agent sur contrat d\'insertion dans la vie sociale (CIVIS) emplois hors filière', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 405, 65, 0, NULL),
('AUT_213', 'Agent sur contrat unique d\'insertion (CUI CAE) emplois hors filière', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 406, 65, 0, NULL),
('AUT_214', 'Agent sur contrat emploi d avenir emplois hors filière', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 407, 65, 0, NULL),
('AUT_215', 'Agent sur PACTE filière incendie et secours', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 408, 65, 0, NULL),
('AUT_216', 'Agent sur emploi à statut inconnu emplois hors filière', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 409, 65, 0, NULL),
('AUT_217', 'Apprenti', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 410, 66, 0, NULL),
('AUT_218', 'Agent en congé de fin d\'activité, retraité du cadre local', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 411, 66, 0, NULL),
('AUT_219', 'Agent exerçant des activités accessoires autorisées par la règlementation sur le cumul d\'emploi', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 412, 66, 0, NULL),
('AUT_220', 'Autre (non classable dans les rubriques précédentes)', NULL, 1, '2017-09-01 12:42:05', 'ADMIN', NULL, NULL, 413, 66, 0, NULL);

--
-- Contenu de la table `ref_groupe_position_statutaire`
--

INSERT INTO `ref_groupe_position_statutaire` (`CD_GROUPOSISTAT`, `LB_GROUPOSISTAT`, `LB_GROUCOMPL`, `LB_GROUCOMM`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_GROUPOSISTAT`) VALUES
('GPS007', 'Détachés dans une autre structure', '(article 64) ', 'Fonctionnaires uniquement', 1, '2017-09-01 13:25:07', 'ADMIN', NULL, NULL, 7),
('GPS008', 'Détachés au sein de leur propre collectivité', '', 'Fonctionnaires uniquement', 1, '2017-09-01 13:25:07', 'ADMIN', NULL, NULL, 8),
('GPS009', 'Mis à disposition dans une autre structure', '(article 61)', 'Fonctionnaires uniquement', 1, '2017-09-01 13:25:07', 'ADMIN', NULL, NULL, 9),
('GPS010', 'Détachés dans votre collectivité et issus de', '', '', 0, '2017-09-01 13:25:07', 'ADMIN', NULL, NULL, 10),
('GPS011', 'Mis à disposition de votre collectivité', '', '', 0, '2017-09-01 13:25:07', 'ADMIN', NULL, NULL, 11),
('GPS012', 'Mis à disposition de votre collectivité dont originaire de la fonction publique d\'Etat', '', '', 0, '2017-09-01 13:25:07', 'ADMIN', NULL, NULL, 12),
('GPS013', 'Fonctionnaires pris en charge par le CDG ou le CNFPT (articles 53 et 97) ', '', '', 0, '2017-09-01 13:25:07', 'ADMIN', NULL, NULL, 13);

--
-- Contenu de la table `ref_inaptitude`
--

INSERT INTO `ref_inaptitude` (`CD_INAP`, `LB_INAP`, `BL_DEMA`, `BL_DECI`, `BL_VISUAGEN`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_INAP`, `BL_FILI`) VALUES
('INAP001', 'Demande de reclassement au cours de l\'année 2015 suite à une inaptitude liée à un accident du travail ou une maladie professionnelle', 1, 0, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 1, NULL),
('INAP002', 'Demande de reclassement au cours de l\'année 2015 suite à une inaptitude liée à d\'autres facteurs', 1, 0, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 2, NULL),
('INAP003', 'Reclassement effectif au cours de l\'année 2015 suite à une inaptitude liée à un accident du travail ou une maladie professionnelle', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 3, NULL),
('INAP004', 'Reclassement effectif au cours de l\'année 2015 suite à une inaptitude liée à d\'autres facteurs', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 4, NULL),
('INAP005', 'Retraite pour invalidité', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 5, NULL),
('INAP006', 'Licenciement pour inaptitude physique', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 6, NULL),
('INAP007', 'Décision d\'inaptitude définitive du fonctionnaire à son emploi, et à tout emploi, au cours de l\'année 2015 suite à l\'avis du comité médical ou de la commission de réforme et travaillant dans la filière : ', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 7, NULL),
('INAP008', 'Décisions d\'accord de temps partiel thérapeutique recensées sur l\'année 2015', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 8, NULL),
('INAP009', 'Décisions d\'accord d\'aménagement d\'horaire ou d\'aménagement de poste de travail', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 9, NULL),
('INAP010', 'Mises en disponibilité d\'office', 0, 1, NULL, 1, '2017-09-01 12:46:31', 'ADMIN', NULL, NULL, 10, NULL);

--
-- Contenu de la table `ref_motif_absence`
--

INSERT INTO `ref_motif_absence` (`CD_MOTIABSE`, `LB_MOTIABSE`, `BL_ABSECOMP`, `BL_ABSEMEDI`, `BL_ABSEAUTRRAIS`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_MOTIABSE`, `BL_ABSAGE`, `CD_MOTI_N4DS`) VALUES
('ABS001', 'Pour maladie ordinaire', NULL, NULL, NULL, 1, '2017-09-02 11:09:42', 'ADMIN', NULL, NULL, 1, 1, NULL),
('ABS002', 'Pour longue maladie, maladie de longue durée et grave maladie', NULL, NULL, NULL, 1, '2017-09-02 11:09:42', 'ADMIN', NULL, NULL, 2, 1, NULL),
('ABS003', 'Pour accidents du travail imputables au service', NULL, NULL, NULL, 1, '2017-09-02 11:09:42', 'ADMIN', NULL, NULL, 3, 1, NULL),
('ABS004', 'Pour accidents du travail imputables au trajet', NULL, NULL, NULL, 1, '2017-09-02 11:09:42', 'ADMIN', NULL, NULL, 4, 1, NULL),
('ABS005', 'Pour maladie professionnelle, maladie imputable au service ou à caractère professionnel', NULL, NULL, NULL, 1, '2017-09-02 11:09:42', 'ADMIN', NULL, NULL, 5, 1, NULL),
('ABS006', 'Pour maternité et adoption (1)', NULL, NULL, NULL, 1, '2017-09-02 11:09:42', 'ADMIN', NULL, NULL, 6, 0, NULL),
('ABS007', 'Pour paternité et adoption', NULL, NULL, NULL, 1, '2017-09-02 11:09:42', 'ADMIN', NULL, NULL, 7, 0, NULL),
('ABS008', 'Pour autorisation spéciale d\'absence (enfant malade, mariage, décès, concours, fonctions électives, participation au Comité d\'Œuvres Sociales, réserviste, pompier volontaire…) ou formation particulière (ex: BAFA), hors motif syndical ou de représentation', NULL, NULL, NULL, 1, '2017-09-02 11:19:57', 'ADMIN', NULL, NULL, 8, 0, NULL);

--
-- Contenu de la table `ref_motif_arrivee`
--

INSERT INTO `ref_motif_arrivee` (`ID_STAT`, `CD_MOTIARRI`, `LB_MOTIARRI`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_MOTIARRI`, `BL_FONC`, `BL_CONTPERM`, `CD_MOTI_N4DS`) VALUES
(NULL, 'MA001', 'Recrutement direct - Lauréat nouvel arrivant dans la collectivité', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 1, 1, 0, NULL),
(NULL, 'MA002', 'Recrutement direct - Lauréat déjà présent en tant que contractuel', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 2, 1, 0, NULL),
(NULL, 'MA003', 'Voie de concours, sélection pro, examen pro - Lauréat nouvel arrivant dans la collectivité', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 3, 1, 0, NULL),
(NULL, 'MA004', 'Voie de concours, sélection pro, examen pro - Lauréat déjà présent en tant que contractuel', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 4, 1, 0, NULL),
(NULL, 'MA005', 'Article 38', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 5, 1, 0, NULL),
(NULL, 'MA006', 'Intégration directe', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 6, 1, 0, NULL),
(NULL, 'MA007', 'Voie de mutation', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 7, 1, 0, NULL),
(NULL, 'MA008', 'Par voie de détachment d\'agents de la FPE', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 8, 1, 0, NULL),
(NULL, 'MA009', 'Par voie de détachment d\'agents de la FPH', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 9, 1, 0, NULL),
(NULL, 'MA010', 'Par voie de détachment d\'agents d\'autres collectivités territoriales', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 10, 1, 0, NULL),
(NULL, 'MA011', 'Par voie de détachment d\'agents d\'autres organismes (ex: FPEEU)', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 11, 1, 0, NULL),
(NULL, 'MA012', 'Réintégration agent non rémunéré pendant la période d\'absence', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 12, 1, 0, NULL),
(NULL, 'MA013', 'Transfert de compétence', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 13, 1, 0, NULL),
(NULL, 'MA015', 'Réintégration d\'agents en positions particulières ayant été rémunéré pendant la période d\'absence', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 14, 1, 0, NULL),
(NULL, 'MA016', 'Remplaçants', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 15, 0, 1, NULL),
(NULL, 'MA017', 'Réintégration (agent non rémunéré pendant la période)', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 16, 0, 1, NULL),
(NULL, 'MA018', 'Retours (agent rémunéré pendant la période)', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 17, 0, 1, NULL),
(NULL, 'MA019', 'Article 3', 1, '2017-09-02 11:27:21', 'ADMIN', NULL, NULL, 18, 0, 1, NULL);

--
-- Contenu de la table `ref_motif_depart`
--

INSERT INTO `ref_motif_depart` (`ID_STAT`, `CD_MOTIDEPA`, `LB_MOTIDEPA`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_MOTIDEPA`, `BL_FONC`, `BL_CONTPERM`, `BL_DEPATEMP`, `BL_DEPADEFI`, `CD_MOTI_N4DS`) VALUES
(NULL, 'MD001', 'Mise à disposition dans une autre collectivité \r\nou structure (Ne prendre en compte que les mises à disposition complètes)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 1, 1, 1, 1, 0, NULL),
(NULL, 'MD002', 'Décharge totale de service pour exercice de mandats syndicaux (article 100)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 2, 1, 0, 1, 0, NULL),
(NULL, 'MD003', 'Congé formation encore rémunéré par la collectivité (max 1 an)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 3, 1, 1, 1, 0, NULL),
(NULL, 'MD004', 'Congé formation au-delà d\'un an', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 4, 1, 1, 1, 0, NULL),
(NULL, 'MD005', 'Détachement dans une autre structure. Agents de la collectivité qui ont été détachés dans l\'année 2017 dans une autre structure (fonction publique d\'Etat, fonction publique hospitalière)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 5, 1, 0, 1, 0, NULL),
(NULL, 'MD006', 'Mise en disponibilité', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 6, 1, 1, 1, 0, NULL),
(NULL, 'MD007', 'Congé parental', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 7, 1, 1, 1, 0, NULL),
(NULL, 'MD008', 'Mutation (changement de collectivité)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 8, 1, 0, 0, 1, NULL),
(NULL, 'MD009', 'Fin de détachement dans votre collectivité (agents originaires d\'autres structures:fonction publique d\'Etat, fonction publique hospitalière, …dont le détachement dans votre collectivité s\'est terminé dans l\'année 2017)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 9, 1, 0, 0, 1, NULL),
(NULL, 'MD010', 'Décharge d\'emploi et de fonctions ou agent pris en \r\ncharge par le CNFPT ou le CDG', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 10, 1, 0, 0, 1, NULL),
(NULL, 'MD011', 'Fin de contrat (inclure les départs de remplaçants, ne pas inclure les agents contractuels mis en stage dans l\'année 2017)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 11, 0, 1, 0, 1, NULL),
(NULL, 'MD012', 'Démission', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 12, 1, 1, 0, 1, NULL),
(NULL, 'MD013', 'Départ à la retraite', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 13, 1, 1, 0, 1, NULL),
(NULL, 'MD014', 'Licenciement', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 14, 1, 1, 0, 1, NULL),
(NULL, 'MD015', 'Décès', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 15, 1, 1, 0, 1, NULL),
(NULL, 'MD016', 'Autres cas  (révocation, abandon de \r\nposte, perte de la nationalité française, etc.)', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 16, 1, 1, 0, 1, NULL),
(NULL, 'MD017', 'Transfert de compétence', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 17, 1, 1, 0, 1, NULL),
(NULL, 'MD018', 'Agent contractuel nommé stagiaire au sein de la collectivité au cours de l\'année y compris dans le cadre de la loi sauvadet', 1, '2017-09-02 11:26:45', 'ADMIN', NULL, NULL, 18, 0, 1, 0, 1, NULL);

--
-- Contenu de la table `ref_motif_entretien`
--

INSERT INTO `ref_motif_entretien` (`CD_MOTIENTR`, `LB_MOTIENTR`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_MOTIENTR`) VALUES
('ME001', 'Congé parental', 1, '2017-09-01 12:43:48', 'ADMIN', NULL, NULL, 1),
('ME002', 'Disponibilité pour élever un enfant de moins de 8 ans, donner des soins à un enfant à charge, au conjoint, etc.', 1, '2017-09-01 12:43:48', 'ADMIN', NULL, NULL, 2),
('ME003', 'Congé de solidarité familiale (accompagnement des personnes en fin de vie ou dépendance)', 1, '2017-09-01 12:43:48', 'ADMIN', NULL, NULL, 3),
('ME004', 'Disponibilité pour convenances personnelles', 1, '2017-09-01 12:43:48', 'ADMIN', NULL, NULL, 4),
('ME005', 'Autres congés de plus de 6 mois', 1, '2017-09-01 12:43:48', 'ADMIN', NULL, NULL, 5);

--
-- Contenu de la table `ref_motif_greve`
--

INSERT INTO `ref_motif_greve` (`CD_MOTIGREV`, `LB_MOTIGREV`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_MOTIGREV`) VALUES
('MG001', 'Sur mot d\'ordre national ', 1, '2017-09-01 12:46:52', 'ADMIN', NULL, NULL, 1),
('MG002', 'Sur mot d\'ordre uniquement local ', 1, '2017-09-01 12:46:52', 'ADMIN', NULL, NULL, 2),
('MG003', 'Non précisé, autres', 1, '2017-09-01 12:46:52', 'ADMIN', NULL, NULL, 3);

--
-- Contenu de la table `ref_organisme_formation`
--

INSERT INTO `ref_organisme_formation` (`CD_ORGAFORM`, `LB_ORGAFORM`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_ORGAFORM`) VALUES
('ORG001', 'CNFPT au titre de la cotisation obligatoire', 1, '2017-09-01 12:48:07', 'ADMIN', NULL, NULL, 1),
('ORG002', 'CNFPT au-delà de la cotisation obligatoire', 1, '2017-09-01 12:48:07', 'ADMIN', NULL, NULL, 2),
('ORG003', 'Collectivité', 1, '2017-09-01 12:48:07', 'ADMIN', NULL, NULL, 3),
('ORG004', 'Autres organismes', 1, '2017-09-01 12:48:07', 'ADMIN', NULL, NULL, 4),
('ORG005', 'Dont CPF (Compte personnel de formation)', 1, '2017-09-01 12:48:07', 'ADMIN', NULL, NULL, 5);

--
-- Contenu de la table `ref_position_statutaire`
--

INSERT INTO `ref_position_statutaire` (`CD_POSISTAT`, `LB_POSISTAT`, `BL_CDG`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_POSISTAT`, `LB_COMPL`, `LB_COMM`, `ID_GROUPOSISTAT`, `BL_IND142`, `BL_IND143`, `BL_IND144`, `CD_MOTI_N4DS`) VALUES
('PS001', 'Fonction publique d\'Etat', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 1, '', '', 7, NULL, NULL, NULL, NULL),
('PS002', 'Fonction publique hospitalière', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 2, '', '', 7, NULL, NULL, NULL, NULL),
('PS003', 'Autre collectivité', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 3, '', '', 7, NULL, NULL, NULL, NULL),
('PS004', 'Autres structures*', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 4, '', '*par exemple: Fonction publique d\'un Etat de l\'Union européenne (FPEUE)', 7, NULL, NULL, NULL, NULL),
('PS005', 'Détachés sur un emploi fonctionnel dans leur collectivité', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 5, '', '', 8, NULL, NULL, NULL, NULL),
('PS006', 'Détachés sur un emploi de cabinet dans leur collectivité', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 6, '', '', 8, NULL, NULL, NULL, NULL),
('PS007', 'Changement de filière', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 7, '', '', 8, NULL, NULL, NULL, NULL),
('', 'Ensemble', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 8, '', '', 9, NULL, NULL, NULL, NULL),
('', 'dont mis à disposition d\'une organisation syndicale', NULL, 1, '2017-09-04 10:36:48', 'ADMIN', NULL, NULL, 9, '', '', 9, NULL, NULL, NULL, NULL),
('GPS001', 'En congé parental', NULL, 1, '2017-09-04 11:02:04', 'ADMIN', NULL, NULL, 10, '(article 75)', 'Fonctionnaires et non titulaires', NULL, NULL, NULL, NULL, NULL),
('GPS002', 'En disponibilité', NULL, 1, '2017-09-04 11:02:04', 'ADMIN', NULL, NULL, 11, '(article 72) hors ceux mis en disponibilité d\'office ou bénéficiaires d\'un congé équivalent pour les non titulaires', 'Fonctionnaires et non titulaires', NULL, NULL, NULL, NULL, NULL),
('GPS003', 'En disponibilité', NULL, 1, '2017-09-04 11:02:04', 'ADMIN', NULL, NULL, 12, 'dont disponibilité de droit', 'Fonctionnaires et non titulaires', NULL, NULL, NULL, NULL, NULL),
('GPS004', 'En disponibilité', NULL, 1, '2017-09-04 11:02:04', 'ADMIN', NULL, NULL, 13, 'd\'office ou bénéficiaires d\'un congé équivalent', 'Fonctionnaires et non titulaires', NULL, NULL, NULL, NULL, NULL),
('GPS005', 'En position hors cadres', NULL, 1, '2017-09-04 11:02:04', 'ADMIN', NULL, NULL, 14, '(article 70)', 'Fonctionnaires uniquement', NULL, NULL, NULL, NULL, NULL),
('GPS006', 'En congé spécial', NULL, 1, '2017-09-04 11:02:04', 'ADMIN', NULL, NULL, 15, '(article 99)', 'Fonctionnaires uniquement', NULL, NULL, NULL, NULL, NULL);

--
-- Contenu de la table `ref_pourcentage_tempa_partiel`
--

INSERT INTO `ref_pourcentage_tempa_partiel` (`LB_POURTEMPPART`, `CD_POURTEMPPART`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_POURTEMPPART`, `PC_BORNMIN`, `PC_BORNMAX`) VALUES
('Moins de 80%', 'PTPSP001', 1, '2017-09-01 12:44:09', 'ADMIN', NULL, NULL, 1, NULL, NULL),
('De 80% à moins de 90%', 'PTPSP002', 1, '2017-09-01 12:44:09', 'ADMIN', NULL, NULL, 2, NULL, NULL),
('90% et plus', 'PTPSP003', 1, '2017-09-01 12:44:10', 'ADMIN', NULL, NULL, 3, NULL, NULL);

--
-- Contenu de la table `ref_stage_titularisation`
--

INSERT INTO `ref_stage_titularisation` (`CD_STAGTITU`, `LB_STAGTITU`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_STAGTITU`) VALUES
('TS001', 'Agents stagiaires titularisés à l\'issue de leur stage', 1, '2017-09-01 12:43:34', 'ADMIN', NULL, NULL, 1),
('TS002', 'Prolongation de stage', 1, '2017-09-01 12:43:34', 'ADMIN', NULL, NULL, 2),
('TS003', 'Agents contractuels titularisés (sans stage) sur un emploi permanent de fonctionnaire (PACTE)', 1, '2017-09-01 12:43:34', 'ADMIN', NULL, NULL, 3),
('TS004', 'Titularisations prononcées en application de l\'article 38 de la loi n° 84-53 du 26 janvier 1984 (travailleurs handicapés)', 1, '2017-09-01 12:43:34', 'ADMIN', NULL, NULL, 4),
('TS005', 'Refus de titularisation', 1, '2017-09-01 12:43:34', 'ADMIN', NULL, NULL, 5),
('TS006', 'Agents contractuels ( nouvel arrivant ou déjà présent) nommés stagiaires dans l\'année 2017', 1, '2017-09-01 12:43:34', 'ADMIN', NULL, NULL, 6);

--
-- Contenu de la table `ref_statut`
--

INSERT INTO `ref_statut` (`LB_STAT`, `CD_STAT`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_STAT`, `CD_MOTI_N4DS`) VALUES
('Titulaire', 'TITU', 1, '2017-09-01 12:42:12', 'ADMIN', NULL, NULL, 1, NULL),
('Stagiaire', 'STAG', 1, '2017-09-01 12:42:12', 'ADMIN', NULL, NULL, 2, NULL),
('Contractuel sur emploi permanent', 'CONTPERM', 1, '2017-09-01 12:42:12', 'ADMIN', NULL, NULL, 3, NULL),
('Contractuel sur emploi non permanent', 'CONTNONPERM', 1, '2017-09-01 12:42:12', 'ADMIN', NULL, NULL, 4, NULL);

--
-- Contenu de la table `ref_structure_origine`
--

INSERT INTO `ref_structure_origine` (`CD_STRUORIG`, `LB_STRUORIG`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_STRUORIG`) VALUES
('SU001', 'Fonction publique d\'Etat', '2017-09-01 12:48:01', 'ADMIN', NULL, NULL, 1),
('SU002', 'Fonction publique hospitalière', '2017-09-01 12:48:01', 'ADMIN', NULL, NULL, 2),
('SU003', 'Autre collectivité', '2017-09-01 12:48:01', 'ADMIN', NULL, NULL, 3),
('SU004', 'Autres structures*', '2017-09-01 12:48:01', 'ADMIN', NULL, NULL, 4);

--
-- Contenu de la table `ref_temps_non_complet`
--

INSERT INTO `ref_temps_non_complet` (`CD_TEMPNONCOMP`, `LB_TEMPNONCOMP`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_TEMPNONCOMP`, `NB_MIN_BORNMIN`, `NB_MIN_BORNMAX`) VALUES
('TNC001', 'Moins de 17h30', 1, '2017-09-01 12:44:16', 'ADMIN', NULL, NULL, 1, NULL, NULL),
('TNC002', 'Entre 17h30 et 28h', 1, '2017-09-01 12:44:16', 'ADMIN', NULL, NULL, 2, NULL, NULL),
('TNC003', 'Plus de 28h', 1, '2017-09-01 12:44:16', 'ADMIN', NULL, NULL, 3, NULL, NULL);

--
-- Contenu de la table `ref_temps_partiel`
--

INSERT INTO `ref_temps_partiel` (`CD_TEMPPART`, `LB_TEMPPART`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_TEMPPART`, `CD_MODA_N4DS`) VALUES
('PARTAUTO', 'Temps partiel sur autorisation', 1, '2017-09-01 12:44:03', 'ADMIN', NULL, NULL, 1, NULL),
('PARTDROI', 'Temps partiel de droit', 1, '2017-09-01 12:44:03', 'ADMIN', NULL, NULL, 2, NULL);

--
-- Contenu de la table `ref_tranche_age`
--

INSERT INTO `ref_tranche_age` (`CD_TRANAGE`, `LB_TRANAGE`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_TRANAGE`) VALUES
('TA001', 'moins de 25 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 1),
('TA002', '25 à 29 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 2),
('TA003', '30 à 34 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 3),
('TA004', '35 à 39 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 4),
('TA005', '40 à 44 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 5),
('TA006', '45 à 49 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 6),
('TA007', '50 à 54 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 7),
('TA008', '55 à 59 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 8),
('TA009', '60 à 64 ans', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 9),
('TA010', '65 ans et plus', 1, '2017-09-01 12:43:56', 'ADMIN', NULL, NULL, 10);

--
-- Contenu de la table `ref_type_cdd`
--

INSERT INTO `ref_type_cdd` (`CD_TYPECDD`, `LB_TYPECDD`, `BL_VALI`, `CD_UTILCREA`, `created_at`, `CD_UTILMODI`, `updated_at`, `ID_TYPECDD`) VALUES
('CDD001', 'Article 3-1', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 1),
('CDD002', 'Article 3-2', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 2),
('CDD003', 'Article 3-3, 1°', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 3),
('CDD004', 'Article 3-3, 2°', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 4),
('CDD005', 'Article 3-3, 3°', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 5),
('CDD006', 'Article 3-3, 4°', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 6),
('CDD007', 'Article 3-3, 5°', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 7),
('CDD008', 'Autres contractuels (articles 38, 38bis, 47,136...)', 1, 'ADMIN', '2017-09-01 12:45:11', NULL, NULL, 8);

--
-- Contenu de la table `ref_type_collectivite`
--

INSERT INTO `ref_type_collectivite` (`CD_TYPECOLL`, `LB_TYPE_COLL`, `BL_VALI`, `CD_UTILCREA`, `created_at`, `CD_UTILMODI`, `updated_at`, `ID_TYPE_COLL`) VALUES
('CCN', 'Commune et commune nouvelle', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 1),
('CCAS', 'CCAS', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 2),
('CD', 'Caisse des écoles', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 3),
('CDM', 'Caisse de crédit municipal', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 4),
('CIAS', 'Centre Intercommunal d\'action sociale (CIAS)', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 5),
('SIVOM', 'SIVOM', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 6),
('SIVU', 'SIVU', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 7),
('SM', 'Syndicat mixte', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 8),
('CCO', 'Communauté de communes', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 9),
('CAG', 'Communauté d\'agglomération', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 10),
('CUR', 'Communauté urbaine', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 11),
('MET', 'Métropole', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 12),
('PM', 'Pôle métropolitain', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 13),
('PETR', 'Pôle d\'équilibre territorial et rural (PETR)', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 14),
('DEP', 'Département', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 15),
('REG', 'Région', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 16),
('SDIS', 'SDIS', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 17),
('CDG', 'CDG', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 18),
('OPH', 'OPHLM - OPAC', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 19),
('AEPC', 'Autre établissement public communal*', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 20),
('GIP', 'GIP', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 21),
('AEPI', 'Autre établissement public intercommunal', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 22),
('CTOM', 'Collectivité et territoire d\'Outre-Mer', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 23),
('ACT', '(Autre) Collectivité territoriale **', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 24),
('CNFPT', 'CNFPT', 1, 'ADMIN', '2017-09-01 12:45:03', NULL, NULL, 25);

--
-- Contenu de la table `ref_type_mission_prevention`
--

INSERT INTO `ref_type_mission_prevention` (`ID_TYPE_COLL`, `CD_TYPEMISSPREV`, `LB_TYPEMISSPREV`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_TYPEMISSPREV`) VALUES
(NULL, 'MP001', 'Assistants* de prévention (ex-agents chargés de la mise en œuvre des actions de prévention dans la collectivité)', 1, '2017-09-01 12:46:46', 'ADMIN', NULL, NULL, 1),
(NULL, 'MP002', 'Conseillers** de prévention (ex-agents chargés de la mise en œuvre des actions de prévention dans la collectivité)', 1, '2017-09-01 12:46:46', 'ADMIN', NULL, NULL, 2),
(NULL, 'MP003', 'Agents chargés des fonctions d\'inspection en hygiène et sécurité dans la collectivité (ACFI) ***', 1, '2017-09-01 12:46:46', 'ADMIN', NULL, NULL, 3),
(NULL, 'MP004', 'Médecins de prévention', 1, '2017-09-01 12:46:46', 'ADMIN', NULL, NULL, 4),
(NULL, 'MP005', 'Autres personnels affectés à la prévention (animateurs, formateurs prévention, personnes en charge de la prévention …)', 1, '2017-09-01 12:46:46', 'ADMIN', NULL, NULL, 5);

--
-- Contenu de la table `ref_validation_experience`
--

INSERT INTO `ref_validation_experience` (`CD_EBCF`, `LB_EBCF`, `BL_VALI`, `created_at`, `CD_UTILCREA`, `updated_at`, `CD_UTILMODI`, `ID_EBCF`) VALUES
('VAE001', 'Dossiers déposés durant l\'année', 1, '2017-09-01 12:44:55', 'ADMIN', NULL, NULL, 1),
('VAE002', 'Dossiers en cours', 1, '2017-09-01 12:44:55', 'ADMIN', NULL, NULL, 2),
('VAE003', 'Dossiers ayant débouchés dans l\'année sur une validation', 1, '2017-09-01 12:44:55', 'ADMIN', NULL, NULL, 3);

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_COLL`, `USERNAME`, `PASSWORD`, `LB_PASS_TEMP`, `FG_TYPEUTIL`, `IS_ACTIVE`, `roles`, `change_request`, `can_valid_user_account`, `can_view`, `can_edit`, `cdg_is_authorized_by_collectivity`, `email`, `postal_code`, `department`, `DT_LASTCONN`, `NM_ERRECONN`, `BL_COMPTEMP`, `CD_UTILCREA`, `created_at`, `CD_UTILMODI`, `updated_at`, `ID_UTIL`, `confirm_code`) VALUES
(NULL, 'ciggc', '$2y$13$3REBCZG9QYNREv0qpX7wI.ZzG.6IPknD1Mv/rVABHU9Tik1ccefk.', NULL, NULL, 1, 'a:1:{i:0;s:8:"ROLE_CDG";}', 1, NULL, NULL, NULL, NULL, 'roubrerie@iorga.com', NULL, NULL, '2017-10-27 07:49:32', NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 1, '7b2e2f24f6fdcf61bb2c0c8018ab2c95'),
(NULL, 'cdg17', '$2y$13$9gioaLOtW9LNYl9cXd2E/OWFKeL8f5puq3W76uod/ynXej.qi3pAq', NULL, NULL, 1, 'a:1:{i:0;s:8:"ROLE_CDG";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 2, NULL),
(NULL, 'cdg29', '$2y$13$9gioaLOtW9LNYl9cXd2E/OWFKeL8f5puq3W76uod/ynXej.qi3pAq', NULL, NULL, 1, 'a:1:{i:0;s:8:"ROLE_CDG";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 3, NULL),
(1, '21780003600014', '$2y$13$g0bpQRmfDGNKT5L2ALiP1uQN.B0Pi2/dadsrzeDCSHqBTT4H20WlW', '8bXUZ(96', NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', 1, NULL, NULL, NULL, 1, 'test@test.fr', NULL, NULL, '2017-10-25 14:42:35', NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 4, NULL),
(2, '21780646200016', '$2y$13$kRr5QfCk0eycoq8i60I.NeDYoEHNOEuL/fLx91wOjlv./pRwxdTBq', NULL, NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-02 15:03:35', NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 5, NULL),
(3, '28780054400010', '$2y$13$5bpwK4it5lh40geVzrMg1uk7542CbTO84FXRyTBOKwTSTi22ustuG', NULL, NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 6, NULL),
(4, '20004176200010', '$2y$13$sgPJCnNxBvzVzFhRyc3v4etxYKstNBJnplzFtmK0IZhfEno8W7EP2', '', NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 7, NULL),
(5, '21290039300019', '$2y$13$sgPJCnNxBvzVzFhRyc3v4etxYKstNBJnplzFtmK0IZhfEno8W7EP2', NULL, NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 8, NULL),
(NULL, 'admin', '$2y$13$EOHHsO4FdUeXuCFKHNrPheMSJvoxyx8WQ13iQNqQmhW6KZzTSY2ta', NULL, NULL, 1, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-27 07:26:33', NULL, NULL, 'ADMIN', '2017-09-01 14:22:07', NULL, NULL, 9, NULL),
(12, '21780646200752', '$2y$13$olp0LEtalF.H1Y3AF4QY5eSGB2UprZRb.SdM7F0xMhhE0PpBUgiaO', NULL, NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2017-10-17 13:03:25', NULL, NULL, 11, NULL),
(22, '21780646200038', '$2y$13$NQojimXKogEN7eQESYGgyOoDDdwRUkd7d8bmUPCrJvfMqdZI2JByi', 'T2f92EM-', NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2017-10-18 10:39:42', NULL, NULL, 18, NULL),
(24, '20145369878550', '$2y$13$5xugYEdbOIFf45lCL3OwZOsItiUjmvwcpkEoQM3JfiR1HHaQnq.Hq', '*62J89eX', NULL, 1, 'a:1:{i:0;s:17:"ROLE_COLLECTIVITY";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2017-10-23 08:02:22', NULL, NULL, 19, NULL);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
