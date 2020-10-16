<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * InformationColectiviteAgent
 */

class InformationColectiviteAgent {

    /**
     * @var boolean
     */
    private $blChartemp;


    /**
     * @var boolean
     */
    private $r2271;

    /**
     * @var boolean
     */
    private $r2272;

    /**
     * @var boolean
     */
    private $blRecPersTemp;

    /**
     * @var boolean
     */
    private $blAutoassusansconvtitu;

    /**
     * @var boolean
     */
    private $blAutoassuavecconvtitu;

    /**
     * @var boolean
     */
    private $blAutoassuavecconvcont;
    
    /**
     * @var boolean
     */
    private $blAutoassusansconvcont;

    /**
     * @var boolean
     */
    private $blRegiassuchom;

//    /**
//     * @var boolean
//     */
//    private $blHeursupp;
    
    /**
     * @var integer
     */
    private $pcOnglets;
    
//    /**
//     * @var boolean
//     */
//    private $blHeurcomp;

    /**
     * @var integer
     */
    private $mtDepefonccoll;

    /**
     * @var integer
     */
    private $mtCharpers;

    /**
     * @var float
     */
    private $lbRati;

    /**
     * @var boolean
     */
    private $blAgenaffeprev;

    /**
     * @var integer
     */
    private $nbVisimedisponprevH;

    /**
     * @var integer
     */
    private $nbVisimedisponprevF;
    
    /**
     * integer
     */
    private $r2101;

    /**
     * integer
     */
    private $r2102;

    /**
     * integer
     */
    private $r2103;

    /**
     * integer
     */
    private $r2104;

    /**
     * integer
     */
    private $titu341;

    /**
     * integer
     */
    private $stag341;

    /**
     * integer
     */
    private $contractuel342;

    /**
     * @var boolean
     */
    private $blDocurisqpro;

    /**
     * @var integer
     */
    private $nmAnnecrea;

    /**
     * @var integer
     */
    private $rifseepContractuel;


    /**
     * @var integer
     */
    private $r13221;

    /**
     * @var integer
     */
    private $r13222;

    /**
     * @var integer
     */
    private $r13223;

    /**
     * @var integer
     */
    private $r13224;

    /**
     * @var integer
     */
    private $mpccm;

    /**
     * @var integer
     */
    private $nmAnnedernmaj;

    /**
     * @var integer
     */
    private $q425;

    /**
     * @var integer
     */
    private $q3110;

    /**
     * @var integer
     */
    private $q3111;

    /**
     * @var boolean
     */
    private $blPlanprevrisqpsysoci;

    /**
     * @var boolean
     */
    private $blDemaprevtroumuscu;

    /**
     * @var boolean
     */
    private $blDemaprevrisqcanc;

    /**
     * @var boolean
     */
    private $blAutrdemaprev;

    /**
     * @var boolean
     */
    private $blRegisantsecutrav;

    /**
     * @var boolean
     */
    private $blActeviolphys;

    /**
     * @var boolean
     */
    private $q432;

    /**
     * @var boolean
     */
    private $q433;

    /**
     * @var integer
     */
    private $mtCnfptcotiobl;

    /**
     * @var integer
     */
    private $mtCnfptsupcotiobl;

    /**
     * @var integer
     */
    private $mtAutrorga;

    /**
     * @var integer
     */
    private $mtFraidepla;

    /**
     * @var integer
     */
    private $nbReunct;

    /**
     * @var integer
     */
    private $nbReuncommiadmi;

    /**
     * @var integer
     */
    private $nbReuncommiconsu;

    /**
     * @var integer
     */
    private $nbReunchsct;

    /**
     * @var boolean
     */
    private $blCtsiegmissdevo;

    /**
     * @var integer
     */
    private $nbReunctmissdevo;
    /**
     * @var integer
     */
    private $nbJourActRep;

    /**
     * @var integer
     */
    private $nbJourActSec;

    /**
     * @var integer
     */
    private $nbJourautospeacco;

    /**
     * @var integer
     */
    private $nbJourabse;

    /**
     * @var integer
     */
    private $nbHeurglob;

    /**
     * @var integer
     */
    private $nbHeurdroisynd;

    /**
     * @var integer
     */
    private $nbHeurutil;

    /**
     * @var integer
     */
    private $nbProtacco;

    /**
     * @var boolean
     */
    private $blGrev;

    /**
     * @var boolean
     */
    private $blSubvverscomi;

    /**
     * @var boolean
     */
    private $blCotisubvcomiinter;

    /*
     * @var boolean
     */
    /*private $blPresservcoll;*/

    /**
     * @var boolean
     */
    private $blPresservcomsoc;

    /**
     * @var boolean
     */
    private $blPlacresecrec;

    /**
     * @var boolean
     */
    private $blAidefinagardenfa;

    /**
     * @var boolean
     */
    private $blAutrgardenfa;

    /**
     * @var text
     */
    private $blAutrgardenfaDescription;

    /**
     * @var boolean
     */
    private $blSantconvparti;

    /**
     * @var boolean
     */
    private $blSantcontregl;

    /**
     * @var boolean
     */
    private $blPrevoconvparti;

    /**
     * @var boolean
     */
    private $blPrevocontregl;

    /**
     * @var integer
     */
    private $mtDepetota;

    /**
     * @var integer
     */
    private $mtDepeinsepershand;

    /**
     * @var integer
     */
    private $mtRealemplpershand;

    /**
     * @var integer
     */
    private $mtDepeamentrav;

    /**
     * @var integer
     */
    private $nbTravhandemplperm;

    /**
     * @var integer
     */
    private $txEmpldiretravhand;

    /**
     * @var integer
     */
    private $txEmpllegatravhand;

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
    private $idInfocollagen;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sante;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $prevoyance;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ActionPrevention;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $infocoll_132;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $infocoll_157;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $infocoll_215;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $infocoll_216;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ActeViolencePhysique;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ConflitTravail;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    private $Etpr114AnneePrecedente;
//
//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    private $Etpr124AnneePrecedente;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $AgentSanctionDisciplinaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $AgentSanctionDisciplinaireStagiaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $AgentSanctionDisciplinaireContractuel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $AgentMotifSanctionDisciplinaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Etpr131AnneePrecedente;

    /**
     * @var \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete
     */
    private $enquete;

    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    private $collectivite;

    /**
     * @var boolean
     */
    private $rassctExistEvalRPS;

    /**
     * @var boolean
     */
    private $rassctMajEvalRPS;

    /**
     * @var boolean
     */
    private $rassctDiagRPS;

    /**
     * @var boolean
     */
    private $rassctExistPrevActionSante;

    /**
     * @var boolean
     */
    private $rassctActiMedecPrev;

    /**
     * @var boolean
     */
    private $rassctDesiACFI;

    /**
     * @var integer
     */
    private $rassctNbVisitACFI;

    /**
     * @var integer
     */
    private $rassctNbCtChsct;

    /**
     * @var boolean
     */
    private $rassctExistPrevEntreExte;

    /**
     * @var boolean
     */
    private $rassctExistDiagPeniAnnex;

    /**
     * @var boolean
     */
    private $rassctNeceFicheSuiviFact;

    /**
     * @var boolean
     */
    private $rassctExistFicheExpoPeni;

    /**
     * @var boolean
     */
    private $rassctNeceFicheAmiante;

    /**
     * @var boolean
     */
    private $rassctExistFicheAmiante;

    /**
     * @var string
     */
    private $handMailCorres;

    /**
     * @var boolean
     */
    private $handObliEmplTrav;

    /**
     * @var integer
     */
    private $handNbAvisInapTempo;

    /**
     * @var integer
     */
    private $handNbAvisInapDef;

    /**
     * @var integer
     */
    private $handNbAvisInapDefToutesFonctions;

    /**
     * @var integer
     */
    private $handNbRecla;

    /**
     * @var integer
     */
    private $handNbRetraiteInval;

    /**
     * @var integer
     */
    private $handNbLicencInapPhysi;

    /**
     * @var boolean
     */
    private $handMesureAmenaPosteCondTrav;

    /**
     * @var integer
     */
    private $handNbMesureAmenaPosteCondTrav;

    /**
     * @var integer
     */
    private $handNbMesureAmenaPosteCondTravBoeth;

    /**
     * @var boolean
     */
    private $handMesureChangAffec;

    /**
     * @var integer
     */
    private $handNbMesureChangAffec;

    /**
     * @var integer
     */
    private $handNbMesureChangAffecBoeth;

    /**
     * @var boolean
     */
    private $handDispoOffice;

    /**
     * @var integer
     */
    private $handNbDispoOffice;

    /**
     * @var integer
     */
    private $handNbDispoOfficeBoeth;

    /**
     * @var integer
     */
    private $handNbReclaDemande;

    /**
     * @var integer
     */
    private $handNbDemReclaInapAcciTravMaladiePro;

    /**
     * @var integer
     */
    private $handNbReclaReal;

    /**
     * @var integer
     */
    private $handNbReaReclaInapAcciTravMaladiePro;

    /**
     * @var boolean
     */
    private $q2171;

    /**
     * @var boolean
     */
    private $r2171;

    /**
     * @var boolean
     */
    private $q2172;

    /**
     * @var boolean
     */
    private $r2172;

    /**
     * @var boolean
     */
    private $q2173;

    /**
     * @var boolean
     */
    private $r2173;

    /**
     * @var boolean
     */
    private $q2174;

    /**
     * @var boolean
     */
    private $r2174;

    /**
     * Constructor
     */
    public function __construct() {
        $this->sante = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prevoyance = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ActionPrevention = new \Doctrine\Common\Collections\ArrayCollection();
        $this->infocoll_132 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->infocoll_157 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->infocoll_215 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->infocoll_216 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ActeViolencePhysique = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ConflitTravail = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->Etpr114AnneePrecedente = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->Etpr124AnneePrecedente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Etpr131AnneePrecedente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->AgentSanctionDisciplinaire = new \Doctrine\Common\Collections\ArrayCollection();
        $this->AgentSanctionDisciplinaireStagiaire = new \Doctrine\Common\Collections\ArrayCollection();
        $this->AgentSanctionDisciplinaireContractuel = new \Doctrine\Common\Collections\ArrayCollection();
        $this->AgentMotifSanctionDisciplinaire = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getBlRecPersTemp() {
        return $this->blRecPersTemp;
    }

    function setBlRecPersTemp($blRecPersTemp) {
        $this->blRecPersTemp = $blRecPersTemp;
    }

    /**
     * Set blChartemp
     *
     * @param boolean $blChartemp
     *
     * @return InformationColectiviteAgent
     */
    public function setBlChartemp($blChartemp) {
        $this->blChartemp = $blChartemp;

        return $this;
    }

    /**
     * Get r2271
     *
     * @return boolean
     */
    public function getR2271() {
        return $this->r2271;
    }

    /**
     * Set r2271
     *
     * @param boolean $r2271
     *
     * @return InformationColectiviteAgent
     */
    public function setR2271($r2271) {
        $this->r2271 = $r2271;

        return $this;
    }

    /**
     * Get r2272
     *
     * @return boolean
     */
    public function getR2272() {
        return $this->r2272;
    }

    /**
     * Set r2272
     *
     * @param boolean $r2272
     *
     * @return InformationColectiviteAgent
     */
    public function setR2272($r2272) {
        $this->r2272 = $r2272;

        return $this;
    }

    /**
     * Get blChartemp
     *
     * @return boolean
     */
    public function getBlChartemp() {
        return $this->blChartemp;
    }


    /**
     * Set blAutoassusansconvtitu
     *
     * @param boolean $blAutoassusansconvtitu
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAutoassusansconvtitu($blAutoassusansconvtitu) {
        $this->blAutoassusansconvtitu = $blAutoassusansconvtitu;

        return $this;
    }

    /**
     * Get blAutoassusansconvtitu
     *
     * @return boolean
     */
    public function getBlAutoassusansconvtitu() {
        return $this->blAutoassusansconvtitu;
    }

    /**
     * Set blAutoassuavecconvtitu
     *
     * @param boolean $blAutoassuavecconvtitu
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAutoassuavecconvtitu($blAutoassuavecconvtitu) {
        $this->blAutoassuavecconvtitu = $blAutoassuavecconvtitu;

        return $this;
    }

    /**
     * Get blAutoassuavecconvtitu
     *
     * @return boolean
     */
    public function getBlAutoassuavecconvtitu() {
        return $this->blAutoassuavecconvtitu;
    }

    /**
     * Set blAutoassuavecconvcont
     *
     * @param boolean $blAutoassuavecconvcont
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAutoassuavecconvcont($blAutoassuavecconvcont) {
        $this->blAutoassuavecconvcont = $blAutoassuavecconvcont;

        return $this;
    }

    /**
     * Get blAutoassuavecconvcont
     *
     * @return boolean
     */
    public function getBlAutoassuavecconvcont() {
        return $this->blAutoassuavecconvcont;
    }

    /**
     * Set blRegiassuchom
     *
     * @param boolean $blRegiassuchom
     *
     * @return InformationColectiviteAgent
     */
    public function setBlRegiassuchom($blRegiassuchom) {
        $this->blRegiassuchom = $blRegiassuchom;

        return $this;
    }

    /**
     * Get blRegiassuchom
     *
     * @return boolean
     */
    public function getBlRegiassuchom() {
        return $this->blRegiassuchom;
    }

//    /**
//     * Set blHeursupp
//     *
//     * @param boolean $blHeursupp
//     *
//     * @return InformationColectiviteAgent
//     */
//    public function setBlHeursupp($blHeursupp) {
//        $this->blHeursupp = $blHeursupp;
//
//        return $this;
//    }
//
//    /**
//     * Get blHeursupp
//     *
//     * @return boolean
//     */
//    public function getBlHeursupp() {
//        return $this->blHeursupp;
//    }
//
//    /**
//     * Set blHeurcomp
//     *
//     * @param boolean $blHeurcomp
//     *
//     * @return InformationColectiviteAgent
//     */
//    public function setBlHeurcomp($blHeurcomp) {
//        $this->blHeurcomp = $blHeurcomp;
//
//        return $this;
//    }
//
//    /**
//     * Get blHeurcomp
//     *
//     * @return boolean
//     */
//    public function getBlHeurcomp() {
//        return $this->blHeurcomp;
//    }

    /**
     * Set mtDepefonccoll
     *
     * @param integer $mtDepefonccoll
     *
     * @return InformationColectiviteAgent
     */
    public function setMtDepefonccoll($mtDepefonccoll) {
        $this->mtDepefonccoll = $mtDepefonccoll;

        return $this;
    }

    /**
     * Get mtDepefonccoll
     *
     * @return integer
     */
    public function getMtDepefonccoll() {
        return $this->mtDepefonccoll;
    }

    /**
     * Set mtCharpers
     *
     * @param integer $mtCharpers
     *
     * @return InformationColectiviteAgent
     */
    public function setMtCharpers($mtCharpers) {
        $this->mtCharpers = $mtCharpers;

        return $this;
    }

    /**
     * Get mtCharpers
     *
     * @return integer
     */
    public function getMtCharpers() {
        return $this->mtCharpers;
    }

    /**
     * Set lbRati
     *
     * @param float $lbRati
     *
     * @return InformationColectiviteAgent
     */
    public function setLbRati($lbRati) {
        $this->lbRati = $lbRati;

        return $this;
    }

    /**
     * Get lbRati
     *
     * @return float
     */
    public function getLbRati() {
        return $this->lbRati;
    }

    /**
     * Set blAgenaffeprev
     *
     * @param boolean $blAgenaffeprev
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAgenaffeprev($blAgenaffeprev) {
        $this->blAgenaffeprev = $blAgenaffeprev;

        return $this;
    }

    /**
     * Get blAgenaffeprev
     *
     * @return boolean
     */
    public function getBlAgenaffeprev() {
        return $this->blAgenaffeprev;
    }

    /**
     * Set nbVisimedisponprevH
     *
     * @param integer $nbVisimedisponprevH
     *
     * @return InformationColectiviteAgent
     */
    public function setNbVisimedisponprevH($nbVisimedisponprevH) {
        $this->nbVisimedisponprevH = $nbVisimedisponprevH;

        return $this;
    }

    /**
     * Get nbVisimedisponprevH
     *
     * @return integer
     */
    public function getNbVisimedisponprevH() {
        return $this->nbVisimedisponprevH;
    } 
    
    /**
     * Set nbVisimedisponprevF
     *
     * @param integer $nbVisimedisponprevF
     *
     * @return InformationColectiviteAgent
     */
    public function setnbVisimedisponprevF($nbVisimedisponprevF) {
        $this->nbVisimedisponprevF = $nbVisimedisponprevF;

        return $this;
    }

    /**
     * Get nbVisimedisponprevF
     *
     * @return integer
     */
    public function getnbVisimedisponprevF() {
        return $this->nbVisimedisponprevF;
    }

    /**
     * Set blDocurisqpro
     *
     * @param boolean $blDocurisqpro
     *
     * @return InformationColectiviteAgent
     */
    public function setBlDocurisqpro($blDocurisqpro) {
        $this->blDocurisqpro = $blDocurisqpro;

        return $this;
    }

    /**
     * Get blDocurisqpro
     *
     * @return boolean
     */
    public function getBlDocurisqpro() {
        return $this->blDocurisqpro;
    }

    /**
     * Set nmAnnecrea
     *
     * @param integer $nmAnnecrea
     *
     * @return InformationColectiviteAgent
     */
    public function setNmAnnecrea($nmAnnecrea) {
        $this->nmAnnecrea = $nmAnnecrea;

        return $this;
    }

    /**
     * Get nmAnnecrea
     *
     * @return integer
     */
    public function getNmAnnecrea() {
        return $this->nmAnnecrea;
    }

    /**
     * Set nmAnnedernmaj
     *
     * @param integer $nmAnnedernmaj
     *
     * @return InformationColectiviteAgent
     */
    public function setNmAnnedernmaj($nmAnnedernmaj) {
        $this->nmAnnedernmaj = $nmAnnedernmaj;

        return $this;
    }

    /**
     * Get nmAnnedernmaj
     *
     * @return integer
     */
    public function getNmAnnedernmaj() {
        return $this->nmAnnedernmaj;
    }

    /**
     * Set blPlanprevrisqpsysoci
     *
     * @param boolean $blPlanprevrisqpsysoci
     *
     * @return InformationColectiviteAgent
     */
    public function setBlPlanprevrisqpsysoci($blPlanprevrisqpsysoci) {
        $this->blPlanprevrisqpsysoci = $blPlanprevrisqpsysoci;

        return $this;
    }

    /**
     * Get blPlanprevrisqpsysoci
     *
     * @return boolean
     */
    public function getBlPlanprevrisqpsysoci() {
        return $this->blPlanprevrisqpsysoci;
    }

    /**
     * Set blDemaprevtroumuscu
     *
     * @param boolean $blDemaprevtroumuscu
     *
     * @return InformationColectiviteAgent
     */
    public function setBlDemaprevtroumuscu($blDemaprevtroumuscu) {
        $this->blDemaprevtroumuscu = $blDemaprevtroumuscu;

        return $this;
    }

    /**
     * Get blDemaprevtroumuscu
     *
     * @return boolean
     */
    public function getBlDemaprevtroumuscu() {
        return $this->blDemaprevtroumuscu;
    }

    /**
     * Set blDemaprevrisqcanc
     *
     * @param boolean $blDemaprevrisqcanc
     *
     * @return InformationColectiviteAgent
     */
    public function setBlDemaprevrisqcanc($blDemaprevrisqcanc) {
        $this->blDemaprevrisqcanc = $blDemaprevrisqcanc;

        return $this;
    }

    /**
     * Get blDemaprevrisqcanc
     *
     * @return boolean
     */
    public function getBlDemaprevrisqcanc() {
        return $this->blDemaprevrisqcanc;
    }

    /**
     * Set blAutrdemaprev
     *
     * @param boolean $blAutrdemaprev
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAutrdemaprev($blAutrdemaprev) {
        $this->blAutrdemaprev = $blAutrdemaprev;

        return $this;
    }

    /**
     * Get blAutrdemaprev
     *
     * @return boolean
     */
    public function getBlAutrdemaprev() {
        return $this->blAutrdemaprev;
    }

    /**
     * Set blRegisantsecutrav
     *
     * @param boolean $blRegisantsecutrav
     *
     * @return InformationColectiviteAgent
     */
    public function setBlRegisantsecutrav($blRegisantsecutrav) {
        $this->blRegisantsecutrav = $blRegisantsecutrav;

        return $this;
    }

    /**
     * Get blRegisantsecutrav
     *
     * @return boolean
     */
    public function getBlRegisantsecutrav() {
        return $this->blRegisantsecutrav;
    }

    /**
     * Set blActeviolphys
     *
     * @param boolean $blActeviolphys
     *
     * @return InformationColectiviteAgent
     */
    public function setBlActeviolphys($blActeviolphys) {
        $this->blActeviolphys = $blActeviolphys;

        return $this;
    }

    /**
     * Get blActeviolphys
     *
     * @return boolean
     */
    public function getBlActeviolphys() {
        return $this->blActeviolphys;
    }

    /**
     * Set q432
     *
     * @param boolean $q432
     *
     * @return InformationColectiviteAgent
     */
    public function setQ432($q432) {
        $this->q432 = $q432;

        return $this;
    }

    /**
     * Get q432
     *
     * @return boolean
     */
    public function getQ432() {
        return $this->q432;
    }

    /**
     * Set q433
     *
     * @param boolean $q433
     *
     * @return InformationColectiviteAgent
     */
    public function setQ433($q433) {
        $this->q433 = $q433;

        return $this;
    }

    /**
     * Get q433
     *
     * @return boolean
     */
    public function getQ433() {
        return $this->q433;
    }

    /**
     * Set mtCnfptcotiobl
     *
     * @param integer $mtCnfptcotiobl
     *
     * @return InformationColectiviteAgent
     */
    public function setMtCnfptcotiobl($mtCnfptcotiobl) {
        $this->mtCnfptcotiobl = $mtCnfptcotiobl;

        return $this;
    }

    /**
     * Get mtCnfptcotiobl
     *
     * @return integer
     */
    public function getMtCnfptcotiobl() {
        return $this->mtCnfptcotiobl;
    }

    /**
     * Set mtCnfptsupcotiobl
     *
     * @param integer $mtCnfptsupcotiobl
     *
     * @return InformationColectiviteAgent
     */
    public function setMtCnfptsupcotiobl($mtCnfptsupcotiobl) {
        $this->mtCnfptsupcotiobl = $mtCnfptsupcotiobl;

        return $this;
    }

    /**
     * Get mtCnfptsupcotiobl
     *
     * @return integer
     */
    public function getMtCnfptsupcotiobl() {
        return $this->mtCnfptsupcotiobl;
    }

    /**
     * Set mtAutrorga
     *
     * @param integer $mtAutrorga
     *
     * @return InformationColectiviteAgent
     */
    public function setMtAutrorga($mtAutrorga) {
        $this->mtAutrorga = $mtAutrorga;

        return $this;
    }

    /**
     * Get mtAutrorga
     *
     * @return integer
     */
    public function getMtAutrorga() {
        return $this->mtAutrorga;
    }

    /**
     * Set mtFraidepla
     *
     * @param integer $mtFraidepla
     *
     * @return InformationColectiviteAgent
     */
    public function setMtFraidepla($mtFraidepla) {
        $this->mtFraidepla = $mtFraidepla;

        return $this;
    }

    /**
     * Get mtFraidepla
     *
     * @return integer
     */
    public function getMtFraidepla() {
        return $this->mtFraidepla;
    }

    /**
     * Set nbReunct
     *
     * @param integer $nbReunct
     *
     * @return InformationColectiviteAgent
     */
    public function setNbReunct($nbReunct) {
        $this->nbReunct = $nbReunct;

        return $this;
    }

    /**
     * Get nbReunct
     *
     * @return integer
     */
    public function getNbReunct() {
        return $this->nbReunct;
    }

    /**
     * Set nbReuncommiadmi
     *
     * @param integer $nbReuncommiadmi
     *
     * @return InformationColectiviteAgent
     */
    public function setNbReuncommiadmi($nbReuncommiadmi) {
        $this->nbReuncommiadmi = $nbReuncommiadmi;

        return $this;
    }

    /**
     * Set nbReuncommiconsu
     *
     * @param integer $nbReuncommiconsu
     *
     * @return InformationColectiviteAgent
     */
    public function setNbReuncommiconsu($nbReuncommiconsu) {
        $this->nbReuncommiconsu = $nbReuncommiconsu;

        return $this;
    }

    /**
     * Get nbReuncommiadmi
     *
     * @return integer
     */
    public function getNbReuncommiadmi() {
        return $this->nbReuncommiadmi;
    }

    /**
     * Get nbReuncommiconsu
     *
     * @return integer
     */
    public function getNbReuncommiconsu() {
        return $this->nbReuncommiconsu;
    }

    /**
     * Set nbReunchsct
     *
     * @param integer $nbReunchsct
     *
     * @return InformationColectiviteAgent
     */
    public function setNbReunchsct($nbReunchsct) {
        $this->nbReunchsct = $nbReunchsct;

        return $this;
    }

    /**
     * Get nbReunchsct
     *
     * @return integer
     */
    public function getNbReunchsct() {
        return $this->nbReunchsct;
    }

    /**
     * Set blCtsiegmissdevo
     *
     * @param boolean $blCtsiegmissdevo
     *
     * @return InformationColectiviteAgent
     */
    public function setBlCtsiegmissdevo($blCtsiegmissdevo) {
        $this->blCtsiegmissdevo = $blCtsiegmissdevo;

        return $this;
    }

    /**
     * Get blCtsiegmissdevo
     *
     * @return boolean
     */
    public function getBlCtsiegmissdevo() {
        return $this->blCtsiegmissdevo;
    }

    /**
     * Set nbReunctmissdevo
     *
     * @param integer $nbReunctmissdevo
     *
     * @return InformationColectiviteAgent
     */
    public function setNbReunctmissdevo($nbReunctmissdevo) {
        $this->nbReunctmissdevo = $nbReunctmissdevo;

        return $this;
    }

    /**
     * Set nbJourActRep
     *
     * @param integer $nbJourActRep
     *
     * @return InformationColectiviteAgent
     */
    public function setNbJourActRep($nbJourActRep) {
        $this->nbJourActRep = $nbJourActRep;

        return $this;
    }

    /**
     * Set nbJourActSec
     *
     * @param integer $nbJourActSec
     *
     * @return InformationColectiviteAgent
     */
    public function setNbJourActSec($nbJourActSec) {
        $this->nbJourActSec = $nbJourActSec;

        return $this;
    }

    /**
     * Get nbReunctmissdevo
     *
     * @return integer
     */
    public function getNbReunctmissdevo() {
        return $this->nbReunctmissdevo;
    }

    /**
     * Get nbJourActRep
     *
     * @return integer
     */
    public function getNbJourActRep() {
        return $this->nbJourActRep;
    }

    /**
     * Get nbJourActSec
     *
     * @return integer
     */
    public function getNbJourActSec() {
        return $this->nbJourActSec;
    }

    /**
     * Set nbJourautospeacco
     *
     * @param integer $nbJourautospeacco
     *
     * @return InformationColectiviteAgent
     */
    public function setNbJourautospeacco($nbJourautospeacco) {
        $this->nbJourautospeacco = $nbJourautospeacco;

        return $this;
    }

    /**
     * Get nbJourautospeacco
     *
     * @return integer
     */
    public function getNbJourautospeacco() {
        return $this->nbJourautospeacco;
    }

    /**
     * Set nbJourabse
     *
     * @param integer $nbJourabse
     *
     * @return InformationColectiviteAgent
     */
    public function setNbJourabse($nbJourabse) {
        $this->nbJourabse = $nbJourabse;

        return $this;
    }

    /**
     * Get nbJourabse
     *
     * @return integer
     */
    public function getNbJourabse() {
        return $this->nbJourabse;
    }

    /**
     * Set nbHeurglob
     *
     * @param integer $nbHeurglob
     *
     * @return InformationColectiviteAgent
     */
    public function setNbHeurglob($nbHeurglob) {
        $this->nbHeurglob = $nbHeurglob;

        return $this;
    }

    /**
     * Get nbHeurglob
     *
     * @return integer
     */
    public function getNbHeurglob() {
        return $this->nbHeurglob;
    }

    /**
     * Set nbHeurdroisynd
     *
     * @param integer $nbHeurdroisynd
     *
     * @return InformationColectiviteAgent
     */
    public function setNbHeurdroisynd($nbHeurdroisynd) {
        $this->nbHeurdroisynd = $nbHeurdroisynd;

        return $this;
    }

    /**
     * Get nbHeurdroisynd
     *
     * @return integer
     */
    public function getNbHeurdroisynd() {
        return $this->nbHeurdroisynd;
    }

    /**
     * Set nbHeurutil
     *
     * @param integer $nbHeurutil
     *
     * @return InformationColectiviteAgent
     */
    public function setNbHeurutil($nbHeurutil) {
        $this->nbHeurutil = $nbHeurutil;

        return $this;
    }

    /**
     * Get nbHeurutil
     *
     * @return integer
     */
    public function getNbHeurutil() {
        return $this->nbHeurutil;
    }

    /**
     * Set nbProtacco
     *
     * @param integer $nbProtacco
     *
     * @return InformationColectiviteAgent
     */
    public function setNbProtacco($nbProtacco) {
        $this->nbProtacco = $nbProtacco;

        return $this;
    }

    /**
     * Get nbProtacco
     *
     * @return integer
     */
    public function getNbProtacco() {
        return $this->nbProtacco;
    }

    /**
     * Set blGrev
     *
     * @param boolean $blGrev
     *
     * @return InformationColectiviteAgent
     */
    public function setBlGrev($blGrev) {
        $this->blGrev = $blGrev;

        return $this;
    }

    /**
     * Get blGrev
     *
     * @return boolean
     */
    public function getBlGrev() {
        return $this->blGrev;
    }

    /**
     * Set blSubvverscomi
     *
     * @param boolean $blSubvverscomi
     *
     * @return InformationColectiviteAgent
     */
    public function setBlSubvverscomi($blSubvverscomi) {
        $this->blSubvverscomi = $blSubvverscomi;

        return $this;
    }

    /**
     * Get blSubvverscomi
     *
     * @return boolean
     */
    public function getBlSubvverscomi() {
        return $this->blSubvverscomi;
    }

    /**
     * Set blCotisubvcomiinter
     *
     * @param boolean $blCotisubvcomiinter
     *
     * @return InformationColectiviteAgent
     */
    public function setBlCotisubvcomiinter($blCotisubvcomiinter) {
        $this->blCotisubvcomiinter = $blCotisubvcomiinter;

        return $this;
    }

    /**
     * Get blCotisubvcomiinter
     *
     * @return boolean
     */
    public function getBlCotisubvcomiinter() {
        return $this->blCotisubvcomiinter;
    }

    /*
     * Set blPresservcoll
     *
     * @param boolean $blPresservcoll
     *
     * @return InformationColectiviteAgent
     */
  /*  public function setBlPresservcoll($blPresservcoll) {
        $this->blPresservcoll = $blPresservcoll;

        return $this;
    }*/

    /**
     * Set blPresservcomsoc
     *
     * @param boolean $blPresservcomsoc
     *
     * @return InformationColectiviteAgent
     */
    public function setBlPresservcomsoc($blPresservcomsoc) {
        $this->blPresservcomsoc = $blPresservcomsoc;

        return $this;
    }

    /*
     * Get blPresservcoll
     *
     * @return boolean
     */
   /* public function getBlPresservcoll() {
        return $this->blPresservcoll;
    }*/

    /**
     * Get blPresservcomsoc
     *
     * @return boolean
     */
    public function getBlPresservcomsoc() {
        return $this->blPresservcomsoc;
    }

    /**
     * Set blPlacresecrec
     *
     * @param boolean $blPlacresecrec
     *
     * @return InformationColectiviteAgent
     */
    public function setBlPlacresecrec($blPlacresecrec) {
        $this->blPlacresecrec = $blPlacresecrec;

        return $this;
    }

    /**
     * Get blPlacresecrec
     *
     * @return boolean
     */
    public function getBlPlacresecrec() {
        return $this->blPlacresecrec;
    }

    /**
     * Set blAidefinagardenfa
     *
     * @param boolean $blAidefinagardenfa
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAidefinagardenfa($blAidefinagardenfa) {
        $this->blAidefinagardenfa = $blAidefinagardenfa;

        return $this;
    }

    /**
     * Get blAidefinagardenfa
     *
     * @return boolean
     */
    public function getBlAidefinagardenfa() {
        return $this->blAidefinagardenfa;
    }

    /**
     * Set blAutrgardenfa
     *
     * @param boolean $blAutrgardenfa
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAutrgardenfa($blAutrgardenfa) {
        $this->blAutrgardenfa = $blAutrgardenfa;

        return $this;
    }
    /**
     * Set blAutrgardenfaDescription
     *
     * @param text $blAutrgardenfaDescription
     *
     * @return InformationColectiviteAgent
     */
    public function setBlAutrgardenfaDescription($blAutrgardenfaDescription) {
        $this->blAutrgardenfaDescription = $blAutrgardenfaDescription;

        return $this;
    }

    /**
     * Get blAutrgardenfa
     *
     * @return boolean
     */
    public function getBlAutrgardenfa() {
        return $this->blAutrgardenfa;
    }

    /**
     * Get blAutrgardenfaDescription
     *
     * @return text
     */
    public function getBlAutrgardenfaDescription() {
        return $this->blAutrgardenfaDescription;
    }

    /**
     * Set blSantconvparti
     *
     * @param boolean $blSantconvparti
     *
     * @return InformationColectiviteAgent
     */
    public function setBlSantconvparti($blSantconvparti) {
        $this->blSantconvparti = $blSantconvparti;

        return $this;
    }

    /**
     * Get blSantconvparti
     *
     * @return boolean
     */
    public function getBlSantconvparti() {
        return $this->blSantconvparti;
    }

    /**
     * Set blSantcontregl
     *
     * @param boolean $blSantcontregl
     *
     * @return InformationColectiviteAgent
     */
    public function setBlSantcontregl($blSantcontregl) {
        $this->blSantcontregl = $blSantcontregl;

        return $this;
    }

    /**
     * Get blSantcontregl
     *
     * @return boolean
     */
    public function getBlSantcontregl() {
        return $this->blSantcontregl;
    }

    /**
     * Set blPrevoconvparti
     *
     * @param boolean $blPrevoconvparti
     *
     * @return InformationColectiviteAgent
     */
    public function setBlPrevoconvparti($blPrevoconvparti) {
        $this->blPrevoconvparti = $blPrevoconvparti;

        return $this;
    }

    /**
     * Get blPrevoconvparti
     *
     * @return boolean
     */
    public function getBlPrevoconvparti() {
        return $this->blPrevoconvparti;
    }

    /**
     * Set blPrevocontregl
     *
     * @param boolean $blPrevocontregl
     *
     * @return InformationColectiviteAgent
     */
    public function setBlPrevocontregl($blPrevocontregl) {
        $this->blPrevocontregl = $blPrevocontregl;

        return $this;
    }

    /**
     * Get blPrevocontregl
     *
     * @return boolean
     */
    public function getBlPrevocontregl() {
        return $this->blPrevocontregl;
    }

    /**
     * Set mtDepetota
     *
     * @param integer $mtDepetota
     *
     * @return InformationColectiviteAgent
     */
    public function setMtDepetota($mtDepetota) {
        $this->mtDepetota = $mtDepetota;

        return $this;
    }

    /**
     * Get mtDepetota
     *
     * @return integer
     */
    public function getMtDepetota() {
        return $this->mtDepetota;
    }

    /**
     * Set mtDepeinsepershand
     *
     * @param integer $mtDepeinsepershand
     *
     * @return InformationColectiviteAgent
     */
    public function setMtDepeinsepershand($mtDepeinsepershand) {
        $this->mtDepeinsepershand = $mtDepeinsepershand;

        return $this;
    }

    /**
     * Get mtDepeinsepershand
     *
     * @return integer
     */
    public function getMtDepeinsepershand() {
        return $this->mtDepeinsepershand;
    }

    /**
     * Set mtRealemplpershand
     *
     * @param integer $mtRealemplpershand
     *
     * @return InformationColectiviteAgent
     */
    public function setMtRealemplpershand($mtRealemplpershand) {
        $this->mtRealemplpershand = $mtRealemplpershand;

        return $this;
    }

    /**
     * Get mtRealemplpershand
     *
     * @return integer
     */
    public function getMtRealemplpershand() {
        return $this->mtRealemplpershand;
    }

    /**
     * Set mtDepeamentrav
     *
     * @param integer $mtDepeamentrav
     *
     * @return InformationColectiviteAgent
     */
    public function setMtDepeamentrav($mtDepeamentrav) {
        $this->mtDepeamentrav = $mtDepeamentrav;

        return $this;
    }

    /**
     * Get mtDepeamentrav
     *
     * @return integer
     */
    public function getMtDepeamentrav() {
        return $this->mtDepeamentrav;
    }

    /**
     * Set nbTravhandemplperm
     *
     * @param integer $nbTravhandemplperm
     *
     * @return InformationColectiviteAgent
     */
    public function setNbTravhandemplperm($nbTravhandemplperm) {
        $this->nbTravhandemplperm = $nbTravhandemplperm;

        return $this;
    }

    /**
     * Get nbTravhandemplperm
     *
     * @return integer
     */
    public function getNbTravhandemplperm() {
        return $this->nbTravhandemplperm;
    }

    /**
     * Set txEmpldiretravhand
     *
     * @param integer $txEmpldiretravhand
     *
     * @return InformationColectiviteAgent
     */
    public function setTxEmpldiretravhand($txEmpldiretravhand) {
        $this->txEmpldiretravhand = $txEmpldiretravhand;

        return $this;
    }

    /**
     * Get txEmpldiretravhand
     *
     * @return integer
     */
    public function getTxEmpldiretravhand() {
        return $this->txEmpldiretravhand;
    }

    /**
     * Set txEmpllegatravhand
     *
     * @param integer $txEmpllegatravhand
     *
     * @return InformationColectiviteAgent
     */
    public function setTxEmpllegatravhand($txEmpllegatravhand) {
        $this->txEmpllegatravhand = $txEmpllegatravhand;

        return $this;
    }

    /**
     * Get txEmpllegatravhand
     *
     * @return integer
     */
    public function getTxEmpllegatravhand() {
        return $this->txEmpllegatravhand;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return InformationColectiviteAgent
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
     * @return InformationColectiviteAgent
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
     * Get idInfocollagen
     *
     * @return integer
     */
    public function getIdInfocollagen() {
        return $this->idInfocollagen;
    }

    /**
     * Add sante
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Sante $sante
     *
     * @return InformationColectiviteAgent
     */
    public function addSante(\Bilan_Social\Bundle\ApaBundle\Entity\Sante $sante) {
        $this->sante[] = $sante;

        return $this;
    }

    /**
     * Remove sante
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Sante $sante
     */
    public function removeSante(\Bilan_Social\Bundle\ApaBundle\Entity\Sante $sante) {
        $this->sante->removeElement($sante);
    }

    /**
     * Get sante
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSante() {
        return $this->sante;
    }

    /**
     * Add prevoyance
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Prevoyance $prevoyance
     *
     * @return InformationColectiviteAgent
     */
    public function addPrevoyance(\Bilan_Social\Bundle\ApaBundle\Entity\Prevoyance $prevoyance) {
        $this->prevoyance[] = $prevoyance;

        return $this;
    }

    /**
     * Remove prevoyance
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Prevoyance $prevoyance
     */
    public function removePrevoyance(\Bilan_Social\Bundle\ApaBundle\Entity\Prevoyance $prevoyance) {
        $this->prevoyance->removeElement($prevoyance);
    }

    /**
     * Get prevoyance
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrevoyance() {
        return $this->prevoyance;
    }

    /**
     * Add actionPrevention
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $actionPrevention
     *
     * @return InformationColectiviteAgent
     */
    public function addActionPrevention(\Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $actionPrevention) {
        $this->ActionPrevention[] = $actionPrevention;

        return $this;
    }

    /**
     * Remove actionPrevention
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $actionPrevention
     */
    public function removeActionPrevention(\Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $actionPrevention) {
        $this->ActionPrevention->removeElement($actionPrevention);
    }

    /**
     * Get actionPrevention
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActionPrevention() {
        return $this->ActionPrevention;
    }

    /**
     * Add InfoColl_132
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_132 $infocoll_132
     *
     * @return InformationColectiviteAgent
     */
    public function addInfocoll132(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_132 $infocoll_132) {
        $this->infocoll_132[] = $infocoll_132;

        return $this;
    }

    /**
     * Remove InfoColl_132
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $infocoll_132
     */
    public function removeInfocoll132(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_132 $infocoll_132) {
        $this->infocoll_132->removeElement($infocoll_132);
    }

    /**
     * Get InfoColl_132
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfocoll132() {
        return $this->infocoll_132;
    }

    /**
     * Add InfoColl_157
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_157 $infocoll_157
     *
     * @return InformationColectiviteAgent
     */
    public function addInfocoll157(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_157 $infocoll_157) {
        $this->infocoll_157[] = $infocoll_157;

        return $this;
    }

    /**
     * Remove InfoColl_157
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $infocoll_157
     */
    public function removeInfocoll157(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_157 $infocoll_157) {
        $this->infocoll_157->removeElement($infocoll_157);
    }

    /**
     * Get InfoColl_157
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfocoll157() {
        return $this->infocoll_157;
    }

    /**
     * Add InfoColl_215
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_215 $infocoll_215
     *
     * @return InformationColectiviteAgent
     */
    public function addInfocoll215(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_215 $infocoll_215) {
        $this->infocoll_215[] = $infocoll_215;

        return $this;
    }

    /**
     * Remove InfoColl_215
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $infocoll_215
     */
    public function removeInfocoll215(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_215 $infocoll_215) {
        $this->infocoll_215->removeElement($infocoll_215);
    }

    /**
     * Get InfoColl_215
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfocoll215() {
        return $this->infocoll_215;
    }


    /**
     * Add InfoColl_216
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_216 $infocoll_216
     *
     * @return InformationColectiviteAgent
     */
    public function addInfocoll216(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_216 $infocoll_216) {
        $this->infocoll_216[] = $infocoll_216;

        return $this;
    }

    /**
     * Remove InfoColl_216
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention $infocoll_216
     */
    public function removeInfocoll216(\Bilan_Social\Bundle\ApaBundle\Entity\InfoColl_216 $infocoll_216) {
        $this->infocoll_216->removeElement($infocoll_216);
    }

    /**
     * Get InfoColl_216
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInfocoll216() {
        return $this->infocoll_216;
    }


    /**
     * Add acteViolencePhysique
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $acteViolencePhysique
     *
     * @return InformationColectiviteAgent
     */
    public function addActeViolencePhysique(\Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $acteViolencePhysique) {
        $this->ActeViolencePhysique[] = $acteViolencePhysique;

        return $this;
    }

    /**
     * Remove acteViolencePhysique
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $acteViolencePhysique
     */
    public function removeActeViolencePhysique(\Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $acteViolencePhysique) {
        $this->ActeViolencePhysique->removeElement($acteViolencePhysique);
    }

    /**
     * Get acteViolencePhysique
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActeViolencePhysique() {
        return $this->ActeViolencePhysique;
    }

    /**
     * Add conflitTravail
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $conflitTravail
     *
     * @return InformationColectiviteAgent
     */
    public function addConflitTravail(\Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $conflitTravail) {
        $this->ConflitTravail[] = $conflitTravail;

        return $this;
    }

    /**
     * Remove conflitTravail
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $conflitTravail
     */
    public function removeConflitTravail(\Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $conflitTravail) {
        $this->ConflitTravail->removeElement($conflitTravail);
    }

    /**
     * Get conflitTravail
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConflitTravail() {
        return $this->ConflitTravail;
    }

//    /**
//     * Add etpr114AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $etpr114AnneePrecedente
//     *
//     * @return InformationColectiviteAgent
//     */
//    public function addEtpr114AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $etpr114AnneePrecedente) {
//        $this->Etpr114AnneePrecedente[] = $etpr114AnneePrecedente;
//
//        return $this;
//    }
//
//    /**
//     * Remove etpr114AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $etpr114AnneePrecedente
//     */
//    public function removeEtpr114AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $etpr114AnneePrecedente) {
//        $this->Etpr114AnneePrecedente->removeElement($etpr114AnneePrecedente);
//    }
//
//    /**
//     * Get etpr114AnneePrecedente
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getEtpr114AnneePrecedente() {
//        return $this->Etpr114AnneePrecedente;
//    }

//    /**
//     * Add etpr124AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $etpr124AnneePrecedente
//     *
//     * @return InformationColectiviteAgent
//     */
//    public function addEtpr124AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $etpr124AnneePrecedente) {
//        $this->Etpr124AnneePrecedente[] = $etpr124AnneePrecedente;
//
//        return $this;
//    }
//
//    /**
//     * Remove etpr124AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $etpr124AnneePrecedente
//     */
//    public function removeEtpr124AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $etpr124AnneePrecedente) {
//        $this->Etpr124AnneePrecedente->removeElement($etpr124AnneePrecedente);
//    }
//
//    /**
//     * Get etpr124AnneePrecedente
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getEtpr124AnneePrecedente() {
//        return $this->Etpr124AnneePrecedente;
//    }

    /**
     * Add etpr131AnneePrecedente
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $etpr131AnneePrecedente
     *
     * @return InformationColectiviteAgent
     */
    public function addEtpr131AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $etpr131AnneePrecedente) {
        $this->Etpr131AnneePrecedente[] = $etpr131AnneePrecedente;

        return $this;
    }

    /**
     * Remove etpr131AnneePrecedente
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $etpr131AnneePrecedente
     */
    public function removeEtpr131AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $etpr131AnneePrecedente) {
        $this->Etpr131AnneePrecedente->removeElement($etpr131AnneePrecedente);
    }

    /**
     * Get etpr131AnneePrecedente
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtpr131AnneePrecedente() {
        return $this->Etpr131AnneePrecedente;
    }

    /**
     * Set enquete
     *
     * @param \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete
     *
     * @return InformationColectiviteAgent
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
     * @return InformationColectiviteAgent
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

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

    function getRassctExistEvalRPS() {
        return $this->rassctExistEvalRPS;
    }

    function getRassctMajEvalRPS() {
        return $this->rassctMajEvalRPS;
    }

    function getRassctDiagRPS() {
        return $this->rassctDiagRPS;
    }

    function getRassctExistPrevActionSante() {
        return $this->rassctExistPrevActionSante;
    }

    function getRassctActiMedecPrev() {
        return $this->rassctActiMedecPrev;
    }

    function getRassctDesiACFI() {
        return $this->rassctDesiACFI;
    }

    function getRassctNbVisitACFI() {
        return $this->rassctNbVisitACFI;
    }

    function getRassctNbCtChsct() {
        return $this->rassctNbCtChsct;
    }

    function getRassctExistPrevEntreExte() {
        return $this->rassctExistPrevEntreExte;
    }

    function getRassctExistDiagPeniAnnex() {
        return $this->rassctExistDiagPeniAnnex;
    }

    function getRassctNeceFicheSuiviFact() {
        return $this->rassctNeceFicheSuiviFact;
    }

    function getRassctExistFicheExpoPeni() {
        return $this->rassctExistFicheExpoPeni;
    }

    function getRassctNeceFicheAmiante() {
        return $this->rassctNeceFicheAmiante;
    }

    function getRassctExistFicheAmiante() {
        return $this->rassctExistFicheAmiante;
    }

    function setRassctExistEvalRPS($rassctExistEvalRPS) {
        $this->rassctExistEvalRPS = $rassctExistEvalRPS;
    }

    function setRassctMajEvalRPS($rassctMajEvalRPS) {
        $this->rassctMajEvalRPS = $rassctMajEvalRPS;
    }

    function setRassctDiagRPS($rassctDiagRPS) {
        $this->rassctDiagRPS = $rassctDiagRPS;
    }

    function setRassctExistPrevActionSante($rassctExistPrevActionSante) {
        $this->rassctExistPrevActionSante = $rassctExistPrevActionSante;
    }

    function setRassctActiMedecPrev($rassctActiMedecPrev) {
        $this->rassctActiMedecPrev = $rassctActiMedecPrev;
    }

    function setRassctDesiACFI($rassctDesiACFI) {
        $this->rassctDesiACFI = $rassctDesiACFI;
    }

    function setRassctNbVisitACFI($rassctNbVisitACFI) {
        $this->rassctNbVisitACFI = $rassctNbVisitACFI;
    }

    function setRassctNbCtChsct($rassctNbCtChsct) {
        $this->rassctNbCtChsct = $rassctNbCtChsct;
    }

    function setRassctExistPrevEntreExte($rassctExistPrevEntreExte) {
        $this->rassctExistPrevEntreExte = $rassctExistPrevEntreExte;
    }

    function setRassctExistDiagPeniAnnex($rassctExistDiagPeniAnnex) {
        $this->rassctExistDiagPeniAnnex = $rassctExistDiagPeniAnnex;
    }

    function setRassctNeceFicheSuiviFact($rassctNeceFicheSuiviFact) {
        $this->rassctNeceFicheSuiviFact = $rassctNeceFicheSuiviFact;
    }

    function setRassctExistFicheExpoPeni($rassctExistFicheExpoPeni) {
        $this->rassctExistFicheExpoPeni = $rassctExistFicheExpoPeni;
    }

    function setRassctNeceFicheAmiante($rassctNeceFicheAmiante) {
        $this->rassctNeceFicheAmiante = $rassctNeceFicheAmiante;
    }

    function setRassctExistFicheAmiante($rassctExistFicheAmiante) {
        $this->rassctExistFicheAmiante = $rassctExistFicheAmiante;
    }

    function getHandMailCorres() {
        return $this->handMailCorres;
    }

    function getHandObliEmplTrav() {
        return $this->handObliEmplTrav;
    }

    function getHandNbAvisInapTempo() {
        return $this->handNbAvisInapTempo;
    }

    function getHandNbAvisInapDef() {
        return $this->handNbAvisInapDef;
    }

    function getHandNbAvisInapDefToutesFonctions() {
        return $this->handNbAvisInapDefToutesFonctions;
    }

    function getHandNbRecla() {
        return $this->handNbRecla;
    }

    function getHandNbRetraiteInval() {
        return $this->handNbRetraiteInval;
    }

    function getHandNbLicencInapPhysi() {
        return $this->handNbLicencInapPhysi;
    }

    function getHandMesureAmenaPosteCondTrav() {
        return $this->handMesureAmenaPosteCondTrav;
    }

    function getHandNbMesureAmenaPosteCondTrav() {
        return $this->handNbMesureAmenaPosteCondTrav;
    }

    function getHandNbMesureAmenaPosteCondTravBoeth() {
        return $this->handNbMesureAmenaPosteCondTravBoeth;
    }

    function getHandMesureChangAffec() {
        return $this->handMesureChangAffec;
    }

    function getHandNbMesureChangAffec() {
        return $this->handNbMesureChangAffec;
    }

    function getHandNbMesureChangAffecBoeth() {
        return $this->handNbMesureChangAffecBoeth;
    }

    function getHandDispoOffice() {
        return $this->handDispoOffice;
    }

    function getHandNbDispoOffice() {
        return $this->handNbDispoOffice;
    }

    function getHandNbDispoOfficeBoeth() {
        return $this->handNbDispoOfficeBoeth;
    }

    function getHandNbReclaDemande() {
        return $this->handNbReclaDemande;
    }

    function getHandNbDemReclaInapAcciTravMaladiePro() {
        return $this->handNbDemReclaInapAcciTravMaladiePro;
    }

    function getHandNbReclaReal() {
        return $this->handNbReclaReal;
    }

    function getHandNbReaReclaInapAcciTravMaladiePro() {
        return $this->handNbReaReclaInapAcciTravMaladiePro;
    }

    function setHandMailCorres($handMailCorres) {
        $this->handMailCorres = $handMailCorres;
    }

    function setHandObliEmplTrav($handObliEmplTrav) {
        $this->handObliEmplTrav = $handObliEmplTrav;
    }

    function setHandNbAvisInapTempo($handNbAvisInapTempo) {
        $this->handNbAvisInapTempo = $handNbAvisInapTempo;
    }

    function setHandNbAvisInapDef($handNbAvisInapDef) {
        $this->handNbAvisInapDef = $handNbAvisInapDef;
    }

    function setHandNbAvisInapDefToutesFonctions($handNbAvisInapDefToutesFonctions) {
        $this->handNbAvisInapDefToutesFonctions = $handNbAvisInapDefToutesFonctions;
    }

    function setHandNbRecla($handNbRecla) {
        $this->handNbRecla = $handNbRecla;
    }

    function setHandNbRetraiteInval($handNbRetraiteInval) {
        $this->handNbRetraiteInval = $handNbRetraiteInval;
    }

    function setHandNbLicencInapPhysi($handNbLicencInapPhysi) {
        $this->handNbLicencInapPhysi = $handNbLicencInapPhysi;
    }

    function setHandMesureAmenaPosteCondTrav($handMesureAmenaPosteCondTrav) {
        $this->handMesureAmenaPosteCondTrav = $handMesureAmenaPosteCondTrav;
    }

    function setHandNbMesureAmenaPosteCondTrav($handNbMesureAmenaPosteCondTrav) {
        $this->handNbMesureAmenaPosteCondTrav = $handNbMesureAmenaPosteCondTrav;
    }

    function setHandNbMesureAmenaPosteCondTravBoeth($handNbMesureAmenaPosteCondTravBoeth) {
        $this->handNbMesureAmenaPosteCondTravBoeth = $handNbMesureAmenaPosteCondTravBoeth;
    }

    function setHandMesureChangAffec($handMesureChangAffec) {
        $this->handMesureChangAffec = $handMesureChangAffec;
    }

    function setHandNbMesureChangAffec($handNbMesureChangAffec) {
        $this->handNbMesureChangAffec = $handNbMesureChangAffec;
    }

    function setHandNbMesureChangAffecBoeth($handNbMesureChangAffecBoeth) {
        $this->handNbMesureChangAffecBoeth = $handNbMesureChangAffecBoeth;
    }

    function setHandDispoOffice($handDispoOffice) {
        $this->handDispoOffice = $handDispoOffice;
    }

    function setHandNbDispoOffice($handNbDispoOffice) {
        $this->handNbDispoOffice = $handNbDispoOffice;
    }

    function setHandNbDispoOfficeBoeth($handNbDispoOfficeBoeth) {
        $this->handNbDispoOfficeBoeth = $handNbDispoOfficeBoeth;
    }

    function setHandNbReclaDemande($handNbReclaDemande) {
        $this->handNbReclaDemande = $handNbReclaDemande;
    }

    function setHandNbDemReclaInapAcciTravMaladiePro($handNbDemReclaInapAcciTravMaladiePro) {
        $this->handNbDemReclaInapAcciTravMaladiePro = $handNbDemReclaInapAcciTravMaladiePro;
    }

    function setHandNbReclaReal($handNbReclaReal) {
        $this->handNbReclaReal = $handNbReclaReal;
    }

    function setHandNbReaReclaInapAcciTravMaladiePro($handNbReaReclaInapAcciTravMaladiePro) {
        $this->handNbReaReclaInapAcciTravMaladiePro = $handNbReaReclaInapAcciTravMaladiePro;
    }
    function getR2101() {
        return $this->r2101;
    }

    function getR2102() {
        return $this->r2102;
    }

    function getR2103() {
        return $this->r2103;
    }

    function getR2104() {
        return $this->r2104;
    }

    function getTitu341() {
        return $this->titu341;
    }

    function getStag341() {
        return $this->stag341;
    }

    function getContractuel342() {
        return $this->contractuel342;
    }

    function setR2101($r2101) {
        $this->r2101 = $r2101;
    }

    function setR2102($r2102) {
        $this->r2102 = $r2102;
    }

    function setR2103($r2103) {
        $this->r2103 = $r2103;
    }

    function setR2104($r2104) {
        $this->r2104 = $r2104;
    }

    function setTitu341($titu341) {
        $this->titu341 = $titu341;
    }

    function setStag341($stag341) {
        $this->stag341 = $stag341;
    }

    function setContractuel342($contractuel342) {
        $this->contractuel342 = $contractuel342;
    }

    function getBlAutoassusansconvcont() {
        return $this->blAutoassusansconvcont;
    }

    function setBlAutoassusansconvcont($blAutoassusansconvcont) {
        $this->blAutoassusansconvcont = $blAutoassusansconvcont;
    }
    
    function getPcOnglets() {
        return $this->pcOnglets;
    }

    function setPcOnglets($pcOnglets) {
        $this->pcOnglets = $pcOnglets;
    }

    /**
        * Get AgentSanctionDisciplinaire
        *
        * @return \Doctrine\Common\Collections\Collection
        */
       public function getAgentSanctionDisciplinaire() {
           return $this->AgentSanctionDisciplinaire;
       }

       /**
        * Add AgentSanctionDisciplinaire
        *
        * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $AgentSanctionDisciplinaire
        *
        * @return InformationColectiviteAgent
        */
       public function addAgentSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $AgentSanctionDisciplinaire) {
           $this->AgentSanctionDisciplinaire[] = $AgentSanctionDisciplinaire;

           return $this;
       }

       /**
        * Remove AgentSanctionDisciplinaire
        *
        * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $AgentSanctionDisciplinaire
        */
       public function removeAgentSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $AgentSanctionDisciplinaire) {
           $this->AgentSanctionDisciplinaire->removeElement($AgentSanctionDisciplinaire);
       }

       /**
        * Get SanctionDisciplinaire
        *
        * @return \Doctrine\Common\Collections\Collection
        */
       public function getSanctionDisciplinaire() {
           return $this->AgentSanctionDisciplinaire;
       }

    /**
     * Get AgentSanctionDisciplinaireStagiaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgentSanctionDisciplinaireStagiaire() {
        return $this->AgentSanctionDisciplinaireStagiaire;
    }

    /**
     * Add AgentSanctionDisciplinaireStagiaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireStagiaire $AgentSanctionDisciplinaireStagiaire
     *
     * @return InformationColectiviteAgent
     */
    public function addAgentSanctionDisciplinaireStagiaire(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireStagiaire $AgentSanctionDisciplinaireStagiaire) {
        $this->AgentSanctionDisciplinaireStagiaire[] = $AgentSanctionDisciplinaireStagiaire;

        return $this;
    }

    /**
     * Remove AgentSanctionDisciplinaireStagiaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireStagiaire $AgentSanctionDisciplinaireStagiaire
     */
    public function removeAgentSanctionDisciplinaireStagiaire(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireStagiaire $AgentSanctionDisciplinaireStagiaire) {
        $this->AgentSanctionDisciplinaireStagiaire->removeElement($AgentSanctionDisciplinaireStagiaire);
    }

    /**
     * Get SanctionDisciplinaireStagiaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSanctionDisciplinaireStagiaire() {
        return $this->AgentSanctionDisciplinaireStagiaire;
    }


    /**
     * Get AgentSanctionDisciplinaireContractuel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgentSanctionDisciplinaireContractuel() {
        return $this->AgentSanctionDisciplinaireContractuel;
    }

    /**
     * Add AgentSanctionDisciplinaireContractuel
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireContractuel $AgentSanctionDisciplinaireContractuel
     *
     * @return InformationColectiviteAgent
     */
    public function addAgentSanctionDisciplinaireContractuel(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireContractuel $AgentSanctionDisciplinaireContractuel) {
        $this->AgentSanctionDisciplinaireContractuel[] = $AgentSanctionDisciplinaireContractuel;

        return $this;
    }

    /**
     * Remove AgentSanctionDisciplinaireContractuel
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireContractuel $AgentSanctionDisciplinaireContractuel
     */
    public function removeAgentSanctionDisciplinaireContractuel(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireContractuel $AgentSanctionDisciplinaireContractuel) {
        $this->AgentSanctionDisciplinaireContractuel->removeElement($AgentSanctionDisciplinaireContractuel);
    }

    /**
     * Get SanctionDisciplinaireContractuel
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSanctionDisciplinaireContractuel() {
        return $this->AgentSanctionDisciplinaireContractuel;
    }
       

       /**
        * Add AgentMotifSanctionDisciplinaire
        *
        * @param \Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $AgentMotifSanctionDisciplinaire
        *
        * @return InformationColectiviteAgent
        */
       public function addAgentMotifSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $AgentMotifSanctionDisciplinaire) {
           $this->AgentMotifSanctionDisciplinaire[] = $AgentMotifSanctionDisciplinaire;

           return $this;
       }

       /**
        * Remove AgentMotifSanctionDisciplinaire
        *
        * @param \Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $AgentMotifSanctionDisciplinaire
        */
       public function removeAgentMotifSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $AgentMotifSanctionDisciplinaire) {
           $this->AgentMotifSanctionDisciplinaire->removeElement($AgentMotifSanctionDisciplinaire);
       }

       /**
        * Get AgentMotifSanctionDisciplinaire
        *
        * @return \Doctrine\Common\Collections\Collection
        */
       public function getAgentMotifSanctionDisciplinaire() {
           return $this->AgentMotifSanctionDisciplinaire;
       }

    /**
     * @return int
     */
    public function getQ425()
    {
        return $this->q425;
    }

    /**
     * @param int $q425
     */
    public function setQ425($q425)
    {
        $this->q425 = $q425;
    }

    /**
     * @return int
     */
    public function getQ3110()
    {
        return $this->q3110;
    }

    /**
     * @param int $q3110
     */
    public function setQ3110($q3110)
    {
        $this->q3110 = $q3110;
    }

    /**
     * @return int
     */
    public function getQ3111()
    {
        return $this->q3111;
    }

    /**
     * @param int $q3111
     */
    public function setQ3111($q3111)
    {
        $this->q3111 = $q3111;
    }

    /**
     * @return int
     */
    public function getRifseepContractuel()
    {
        return $this->rifseepContractuel;
    }

    /**
     * @param int $rifseepContractuel
     */
    public function setRifseepContractuel($rifseepContractuel)
    {
        $this->rifseepContractuel = $rifseepContractuel;
    }

    /**
     * @return int
     */
    public function getMpccm()
    {
        return $this->mpccm;
    }

    /**
     * @param int $mpccm
     */
    public function setMpccm($mpccm)
    {
        $this->mpccm = $mpccm;
    }

    /**
     * @return int
     */
    public function getR13221()
    {
        return $this->r13221;
    }

    /**
     * @param int $r13221
     */
    public function setR13221($r13221)
    {
        $this->r13221 = $r13221;
    }

    /**
     * @return int
     */
    public function getR13222()
    {
        return $this->r13222;
    }

    /**
     * @param int $r13222
     */
    public function setR13222($r13222)
    {
        $this->r13222 = $r13222;
    }

    /**
     * @return int
     */
    public function getR13223()
    {
        return $this->r13223;
    }

    /**
     * @param int $r13223
     */
    public function setR13223($r13223)
    {
        $this->r13223 = $r13223;
    }

    /**
     * @return int
     */
    public function getR13224()
    {
        return $this->r13224;
    }

    /**
     * @param int $r13224
     */
    public function setR13224($r13224)
    {
        $this->r13224 = $r13224;
    }

    /**
     * @return bool
     */
    public function isQ2171()
    {
        return $this->q2171;
    }

    /**
     * @param bool $q2171
     */
    public function setQ2171( $q2171)
    {
        $this->q2171 = $q2171;
    }

    /**
     * @return bool
     */
    public function isR2171()
    {
        return $this->r2171;
    }

    /**
     * @param bool $r2171
     */
    public function setR2171($r2171)
    {
        $this->r2171 = $r2171;
    }

    /**
     * @return bool
     */
    public function isQ2172()
    {
        return $this->q2172;
    }

    /**
     * @param bool $q2172
     */
    public function setQ2172($q2172)
    {
        $this->q2172 = $q2172;
    }

    /**
     * @return bool
     */
    public function isR2172()
    {
        return $this->r2172;
    }

    /**
     * @param bool $r2172
     */
    public function setR2172($r2172)
    {
        $this->r2172 = $r2172;
    }

    /**
     * @return bool
     */
    public function isQ2173()
    {
        return $this->q2173;
    }

    /**
     * @param bool $q2173
     */
    public function setQ2173($q2173)
    {
        $this->q2173 = $q2173;
    }

    /**
     * @return bool
     */
    public function isR2173()
    {
        return $this->r2173;
    }

    /**
     * @param bool $r2173
     */
    public function setR2173($r2173)
    {
        $this->r2173 = $r2173;
    }

    /**
     * @return bool
     */
    public function isQ2174()
    {
        return $this->q2174;
    }

    /**
     * @param bool $q2174
     */
    public function setQ2174($q2174)
    {
        $this->q2174 = $q2174;
    }

    /**
     * @return bool
     */
    public function isR2174()
    {
        return $this->r2174;
    }

    /**
     * @param bool $r2174
     */
    public function setR2174($r2174)
    {
        $this->r2174 = $r2174;
    }


}
