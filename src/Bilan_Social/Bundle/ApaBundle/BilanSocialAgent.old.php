<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * BilanSocialAgent
 */
class BilanSocialAgent {

    /**
     * @var integer
     */
    private $idColl;

    /**
     * @var integer
     */
    private $idEnqu;

    /**
     *
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent
     */
    private $AbsenceArretAgent;

    /**
     * @var integer
     */
    private $idInfogene;

    /**
     * @var integer
     */
    private $idInfocollagen;

    /**
     * @var string
     */
    private $lbNom;

    /**
     * @var string
     */
    private $lbPren;

    /**
     * @var string
     */
    private $lbDatenais;

    /**
     * @var string
     */
    private $cdSexe;

    /**
     * @var boolean
     */
    private $blBoeth;

    /**
     * @var boolean
     */
    private $blAgenremu3112;

    /**
     * @var boolean
     */
    private $blAgenremuanne;

    /**
     * @var boolean
     */
    private $blAgenarriannecoll;

    /**
     * @var boolean
     */
    private $blEmplfonc;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade
     */
    private $idGraddeta;

    /**
     * @var integer
     */
    private $idCadrempldeta;

    /**
     * @var \DateTime
     */
    private $dtDetaemplfonc;

    /**
     * @var integer
     */
    private $idStruorigposistat;

    /**
     * @var boolean
     */
    private $blAcqustatanne;

    /**
     * @var boolean
     */
    private $blAgentitustaganne;

    /**
     * @var boolean
     */
    private $blTituloisauvaanne;

    /**
     * @var boolean
     */
    private $blRecrsansconcseleprof;

    /**
     * @var string
     */
    private $lbDatedepacoll;

    /**
     * @var integer
     */
    private $idMotidepa;

    /**
     * @var string
     */
    private $cdMotidece;

    /**
     * @var boolean
     */
    private $blMouvinteanne;

    /**
     * @var boolean
     */
    private $blPromavanstaganne;

    /**
     * @var boolean
     */
    private $blTempcomp;

    /**
     * @var boolean
     */
    private $blTempplein;

    /**
     * @var integer
     */
    private $nbDemapart;

    /**
     * @var integer
     */
    private $nbDemapartacce;

    /**
     * @var integer
     */
    private $nbPremdemasati;

    /**
     * @var integer
     */
    private $nbModiemplpermtempcomp;

    /**
     * @var integer
     */
    private $nbAgenempltempcompnonrenou;

    /**
     * @var float
     */
    private $nmHeurremuanne;

    /**
     * @var string
     */
    private $mtRemuannubrut;

    /**
     * @var string
     */
    private $mtTotaremuprimindem;

    /**
     * @var string
     */
    private $mtTotaremubrutnbi;

    /**
     * @var string
     */
    private $mtTotaremubrutheursupp;

    /**
     * @var float
     */
    private $nbHeursupp;

    /**
     * @var float
     */
    private $nbHeurcomprealremu;

    /**
     * @var boolean
     */
    private $blAgenabse;

    /**
     * @var integer
     */
    private $nbAllotempinac;

    /**
     * @var integer
     */
    private $nbAllotempinva;

    /**
     * @var boolean
     */
    private $blCongpateaccuenfa;

    /**
     * @var integer
     */
    private $nbJourcongpateaccuenfa;

    /**
     * @var boolean
     */
    private $blEntrdepacong;

    /**
     * @var integer
     */
    private $idMotientrdepacong;

    /**
     * @var boolean
     */
    private $blEntrretocong;

    /**
     * @var integer
     */
    private $idMotientrretocong;

    /**
     * @var boolean
     */
    private $blCet;

    /**
     * @var integer
     */
    private $nbJourcumu3112;

    /**
     * @var integer
     */
    private $nbJourvers3112;

    /**
     * @var integer
     */
    private $nbJourdepe3112;

    /**
     * @var integer
     */
    private $nbJourinde3112;

    /**
     * @var integer
     */
    private $nbJourprisrafp3112;

    /**
     * @var boolean
     */
    private $blTeletrav;

    /**
     * @var boolean
     */
    private $blAgenprev;

    /**
     * @var boolean
     */
    private $blDemainap;

    /**
     * @var integer
     */
    private $idInapdema;

    /**
     * @var boolean
     */
    private $blDeciinap;

    /**
     * @var integer
     */
    private $idInapdeci;

    /**
     * @var boolean
     */
    private $blFormsuiv;

    /**
     * @var boolean
     */
    private $blVae;

    /**
     * @var integer
     */
    private $idEbcf;

    /**
     * @var boolean
     */
    private $blBilacomp;

    /**
     * @var integer
     */
    private $nbBilacomp;

    /**
     * @var boolean
     */
    private $blCongform;

    /**
     * @var boolean
     */
    private $blCdi;

    /**
     * @var integer
     */
    private $idTypecdd;

    /**
     * @var string
     */
    private $fgStat;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $idBilasociagen;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire
     */
    private $refPositionStatutaire;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    private $refStatut;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFonctionPublique
     */
    private $refFonctionPublique;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel
     */
    private $refEmploiFonctionnel;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    private $refCategorie;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    private $refFiliere;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    private $refCadreEmploi;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade
     */
    private $refGrade;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee
     */
    private $refMotifArrivee;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation
     */
    private $refStageTitularisation;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours
     */
    private $refAvancementPromotionConcours;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet
     */
    private $refTempsNonComplet;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsPartiel
     */
    private $refTempsPartiel;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPourcentageTempaPartiel
     */
    private $refPourcentageTempaPartiel;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCycleTravail
     */
    private $refCycleTravail;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention
     */
    private $refTypeMissionPrevention;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    private $refEmploiNonPermanent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine
     */
    private $refStructureOrigine;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $refContrainteTravail;

    /**
     * Constructor
     */
    public function __construct() {
        $this->refContrainteTravail = new \Doctrine\Common\Collections\ArrayCollection();
        $this->AbsenceArretAgent = new \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent;
    }

    /**
     * Set idColl
     *
     * @param integer $idColl
     *
     * @return BilanSocialAgent
     */
    public function setIdColl($idColl) {
        $this->idColl = $idColl;

        return $this;
    }

    /**
     * Get idColl
     *
     * @return integer
     */
    public function getIdColl() {
        return $this->idColl;
    }

    /**
     * Set idEnqu
     *
     * @param integer $idEnqu
     *
     * @return BilanSocialAgent
     */
    public function setIdEnqu($idEnqu) {
        $this->idEnqu = $idEnqu;

        return $this;
    }

    /**
     * Get idEnqu
     *
     * @return integer
     */
    public function getIdEnqu() {
        return $this->idEnqu;
    }

    /**
     * Set idInfogene
     *
     * @param integer $idInfogene
     *
     * @return BilanSocialAgent
     */
    public function setIdInfogene($idInfogene) {
        $this->idInfogene = $idInfogene;

        return $this;
    }

    /**
     * Get idInfogene
     *
     * @return integer
     */
    public function getIdInfogene() {
        return $this->idInfogene;
    }

    /**
     * Set idInfocollagen
     *
     * @param integer $idInfocollagen
     *
     * @return BilanSocialAgent
     */
    public function setIdInfocollagen($idInfocollagen) {
        $this->idInfocollagen = $idInfocollagen;

        return $this;
    }

    /**
     * Get idInfocollagen
     *
     * @return integer
     */
    public function getIdInfocollagen() {
        return $this->idInfocollagen;
    }

    /**
     * Set lbNom
     *
     * @param string $lbNom
     *
     * @return BilanSocialAgent
     */
    public function setLbNom($lbNom) {
        $this->lbNom = $lbNom;

        return $this;
    }

    /**
     * Get lbNom
     *
     * @return string
     */
    public function getLbNom() {
        return $this->lbNom;
    }

    /**
     * Set lbPren
     *
     * @param string $lbPren
     *
     * @return BilanSocialAgent
     */
    public function setLbPren($lbPren) {
        $this->lbPren = $lbPren;

        return $this;
    }

    /**
     * Get lbPren
     *
     * @return string
     */
    public function getLbPren() {
        return $this->lbPren;
    }

    /**
     * Set lbDatenais
     *
     * @param string $lbDatenais
     *
     * @return BilanSocialAgent
     */
    public function setLbDatenais($lbDatenais) {
        $this->lbDatenais = $lbDatenais;

        return $this;
    }

    /**
     * Get lbDatenais
     *
     * @return string
     */
    public function getLbDatenais() {
        return $this->lbDatenais;
    }

    /**
     * Set cdSexe
     *
     * @param string $cdSexe
     *
     * @return BilanSocialAgent
     */
    public function setCdSexe($cdSexe) {
        $this->cdSexe = $cdSexe;

        return $this;
    }

    /**
     * Get cdSexe
     *
     * @return string
     */
    public function getCdSexe() {
        return $this->cdSexe;
    }

    /**
     * Set blBoeth
     *
     * @param boolean $blBoeth
     *
     * @return BilanSocialAgent
     */
    public function setBlBoeth($blBoeth) {
        $this->blBoeth = $blBoeth;

        return $this;
    }

    /**
     * Get blBoeth
     *
     * @return boolean
     */
    public function getBlBoeth() {
        return $this->blBoeth;
    }

    /**
     * Set blAgenremu3112
     *
     * @param boolean $blAgenremu3112
     *
     * @return BilanSocialAgent
     */
    public function setBlAgenremu3112($blAgenremu3112) {
        $this->blAgenremu3112 = $blAgenremu3112;

        return $this;
    }

    /**
     * Get blAgenremu3112
     *
     * @return boolean
     */
    public function getBlAgenremu3112() {
        return $this->blAgenremu3112;
    }

    /**
     * Set blAgenremuanne
     *
     * @param boolean $blAgenremuanne
     *
     * @return BilanSocialAgent
     */
    public function setBlAgenremuanne($blAgenremuanne) {
        $this->blAgenremuanne = $blAgenremuanne;

        return $this;
    }

    /**
     * Get blAgenremuanne
     *
     * @return boolean
     */
    public function getBlAgenremuanne() {
        return $this->blAgenremuanne;
    }

    /**
     * Set blAgenarriannecoll
     *
     * @param boolean $blAgenarriannecoll
     *
     * @return BilanSocialAgent
     */
    public function setBlAgenarriannecoll($blAgenarriannecoll) {
        $this->blAgenarriannecoll = $blAgenarriannecoll;

        return $this;
    }

    /**
     * Get blAgenarriannecoll
     *
     * @return boolean
     */
    public function getBlAgenarriannecoll() {
        return $this->blAgenarriannecoll;
    }

    /**
     * Set blEmplfonc
     *
     * @param boolean $blEmplfonc
     *
     * @return BilanSocialAgent
     */
    public function setBlEmplfonc($blEmplfonc) {
        $this->blEmplfonc = $blEmplfonc;

        return $this;
    }

    /**
     * Get blEmplfonc
     *
     * @return boolean
     */
    public function getBlEmplfonc() {
        return $this->blEmplfonc;
    }

    /**
     * Set $IdGraddeta
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade $IdGraddeta
     *
     * @return BilanSocialAgent
     */
    public function setIdGraddeta(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade $IdGraddeta = null) {

        $this->idGraddeta = $IdGraddeta->getIdGrad();

        return $this;
    }

    /**
     * Get idGraddeta
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade
     */
    public function getIdGraddeta() {
        return $this->idGraddeta;
    }

    /**
     * Set idCadrempldeta
     *
     * @param integer $idCadrempldeta
     *
     * @return BilanSocialAgent
     */
    public function setIdCadrempldeta($idCadrempldeta) {
        $this->idCadrempldeta = $idCadrempldeta;

        return $this;
    }

    /**
     * Get idCadrempldeta
     *
     * @return integer
     */
    public function getIdCadrempldeta() {
        return $this->idCadrempldeta;
    }

    /**
     * Set dtDetaemplfonc
     *
     * @param \DateTime $dtDetaemplfonc
     *
     * @return BilanSocialAgent
     */
    public function setDtDetaemplfonc($dtDetaemplfonc) {
        $this->dtDetaemplfonc = $dtDetaemplfonc;

        return $this;
    }

    /**
     * Get dtDetaemplfonc
     *
     * @return \DateTime
     */
    public function getDtDetaemplfonc() {
        return $this->dtDetaemplfonc;
    }

    /**
     * Set idStruorigposistat
     *
     * @param integer $idStruorigposistat
     *
     * @return BilanSocialAgent
     */
    public function setIdStruorigposistat($idStruorigposistat) {
        $this->idStruorigposistat = $idStruorigposistat;

        return $this;
    }

    /**
     * Get idStruorigposistat
     *
     * @return integer
     */
    public function getIdStruorigposistat() {
        return $this->idStruorigposistat;
    }

    /**
     * Set blAcqustatanne
     *
     * @param boolean $blAcqustatanne
     *
     * @return BilanSocialAgent
     */
    public function setBlAcqustatanne($blAcqustatanne) {
        $this->blAcqustatanne = $blAcqustatanne;

        return $this;
    }

    /**
     * Get blAcqustatanne
     *
     * @return boolean
     */
    public function getBlAcqustatanne() {
        return $this->blAcqustatanne;
    }

    /**
     * Set blAgentitustaganne
     *
     * @param boolean $blAgentitustaganne
     *
     * @return BilanSocialAgent
     */
    public function setBlAgentitustaganne($blAgentitustaganne) {
        $this->blAgentitustaganne = $blAgentitustaganne;

        return $this;
    }

    /**
     * Get blAgentitustaganne
     *
     * @return boolean
     */
    public function getBlAgentitustaganne() {
        return $this->blAgentitustaganne;
    }

    /**
     * Set blTituloisauvaanne
     *
     * @param boolean $blTituloisauvaanne
     *
     * @return BilanSocialAgent
     */
    public function setBlTituloisauvaanne($blTituloisauvaanne) {
        $this->blTituloisauvaanne = $blTituloisauvaanne;

        return $this;
    }

    /**
     * Get blTituloisauvaanne
     *
     * @return boolean
     */
    public function getBlTituloisauvaanne() {
        return $this->blTituloisauvaanne;
    }

    /**
     * Set blRecrsansconcseleprof
     *
     * @param boolean $blRecrsansconcseleprof
     *
     * @return BilanSocialAgent
     */
    public function setBlRecrsansconcseleprof($blRecrsansconcseleprof) {
        $this->blRecrsansconcseleprof = $blRecrsansconcseleprof;

        return $this;
    }

    /**
     * Get blRecrsansconcseleprof
     *
     * @return boolean
     */
    public function getBlRecrsansconcseleprof() {
        return $this->blRecrsansconcseleprof;
    }

    /**
     * Set lbDatedepacoll
     *
     * @param string $lbDatedepacoll
     *
     * @return BilanSocialAgent
     */
    public function setLbDatedepacoll($lbDatedepacoll) {
        $this->lbDatedepacoll = $lbDatedepacoll;

        return $this;
    }

    /**
     * Get lbDatedepacoll
     *
     * @return string
     */
    public function getLbDatedepacoll() {
        return $this->lbDatedepacoll;
    }

    /**
     * Set idMotidepa
     *
     * @param integer $idMotidepa
     *
     * @return BilanSocialAgent
     */
    public function setIdMotidepa($idMotidepa) {
        $this->idMotidepa = $idMotidepa;

        return $this;
    }

    /**
     * Get idMotidepa
     *
     * @return integer
     */
    public function getIdMotidepa() {
        return $this->idMotidepa;
    }

    /**
     * Set cdMotidece
     *
     * @param string $cdMotidece
     *
     * @return BilanSocialAgent
     */
    public function setCdMotidece($cdMotidece) {
        $this->cdMotidece = $cdMotidece;

        return $this;
    }

    /**
     * Get cdMotidece
     *
     * @return string
     */
    public function getCdMotidece() {
        return $this->cdMotidece;
    }

    /**
     * Set blMouvinteanne
     *
     * @param boolean $blMouvinteanne
     *
     * @return BilanSocialAgent
     */
    public function setBlMouvinteanne($blMouvinteanne) {
        $this->blMouvinteanne = $blMouvinteanne;

        return $this;
    }

    /**
     * Get blMouvinteanne
     *
     * @return boolean
     */
    public function getBlMouvinteanne() {
        return $this->blMouvinteanne;
    }

    /**
     * Set blPromavanstaganne
     *
     * @param boolean $blPromavanstaganne
     *
     * @return BilanSocialAgent
     */
    public function setBlPromavanstaganne($blPromavanstaganne) {
        $this->blPromavanstaganne = $blPromavanstaganne;

        return $this;
    }

    /**
     * Get blPromavanstaganne
     *
     * @return boolean
     */
    public function getBlPromavanstaganne() {
        return $this->blPromavanstaganne;
    }

    /**
     * Set blTempcomp
     *
     * @param boolean $blTempcomp
     *
     * @return BilanSocialAgent
     */
    public function setBlTempcomp($blTempcomp) {
        $this->blTempcomp = $blTempcomp;

        return $this;
    }

    /**
     * Get blTempcomp
     *
     * @return boolean
     */
    public function getBlTempcomp() {
        return $this->blTempcomp;
    }

    /**
     * Set blTempplein
     *
     * @param boolean $blTempplein
     *
     * @return BilanSocialAgent
     */
    public function setBlTempplein($blTempplein) {
        $this->blTempplein = $blTempplein;

        return $this;
    }

    /**
     * Get blTempplein
     *
     * @return boolean
     */
    public function getBlTempplein() {
        return $this->blTempplein;
    }

    /**
     * Set nbDemapart
     *
     * @param integer $nbDemapart
     *
     * @return BilanSocialAgent
     */
    public function setNbDemapart($nbDemapart) {
        $this->nbDemapart = $nbDemapart;

        return $this;
    }

    /**
     * Get nbDemapart
     *
     * @return integer
     */
    public function getNbDemapart() {
        return $this->nbDemapart;
    }

    /**
     * Set nbDemapartacce
     *
     * @param integer $nbDemapartacce
     *
     * @return BilanSocialAgent
     */
    public function setNbDemapartacce($nbDemapartacce) {
        $this->nbDemapartacce = $nbDemapartacce;

        return $this;
    }

    /**
     * Get nbDemapartacce
     *
     * @return integer
     */
    public function getNbDemapartacce() {
        return $this->nbDemapartacce;
    }

    /**
     * Set nbPremdemasati
     *
     * @param integer $nbPremdemasati
     *
     * @return BilanSocialAgent
     */
    public function setNbPremdemasati($nbPremdemasati) {
        $this->nbPremdemasati = $nbPremdemasati;

        return $this;
    }

    /**
     * Get nbPremdemasati
     *
     * @return integer
     */
    public function getNbPremdemasati() {
        return $this->nbPremdemasati;
    }

    /**
     * Set nbModiemplpermtempcomp
     *
     * @param integer $nbModiemplpermtempcomp
     *
     * @return BilanSocialAgent
     */
    public function setNbModiemplpermtempcomp($nbModiemplpermtempcomp) {
        $this->nbModiemplpermtempcomp = $nbModiemplpermtempcomp;

        return $this;
    }

    /**
     * Get nbModiemplpermtempcomp
     *
     * @return integer
     */
    public function getNbModiemplpermtempcomp() {
        return $this->nbModiemplpermtempcomp;
    }

    /**
     * Set nbAgenempltempcompnonrenou
     *
     * @param integer $nbAgenempltempcompnonrenou
     *
     * @return BilanSocialAgent
     */
    public function setNbAgenempltempcompnonrenou($nbAgenempltempcompnonrenou) {
        $this->nbAgenempltempcompnonrenou = $nbAgenempltempcompnonrenou;

        return $this;
    }

    /**
     * Get nbAgenempltempcompnonrenou
     *
     * @return integer
     */
    public function getNbAgenempltempcompnonrenou() {
        return $this->nbAgenempltempcompnonrenou;
    }

    /**
     * Set nmHeurremuanne
     *
     * @param float $nmHeurremuanne
     *
     * @return BilanSocialAgent
     */
    public function setNmHeurremuanne($nmHeurremuanne) {
        $this->nmHeurremuanne = $nmHeurremuanne;

        return $this;
    }

    /**
     * Get nmHeurremuanne
     *
     * @return float
     */
    public function getNmHeurremuanne() {
        return $this->nmHeurremuanne;
    }

    /**
     * Set mtRemuannubrut
     *
     * @param string $mtRemuannubrut
     *
     * @return BilanSocialAgent
     */
    public function setMtRemuannubrut($mtRemuannubrut) {
        $this->mtRemuannubrut = $mtRemuannubrut;

        return $this;
    }

    /**
     * Get mtRemuannubrut
     *
     * @return string
     */
    public function getMtRemuannubrut() {
        return $this->mtRemuannubrut;
    }

    /**
     * Set mtTotaremuprimindem
     *
     * @param string $mtTotaremuprimindem
     *
     * @return BilanSocialAgent
     */
    public function setMtTotaremuprimindem($mtTotaremuprimindem) {
        $this->mtTotaremuprimindem = $mtTotaremuprimindem;

        return $this;
    }

    /**
     * Get mtTotaremuprimindem
     *
     * @return string
     */
    public function getMtTotaremuprimindem() {
        return $this->mtTotaremuprimindem;
    }

    /**
     * Set mtTotaremubrutnbi
     *
     * @param string $mtTotaremubrutnbi
     *
     * @return BilanSocialAgent
     */
    public function setMtTotaremubrutnbi($mtTotaremubrutnbi) {
        $this->mtTotaremubrutnbi = $mtTotaremubrutnbi;

        return $this;
    }

    /**
     * Get mtTotaremubrutnbi
     *
     * @return string
     */
    public function getMtTotaremubrutnbi() {
        return $this->mtTotaremubrutnbi;
    }

    /**
     * Set mtTotaremubrutheursupp
     *
     * @param string $mtTotaremubrutheursupp
     *
     * @return BilanSocialAgent
     */
    public function setMtTotaremubrutheursupp($mtTotaremubrutheursupp) {
        $this->mtTotaremubrutheursupp = $mtTotaremubrutheursupp;

        return $this;
    }

    /**
     * Get mtTotaremubrutheursupp
     *
     * @return string
     */
    public function getMtTotaremubrutheursupp() {
        return $this->mtTotaremubrutheursupp;
    }

    /**
     * Set nbHeursupp
     *
     * @param float $nbHeursupp
     *
     * @return BilanSocialAgent
     */
    public function setNbHeursupp($nbHeursupp) {
        $this->nbHeursupp = $nbHeursupp;

        return $this;
    }

    /**
     * Get nbHeursupp
     *
     * @return float
     */
    public function getNbHeursupp() {
        return $this->nbHeursupp;
    }

    /**
     * Set nbHeurcomprealremu
     *
     * @param float $nbHeurcomprealremu
     *
     * @return BilanSocialAgent
     */
    public function setNbHeurcomprealremu($nbHeurcomprealremu) {
        $this->nbHeurcomprealremu = $nbHeurcomprealremu;

        return $this;
    }

    /**
     * Get nbHeurcomprealremu
     *
     * @return float
     */
    public function getNbHeurcomprealremu() {
        return $this->nbHeurcomprealremu;
    }

    /**
     * Set blAgenabse
     *
     * @param boolean $blAgenabse
     *
     * @return BilanSocialAgent
     */
    public function setBlAgenabse($blAgenabse) {
        $this->blAgenabse = $blAgenabse;

        return $this;
    }

    /**
     * Get blAgenabse
     *
     * @return boolean
     */
    public function getBlAgenabse() {
        return $this->blAgenabse;
    }

    /**
     * Set nbAllotempinac
     *
     * @param integer $nbAllotempinac
     *
     * @return BilanSocialAgent
     */
    public function setNbAllotempinac($nbAllotempinac) {
        $this->nbAllotempinac = $nbAllotempinac;

        return $this;
    }

    /**
     * Get nbAllotempinac
     *
     * @return integer
     */
    public function getNbAllotempinac() {
        return $this->nbAllotempinac;
    }

    /**
     * Set nbAllotempinva
     *
     * @param integer $nbAllotempinva
     *
     * @return BilanSocialAgent
     */
    public function setNbAllotempinva($nbAllotempinva) {
        $this->nbAllotempinva = $nbAllotempinva;

        return $this;
    }

    /**
     * Get nbAllotempinva
     *
     * @return integer
     */
    public function getNbAllotempinva() {
        return $this->nbAllotempinva;
    }

    /**
     * Set blCongpateaccuenfa
     *
     * @param boolean $blCongpateaccuenfa
     *
     * @return BilanSocialAgent
     */
    public function setBlCongpateaccuenfa($blCongpateaccuenfa) {
        $this->blCongpateaccuenfa = $blCongpateaccuenfa;

        return $this;
    }

    /**
     * Get blCongpateaccuenfa
     *
     * @return boolean
     */
    public function getBlCongpateaccuenfa() {
        return $this->blCongpateaccuenfa;
    }

    /**
     * Set nbJourcongpateaccuenfa
     *
     * @param integer $nbJourcongpateaccuenfa
     *
     * @return BilanSocialAgent
     */
    public function setNbJourcongpateaccuenfa($nbJourcongpateaccuenfa) {
        $this->nbJourcongpateaccuenfa = $nbJourcongpateaccuenfa;

        return $this;
    }

    /**
     * Get nbJourcongpateaccuenfa
     *
     * @return integer
     */
    public function getNbJourcongpateaccuenfa() {
        return $this->nbJourcongpateaccuenfa;
    }

    /**
     * Set blEntrdepacong
     *
     * @param boolean $blEntrdepacong
     *
     * @return BilanSocialAgent
     */
    public function setBlEntrdepacong($blEntrdepacong) {
        $this->blEntrdepacong = $blEntrdepacong;

        return $this;
    }

    /**
     * Get blEntrdepacong
     *
     * @return boolean
     */
    public function getBlEntrdepacong() {
        return $this->blEntrdepacong;
    }

    /**
     * Set idMotientrdepacong
     *
     * @param integer $idMotientrdepacong
     *
     * @return BilanSocialAgent
     */
    public function setIdMotientrdepacong($idMotientrdepacong) {
        $this->idMotientrdepacong = $idMotientrdepacong;

        return $this;
    }

    /**
     * Get idMotientrdepacong
     *
     * @return integer
     */
    public function getIdMotientrdepacong() {
        return $this->idMotientrdepacong;
    }

    /**
     * Set blEntrretocong
     *
     * @param boolean $blEntrretocong
     *
     * @return BilanSocialAgent
     */
    public function setBlEntrretocong($blEntrretocong) {
        $this->blEntrretocong = $blEntrretocong;

        return $this;
    }

    /**
     * Get blEntrretocong
     *
     * @return boolean
     */
    public function getBlEntrretocong() {
        return $this->blEntrretocong;
    }

    /**
     * Set idMotientrretocong
     *
     * @param integer $idMotientrretocong
     *
     * @return BilanSocialAgent
     */
    public function setIdMotientrretocong($idMotientrretocong) {
        $this->idMotientrretocong = $idMotientrretocong;

        return $this;
    }

    /**
     * Get idMotientrretocong
     *
     * @return integer
     */
    public function getIdMotientrretocong() {
        return $this->idMotientrretocong;
    }

    /**
     * Set blCet
     *
     * @param boolean $blCet
     *
     * @return BilanSocialAgent
     */
    public function setBlCet($blCet) {
        $this->blCet = $blCet;

        return $this;
    }

    /**
     * Get blCet
     *
     * @return boolean
     */
    public function getBlCet() {
        return $this->blCet;
    }

    /**
     * Set nbJourcumu3112
     *
     * @param integer $nbJourcumu3112
     *
     * @return BilanSocialAgent
     */
    public function setNbJourcumu3112($nbJourcumu3112) {
        $this->nbJourcumu3112 = $nbJourcumu3112;

        return $this;
    }

    /**
     * Get nbJourcumu3112
     *
     * @return integer
     */
    public function getNbJourcumu3112() {
        return $this->nbJourcumu3112;
    }

    /**
     * Set nbJourvers3112
     *
     * @param integer $nbJourvers3112
     *
     * @return BilanSocialAgent
     */
    public function setNbJourvers3112($nbJourvers3112) {
        $this->nbJourvers3112 = $nbJourvers3112;

        return $this;
    }

    /**
     * Get nbJourvers3112
     *
     * @return integer
     */
    public function getNbJourvers3112() {
        return $this->nbJourvers3112;
    }

    /**
     * Set nbJourdepe3112
     *
     * @param integer $nbJourdepe3112
     *
     * @return BilanSocialAgent
     */
    public function setNbJourdepe3112($nbJourdepe3112) {
        $this->nbJourdepe3112 = $nbJourdepe3112;

        return $this;
    }

    /**
     * Get nbJourdepe3112
     *
     * @return integer
     */
    public function getNbJourdepe3112() {
        return $this->nbJourdepe3112;
    }

    /**
     * Set nbJourinde3112
     *
     * @param integer $nbJourinde3112
     *
     * @return BilanSocialAgent
     */
    public function setNbJourinde3112($nbJourinde3112) {
        $this->nbJourinde3112 = $nbJourinde3112;

        return $this;
    }

    /**
     * Get nbJourinde3112
     *
     * @return integer
     */
    public function getNbJourinde3112() {
        return $this->nbJourinde3112;
    }

    /**
     * Set nbJourprisrafp3112
     *
     * @param integer $nbJourprisrafp3112
     *
     * @return BilanSocialAgent
     */
    public function setNbJourprisrafp3112($nbJourprisrafp3112) {
        $this->nbJourprisrafp3112 = $nbJourprisrafp3112;

        return $this;
    }

    /**
     * Get nbJourprisrafp3112
     *
     * @return integer
     */
    public function getNbJourprisrafp3112() {
        return $this->nbJourprisrafp3112;
    }

    /**
     * Set blTeletrav
     *
     * @param boolean $blTeletrav
     *
     * @return BilanSocialAgent
     */
    public function setBlTeletrav($blTeletrav) {
        $this->blTeletrav = $blTeletrav;

        return $this;
    }

    /**
     * Get blTeletrav
     *
     * @return boolean
     */
    public function getBlTeletrav() {
        return $this->blTeletrav;
    }

    /**
     * Set blAgenprev
     *
     * @param boolean $blAgenprev
     *
     * @return BilanSocialAgent
     */
    public function setBlAgenprev($blAgenprev) {
        $this->blAgenprev = $blAgenprev;

        return $this;
    }

    /**
     * Get blAgenprev
     *
     * @return boolean
     */
    public function getBlAgenprev() {
        return $this->blAgenprev;
    }

    /**
     * Set blDemainap
     *
     * @param boolean $blDemainap
     *
     * @return BilanSocialAgent
     */
    public function setBlDemainap($blDemainap) {
        $this->blDemainap = $blDemainap;

        return $this;
    }

    /**
     * Get blDemainap
     *
     * @return boolean
     */
    public function getBlDemainap() {
        return $this->blDemainap;
    }

    /**
     * Set idInapdema
     *
     * @param integer $idInapdema
     *
     * @return BilanSocialAgent
     */
    public function setIdInapdema($idInapdema) {
        $this->idInapdema = $idInapdema;

        return $this;
    }

    /**
     * Get idInapdema
     *
     * @return integer
     */
    public function getIdInapdema() {
        return $this->idInapdema;
    }

    /**
     * Set blDeciinap
     *
     * @param boolean $blDeciinap
     *
     * @return BilanSocialAgent
     */
    public function setBlDeciinap($blDeciinap) {
        $this->blDeciinap = $blDeciinap;

        return $this;
    }

    /**
     * Get blDeciinap
     *
     * @return boolean
     */
    public function getBlDeciinap() {
        return $this->blDeciinap;
    }

    /**
     * Set idInapdeci
     *
     * @param integer $idInapdeci
     *
     * @return BilanSocialAgent
     */
    public function setIdInapdeci($idInapdeci) {
        $this->idInapdeci = $idInapdeci;

        return $this;
    }

    /**
     * Get idInapdeci
     *
     * @return integer
     */
    public function getIdInapdeci() {
        return $this->idInapdeci;
    }

    /**
     * Set blFormsuiv
     *
     * @param boolean $blFormsuiv
     *
     * @return BilanSocialAgent
     */
    public function setBlFormsuiv($blFormsuiv) {
        $this->blFormsuiv = $blFormsuiv;

        return $this;
    }

    /**
     * Get blFormsuiv
     *
     * @return boolean
     */
    public function getBlFormsuiv() {
        return $this->blFormsuiv;
    }

    /**
     * Set blVae
     *
     * @param boolean $blVae
     *
     * @return BilanSocialAgent
     */
    public function setBlVae($blVae) {
        $this->blVae = $blVae;

        return $this;
    }

    /**
     * Get blVae
     *
     * @return boolean
     */
    public function getBlVae() {
        return $this->blVae;
    }

    /**
     * Set idEbcf
     *
     * @param integer $idEbcf
     *
     * @return BilanSocialAgent
     */
    public function setIdEbcf($idEbcf) {
        $this->idEbcf = $idEbcf;

        return $this;
    }

    /**
     * Get idEbcf
     *
     * @return integer
     */
    public function getIdEbcf() {
        return $this->idEbcf;
    }

    /**
     * Set blBilacomp
     *
     * @param boolean $blBilacomp
     *
     * @return BilanSocialAgent
     */
    public function setBlBilacomp($blBilacomp) {
        $this->blBilacomp = $blBilacomp;

        return $this;
    }

    /**
     * Get blBilacomp
     *
     * @return boolean
     */
    public function getBlBilacomp() {
        return $this->blBilacomp;
    }

    /**
     * Set nbBilacomp
     *
     * @param integer $nbBilacomp
     *
     * @return BilanSocialAgent
     */
    public function setNbBilacomp($nbBilacomp) {
        $this->nbBilacomp = $nbBilacomp;

        return $this;
    }

    /**
     * Get nbBilacomp
     *
     * @return integer
     */
    public function getNbBilacomp() {
        return $this->nbBilacomp;
    }

    /**
     * Set blCongform
     *
     * @param boolean $blCongform
     *
     * @return BilanSocialAgent
     */
    public function setBlCongform($blCongform) {
        $this->blCongform = $blCongform;

        return $this;
    }

    /**
     * Get blCongform
     *
     * @return boolean
     */
    public function getBlCongform() {
        return $this->blCongform;
    }

    /**
     * Set blCdi
     *
     * @param boolean $blCdi
     *
     * @return BilanSocialAgent
     */
    public function setBlCdi($blCdi) {
        $this->blCdi = $blCdi;

        return $this;
    }

    /**
     * Get blCdi
     *
     * @return boolean
     */
    public function getBlCdi() {
        return $this->blCdi;
    }

    /**
     * Set idTypecdd
     *
     * @param integer $idTypecdd
     *
     * @return BilanSocialAgent
     */
    public function setIdTypecdd($idTypecdd) {
        $this->idTypecdd = $idTypecdd;

        return $this;
    }

    /**
     * Get idTypecdd
     *
     * @return integer
     */
    public function getIdTypecdd() {
        return $this->idTypecdd;
    }

    /**
     * Set fgStat
     *
     * @param string $fgStat
     *
     * @return BilanSocialAgent
     */
    public function setFgStat($fgStat) {
        $this->fgStat = $fgStat;

        return $this;
    }

    /**
     * Get fgStat
     *
     * @return string
     */
    public function getFgStat() {
        return $this->fgStat;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return BilanSocialAgent
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return BilanSocialAgent
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Get idBilasociagen
     *
     * @return integer
     */
    public function getIdBilasociagen() {
        return $this->idBilasociagen;
    }

    /**
     * Set refPositionStatutaire
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutaire
     *
     * @return BilanSocialAgent
     */
    public function setRefPositionStatutaire(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutaire = null) {
        $this->refPositionStatutaire = $refPositionStatutaire;

        return $this;
    }

    /**
     * Get refPositionStatutaire
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire
     */
    public function getRefPositionStatutaire() {
        return $this->refPositionStatutaire;
    }

    /**
     * Set refStatut
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $refStatut
     *
     * @return BilanSocialAgent
     */
    public function setRefStatut(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $refStatut = null) {
        $this->refStatut = $refStatut;

        return $this;
    }

    /**
     * Get refStatut
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    public function getRefStatut() {
        return $this->refStatut;
    }

    /**
     * Set refFonctionPublique
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFonctionPublique $refFonctionPublique
     *
     * @return BilanSocialAgent
     */
    public function setRefFonctionPublique(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFonctionPublique $refFonctionPublique = null) {
        $this->refFonctionPublique = $refFonctionPublique;

        return $this;
    }

    /**
     * Get refFonctionPublique
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFonctionPublique
     */
    public function getRefFonctionPublique() {
        return $this->refFonctionPublique;
    }

    /**
     * Set refEmploiFonctionnel
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel $refEmploiFonctionnel
     *
     * @return BilanSocialAgent
     */
    public function setRefEmploiFonctionnel(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel $refEmploiFonctionnel = null) {
        $this->refEmploiFonctionnel = $refEmploiFonctionnel;

        return $this;
    }

    /**
     * Get refEmploiFonctionnel
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel
     */
    public function getRefEmploiFonctionnel() {
        return $this->refEmploiFonctionnel;
    }

    /**
     * Set refCategorie
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie
     *
     * @return BilanSocialAgent
     */
    public function setRefCategorie(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie = null) {
        $this->refCategorie = $refCategorie;

        return $this;
    }

    /**
     * Get refCategorie
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    public function getRefCategorie() {
        return $this->refCategorie;
    }

    /**
     * Set refFiliere
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
     *
     * @return BilanSocialAgent
     */
    public function setRefFiliere(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere = null) {
        $this->refFiliere = $refFiliere;

        return $this;
    }

    /**
     * Get refFiliere
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getRefFiliere() {
        return $this->refFiliere;
    }

    /**
     * Set refCadreEmploi
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploi
     *
     * @return BilanSocialAgent
     */
    public function setRefCadreEmploi(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploi = null) {
        $this->refCadreEmploi = $refCadreEmploi;

        return $this;
    }

    /**
     * Get refCadreEmploi
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    public function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    /**
     * Set refGrade
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade $refGrade
     *
     * @return BilanSocialAgent
     */
    public function setRefGrade(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade $refGrade = null) {
        $this->refGrade = $refGrade;

        return $this;
    }

    /**
     * Get refGrade
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade
     */
    public function getRefGrade() {
        return $this->refGrade;
    }

    /**
     * Set refMotifArrivee
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee $refMotifArrivee
     *
     * @return BilanSocialAgent
     */
    public function setRefMotifArrivee(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee $refMotifArrivee = null) {
        $this->refMotifArrivee = $refMotifArrivee;

        return $this;
    }

    /**
     * Get refMotifArrivee
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee
     */
    public function getRefMotifArrivee() {
        return $this->refMotifArrivee;
    }

    /**
     * Set refStageTitularisation
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation $refStageTitularisation
     *
     * @return BilanSocialAgent
     */
    public function setRefStageTitularisation(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation $refStageTitularisation = null) {
        $this->refStageTitularisation = $refStageTitularisation;

        return $this;
    }

    /**
     * Get refStageTitularisation
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation
     */
    public function getRefStageTitularisation() {
        return $this->refStageTitularisation;
    }

    /**
     * Set refAvancementPromotionConcours
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours $refAvancementPromotionConcours
     *
     * @return BilanSocialAgent
     */
    public function setRefAvancementPromotionConcours(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours $refAvancementPromotionConcours = null) {
        $this->refAvancementPromotionConcours = $refAvancementPromotionConcours;

        return $this;
    }

    /**
     * Get refAvancementPromotionConcours
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours
     */
    public function getRefAvancementPromotionConcours() {
        return $this->refAvancementPromotionConcours;
    }

    /**
     * Set refTempsNonComplet
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet $refTempsNonComplet
     *
     * @return BilanSocialAgent
     */
    public function setRefTempsNonComplet(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet $refTempsNonComplet = null) {
        $this->refTempsNonComplet = $refTempsNonComplet;

        return $this;
    }

    /**
     * Get refTempsNonComplet
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet
     */
    public function getRefTempsNonComplet() {
        return $this->refTempsNonComplet;
    }

    /**
     * Set refTempsPartiel
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsPartiel $refTempsPartiel
     *
     * @return BilanSocialAgent
     */
    public function setRefTempsPartiel(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsPartiel $refTempsPartiel = null) {
        $this->refTempsPartiel = $refTempsPartiel;

        return $this;
    }

    /**
     * Get refTempsPartiel
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsPartiel
     */
    public function getRefTempsPartiel() {
        return $this->refTempsPartiel;
    }

    /**
     * Set refPourcentageTempaPartiel
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPourcentageTempaPartiel $refPourcentageTempaPartiel
     *
     * @return BilanSocialAgent
     */
    public function setRefPourcentageTempaPartiel(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefPourcentageTempaPartiel $refPourcentageTempaPartiel = null) {
        $this->refPourcentageTempaPartiel = $refPourcentageTempaPartiel;

        return $this;
    }

    /**
     * Get refPourcentageTempaPartiel
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPourcentageTempaPartiel
     */
    public function getRefPourcentageTempaPartiel() {
        return $this->refPourcentageTempaPartiel;
    }

    /**
     * Set refCycleTravail
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCycleTravail $refCycleTravail
     *
     * @return BilanSocialAgent
     */
    public function setRefCycleTravail(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCycleTravail $refCycleTravail = null) {
        $this->refCycleTravail = $refCycleTravail;

        return $this;
    }

    /**
     * Get refCycleTravail
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCycleTravail
     */
    public function getRefCycleTravail() {
        return $this->refCycleTravail;
    }

    /**
     * Set refTypeMissionPrevention
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention $refTypeMissionPrevention
     *
     * @return BilanSocialAgent
     */
    public function setRefTypeMissionPrevention(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention $refTypeMissionPrevention = null) {
        $this->refTypeMissionPrevention = $refTypeMissionPrevention;

        return $this;
    }

    /**
     * Get refTypeMissionPrevention
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention
     */
    public function getRefTypeMissionPrevention() {
        return $this->refTypeMissionPrevention;
    }

    /**
     * Set refEmploiNonPermanent
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent
     *
     * @return BilanSocialAgent
     */
    public function setRefEmploiNonPermanent(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent = null) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;

        return $this;
    }

    /**
     * Get refEmploiNonPermanent
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    public function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

    /**
     * Set refStructureOrigine
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine $refStructureOrigine
     *
     * @return BilanSocialAgent
     */
    public function setRefStructureOrigine(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine $refStructureOrigine = null) {
        $this->refStructureOrigine = $refStructureOrigine;

        return $this;
    }

    /**
     * Get refStructureOrigine
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine
     */
    public function getRefStructureOrigine() {
        return $this->refStructureOrigine;
    }

    /**
     * Add refContrainteTravail
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefContrainteTravail $refContrainteTravail
     *
     * @return BilanSocialAgent
     */
    public function addRefContrainteTravail(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefContrainteTravail $refContrainteTravail) {
        $this->refContrainteTravail[] = $refContrainteTravail;

        return $this;
    }

    /**
     * Remove refContrainteTravail
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefContrainteTravail $refContrainteTravail
     */
    public function removeRefContrainteTravail(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefContrainteTravail $refContrainteTravail) {
        $this->refContrainteTravail->removeElement($refContrainteTravail);
    }

    /**
     * Get refContrainteTravail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefContrainteTravail() {
        return $this->refContrainteTravail;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

}
