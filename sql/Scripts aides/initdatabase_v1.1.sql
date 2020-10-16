/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  05/07/2017 14:47:30                      */
/*==============================================================*/


drop table if exists ABSENCE_ARRET_AGENT;

drop table if exists ACTE_VIOLENCE_PHYSIQUE;

drop table if exists ACTION_PREVENTION;

drop table if exists ACTUALITE;

drop table if exists AGENT_AFFECTE_PREVENTION;

drop table if exists BILAN_SOCIAL_AGENT;

drop table if exists BILAN_SOCIAL_CONSOLIDE;

drop table if exists CAMPAGNE;

drop table if exists CDG;

drop table if exists COLLECTIVITE;

drop table if exists CONFILT_TRAVAIL;

drop table if exists DEPARTEMENT;

drop table if exists DROITS;

drop table if exists ENQUETE;

drop table if exists ENQUETE_COLLECTIVITE;

drop table if exists ETPR_114_ANNEE_PRECEDENTE;

drop table if exists ETPR_124_ANNEE_PRECEDENTE;

drop table if exists ETPR_131_ANNEE_PRECEDENTE;

drop table if exists FORMATION_AGENT;

drop table if exists HISTORIQUE_COLLECTIVITE;

drop table if exists HISTORIQUE_CONNEXION;

drop table if exists HISTORIQUE_ECHANGE;

drop table if exists IMPORT;

drop table if exists IND_110_1;

drop table if exists IND_110_2;

drop table if exists IND_110_3;

drop table if exists IND_111;

drop table if exists IND_112;

drop table if exists IND_113;

drop table if exists IND_114;

drop table if exists IND_121;

drop table if exists IND_122;

drop table if exists IND_123;

drop table if exists IND_124;

drop table if exists IND_131_1;

drop table if exists IND_131_2;

drop table if exists IND_132;

drop table if exists IND_141;

drop table if exists IND_142;

drop table if exists IND_143;

drop table if exists IND_144;

drop table if exists IND_150_1;

drop table if exists IND_150_2;

drop table if exists IND_151_1;

drop table if exists IND_151_2;

drop table if exists IND_151_3;

drop table if exists IND_152;

drop table if exists IND_153_1;

drop table if exists IND_153_2;

drop table if exists IND_154;

drop table if exists IND_155;

drop table if exists IND_156;

drop table if exists IND_158;

drop table if exists IND_161;

drop table if exists IND_171;

drop table if exists IND_211_1;

drop table if exists IND_211_2;

drop table if exists IND_211_3;

drop table if exists IND_212_1;

drop table if exists IND_212_2;

drop table if exists IND_212_3;

drop table if exists IND_214;

drop table if exists IND_215;

drop table if exists IND_221;

drop table if exists IND_222;

drop table if exists IND_223_1;

drop table if exists IND_223_2;

drop table if exists IND_223_3;

drop table if exists IND_224;

drop table if exists IND_231;

drop table if exists IND_311;

drop table if exists IND_321;

drop table if exists IND_331;

drop table if exists IND_343;

drop table if exists IND_511;

drop table if exists IND_512;

drop table if exists IND_521;

drop table if exists IND_522;

drop table if exists IND_523;

drop table if exists IND_531;

drop table if exists IND_611_1;

drop table if exists IND_611_2;

drop table if exists IND_612_1;

drop table if exists IND_612_2;

drop table if exists IND_613;

drop table if exists IND_712;

drop table if exists IND_713;

drop table if exists IND_814_1;

drop table if exists IND_814_2;

drop table if exists IND_RAST_AT;

drop table if exists IND_RAST_MP;

drop table if exists INFORMATION_COLECTIVITE_AGENT;

drop table if exists INFORMATION_GENERALE;

drop table if exists MODELE_MAIL;

drop table if exists MODE_SAISIE_ENQUETE;

drop table if exists MODULE_ENQUETE;

drop table if exists PREVOYANCE;

drop table if exists PROFIL;

drop table if exists QUESTION_COLLECTIVITE_CONSOLIDE;

drop table if exists REF_ACTE_VIOLENCE_PHYSIQUE;

drop table if exists REF_AVANCEMENT_PROMOTION_CONCOURS;

drop table if exists REF_CADRE_EMPLOI;

drop table if exists REF_CATEGORIE;

drop table if exists REF_CONTRAINTE_TRAVAIL;

drop table if exists REF_CYCLE_TRAVAIL;

drop table if exists REF_EMPLOI_FONCTIONNEL;

drop table if exists REF_EMPLOI_NON_PERMANENT;

drop table if exists REF_FILIERE;

drop table if exists REF_FONCTION_PUBLIQUE;

drop table if exists REF_FORMATION;

drop table if exists REF_GRADE;

drop table if exists REF_INAPTITUDE;

drop table if exists REF_MOTIF_ABSENCE;

drop table if exists REF_MOTIF_ARRIVEE;

drop table if exists REF_MOTIF_DEPART;

drop table if exists REF_MOTIF_ENTRETIEN;

drop table if exists REF_MOTIF_GREVE;

drop table if exists REF_ORGANISME_FORMATION;

drop table if exists REF_POSITION_STATUTAIRE;

drop table if exists REF_POURCENTAGE_TEMPA_PARTIEL;

drop table if exists REF_STAGE_TITULARISATION;

drop table if exists REF_STATUT;

drop table if exists REF_STRUCTURE_ORIGINE;

drop table if exists REF_TEMPS_NON_COMPLET;

drop table if exists REF_TEMPS_PARTIEL;

drop table if exists REF_TRANCHE_AGE;

drop table if exists REF_TYPE_COLLECTIVITE;

drop table if exists REF_TYPE_MISSION_PREVENTION;

drop table if exists REF_VALIDATION_EXPERIENCE;

drop table if exists SANTE;

drop table if exists TYPE_IMPORT;

drop table if exists UTILISATEUR;

drop table if exists UTILISATEUR_DROITS;

/*==============================================================*/
/* Table : ABSENCE_ARRET_AGENT                                  */
/*==============================================================*/
create table ABSENCE_ARRET_AGENT
(
   ID_ABSEARREAGEN      int not null auto_increment,
   ID_BILASOCIAGEN      int,
   ID_MOTIABSE          int,
   NB_JOURABSE          float(4,1),
   NB_ACCIAVECARRE      int,
   NB_ACCISANSARRE      int,
   NB_ARRE              int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_ABSEARREAGEN)
);

/*==============================================================*/
/* Table : ACTE_VIOLENCE_PHYSIQUE                               */
/*==============================================================*/
create table ACTE_VIOLENCE_PHYSIQUE
(
   ID_VIOLPHSY          int not null auto_increment,
   ID_INFOCOLLAGEN      int,
   ID_ACTEVIOLPHYS      int,
   R_5311               int,
   R_5312               int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_VIOLPHSY)
);

/*==============================================================*/
/* Table : ACTION_PREVENTION                                    */
/*==============================================================*/
create table ACTION_PREVENTION
(
   ID_ACTIPREV          int not null auto_increment,
   ID_INFOCOLLAGEN      int,
   ID_FORM              int,
   R_5121               decimal(10,2),
   R_5122               int,
   R_5123               int,
   R_5124               decimal(10,2),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_ACTIPREV)
);

/*==============================================================*/
/* Table : ACTUALITE                                            */
/*==============================================================*/
create table ACTUALITE
(
   ID_ACTU              int not null auto_increment,
   LB_ACTU              text,
   LB_LIENACTU          varchar(255),
   LB_IMAG              varchar(150),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_ACTU)
);

/*==============================================================*/
/* Table : AGENT_AFFECTE_PREVENTION                             */
/*==============================================================*/
create table AGENT_AFFECTE_PREVENTION
(
   ID_AGENAFFEPREV      int not null auto_increment,
   ID_INFOCOLLAGEN      int,
   ID_TYPEMISSPREV      int,
   R_5111               int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_AGENAFFEPREV)
);

/*==============================================================*/
/* Table : BILAN_SOCIAL_AGENT                                   */
/*==============================================================*/
create table BILAN_SOCIAL_AGENT
(
   ID_BILASOCIAGEN      int not null auto_increment,
   ID_COLL              int,
   ID_ENQU              int,
   LB_NOM               varchar(100) comment 'Q0',
   LB_PREN              varchar(100) comment 'Q0',
   LB_DATENAIS          varchar(6) comment 'Q0 - Mois et année de naissance',
   CD_SEXE              varchar(1) comment 'Q1',
   BL_BOETH             bool comment 'Q19',
   BL_AGENREMU3112      bool comment 'Q4.1',
   BL_AGENREMUANNE      bool comment 'Q4.2',
   ID_POSISTAT          int comment 'Q2.7',
   ID_STAT              int comment 'Q2',
   BL_AGENARRIANNECOLL  bool comment 'Q5.1',
   BL_EMPLFONC          bool comment 'Q8.1',
   ID_GRADDETA          int comment 'R8.1.A',
   ID_FONCPUBL          int comment 'Q8.2',
   ID_CADREMPLDETA      int comment 'Q9.2.1',
   ID_EMPLFONC          int comment 'Q8.3',
   DT_DETAEMPLFONC      datetime comment 'Q8.4',
   ID_STRUORIGPOSISTAT  int comment 'Si sélectionne d''une position particulière alors choix Agent originaire de la collectivité ou Agent originaire d''une autre structure
            R2.7.B.B',
   ID_CATE              int comment 'Q3',
   ID_FILI              int comment 'Q3',
   ID_CADREMPL          int comment 'Q3',
   ID_GRAD              int comment 'Q3',
   ID_MOTIARRI          int comment 'Q5.4',
   BL_ACQUSTATANNE      bool comment 'Q2.0',
   BL_AGENTITUSTAGANNE  bool comment 'Q17',
   ID_STAGTITU          int comment 'Q17.1',
   BL_TITULOISAUVAANNE  bool comment 'Q2.0.1 - Question affiché si le motif de titulatisation ou de mise en stage est Loi Sauvadet',
   BL_RECRSANSCONCSELEPROF bool comment 'Q2.0.2 - Dépend de la question Q2.0.1 - Réservé sans concours ou sélection professionelle',
   LB_DATEDEPACOLL      varchar(6) comment 'Q5.2 - Mois et année de départ de la collectivité - Si non à la question 4.1',
   ID_MOTIDEPA          int comment 'Q16',
   CD_MOTIDECE          varchar(1) comment 'Q16.1 - Si motif de départ = décès. Choisir si le décès est consécutif à un accident de trajet, deservice ou autre',
   BL_MOUVINTEANNE      bool comment 'Q5.3',
   BL_PROMAVANSTAGANNE  bool comment 'Q18',
   ID_AVANPROMCONC      int comment 'Q18.1 - Si oui à Q18 - Choix multiples possibles',
   BL_TEMPCOMP          bool comment 'Q11.1',
   ID_TEMPNONCOMP       int comment 'Q11.2',
   ID_CONTTRAV          int comment 'Q25',
   BL_TEMPPLEIN         bool comment 'Q12.1',
   ID_TEMPPART          int comment 'Q12.2',
   ID_POURTEMPPART      int comment 'Q12.3',
   NB_DEMAPART          int comment 'Q28.1',
   NB_DEMAPARTACCE      int comment 'Q28.2',
   NB_PREMDEMASATI      int comment 'Q28.3',
   NB_MODIEMPLPERMTEMPCOMP int comment 'Q28.4',
   NB_AGENEMPLTEMPCOMPNONRENOU int comment 'Q28.5',
   ID_CYCLTRAV          int comment 'Q24 - Affiché si QIC2 est à oui',
   NM_HEURREMUANNE      float(5,2) comment 'Q13',
   MT_REMUANNUBRUT      decimal(10,2) comment 'Q29.1 - Affiché si QIC1 est à oui',
   MT_TOTAREMUPRIMINDEM decimal(10,2) comment 'Q29.2 - Affiché si QIC1 est à oui',
   MT_TOTAREMUBRUTNBI   decimal(10,2) comment 'Q29.3 - Affiché si QIC1 est à oui',
   MT_TOTAREMUBRUTHEURSUPP decimal(10,2) comment 'Q29.4 - Affiché si QIC1 est à oui',
   NB_HEURSUPP          float(5,2) comment 'Q30.1',
   NB_HEURCOMPREALREMU  float(5,2) comment 'Q30.2',
   BL_AGENABSE          bool comment 'Q20.1',
   NB_ALLOTEMPINAC      int comment 'Q20.3',
   NB_ALLOTEMPINVA      int comment 'Q20.4',
   BL_CONGPATEACCUENFA  bool comment 'Q21',
   NB_JOURCONGPATEACCUENFA int comment 'Q21.1 - Affiché si oui à Q21',
   BL_ENTRDEPACONG      bool comment 'Q22',
   ID_MOTIENTRDEPACONG  int comment 'Q22.1 - Affiché si oui à Q22',
   BL_ENTRRETOCONG      bool comment 'Q23',
   ID_MOTIENTRRETOCONG  int comment 'Q23.1 - Affiché si oui à Q23',
   BL_CET               bool comment 'Q26 - Affiché si oui à QIC 6',
   NB_JOURCUMU3112      int comment 'Q26.2 - Affiché si oui à Q26',
   NB_JOURVERS3112      int comment 'Q26.3 - Affiché si oui à Q26',
   NB_JOURDEPE3112      int comment 'Q26.4 - Affiché si oui à Q26',
   NB_JOURINDE3112      int comment 'Q26.5 - Affiché si oui à Q26',
   NB_JOURPRISRAFP3112  int comment 'Q26.6 - Affiché si oui à Q26',
   BL_TELETRAV          bool comment 'Q27 - Affiché si oui à QIC7',
   BL_AGENPREV          bool comment 'Q31.1',
   ID_TYPEMISSPREV      int comment 'Q31.2 - Affiché si oui à Q31.1',
   BL_DEMAINAP          bool comment 'Q32.1',
   ID_INAPDEMA          int comment 'R31.1 - Affiché si oui à Q31.1',
   BL_DECIINAP          bool comment 'Q32.2',
   ID_INAPDECI          int comment 'R32.2 - Affiché si oui à Q32.2',
   BL_FORMSUIV          bool comment 'Q33',
   BL_VAE               bool comment 'Q34.1',
   ID_EBCF              int comment 'Q34.2 - Affiché si oui à Q34.1',
   BL_BILACOMP          bool comment 'Q35.1',
   NB_BILACOMP          int comment 'Q35.2 - Affiché si oui à Q35.1',
   BL_CONGFORM          bool comment 'Q36.1',
   ID_EMPLNONPERM       int comment 'Q2.6',
   ID_STRUORIG          int comment 'Q15.1 - Affiché si R2.6 est Emploi de cabinet',
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_BILASOCIAGEN)
);

/*==============================================================*/
/* Table : BILAN_SOCIAL_CONSOLIDE                               */
/*==============================================================*/
create table BILAN_SOCIAL_CONSOLIDE
(
   ID_BILASOCICONS      int not null auto_increment,
   ID_ENQU              int,
   ID_COLL              int,
   ID_QUESCOLLCONS      int,
   Q_132                int,
   Q_161                int,
   R_16211              decimal(10,2),
   R_16212              decimal(10,2),
   R_16213              decimal(10,2),
   R_16214              decimal(10,2),
   R_16221              int,
   R_16222              decimal(5,2),
   R_16223              decimal(5,2),
   Q_2151               int,
   Q_2152               int,
   Q_224                bool,
   Q_225                int,
   Q_3411               int,
   Q_3412               int,
   Q_3421               int,
   Q_3422               int,
   Q_343                bool,
   R_3441               int,
   R_3442               int,
   R_3443               varchar(10),
   R_4111               int,
   R_4112               int,
   R_513                int,
   Q_514                int,
   R_5141               int,
   R_5142               int,
   Q_515                int,
   Q_5161               int,
   Q_5162               int,
   Q_5163               int,
   Q_517                int,
   Q_531                int,
   R_6141               int,
   R_6142               int,
   R_6143               int,
   R_6144               int,
   R_7111               int,
   R_7112               int,
   R_7113               int,
   Q_7114               int,
   R_7115               int,
   Q_713                int,
   Q_8111               int,
   Q_8112               int,
   Q_812                int,
   Q_8131               int,
   Q_8132               int,
   Q_8133               int,
   Q_S8141              int,
   Q_S8142              int,
   Q_P8143              int,
   Q_P8144              int,
   FG_STAT              varchar(1),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_BILASOCICONS)
);

/*==============================================================*/
/* Table : CAMPAGNE                                             */
/*==============================================================*/
create table CAMPAGNE
(
   ID_CAMP              int not null auto_increment,
   LB_CAMP              varchar(255),
   NM_ANNE              int,
   DT_DEBU              datetime,
   DT_CLOT              datetime,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_CAMP)
);

/*==============================================================*/
/* Table : CDG                                                  */
/*==============================================================*/
create table CDG
(
   ID_CDG               int not null auto_increment,
   LB_CDG               varchar(150),
   LB_NOM               varchar(150),
   LB_PREN              varchar(150),
   LB_TELE              varchar(20),
   LB_PORT              varchar(20),
   LB_FONC              varchar(200),
   BL_AFFIESPAANAL      bool,
   LB_MAIL              varchar(255),
   CD_UTILCREA          varchar(50),
   DT_CREA              datetime,
   CD_UTILMODI          varchar(50),
   DT_MODI              datetime,
   primary key (ID_CDG)
);

/*==============================================================*/
/* Table : COLLECTIVITE                                         */
/*==============================================================*/
create table COLLECTIVITE
(
   ID_COLL              int not null auto_increment,
   ID_TYPE_COLL         int,
   ID_CATE_JURI         int,
   ID_CDG               int,
   ID_DEPA              int,
   LB_COLL              varchar(150) not null,
   LB_ADRE              varchar(255),
   CD_POST              varchar(10),
   LB_VILL              varchar(100),
   CD_INSE              varchar(20),
   NM_SIRE              varchar(14) not null,
   LB_TELE              varchar(20),
   LB_MAIL              varchar(255),
   NM_POPU_INSE         int,
   LB_CONT_COLL         varchar(100),
   BL_TRAN_BS           bool,
   BL_SURCLAS_DEMO      bool,
   NM_SURCLAS_DEMO      int,
   NM_STRAT_COLL        int,
   BL_CDG_COLL          bool,
   LB_CONT_CDG          varchar(100),
   BL_AFFI_COLL         bool,
   BL_CT_CDG            bool,
   BL_COLL_DGCL         bool,
   LB_ZONE_EMPL_COLL    varchar(150),
   NM_LOGE_OPHLM_ODHLM  int,
   BL_ACTI              bool,
   BL_DISS              bool,
   DT_DISS              datetime,
   BL_FUSI              bool,
   BL_FIRSCONN          bool,
   DT_FUSI              datetime,
   BL_ABSO              bool,
   DT_ABSO              datetime,
   CD_UTILCREA          varchar(50),
   DT_CREA              datetime,
   CD_UTILMODI          varchar(50),
   DT_MODI              datetime,
   primary key (ID_COLL)
);

/*==============================================================*/
/* Table : CONFILT_TRAVAIL                                      */
/*==============================================================*/
create table CONFILT_TRAVAIL
(
   ID_CONFTRAV          int not null auto_increment,
   ID_MOTIGREV          int,
   R_7131               int,
   R_7132               int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_CONFTRAV)
);

/*==============================================================*/
/* Table : DEPARTEMENT                                          */
/*==============================================================*/
create table DEPARTEMENT
(
   ID_DEPA              int not null auto_increment,
   CD_DEPA              varchar(20),
   LB_DEPA              varchar(150),
   CD_UTILCREA          varchar(50),
   DT_CREA              datetime,
   CD_UTILMODI          varchar(50),
   DT_MODI              datetime,
   primary key (ID_DEPA)
);

/*==============================================================*/
/* Table : DROITS                                               */
/*==============================================================*/
create table DROITS
(
   ID_DROI              int not null auto_increment,
   CD_DROI              varchar(20) not null,
   LB_DROI              varchar(50) not null,
   primary key (ID_DROI)
);

/*==============================================================*/
/* Table : ENQUETE                                              */
/*==============================================================*/
create table ENQUETE
(
   ID_ENQU              int not null,
   ID_CDG               int not null,
   ID_CAMP              int,
   LB_ENQU              varchar(255) not null,
   CM_DESC              text,
   NM_ANNE              int not null,
   FG_STAT              varchar(1) not null,
   DT_DEBU              datetime,
   DT_CLOT              datetime,
   BL_RELA              bool,
   DT_RELA              datetime,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_ENQU)
);

/*==============================================================*/
/* Table : ENQUETE_COLLECTIVITE                                 */
/*==============================================================*/
create table ENQUETE_COLLECTIVITE
(
   ID_ENQUCOLL          int not null auto_increment,
   ID_ENQU              int,
   ID_COLL              int,
   ID_TYPEIMPO          int,
   ID_MODECAMP          int,
   ID_MODU              int,
   BL_BILASOCIVIDE      bool,
   primary key (ID_ENQUCOLL)
);

/*==============================================================*/
/* Table : ETPR_114_ANNEE_PRECEDENTE                            */
/*==============================================================*/
create table ETPR_114_ANNEE_PRECEDENTE
(
   ID_ETPR114           int not null auto_increment,
   ID_INFOCOLLAGEN      int,
   ID_FILI              int,
   R_1141               int,
   R_1142               int,
   R_1143               int,
   R_1144               int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_ETPR114)
);

/*==============================================================*/
/* Table : ETPR_124_ANNEE_PRECEDENTE                            */
/*==============================================================*/
create table ETPR_124_ANNEE_PRECEDENTE
(
   ID_124               int not null auto_increment,
   ID_INFOCOLLAGEN      int,
   ID_FILI              int,
   R_1241               int,
   R_1242               int,
   R_1243               int,
   R_1244               int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_124)
);

/*==============================================================*/
/* Table : ETPR_131_ANNEE_PRECEDENTE                            */
/*==============================================================*/
create table ETPR_131_ANNEE_PRECEDENTE
(
   ID_1312              int not null auto_increment,
   ID_EMPLNONPERM       int,
   ID_INFOCOLLAGEN      int,
   R_13121              int,
   R_13122              int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1312)
);

/*==============================================================*/
/* Table : FORMATION_AGENT                                      */
/*==============================================================*/
create table FORMATION_AGENT
(
   ID_FORMAGEN          int not null auto_increment,
   ID_ORGAFORM          int,
   ID_FORM              int,
   ID_BILASOCIAGEN      int,
   NB_FORM              int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_FORMAGEN)
);

/*==============================================================*/
/* Table : HISTORIQUE_COLLECTIVITE                              */
/*==============================================================*/
create table HISTORIQUE_COLLECTIVITE
(
   ID_HISTCOLL          int not null auto_increment,
   ID_COLL              int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(20),
   primary key (ID_HISTCOLL)
);

/*==============================================================*/
/* Table : HISTORIQUE_CONNEXION                                 */
/*==============================================================*/
create table HISTORIQUE_CONNEXION
(
   ID_HIST_CONN         int not null auto_increment,
   CD_UTIL              varchar(20),
   DT_CONN              datetime,
   primary key (ID_HIST_CONN)
);

/*==============================================================*/
/* Table : HISTORIQUE_ECHANGE                                   */
/*==============================================================*/
create table HISTORIQUE_ECHANGE
(
   ID_HISTECHA          int not null auto_increment,
   ID_CDG               int,
   ID_COLL              int,
   LB_NOMHISTECHA       varchar(255),
   FG_TYPEECHA          varchar(1),
   CM_HISTECHA          text,
   DT_HISTECHA          datetime,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_HISTECHA)
);

/*==============================================================*/
/* Table : IMPORT                                               */
/*==============================================================*/
create table IMPORT
(
   ID_IMPO              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_BILASOCIAGEN      int,
   FG_TYPEIMPO          varchar(1),
   LB_NOMFICH           varchar(255),
   DT_IMPO              datetime,
   BL_ERRE              bool,
   BL_IMPO              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_IMPO)
);

/*==============================================================*/
/* Table : IND_110_1                                            */
/*==============================================================*/
create table IND_110_1
(
   ID_1101              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLFONC          int,
   R_1101               int,
   R_1102               int,
   R_1103               int,
   R_1104               int,
   R_1105               int,
   R_1106               int,
   R_1107               int,
   R_1108               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1101)
);

/*==============================================================*/
/* Table : IND_110_2                                            */
/*==============================================================*/
create table IND_110_2
(
   ID_1102              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLFONC          int,
   R_1101               int,
   R_1102               int,
   R_1103               int,
   R_1104               int,
   R_1105               int,
   R_1106               int,
   R_1107               int,
   R_1108               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1102)
);

/*==============================================================*/
/* Table : IND_110_3                                            */
/*==============================================================*/
create table IND_110_3
(
   ID_1103              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLFONC          int,
   R_1101               int,
   R_1102               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1103)
);

/*==============================================================*/
/* Table : IND_111                                              */
/*==============================================================*/
create table IND_111
(
   ID_111               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_GRAD              int,
   R_1111               int,
   R_1112               int,
   R_1113               int,
   R_1114               int,
   R_1115               int,
   R_1116               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_111)
);

/*==============================================================*/
/* Table : IND_112                                              */
/*==============================================================*/
create table IND_112
(
   ID_112               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_GRAD              int,
   R_1121               int,
   R_1122               int,
   R_1123               int,
   R_1124               int,
   R_1125               int,
   R_1126               int,
   R_1127               int,
   R_1128               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_112)
);

/*==============================================================*/
/* Table : IND_113                                              */
/*==============================================================*/
create table IND_113
(
   ID_113               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CATE              int,
   FG_GENR              varchar(1),
   R_1131               int,
   R_1132               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_113)
);

/*==============================================================*/
/* Table : IND_114                                              */
/*==============================================================*/
create table IND_114
(
   ID_114               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_FILI              int,
   R_1141               int,
   R_1142               int,
   R_1143               char(10),
   R_1144               char(10),
   R_1145               char(10),
   R_1146               char(10),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_114)
);

/*==============================================================*/
/* Table : IND_121                                              */
/*==============================================================*/
create table IND_121
(
   ID_121               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CADREMPL          int,
   R_1211               int,
   R_1212               int,
   R_1213               int,
   R_1214               int,
   R_1215               int,
   R_1216               int,
   R_1217               int,
   R_1218               int,
   R_1219               int,
   R_12110              int,
   R_12111              int,
   R_12112              int,
   R_12113              int,
   R_12114              int,
   R_12115              int,
   R_12116              int,
   R_12117              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_121)
);

/*==============================================================*/
/* Table : IND_122                                              */
/*==============================================================*/
create table IND_122
(
   ID_122               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CADREMPL          int not null,
   R_1221               int,
   R_1222               int,
   R_1223               int,
   R_1224               int,
   R_1225               int,
   R_1226               int,
   R_1227               int,
   R_1228               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_122)
);

/*==============================================================*/
/* Table : IND_123                                              */
/*==============================================================*/
create table IND_123
(
   ID_123               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CATE              int,
   FG_GENR              varchar(1),
   R_1231               int,
   R_1232               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_123)
);

/*==============================================================*/
/* Table : IND_124                                              */
/*==============================================================*/
create table IND_124
(
   ID_124               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_FILI              int,
   R_1241               int,
   R_1242               int,
   R_1243               int,
   R_1244               int,
   R_1245               int,
   R_1246               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_124)
);

/*==============================================================*/
/* Table : IND_131_1                                            */
/*==============================================================*/
create table IND_131_1
(
   ID_1311              int not null auto_increment,
   ID_EMPLNONPERM       int,
   ID_BILASOCICONS      int,
   R_13111              int,
   R_13112              int,
   R_13113              int,
   R_13114              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1311)
);

/*==============================================================*/
/* Table : IND_131_2                                            */
/*==============================================================*/
create table IND_131_2
(
   ID_1312              int not null auto_increment,
   ID_EMPLNONPERM       int,
   ID_BILASOCICONS      int,
   R_13121              int,
   R_13122              int,
   R_13123              int,
   R_13124              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1312)
);

/*==============================================================*/
/* Table : IND_132                                              */
/*==============================================================*/
create table IND_132
(
   ID_132               int not null auto_increment,
   ID_BILASOCICONS      int,
   R_1321_1             int,
   R_1322_1             int,
   R_1321_2             int,
   R_1322_2             int,
   FG_STAT              varchar(1),
   DT_CREA              int,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_132)
);

/*==============================================================*/
/* Table : IND_141                                              */
/*==============================================================*/
create table IND_141
(
   ID_141               int not null auto_increment,
   ID_POSISTAT          int,
   ID_BILASOCICONS      int,
   R_1411               int,
   R_1412               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_141)
);

/*==============================================================*/
/* Table : IND_142                                              */
/*==============================================================*/
create table IND_142
(
   ID_142               int not null auto_increment,
   ID_POSISTAT          int,
   ID_BILASOCICONS      int,
   R_1421               int,
   R_1422               int,
   R_1423               int,
   R_1424               int,
   R_1425               int,
   R_1426               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_142)
);

/*==============================================================*/
/* Table : IND_143                                              */
/*==============================================================*/
create table IND_143
(
   ID_143               int not null auto_increment,
   ID_POSISTAT          int,
   ID_BILASOCICONS      int,
   R_1431               int,
   R_1432               int,
   R_1433               int,
   R_1434               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_143)
);

/*==============================================================*/
/* Table : IND_144                                              */
/*==============================================================*/
create table IND_144
(
   ID_144               int not null auto_increment,
   ID_POSISTAT          int,
   ID_BILASOCICONS      int,
   R_1441               char(10),
   R_1442               char(10),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_144)
);

/*==============================================================*/
/* Table : IND_150_1                                            */
/*==============================================================*/
create table IND_150_1
(
   ID_1501              int not null,
   ID_MOTIDEPA          int,
   ID_BILASOCICONS      int,
   R_15011              int,
   R_15012              int,
   R_15013              int,
   R_15014              int,
   R_15015              int,
   R_15016              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1501)
);

/*==============================================================*/
/* Table : IND_150_2                                            */
/*==============================================================*/
create table IND_150_2
(
   ID_1502              int not null,
   ID_MOTIDEPA          int,
   ID_BILASOCICONS      int,
   R_15021              int,
   R_15022              int,
   R_15023              int,
   R_15024              int,
   R_15025              int,
   R_15026              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1502)
);

/*==============================================================*/
/* Table : IND_151_1                                            */
/*==============================================================*/
create table IND_151_1
(
   ID_1511              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLFONC          int,
   R_15111              int,
   R_15112              int,
   R_15113              int,
   R_15114              int,
   R_15115              int,
   R_15116              int,
   R_15117              int,
   R_15118              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1511)
);

/*==============================================================*/
/* Table : IND_151_2                                            */
/*==============================================================*/
create table IND_151_2
(
   ID_1512              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLFONC          int,
   R_15121              int,
   R_15122              int,
   R_15123              int,
   R_15124              int,
   R_15125              int,
   R_15126              int,
   R_15127              int,
   R_15128              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1512)
);

/*==============================================================*/
/* Table : IND_151_3                                            */
/*==============================================================*/
create table IND_151_3
(
   ID_1513              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLFONC          int,
   R_15131              int,
   R_15132              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1513)
);

/*==============================================================*/
/* Table : IND_152                                              */
/*==============================================================*/
create table IND_152
(
   ID_152               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CADREMPL          int,
   R_1521               int,
   R_1522               int,
   R_1523               int,
   R_1524               int,
   R_1525               int,
   R_1526               int,
   R_1527               int,
   R_1528               int,
   R_1529               int,
   R_15210              int,
   R_15211              int,
   R_15212              int,
   R_15213              int,
   R_15214              int,
   R_15215              int,
   R_15216              int,
   R_15217              int,
   R_15218              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_152)
);

/*==============================================================*/
/* Table : IND_153_1                                            */
/*==============================================================*/
create table IND_153_1
(
   ID_1531              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_ARRI              int,
   R_15311              int,
   R_15312              int,
   R_15313              int,
   R_15314              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1531)
);

/*==============================================================*/
/* Table : IND_153_2                                            */
/*==============================================================*/
create table IND_153_2
(
   ID_1532              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CADREMPL          int,
   R_15321              int,
   R_15322              int,
   R_15323              int,
   R_15324              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_1532)
);

/*==============================================================*/
/* Table : IND_154                                              */
/*==============================================================*/
create table IND_154
(
   ID_154               int not null auto_increment,
   ID_STAGTITU          int,
   ID_BILASOCICONS      int,
   R_1541               int,
   R_1542               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_154)
);

/*==============================================================*/
/* Table : IND_155                                              */
/*==============================================================*/
create table IND_155
(
   ID_155               int not null auto_increment,
   ID_AVANPROMCONC      int,
   ID_BILASOCICONS      int,
   R_1551               int,
   R_1552               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_155)
);

/*==============================================================*/
/* Table : IND_156                                              */
/*==============================================================*/
create table IND_156
(
   ID_156               int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_1561               int,
   R_1562               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_156)
);

/*==============================================================*/
/* Table : IND_158                                              */
/*==============================================================*/
create table IND_158
(
   ID_158               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_FILI              int,
   R_1581               int,
   R_1582               int,
   R_1583               int,
   R_1584               int,
   R_1585               int,
   R_1586               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_158)
);

/*==============================================================*/
/* Table : IND_161                                              */
/*==============================================================*/
create table IND_161
(
   ID_161               int not null,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_1611               int,
   R_1612               int,
   R_1613               int,
   R_1614               int,
   R_1615               int,
   R_1616               int,
   R_1617               int,
   R_1618               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_161)
);

/*==============================================================*/
/* Table : IND_171                                              */
/*==============================================================*/
create table IND_171
(
   ID_171               int not null auto_increment,
   ID_TRANAGE           int,
   ID_BILASOCICONS      int,
   R_1711               int,
   R_1712               int,
   R_1713               int,
   FG_GENR              varchar(1),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_171)
);

/*==============================================================*/
/* Table : IND_211_1                                            */
/*==============================================================*/
create table IND_211_1
(
   ID_2111              int not null auto_increment,
   ID_MOTIABSE          int,
   ID_BILASOCICONS      int,
   R_21111              int,
   R_21112              int,
   R_21113              int,
   R_21114              int,
   R_21115              int,
   R_21116              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2111)
);

/*==============================================================*/
/* Table : IND_211_2                                            */
/*==============================================================*/
create table IND_211_2
(
   ID_2112              int not null auto_increment,
   ID_MOTIABSE          int,
   ID_BILASOCICONS      int,
   R_21121              int,
   R_21122              int,
   R_21123              int,
   R_21124              int,
   R_21125              int,
   R_21126              int,
   R_21127              int,
   R_21128              int,
   R_21129              int,
   R_211210             int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2112)
);

/*==============================================================*/
/* Table : IND_211_3                                            */
/*==============================================================*/
create table IND_211_3
(
   ID_2113              int not null auto_increment,
   ID_MOTIABSE          int,
   ID_BILASOCICONS      int,
   R_21131              decimal(5,2),
   R_21132              decimal(5,2),
   R_21133              decimal(5,2),
   R_21134              decimal(5,2),
   R_21135              decimal(5,2),
   R_21136              decimal(5,2),
   R_21137              decimal(5,2),
   R_21138              decimal(5,2),
   R_21139              decimal(5,2),
   R_211310             decimal(5,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2113)
);

/*==============================================================*/
/* Table : IND_212_1                                            */
/*==============================================================*/
create table IND_212_1
(
   ID_2121              int not null auto_increment,
   ID_MOTIABSE          int,
   ID_BILASOCICONS      int,
   R_21211              int,
   R_21212              int,
   R_21113              int,
   R_21214              int,
   R_21215              int,
   R_21216              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2121)
);

/*==============================================================*/
/* Table : IND_212_2                                            */
/*==============================================================*/
create table IND_212_2
(
   ID_2122              int not null auto_increment,
   ID_MOTIABSE          int,
   ID_BILASOCICONS      int,
   R_21221              int,
   R_21222              int,
   R_21223              int,
   R_21224              int,
   R_21225              int,
   R_21226              int,
   R_21227              int,
   R_21228              int,
   R_21229              int,
   R_212210             int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2122)
);

/*==============================================================*/
/* Table : IND_212_3                                            */
/*==============================================================*/
create table IND_212_3
(
   ID_2123              int not null auto_increment,
   ID_MOTIABSE          int,
   ID_BILASOCICONS      int,
   R_21231              decimal(5,2),
   R_21232              decimal(5,2),
   R_21233              decimal(5,2),
   R_21234              decimal(5,2),
   R_21235              decimal(5,2),
   R_21236              decimal(5,2),
   R_21237              decimal(5,2),
   R_21238              decimal(5,2),
   R_21239              decimal(5,2),
   R_212310             decimal(5,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2123)
);

/*==============================================================*/
/* Table : IND_214                                              */
/*==============================================================*/
create table IND_214
(
   ID_214               int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_2141               char(10),
   R_2142               char(10),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_214)
);

/*==============================================================*/
/* Table : IND_215                                              */
/*==============================================================*/
create table IND_215
(
   ID_215               int not null auto_increment,
   ID_MOTIENTR          int,
   ID_BILASOCICONS      int,
   R_21511              int,
   R_21512              int,
   R_21521              int,
   R_21522              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_215)
);

/*==============================================================*/
/* Table : IND_221                                              */
/*==============================================================*/
create table IND_221
(
   ID_221               int not null auto_increment,
   ID_CYCLTRAV          int,
   ID_BILASOCICONS      int,
   R_2211               int,
   R_2212               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_221)
);

/*==============================================================*/
/* Table : IND_222                                              */
/*==============================================================*/
create table IND_222
(
   ID_222               int not null,
   ID_CONTTRAV          int,
   ID_BILASOCICONS      int,
   R_2221               int,
   R_2222               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_222)
);

/*==============================================================*/
/* Table : IND_223_1                                            */
/*==============================================================*/
create table IND_223_1
(
   ID_2231              int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_22311              int,
   R_22312              int,
   R_22313              int,
   R_22314              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2231)
);

/*==============================================================*/
/* Table : IND_223_2                                            */
/*==============================================================*/
create table IND_223_2
(
   ID_2232              int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_22321              int,
   R_22322              int,
   R_22323              int,
   R_22324              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2232)
);

/*==============================================================*/
/* Table : IND_223_3                                            */
/*==============================================================*/
create table IND_223_3
(
   ID_2233              int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_22331              int,
   R_22332              int,
   R_22333              int,
   R_22334              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_2233)
);

/*==============================================================*/
/* Table : IND_224                                              */
/*==============================================================*/
create table IND_224
(
   ID_224               int not null auto_increment,
   ID_BILASOCICONS      int,
   R_2241               int,
   R_2242               int,
   R_2243               int,
   R_2244               int,
   R_2245               int,
   R_2246               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_224)
);

/*==============================================================*/
/* Table : IND_231                                              */
/*==============================================================*/
create table IND_231
(
   ID_231               int not null auto_increment,
   ID_BILASOCICONS      int,
   R_23111              int,
   R_23112              int,
   R_23121              int,
   R_23122              int,
   R_23131              int,
   R_23132              int,
   R_23141              int,
   R_23142              int,
   R_23151              int,
   R_23152              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_231)
);

/*==============================================================*/
/* Table : IND_311                                              */
/*==============================================================*/
create table IND_311
(
   ID_311               int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_3111               decimal(10,2),
   R_3112               decimal(10,2),
   R_3113               decimal(10,2),
   R_3114               decimal(10,2),
   R_3115               decimal(10,2),
   R_3116               decimal(10,2),
   R_3117               decimal(10,2),
   R_3118               decimal(10,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_311)
);

/*==============================================================*/
/* Table : IND_321                                              */
/*==============================================================*/
create table IND_321
(
   ID_321               int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_3211               decimal(10,2),
   R_3212               decimal(10,2),
   R_3213               decimal(10,2),
   R_3214               decimal(10,2),
   R_3215               decimal(10,2),
   R_3216               decimal(10,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_321)
);

/*==============================================================*/
/* Table : IND_331                                              */
/*==============================================================*/
create table IND_331
(
   ID_331               int not null auto_increment,
   ID_EMPLNONPERM       int,
   ID_BILASOCICONS      int,
   R_3311               decimal(10,2),
   R_3312               decimal(10,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_331)
);

/*==============================================================*/
/* Table : IND_343                                              */
/*==============================================================*/
create table IND_343
(
   ID_343               int not null auto_increment,
   ID_FILI              int,
   ID_BILASOCICONS      int,
   R_3431               decimal(5,2),
   R_3432               decimal(5,2),
   R_3433               decimal(5,2),
   R_3434               decimal(5,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_343)
);

/*==============================================================*/
/* Table : IND_511                                              */
/*==============================================================*/
create table IND_511
(
   ID_511               int not null auto_increment,
   ID_TYPEMISSPREV      int,
   ID_BILASOCICONS      int,
   R_5111               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_511)
);

/*==============================================================*/
/* Table : IND_512                                              */
/*==============================================================*/
create table IND_512
(
   ID_512               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_FORM              int,
   R_5121               decimal(10,2),
   R_5122               int,
   R_5123               int,
   R_5124               decimal(10,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_512)
);

/*==============================================================*/
/* Table : IND_521                                              */
/*==============================================================*/
create table IND_521
(
   ID_521               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CADREMPL          int,
   R_5211               int comment 'Nb accidents de travail - Accident de service (Hommes)',
   R_5212               int comment 'Nb accidents de travail - Accident de service (Femmes)',
   R_5213               int comment 'Nb accidents de travail - Accident de trajet (Hommes)',
   R_5214               int comment 'Nb accidents de travail - Accident de trajet (Femmes)',
   R_5215               int comment 'Nb accidents de travail - Maladie professionnelle reconnues (Hommes)',
   R_5216               int comment 'Nb accidents de travail -Maladie professionnelle reconnues (Femmes)',
   R_5217               int comment 'Nb jours arrêts travail - Accident de service (Hommes)',
   R_5218               int comment 'Nb jours arrêts travail - Accident de service (Femmes)',
   R_5219               int comment 'Nb jours arrêts travail - Accident de trajet (Hommes)',
   R_52110              int comment 'Nb jours arrêts travail - Accident de trajet (Femmes)',
   R_52111              int comment 'Nb jours arrêts travail - Maladies pro reconnues (Hommes)',
   R_52112              int comment 'Nb jours arrêts travail - Maladies pro reconnues (Femmes)',
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_521)
);

alter table IND_521 comment 'Accidents du travail* et maladies professionnelles reconnues';

/*==============================================================*/
/* Table : IND_522                                              */
/*==============================================================*/
create table IND_522
(
   ID_522               int not null auto_increment,
   ID_INAP              int,
   ID_BILASOCICONS      int,
   R_5221               int,
   R_5222               int,
   R_5223               int,
   R_5224               int,
   R_5225               int,
   R_5226               int,
   R_5227               int,
   R_5228               int,
   R_5229               int,
   R_52210              int,
   R_52211              int,
   R_52212              int,
   R_52213              int,
   R_52214              int,
   R_52215              int,
   R_52216              int,
   R_52217              int,
   R_52218              int,
   R_52219              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_522)
);

/*==============================================================*/
/* Table : IND_523                                              */
/*==============================================================*/
create table IND_523
(
   ID_523               int not null auto_increment,
   ID_STAT              int,
   ID_BILASOCICONS      int,
   R_5231               int,
   R_5232               int,
   R_5233               int,
   R_5234               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_523)
);

/*==============================================================*/
/* Table : IND_531                                              */
/*==============================================================*/
create table IND_531
(
   ID_531               int not null auto_increment,
   ID_ACTEVIOLPHYS      int,
   ID_BILASOCICONS      int,
   R_5311               int,
   R_5312               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_531)
);

/*==============================================================*/
/* Table : IND_611_1                                            */
/*==============================================================*/
create table IND_611_1
(
   ID_6111              int not null,
   ID_FORM              int,
   ID_BILASOCICONS      int,
   ID_CATE              int,
   R_61111              decimal(5,2),
   R_61112              decimal(5,2),
   R_61113              decimal(5,2),
   R_61114              decimal(5,2),
   R_61115              decimal(5,2),
   R_61116              decimal(5,2),
   R_61117              decimal(5,2),
   R_61118              decimal(5,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_6111)
);

/*==============================================================*/
/* Table : IND_611_2                                            */
/*==============================================================*/
create table IND_611_2
(
   ID_6112              int not null auto_increment,
   ID_CATE              int,
   ID_BILASOCICONS      int,
   R_61121              int,
   R_61122              int,
   R_61123              int,
   R_61124              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_6112)
);

/*==============================================================*/
/* Table : IND_612_1                                            */
/*==============================================================*/
create table IND_612_1
(
   ID_6121              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLNONPERM       int,
   R_61211              decimal(5,2),
   R_61212              decimal(5,2),
   R_61213              decimal(5,2),
   R_61214              decimal(5,2),
   R_61215              decimal(5,2),
   R_61216              int,
   R_61217              int,
   R_61218              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_6121)
);

/*==============================================================*/
/* Table : IND_612_2                                            */
/*==============================================================*/
create table IND_612_2
(
   ID_6122              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EMPLNONPERM       int,
   R_61221              int,
   R_61222              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_6122)
);

/*==============================================================*/
/* Table : IND_613                                              */
/*==============================================================*/
create table IND_613
(
   ID_613               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_EBCF              int,
   R_6131               char(10),
   R_6132               char(10),
   R_6133               char(10),
   R_6134               char(10),
   R_61321              char(10),
   R_61322              char(10),
   R_61323              char(10),
   R_61324              char(10),
   R_61331              char(10),
   R_61332              char(10),
   R_61333              char(10),
   R_61334              char(10),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_613)
);

/*==============================================================*/
/* Table : IND_712                                              */
/*==============================================================*/
create table IND_712
(
   ID_712               int not null auto_increment,
   ID_BILASOCICONS      int,
   R_7121               decimal(5,2),
   R_7122               decimal(5,2),
   R_7123               decimal(5,2),
   R_7124               decimal(5,2),
   R_7125               decimal(5,2),
   R_7126               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_712)
);

/*==============================================================*/
/* Table : IND_713                                              */
/*==============================================================*/
create table IND_713
(
   ID_713               int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_MOTIGREV          int,
   R_7131               int,
   R_7132               int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_713)
);

/*==============================================================*/
/* Table : IND_814_1                                            */
/*==============================================================*/
create table IND_814_1
(
   ID_8141              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CATE              int,
   R_81411              int,
   R_81412              int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_8141)
);

/*==============================================================*/
/* Table : IND_814_2                                            */
/*==============================================================*/
create table IND_814_2
(
   ID_8142              int not null auto_increment,
   ID_BILASOCICONS      int,
   ID_CATE              int,
   R_81421              decimal(10,2),
   R_81422              decimal(10,2),
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_8142)
);

/*==============================================================*/
/* Table : IND_RAST_AT                                          */
/*==============================================================*/
create table IND_RAST_AT
(
   ID_RASTAT            int not null auto_increment,
   ID_CADREMPL          int,
   ID_BILASOCICONS      int,
   RASTAT_1             int,
   RASTAT_2             int,
   RASTAT_3             int,
   RASTAT_4             int,
   RASTAT_5             int,
   RASTAT_6             int,
   RASTAT_7             int,
   RASTAT_8             int,
   RASTAT_9             int,
   RASTAT_10            int,
   RASTAT_11            int,
   RASTAT_13            int,
   RASTAT_14            int,
   RASTAT_15            int,
   RASTAT_16            int,
   RASTAT_17            int,
   RASTAT_18            int,
   RASTAT_19            int,
   RASTAT_20            int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_RASTAT)
);

/*==============================================================*/
/* Table : IND_RAST_MP                                          */
/*==============================================================*/
create table IND_RAST_MP
(
   ID_RASTMP            int not null auto_increment,
   ID_CADREMPL          int,
   ID_BILASOCICONS      int,
   RASTMP_1             int,
   RASTMP_2             int,
   RASTMP_3             int,
   RASTMP_4             int,
   RASTMP_5             int,
   RASTMP_6             int,
   RASTMP_7             int,
   RASTMP_8             int,
   RASTMP_9             int,
   RASTMP_10            int,
   FG_STAT              varchar(1),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_RASTMP)
);

/*==============================================================*/
/* Table : INFORMATION_COLECTIVITE_AGENT                        */
/*==============================================================*/
create table INFORMATION_COLECTIVITE_AGENT
(
   ID_INFOCOLLAGEN      int not null auto_increment,
   BL_CHARTEMP          bool comment 'Ind 225',
   BL_AUTOASSUSANSCONVTITU bool comment 'IND 341',
   BL_AUTOASSUAVECCONVTITU bool comment 'IND 341',
   BL_AUTOASSUAVECCONVCONT bool comment 'IND 342',
   BL_REGIASSUCHOM      bool comment 'IND 342',
   BL_HEURSUPP          bool comment 'IND 343',
   BL_HEURCOMP          bool comment 'IND 343',
   MT_DEPEFONCCOLL      int,
   MT_CHARPERS          int,
   LB_RATI              varchar(10),
   BL_AGENAFFEPREV      bool,
   NB_VISIMEDISPONPREV  int,
   BL_DOCURISQPRO       bool,
   NM_ANNECREA          int,
   NM_ANNEDERNMAJ       int,
   BL_PLANPREVRISQPSYSOCI bool,
   BL_DEMAPREVTROUMUSCU bool,
   BL_DEMAPREVRISQCANC  bool,
   BL_AUTRDEMAPREV      bool,
   BL_REGISANTSECUTRAV  bool,
   BL_ACTEVIOLPHYS      bool,
   MT_CNFPTCOTIOBL      int,
   MT_CNFPTSUPCOTIOBL   int,
   MT_AUTRORGA          int,
   MT_FRAIDEPLA         int,
   NB_REUNCT            int,
   NB_REUNCOMMIADMI     int,
   NB_REUNCHSCT         int,
   BL_CTSIEGMISSDEVO    bool,
   NB_REUNCTMISSDEVO    int,
   NB_JOURAUTOSPEACCO   int,
   NB_JOURABSE          int,
   NB_HEURGLOB          int,
   NB_HEURDROISYND      int,
   NB_HEURUTIL          int,
   NB_PROTACCO          int,
   BL_GREV              bool,
   BL_SUBVVERSCOMI      bool,
   BL_COTISUBVCOMIINTER bool,
   BL_PRESSERVCOLL      bool,
   BL_PLACRESECREC      bool,
   BL_AIDEFINAGARDENFA  bool,
   BL_AUTRGARDENFA      bool,
   BL_SANTCONVPARTI     bool,
   BL_SANTCONTREGL      bool,
   BL_PREVOCONVPARTI    bool,
   BL_PREVOCONTREGL     bool,
   MT_DEPETOTA          int comment 'IND 162',
   MT_DEPEINSEPERSHAND  int comment 'IND 162',
   MT_REALEMPLPERSHAND  int comment 'IND 162',
   MT_DEPEAMENTRAV      int comment 'IND 162',
   NB_TRAVHANDEMPLPERM  int comment 'IND 162',
   TX_EMPLDIRETRAVHAND  int comment 'IND 162',
   TX_EMPLLEGATRAVHAND  int comment 'IND 162',
   primary key (ID_INFOCOLLAGEN)
);

/*==============================================================*/
/* Table : INFORMATION_GENERALE                                 */
/*==============================================================*/
create table INFORMATION_GENERALE
(
   ID_INFOGENE          int not null auto_increment,
   ID_BILASOCIAGEN      int,
   Q1                   bool,
   Q2                   bool,
   Q3                   bool,
   Q4                   bool,
   Q5                   bool,
   Q6                   bool,
   Q7                   bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_INFOGENE)
);

/*==============================================================*/
/* Table : MODELE_MAIL                                          */
/*==============================================================*/
create table MODELE_MAIL
(
   ID_MODEMAIL          int not null auto_increment,
   CD_MODEMAIL          varchar(20),
   LB_OBJ               varchar(150),
   LB_CORP              text,
   BL_APPL              bool,
   BL_DUPL              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_MODEMAIL)
);

/*==============================================================*/
/* Table : MODE_SAISIE_ENQUETE                                  */
/*==============================================================*/
create table MODE_SAISIE_ENQUETE
(
   ID_MODECAMP          int not null auto_increment,
   CD_MODECAMP          varchar(10) not null,
   LB_MODECAMP          varchar(50) not null,
   primary key (ID_MODECAMP)
);

/*==============================================================*/
/* Table : MODULE_ENQUETE                                       */
/*==============================================================*/
create table MODULE_ENQUETE
(
   ID_MODUENQU          int not null,
   CD_MODUENQU          varchar(10) not null,
   LB_MODUENQU          varchar(50) not null,
   primary key (ID_MODUENQU)
);

/*==============================================================*/
/* Table : PREVOYANCE                                           */
/*==============================================================*/
create table PREVOYANCE
(
   ID_PREVO             int not null auto_increment,
   ID_CATE              int,
   ID_INFOCOLLAGEN      int,
   R_81421              decimal(10,2),
   R_81422              decimal(10,2),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_PREVO)
);

/*==============================================================*/
/* Table : PROFIL                                               */
/*==============================================================*/
create table PROFIL
(
   ID_PROF              int not null auto_increment,
   LB_PROF              varchar(20),
   primary key (ID_PROF)
);

/*==============================================================*/
/* Table : QUESTION_COLLECTIVITE_CONSOLIDE                      */
/*==============================================================*/
create table QUESTION_COLLECTIVITE_CONSOLIDE
(
   ID_QUESCOLLCONS      int not null auto_increment,
   Q1                   bool,
   Q2                   bool,
   Q3                   bool,
   Q4                   bool,
   Q5                   bool,
   Q6                   bool,
   Q7                   bool,
   Q8                   bool,
   Q9                   bool,
   Q10                  bool,
   Q11                  bool,
   Q12                  bool,
   Q13                  bool,
   Q14                  bool,
   DT_CREA              date,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_QUESCOLLCONS)
);

/*==============================================================*/
/* Table : REF_ACTE_VIOLENCE_PHYSIQUE                           */
/*==============================================================*/
create table REF_ACTE_VIOLENCE_PHYSIQUE
(
   ID_ACTEVIOLPHYS      int not null auto_increment,
   CD_ACTVIOLPHYS       varchar(50),
   LB_ACTVIOLPHYS       varchar(255),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_ACTEVIOLPHYS)
);

/*==============================================================*/
/* Table : REF_AVANCEMENT_PROMOTION_CONCOURS                    */
/*==============================================================*/
create table REF_AVANCEMENT_PROMOTION_CONCOURS
(
   ID_AVANPROMCONC      int not null auto_increment,
   CD_AVANPROMCONC      varchar(50),
   LB_AVANPROMCONC      varchar(255),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_AVANPROMCONC)
);

/*==============================================================*/
/* Table : REF_CADRE_EMPLOI                                     */
/*==============================================================*/
create table REF_CADRE_EMPLOI
(
   ID_CADREMPL          int not null auto_increment,
   ID_FILI              int,
   ID_CATE              int,
   CD_CADREMPL          varchar(50),
   LB_CADREMPL          varchar(200),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_CADREMPL)
);

/*==============================================================*/
/* Table : REF_CATEGORIE                                        */
/*==============================================================*/
create table REF_CATEGORIE
(
   ID_CATE              int not null auto_increment,
   CD_CATE              varchar(10),
   LB_CATE              varchar(50),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_CATE)
);

/*==============================================================*/
/* Table : REF_CONTRAINTE_TRAVAIL                               */
/*==============================================================*/
create table REF_CONTRAINTE_TRAVAIL
(
   ID_CONTTRAV          int not null auto_increment,
   CD_CONTTRAV          varchar(50),
   LB_CONTTRAV          varchar(100),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_CONTTRAV)
);

/*==============================================================*/
/* Table : REF_CYCLE_TRAVAIL                                    */
/*==============================================================*/
create table REF_CYCLE_TRAVAIL
(
   ID_CYCLTRAV          int not null auto_increment,
   CD_CYCLTRAV          varchar(50),
   LB_CYCLTRAV          varchar(100),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_CYCLTRAV)
);

/*==============================================================*/
/* Table : REF_EMPLOI_FONCTIONNEL                               */
/*==============================================================*/
create table REF_EMPLOI_FONCTIONNEL
(
   ID_EMPLFONC          int not null auto_increment,
   CD_EMPLFONC          varchar(50),
   LB_EMPLFONC          varchar(200),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_EMPLFONC)
);

/*==============================================================*/
/* Table : REF_EMPLOI_NON_PERMANENT                             */
/*==============================================================*/
create table REF_EMPLOI_NON_PERMANENT
(
   ID_EMPLNONPERM       int not null auto_increment,
   CD_EMPLNONPERM       varchar(50),
   LB_EMPLNONPERM       varbinary(200),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_EMPLNONPERM)
);

/*==============================================================*/
/* Table : REF_FILIERE                                          */
/*==============================================================*/
create table REF_FILIERE
(
   ID_FILI              int not null auto_increment,
   CD_FILI              varchar(50),
   LB_FILI              varchar(150),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_FILI)
);

/*==============================================================*/
/* Table : REF_FONCTION_PUBLIQUE                                */
/*==============================================================*/
create table REF_FONCTION_PUBLIQUE
(
   ID_FONCPUBL          int not null auto_increment,
   CD_FONCPUBL          varchar(50),
   LB_FONCPUBL          varchar(150),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_FONCPUBL)
);

/*==============================================================*/
/* Table : REF_FORMATION                                        */
/*==============================================================*/
create table REF_FORMATION
(
   ID_FORM              int not null auto_increment,
   CD_FORM              varchar(50),
   LB_FORM              text,
   BL_PREV              bool,
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_FORM)
);

/*==============================================================*/
/* Table : REF_GRADE                                            */
/*==============================================================*/
create table REF_GRADE
(
   ID_GRAD              int not null auto_increment,
   ID_CADREMPL          int,
   CD_GRAD              varchar(50),
   LB_GRAD              varchar(200),
   BL_DETA              bool,
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_GRAD)
);

/*==============================================================*/
/* Table : REF_INAPTITUDE                                       */
/*==============================================================*/
create table REF_INAPTITUDE
(
   ID_INAP              int not null auto_increment,
   CD_INAP              varchar(50),
   LB_INAP              varchar(255),
   BL_DEMA              bool,
   BL_DECI              bool,
   BL_VISUAGEN          bool,
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_INAP)
);

/*==============================================================*/
/* Table : REF_MOTIF_ABSENCE                                    */
/*==============================================================*/
create table REF_MOTIF_ABSENCE
(
   ID_MOTIABSE          int not null auto_increment,
   CD_MOTIABSE          varchar(50),
   LB_MOTIABSE          varchar(200),
   BL_ABSECOMP          bool,
   BL_ABSEMEDI          bool,
   BL_ABSEAUTRRAIS      bool,
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_MOTIABSE)
);

/*==============================================================*/
/* Table : REF_MOTIF_ARRIVEE                                    */
/*==============================================================*/
create table REF_MOTIF_ARRIVEE
(
   ID_MOTIARRI          int not null auto_increment,
   ID_STAT              int,
   CD_MOTIARRI          varchar(50),
   LB_MOTIARRI          varchar(200),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_MOTIARRI)
);

/*==============================================================*/
/* Table : REF_MOTIF_DEPART                                     */
/*==============================================================*/
create table REF_MOTIF_DEPART
(
   ID_MOTIDEPA          int not null auto_increment,
   ID_STAT              int,
   CD_MOTIDEPA          varchar(50),
   LB_MOTIDEPA          varchar(255),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_MOTIDEPA)
);

/*==============================================================*/
/* Table : REF_MOTIF_ENTRETIEN                                  */
/*==============================================================*/
create table REF_MOTIF_ENTRETIEN
(
   ID_MOTIENTR          int not null auto_increment,
   CD_MOTIENTR          varchar(50),
   LB_MOTIENTR          varchar(255),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_MOTIENTR)
);

/*==============================================================*/
/* Table : REF_MOTIF_GREVE                                      */
/*==============================================================*/
create table REF_MOTIF_GREVE
(
   ID_MOTIGREV          int not null auto_increment,
   CD_MOTIGREV          varchar(50),
   LB_MOTIGREV          varchar(150),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_MOTIGREV)
);

/*==============================================================*/
/* Table : REF_ORGANISME_FORMATION                              */
/*==============================================================*/
create table REF_ORGANISME_FORMATION
(
   ID_ORGAFORM          int not null auto_increment,
   CD_ORGAFORM          varchar(50),
   LB_ORGAFORM          varchar(150),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_ORGAFORM)
);

/*==============================================================*/
/* Table : REF_POSITION_STATUTAIRE                              */
/*==============================================================*/
create table REF_POSITION_STATUTAIRE
(
   ID_POSISTAT          int not null auto_increment,
   ID_STAT              int,
   CD_POSISTAT          varchar(50),
   LB_POSISTAT          varchar(200),
   BL_CDG               bool,
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_POSISTAT)
);

/*==============================================================*/
/* Table : REF_POURCENTAGE_TEMPA_PARTIEL                        */
/*==============================================================*/
create table REF_POURCENTAGE_TEMPA_PARTIEL
(
   ID_POURTEMPPART      int not null auto_increment,
   CD_POURTEMPPART      varchar(50),
   LB_POURTEMPPART      varchar(100),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_POURTEMPPART)
);

/*==============================================================*/
/* Table : REF_STAGE_TITULARISATION                             */
/*==============================================================*/
create table REF_STAGE_TITULARISATION
(
   ID_STAGTITU          int not null auto_increment,
   CD_STAGTITU          varbinary(50),
   LB_STAGTITU          varchar(255),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_STAGTITU)
);

/*==============================================================*/
/* Table : REF_STATUT                                           */
/*==============================================================*/
create table REF_STATUT
(
   ID_STAT              int not null auto_increment,
   CD_STAT              varchar(50),
   LB_STAT              varchar(100),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_STAT)
);

/*==============================================================*/
/* Table : REF_STRUCTURE_ORIGINE                                */
/*==============================================================*/
create table REF_STRUCTURE_ORIGINE
(
   ID_STRUORIG          int not null auto_increment,
   CD_STRUORIG          varchar(50),
   LB_STRUORIG          varchar(150),
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_STRUORIG)
);

/*==============================================================*/
/* Table : REF_TEMPS_NON_COMPLET                                */
/*==============================================================*/
create table REF_TEMPS_NON_COMPLET
(
   ID_TEMPNONCOMP       int not null auto_increment,
   CD_TEMPNONCOMP       varchar(50),
   LB_TEMPNONCOMP       varchar(100),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_TEMPNONCOMP)
);

/*==============================================================*/
/* Table : REF_TEMPS_PARTIEL                                    */
/*==============================================================*/
create table REF_TEMPS_PARTIEL
(
   ID_TEMPPART          int not null auto_increment,
   CD_TEMPPART          varchar(50),
   LB_TEMPPART          varchar(150),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_TEMPPART)
);

/*==============================================================*/
/* Table : REF_TRANCHE_AGE                                      */
/*==============================================================*/
create table REF_TRANCHE_AGE
(
   ID_TRANAGE           int not null auto_increment,
   CD_TRANAGE           varchar(50),
   LB_TRANAGE           varchar(100),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_TRANAGE)
);

/*==============================================================*/
/* Table : REF_TYPE_COLLECTIVITE                                */
/*==============================================================*/
create table REF_TYPE_COLLECTIVITE
(
   ID_TYPE_COLL         int not null auto_increment,
   CD_TYPECOLL          varchar(50),
   LB_TYPE_COLL         varchar(150),
   BL_VALI              bool,
   CD_UTILCREA          varchar(50),
   DT_CREA              datetime,
   CD_UTILMODI          varchar(50),
   DT_MODI              datetime,
   primary key (ID_TYPE_COLL)
);

/*==============================================================*/
/* Table : REF_TYPE_MISSION_PREVENTION                          */
/*==============================================================*/
create table REF_TYPE_MISSION_PREVENTION
(
   ID_TYPEMISSPREV      int not null auto_increment,
   ID_TYPE_COLL         int,
   CD_TYPEMISSPREV      varchar(50),
   LB_TYPEMISSPREV      varchar(255),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_TYPEMISSPREV)
);

/*==============================================================*/
/* Table : REF_VALIDATION_EXPERIENCE                            */
/*==============================================================*/
create table REF_VALIDATION_EXPERIENCE
(
   ID_EBCF              int not null auto_increment,
   CD_EBCF              varchar(50),
   LB_EBCF              varchar(255),
   BL_VALI              bool,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_EBCF)
);

/*==============================================================*/
/* Table : SANTE                                                */
/*==============================================================*/
create table SANTE
(
   ID_SANT              int not null auto_increment,
   ID_CATE              int,
   ID_INFOCOLLAGEN      int,
   R_81411              int,
   R_81412              int,
   DT_CREA              datetime,
   CD_UTILCREA          varchar(50),
   DT_MODI              datetime,
   CD_UTILMODI          varchar(50),
   primary key (ID_SANT)
);

/*==============================================================*/
/* Table : TYPE_IMPORT                                          */
/*==============================================================*/
create table TYPE_IMPORT
(
   ID_TYPEIMPO          int not null auto_increment,
   CD_TYPEIMPO          varchar(20) not null,
   LB_TYPEIMPO          varchar(50) not null,
   primary key (ID_TYPEIMPO)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   ID_UTIL              int not null auto_increment,
   ID_PROF              int,
   ID_COLL              int,
   ID_CDG               int,
   LB_LOGI              varchar(50) not null,
   LB_MDP               varchar(50) not null,
   FG_TYPEUTIL          varchar(1),
   BL_ACTIF             bool,
   DT_LASTCONN          datetime,
   NM_ERRECONN          int,
   BL_COMPTEMP          bool,
   CD_UTILCREA          varchar(50),
   DT_CREA              datetime,
   CD_UTILMODI          varchar(50),
   DT_MODI              datetime,
   primary key (ID_UTIL)
);

/*==============================================================*/
/* Table : UTILISATEUR_DROITS                                   */
/*==============================================================*/
create table UTILISATEUR_DROITS
(
   ID_UTILDROIT         int not null auto_increment,
   ID_UTIL              int,
   ID_DROI              int,
   ID_DEPA              int,
   BL_VOIR              bool,
   BL_SAIS              bool,
   BL_AUCU              bool,
   primary key (ID_UTILDROIT)
);

alter table ABSENCE_ARRET_AGENT add constraint FK_ABSENCEARRETAGENT_BILANSOCIALAGENT foreign key (ID_BILASOCIAGEN)
      references BILAN_SOCIAL_AGENT (ID_BILASOCIAGEN) on delete restrict on update restrict;

alter table ABSENCE_ARRET_AGENT add constraint FK_ABSENCEARRETAGENT_MOTIFABSENCE foreign key (ID_MOTIABSE)
      references REF_MOTIF_ABSENCE (ID_MOTIABSE) on delete restrict on update restrict;

alter table ACTE_VIOLENCE_PHYSIQUE add constraint FK_ACTEVIOLENCEPHYSIQUE_INFOCOLLAGENT foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table ACTE_VIOLENCE_PHYSIQUE add constraint FK_ACTEVIOLENCEPHYSIQUE_REFACTEVIOLPHYS foreign key (ID_ACTEVIOLPHYS)
      references REF_ACTE_VIOLENCE_PHYSIQUE (ID_ACTEVIOLPHYS) on delete restrict on update restrict;

alter table ACTION_PREVENTION add constraint FK_ACTIONPREVENTION_FORMATION foreign key (ID_FORM)
      references REF_FORMATION (ID_FORM) on delete restrict on update restrict;

alter table ACTION_PREVENTION add constraint FK_ACTIONPREVENTION_INFORMATIONCOLLECTIVTE foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table AGENT_AFFECTE_PREVENTION add constraint FK_AGENTAFFECTEPREVENTION_INFORCOLLAGENT foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table AGENT_AFFECTE_PREVENTION add constraint FK_AGENTAFFECTEPREVENTION_TYPEMISSIPREV foreign key (ID_TYPEMISSPREV)
      references REF_TYPE_MISSION_PREVENTION (ID_TYPEMISSPREV) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_AVANPROMCONCOURS foreign key (ID_AVANPROMCONC)
      references REF_AVANCEMENT_PROMOTION_CONCOURS (ID_AVANPROMCONC) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_COLLECTIVITE foreign key (ID_COLL)
      references COLLECTIVITE (ID_COLL) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_CONTRAINTETRAVAIL foreign key (ID_CONTTRAV)
      references REF_CONTRAINTE_TRAVAIL (ID_CONTTRAV) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_CYCLETRAVAIL foreign key (ID_CYCLTRAV)
      references REF_CYCLE_TRAVAIL (ID_CYCLTRAV) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_EMPLOINONPERMANENT foreign key (ID_EMPLNONPERM)
      references REF_EMPLOI_NON_PERMANENT (ID_EMPLNONPERM) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_ENQUETE foreign key (ID_ENQU)
      references ENQUETE (ID_ENQU) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_FONCTIONPUBLIQUE foreign key (ID_FONCPUBL)
      references REF_FONCTION_PUBLIQUE (ID_FONCPUBL) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_GRADE foreign key (ID_GRAD)
      references REF_GRADE (ID_GRAD) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_GRADEDETACHEMENT foreign key (ID_GRADDETA)
      references REF_GRADE (ID_GRAD) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_MOTIFDEPART foreign key (ID_MOTIDEPA)
      references REF_MOTIF_DEPART (ID_MOTIDEPA) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_MOTIFENTRETIEN_DEPART foreign key (ID_MOTIENTRDEPACONG)
      references REF_MOTIF_ENTRETIEN (ID_MOTIENTR) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_MOTIFENTRETIEN_RETOUR foreign key (ID_MOTIENTRRETOCONG)
      references REF_MOTIF_ENTRETIEN (ID_MOTIENTR) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_PORCENTEMPSPARTIEL foreign key (ID_POURTEMPPART)
      references REF_POURCENTAGE_TEMPA_PARTIEL (ID_POURTEMPPART) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_POSITIONSTATUTAIRE foreign key (ID_POSISTAT)
      references REF_POSITION_STATUTAIRE (ID_POSISTAT) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_STATUT foreign key (ID_STAT)
      references REF_STATUT (ID_STAT) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_STRUCORIGINE foreign key (ID_STRUORIG)
      references REF_STRUCTURE_ORIGINE (ID_STRUORIG) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_STRUCTUREORIGINE foreign key (ID_STRUORIGPOSISTAT)
      references REF_STRUCTURE_ORIGINE (ID_STRUORIG) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_TEMPSNONCOMPLET foreign key (ID_TEMPNONCOMP)
      references REF_TEMPS_NON_COMPLET (ID_TEMPNONCOMP) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_TEMPSPARTIEL foreign key (ID_TEMPPART)
      references REF_TEMPS_PARTIEL (ID_TEMPPART) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_TITULARISATIONSTAGE foreign key (ID_STAGTITU)
      references REF_STAGE_TITULARISATION (ID_STAGTITU) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_TYPEMISSIONPREVENTION foreign key (ID_TYPEMISSPREV)
      references REF_TYPE_MISSION_PREVENTION (ID_TYPEMISSPREV) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGENT_VALIDATIONEXPERIENCE foreign key (ID_EBCF)
      references REF_VALIDATION_EXPERIENCE (ID_EBCF) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGEN_INAPTITUDE_DECISION foreign key (ID_INAPDECI)
      references REF_INAPTITUDE (ID_INAP) on delete restrict on update restrict;

alter table BILAN_SOCIAL_AGENT add constraint FK_BILANSOCIALAGEN_INAPTITUDE_DEMANDE foreign key (ID_INAPDEMA)
      references REF_INAPTITUDE (ID_INAP) on delete restrict on update restrict;

alter table BILAN_SOCIAL_CONSOLIDE add constraint FK_BILANSOCIALCONSOLIDE_COLLECTIVITE foreign key (ID_COLL)
      references COLLECTIVITE (ID_COLL) on delete restrict on update restrict;

alter table BILAN_SOCIAL_CONSOLIDE add constraint FK_BILANSOCIALCONSOLIDE_ENQUETE foreign key (ID_ENQU)
      references ENQUETE (ID_ENQU) on delete restrict on update restrict;

alter table BILAN_SOCIAL_CONSOLIDE add constraint FK_BILANSOCIALCONSOLIDE_QUESCOLLCONSOLIDE foreign key (ID_QUESCOLLCONS)
      references QUESTION_COLLECTIVITE_CONSOLIDE (ID_QUESCOLLCONS) on delete restrict on update restrict;

alter table COLLECTIVITE add constraint FK_CDG_COLLECTIVITE foreign key (ID_CDG)
      references CDG (ID_CDG) on delete restrict on update restrict;

alter table COLLECTIVITE add constraint FK_DEPARTEMENT_COLLECTIVITE foreign key (ID_DEPA)
      references DEPARTEMENT (ID_DEPA) on delete restrict on update restrict;

alter table COLLECTIVITE add constraint FK_TYPECOLLECTIVITE_COLLECTIVITE foreign key (ID_TYPE_COLL)
      references REF_TYPE_COLLECTIVITE (ID_TYPE_COLL) on delete restrict on update restrict;

alter table CONFILT_TRAVAIL add constraint FK_CONFLITTRAVAIL_MMOTIFGREVE foreign key (ID_MOTIGREV)
      references REF_MOTIF_GREVE (ID_MOTIGREV) on delete restrict on update restrict;

alter table ENQUETE add constraint FK_CDG_CAMPAGNE foreign key (ID_CDG)
      references CDG (ID_CDG) on delete restrict on update restrict;

alter table ENQUETE add constraint FK_ENQUETE_CAMPAGNE foreign key (ID_CAMP)
      references CAMPAGNE (ID_CAMP) on delete restrict on update restrict;

alter table ENQUETE_COLLECTIVITE add constraint FK_ENQUETECOLLECTIVITE_COLLECTIVITE foreign key (ID_COLL)
      references COLLECTIVITE (ID_COLL) on delete restrict on update restrict;

alter table ENQUETE_COLLECTIVITE add constraint FK_ENQUETECOLLECTIVITE_ENQUETE foreign key (ID_ENQU)
      references ENQUETE (ID_ENQU) on delete restrict on update restrict;

alter table ENQUETE_COLLECTIVITE add constraint FK_ENQUETECOLLECTIVITE_MODESAISIEENQUETE foreign key (ID_MODECAMP)
      references MODE_SAISIE_ENQUETE (ID_MODECAMP) on delete restrict on update restrict;

alter table ENQUETE_COLLECTIVITE add constraint FK_ENQUETECOLLECTIVITE_MODULE foreign key (ID_MODU)
      references MODULE_ENQUETE (ID_MODUENQU) on delete restrict on update restrict;

alter table ENQUETE_COLLECTIVITE add constraint FK_ENQUETECOLLECTIVITE_TYPEIMPORT foreign key (ID_TYPEIMPO)
      references TYPE_IMPORT (ID_TYPEIMPO) on delete restrict on update restrict;

alter table ETPR_114_ANNEE_PRECEDENTE add constraint FK_ETPR114ANNEEPRECEDENTE_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table ETPR_114_ANNEE_PRECEDENTE add constraint FK_ETPR114ANNEEPRECEDENTE_INFORMATIONCOLLECTIVITEAGENT foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table ETPR_124_ANNEE_PRECEDENTE add constraint FK_ETPR124ANNEEPRECEDENTE_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table ETPR_124_ANNEE_PRECEDENTE add constraint FK_ETPR124ANNEEPRECEDENTE_INFORMATIONCOLLECTIVITEAGENT foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table ETPR_131_ANNEE_PRECEDENTE add constraint FK_ETPR131EMPLNONPERM_EMPLOINONPERMANENT foreign key (ID_EMPLNONPERM)
      references REF_EMPLOI_NON_PERMANENT (ID_EMPLNONPERM) on delete restrict on update restrict;

alter table ETPR_131_ANNEE_PRECEDENTE add constraint FK_ETPR131EMPLNONPERM_INFOCOLLAGENT foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table FORMATION_AGENT add constraint FK_FORMATIONAGENT_BILANSOCIALAGENT foreign key (ID_BILASOCIAGEN)
      references BILAN_SOCIAL_AGENT (ID_BILASOCIAGEN) on delete restrict on update restrict;

alter table FORMATION_AGENT add constraint FK_FORMATIONAGENT_FORMATION foreign key (ID_FORM)
      references REF_FORMATION (ID_FORM) on delete restrict on update restrict;

alter table FORMATION_AGENT add constraint FK_FORMATIONAGENT_ORGANISMEFORMATION foreign key (ID_ORGAFORM)
      references REF_ORGANISME_FORMATION (ID_ORGAFORM) on delete restrict on update restrict;

alter table HISTORIQUE_COLLECTIVITE add constraint FK_COLLECTIVITE_HISTORIQUE_COLLECTIVITE foreign key (ID_COLL)
      references COLLECTIVITE (ID_COLL) on delete restrict on update restrict;

alter table HISTORIQUE_ECHANGE add constraint FK_HISTORIQUEECHANGE_CDG foreign key (ID_CDG)
      references CDG (ID_CDG) on delete restrict on update restrict;

alter table HISTORIQUE_ECHANGE add constraint FK_HISTORIQUEECHANGE_COLLECTIVITE foreign key (ID_COLL)
      references COLLECTIVITE (ID_COLL) on delete restrict on update restrict;

alter table IMPORT add constraint FK_IMPORT_BILANSOCIALAGENT foreign key (ID_BILASOCIAGEN)
      references BILAN_SOCIAL_AGENT (ID_BILASOCIAGEN) on delete restrict on update restrict;

alter table IMPORT add constraint FK_IMPORT_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_110_1 add constraint FK_1101_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_110_1 add constraint FK_1101_EMPLOIFONCTIONNEL foreign key (ID_EMPLFONC)
      references REF_EMPLOI_FONCTIONNEL (ID_EMPLFONC) on delete restrict on update restrict;

alter table IND_110_2 add constraint FK_1102_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_110_2 add constraint FK_1102_EMPLOIFONCTIONNEL foreign key (ID_EMPLFONC)
      references REF_EMPLOI_FONCTIONNEL (ID_EMPLFONC) on delete restrict on update restrict;

alter table IND_110_3 add constraint FK_1103_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_110_3 add constraint FK_1103_EMPLOIFONCTIONNEL foreign key (ID_EMPLFONC)
      references REF_EMPLOI_FONCTIONNEL (ID_EMPLFONC) on delete restrict on update restrict;

alter table IND_111 add constraint FK_111_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_111 add constraint FK_111_GRADE foreign key (ID_GRAD)
      references REF_GRADE (ID_GRAD) on delete restrict on update restrict;

alter table IND_112 add constraint FK_112_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_112 add constraint FK_112_GRADE foreign key (ID_GRAD)
      references REF_GRADE (ID_GRAD) on delete restrict on update restrict;

alter table IND_113 add constraint FK_113_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_113 add constraint FK_113_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_114 add constraint FK_114_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_114 add constraint FK_114_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table IND_121 add constraint FK_121_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_121 add constraint FK_121_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table IND_122 add constraint FK_122_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_122 add constraint FK_122_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table IND_123 add constraint FK_123_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_123 add constraint FK_123_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_124 add constraint FK_124_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_124 add constraint FK_124_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table IND_131_1 add constraint FK_1311_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_131_1 add constraint FK_1311_EMPLOINONPERMANENT foreign key (ID_EMPLNONPERM)
      references REF_EMPLOI_NON_PERMANENT (ID_EMPLNONPERM) on delete restrict on update restrict;

alter table IND_131_2 add constraint FK_1312_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_131_2 add constraint FK_1312_EMPLOINONPERMANENT foreign key (ID_EMPLNONPERM)
      references REF_EMPLOI_NON_PERMANENT (ID_EMPLNONPERM) on delete restrict on update restrict;

alter table IND_132 add constraint FK_132_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_141 add constraint FK_141_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_141 add constraint FK_141_POSITIONSTATUTAIRE foreign key (ID_POSISTAT)
      references REF_POSITION_STATUTAIRE (ID_POSISTAT) on delete restrict on update restrict;

alter table IND_142 add constraint FK_142_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_142 add constraint FK_142_POSITIONSTATUTAIRE foreign key (ID_POSISTAT)
      references REF_POSITION_STATUTAIRE (ID_POSISTAT) on delete restrict on update restrict;

alter table IND_143 add constraint FK_143_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_143 add constraint FK_143_POSITIONSTATUTAIRE foreign key (ID_POSISTAT)
      references REF_POSITION_STATUTAIRE (ID_POSISTAT) on delete restrict on update restrict;

alter table IND_144 add constraint FK_144_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_144 add constraint FK_144_POSITIONSTATUTAIRE foreign key (ID_POSISTAT)
      references REF_POSITION_STATUTAIRE (ID_POSISTAT) on delete restrict on update restrict;

alter table IND_150_1 add constraint FK_1501_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_150_1 add constraint FK_1501_MOTIFDEPART foreign key (ID_MOTIDEPA)
      references REF_MOTIF_DEPART (ID_MOTIDEPA) on delete restrict on update restrict;

alter table IND_150_2 add constraint FK_1502_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_150_2 add constraint FK_1502_MOTIFDEPART foreign key (ID_MOTIDEPA)
      references REF_MOTIF_DEPART (ID_MOTIDEPA) on delete restrict on update restrict;

alter table IND_151_1 add constraint FK_1511_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_151_1 add constraint FK_1511_EMPLOIFONCTIONNEL foreign key (ID_EMPLFONC)
      references REF_EMPLOI_FONCTIONNEL (ID_EMPLFONC) on delete restrict on update restrict;

alter table IND_151_2 add constraint FK_1512_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_151_2 add constraint FK_1512_EMPLOIFONCTIONNEL foreign key (ID_EMPLFONC)
      references REF_EMPLOI_FONCTIONNEL (ID_EMPLFONC) on delete restrict on update restrict;

alter table IND_151_3 add constraint FK_1513_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_151_3 add constraint FK_1513_EMPLOIFONCTIONNEL foreign key (ID_EMPLFONC)
      references REF_EMPLOI_FONCTIONNEL (ID_EMPLFONC) on delete restrict on update restrict;

alter table IND_152 add constraint FK_152_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_152 add constraint FK_152_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table IND_153_1 add constraint FK_1531_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_153_1 add constraint FK_1531_MOTIFARRIVEE foreign key (ID_ARRI)
      references REF_MOTIF_ARRIVEE (ID_MOTIARRI) on delete restrict on update restrict;

alter table IND_153_2 add constraint FK_1532_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_153_2 add constraint FK_1532_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table IND_154 add constraint FK_154_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_154 add constraint FK_154_STAGETITULARISATION foreign key (ID_STAGTITU)
      references REF_STAGE_TITULARISATION (ID_STAGTITU) on delete restrict on update restrict;

alter table IND_155 add constraint FK_155_AVANCEMENTPROMOTIONCONC foreign key (ID_AVANPROMCONC)
      references REF_AVANCEMENT_PROMOTION_CONCOURS (ID_AVANPROMCONC) on delete restrict on update restrict;

alter table IND_155 add constraint FK_155_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_156 add constraint FK_156_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_156 add constraint FK_156_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_158 add constraint FK_158_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_158 add constraint FK_158_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table IND_161 add constraint FK_161_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_161 add constraint FK_161_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_171 add constraint FK_171_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_171 add constraint FK_171_TRANCHEAGE foreign key (ID_TRANAGE)
      references REF_TRANCHE_AGE (ID_TRANAGE) on delete restrict on update restrict;

alter table IND_211_1 add constraint FK_2111BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_211_1 add constraint FK_2111_MOTIFABSENCE foreign key (ID_MOTIABSE)
      references REF_MOTIF_ABSENCE (ID_MOTIABSE) on delete restrict on update restrict;

alter table IND_211_2 add constraint FK_2112_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_211_2 add constraint FK_2112_MOTIFABSENCE foreign key (ID_MOTIABSE)
      references REF_MOTIF_ABSENCE (ID_MOTIABSE) on delete restrict on update restrict;

alter table IND_211_3 add constraint FK_2113_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_211_3 add constraint FK_2113_MOTIFABSENCE foreign key (ID_MOTIABSE)
      references REF_MOTIF_ABSENCE (ID_MOTIABSE) on delete restrict on update restrict;

alter table IND_212_1 add constraint FK_2121_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_212_1 add constraint FK_2121_MOTIFABSENCE foreign key (ID_MOTIABSE)
      references REF_MOTIF_ABSENCE (ID_MOTIABSE) on delete restrict on update restrict;

alter table IND_212_2 add constraint FK_2122_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_212_2 add constraint FK_2122_MOTIFABSENCE foreign key (ID_MOTIABSE)
      references REF_MOTIF_ABSENCE (ID_MOTIABSE) on delete restrict on update restrict;

alter table IND_212_3 add constraint FK_2123_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_212_3 add constraint FK_2123_MOTIFABSENCE foreign key (ID_MOTIABSE)
      references REF_MOTIF_ABSENCE (ID_MOTIABSE) on delete restrict on update restrict;

alter table IND_214 add constraint FK_214_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_214 add constraint FK_214_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_215 add constraint FK_215_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_215 add constraint FK_215_MOTIFENTRETIEN foreign key (ID_MOTIENTR)
      references REF_MOTIF_ENTRETIEN (ID_MOTIENTR) on delete restrict on update restrict;

alter table IND_221 add constraint FK_221_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_221 add constraint FK_221_CYCLETRAVAIL foreign key (ID_CYCLTRAV)
      references REF_CYCLE_TRAVAIL (ID_CYCLTRAV) on delete restrict on update restrict;

alter table IND_222 add constraint FK_222_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_222 add constraint FK_222_CONTRAINTETRAVAIL foreign key (ID_CONTTRAV)
      references REF_CONTRAINTE_TRAVAIL (ID_CONTTRAV) on delete restrict on update restrict;

alter table IND_223_1 add constraint FK_2231_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_223_1 add constraint FK_2231_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_223_2 add constraint FK_2232_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_223_2 add constraint FK_2232_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_223_3 add constraint FK_2233_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_223_3 add constraint FK_2233_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_224 add constraint FK_224_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_231 add constraint FK_231_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_311 add constraint FK_311_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_311 add constraint FK_311_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_321 add constraint FK_321_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_321 add constraint FK_321_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_331 add constraint FK_331_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_331 add constraint FK_331_EMPLOINONPERMANENT foreign key (ID_EMPLNONPERM)
      references REF_EMPLOI_NON_PERMANENT (ID_EMPLNONPERM) on delete restrict on update restrict;

alter table IND_343 add constraint FK_343_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_343 add constraint FK_343_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table IND_511 add constraint FK_511_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_511 add constraint FK_511_TYPEMISSIONPREVENTION foreign key (ID_TYPEMISSPREV)
      references REF_TYPE_MISSION_PREVENTION (ID_TYPEMISSPREV) on delete restrict on update restrict;

alter table IND_512 add constraint FK_512_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_512 add constraint FK_512_FORMATION foreign key (ID_FORM)
      references REF_FORMATION (ID_FORM) on delete restrict on update restrict;

alter table IND_521 add constraint FK_BILANSOCIALCONSOLIDE_521 foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_521 add constraint FK_CADREEMPLOI_521 foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table IND_522 add constraint FK_522_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_522 add constraint FK_522_INAPTITUDE foreign key (ID_INAP)
      references REF_INAPTITUDE (ID_INAP) on delete restrict on update restrict;

alter table IND_523 add constraint FK_523_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_523 add constraint FK_523_STATUT foreign key (ID_STAT)
      references REF_STATUT (ID_STAT) on delete restrict on update restrict;

alter table IND_531 add constraint FK_531_ACTEVIOLENCEPHYSIQUE foreign key (ID_ACTEVIOLPHYS)
      references REF_ACTE_VIOLENCE_PHYSIQUE (ID_ACTEVIOLPHYS) on delete restrict on update restrict;

alter table IND_531 add constraint FK_531_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_611_1 add constraint FK_6111_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_611_1 add constraint FK_611_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_611_1 add constraint FK_611_FORMATION foreign key (ID_FORM)
      references REF_FORMATION (ID_FORM) on delete restrict on update restrict;

alter table IND_611_2 add constraint FK_6112_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_611_2 add constraint FK_6112_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_612_1 add constraint FK_6121_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_612_1 add constraint FK_6121_EMPLOINONPERMANENT foreign key (ID_EMPLNONPERM)
      references REF_EMPLOI_NON_PERMANENT (ID_EMPLNONPERM) on delete restrict on update restrict;

alter table IND_612_2 add constraint FK_6122_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_612_2 add constraint FK_6122_EMPLOINONPERMANENT foreign key (ID_EMPLNONPERM)
      references REF_EMPLOI_NON_PERMANENT (ID_EMPLNONPERM) on delete restrict on update restrict;

alter table IND_613 add constraint FK_613_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_613 add constraint FK_613_EXPERIENCEBILANCONGEFORMATION foreign key (ID_EBCF)
      references REF_VALIDATION_EXPERIENCE (ID_EBCF) on delete restrict on update restrict;

alter table IND_712 add constraint FK_712_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_713 add constraint FK_713_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_713 add constraint FK_713_MOTIFGREVE foreign key (ID_MOTIGREV)
      references REF_MOTIF_GREVE (ID_MOTIGREV) on delete restrict on update restrict;

alter table IND_814_1 add constraint FK_8141_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_814_1 add constraint FK_8141_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_814_2 add constraint FK_8142_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_814_2 add constraint FK_8142_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table IND_RAST_AT add constraint FK_RASTAT_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_RAST_AT add constraint FK_RASTAT_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table IND_RAST_MP add constraint FK_RASTMP_BILANSOCIALCONSOLIDE foreign key (ID_BILASOCICONS)
      references BILAN_SOCIAL_CONSOLIDE (ID_BILASOCICONS) on delete restrict on update restrict;

alter table IND_RAST_MP add constraint FK_RASTMP_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table INFORMATION_GENERALE add constraint FK_INFORMATIONSGENERALES_BILANSOCIALAGENT foreign key (ID_BILASOCIAGEN)
      references BILAN_SOCIAL_AGENT (ID_BILASOCIAGEN) on delete restrict on update restrict;

alter table PREVOYANCE add constraint FK_PREVOYANCE_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table PREVOYANCE add constraint FK_PREVOYANCE_INFOCOLLAGENT foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table REF_CADRE_EMPLOI add constraint FK_CADREEMPLOI_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table REF_CADRE_EMPLOI add constraint FK_CADREEMPLOI_FILIERE foreign key (ID_FILI)
      references REF_FILIERE (ID_FILI) on delete restrict on update restrict;

alter table REF_GRADE add constraint FK_GRADE_CADREEMPLOI foreign key (ID_CADREMPL)
      references REF_CADRE_EMPLOI (ID_CADREMPL) on delete restrict on update restrict;

alter table REF_MOTIF_ARRIVEE add constraint FK_MOTIFARRIVEE_STATUT foreign key (ID_STAT)
      references REF_STATUT (ID_STAT) on delete restrict on update restrict;

alter table REF_MOTIF_DEPART add constraint FK_STATUT_MOTIFDEPART foreign key (ID_STAT)
      references REF_STATUT (ID_STAT) on delete restrict on update restrict;

alter table REF_POSITION_STATUTAIRE add constraint FK_STATUT_POSITIONSTATUTAIRE foreign key (ID_STAT)
      references REF_STATUT (ID_STAT) on delete restrict on update restrict;

alter table REF_TYPE_MISSION_PREVENTION add constraint FK_TYPECOLLECTIVITE_TYPEMISSIONPREVENTION foreign key (ID_TYPE_COLL)
      references REF_TYPE_COLLECTIVITE (ID_TYPE_COLL) on delete restrict on update restrict;

alter table SANTE add constraint FK_SANTE_CATEGORIE foreign key (ID_CATE)
      references REF_CATEGORIE (ID_CATE) on delete restrict on update restrict;

alter table SANTE add constraint FK_SANTE_INFOCOLLAGENT foreign key (ID_INFOCOLLAGEN)
      references INFORMATION_COLECTIVITE_AGENT (ID_INFOCOLLAGEN) on delete restrict on update restrict;

alter table UTILISATEUR add constraint FK_COLLECTIVITE_UTILISATEUR foreign key (ID_COLL)
      references COLLECTIVITE (ID_COLL) on delete restrict on update restrict;

alter table UTILISATEUR add constraint FK_PROFIL_UTILISATEUR foreign key (ID_PROF)
      references PROFIL (ID_PROF) on delete restrict on update restrict;

alter table UTILISATEUR add constraint FK_UTILISATEUR_CDG foreign key (ID_CDG)
      references CDG (ID_CDG) on delete restrict on update restrict;

alter table UTILISATEUR_DROITS add constraint FK_UTILISATEURDROITS_DEPARTEMENT foreign key (ID_DEPA)
      references DEPARTEMENT (ID_DEPA) on delete restrict on update restrict;

alter table UTILISATEUR_DROITS add constraint FK_UTILISATEURDROITS_DROITS foreign key (ID_DROI)
      references DROITS (ID_DROI) on delete restrict on update restrict;

alter table UTILISATEUR_DROITS add constraint FK_UTILISATEURDROITS_UTILISATEUR foreign key (ID_UTIL)
      references UTILISATEUR (ID_UTIL) on delete restrict on update restrict;

