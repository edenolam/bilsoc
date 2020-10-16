<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;
//@Assert\NotBlank(message = "agent.blAgenremu3112.not_blank")
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Bilan_Social\Bundle\ApaBundle\Entity\Traits\BilanSociaLAgentTrait;

/**
 * BilanSocialAgent
 */
class BilanSocialAgent {
    
    use BilanSociaLAgentTrait;
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
     *
     */
    private $lbNom;

    /**
     * @var string
     *
     */
    private $lbPren;

    /**
     * @var string
     *
     */
    private $lbDatenais;

    /**
     * @var string
     * @Assert\NotBlank(message = "agent.cdsexe.not_blank")
     */
    private $cdSexe;

    /**
     * @var boolean
     */
    private $blBoeth;

    /**
     * @var boolean
     * 
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
     * @var integer
     */
    private $idGraddeta;

    /**
     * @var \DateTime
     */
    private $dtDetaemplfonc;

    /**
     * @var \DateTime
     */
    private $dtArriStat;

    /**
     * @var boolean
     */
    private $blStruorigposistat;

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
     * @var \DateTime
     */
    private $lbDatedepacoll;

    /**
     * @var string
     */
    private $cdMotidece;

     /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne
     */
    private $RefMouvinteanne;

    /**
     * @var boolean
     */
    private $blPromavanstaganne;

    /**
     * @var boolean
     */
    private $blHeureSuppComp;

    /**
     * @var boolean
     */
    private $blTempcomp;

    /**
     * @var boolean
     */
    private $blTempplein;

    /**
     * @var boolean
     */
    private $blDemapart;


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
     *
     * @Assert\LessThanOrEqual(
     *     value = 1,
     *     message = "agent.nbAgenempltempcompnonrenou.onemax"
     * )
     */
    private $nbAgenempltempcompnonrenou;

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
    private $nbAllotempinvtrav;

    /**
     * @var integer
     */
    private $nbAllotempinvapro;

    /**
     * @var integer
     */
    private $nbAllotempinvaautrecas;

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
     * @var boolean
     */
    private $blEntrretocong;

    /**
     * @var boolean
     */
    private $blCet;

    /**
     * @var boolean
     */
    private $blCetOuvert;

    /**
     * @var integer
     *
     * @Assert\LessThanOrEqual(
     *     value = 60,
     *     message = "agent.autre.cet.value"
     * )
     */
    private $nbJourcumu3112;

    /**
     * @var integer
     * @Assert\LessThanOrEqual(
     *     value = 60,
     *     message = "agent.autre.cet.value"
     *
     * )
     */
    private $nbJourvers3112;

    /**
     * @var integer
     * @Assert\LessThanOrEqual(
     *     value = 60,
     *     message = "agent.autre.cet.value"
     * )
     */
    private $nbJourdepe3112;

    /**
     * @var integer
     * @Assert\LessThanOrEqual(
     *     value = 60,
     *     message = "agent.autre.cet.value"
     *
     * )
     */
    private $nbJourinde3112;

    /**
     * @var integer
     * @Assert\LessThanOrEqual(
     *     value = 60,
     *     message = "agent.autre.cet.value"
     * )
     */
    private $nbJourprisrafp3112;

    /**
     * @var integer
     * @Assert\LessThanOrEqual(
     *     value = 60,
     *     message = "agent.autre.cet.value"
     * )
     */
    private $nbJourdonneBenef;

    /**
     * @var boolean
     */
    private $blTeletrav;


    /**
     * @var boolean
     */
    private $blTeletravBenef;

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
//    private $idInapdeci;

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

    private $cdProfessionCategSocio;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $AbsenceArretAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $FormationAgents;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial
     */
    private $Handitorials;
    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\Gpeec
     */
    private $Gpeec;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\GpeecPlus
     */
    private $GpeecPlus;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\Dgcl
     */
    private $Dgcl;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $EtprAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $BilanQ30Alerte;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $HeuSuppReaRemAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $RemunerationGlobaleAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $RemunerationAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $HeuCompReaRemAgent;

    /**
     * @var \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete
     */
    private $enquete;

    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    private $collectivite;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire
     */
    private $refPositionStatutaire;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude
     */
    private $refInapDeci;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude
     */
    private $refInapDema;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     *
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
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    private $FiliereInaptitude;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    private $FiliereEmpFonc;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    private $refCadreEmploi;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    private $refCadreEmploiOrigin;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien
     */
    private $refMotifEntretienRetour;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien
     */
    private $refMotifEntretienDepart;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade
     */
    private $refGrade;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade
     */
    private $refGradeDeta;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    private $RefCadreEmploiDeta;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee
     */
    private $refMotifArrivee;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation
     */
    private $refStageTitularisation;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart
     */
    private $refMotifDepart;

    /**
     * @var \Doctrine\Common\Collections\Collection
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
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention
     */
    private $refActionPrevention;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    private $refEmploiNonPermanent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine
     */
    private $refStructureOrigine;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCdd
     */
    private $refTypeCdd;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $refContrainteTravail;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $SimpleStatus;


    /**
     * @var \DateTime
     */
    private $dtChanstat;

    /**
     * @var boolean
     */
    private $blPosiacti;

    /**
     * @var boolean
     */
    private $blPosiactinonremu;


    /**
     * @var integer
     */
    private $pcFillGroupStatut;

    /**
     * @var integer
     */
    private $pcFillGroupRemuneration;

    /**
     * @var integer
     */
    private $pcFillGroupAbsence;

    /**
     * @var integer
     */
    private $pcFillGroupFormation;

    /**
     * @var integer
     */
    private $pcFillGroupAutre;

    /**
     * @var integer
     */
    private $pcFillGroupRASSCT;

    /**
     * @var integer
     */
    private $pcFillGroupHanditorial;

    /**
     * @var integer
     */
    private $pcFillGroupGPEEC;
    
    /**
     * @var integer
     */
    private $pcFillAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire
     */
    private $refPositionStatutairenonremu;
    private $lbMotiN4ds;
    private $lbMotiArriN4ds;
    private $lbModaN4ds;
    private $lbStatJuriN4ds;
    private $lbAlerteNonPermanentN4ds;
    private $lbIntiContTravN4ds;
    private $lbPosiStatN4ds;
    private $lbPosiStatNonRemuN4ds;
    private $lbGradeN4ds;
    private $lbGradeOrigN4ds;
    private $lbNatureEmploiN4ds;
    private $em;

    /**
     * @var string
     */
    private $commAgent;

    /**
     * @var boolean
     */
    private $blCyclTrav;

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if ($this->getBlAgenremuanne() !== 0 && $this->getBlAgenremuanne() !== null && $this->getRefStatut() == null ) {

            $context->buildViolation('agent.status.not_blank')
                ->atPath('refStatut')
                ->addViolation();
        }
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->EtprAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->BilanQ30Alerte = new \Doctrine\Common\Collections\ArrayCollection();
        $this->HeuSuppReaRemAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->AbsenceArretAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->refContrainteTravail = new \Doctrine\Common\Collections\ArrayCollection();
        $this->refAvancementPromotionConcours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->HeuCompReaRemAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->SimpleStatus = new \Doctrine\Common\Collections\ArrayCollection();
        $this->FormationAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationGlobaleAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationAgent = new \Doctrine\Common\Collections\ArrayCollection();

        $this->pcFillGroupStatut = 0;
        $this->pcFillGroupRemuneration = 0;
        $this->pcFillGroupAbsence = 0;
        $this->pcFillGroupFormation = 0;
        $this->pcFillGroupAutre = 0;
        $this->pcFillGroupRASSCT = 0;
        $this->pcFillGroupHanditorial = 0;
        $this->pcFillGroupGPEEC = 0;
        $this->pcFillAgent = 0;
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
     * Set idGraddeta
     *
     * @param integer $idGraddeta
     *
     * @return BilanSocialAgent
     */
    public function setIdGraddeta($idGraddeta) {
        $this->idGraddeta = $idGraddeta;

        return $this;
    }

    /**
     * Get idGraddeta
     *
     * @return integer
     */
    public function getIdGraddeta() {
        return $this->idGraddeta;
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
     * Set dtArriStat
     *
     * @param \DateTime $dtArriStat
     *
     * @return BilanSocialAgent
     */
    public function setDtArriStat($dtArriStat) {
        $this->dtArriStat = $dtArriStat;

        return $this;
    }

    /**
     * Get dtArriStat
     *
     * @return \DateTime
     */
    public function getDtArriStat() {
        return $this->dtArriStat;
    }

    /**
     * Set blStruorigposistat
     *
     * @param integer $blStruorigposistat
     *
     * @return BilanSocialAgent
     */
    public function setBlStruorigposistat($blStruorigposistat) {
        $this->blStruorigposistat = $blStruorigposistat;

        return $this;
    }

    /**
     * Get blStruorigposistat
     *
     * @return integer
     */
    public function getBlStruorigposistat() {
        return $this->blStruorigposistat;
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
     * @param \DateTime $lbDatedepacoll
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
     * @return \DateTime
     */
    public function getLbDatedepacoll() {
        return $this->lbDatedepacoll;
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
     * Set blHeureSuppComp
     *
     * @param boolean $blHeureSuppComp
     *
     * @return BilanSocialAgent
     */
    public function setBlHeureSuppComp($blHeureSuppComp) {
        $this->blHeureSuppComp = $blHeureSuppComp;

        return $this;
    }

    /**
     * Get blHeureSuppComp
     *
     * @return boolean
     */
    public function getBlHeureSuppComp() {
        return $this->blHeureSuppComp;
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
     * Set nbAllotempinvtrav
     *
     * @param integer $nbAllotempinvtrav
     *
     * @return BilanSocialAgent
     */
    public function setNbAllotempinvtrav($nbAllotempinvtrav) {
        $this->nbAllotempinvtrav = $nbAllotempinvtrav;

        return $this;
    }

    /**
     * Get nbAllotempinvtrav
     *
     * @return integer
     */
    public function getNbAllotempinvtrav() {
        return $this->nbAllotempinvtrav;
    }

    /**
     * Set nbAllotempinvapro
     *
     * @param integer $nbAllotempinvapro
     *
     * @return BilanSocialAgent
     */
    public function setNbAllotempinvapro($nbAllotempinvapro) {
        $this->nbAllotempinvapro = $nbAllotempinvapro;

        return $this;
    }

    /**
     * Get nbAllotempinvapro
     *
     * @return integer
     */
    public function getNbAllotempinvapro() {
        return $this->nbAllotempinvapro;
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

//    /**
//     * Set idMotientrdepacong
//     *
//     * @param integer $idMotientrdepacong
//     *
//     * @return BilanSocialAgent
//     */
//    public function setIdMotientrdepacong($idMotientrdepacong) {
//        $this->idMotientrdepacong = $idMotientrdepacong;
//
//        return $this;
//    }
//
//    /**
//     * Get idMotientrdepacong
//     *
//     * @return integer
//     */
//    public function getIdMotientrdepacong() {
//        return $this->idMotientrdepacong;
//    }

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

//
//    /**
//     * Set idMotientrretocong
//     *
//     * @param integer $idMotientrretocong
//     *
//     * @return BilanSocialAgent
//     */
//    public function setIdMotientrretocong($idMotientrretocong) {
//        $this->idMotientrretocong = $idMotientrretocong;
//
//        return $this;
//    }
//
//    /**
//     * Get idMotientrretocong
//     *
//     * @return integer
//     */
//    public function getIdMotientrretocong() {
//        return $this->idMotientrretocong;
//    }

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
     * Set nbJourdonneBenef
     *
     * @param integer $nbJourdonneBenef
     *
     * @return BilanSocialAgent
     */
    public function setNbJourdonneBenef($nbJourdonneBenef) {
        $this->nbJourdonneBenef = $nbJourdonneBenef;

        return $this;
    }

    /**
     * Get nbJourdonneBenef
     *
     * @return integer
     */
    public function getNbJourdonneBenef() {
        return $this->nbJourdonneBenef;
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
     * Set blTeletravBenef
     *
     * @param boolean $blTeletravBenef
     *
     * @return BilanSocialAgent
     */
    public function setBlTeletravBenef($blTeletravBenef) {
        $this->blTeletravBenef = $blTeletravBenef;

        return $this;
    }

    /**
     * Get blTeletravBenef
     *
     * @return boolean
     */
    public function getBlTeletravBenef() {
        return $this->blTeletravBenef;
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
//    public function setIdInapdeci($idInapdeci) {
//        $this->idInapdeci = $idInapdeci;
//
//        return $this;
//    }

    /**
     * Get idInapdeci
     *
     * @return integer
     */
//    public function getIdInapdeci() {
//        return $this->idInapdeci;
//    }

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
     * Set dtChanstat
     *
     * @param \DateTime $dtChanstat
     *
     * @return BilanSocialAgent
     */
    public function setDtChanstat($dtChanstat) {
        $this->dtChanstat = $dtChanstat;

        return $this;
    }

    /**
     * Get dtChanstat
     *
     * @return \DateTime
     */
    public function getDtChanstat() {
        return $this->dtChanstat;
    }

    /**
     * Add absenceArretAgent
     *
     * @param $absenceArretAgent
     *
     * @return BilanSocialAgent
     */
    public function addAbsenceArretAgent( $absenceArretAgent) {
        $this->AbsenceArretAgents[] = $absenceArretAgent;

        return $this;
    }

    /**
     * Remove absenceArretAgent
     *
     * @param $absenceArretAgent
     */
    public function removeAbsenceArretAgent( $absenceArretAgent) {
        $this->AbsenceArretAgents->removeElement($absenceArretAgent);
    }

    /**
     * Get absenceArretAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbsenceArretAgents() {
        return $this->AbsenceArretAgents;
    }

    /**
     * Add FormationAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents
     *
     * @return BilanSocialAgent
     */
    public function addFormationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents) {
        $this->FormationAgents[] = $FormationAgents;

        return $this;
    }

    /**
     * Remove FormationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents
     */
    public function removeFormationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents) {
        $this->FormationAgents->removeElement($FormationAgents);
    }

    /**
     * Get FormationAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormationAgents() {
        return $this->FormationAgents;
    }

    /**
     * Add EtprAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent
     *
     * @return BilanSocialAgent
     */
    public function addEtprAgent(\Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent) {
        $this->EtprAgent[] = $EtprAgent;

        return $this;
    }

    /**
     * Remove EtprAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent
     */
    public function removeEtprAgent(\Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent) {
        $this->EtprAgent->removeElement($EtprAgent);
    }

    /**
     * Get EtprAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtprAgent() {
        return $this->EtprAgent;
    }

    /**
     * Add SimpleStatus
     *
     *
     * @return BilanSocialAgent
     */
    public function addSimpleStatus($SimpleStatus) {
        $this->SimpleStatus[] = $SimpleStatus;

        return $this;
    }

    /**
     * Remove SimpleStatus
     *
     */
    public function removeSimpleStatus($SimpleStatus) {
        $this->SimpleStatus->removeElement($SimpleStatus);
    }

    /**
     * Get SimpleStatus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSimpleStatus() {
        return $this->SimpleStatus;
    }

    /**
     * Add RemunerationGlobaleAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent
     *
     * @return BilanSocialAgent
     */
    public function addRemunerationGlobaleAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent) {
        $this->RemunerationGlobaleAgent[] = $RemunerationGlobaleAgent;

        return $this;
    }

    /**
     * Remove RemunerationGlobaleAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent
     */
    public function removeRemunerationGlobaleAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent) {
        $this->RemunerationGlobaleAgent->removeElement($RemunerationGlobaleAgent);
    }

    /**
     * Get RemunerationGlobaleAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRemunerationGlobaleAgent() {
        return $this->RemunerationGlobaleAgent;
    }



    /**
     * Add RemunerationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent
     *
     * @return BilanSocialAgent
     */
    public function addRemunerationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent) {
        $this->RemunerationAgent[] = $RemunerationAgent;

        return $this;
    }

    /**
     * Remove RemunerationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent
     */
    public function removeRemunerationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent) {
        $this->RemunerationAgent->removeElement($RemunerationAgent);
    }

    /**
     * Get RemunerationAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRemunerationAgent() {
        return $this->RemunerationAgent;
    }




    /**
     * Add HeuSuppReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent
     *
     * @return RefStatut
     */
    public function addHeuSuppReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent) {
        $this->HeuSuppReaRemAgent[] = $HeuSuppReaRemAgent;

        return $this;
    }

    /**
     * Remove HeuSuppReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent
     */
    public function removeHeuSuppReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent) {
        $this->HeuSuppReaRemAgent->removeElement($HeuSuppReaRemAgent);
    }

    /**
     * Get HeuSuppReaRemAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeuSuppReaRemAgent() {
        return $this->HeuSuppReaRemAgent;
    }

    /**
     * Add HeuCompReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent
     *
     * @return RefStatut
     */
    public function addHeuCompReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent) {
        $this->HeuCompReaRemAgent[] = $HeuCompReaRemAgent;

        return $this;
    }

    /**
     * Remove HeuCompReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent
     */
    public function removeHeuCompReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent) {
        $this->HeuCompReaRemAgent->removeElement($HeuCompReaRemAgent);
    }

    /**
     * Get HeuCompReaRemAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeuCompReaRemAgent() {
        return $this->HeuCompReaRemAgent;
    }

    /**
     * Set enquete
     *
     * @param \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete
     *
     * @return BilanSocialAgent
     */
    public function setEnquete(\Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete = null) {
        $this->enquete = $enquete;

        return $this;
    }

    /**
     * Get enquete
     *
     * @return \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete
     */
    public function getEnquete() {
        return $this->enquete;
    }

    /**
     * Set collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return BilanSocialAgent
     */
    public function setCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite = null) {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    public function getCollectivite() {
        return $this->collectivite;
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
     * Set refMotifEntretienRetour
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien $refMotifEntretienRetour
     *
     * @return BilanSocialAgent
     */
    public function setRefMotifEntretienRetour(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien $refMotifEntretienRetour = null) {
        $this->refMotifEntretienRetour = $refMotifEntretienRetour;

        return $this;
    }

    /**
     * Get refMotifEntretienRetour
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien
     */
    public function getRefMotifEntretienRetour() {
        return $this->refMotifEntretienRetour;
    }

    /**
     * Set refMotifEntretienDepart
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien $refMotifEntretienDepart
     *
     * @return BilanSocialAgent
     */
    public function setRefMotifEntretienDepart(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien $refMotifEntretienDepart = null) {
        $this->refMotifEntretienDepart = $refMotifEntretienDepart;

        return $this;
    }

    /**
     * Get refMotifEntretienDepart
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien
     */
    public function RefMotifEntretienDepart() {
        return $this->refMotifEntretienDepart;
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
     * Set FiliereInaptitude
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $FiliereInaptitude
     *
     * @return BilanSocialAgent
     */
    public function setFiliereInaptitude(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $FiliereInaptitude = null) {
        $this->FiliereInaptitude = $FiliereInaptitude;

        return $this;
    }

    /**
     * Get FiliereInaptitude
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getFiliereInaptitude() {
        return $this->FiliereInaptitude;
    }

    /**
     * Set FiliereEmpFonc
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $FiliereEmpFonc
     *
     * @return BilanSocialAgent
     */
    public function setFiliereEmpFonc(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $FiliereEmpFonc = null) {
        $this->FiliereEmpFonc = $FiliereEmpFonc;

        return $this;
    }

    /**
     * Get FiliereEmpFonc
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getFiliereEmpFonc() {
        return $this->FiliereEmpFonc;
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
     * Set refCadreEmploiOrigin
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploiOrigin
     *
     * @return BilanSocialAgent
     */
    public function setRefCadreEmploiOrigin(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploiOrigin = null) {
        $this->refCadreEmploiOrigin = $refCadreEmploiOrigin;

        return $this;
    }

    /**
     * Get refCadreEmploiOrigin
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    public function getRefCadreEmploiOrigin() {
        return $this->refCadreEmploiOrigin;
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
     * Set refGradeDeta
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade $refGradeDeta
     *
     * @return BilanSocialAgent
     */
    public function setRefGradeDeta(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade $refGradeDeta = null) {
        $this->refGradeDeta = $refGradeDeta;

        return $this;
    }

    /**
     * Get refGradeDeta
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade
     */
    public function getRefGradeDeta() {
        return $this->refGradeDeta;
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
     * Set refMotifDepart
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart $refMotifDepart
     *
     * @return BilanSocialAgent
     */
    public function setRefMotifDepart(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart $refMotifDepart = null) {
        $this->refMotifDepart = $refMotifDepart;

        return $this;
    }

    /**
     * Get refMotifDepart
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart
     */
    public function getRefMotifDepart() {
        return $this->refMotifDepart;
    }

    /**
     * Add refAvancementPromotionConcours
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours $refAvancementPromotionConcours
     *
     * @return BilanSocialAgent
     */
    public function addRefAvancementPromotionConcours(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours $refAvancementPromotionConcours) {
        $this->refAvancementPromotionConcours[] = $refAvancementPromotionConcours;

        return $this;
    }

    /**
     * Remove refAvancementPromotionConcours
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours $refAvancementPromotionConcours
     */
    public function removeRefAvancementPromotionConcours(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours $refAvancementPromotionConcours) {
        $this->refAvancementPromotionConcours->removeElement($refAvancementPromotionConcours);
    }

    /**
     * Get refAvancementPromotionConcours
     *
     * @return \Doctrine\Common\Collections\Collection
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
     * Get refInapDeci
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude
     */
    public function getRefInapDeci() {
        return $this->refInapDeci;
    }

    /**
     * Set refInapDeci
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude $refInapDeci
     *
     * @return BilanSocialAgent
     */
    public function setRefInapDeci(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude $refInapDeci = null) {
        $this->refInapDeci = $refInapDeci;

        return $this;
    }

    /**
     * Get refInapDema
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude
     */
    public function getRefInapDema() {
        return $this->refInapDema;
    }

    /**
     * Set refInapDema
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude $refInapDema
     *
     * @return BilanSocialAgent
     */
    public function setRefInapDema(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude $refInapDema = null) {
        $this->refInapDema = $refInapDema;

        return $this;
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
     * Set refActionPrevention
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention $refActionPrevention
     *
     * @return BilanSocialAgent
     */
    public function setRefActionPrevention(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention $refActionPrevention = null) {
        $this->refActionPrevention = $refActionPrevention;

        return $this;
    }

    /**
     * Get refActionPrevention
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention
     */
    public function getRefActionPrevention() {
        return $this->refActionPrevention;
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
     * Set refTypeCdd
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCdd $refTypeCdd
     *
     * @return BilanSocialAgent
     */
    public function setRefTypeCdd(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCdd $refTypeCdd = null) {
        $this->refTypeCdd = $refTypeCdd;

        return $this;
    }

    /**
     * Get refTypeCdd
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCdd
     */
    public function getRefTypeCdd() {
        return $this->refTypeCdd;
    }

    function getLbMotiN4ds() {
        return $this->lbMotiN4ds;
    }

    function setLbMotiN4ds($lbMotiN4ds) {
        $this->lbMotiN4ds = $lbMotiN4ds;
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

    function getBlCetOuvert() {
        return $this->blCetOuvert;
    }

    function setBlCetOuvert($blCetOuvert) {
        $this->blCetOuvert = $blCetOuvert;
    }

    function setIdBilasociagen($idBilasociagen) {
        $this->idBilasociagen = $idBilasociagen;
    }

    /**
     * Set blPosiacti
     *
     * @param boolean $blPosiacti
     *
     * @return BilanSocialAgent
     */
    public function setBlPosiacti($blPosiacti) {
        $this->blPosiacti = $blPosiacti;

        return $this;
    }

    /**
     * Get blPosiacti
     *
     * @return boolean
     */
    public function getBlPosiacti() {
        return $this->blPosiacti;
    }

    /**
     * Set refPositionStatutairenonremu
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutairenonremu
     *
     * @return BilanSocialAgent
     */
    public function setRefPositionStatutaireNonRemu(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutaireNonRemu = null) {
        $this->refPositionStatutairenonremu = $refPositionStatutaireNonRemu;
        return $this;
    }

    /**
     * Get refPositionStatutairenonremu
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire
     */
    public function getRefPositionStatutaireNonRemu() {
        return $this->refPositionStatutairenonremu;
    }

    /**
     * Set blPosiactinonremu
     *
     * @param boolean $blPosiactinonremu
     *
     * @return BilanSocialAgent
     */
    public function setBlPosiactiNonRemu($blPosiactinonremu) {
        $this->blPosiactinonremu = $blPosiactinonremu;

        return $this;
    }

    /**
     * Get blPosiactinonremu
     *
     * @return boolean
     */
    public function getBlPosiactiNonRemu() {
        return $this->blPosiactinonremu;
    }

    function getLbMotiArriN4ds() {
        return $this->lbMotiArriN4ds;
    }

    function setLbMotiArriN4ds($lbMotiArriN4ds) {
        $this->lbMotiArriN4ds = $lbMotiArriN4ds;
    }

    function getLbModaN4ds() {
        return $this->lbModaN4ds;
    }

    function setLbModaN4ds($lbModaN4ds) {
        $this->lbModaN4ds = $lbModaN4ds;
    }

    function getLbStatJuriN4ds() {
        return $this->lbStatJuriN4ds;
    }

    function setLbStatJuriN4ds($lbStatJuriN4ds) {
        $this->lbStatJuriN4ds = $lbStatJuriN4ds;
    }

    function getLbMotiDetaN4ds() {
        return $this->lbMotiDetaN4ds;
    }

    function setLbMotiDetaN4ds($lbMotiDetaN4ds) {
        $this->lbMotiDetaN4ds = $lbMotiDetaN4ds;
    }

    function getLbIntiContTravN4ds() {
        return $this->lbIntiContTravN4ds;
    }

    function setLbIntiContTravN4ds($lbIntiContTravN4ds) {
        $this->lbIntiContTravN4ds = $lbIntiContTravN4ds;
    }

    function getLbPosiStatN4ds() {
        return $this->lbPosiStatN4ds;
    }

    function getLbPosiStatNonRemuN4ds() {
        return $this->lbPosiStatNonRemuN4ds;
    }

    function setLbPosiStatN4ds($lbPosiStatN4ds) {
        $this->lbPosiStatN4ds = $lbPosiStatN4ds;
    }

    function setLbPosiStatNonRemuN4ds($lbPosiStatNonRemuN4ds) {
        $this->lbPosiStatNonRemuN4ds = $lbPosiStatNonRemuN4ds;
    }

    /**
     * @return int
     */
    public function getPcFillGroupStatut(): int
    {
        return $this->pcFillGroupStatut;
    }

    /**
     * @param int $pcFillGroupStatut
     */
    public function setPcFillGroupStatut(int $pcFillGroupStatut)
    {
        $this->pcFillGroupStatut = $pcFillGroupStatut;
    }

    /**
     * @return int
     */
    public function getPcFillGroupRemuneration(): int
    {
        return $this->pcFillGroupRemuneration;
    }

    /**
     * @param int $pcFillGroupRemuneration
     */
    public function setPcFillGroupRemuneration(int $pcFillGroupRemuneration)
    {
        $this->pcFillGroupRemuneration = $pcFillGroupRemuneration;
    }

    /**
     * @return int
     */
    public function getPcFillGroupAbsence(): int
    {
        return $this->pcFillGroupAbsence;
    }

    /**
     * @param int $pcFillGroupAbsence
     */
    public function setPcFillGroupAbsence(int $pcFillGroupAbsence)
    {
        $this->pcFillGroupAbsence = $pcFillGroupAbsence;
    }

    /**
     * @return int
     */
    public function getPcFillGroupFormation(): int
    {
        return $this->pcFillGroupFormation;
    }

    /**
     * @param int $pcFillGroupFormation
     */
    public function setPcFillGroupFormation(int $pcFillGroupFormation)
    {
        $this->pcFillGroupFormation = $pcFillGroupFormation;
    }

    /**
     * @return int
     */
    public function getPcFillGroupAutre(): int
    {
        return $this->pcFillGroupAutre;
    }

    /**
     * @param int $pcFillGroupAutre
     */
    public function setPcFillGroupAutre(int $pcFillGroupAutre)
    {
        $this->pcFillGroupAutre = $pcFillGroupAutre;
    }

    /**
     * @return int
     */
    public function getPcFillGroupRASSCT(): int
    {
        return $this->pcFillGroupRASSCT;
    }

    /**
     * @param int $pcFillGroupRASSCT
     */
    public function setPcFillGroupRASSCT(int $pcFillGroupRASSCT)
    {
        $this->pcFillGroupRASSCT = $pcFillGroupRASSCT;
    }

    /**
     * @return int
     */
    public function getPcFillGroupHanditorial(): int
    {
        return $this->pcFillGroupHanditorial;
    }

    /**
     * @param int $pcFillGroupHanditorial
     */
    public function setPcFillGroupHanditorial(int $pcFillGroupHanditorial)
    {
        $this->pcFillGroupHanditorial = $pcFillGroupHanditorial;
    }

    /**
     * @return int
     */
    public function getPcFillGroupGPEEC(): int
    {
        return $this->pcFillGroupGPEEC;
    }

    /**
     * @param int $pcFillGroupGPEEC
     */
    public function setPcFillGroupGPEEC(int $pcFillGroupGPEEC)
    {
        $this->pcFillGroupGPEEC = $pcFillGroupGPEEC;
    }
    
    function getPcFillAgent() {
        return $this->pcFillAgent;
    }

    function setPcFillAgent($pcFillAgent) {
        $this->pcFillAgent = $pcFillAgent;
    }

    


    /**
     * Add BilanQ30Alerte
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte
     *
     * @return BilanQ30Alerte
     */
    public function addBilanQ30Alerte(\Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte) {
        $this->BilanQ30Alerte[] = $BilanQ30Alerte;

        return $this;
    }

    /**
     * Remove BilanQ30Alerte
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte
     */
    public function removeBilanQ30Alerte(\Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte) {
        $this->BilanQ30Alerte->removeElement($BilanQ30Alerte);
    }

    /**
     * Get BilanQ30Alerte
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanQ30Alerte() {
        return $this->BilanQ30Alerte;
    }

    function getLbGradeN4ds() {
        return $this->lbGradeN4ds;
    }

    function setLbGradeN4ds($lbGradeN4ds) {
        $this->lbGradeN4ds = $lbGradeN4ds;
    }

    function getLbGradeOrigN4ds() {
        return $this->lbGradeOrigN4ds;
    }

    function setLbGradeOrigN4ds($lbGradeOrigN4ds) {
        $this->lbGradeOrigN4ds = $lbGradeOrigN4ds;
    }

    function getLbNatureEmploiN4ds() {
        return $this->lbNatureEmploiN4ds;
    }

    function setLbNatureEmploiN4ds($lbNatureEmploiN4ds) {
        $this->lbNatureEmploiN4ds = $lbNatureEmploiN4ds;
    }

    function getHanditorials() {
        return $this->Handitorials;
    }

    function setHanditorials($Handitorials) {
        $this->Handitorials = $Handitorials;
    }

    function getGpeec() {
        return $this->Gpeec;
    }

    function setGpeec(\Bilan_Social\Bundle\ApaBundle\Entity\Gpeec $Gpeec) {
        $this->Gpeec = $Gpeec;
    }

    function getGpeecPlus() {
        return $this->GpeecPlus;
    }

    function setGpeecPlus(\Bilan_Social\Bundle\ApaBundle\Entity\GpeecPlus $GpeecPlus) {
        $this->GpeecPlus = $GpeecPlus;
    }

    function getDgcl() {
        return $this->Dgcl;
    }

    function setDgcl(\Bilan_Social\Bundle\ApaBundle\Entity\Dgcl $Dgcl) {
        $this->Dgcl = $Dgcl;
    }

    function getBlDemapart() {
        return $this->blDemapart;
    }

    function setBlDemapart($blDemapart) {
        $this->blDemapart = $blDemapart;
    }

    function getRefCadreEmploiDeta(){
        return $this->RefCadreEmploiDeta;
    }

    function setRefCadreEmploiDeta(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $RefCadreEmploiDeta = null) {
        $this->RefCadreEmploiDeta = $RefCadreEmploiDeta;
    }


    /**
     * Get RefMouvinteanne
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne
     */
    function getRefMouvinteanne(){
        return $this->RefMouvinteanne;
    }
    /**
     * Set RefMouvinteanne
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne $RefMouvinteanne
     *
     * @return BilanSocialAgent
     */
    function setRefMouvinteanne(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne $RefMouvinteanne = null) {
        $this->RefMouvinteanne = $RefMouvinteanne;
    }

    function getNbAllotempinvaautrecas() {
        return $this->nbAllotempinvaautrecas;
    }

    function setNbAllotempinvaautrecas($nbAllotempinvaautrecas) {
        $this->nbAllotempinvaautrecas = $nbAllotempinvaautrecas;
    }

    function getCdProfessionCategSocio() {
        return $this->cdProfessionCategSocio;
    }

    function setCdProfessionCategSocio($cdProfessionCategSocio) {
        $this->cdProfessionCategSocio = $cdProfessionCategSocio;
    }

    function getLbAlerteNonPermanentN4ds() {
        return $this->lbAlerteNonPermanentN4ds;
    }

    function setLbAlerteNonPermanentN4ds($lbAlerteNonPermanentN4ds) {
        $this->lbAlerteNonPermanentN4ds = $lbAlerteNonPermanentN4ds;
    }

    /**
     * Set commAgent
     *
     * @param string $commAgent
     *
     * @return BilanSocialAgent
     */
    public function setCommAgent($commAgent) {
        $this->commAgent = $commAgent;

        return $this;
    }

    /**
     * Get commAgent
     *
     * @return string
     */
    public function getCommAgent() {
        return $this->commAgent;
    }

    /**
     * Set blCyclTrav
     *
     * @param boolean $blCyclTrav
     *
     * @return BilanSocialAgent
     */
    public function setBlCyclTrav($blCyclTrav) {
        $this->blCyclTrav = $blCyclTrav;

        return $this;
    }

    /**
     * Get blCyclTrav
     *
     * @return boolean
     */
    public function getBlCyclTrav() {
        return $this->blCyclTrav;
    }
}
