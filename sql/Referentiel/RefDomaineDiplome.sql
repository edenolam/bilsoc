SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Structure de la table `ref_domaine_diplome`
--

CREATE TABLE IF NOT EXISTS `ref_domaine_diplome` (
  `ID_DOMAINE_DIPLOME` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `CD_DOMAINE_DIPLOME` varchar(20) DEFAULT NULL,
  `LB_DOMAINE_DIPLOME` varchar(255) NOT NULL,
  `BL_VALIDE` tinyint(1) NOT NULL DEFAULT '1',
  `cd_utilcrea` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `CD_UTILMODI` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`ID_DOMAINE_DIPLOME`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Domaines de diplôme' AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ref_domaine_diplome`
--

INSERT INTO ref_domaine_diplome(CD_DOMAINE_DIPLOME, LB_DOMAINE_DIPLOME, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES('Niveau VI', 'BEPC, brevet élémentaire, brevet des collèges, DNB ;', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_diplome(CD_DOMAINE_DIPLOME, LB_DOMAINE_DIPLOME, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES('Niveau V', 'CAP, BEP ou diplôme de niveau équivalent ;', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_diplome(CD_DOMAINE_DIPLOME, LB_DOMAINE_DIPLOME, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES('Niveau IV', 'baccalauréat, brevet professionnel dont (baccalauréat général ou technologique, brevet supérieur, capacité en droit, DAEU, ESEU / baccalauréat professionnel, brevet professionnel, de technicien ou d’enseignement, diplôme équivalent)', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_diplome(CD_DOMAINE_DIPLOME, LB_DOMAINE_DIPLOME, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES('Niveau III', 'BTS, DUT, Deug, Deust, diplôme de la santé ou du social de niveau bac+2, diplôme équivalent ;', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_diplome(CD_DOMAINE_DIPLOME, LB_DOMAINE_DIPLOME, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES('Niveau II', 'licence, licence professionnelle, maîtrise, diplôme équivalent de niveau bac+3 ou bac+4 ;', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_diplome(CD_DOMAINE_DIPLOME, LB_DOMAINE_DIPLOME, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES('Niveau I', 'Master, DEA, DESS, diplôme de grande école de niveau bac+5, doctorat de santé ;', 0, 'ADMIN', now(), 'ADMIN', now());
INSERT INTO ref_domaine_diplome(CD_DOMAINE_DIPLOME, LB_DOMAINE_DIPLOME, BL_VALIDE, CD_UTILCREA, created_at, CD_UTILMODI, updated_at) VALUES('Niveau I', 'Doctorat de recherche (hors santé)', 0, 'ADMIN', now(), 'ADMIN', now());