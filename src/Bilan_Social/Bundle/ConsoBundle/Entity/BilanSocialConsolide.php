<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

class BilanSocialConsolide{


    /**
     * @var integer
     */
    private $idBilasocicons;
    private $enquete;
    private $collectivite;
    private $questionCollectiviteConsolide;
    private $ind1101s;
    private $ind1101sTemp;
    private $ind1102s;
    private $ind1102sTemp;
    private $ind1103s;
    private $ind1103sTemp;
    private $ind111s;
    private $ind111sTemp;
    private $ind111AotmsTemp;
    private $ind112s;
    private $ind112sTemp;
    private $ind112AotmsTemp;
    private $ind113s;
    private $ind114s;
    private $ind114sTemp;
    private $ind121s;
    private $ind121sTemp;
    private $ind121AotmsTemp;
    private $ind122s;
    private $ind122sTemp;
    private $ind122AotmsTemp;
    private $ind123s;
    private $ind124s;
    private $ind124sTemp;
    private $ind1311s;
    private $ind1311sTemp;
    private $ind1312s;
    private $ind1312sTemp;
    private $ind132s;
    private $ind132Biss;
    private $ind141s;
    private $ind142s;
    private $ind143s;
    private $ind144s;
    private $ind1501s;
    private $ind1502s;
    private $ind1511s;
    private $ind1512s;
    private $ind1513s;
    private $ind152s;
    private $ind152sTemp;
    private $ind152AotmsTemp;
    private $ind1531s;
    private $ind1532s;
    private $ind1532sTemp;
    private $ind1532AotmsTemp;
    private $ind154s;
    private $ind155s;
//    private $ind156s;
    private $ind157s;
    private $ind158s;
    private $ind158sTemp;
    private $ind158AotmsTemp;
    private $ind171s;
    private $ind171sTemp;
    private $ind161s;
    private $ind1612s;
    private $ind2111s;
    private $ind2112s;
    private $ind2113s;
    private $ind2121s;
    private $ind2122s;
    private $ind2123s;
    private $ind2131s;
    private $ind2132s;
    private $ind2133s;
    private $ind214s;
    private $ind215s;
    private $ind216s;
    private $ind221s;
    private $ind222s;
    private $ind2231s;
    private $ind2232s;
    private $ind2233s;
    private $ind2261s;
    private $ind2262s;
    private $ind2263s;
    private $ind224s;
    private $ind231s;
    private $ind311s;
    private $ind311sTemp;
    private $ind311AotmsTemp;
    private $ind321s;
    private $ind321sTemp;
    private $ind321AotmsTemp;
    private $ind331s;
    private $ind344s;
    private $ind344sTemp;
    private $ind344AotmsTemp;
    private $ind411s;
    private $ind412s;
    private $ind421s;
    private $ind421sTemp;
    private $ind421AotmsTemp;
    private $ind421HsTemp;
    private $ind422s;
    private $ind422sTemp;
    private $ind422AotmsTemp;
    private $ind422HsTemp;
    private $ind423s;
    private $ind423sFili;
    private $ind424s;
    private $ind431s;
    private $ind5111s;
    private $ind5112s;
    private $ind5113s;
    private $ind5121s;
    private $ind5122s;
    private $ind513s;
    private $ind613s;
    private $ind6141s;
    private $ind6143s;
    private $ind6144s;
    private $ind6142s;
    private $ind7141s;
    private $ind7142s;

    private $bscRassctAccidentTravails;
    private $bscRassctInformationCollectivite;


    private $nbAgentContractuelEmploiPermanent;
    private $nbAgentContractuelEmploiNonPermament;
    private $nbAgentEmploiPermanent;
    private $nbAgentTitulaire;

    /**
     * @var integer
     */
    private $q3110;

    /**
     * @var integer
     */
    private $q3111;

    /**
     * @var integer
     */
    private $rifseepContractuel;



    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bscRassctRealisationFormationSanteTravails;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bscRassctPrevisionFormationSanteTravails;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bscRassctAutresMesures;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bscRassctPredictionsAutresMesures;
    private $bscRassctNbMaladiePros;
    private $bscRassctNbAccidentTravails;
    private $bscRassctNatureLesions;
    private $bscRassctSiegeLesions;
    private $bscRassctElementMateriels;
    private $bscRassctMaladieProCaracPros;
    private $bscGpeecNbAgentsTituEmpPermaParFoncEtAges;
    private $bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp;
    private $bscGpeecPlusNbAgentsParSpeEtAges;
    private $bscGpeecPlusNbAgentsParSpeEtAgesTemp;
    private $bscGpeecNiveauDiplomes;

    /**
     * @var \Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialQuestionsGenerales
     */
    private $bscHanditorialQuestionsGenerales;
    private $bscHanditorialInaptitudeEtReclassement;
    private $bscHanditorialQuestionsBoeths;
    private $bscHanditorialNatureHandicaps;
    private $bscHanditorialAvisInaptitudes;
    private $bscHanditorialMesureInaptitudes;
    private $bscHanditorialAvisInaptitudesAvant;
    private $bscHanditorialMesureInaptitudesAvant;
    private $bscHanditorialAncienneteAgents;
    private $bscHanditorialModeEntrees;
    private $bscHanditorialStatutAgents;
    private $bscHanditorialArticles;
    private $bscHanditorialModeSortiesTitulaire;
    private $bscHanditorialModeSortiesNonTitulaire;
    private $bscHanditorialDerniersDiplomes;
    private $bscHanditorialCadreEmplois;
    private $bscHanditorialCadreEmploisTemp;
    private $bscHanditorialInaptEtReclaCadreEmplois;
    private $bscHanditorialInaptEtReclaCadreEmploisTemp;
    private $bscHanditorialMetiers;
    private $bscHanditorialMetiersTemp;
    private $bscHanditorialInaptEtReclaMetiers;
    private $bscHanditorialInaptEtReclaMetiersTemp;
    private $bscHanditorialTempsComplets;
    private $bscHanditorialInaptEtReclaTempsComplets;
    private $bscHanditorialTempsPleins;

    /*-----------------------
    * partie dgcl
    -----------------------*/

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bscDgclJoursCarenceTitulaires;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bscDgclJoursCarenceContractuels;

    private $incoherenceLogs;
    private $blIncoInd110;
    private $moyenneInd110;
    private $blIncoInd111;
    private $moyenneInd111;
    private $blIncoInd112;
    private $moyenneInd112;
    private $blIncoInd113;
    private $moyenneInd113;
    private $blIncoInd114;
    private $moyenneInd114;
    private $blIncoInd121;
    private $moyenneInd121;
    private $blIncoInd122;
    private $moyenneInd122;
    private $blIncoInd123;
    private $moyenneInd123;
    private $blIncoInd124;
    private $moyenneInd124;
    private $blIncoInd131;
    private $moyenneInd131;
    private $blIncoInd132;
    private $moyenneInd132;
    private $blIncoInd140;
    private $moyenneInd140;
    private $blIncoInd150;
    private $moyenneInd150;
    private $blIncoInd151;
    private $moyenneInd151;
    private $blIncoInd152;
    private $moyenneInd152;
    private $blIncoInd1531;
    private $moyenneInd1531;
    private $blIncoInd1532;
    private $moyenneInd1532;
    private $blIncoInd154;
    private $moyenneInd154;
    private $blIncoInd155;
    private $moyenneInd155;
//    private $blIncoInd156;
//    private $moyenneInd156;
    private $blIncoInd157;
    private $moyenneInd157;
    private $blIncoInd158;
    private $moyenneInd158;
    private $blIncoInd161;
    private $moyenneInd161;
    private $blIncoInd162;
    private $moyenneInd162;
    private $blIncoInd171;
    private $moyenneInd171;
    private $blIncoEff;

    private $blIncoTpsTrav;
    private $blIncoInd210;
    private $moyenneInd210;
    private $blIncoInd211;
    private $moyenneInd211;
    private $blIncoInd212;
    private $moyenneInd212;
    private $blIncoInd213;
    private $moyenneInd213;
    private $blIncoInd214;
    private $moyenneInd214;
    private $blIncoInd215;
    private $moyenneInd215;
    private $blIncoInd216;
    private $moyenneInd216;
    private $blIncoInd217;
    private $moyenneInd217;
    private $blIncoInd221;
    private $moyenneInd221;
    private $blIncoInd222;
    private $moyenneInd222;
    private $blIncoInd223;
    private $moyenneInd223;
    private $blIncoInd224;
    private $moyenneInd224;
    private $blIncoInd225;
    private $moyenneInd225;
    private $blIncoInd226;
    private $moyenneInd226;
    private $blIncoInd231;
    private $moyenneInd231;
    private $blIncoMouv;

    private $blIncoConditions;
    private $blIncoInd411;
    private $moyenneInd411;
    private $blIncoInd413;
    private $moyenneInd413;
    private $blIncoInd414;
    private $moyenneInd414;
    private $blIncoInd421;
    private $moyenneInd421;
    private $blIncoInd422;
    private $moyenneInd422;
    private $blIncoInd423;
    private $moyenneInd423;
    private $blIncoInd424;
    private $moyenneInd424;
    private $blIncoInd425;
    private $moyenneInd425;
    private $blIncoInd431;
    private $moyenneInd431;


    private $blIncoRemuneration;
    private $blIncoInd311;
    private $moyenneInd311;
    private $blIncoInd321;
    private $moyenneInd321;
    private $blIncoInd331;
    private $moyenneInd331;
    private $blIncoInd341;
    private $moyenneInd341;
    private $blIncoInd342;
    private $moyenneInd342;
    private $blIncoInd343;
    private $moyenneInd343;
    private $blIncoInd344;
    private $moyenneInd344;
    private $blIncoInd345;
    private $moyenneInd345;

    private $blIncoFormation;

    private $blIncoInd5111;
    private $moyenneInd5111;
    private $blIncoInd5112;
    private $moyenneInd5112;
    private $blIncoInd5113;
    private $moyenneInd5113;

    private $blIncoInd512;
    private $moyenneInd512;
    private $blIncoInd513;
    private $moyenneInd513;
    private $blIncoInd514;
    private $moyenneInd514;


    private $blIncoDroit;
    private $blIncoInd611;
    private $moyenneInd611;
    private $blIncoInd612;
    private $moyenneInd612;
    private $blIncoInd613;
    private $moyenneInd613;
    private $blIncoInd614;
    private $moyenneInd614;

    private $blIncoInd711;
    private $moyenneInd711;
    private $blIncoInd712;
    private $moyenneInd712;
    private $blIncoInd713;
    private $moyenneInd713;
    private $blIncoInd714;
    private $moyenneInd714;

    private $blIncoRassct;
    private $blIncoRassctAccidentTravail;
    private $moyenneRassctAccidentTravail;
    private $blIncoRassctRealisationFormationSanteTravail;
    private $moyenneRassctRealisationFormationSanteTravail;
    private $blIncoRassctPrevisionFormationSanteTravail;
    private $moyenneRassctPrevisionFormationSanteTravail;
    private $blIncoRassctAutresMesures;
    private $moyenneRassctAutresMesures;
    private $blIncoRassctPredictionsAutresMesures;
    private $moyenneRassctPredictionsAutresMesures;
    private $blIncoRassctNbMaladiePro;
    private $moyenneRassctNbMaladiePro;
    private $blIncoRassctNbAccidentTravail;
    private $moyenneRassctNbAccidentTravail;
    private $blIncoRassctNatureLesion;
    private $moyenneRassctNatureLesion;
    private $blIncoRassctSiegeLesion;
    private $moyenneRassctSiegeLesion;
    private $blIncoRassctElementMateriel;
    private $moyenneRassctElementMateriel;
    private $blIncoRassctMaladieProCaracPro;
    private $moyenneRassctMaladieProCaracPro;
    private $blIncoGpeec;
    private $blIncoGpeecNbAgentsTituEmpPermaParFoncEtAge;
    private $moyenneGpeecNbAgentsTituEmpPermaParFoncEtAge;
    private $blIncoGpeecPlusNbAgentsParSpeEtAge;
    private $moyenneGpeecPlusNbAgentsParSpeEtAge;
    private $moyenneGpeecNiveauDiplome;
    private $blIncoGpeecNiveauDiplome;
    private $blIncoHanditorial;
    private $blIncoHanditorialQuestionsGenerales;
    private $moyenneHanditorialQuestionsGenerales;
    private $blIncoHanditorialInaptitudeEtReclassement;
    private $moyenneHanditorialInaptitudeEtReclassement;
    private $blIncoHanditorialQuestionsBoeths;
    private $moyenneHanditorialQuestionsBoeths;
    private $blIncoHanditorialNatureHandicaps;
    private $moyenneHanditorialNatureHandicaps;
    private $blIncoHanditorialAvisInaptitudes;
    private $moyenneHanditorialAvisInaptitudes;
    private $blIncoHanditorialCadreEmplois;
    private $moyenneHanditorialCadreEmplois;
    private $blIncoHanditorialInaptEtReclaCadreEmplois;
    private $moyenneHanditorialInaptEtReclaCadreEmplois;
    private $blIncoHanditorialMetiers;
    private $moyenneHanditorialMetiers;
    private $blIncoHanditorialInaptEtReclaMetiers;
    private $moyenneHanditorialInaptEtReclaMetiers;
    private $blIncoHanditorialTempsComplets;
    private $moyenneHanditorialTempsComplets;
    private $blIncoHanditorialInaptEtReclaTempsComplets;
    private $moyenneHanditorialInaptEtReclaTempsComplets;
    private $blIncoRassctInformationCollectivite;
    private $moyenneRassctInformationCollectivite;

    private $blIncoDgcl;
    private $blIncoDgclJoursCarence;
    private $moyenneDgclJoursCarence;
    private $blIncoDgclJoursCarenceTitulaire;
    private $moyenneDgclJoursCarenceTitulaire;
    private $blIncoDgclJoursCarenceContractuel;
    private $moyenneDgclJoursCarenceContractuel;
    private $blUpdated;


    /**
     * @var integer
     */
    private $q132;

    /**
     * @var integer
     */
    private $q161;

    /**
     * @var string
     */
    private $r16211;

    /**
     * @var string
     */
    private $r16212;

    /**
     * @var string
     */
    private $r16213;

    /**
     * @var string
     */
    private $r16214;

    /**
     * @var integer
     */
    private $r16221;

    /**
     * @var string
     */
    private $r16222;

    /**
     * @var string
     */
    private $r16223;

    private $r2101;
    private $r2102;
    private $r2103;
    private $r2104;


    private $blIncoInd227;
    private $moyenneInd227;
    private $r2271;
    private $r2272;

    /**
     * @var integer
     */
    private $q215;

    /**
     * @var integer
     */
    private $q216;

    private $r2171;
    private $r2172;
    private $r2173;
    private $r2174;
    private $r2175;
    private $r2176;
    private $r2177;
    private $r2178;
    private $ind2211Cycle;
    private $ind2212Cycle;

    /**
     * @var integer
     */
    private $q221;

    /**
     * @var boolean
     */
    private $q224;

    /**
     * @var integer
     */
    private $q225;

    /**
     * @var integer
     */
    private $q3411;

    /**
     * @var integer
     */
    private $q3412;

    /**
     * @var integer
     */
    private $r3411;

    /**
     * @var integer
     */
    private $r3412;

    /**
     * @var integer
     */
    private $q3421;

    /**
     * @var integer
     */
    private $q3422;

    /**
     * @var integer
     */
    private $q3423;

    /**
     * @var integer
     */
    private $r342;

    /**
     * @var boolean
     */
    private $q343;

    /**
     * @var boolean
     */
    private $q344;

    /**
     * @var integer
     */
    private $r3451;

    /**
     * @var integer
     */
    private $r3452;

    /**
     * @var string
     */
    private $r3453;

    /**
     * @var integer
     */
    private $r4131;

    /**
     * @var integer
     */
    private $r4132;

    /**
     * @var integer
     */
    private $q414;

    /**
     * @var \DateTime
     */
    private $r4141;

    /**
     * @var \DateTime
     */
    private $r4142;

    /**
     * @var integer
     */
    private $q415;

    /**
     * @var integer
     */
    private $q4161;

    /**
     * @var integer
     */
    private $q4162;

    /**
     * @var integer
     */
    private $q4163;

    /**
     * @var integer
     */
    private $q417;

    /**
     * @var integer
     */
    private $q421;

    /**
     * @var decimal
     */
    private $r421;


    /**
     * @var integer
     */
    private $q422;


    /**
     * @var integer
     */
    private $q425;




    /**
     * @var integer
     */
    private $q4311;

    /**
     * @var integer
     */
    private $q4312;

    /**
     * @var integer
     */
    private $q4313;

    /**
     * @var integer
     */
    private $r5141;

    /**
     * @var integer
     */
    private $r5142;

    /**
     * @var integer
     */
    private $r5143;

    /**
     * @var integer
     */
    private $r5144;

    /**
     * @var integer
     */
    private $r6111;

    /**
     * @var integer
     */
    private $r6112;

    /**
     * @var integer
     */
    private $q6113;

    /**
     * @var integer
     */
    private $r6113;

    /**
     * @var integer
     */
    private $q6114;

    /**
     * @var integer
     */
    private $r6114;

    /**
     * @var integer
     */
    private $r6115;

  /**
   * @var integer
   */
    private $r6116;

    /**
     * @var integer
     */
    private $r6117;
    /**
     * @var integer
     */
    private $r6121;
    /**
     * @var integer
     */
    private $r6122;
    /**
     * @var integer
     */
    private $r6123;
    /**
     * @var integer
     */
    private $r6124;
    /**
     * @var integer
     */
    private $r6125;
    /**
     * @var integer
     */
    private $r6126;

    /**
     * @var integer
     */
    private $r7133;

    /**
     * @var integer
     */
    private $q613;

    /**
     * @var integer
     */
    private $q7111;

    /**
     * @var integer
     */
    private $q7112;

    /*
     * @var integer
     */
    /* private $q7121; */
/**
     * @var integer
     */
    private $q7122;

    /**
     * @var integer
     */
    private $q7131;

    /**
     * @var integer
     */
    private $q7132;

    /**
     * @var integer
     */
    private $q7133;

    /**
     * @var integer
     */
    private $qS7141;

    /**
     * @var integer
     */
    private $qS7142;

    /**
     * @var integer
     */
    private $qP7143;

    /**
     * @var integer
     */
    private $qP7144;

    /**
     * @var integer
     */
    private $r71411HC;

    /**
     * @var integer
     */
    private $r71412HC;

    /**
     * @var integer
     */
    private $r71421HC;

    /**
     * @var integer
     */
    private $r71422HC;


    /**
     * @var boolean
     */
    private $qHandiB22;

    /**
     * @var boolean
     */
    private $qHandiB23;

    /**
     * @var boolean
     */
    private $qHandiB41A;

    /**
     * @var boolean
     */
    private $qHandiB41B;

    /**
     * @var string
     */
    private $fgStat;

    /**
     * @var boolean
     */
    private $blVali;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var string
     */
    private $cdUtilmodi;
    /*
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;
    private $coherenceErrorJson;

    /**
     * Get idBilasocicons
     *
     * @return integer
     */
    public function getIdBilasocicons()
    {
        return $this->idBilasocicons;
    }

    /**
     * Set q132
     *
     * @param integer $q132
     * @return BilanSocialConsolide
     */
    public function setQ132($q132)
    {
        $this->q132 = $q132;

        return $this;
    }

    /**
     * Get q132
     *
     * @return integer
     */
    public function getQ132()
    {
        return $this->q132;
    }

    /**
     * Set q161
     *
     * @param integer $q161
     * @return BilanSocialConsolide
     */
    public function setQ161($q161)
    {
        $this->q161 = $q161;

        return $this;
    }

    /**
     * Get q161
     *
     * @return integer
     */
    public function getQ161()
    {
        return $this->q161;
    }

    /**
     * Set r16211
     *
     * @param string $r16211
     * @return BilanSocialConsolide
     */
    public function setR16211($r16211)
    {
        $this->r16211 = $r16211;

        return $this;
    }

    /**
     * Get r16211
     *
     * @return string
     */
    public function getR16211()
    {
        return $this->r16211;
    }

    /**
     * Set r16212
     *
     * @param string $r16212
     * @return BilanSocialConsolide
     */
    public function setR16212($r16212)
    {
        $this->r16212 = $r16212;

        return $this;
    }

    /**
     * Get r16212
     *
     * @return string
     */
    public function getR16212()
    {
        return $this->r16212;
    }

    /**
     * Set r16213
     *
     * @param string $r16213
     * @return BilanSocialConsolide
     */
    public function setR16213($r16213)
    {
        $this->r16213 = $r16213;

        return $this;
    }

    /**
     * Get r16213
     *
     * @return string
     */
    public function getR16213()
    {
        return $this->r16213;
    }

    /**
     * Set r16214
     *
     * @param string $r16214
     * @return BilanSocialConsolide
     */
    public function setR16214($r16214)
    {
        $this->r16214 = $r16214;

        return $this;
    }

    /**
     * Get r16214
     *
     * @return string
     */
    public function getR16214()
    {
        return $this->r16214;
    }

    /**
     * Set r16221
     *
     * @param integer $r16221
     * @return BilanSocialConsolide
     */
    public function setR16221($r16221)
    {
        $this->r16221 = $r16221;

        return $this;
    }

    /**
     * Get r16221
     *
     * @return integer
     */
    public function getR16221()
    {
        return $this->r16221;
    }

    /**
     * Set r16222
     *
     * @param string $r16222
     * @return BilanSocialConsolide
     */
    public function setR16222($r16222)
    {
        $this->r16222 = $r16222;

        return $this;
    }

    /**
     * Get r16222
     *
     * @return string
     */
    public function getR16222()
    {
        return $this->r16222;
    }

    /**
     * Set r16223
     *
     * @param string $r16223
     * @return BilanSocialConsolide
     */
    public function setR16223($r16223)
    {
        $this->r16223 = $r16223;

        return $this;
    }

    /**
     * Get r16223
     *
     * @return string
     */
    public function getR16223()
    {
        return $this->r16223;
    }

    /**
     * Set q215
     *
     * @param integer $q215
     * @return BilanSocialConsolide
     */
    public function setq215($q215)
    {
        $this->q215 = $q215;

        return $this;
    }

    /**
     * Get q215
     *
     * @return integer
     */
    public function getq215()
    {
        return $this->q215;
    }

    /**
     * Set q216
     *
     * @param integer $q216
     * @return BilanSocialConsolide
     */
    public function setq216($q216)
    {
        $this->q216 = $q216;

        return $this;
    }

    /**
     * Get q216
     *
     * @return integer
     */
    public function getq216()
    {
        return $this->q216;
    }


    /**
     * Set q221
     *
     * @param integer $q221
     * @return BilanSocialConsolide
     */
    public function setQ221($q221)
    {
        $this->q221 = $q221;

        return $this;
    }

    /**
     * Get q221
     *
     * @return integer
     */
    public function getQ221()
    {
        return $this->q221;
    }

    /**
     * Set q224
     *
     * @param boolean $q224
     * @return BilanSocialConsolide
     */
    public function setQ224($q224)
    {
        $this->q224 = $q224;

        return $this;
    }

    /**
     * Get q224
     *
     * @return boolean
     */
    public function getQ224()
    {
        return $this->q224;
    }

    /**
     * Set q225
     *
     * @param integer $q225
     * @return BilanSocialConsolide
     */
    public function setQ225($q225)
    {
        $this->q225 = $q225;

        return $this;
    }

    /**
     * Get q225
     *
     * @return integer
     */
    public function getQ225()
    {
        return $this->q225;
    }

    /**
     * Set q3411
     *
     * @param integer $q3411
     * @return BilanSocialConsolide
     */
    public function setQ3411($q3411)
    {
        $this->q3411 = $q3411;

        return $this;
    }

    /**
     * Get q3411
     *
     * @return integer
     */
    public function getQ3411()
    {
        return $this->q3411;
    }

    /**
     * Set q3412
     *
     * @param integer $q3412
     * @return BilanSocialConsolide
     */
    public function setQ3412($q3412)
    {
        $this->q3412 = $q3412;

        return $this;
    }

    /**
     * Get q3412
     *
     * @return integer
     */
    public function getQ3412()
    {
        return $this->q3412;
    }

    /**
     * Set q3421
     *
     * @param integer $q3421
     * @return BilanSocialConsolide
     */
    public function setQ3421($q3421)
    {
        $this->q3421 = $q3421;

        return $this;
    }

    /**
     * Get q3421
     *
     * @return integer
     */
    public function getQ3421()
    {
        return $this->q3421;
    }

    /**
     * Set q3422
     *
     * @param integer $q3422
     * @return BilanSocialConsolide
     */
    public function setQ3422($q3422)
    {
        $this->q3422 = $q3422;

        return $this;
    }

    /**
     * Get q3422
     *
     * @return integer
     */
    public function getQ3422()
    {
        return $this->q3422;
    }


    /**
     * Set q343
     *
     * @param boolean $q343
     * @return BilanSocialConsolide
     */
    public function setQ343($q343)
    {
        $this->q343 = $q343;

        return $this;
    }

    /**
     * Get q343
     *
     * @return boolean
     */
    public function getQ343()
    {
        return $this->q343;
    }


    /**
     * Set q344
     *
     * @param boolean $q344
     * @return BilanSocialConsolide
     */
    public function setQ344($q344)
    {
        $this->q344 = $q344;

        return $this;
    }

    /**
     * Get q344
     *
     * @return boolean
     */
    public function getQ344()
    {
        return $this->q344;
    }

    /**
     * Set r3451
     *
     * @param integer $r3451
     * @return BilanSocialConsolide
     */
    public function setR3451($r3451)
    {
        $this->r3451 = $r3451;

        return $this;
    }

    /**
     * Get r3451
     *
     * @return integer
     */
    public function getR3451()
    {
        return $this->r3451;
    }

    /**
     * Set r3452
     *
     * @param integer $r3452
     * @return BilanSocialConsolide
     */
    public function setR3452($r3452)
    {
        $this->r3452 = $r3452;

        return $this;
    }

    /**
     * Get r3452
     *
     * @return integer
     */
    public function getR3452()
    {
        return $this->r3452;
    }

    /**
     * Set r3453
     *
     * @param string $r3453
     * @return BilanSocialConsolide
     */
    public function setR3453($r3453)
    {
        $this->r3453 = $r3453;

        return $this;
    }

    /**
     * Get r3453
     *
     * @return string
     */
    public function getR3453()
    {
        return $this->r3453;
    }

    /**
     * Set r4131
     *
     * @param integer $r4131
     * @return BilanSocialConsolide
     */
    public function setR4131($r4131)
    {
        $this->r4131 = $r4131;

        return $this;
    }

    /**
     * Get r4131
     *
     * @return integer
     */
    public function getR4131()
    {
        return $this->r4131;
    }

    /**
     * Set r4132
     *
     * @param integer $r4132
     * @return BilanSocialConsolide
     */
    public function setR4132($r4132)
    {
        $this->r4132 = $r4132;

        return $this;
    }

    /**
     * Get r4132
     *
     * @return integer
     */
    public function getR4132()
    {
        return $this->r4132;
    }

    /**
     * Set q414
     *
     * @param integer $q414
     * @return BilanSocialConsolide
     */
    public function setQ414($q414)
    {
        $this->q414 = $q414;

        return $this;
    }

    /**
     * Get q414
     *
     * @return integer
     */
    public function getQ414()
    {
        return $this->q414;
    }

    /**
     * Set q415
     *
     * @param integer $q415
     * @return BilanSocialConsolide
     */
    public function setQ415($q415)
    {
        $this->q415 = $q415;

        return $this;
    }

    /**
     * Get q415
     *
     * @return integer
     */
    public function getQ415()
    {
        return $this->q415;
    }

    /**
     * Set q4161
     *
     * @param integer $q4161
     * @return BilanSocialConsolide
     */
    public function setQ4161($q4161)
    {
        $this->q4161 = $q4161;

        return $this;
    }

    /**
     * Get q4161
     *
     * @return integer
     */
    public function getQ4161()
    {
        return $this->q4161;
    }

    /**
     * Set q4162
     *
     * @param integer $q4162
     * @return BilanSocialConsolide
     */
    public function setQ4162($q4162)
    {
        $this->q4162 = $q4162;

        return $this;
    }

    /**
     * Get q4162
     *
     * @return integer
     */
    public function getQ4162()
    {
        return $this->q4162;
    }

    /**
     * Set q4163
     *
     * @param integer $q4163
     * @return BilanSocialConsolide
     */
    public function setQ4163($q4163)
    {
        $this->q4163 = $q4163;

        return $this;
    }

    /**
     * Get q4163
     *
     * @return integer
     */
    public function getQ4163()
    {
        return $this->q4163;
    }

    /**
     * Set q417
     *
     * @param integer $q417
     * @return BilanSocialConsolide
     */
    public function setQ417($q417)
    {
        $this->q417 = $q417;

        return $this;
    }

    /**
     * Get q417
     *
     * @return integer
     */
    public function getQ417()
    {
        return $this->q417;
    }

    /**
     * Set q4311
     *
     * @param integer $q4311
     * @return BilanSocialConsolide
     */
    public function setQ4311($q4311)
    {
        $this->q4311 = $q4311;

        return $this;
    }

    /**
     * Get q4311
     *
     * @return integer
     */
    public function getQ4311()
    {
        return $this->q4311;
    }

    /**
     * Set q4312
     *
     * @param integer $q4312
     * @return BilanSocialConsolide
     */
    public function setQ4312($q4312)
    {
        $this->q4312 = $q4312;

        return $this;
    }

    /**
     * Get q4312
     *
     * @return integer
     */
    public function getQ4312()
    {
        return $this->q4312;
    }

    /**
     * Set q4313
     *
     * @param integer $q4313
     * @return BilanSocialConsolide
     */
    public function setQ4313($q4313)
    {
        $this->q4313 = $q4313;

        return $this;
    }

    /**
     * Get q4313
     *
     * @return integer
     */
    public function getQ4313()
    {
        return $this->q4313;
    }

    /**
     * Set r4141
     *
     * @param integer $r4141
     * @return BilanSocialConsolide
     */
    public function setR4141($r4141)
    {
        $this->r4141 = $r4141;

        return $this;
    }

    /**
     * Get r4141
     *
     * @return integer
     */
    public function getR4141()
    {
        return $this->r4141;
    }

    /**
     * Set r4142
     *
     * @param integer $r4142
     * @return BilanSocialConsolide
     */
    public function setR4142($r4142)
    {
        $this->r4142 = $r4142;

        return $this;
    }

    /**
     * Get r4142
     *
     * @return integer
     */
    public function getR4142()
    {
        return $this->r4142;
    }

    function getQHandiB22()
    {
        return $this->qHandiB22;
    }

    function setQHandiB22($qHandiB22)
    {
        $this->qHandiB22 = $qHandiB22;
    }

    function getQHandiB23()
    {
        return $this->qHandiB23;
    }

    function setQHandiB23($qHandiB23)
    {
        $this->qHandiB23 = $qHandiB23;
    }

    /**
     * Set fgStat
     *
     * @param string $fgStat
     * @return BilanSocialConsolide
     */
    public function setFgStat($fgStat)
    {
        $this->fgStat = $fgStat;

        return $this;
    }

    /**
     * Get fgStat
     *
     * @return string
     */
    public function getFgStat()
    {
        return $this->fgStat;
    }

    /**
     * Set blVali
     *
     * @param boolean $blVali
     * @return BilanSocialConsolide
     */
    public function setBlVali($blVali)
    {
        $this->blVali = $blVali;

        return $this;
    }

    /**
     * Get blVali
     *
     * @return boolean
     */
    public function getBlVali()
    {
        return $this->blVali;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return BilanSocialConsolide
     */
    public function setDtCrea($dtCrea)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea()
    {
        return $this->dtCrea;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     * @return BilanSocialConsolide
     */
    public function setCdUtilcrea($cdUtilcrea)
    {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea()
    {
        return $this->cdUtilcrea;
    }

    /**
     * Set dtModi
     *
     * @param \DateTime $dtModi
     * @return BilanSocialConsolide
     */
    public function setDtModi($dtModi)
    {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi()
    {
        return $this->dtModi;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     * @return BilanSocialConsolide
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;
        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi()
    {
        return $this->cdUtilmodi;
    }

    function getQuestionCollectiviteConsolide()
    {
        return $this->questionCollectiviteConsolide;
    }

    function setQuestionCollectiviteConsolide($questionCollectiviteConsolide)
    {
        $this->questionCollectiviteConsolide = $questionCollectiviteConsolide;
    }

    function getInd1101s()
    {
        return $this->ind1101s;
    }

    function setInd1101s($ind1101s)
    {
        $this->ind1101s = $ind1101s;
    }

    function getInd1102s()
    {
        return $this->ind1102s;
    }

    function setInd1102s($ind1102s)
    {
        $this->ind1102s = $ind1102s;
    }

    function getInd1103s()
    {
        return $this->ind1103s;
    }

    function setInd1103s($ind1103s)
    {
        $this->ind1103s = $ind1103s;
    }

    function getInd113s()
    {
        return $this->ind113s;
    }

    function setInd113s($ind113s)
    {
        $this->ind113s = $ind113s;
    }

    function getInd111s()
    {
        return $this->ind111s;
    }

    function setInd111s($ind111s)
    {
        $this->ind111s = $ind111s;
    }

    function getInd112s()
    {
        return $this->ind112s;
    }

    function setInd112s($ind112s)
    {
        $this->ind112s = $ind112s;
    }

    function getCoherenceErrorJson()
    {
        return $this->coherenceErrorJson;
    }

    function setCoherenceErrorJson($coherenceErrorJson)
    {
        $this->coherenceErrorJson = $coherenceErrorJson;
    }

    function getIncoherenceLogs()
    {
        return $this->incoherenceLogs;
    }

    function setIncoherenceLogs($incoherenceLogs)
    {
        $this->incoherenceLogs = $incoherenceLogs;
    }

    function getInd114s()
    {
        return $this->ind114s;
    }

    function setInd114s($ind114s)
    {
        $this->ind114s = $ind114s;
    }

    function getInd114sTemp()
    {
        return $this->ind114sTemp;
    }

    function setInd114sTemp($ind114sTemp)
    {
        $this->ind114sTemp = $ind114sTemp;
    }

    function getInd121s()
    {
        return $this->ind121s;
    }

    function setInd121s($ind121s)
    {
        $this->ind121s = $ind121s;
    }

    function getInd122s()
    {
        return $this->ind122s;
    }

    function setInd122s($ind122s)
    {
        $this->ind122s = $ind122s;
    }

    function getInd122AotmsTemp()
    {
        return $this->ind122AotmsTemp;
    }

    function setInd122AotmsTemp($ind122AotmsTemp)
    {
        $this->ind122AotmsTemp = $ind122AotmsTemp;
    }

    function getInd123s()
    {
        return $this->ind123s;
    }

    function setInd123s($ind123s)
    {
        $this->ind123s = $ind123s;
    }

    function getInd124s()
    {
        return $this->ind124s;
    }

    function setInd124s($ind124s)
    {
        $this->ind124s = $ind124s;
    }

    function getInd124sTemp()
    {
        return $this->ind124sTemp;
    }


    function setInd124sTemp($ind124sTemp)
    {
        $this->ind124sTemp = $ind124sTemp;
    }


    function getEnquete()
    {
        return $this->enquete;
    }

    function getCollectivite()
    {
        return $this->collectivite;
    }

    function setEnquete($enquete)
    {
        $this->enquete = $enquete;
    }

    function setCollectivite($collectivite)
    {
        $this->collectivite = $collectivite;
    }

    function getInd1311s()
    {
        return $this->ind1311s;
    }

    function getInd1312s()
    {
        return $this->ind1312s;
    }

    function setInd1311s($ind1311s)
    {
        $this->ind1311s = $ind1311s;
    }

    function setInd1312s($ind1312s)
    {
        $this->ind1312s = $ind1312s;
    }

    function getInd132s()
    {
        return $this->ind132s;
    }

    function setInd132s($ind132s)
    {
        $this->ind132s = $ind132s;
    }

    function getInd132Biss() {
        return $this->ind132Biss;
    }

    function setInd132Biss($ind132Biss) {
        $this->ind132Biss = $ind132Biss;
    }

    function getInd141s() {
        return $this->ind141s;
    }

    function setInd141s($ind141s)
    {
        $this->ind141s = $ind141s;
    }

    function getInd142s()
    {
        return $this->ind142s;
    }

    function getInd143s()
    {
        return $this->ind143s;
    }

    function getInd144s()
    {
        return $this->ind144s;
    }

    function setInd142s($ind142s)
    {
        $this->ind142s = $ind142s;
    }

    function setInd143s($ind143s)
    {
        $this->ind143s = $ind143s;
    }

    function setInd144s($ind144s)
    {
        $this->ind144s = $ind144s;
    }

    function getInd111sTemp()
    {
        return $this->ind111sTemp;
    }

    function setInd111sTemp($ind111sTemp)
    {
        $this->ind111sTemp = $ind111sTemp;
    }

    function getInd111AotmsTemp()
    {
        return $this->ind111AotmsTemp;
    }

    function setInd111AotmsTemp($ind111AotmsTemp)
    {
        $this->ind111AotmsTemp = $ind111AotmsTemp;
    }


    function getInd1101sTemp()
    {
        return $this->ind1101sTemp;
    }

    function getInd1102sTemp()
    {
        return $this->ind1102sTemp;
    }

    function getInd1103sTemp()
    {
        return $this->ind1103sTemp;
    }

    function setInd1101sTemp($ind1101sTemp)
    {
        $this->ind1101sTemp = $ind1101sTemp;
    }

    function setInd1102sTemp($ind1102sTemp)
    {
        $this->ind1102sTemp = $ind1102sTemp;
    }

    function setInd1103sTemp($ind1103sTemp)
    {
        $this->ind1103sTemp = $ind1103sTemp;
    }

    function getInd112sTemp()
    {
        return $this->ind112sTemp;
    }

    function setInd112sTemp($ind112sTemp)
    {
        $this->ind112sTemp = $ind112sTemp;
    }

    function getInd112AotmsTemp()
    {
        return $this->ind112AotmsTemp;
    }

    function setInd112AotmsTemp($ind112AotmsTemp)
    {
        $this->ind112AotmsTemp = $ind112AotmsTemp;
    }

    function getInd121sTemp()
    {
        return $this->ind121sTemp;
    }

    function setInd121sTemp($ind121sTemp)
    {
        $this->ind121sTemp = $ind121sTemp;
    }

    function getInd121AotmsTemp()
    {
        return $this->ind121AotmsTemp;
    }

    function setInd121AotmsTemp($ind121AotmsTemp)
    {
        $this->ind121AotmsTemp = $ind121AotmsTemp;
    }

    function getInd122sTemp()
    {
        return $this->ind122sTemp;
    }

    function setInd122sTemp($ind122sTemp)
    {
        $this->ind122sTemp = $ind122sTemp;
    }

    function getInd1311sTemp()
    {
        return $this->ind1311sTemp;
    }

    function setInd1311sTemp($ind1311sTemp)
    {
        $this->ind1311sTemp = $ind1311sTemp;
    }

    function getInd1312sTemp()
    {
        return $this->ind1312sTemp;
    }

    function setInd1312sTemp($ind1312sTemp)
    {
        $this->ind1312sTemp = $ind1312sTemp;
    }

    function getInd1501s()
    {
        return $this->ind1501s;
    }

    function getInd1502s()
    {
        return $this->ind1502s;
    }

    function setInd1501s($ind1501s)
    {
        $this->ind1501s = $ind1501s;
    }

    function setInd1502s($ind1502s)
    {
        $this->ind1502s = $ind1502s;
    }

    function getInd1511s()
    {
        return $this->ind1511s;
    }

    function getInd1512s()
    {
        return $this->ind1512s;
    }

    function getInd1513s()
    {
        return $this->ind1513s;
    }

    function setInd1511s($ind1511s)
    {
        $this->ind1511s = $ind1511s;
    }

    function setInd1512s($ind1512s)
    {
        $this->ind1512s = $ind1512s;
    }

    function setInd1513s($ind1513s)
    {
        $this->ind1513s = $ind1513s;
    }

    function getInd152s()
    {
        return $this->ind152s;
    }

    function getInd152sTemp()
    {
        return $this->ind152sTemp;
    }

    function setInd152s($ind152s)
    {
        $this->ind152s = $ind152s;
    }

    function getInd152AotmsTemp()
    {
        return $this->ind152AotmsTemp;
    }

    function setInd152AotmsTemp($ind152AotmsTemp)
    {
        $this->ind152AotmsTemp = $ind152AotmsTemp;
    }

    function setInd152sTemp($ind152sTemp)
    {
        $this->ind152sTemp = $ind152sTemp;
    }

    function getInd1531s()
    {
        return $this->ind1531s;
    }

    function setInd1531s($ind1531s)
    {
        $this->ind1531s = $ind1531s;
    }

    function getInd1532s()
    {
        return $this->ind1532s;
    }

    function setInd1532s($ind1532s)
    {
        $this->ind1532s = $ind1532s;
    }

    function getInd1532sTemp()
    {
        return $this->ind1532sTemp;
    }

    function setInd1532sTemp($ind1532sTemp)
    {
        $this->ind1532sTemp = $ind1532sTemp;
    }

    function getInd1532AotmsTemp()
    {
        return $this->ind1532AotmsTemp;
    }

    function setInd1532AotmsTemp($ind1532AotmsTemp)
    {
        $this->ind1532AotmsTemp = $ind1532AotmsTemp;
    }

    function getInd154s()
    {
        return $this->ind154s;
    }

    function getInd155s()
    {
        return $this->ind155s;
    }

//    function getInd156s() {
//        return $this->ind156s;
//    }

    function getInd157s() {
        return $this->ind157s;
    }

    function setInd154s($ind154s)
    {
        $this->ind154s = $ind154s;
    }

    function setInd155s($ind155s)
    {
        $this->ind155s = $ind155s;
    }

//    function setInd156s($ind156s) {
//        $this->ind156s = $ind156s;
//    }

    function setInd157s($ind157s) {
        $this->ind157s = $ind157s;
    }

    function getInd158s()
    {
        return $this->ind158s;
    }

    function setInd158s($ind158s)
    {
        $this->ind158s = $ind158s;
    }

    function getInd158sTemp()
    {
        return $this->ind158sTemp;
    }

    function getInd158AotmsTemp()
    {
        return $this->ind158AotmsTemp;
    }

    function setInd158sTemp($ind158sTemp)
    {
        $this->ind158sTemp = $ind158sTemp;
    }

    function setInd158AotmsTemp($ind158AotmsTemp)
    {
        $this->ind158AotmsTemp = $ind158AotmsTemp;
    }

    function getInd161s()
    {
        return $this->ind161s;
    }

    function setInd161s($ind161s)
    {
        $this->ind161s = $ind161s;
    }

    function getInd171s()
    {
        return $this->ind171s;
    }

    function setInd171s($ind171s)
    {
        $this->ind171s = $ind171s;
    }

    function getInd171sTemp()
    {
        return $this->ind171sTemp;
    }

    function setInd171sTemp($ind171sTemp)
    {
        $this->ind171sTemp = $ind171sTemp;
    }

    function getInd2111s()
    {
        return $this->ind2111s;
    }

    function setInd2111s($ind2111s)
    {
        $this->ind2111s = $ind2111s;
    }

    function getInd2112s()
    {
        return $this->ind2112s;
    }

    function getInd2113s()
    {
        return $this->ind2113s;
    }

    function setInd2112s($ind2112s)
    {
        $this->ind2112s = $ind2112s;
    }

    function setInd2113s($ind2113s)
    {
        $this->ind2113s = $ind2113s;
    }

    function setInd222s($ind222s)
    {
        $this->ind222s = $ind222s;
    }

    function getInd222s()
    {
        return $this->ind222s;
    }

    function getInd2121s()
    {
        return $this->ind2121s;
    }

    function getInd2122s()
    {
        return $this->ind2122s;
    }

    function getInd2123s()
    {
        return $this->ind2123s;
    }

    function getInd2131s()
    {
        return $this->ind2131s;
    }

    function getInd2132s()
    {
        return $this->ind2132s;
    }

    function getInd2133s()
    {
        return $this->ind2133s;
    }

    function getInd214s()
    {
        return $this->ind214s;
    }

    function getInd215s()
    {
        return $this->ind215s;
    }

    function getInd216s()
    {
        return $this->ind216s;
    }

    function getInd2231s()
    {
        return $this->ind2231s;
    }

    function setInd2231s($ind2231s)
    {
        $this->ind2231s = $ind2231s;
    }

    function getInd2232s()
    {
        return $this->ind2232s;
    }

    function setInd2232s($ind2232s)
    {
        $this->ind2232s = $ind2232s;
    }

    function getInd2233s()
    {
        return $this->ind2233s;
    }

    function setInd2233s($ind2233s)
    {
        $this->ind2233s = $ind2233s;
    }

    function getInd224s()
    {
        return $this->ind224s;
    }

    function setInd224s($ind224s)
    {
        $this->ind224s = $ind224s;
    }

    function getInd2261s()
    {
        return $this->ind2261s;
    }

    function setInd2261s($ind2261s)
    {
        $this->ind2261s = $ind2261s;
    }
    
    function getInd2262s()
    {
        return $this->ind2262s;
    }

    function setInd2262s($ind2262s)
    {
        $this->ind2262s = $ind2262s;
    }  
    
    function getInd2263s()
    {
        return $this->ind2263s;
    }

    function setInd2263s($ind2263s)
    {
        $this->ind2263s = $ind2263s;
    }
    
    function getInd231s()
    {
        return $this->ind231s;
    }

    function setInd231s($ind231s)
    {
        $this->ind231s = $ind231s;
    }

    function getInd411s()
    {
        return $this->ind411s;
    }

    function setInd411s($ind411s)
    {
        $this->ind411s = $ind411s;
    }

    function getInd412s()
    {
        return $this->ind412s;
    }

    function setInd412s($ind412s)
    {
        $this->ind412s = $ind412s;
    }

    function getInd423s()
    {
        return $this->ind423s;
    }

    function setInd423s($ind423s)
    {
        $this->ind423s = $ind423s;
    }

    function getInd423sFili()
    {
        return $this->ind423sFili;
    }

    function setInd423sFili($ind423sFili)
    {
        $this->ind423sFili = $ind423sFili;
    }

    function getInd424s()
    {
        return $this->ind424s;
    }

    function setInd424s($ind424s)
    {
        $this->ind424s = $ind424s;
    }

    function getInd431s()
    {
        return $this->ind431s;
    }

    function setInd431s($ind431s)
    {
        $this->ind431s = $ind431s;
    }

    function getBscRassctAccidentTravails()
    {
        return $this->bscRassctAccidentTravails;
    }

    function setBscRassctAccidentTravails($bscRassctAccidentTravails)
    {
        $this->bscRassctAccidentTravails = $bscRassctAccidentTravails;
    }

    function getBscHanditorialTempsComplets()
    {
        return $this->bscHanditorialTempsComplets;
    }

    function setBscHanditorialTempsComplets($bscHanditorialTempsComplets)
    {
        $this->bscHanditorialTempsComplets = $bscHanditorialTempsComplets;
    }

    function getBscHanditorialInaptEtReclaTempsComplets()
    {
        return $this->bscHanditorialInaptEtReclaTempsComplets;
    }

    function setBscHanditorialInaptEtReclaTempsComplets($bscHanditorialInaptEtReclaTempsComplets)
    {
        $this->bscHanditorialInaptEtReclaTempsComplets = $bscHanditorialInaptEtReclaTempsComplets;
    }

    function getBscHanditorialTempsPleins()
    {
        return $this->bscHanditorialTempsPleins;
    }

    function setBscHanditorialTempsPleins($bscHanditorialTempsPleins)
    {
        $this->bscHanditorialTempsPleins = $bscHanditorialTempsPleins;
    }

    function getBlIncoTpsTrav()
    {
        return $this->blIncoTpsTrav;
    }

    function getBlIncoInd211()
    {
        return $this->blIncoInd211;
    }

    function getMoyenneInd211()
    {
        return $this->moyenneInd211;
    }

    function getBlIncoInd212()
    {
        return $this->blIncoInd212;
    }

    function getMoyenneInd212()
    {
        return $this->moyenneInd212;
    }

    function getBlIncoInd213()
    {
        return $this->blIncoInd213;
    }

    function getMoyenneInd213()
    {
        return $this->moyenneInd213;
    }

    function getBlIncoInd214()
    {
        return $this->blIncoInd214;
    }

    function getMoyenneInd214()
    {
        return $this->moyenneInd214;
    }

    function getBlIncoInd215()
    {
        return $this->blIncoInd215;
    }

    function getMoyenneInd215()
    {
        return $this->moyenneInd215;
    }

    function getBlIncoInd216()
    {
        return $this->blIncoInd216;
    }

    function getMoyenneInd216()
    {
        return $this->moyenneInd216;
    }

    function getMoyenneInd222()
    {
        return $this->moyenneInd222;
    }

    function getBlIncoInd222()
    {
        return $this->blIncoInd222;
    }

    function getMoyenneInd223()
    {
        return $this->moyenneInd223;
    }

    function getBlIncoInd223()
    {
        return $this->blIncoInd223;
    }
    function getMoyenneInd224()
    {
        return $this->moyenneInd224;
    }

    function getBlIncoInd224()
    {
        return $this->blIncoInd224;
    }

    function getMoyenneInd225()
    {
        return $this->moyenneInd225;
    }

    function getBlIncoInd225()
    {
        return $this->blIncoInd225;
    }

    function getMoyenneInd226()
    {
        return $this->moyenneInd226;
    }

    function getBlIncoInd226()
    {
        return $this->blIncoInd226;
    }

    function getMoyenneInd231()
    {
        return $this->moyenneInd231;
    }

    function getBlIncoInd231()
    {
        return $this->blIncoInd231;
    }

    function setInd2121s($ind2121s)
    {
        $this->ind2121s = $ind2121s;
    }

    function setInd2122s($ind2122s)
    {
        $this->ind2122s = $ind2122s;
    }

    function setInd2123s($ind2123s)
    {
        $this->ind2123s = $ind2123s;
    }

    function setInd2131s($ind2131s)
    {
        $this->ind2131s = $ind2131s;
    }

    function setInd2132s($ind2132s)
    {
        $this->ind2132s = $ind2132s;
    }

    function setInd2133s($ind2133s)
    {
        $this->ind2133s = $ind2133s;
    }

    function setInd214s($ind214s)
    {
        $this->ind214s = $ind214s;
    }

    function setInd215s($ind215s)
    {
        $this->ind215s = $ind215s;
    }

    function setInd216s($ind216s)
    {
        $this->ind216s = $ind216s;
    }

    function setBlIncoTpsTrav($blIncoTpsTrav)
    {
        $this->blIncoTpsTrav = $blIncoTpsTrav;
    }

    function setBlIncoInd211($blIncoInd211)
    {
        $this->blIncoInd211 = $blIncoInd211;
    }

    function setMoyenneInd211($moyenneInd211)
    {
        $this->moyenneInd211 = $moyenneInd211;
    }

    function setBlIncoInd212($blIncoInd212)
    {
        $this->blIncoInd212 = $blIncoInd212;
    }

    function setMoyenneInd212($moyenneInd212)
    {
        $this->moyenneInd212 = $moyenneInd212;
    }

    function setBlIncoInd213($blIncoInd213)
    {
        $this->blIncoInd213 = $blIncoInd213;
    }

    function setMoyenneInd213($moyenneInd213)
    {
        $this->moyenneInd213 = $moyenneInd213;
    }

    function setBlIncoInd214($blIncoInd214)
    {
        $this->blIncoInd214 = $blIncoInd214;
    }

    function setMoyenneInd214($moyenneInd214)
    {
        $this->moyenneInd214 = $moyenneInd214;
    }

    function setBlIncoInd215($blIncoInd215)
    {
        $this->blIncoInd215 = $blIncoInd215;
    }

    function setMoyenneInd215($moyenneInd215)
    {
        $this->moyenneInd215 = $moyenneInd215;
    }

    function setBlIncoInd216($blIncoInd216)
    {
        $this->blIncoInd216 = $blIncoInd216;
    }

    function setMoyenneInd216($moyenneInd216)
    {
        $this->moyenneInd216 = $moyenneInd216;
    }

    function getBlIncoInd217()
    {
        return $this->blIncoInd217;
    }

    function getMoyenneInd217()
    {
        return $this->moyenneInd217;
    }

    function setBlIncoInd217($blIncoInd217)
    {
        $this->blIncoInd217 = $blIncoInd217;
    }

    function setMoyenneInd217($moyenneInd217)
    {
        $this->moyenneInd217 = $moyenneInd217;
    }

    function setBlIncoInd222($blIncoInd222)
    {
        $this->blIncoInd222 = $blIncoInd222;
    }

    function setMoyenneInd222($moyenneInd222)
    {
        $this->moyenneInd222 = $moyenneInd222;
    }

    function setBlIncoInd223($blIncoInd223)
    {
        $this->blIncoInd223 = $blIncoInd223;
    }

    function setMoyenneInd223($moyenneInd223)
    {
        $this->moyenneInd223 = $moyenneInd223;
    }

    function setBlIncoInd224($blIncoInd224)
    {
        $this->blIncoInd224 = $blIncoInd224;
    }

    function setMoyenneInd224($moyenneInd224)
    {
        $this->moyenneInd224 = $moyenneInd224;
    }

    function setBlIncoInd225($blIncoInd225)
    {
        $this->blIncoInd225 = $blIncoInd225;
    }

    function setMoyenneInd225($moyenneInd225)
    {
        $this->moyenneInd225 = $moyenneInd225;
    }

    function setBlIncoInd226($blIncoInd226)
    {
        $this->blIncoInd226 = $blIncoInd226;
    }

    function setMoyenneInd226($moyenneInd226)
    {
        $this->moyenneInd226 = $moyenneInd226;
    }

    function setBlIncoInd231($blIncoInd231)
    {
        $this->blIncoInd231 = $blIncoInd231;
    }

    function setMoyenneInd231($moyenneInd231)
    {
        $this->moyenneInd231 = $moyenneInd231;
    }

    /*
     * Méthodes complémentaires
     */

    public function __construct()
    {
        $this->ind1101s = new ArrayCollection();
        $this->ind1101sTemp = new ArrayCollection();
        $this->ind1102s = new ArrayCollection();
        $this->ind1102sTemp = new ArrayCollection();
        $this->ind1103s = new ArrayCollection();
        $this->ind1103sTemp = new ArrayCollection();
        $this->ind111s = new ArrayCollection();
        $this->ind111sTemp = new ArrayCollection();
        $this->ind111AotmsTemp = new ArrayCollection();
        $this->ind112s = new ArrayCollection();
        $this->ind112sTemp = new ArrayCollection();
        $this->ind112AotmsTemp = new ArrayCollection();
        $this->ind113s = new ArrayCollection();
        $this->ind114s = new ArrayCollection();
        $this->ind114sTemp = new ArrayCollection();
        $this->ind121s = new ArrayCollection();
        $this->ind121sTemp = new ArrayCollection();
        $this->ind121AotmsTemp = new ArrayCollection();
        $this->ind122s = new ArrayCollection();
        $this->ind122sTemp = new ArrayCollection();
        $this->ind122AotmsTemp = new ArrayCollection();
        $this->ind123s = new ArrayCollection();
        $this->ind124s = new ArrayCollection();
        $this->ind124sTemp = new ArrayCollection();
        $this->ind1311s = new ArrayCollection();
        $this->ind1311sTemp = new ArrayCollection();
        $this->ind1312s = new ArrayCollection();
        $this->ind1312sTemp = new ArrayCollection();
        $this->ind132s = new ArrayCollection();
        $this->ind132Biss = new ArrayCollection();
        $this->ind141s = new ArrayCollection();
        $this->ind142s = new ArrayCollection();
        $this->ind143s = new ArrayCollection();
        $this->ind144s = new ArrayCollection();
        $this->ind1501s = new ArrayCollection();
        $this->ind1502s = new ArrayCollection();
        $this->ind1511s = new ArrayCollection();
        $this->ind1512s = new ArrayCollection();
        $this->ind1513s = new ArrayCollection();
        $this->ind152s = new ArrayCollection();
        $this->ind152sTemp = new ArrayCollection();
        $this->ind152AotmsTemp = new ArrayCollection();
        $this->ind1531s = new ArrayCollection();
        $this->ind1532s = new ArrayCollection();
        $this->ind1532sTemp = new ArrayCollection();
        $this->ind1532AotmsTemp = new ArrayCollection();
        $this->ind154s = new ArrayCollection();
        $this->ind155s = new ArrayCollection();
//        $this->ind156s = new ArrayCollection();
        $this->ind157s = new ArrayCollection();
        $this->ind158s = new ArrayCollection();
        $this->ind158sTemp = new ArrayCollection();
        $this->ind158AotmsTemp = new ArrayCollection();
        $this->ind171s = new ArrayCollection();
        $this->ind171sTemp = new ArrayCollection();
        $this->ind161s = new ArrayCollection();
        $this->ind1612s = new ArrayCollection();
        $this->ind2111s = new ArrayCollection();
        $this->ind2112s = new ArrayCollection();
        $this->ind2113s = new ArrayCollection();
        $this->ind2121s = new ArrayCollection();
        $this->ind2122s = new ArrayCollection();
        $this->ind2123s = new ArrayCollection();
        $this->ind2131s = new ArrayCollection();
        $this->ind2132s = new ArrayCollection();
        $this->ind2133s = new ArrayCollection();
        $this->ind214s = new ArrayCollection();
        $this->ind215s = new ArrayCollection();
        $this->ind216s = new ArrayCollection();
        $this->ind221s = new ArrayCollection();
        $this->ind222s = new ArrayCollection();
        $this->ind2231s = new ArrayCollection();
        $this->ind2232s = new ArrayCollection();
        $this->ind2233s = new ArrayCollection();
        $this->ind224s = new ArrayCollection();
        $this->ind2261s = new ArrayCollection();
        $this->ind2262s = new ArrayCollection();
        $this->ind2263s = new ArrayCollection();
        $this->ind231s = new ArrayCollection();
        $this->ind311s = new ArrayCollection();
        $this->ind311sTemp = new ArrayCollection();
        $this->ind311AotmsTemp = new ArrayCollection();
        $this->ind321s = new ArrayCollection();
        $this->ind321sTemp = new ArrayCollection();
        $this->ind321AotmsTemp = new ArrayCollection();
        $this->ind331s = new ArrayCollection();
        $this->ind344s = new ArrayCollection();
        $this->ind344sTemp = new ArrayCollection();
        $this->ind344AotmsTemp = new ArrayCollection();
        $this->ind411s = new ArrayCollection();
        $this->ind412s = new ArrayCollection();
        $this->ind421s = new ArrayCollection();
        $this->ind421sTemp = new ArrayCollection();
        $this->ind421AotmsTemp = new ArrayCollection();
        $this->ind421HsTemp = new ArrayCollection();
        $this->ind422s = new ArrayCollection();
        $this->ind422sTemp = new ArrayCollection();
        $this->ind422AotmsTemp = new ArrayCollection();
        $this->ind422HsTemp = new ArrayCollection();
        $this->ind423s = new ArrayCollection();
        $this->ind423sFili = new ArrayCollection();
        $this->ind424s = new ArrayCollection();
        $this->ind431s = new ArrayCollection();
        $this->ind5111s = new ArrayCollection();
        $this->ind5112s = new ArrayCollection();
        $this->ind5113s = new ArrayCollection();
        $this->ind5121s = new ArrayCollection();
        $this->ind5122s = new ArrayCollection();
        $this->ind513s = new ArrayCollection();
        $this->ind613s = new ArrayCollection();
        $this->ind6141s = new ArrayCollection();
        $this->ind6143s = new ArrayCollection();
        $this->ind6144s = new ArrayCollection();
        $this->ind6142s = new ArrayCollection();
        $this->ind7141s = new ArrayCollection();
        $this->ind7142s = new ArrayCollection();
        $this->bscRassctAccidentTravails = new ArrayCollection();
        $this->bscRassctRealisationFormationSanteTravails = new ArrayCollection();
        $this->bscRassctPrevisionFormationSanteTravails = new ArrayCollection();
        $this->bscRassctAutresMesures = new ArrayCollection();
        $this->bscRassctPredictionsAutresMesures = new ArrayCollection();
        $this->bscRassctNbMaladiePros = new ArrayCollection();
        $this->bscRassctNbAccidentTravails = new ArrayCollection();
        $this->bscRassctNatureLesions = new ArrayCollection();
        $this->bscRassctSiegeLesions = new ArrayCollection();
        $this->bscRassctElementMateriels = new ArrayCollection();
        $this->bscRassctMaladieProCaracPros = new ArrayCollection();
        $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAges = new ArrayCollection();
        $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp = new ArrayCollection();
        $this->bscGpeecPlusNbAgentsParSpeEtAges = new ArrayCollection();
        $this->bscGpeecPlusNbAgentsParSpeEtAgesTemp = new ArrayCollection();
        $this->bscGpeecNiveauDiplomes = new ArrayCollection();
        $this->bscHanditorialQuestionsBoeths = new ArrayCollection();
        $this->bscHanditorialNatureHandicaps = new ArrayCollection();
        $this->bscHanditorialAvisInaptitudes = new ArrayCollection();
        $this->bscHanditorialMesureInaptitudes = new ArrayCollection();
        $this->bscHanditorialAvisInaptitudesAvant = new ArrayCollection();
        $this->bscHanditorialMesureInaptitudesAvant = new ArrayCollection();
        $this->bscHanditorialAncienneteAgents = new ArrayCollection();
        $this->bscHanditorialModeEntrees = new ArrayCollection();
        $this->bscHanditorialStatutAgents = new ArrayCollection();
        $this->bscHanditorialArticles = new ArrayCollection();
        $this->bscHanditorialModeSortiesTitulaire = new ArrayCollection();
        $this->bscHanditorialModeSortiesNonTitulaire = new ArrayCollection();
        $this->bscHanditorialDerniersDiplomes = new ArrayCollection();
        $this->bscHanditorialCadreEmplois = new ArrayCollection();
        $this->bscHanditorialCadreEmploisTemp = new ArrayCollection();
        $this->bscHanditorialMetiers = new ArrayCollection();
        $this->bscHanditorialMetiersTemp = new ArrayCollection();
        $this->bscHanditorialTempsComplets = new ArrayCollection();
        $this->bscHanditorialTempsPleins = new ArrayCollection();
        $this->incoherenceLogs = new ArrayCollection();
    }

    private function createIndicateurXInstanceByName($indicateurName, $value)
    {
        $ind = null;

        if ($indicateurName == "Ind1101") {
            $ind = new Ind1101();
            $ind->setRefEmploiFonctionnel($value);
            // Ecran du debut de projet, on reste sur une liste temp
            $this->ind1101sTemp->add($ind);
        }
        if ($indicateurName == "Ind1102") {
            $ind = new Ind1102();
            $ind->setRefEmploiFonctionnel($value);
            // Ecran du debut de projet, on reste sur une liste temp
            $this->ind1102sTemp->add($ind);
        }
        if ($indicateurName == "Ind1103") {
            $ind = new Ind1103();
            $ind->setRefEmploiFonctionnel($value);
            // Ecran du debut de projet, on reste sur une liste temp
            $this->ind1103sTemp->add($ind);
        }
        if ($indicateurName == "Ind114") {
            $ind = new Ind114();
            $ind->setRefFiliere($value);
            $this->ind114sTemp->add($ind);
        }
        if ($indicateurName == "Ind124") {
            $ind = new Ind124();
            $ind->setRefFiliere($value);
            $this->ind124sTemp->add($ind);
        }
        if ($indicateurName == "Ind1311") {
            $ind = new Ind1311();
            $ind->setRefEmploiNonPermanent($value);
            $this->ind1311sTemp->add($ind);
        }
        if ($indicateurName == "Ind1312") {
            $ind = new Ind1312();
            $ind->setRefEmploiNonPermanent($value);
            $this->ind1312sTemp->add($ind);
        }


        if ($indicateurName == "Ind1501") {
            $ind = new Ind1501();
            $ind->setRefMotifDepart($value);
            $this->ind1501s->add($ind);
        }
        if ($indicateurName == "Ind1502") {
            $ind = new Ind1502();
            $ind->setRefMotifDepart($value);
            $this->ind1502s->add($ind);
        }
        if ($indicateurName == "Ind1511") {
            $ind = new Ind1511();
            $ind->setRefEmploiFonctionnel($value);
            $this->ind1511s->add($ind);
        }
        if ($indicateurName == "Ind1512") {
            $ind = new Ind1512();
            $ind->setRefEmploiFonctionnel($value);
            $this->ind1512s->add($ind);
        }
        if ($indicateurName == "Ind1513") {
            $ind = new Ind1513();
            $ind->setRefEmploiFonctionnel($value);
            $this->ind1513s->add($ind);
        }
        if ($indicateurName == "Ind1531") {
            $ind = new Ind1531();
            $ind->setRefMotifArrivee($value);
            if ($value->getCdMotiarri() == 'MA016' || $value->getCdMotiarri() == 'MA017' || $value->getCdMotiarri() == 'MA018') {
                $this->ind1531s->add($ind);
            }
        }
        if ($indicateurName == "Ind154") {
            $ind = new Ind154();
            $ind->setRefStageTitularisation($value);
            $this->ind154s->add($ind);
        }
        if ($indicateurName == "Ind155") {
            $ind = new Ind155();
            $ind->setRefAvancementPromotionConcours($value);
            $this->ind155s->add($ind);
        }
//        if ($indicateurName == "Ind156") {
//            $ind = new Ind156();
//            $ind->setRefCategorie($value);
//            $this->ind156s->add($ind);
//        }
        if ($indicateurName == "Ind157") {
            $ind = new Ind157();
            $ind->setRefCategorie($value);
            $this->ind157s->add($ind);
        }
        if ($indicateurName == "Ind158") {
            $ind = new Ind158();
            $ind->setRefFiliere($value);
            $this->ind158sTemp->add($ind);
        }
        if ($indicateurName == "Ind161") {
            $ind = new Ind161();
            $ind->setRefCategorie($value);
            $this->ind161s->add($ind);
        }

        if ($indicateurName == "Ind214") {
            $ind = new Ind214();
            $ind->setRefCategorie($value);
            $this->ind214s->add($ind);
        }

        if ($indicateurName == "Ind215") {
            $ind = new Ind215();
            $ind->setRefCategorie($value);
            $this->ind215s->add($ind);
        }

        if ($indicateurName == "Ind216") {
            $ind = new Ind216();
            $ind->setRefCategorie($value);
            $this->ind216s->add($ind);
        }

        if ($indicateurName == "Ind221") {
            $ind = new Ind221();
            $ind->setRefCycleTravail($value);
            $this->ind221s->add($ind);
        }
        if ($indicateurName == "Ind222") {
            $ind = new Ind222();
            $ind->setRefContrainteTravail($value);
            $this->ind222s->add($ind);
        }
        if ($indicateurName == "Ind2231") {
            $ind = new Ind2231();
            $ind->setRefCategorie($value);
            $this->ind2231s->add($ind);
        }
        if ($indicateurName == "Ind2232") {
            $ind = new Ind2232();
            $ind->setRefCategorie($value);
            $this->ind2232s->add($ind);
        }
        if ($indicateurName == "Ind2233") {
            $ind = new Ind2233();
            $ind->setRefCategorie($value);
            $this->ind2233s->add($ind);
        }
        if ($indicateurName == "Ind224") {
            // Pas de referentiel
            $ind = new Ind224();
            $this->ind224s->add($ind);
        }
        if ($indicateurName == "Ind2261") {
            $ind = new Ind2261();
            $ind->setRefCategorie($value);
            $this->ind2261s->add($ind);
        }
        if ($indicateurName == "Ind2262") {
            $ind = new Ind2262();
            $ind->setRefCategorie($value);
            $this->ind2262s->add($ind);
        }
        if ($indicateurName == "Ind2263") {
            $ind = new Ind2263();
            $ind->setRefCategorie($value);
            $this->ind2263s->add($ind);
        }
        if ($indicateurName == "Ind231") {
            // Pas de referentiel
            $ind = new Ind231();
            $key = key($value);
            if (!empty($value)) {
                $ind->setCdDema($value[$key]);
                $ind->setOrder($key);
            }
            $this->ind231s->add($ind);
        }
        if ($indicateurName == "Ind311") {
            $ind = new Ind311();
            $ind->setRefFiliere($value);
            $this->ind311sTemp->add($ind);
        }
        if ($indicateurName == "Ind321") {
            $ind = new Ind321();
            $ind->setRefCategorie($value);
            $this->ind321s->add($ind);
        }
        if ($indicateurName == "Ind331") {
            $ind = new Ind331();
            $ind->setRefEmploiNonPermanent($value);
            $this->ind331s->add($ind);
        }
        if ($indicateurName == "Ind424") {
            $ind = new Ind424();
            $ind->setRefStatut($value);
            $this->ind424s->add($ind);
        }
        if ($indicateurName == "Ind411") {
            $ind = new Ind411();
            $ind->setRefTypeMissionPrevention($value);
            $this->ind411s->add($ind);
        }
        if ($indicateurName == "Ind412") {
            $ind = new Ind412();
            $ind->setRefActionPrevention($value);
            $this->ind412s->add($ind);
        }
        if ($indicateurName == "Ind431") {
            $ind = new Ind431();
            $ind->setRefActeViolencePhysique($value);
            $this->ind431s->add($ind);
        }
        if ($indicateurName == "Ind5111") {
            $ind = new Ind5111();
            $ind->setRefCategorie($value);
            $this->ind5111s->add($ind);
        }
        if ($indicateurName == "Ind5121") {
            $ind = new Ind5121();
            $ind->setRefEmploiNonPermanent($value);
            $this->ind5121s->add($ind);
        }
        if ($indicateurName == "Ind5122") {
            $ind = new Ind5122();
            $ind->setRefEmploiNonPermanent($value);
            $this->ind5122s->add($ind);
        }
        if ($indicateurName == "Ind613") {
            $ind = new Ind613();
            $ind->setRefMotifGreve($value);
            $this->ind613s->add($ind);
        }
        if ($indicateurName == "Ind6142") {
            $ind = new Ind6142();
            $ind->setRefMotifSanctionDisciplinaire($value);
            $this->ind6142s->add($ind);
        }
        if ($indicateurName == "Ind7141") {
            $ind = new Ind7141();
            $ind->setRefCategorie($value);
            $this->ind7141s->add($ind);
        }
        if ($indicateurName == "Ind7142") {
            $ind = new Ind7142();
            $ind->setRefCategorie($value);
            $this->ind7142s->add($ind);
        }
        if ($indicateurName == "BscRassctAccidentTravail") {
            // Pas de referentiel
            $ind = new BscRassctAccidentTravail();
            $this->bscRassctAccidentTravails->add($ind);
        }
        if ($indicateurName == "BscRassctNbMaladiePro") {
            $ind = new BscRassctNbMaladiePro();
            $ind->setRefTypeActivite($value);
            $this->bscRassctNbMaladiePros->add($ind);
        }
        if ($indicateurName == "BscRassctNbAccidentTravail") {
            $ind = new BscRassctNbAccidentTravail();
            $ind->setRefTypeActivite($value);
            $this->bscRassctNbAccidentTravails->add($ind);
        }
        if ($indicateurName == "BscRassctNatureLesion") {
            $ind = new BscRassctNatureLesion();
            $ind->setRefNatureLesion($value);
            $this->bscRassctNatureLesions->add($ind);
        }
        if ($indicateurName == "BscRassctSiegeLesion") {
            $ind = new BscRassctSiegeLesion();
            $ind->setRefSiegeLesion($value);
            $this->bscRassctSiegeLesions->add($ind);
        }
        if ($indicateurName == "BscRassctElementMateriel") {
            $ind = new BscRassctElementMateriel();
            $ind->setRefElementMateriel($value);
            $this->bscRassctElementMateriels->add($ind);
        }
        if ($indicateurName == "BscRassctMaladieProCaracPro") {
            $ind = new BscRassctMaladieProCaracPro();
            $ind->setRefMaladieProfessionnelle($value);
            $this->bscRassctMaladieProCaracPros->add($ind);
        }
        if ($indicateurName == "BscHanditorialQuestionsBoethsCategorie") {
            $ind = new BscHanditorialQuestionsBoeths();
            $ind->setRefCategorieBoeth($value);
            $this->bscHanditorialQuestionsBoeths->add($ind);
        }
        if ($indicateurName == "BscHanditorialNatureHandicaps") {
            $ind = new BscHanditorialNatureHandicaps();
            $ind->setRefNatureHandicapBoeth($value);
            $this->bscHanditorialNatureHandicaps->add($ind);
        }
        if ($indicateurName == "BscHanditorialAvisInaptitudes") {
            $ind = new BscHanditorialAvisInaptitudes();
            $ind->setRefInaptitudeBoeth($value);
            $this->bscHanditorialAvisInaptitudes->add($ind);
        }
        if ($indicateurName == "BscHanditorialMesureInaptitudes") {
            $ind = new BscHanditorialMesureInaptitudes();
            $ind->setRefMesureBoeth($value);
            $this->bscHanditorialMesureInaptitudes->add($ind);
        }
        if ($indicateurName == "BscHanditorialAvisInaptitudesAvant") {
            $ind = new BscHanditorialAvisInaptitudesAvant();
            $ind->setRefInaptitudeBoeth($value);
            $this->bscHanditorialAvisInaptitudesAvant->add($ind);
        }
        if ($indicateurName == "BscHanditorialMesureInaptitudesAvant") {
            $ind = new BscHanditorialMesureInaptitudesAvant();
            $ind->setRefMesureBoeth($value);
            $this->bscHanditorialMesureInaptitudesAvant->add($ind);
        }
        if ($indicateurName == "BscHanditorialAncienneteAgents") {
            // Pas de referentiel
            $ind = new BscHanditorialAncienneteAgents();
            $this->bscHanditorialAncienneteAgents->add($ind);
        }
        if ($indicateurName == "BscHanditorialModeEntrees") {
            $ind = new BscHanditorialModeEntrees();
            $ind->setRefMotifArrivee($value);
            $this->bscHanditorialModeEntrees->add($ind);
        }
        if ($indicateurName == "BscHanditorialStatutAgents") {
            $ind = new BscHanditorialStatutAgents();
            $ind->setRefStatut($value);
            $this->bscHanditorialStatutAgents->add($ind);
        }
        if ($indicateurName == "BscHanditorialArticles") {
            $ind = new BscHanditorialArticles();
            $ind->setRefArticle($value);
            $this->bscHanditorialArticles->add($ind);
        }
        if ($indicateurName == "BscHanditorialModeSortiesTitulaire") {
            $ind = new BscHanditorialModeSortiesTitulaire();
            $ind->setRefMotifDepart($value);
            $this->bscHanditorialModeSortiesTitulaire->add($ind);
        }
        if ($indicateurName == "BscHanditorialModeSortiesNonTitulaire") {
            $ind = new BscHanditorialModeSortiesNonTitulaire();
            $ind->setRefMotifDepart($value);
            $this->bscHanditorialModeSortiesNonTitulaire->add($ind);
        }
        if ($indicateurName == "BscHanditorialDerniersDiplomes") {
            $ind = new BscHanditorialDerniersDiplomes();
            $ind->setRefDomaineDiplome($value);
            $this->bscHanditorialDerniersDiplomes->add($ind);
        }
        if ($indicateurName == "BscHanditorialTempsComplets") {
            // Pas de referentiel
            $ind = new BscHanditorialTempsComplets();
            $this->bscHanditorialTempsComplets->add($ind);
        }
        if ($indicateurName == "BscHanditorialTempsPleins") {
            // Pas de referentiel
            $ind = new BscHanditorialTempsPleins();
            $this->bscHanditorialTempsPleins->add($ind);
        }
        return $ind;
    }

    public function initIndicateurX($cdUtil, $indicateurName, $referentielValues)
    {
        foreach ($referentielValues as $value) {
            //error_log('name  ' . $indicateurName);
            $ind = $this->createIndicateurXInstanceByName($indicateurName, $value);
            $ind->setDtCrea(new DateTime('NOW'));
            $ind->setCdUtilcrea($cdUtil);
            $ind->setBilanSocialConsolide($this);
        }
    }

    private function createIndicateur2refeXInstanceByName($indicateurName, $value, $value2)
    {
        $ind = null;

        if ($indicateurName == "Ind5112") {
            $ind = new Ind5112();
            $ind->setRefCategorie($value);
            $ind->setRefFormation($value2);
            $this->ind5112s->add($ind);
        }
        if ($indicateurName == "Ind5113") {
            $ind = new Ind5113();
            $ind->setRefCategorie($value);
            $ind->setRefFormation($value2);
            $this->ind5113s->add($ind);
        }
        return $ind;
    }


    public function initIndicateur2refeX($cdUtil, $indicateurName, $referentielValues, $referentiel2Values)
    {
        foreach ($referentielValues as $value) {
            //error_log('name  ' . $indicateurName);
            foreach ($referentiel2Values as $value2) {
                $ind = $this->createIndicateur2refeXInstanceByName($indicateurName, $value, $value2);
                $ind->setDtCrea(new DateTime('NOW'));
                $ind->setCdUtilcrea($cdUtil);
                $ind->setBilanSocialConsolide($this);
            }
        }
    }

    private function createIndicateurFiliXInstanceByName($indicateurName, $value, $idFili)
    {
        $ind = null;
        if ($indicateurName == "Ind152") {
            if ($idFili == $value->getRefFiliere()->getIdFili()) {
                $ind = new Ind152();
                $ind->setRefCadreEmploi($value);
                $this->ind152sTemp->add($ind);
            }
        }
        if ($indicateurName == "Ind1532") {
            if ($idFili == $value->getRefFiliere()->getIdFili()) {
                $ind = new Ind1532();
                $ind->setRefCadreEmploi($value);
                $this->ind1532sTemp->add($ind);
            }
        }
        if ($indicateurName == "Ind344") {
            if ($idFili == $value->getRefFiliere()->getIdFili()) {
                $ind = new Ind344();
                $ind->setRefCadreEmploi($value);
                $this->ind344sTemp->add($ind);
            }
        }
        if ($indicateurName == "Ind421") {
            if ($idFili == $value->getRefFiliere()->getIdFili()) {
                $ind = new Ind421();
                $ind->setRefCadreEmploi($value);
                $this->ind421sTemp->add($ind);
            }
        }
        if ($indicateurName == "Ind422") {
            if ($idFili == $value->getRefFiliere()->getIdFili()) {
                $ind = new Ind422();
                $ind->setRefCadreEmploi($value);
                $this->ind422sTemp->add($ind);
            }
        }
        if ($indicateurName == "BscGpeecNbAgentsTituEmpPermaParFoncEtAge") {
            if ($idFili == $value->getRefFamilleMetier()->getIdFamilleMetier()) {
                $ind = new BscGpeecNbAgentsTituEmpPermaParFoncEtAge();
                $ind->setRefMetier($value);
                $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp->add($ind);
            }
        }
        if ($indicateurName == "BscGpeecPlusNbAgentsParSpeEtAge") {
            if ($idFili == $value->getRefDomaineSpecialite()->getIdDomaineSpecialite()) {
                $ind = new BscGpeecPlusNbAgentsParSpeEtAge();
                $ind->setRefSpecialite($value);
                $this->bscGpeecPlusNbAgentsParSpeEtAgesTemp->add($ind);
            }
        }
        if ($indicateurName == "BscHanditorialCadreEmplois") {
            if ($idFili == $value->getRefFiliere()->getIdFili()) {
                $ind = new BscHanditorialCadreEmplois();
                $ind->setRefCadreEmploi($value);
                $this->bscHanditorialCadreEmploisTemp->add($ind);
            }
        }
        if ($indicateurName == "BscHanditorialMetiers") {
            if ($idFili == $value->getRefFamilleMetier()->getIdFamilleMetier()) {
                $ind = new BscHanditorialMetiers();
                $ind->setRefMetier($value);
                $this->bscHanditorialMetiersTemp->add($ind);
            }
        }
        return $ind;
    }

    public function initIndicateurFiliX($cdUtil, $indicateurName, $referentielValues, $idFili)
    {
        foreach ($referentielValues as $value) {
            $ind = $this->createIndicateurFiliXInstanceByName($indicateurName, $value, $idFili);
            if ($ind != null) {
                $ind->setDtCrea(new DateTime('NOW'));
                $ind->setCdUtilcrea($cdUtil);
                $ind->setBilanSocialConsolide($this);
            }
        }
    }

    public function initIndicateurFiliTempFromPersX($indicateurName, $idFili)
    {
        if ($indicateurName == "Ind152") {
            foreach ($this->ind152s as $ind) {
                if ($idFili == $ind->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $this->ind152sTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "Ind1532") {
            foreach ($this->ind1532s as $ind) {
                if ($idFili == $ind->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $this->ind1532sTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "Ind344") {
            foreach ($this->ind344s as $ind) {
                if ($idFili == $ind->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $this->ind344sTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "Ind421") {
            foreach ($this->ind421s as $ind) {
                if ($idFili == $ind->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $this->ind421sTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "Ind422") {
            foreach ($this->ind422s as $ind) {
                if ($idFili == $ind->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $this->ind422sTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "BscGpeecNbAgentsTituEmpPermaParFoncEtAge") {
            foreach ($this->bscGpeecNbAgentsTituEmpPermaParFoncEtAges as $ind) {
                if ($idFili == $ind->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier()) {
                    $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "BscGpeecPlusNbAgentsParSpeEtAge") {
            foreach ($this->bscGpeecPlusNbAgentsParSpeEtAges as $ind) {
                if ($idFili == $ind->getRefSpecialite()->getRefDomaineSpecialite()->getIdDomaineSpecialite()) {
                    $this->bscGpeecPlusNbAgentsParSpeEtAgesTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "BscHanditorialCadreEmplois") {
            foreach ($this->bscHanditorialCadreEmplois as $ind) {
                if ($idFili == $ind->getRefCadreEmploi()->getRefFiliere()->getIdFili()) {
                    $this->bscHanditorialCadreEmploisTemp->add($ind);
                }
            }
        }
        if ($indicateurName == "BscHanditorialMetiers") {
            foreach ($this->bscHanditorialMetiers as $ind) {
                if ($idFili == $ind->getRefMetier()->getRefFamilleMetier()->getIdFamilleMetier()) {
                    $this->bscHanditorialMetiersTemp->add($ind);
                }
            }
        }
    }

    private function createIndicateurParticulierXInstanceByName($cdUtil, $indicateurName, $value, $type)
    {
        $ind = null;
        if ($indicateurName == "Ind171") {
            if ($type == 1) {
                $ind = new Ind171();
                $ind->setRefTrancheAge($value);
                $ind->setFgGenr("H");
                $ind->setDtCrea(new DateTime('NOW'));
                $ind->setCdUtilcrea($cdUtil);
                $ind->setBilanSocialConsolide($this);
                $this->ind171s->add($ind);
            }
            if ($type == 2) {
                $ind = new Ind171();
                $ind->setRefTrancheAge($value);
                $ind->setFgGenr("F");
                $ind->setDtCrea(new DateTime('NOW'));
                $ind->setCdUtilcrea($cdUtil);
                $ind->setBilanSocialConsolide($this);
                $this->ind171s->add($ind);
            }
        }
        if ($indicateurName == "Ind211") {
            if ($type == 1) {
                if ($value->getBlAbsecomp() == true) {
                    $ind = new Ind2111();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefMotifAbsence($value);
                    $this->ind2111s->add($ind);

                    $ind = new Ind2112();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2112s->add($ind);

                    $ind = new Ind2113();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2113s->add($ind);
                }
            }
            if ($type == 2) {
                if ($value->getBlAbsemedi() == true) {
                    $ind = new Ind2111();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2111s->add($ind);

                    $ind = new Ind2112();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2112s->add($ind);

                    $ind = new Ind2113();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2113s->add($ind);
                }
            }
            if ($type == 3) {
                if ($value->getBlAbseautrrais() == true) {
                    $ind = new Ind2111();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2111s->add($ind);
                }
            }
        }
        if ($indicateurName == "Ind212") {
            if ($type == 1) {
                if ($value->getBlAbsecomp() == true) {
                    $ind = new Ind2121();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefMotifAbsence($value);
                    $this->ind2121s->add($ind);

                    $ind = new Ind2122();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2122s->add($ind);

                    $ind = new Ind2123();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2123s->add($ind);
                }
            }
            if ($type == 2) {
                if ($value->getBlAbsemedi() == true) {
                    $ind = new Ind2121();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2121s->add($ind);

                    $ind = new Ind2122();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2122s->add($ind);

                    $ind = new Ind2123();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2123s->add($ind);
                }
            }
            if ($type == 3) {
                if ($value->getBlAbseautrrais() == true) {
                    $ind = new Ind2121();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2121s->add($ind);
                }
            }
        }
        if ($indicateurName == "Ind213") {
            if ($type == 1) {
                if ($value->getBlAbsecomp() == true) {
                    $ind = new Ind2131();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefMotifAbsence($value);
                    $this->ind2131s->add($ind);

                    $ind = new Ind2132();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2132s->add($ind);

                    $ind = new Ind2133();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2133s->add($ind);
                }
            }
            if ($type == 2) {
                if ($value->getBlAbsemedi() == true) {
                    $ind = new Ind2131();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2131s->add($ind);

                    $ind = new Ind2132();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2132s->add($ind);

                    $ind = new Ind2133();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2133s->add($ind);
                }
            }
            if ($type == 3) {
                if ($value->getBlAbseautrrais() == true) {
                    $ind = new Ind2131();
                    $ind->setRefMotifAbsence($value);
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setBilanSocialConsolide($this);
                    $this->ind2131s->add($ind);
                }
            }
        }
        if ($indicateurName == "Ind513") {
            if ($type == 1) {
                $ind = new Ind513();
                $ind->setDtCrea(new DateTime('NOW'));
                $ind->setCdUtilcrea($cdUtil);
                $ind->setType($type);
                $ind->setBilanSocialConsolide($this);
                $ind->setRefValidationExperience($value);
                $this->ind513s->add($ind);
            }
            if ($type == 2) {
                $ind = new Ind513();
                $ind->setDtCrea(new DateTime('NOW'));
                $ind->setCdUtilcrea($cdUtil);
                $ind->setType($type);
                $ind->setBilanSocialConsolide($this);
                $this->ind513s->add($ind);
            }
            if ($type == 3) {
                $ind = new Ind513();
                $ind->setDtCrea(new DateTime('NOW'));
                $ind->setCdUtilcrea($cdUtil);
                $ind->setType($type);
                $ind->setBilanSocialConsolide($this);
                $this->ind513s->add($ind);
            }
        }

        if ($indicateurName == "Ind6141") {
            if ($type == 1) {
                if ($value->getBl614G1() == true) {
                    $ind = new Ind6141();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setGroupe(1);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefSanctionDisciplinaire($value);
                    $this->ind6141s->add($ind);
                }
            }
            if ($type == 2) {
                if ($value->getBl614G2() == true) {
                    $ind = new Ind6141();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setGroupe(2);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefSanctionDisciplinaire($value);
                    $this->ind6141s->add($ind);
                }
            }
            if ($type == 3) {
                if ($value->getBl614G3() == true) {
                    $ind = new Ind6141();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setGroupe(3);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefSanctionDisciplinaire($value);
                    $this->ind6141s->add($ind);
                }
            }
            if ($type == 4) {
                if ($value->getBl614G4() == true) {
                    $ind = new Ind6141();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setGroupe(4);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefSanctionDisciplinaire($value);
                    $this->ind6141s->add($ind);
                }
            }
            if ($type == 5) {
                if ($value->getBl614G5() == true) {
                    $ind = new Ind6141();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setGroupe(5);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefSanctionDisciplinaire($value);
                    $this->ind6141s->add($ind);
                }
            }
            if ($type == 6) {
                if ($value->getBl614G6() == true) {
                    $ind = new Ind6141();
                    $ind->setDtCrea(new DateTime('NOW'));
                    $ind->setCdUtilcrea($cdUtil);
                    $ind->setGroupe(6);
                    $ind->setBilanSocialConsolide($this);
                    $ind->setRefSanctionDisciplinaire($value);
                    $this->ind6141s->add($ind);
                }
            }

        }

        return $ind;
    }

    public function initIndicateurParticulierX($cdUtil, $indicateurName, $referentielValues, $type)
    {
        foreach ($referentielValues as $value) {
            $this->createIndicateurParticulierXInstanceByName($cdUtil, $indicateurName, $value, $type);
        }
    }

    function addInd1101($ind1101)
    {
        $this->ind1101s->add($ind1101);
    }

    function addInd1101Temp($ind1101)
    {
        $this->ind1101sTemp->add($ind1101);
    }

    function addInd1102($ind1102)
    {
        $this->ind1102s->add($ind1102);
    }

    function addInd1102Temp($ind1102)
    {
        $this->ind1102sTemp->add($ind1102);
    }

    function addInd1103Temp($ind1103)
    {
        $this->ind1103sTemp->add($ind1103);
    }

    function addInd1103($ind1103)
    {
        $this->ind1103s->add($ind1103);
    }

    function addInd111($ind111)
    {
        $this->ind111s->add($ind111);
    }

    function addInd111Temp($ind111)
    {
        $this->ind111sTemp->add($ind111);
    }

    function addInd111AotmTemp($ind111)
    {
        $this->ind111AotmsTemp->add($ind111);
    }

    function addInd112($ind112)
    {
        $this->ind112s->add($ind112);
    }

    function addInd112Temp($ind112)
    {
        $this->ind112sTemp->add($ind112);
    }

    function addInd112AotmTemp($ind112)
    {
        $this->ind112AotmsTemp->add($ind112);
    }

    function addInd113($ind113)
    {
        $this->ind113s->add($ind113);
    }

    function addInd114($ind114)
    {
        $this->ind114s->add($ind114);
    }

    function addInd114Temp($ind114)
    {
        $this->ind114sTemp->add($ind114);
    }


    function addInd121($ind121)
    {
        $this->ind121s->add($ind121);
    }

    function addInd121Temp($ind121)
    {
        $this->ind121sTemp->add($ind121);
    }

    function addInd121AotmTemp($ind121)
    {
        $this->ind121AotmsTemp->add($ind121);
    }

    function addInd122($ind122)
    {
        $this->ind122s->add($ind122);
    }

    function addInd122Temp($ind122)
    {
        $this->ind122sTemp->add($ind122);
    }

    function addInd122AotmTemp($ind122)
    {
        $this->ind122AotmsTemp->add($ind122);
    }

    function addInd123($ind123)
    {
        $this->ind123s->add($ind123);
    }

    function addInd124($ind124)
    {
        $this->ind124s->add($ind124);
    }

    function addInd124Temp($ind124)
    {
        $this->ind124sTemp->add($ind124);
    }


    function addInd1311($ind1311)
    {
        $this->ind1311s->add($ind1311);
    }

    function addInd1311Temp($ind1311)
    {
        $this->ind1311sTemp->add($ind1311);
    }

    function addInd1312($ind1312)
    {
        $this->ind1312s->add($ind1312);
    }

    function addInd1312Temp($ind1312)
    {
        $this->ind1312sTemp->add($ind1312);
    }

    function addInd132($ind132)
    {
        $this->ind132s->add($ind132);
    }

    function addInd132Bis($ind132Bis) {
        $this->ind132Biss->add($ind132Bis);
    }

    function addInd141($ind141) {
        $this->ind141s->add($ind141);
    }

    function addInd142($ind142)
    {
        $this->ind142s->add($ind142);
    }

    function addInd143($ind143)
    {
        $this->ind143s->add($ind143);
    }

    function addInd144($ind144)
    {
        $this->ind144s->add($ind144);
    }

    function addInd1501($ind1501)
    {
        $this->ind1501s->add($ind1501);
    }

    function addInd1502($ind1502)
    {
        $this->ind1502s->add($ind1502);
    }

    function addInd1511($ind1511)
    {
        $this->ind1511s->add($ind1511);
    }

    function addInd1512($ind1512)
    {
        $this->ind1512s->add($ind1512);
    }

    function addInd1513($ind1513)
    {
        $this->ind1513s->add($ind1513);
    }

    function addInd152($ind152)
    {
        $this->ind152s->add($ind152);
    }

    function addInd152Temp($ind152)
    {
        $this->ind152sTemp->add($ind152);
    }

    function addInd152AotmTemp($ind152)
    {
        $this->ind152AotmsTemp->add($ind152);
    }

    function addInd421($ind421)
    {
        $this->ind421s->add($ind421);
    }

    function addInd421Temp($ind421)
    {
        $this->ind421sTemp->add($ind421);
    }

    function addInd421AotmTemp($ind421)
    {
        $this->ind421AotmsTemp->add($ind421);
    }

    function addInd422($ind422)
    {
        $this->ind422s->add($ind422);
    }

    function addInd422Temp($ind422)
    {
        $this->ind422sTemp->add($ind422);
    }

    function addInd422AotmTemp($ind422)
    {
        $this->ind422AotmsTemp->add($ind422);
    }

    function addInd1531($ind1531)
    {
        $this->ind1531s->add($ind1531);
    }

    function addInd1532($ind1532)
    {
        $this->ind1532s->add($ind1532);
    }

    function addInd1532Temp($ind1532)
    {
        $this->ind1532sTemp->add($ind1532);
    }

    function addInd1532AotmTemp($ind1532)
    {
        $this->ind1532AotmsTemp->add($ind1532);
    }

    function addInd154($ind154)
    {
        $this->ind154s->add($ind154);
    }

    function addInd155($ind155)
    {
        $this->ind155s->add($ind155);
    }

//    function addInd156($ind156) {
//        $this->ind156s->add($ind156);
//    }

    function addInd157($ind157) {
        $this->ind157s->add($ind157);
    }
    function addInd158($ind158) {
        $this->ind158s->add($ind158);
    }

    function addInd158Temp($ind158)
    {
        $this->ind158sTemp->add($ind158);
    }

    function addInd158AotmTemp($ind158)
    {
        $this->ind158AotmsTemp->add($ind158);
    }

    function addInd161($ind161)
    {
        $this->ind161s->add($ind161);
    }

    function addInd1612($ind1612)
    {
        $this->ind1612s->add($ind1612);
    }

    function addInd171($ind171)
    {
        $this->ind171s->add($ind171);
    }

    function addInd171Temp($ind171)
    {
        $this->ind171sTemp->add($ind171);
    }

    function addInd2111($ind2111)
    {
        $this->ind2111s->add($ind2111);
    }

    function addInd2112($ind2112)
    {
        $this->ind2112s->add($ind2112);
    }

    function addInd2113($ind2113)
    {
        $this->ind2113s->add($ind2113);
    }

    function addInd2121($ind2121)
    {
        $this->ind2121s->add($ind2121);
    }

    function addInd2122($ind2122)
    {
        $this->ind2122s->add($ind2122);
    }

    function addInd2123($ind2123)
    {
        $this->ind2123s->add($ind2123);
    }

    function addInd2131($ind2131)
    {
        $this->ind2131s->add($ind2131);
    }

    function addInd2132($ind2132)
    {
        $this->ind2132s->add($ind2132);
    }

    function addInd2133($ind2133)
    {
        $this->ind2133s->add($ind2133);
    }

    function addInd214($ind214)
    {
        $this->ind214s->add($ind214);
    }

    function addInd215($ind215)
    {
        $this->ind215s->add($ind215);
    }

    function addInd216($ind216)
    {
        $this->ind216s->add($ind216);
    }

    function addInd222($ind222)
    {
        $this->ind222s->add($ind222);
    }

    function addInd2231($ind2231)
    {
        $this->ind2231s->add($ind2231);
    }

    function addInd2232($ind2232)
    {
        $this->ind2232s->add($ind2232);
    }

    function addInd2233($ind2233)
    {
        $this->ind2233s->add($ind2233);
    }

    function addInd224($ind224)
    {
        $this->ind224s->add($ind224);
    }

    function addInd2261($ind2261)
    {
        $this->ind2261s->add($ind2261);
    }
    
    function addInd2262($ind2262)
    {
        $this->ind2262s->add($ind2262);
    }
    
    function addInd2263($ind2263)
    {
        $this->ind2263s->add($ind2263);
    }

    function addInd231($ind231)
    {
        $this->ind231s->add($ind231);
    }

    function addInd423($ind423)
    {
        $this->ind423s->add($ind423);
    }

    function addInd423Fili($ind423Fili)
    {
        $this->ind423sFili->add($ind423Fili);
    }

    function addInd424($ind424)
    {
        $ind424->setBilanSocialConsolide($this);
        $this->ind424s->add($ind424);
    }

    function addInd431($ind431)
    {
        $this->ind431s->add($ind431);
    }

    function addInd311($ind311)
    {
        $this->ind311s->add($ind311);
    }

    function addInd311Temp($ind311)
    {
        $this->ind311sTemp->add($ind311);
    }

    function addInd311Aotm($ind311)
    {
        $this->ind311AotmsTemp->add($ind311);
    }

    function addInd321($ind321)
    {
        $this->ind321s->add($ind321);
    }
    function addInd321Temp($ind321)
    {
        $this->ind321sTemp->add($ind321);
    }

    function addInd321Aotm($ind321)
    {
        $this->ind321AotmsTemp->add($ind321);
    }

    function addInd331($ind331)
    {
        $this->ind331s->add($ind331);
    }

    function addInd344($ind344)
    {
        $this->ind344s->add($ind344);
    }

    function addInd344Temp($ind344)
    {
        $this->ind344sTemp->add($ind344);
    }

    function addInd344AotmTemp($ind344)
    {
        $this->ind344AotmsTemp->add($ind344);
    }

    function addIncoherenceLog($incoherenceLog)
    {
        $this->incoherenceLogs->add($incoherenceLog);
    }

    function setFieldsInd111s()
    {
        // Utilisable que si les champs transient des ind111 sont preninit et la liste est bien triée
        $idFiliPrec = 0;
        $idCadremplPrec = 0;
        $idx = 0;
        foreach ($this->ind111s as $ind111) {
            if ($idFiliPrec != $ind111->getIdFili()) {
                if ($idx != 0) {
                    $this->ind111s[$idx - 1]->setLastFiliere(true);
                }
                $ind111->setNewFiliere(true);
            }

            $idFiliPrec = $ind111->getIdFili();
            if ($idCadremplPrec != $ind111->getIdCadrempl()) {
                if ($idx != 0) {
                    $this->ind111s[$idx - 1]->setLastCadreEmploi(true);
                }
                $ind111->setNewCadreEmploi(true);
            }
            $idCadremplPrec = $ind111->getIdCadrempl();
            $idx++;
        }

        if ($this->ind111s->count() != 0) {
            $this->ind111s[$this->ind111s->count() - 1]->setLastFiliere(true);
            $this->ind111s[$this->ind111s->count() - 1]->setLastCadreEmploi(true);
        }
    }

    function setFieldsInd111sTemp()
    {
        // Utilisable que si les champs transient des ind111 sont preninit et la liste est bien triée
        $idFiliPrec = 0;
        $idCadremplPrec = 0;
        $idx = 0;
        foreach ($this->ind111sTemp as $ind111) {
            if ($idFiliPrec != $ind111->getIdFili()) {
                if ($idx != 0) {
                    $this->ind111sTemp[$idx - 1]->setLastFiliere(true);
                }
                $ind111->setNewFiliere(true);
            }

            $idFiliPrec = $ind111->getIdFili();
            if ($idCadremplPrec != $ind111->getIdCadrempl()) {
                if ($idx != 0) {
                    $this->ind111sTemp[$idx - 1]->setLastCadreEmploi(true);
                }
                $ind111->setNewCadreEmploi(true);
            }
            $idCadremplPrec = $ind111->getIdCadrempl();
            $idx++;
        }

        if ($this->ind111sTemp->count() != 0) {
            $this->ind111sTemp[$this->ind111sTemp->count() - 1]->setLastFiliere(true);
            $this->ind111sTemp[$this->ind111sTemp->count() - 1]->setLastCadreEmploi(true);
        }
    }

    function setFieldsInd112s()
    {
        // Utilisable que si les champs transient des ind112 sont preninit et la liste est bien triée
        $idFiliPrec = 0;

        $idx = 0;
        foreach ($this->ind112s as $ind112) {
            if ($idFiliPrec != $ind112->getIdFili()) {
                if ($idx != 0) {
                    $this->ind112s[$idx - 1]->setLastFiliere(true);
                }
                $ind112->setNewFiliere(true);
            }

            $idFiliPrec = $ind112->getIdFili();

            $idx++;
        }

        if ($this->ind112s->count() != 0) {
            $this->ind112s[$this->ind112s->count() - 1]->setLastFiliere(true);
        }
    }

    function setFieldsInd112sTemp()
    {
        // Utilisable que si les champs transient des ind112 sont preninit et la liste est bien triée
        $idFiliPrec = 0;

        $idx = 0;
        foreach ($this->ind112sTemp as $ind112) {
            if ($idFiliPrec != $ind112->getIdFili()) {
                if ($idx != 0) {
                    $this->ind112sTemp[$idx - 1]->setLastFiliere(true);
                }
                $ind112->setNewFiliere(true);
            }

            $idFiliPrec = $ind112->getIdFili();

            $idx++;
        }

        if ($this->ind112sTemp->count() != 0) {
            $this->ind112sTemp[$this->ind112sTemp->count() - 1]->setLastFiliere(true);
        }
    }

    function setFieldsInd113s()
    {
        // Utilisable que si les champs transient des ind112 sont preninit et la liste est bien triée
        $idCatePrec = 0;

        $idx = 0;
        foreach ($this->ind113s as $ind113) {
            if ($idCate != $ind113->getIdCate()) {
                if ($idx != 0) {
                    $this->ind113s[$idx - 1]->setLastFiliere(true);
                }
                $ind113->setNewFiliere(true);
            }

            $idCatePrec = $ind113->getIdCate();

            $idx++;
        }

        if ($this->ind113s->count() != 0) {
            $this->ind113s[$this->ind113s->count() - 1]->setLastFiliere(true);
        }
    }

    function setFieldsInd121s()
    {
        // Utilisable que si les champs transient des ind121 sont preninit et la liste est bien triée
        $idFiliPrec = 0;

        $idx = 0;
        foreach ($this->ind121s as $ind121) {
            if ($idFiliPrec != $ind121->getIdFili()) {
                if ($idx != 0) {
                    $this->ind121s[$idx - 1]->setLastFiliere(true);
                }
                $ind121->setNewFiliere(true);
            }

            $idFiliPrec = $ind121->getIdFili();

            $idx++;
        }

        if ($this->ind121s->count() != 0) {
            $this->ind121s[$this->ind121s->count() - 1]->setLastFiliere(true);
        }
    }

    function setFieldsInd121sTemp()
    {
        // Utilisable que si les champs transient des ind121 sont preninit et la liste est bien triée
        $idFiliPrec = 0;

        $idx = 0;
        foreach ($this->ind121sTemp as $ind121) {
            if ($idFiliPrec != $ind121->getIdFili()) {
                if ($idx != 0) {
                    $this->ind121sTemp[$idx - 1]->setLastFiliere(true);
                }
                $ind121->setNewFiliere(true);
            }

            $idFiliPrec = $ind121->getIdFili();

            $idx++;
        }

        if ($this->ind121sTemp->count() != 0) {
            $this->ind121sTemp[$this->ind121sTemp->count() - 1]->setLastFiliere(true);
        }
    }

    function setFieldsInd122s()
    {
        // Utilisable que si les champs transient des ind122 sont preninit et la liste est bien triée
        $idFiliPrec = 0;

        $idx = 0;
        foreach ($this->ind122s as $ind122) {
            if ($idFiliPrec != $ind122->getIdFili()) {
                if ($idx != 0) {
                    $this->ind122s[$idx - 1]->setLastFiliere(true);
                }
                $ind122->setNewFiliere(true);
            }

            $idFiliPrec = $ind122->getIdFili();

            $idx++;
        }

        if ($this->ind122s->count() != 0) {
            $this->ind122s[$this->ind122s->count() - 1]->setLastFiliere(true);
        }
    }

    function setFieldsInd122sTemp()
    {
        // Utilisable que si les champs transient des ind121 sont preninit et la liste est bien triée
        $idFiliPrec = 0;

        $idx = 0;
        foreach ($this->ind122sTemp as $ind122) {
            if ($idFiliPrec != $ind122->getIdFili()) {
                if ($idx != 0) {
                    $this->ind122sTemp[$idx - 1]->setLastFiliere(true);
                }
                $ind122->setNewFiliere(true);
            }

            $idFiliPrec = $ind122->getIdFili();

            $idx++;
        }

        if ($this->ind122sTemp->count() != 0) {
            $this->ind122sTemp[$this->ind122sTemp->count() - 1]->setLastFiliere(true);
        }
    }

    function setFieldsInd141s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $idGrouPosistatPrec = 0;

        $idx = 0;
        foreach ($this->ind141s as $ind141) {
            if ($idGrouPosistatPrec != $ind141->getIdGrouPosistat()) {
                if ($idx != 0) {
                    $this->ind141s[$idx - 1]->setLastGroupe(true);
                }
                $ind141->setNewGroupe(true);
            }

            $idGrouPosistatPrec = $ind141->getIdGrouPosistat();

            $idx++;
        }

        if ($this->ind141s->count() != 0) {
            $this->ind141s[$this->ind141s->count() - 1]->setLastGroupe(true);
        }
    }

    function setFieldsInd142s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $idGrouPosistatPrec = 0;

        $idx = 0;
        foreach ($this->ind142s as $ind142) {
            if ($idGrouPosistatPrec != $ind142->getIdGrouPosistat()) {
                if ($idx != 0) {
                    $this->ind142s[$idx - 1]->setLastGroupe(true);
                }
                $ind142->setNewGroupe(true);
            }

            $idGrouPosistatPrec = $ind142->getIdGrouPosistat();

            $idx++;
        }

        if ($this->ind142s->count() != 0) {
            $this->ind142s[$this->ind142s->count() - 1]->setLastGroupe(true);
        }
    }

    function setFieldsInd143s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $idGrouPosistatPrec = 0;

        $idx = 0;
        foreach ($this->ind143s as $ind143) {
            if ($idGrouPosistatPrec != $ind143->getIdGrouPosistat()) {
                if ($idx != 0) {
                    $this->ind143s[$idx - 1]->setLastGroupe(true);
                }
                $ind143->setNewGroupe(true);
            }

            $idGrouPosistatPrec = $ind143->getIdGrouPosistat();

            $idx++;
        }

        if ($this->ind143s->count() != 0) {
            $this->ind143s[$this->ind143s->count() - 1]->setLastGroupe(true);
        }
    }

    function setFieldsInd144s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $idGrouPosistatPrec = 0;

        $idx = 0;
        foreach ($this->ind144s as $ind144) {
            if ($idGrouPosistatPrec != $ind144->getIdGrouPosistat()) {
                if ($idx != 0) {
                    $this->ind144s[$idx - 1]->setLastGroupe(true);
                }
                $ind144->setNewGroupe(true);
            }

            $idGrouPosistatPrec = $ind144->getIdGrouPosistat();

            $idx++;
        }

        if ($this->ind144s->count() != 0) {
            $this->ind144s[$this->ind144s->count() - 1]->setLastGroupe(true);
        }
    }

    function setFieldsInd1501s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $nbTemp = 0;
        $nbDefi = 0;

        $idx = 0;

        foreach ($this->ind1501s as $ind1501) {
            if ($ind1501->getRefMotifDepart()->getBlDepadefi() == true) {
                $nbDefi++;
            }
            if ($ind1501->getRefMotifDepart()->getBlDepatemp() == true) {
                $nbTemp++;
            }
        }

        $firstTempDone = false;
        $firstDefiDone = false;

        foreach ($this->ind1501s as $ind1501) {
            if ($ind1501->getRefMotifDepart()->getBlDepadefi() == true && $firstDefiDone == false) {
                $ind1501->setNbRowspan(strval($nbDefi));
                $firstDefiDone = true;
            }

            if ($ind1501->getRefMotifDepart()->getBlDepatemp() == true && $firstTempDone == false) {
                $ind1501->setNbRowspan(strval($nbTemp));
                $firstTempDone = true;
            }
        }
        /*
          foreach ($this->ind1501s as $ind1501) {
          error_log($ind1501->getRefMotifDepart()->getlbMotidepa() . ' - ' .   $ind1501->getNbRowspan() ,0 );
          } */
    }

    function setFieldsInd1502s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $nbTemp = 0;
        $nbPerm = 0;

        $idx = 0;

        foreach ($this->ind1502s as $ind1502) {
            if ($ind1502->getRefMotifDepart()->getBlDepadefi() == true) {
                $nbPerm++;
            }
            if ($ind1502->getRefMotifDepart()->getBlDepatemp() == true) {
                $nbTemp++;
            }
        }

        $firstTempDone = false;
        $firstPermDone = false;

        foreach ($this->ind1502s as $ind1502) {
            if ($ind1502->getRefMotifDepart()->getBlDepadefi() == true && $firstPermDone == false) {
                $ind1502->setNbRowspan(strval($nbPerm));
                $firstPermDone = true;
            }

            if ($ind1502->getRefMotifDepart()->getBlDepatemp() == true && $firstTempDone == false) {
                $ind1502->setNbRowspan(strval($nbTemp));
                $firstTempDone = true;
            }
        }

        /* foreach ($this->ind1502s as $ind1502) {
          error_log($ind1502->getRefMotifDepart()->getlbMotidepa() . ' - ' .   $ind1502->getNbRowspan() ,0 );
          } */
    }

    function setFieldsInd171s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $nbHomme = 0;
        $nbFemme = 0;

        foreach ($this->ind171s as $ind171) {
            if ($ind171->getFgGenr() == 'H') {
                $nbHomme++;
            }
            if ($ind171->getFgGenr() == 'F') {
                $nbFemme++;
            }
        }

        $firstHommeDone = false;
        $firstFemmeDone = false;

        $idx711 = 0;

        foreach ($this->ind171s as $ind171) {
            if ($ind171->getFgGenr() == 'H' && $firstHommeDone == false) {
                $ind171->setNbRowspan(strval($nbHomme + 1));
                $firstHommeDone = true;
            }

            if ($ind171->getFgGenr() == 'F' && $firstFemmeDone == false) {
                $ind171->setNbRowspan(strval($nbFemme + 1));
                $firstFemmeDone = true;
            }

            //error_log(json_encode($idx711) . ' - ' . json_encode($nbHomme-1) ,0);

            if ($idx711 == $nbHomme - 1) {
                $ind171->setLastGenre(true);
            }

            if ($idx711 == $this->ind171s->count() - 1) {
                $ind171->setLastGenre(true);
            }

            $idx711 = $idx711 + 1;
        }
    }

    function setFieldsInd171sTemp()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $nbEnsemble = 0;

        foreach ($this->ind171sTemp as $ind171) {
            if ($ind171->getFgGenr() == 'E') {
                $nbEnsemble++;
            }
        }

        $firstEnsembleDone = false;

        $idx711 = 0;

        foreach ($this->ind171sTemp as $ind171) {
            if ($ind171->getFgGenr() == 'E' && $firstEnsembleDone == false) {
                $ind171->setNbRowspan(strval($nbEnsemble + 1));
                $firstEnsembleDone = true;
            }

            //error_log(json_encode($idx711) . ' - ' . json_encode($nbHomme-1) ,0);

            if ($idx711 == $nbEnsemble - 1) {
                $ind171->setLastGenre(true);
            }

            if ($idx711 == $this->ind171sTemp->count() - 1) {
                $ind171->setLastGenre(true);
            }

            $idx711 = $idx711 + 1;
        }
    }

    function setFieldsInd2111s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;
        $nbAbsAutre = 0;

        foreach ($this->ind2111s as $ind2111) {
            if ($ind2111->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2111->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }
            if ($ind2111->getRefMotifAbsence()->getBlAbseautrrais() == true) {
                $nbAbsAutre++;
            }
        }

        $firstCompDone = false;
        $firstMediDone = false;
        $firstAutreDone = false;


        foreach ($this->ind2111s as $ind2111) {
            if ($ind2111->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2111->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2111->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2111->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }

            if ($ind2111->getRefMotifAbsence()->getBlAbseautrrais() == true && $firstAutreDone == false) {
                $ind2111->setNbRowspan(strval($nbAbsAutre));
                $firstAutreDone = true;
            }
        }
    }

    function setFieldsInd2112s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;


        foreach ($this->ind2112s as $ind2112) {
            if ($ind2112->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2112->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }

        }

        $firstCompDone = false;
        $firstMediDone = false;


        foreach ($this->ind2112s as $ind2112) {
            if ($ind2112->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2112->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2112->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2112->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }


        }
    }

    function setFieldsInd2113s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;


        foreach ($this->ind2113s as $ind2113) {
            if ($ind2113->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2113->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }

        }

        $firstCompDone = false;
        $firstMediDone = false;


        foreach ($this->ind2113s as $ind2113) {
            if ($ind2113->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2113->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2113->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2113->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }


        }
    }


    function setFieldsInd2121s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;
        $nbAbsAutre = 0;

        foreach ($this->ind2121s as $ind2121) {
            if ($ind2121->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2121->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }
            if ($ind2121->getRefMotifAbsence()->getBlAbseautrrais() == true) {
                $nbAbsAutre++;
            }
        }

        $firstCompDone = false;
        $firstMediDone = false;
        $firstAutreDone = false;

        foreach ($this->ind2121s as $ind2121) {
            if ($ind2121->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2121->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2121->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2121->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }

            if ($ind2121->getRefMotifAbsence()->getBlAbseautrrais() == true && $firstAutreDone == false) {
                $ind2121->setNbRowspan(strval($nbAbsAutre));
                $firstAutreDone = true;
            }
        }
    }

    function setFieldsInd2122s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;


        foreach ($this->ind2122s as $ind2122) {
            if ($ind2122->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2122->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }

        }

        $firstCompDone = false;
        $firstMediDone = false;

        foreach ($this->ind2122s as $ind2122) {
            if ($ind2122->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2122->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2122->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2122->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }
        }
    }


    function setFieldsInd2123s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;


        foreach ($this->ind2123s as $ind2123) {
            if ($ind2123->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2123->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }
        }

        $firstCompDone = false;
        $firstMediDone = false;

        foreach ($this->ind2123s as $ind2123) {
            if ($ind2123->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2123->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2123->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2123->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }


        }
    }

    function setFieldsInd2131s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;
        $nbAbsAutre = 0;

        foreach ($this->ind2131s as $ind2131) {
            if ($ind2131->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2131->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }
            if ($ind2131->getRefMotifAbsence()->getBlAbseautrrais() == true) {
                $nbAbsAutre++;
            }
        }

        $firstCompDone = false;
        $firstMediDone = false;
        $firstAutreDone = false;


        foreach ($this->ind2131s as $ind2131) {
            if ($ind2131->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2131->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2131->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2131->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }

            if ($ind2131->getRefMotifAbsence()->getBlAbseautrrais() == true && $firstAutreDone == false) {
                $ind2131->setNbRowspan(strval($nbAbsAutre));
                $firstAutreDone = true;
            }
        }
    }

    function setFieldsInd2132s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;

        foreach ($this->ind2132s as $ind2132) {
            if ($ind2132->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2132->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }

        }

        $firstCompDone = false;
        $firstMediDone = false;

        foreach ($this->ind2132s as $ind2132) {
            if ($ind2132->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2132->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2132->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2132->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }
        }
    }


    function setFieldsInd2133s()
    {
        $nbAbsComp = 0;
        $nbAbsMedi = 0;


        foreach ($this->ind2133s as $ind2133) {
            if ($ind2133->getRefMotifAbsence()->getBlAbsecomp() == true) {
                $nbAbsComp++;
            }
            if ($ind2133->getRefMotifAbsence()->getBlAbsemedi() == true) {
                $nbAbsMedi++;
            }

        }

        $firstCompDone = false;
        $firstMediDone = false;

        foreach ($this->ind2133s as $ind2133) {
            if ($ind2133->getRefMotifAbsence()->getBlAbsecomp() == true && $firstCompDone == false) {
                $ind2133->setNbRowspan(strval($nbAbsComp));
                $firstCompDone = true;
            }

            if ($ind2133->getRefMotifAbsence()->getBlAbsemedi() == true && $firstMediDone == false) {
                $ind2133->setNbRowspan(strval($nbAbsMedi));
                $firstMediDone = true;
            }


        }
    }


    function setFieldsInd221s()
    {
        $lbGrouCyclPrec = "";

        $idx = 0;
        foreach ($this->ind221s as $ind) {
            if ($lbGrouCyclPrec != $ind->getRefCycleTravail()->getLbGroupeCycltrav()
                && $lbGrouCyclPrec != "") {
                if ($idx != 0) {
                    $this->ind221s[$idx - 1]->setLastGroupe(true);
                }
                $ind->setNewGroupe(true);
            }

            $lbGrouCyclPrec = $ind->getRefCycleTravail()->getLbGroupeCycltrav();

            $idx++;
        }

        if ($this->ind221s->count() != 0) {
            $this->ind221s[$this->ind221s->count() - 1]->setLastGroupe(true);
        }
    }


    function setFieldsInd5112s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $idCatePrec = 0;

        $idx = 0;
        foreach ($this->ind5112s as $ind) {
            if ($idCatePrec != $ind->getRefCategorie()->getIdCate()) {
                if ($idx != 0) {
                    $this->ind5112s[$idx - 1]->setLastCateg(true);
                }
                $ind->setNewCateg(true);
            }

            $idCatePrec = $ind->getRefCategorie()->getIdCate();

            $idx++;
        }

        if ($this->ind5112s->count() != 0) {
            $this->ind5112s[$this->ind5112s->count() - 1]->setLastCateg(true);
        }
    }

    function setFieldsInd5113s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $idCatePrec = 0;

        $idx = 0;
        foreach ($this->ind5113s as $ind) {
            if ($idCatePrec != $ind->getRefCategorie()->getIdCate()) {
                if ($idx != 0) {
                    $this->ind5113s[$idx - 1]->setLastCateg(true);
                }
                $ind->setNewCateg(true);
            }

            $idCatePrec = $ind->getRefCategorie()->getIdCate();

            $idx++;
        }

        if ($this->ind5113s->count() != 0) {
            $this->ind5113s[$this->ind5113s->count() - 1]->setLastCateg(true);
        }
    }

    function setFieldsInd513s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $typePrec = 0;

        foreach ($this->ind513s as $ind) {
            if ($typePrec != $ind->getType()) {
                $ind->setFirstType(true);
            }
            $typePrec = $ind->getType();
        }

    }

    function setFieldsInd6141s()
    {
        // Utilisable que si les champs transient des ind141 sont preninit et la liste est bien triée
        $groupe1Ok = 0;
        $groupe2Ok = 0;
        $groupe3Ok = 0;
        $groupe4Ok = 0;
        $groupe5Ok = 0;
        $groupe6Ok = 0;

        foreach ($this->ind6141s as $ind) {
            if ($ind->getGroupe() == 1) {
                if ($groupe1Ok == 0) {
                    $ind->setFirstGroupe1(true);
                    $groupe1Ok = 1;
                }
            }
            if ($ind->getGroupe() == 2) {
                if ($groupe2Ok == 0) {
                    $ind->setFirstGroupe2(true);
                    $groupe2Ok = 1;
                }
            }
            if ($ind->getGroupe() == 3) {
                if ($groupe3Ok == 0) {
                    $ind->setFirstGroupe3(true);
                    $groupe3Ok = 1;
                }
            }
            if ($ind->getGroupe() == 4) {
                if ($groupe4Ok == 0) {
                    $ind->setFirstGroupe4(true);
                    $groupe4Ok = 1;
                }
            }
            if ($ind->getGroupe() == 5) {
                if ($groupe5Ok == 0) {
                    $ind->setFirstGroupe5(true);
                    $groupe5Ok = 1;
                }
            }
            if ($ind->getGroupe() == 6) {
                if ($groupe6Ok == 0) {
                    $ind->setFirstGroupe6(true);
                    $groupe6Ok = 1;
                }
            }
        }

    }

    function setInd110NullToZero()
    {
        foreach ($this->ind1101s as $ind) {
            $ind->setR1101($ind->getR1101(0));
            $ind->setR1102($ind->getR1102(0));
            $ind->setR1103($ind->getR1103(0));
            $ind->setR1104($ind->getR1104(0));
            $ind->setR1105($ind->getR1105(0));
            $ind->setR1106($ind->getR1106(0));
            $ind->setR1107($ind->getR1107(0));
            $ind->setR1108($ind->getR1108(0));
            $ind->setR1109($ind->getR1109(0));
            $ind->setR1110($ind->getR1110(0));
        }
        foreach ($this->ind1102s as $ind) {
            $ind->setR1101($ind->getR1101(0));
            $ind->setR1102($ind->getR1102(0));
            $ind->setR1103($ind->getR1103(0));
            $ind->setR1104($ind->getR1104(0));
            $ind->setR1105($ind->getR1105(0));
            $ind->setR1106($ind->getR1106(0));
            $ind->setR1107($ind->getR1107(0));
            $ind->setR1108($ind->getR1108(0));
            $ind->setR1109($ind->getR1109(0));
            $ind->setR1110($ind->getR1110(0));
        }
        foreach ($this->ind1103s as $ind) {
            $ind->setR1101($ind->getR1101(0));
            $ind->setR1102($ind->getR1102(0));
        }
    }

    function setInd111NullToZero()
    {
        foreach ($this->ind111s as $ind) {
            $ind->setR1111($ind->getR1111(0));
            $ind->setR1112($ind->getR1112(0));
            $ind->setR1113($ind->getR1113(0));
            $ind->setR1114($ind->getR1114(0));
            $ind->setR1115($ind->getR1115(0));
            $ind->setR1116($ind->getR1116(0));

        }
    }

    function setInd112NullToZero()
    {
        foreach ($this->ind112s as $ind) {
            $ind->setR1121($ind->getR1121(0));
            $ind->setR1122($ind->getR1122(0));
            $ind->setR1123($ind->getR1123(0));
            $ind->setR1124($ind->getR1124(0));
            $ind->setR1125($ind->getR1125(0));
            $ind->setR1126($ind->getR1126(0));
            $ind->setR1127($ind->getR1127(0));
            $ind->setR1128($ind->getR1128(0));

        }
    }

    function setInd113NullToZero()
    {
        foreach ($this->ind113s as $ind) {
            $ind->setR1131($ind->getR1131(0));
            $ind->setR1132($ind->getR1132(0));
        }
    }

    function setInd114NullToZero()
    {
        foreach ($this->ind114s as $ind) {
//            $ind->setR1141($ind->getR1141(0));
//            $ind->setR1142($ind->getR1142(0));
            $ind->setR1143($ind->getR1143(0));
            $ind->setR1144($ind->getR1144(0));
        }
    }

    function setInd121NullToZero()
    {
        foreach ($this->ind121s as $ind) {
            $ind->setR1211($ind->getR1211(0));
            $ind->setR1212($ind->getR1212(0));
            $ind->setR1213($ind->getR1213(0));
            $ind->setR1214($ind->getR1214(0));
            $ind->setR1215($ind->getR1215(0));
            $ind->setR1216($ind->getR1216(0));
            $ind->setR1217($ind->getR1217(0));
            $ind->setR1218($ind->getR1218(0));
            $ind->setR1219($ind->getR1219(0));
            $ind->setR12110($ind->getR12110(0));
            $ind->setR12111($ind->getR12111(0));
            $ind->setR12112($ind->getR12112(0));
            $ind->setR12113($ind->getR12113(0));
            $ind->setR12114($ind->getR12114(0));
            $ind->setR12115($ind->getR12115(0));
            $ind->setR12116($ind->getR12116(0));
            $ind->setR12117($ind->getR12117(0));
            $ind->setR12118($ind->getR12118(0));
        }
    }

    function setInd122NullToZero()
    {
        foreach ($this->ind122s as $ind) {
            $ind->setR1221($ind->getR1221(0));
            $ind->setR1222($ind->getR1222(0));
            $ind->setR1223($ind->getR1223(0));
            $ind->setR1224($ind->getR1224(0));
            $ind->setR1225($ind->getR1225(0));
            $ind->setR1226($ind->getR1226(0));
            $ind->setR1227($ind->getR1227(0));
            $ind->setR1228($ind->getR1228(0));

        }
    }

    function setInd123NullToZero()
    {
        foreach ($this->ind123s as $ind) {
            $ind->setR1231($ind->getR1231(0));
            $ind->setR1232($ind->getR1232(0));

        }
    }

    function setInd124NullToZero()
    {
        foreach ($this->ind124s as $ind) {
//            $ind->setR1241($ind->getR1241(0));
//            $ind->setR1242($ind->getR1242(0));
            $ind->setR1243($ind->getR1243(0));
            $ind->setR1244($ind->getR1244(0));

        }
    }

    function setInd131NullToZero()
    {
        foreach ($this->ind1311s as $ind) {
            $ind->setR13111($ind->getR13111(0));
            $ind->setR13112($ind->getR13112(0));
            $ind->setR13113($ind->getR13113(0));
            $ind->setR13114($ind->getR13114(0));

        }
        foreach ($this->ind1312s as $ind) {
            $ind->setR13123($ind->getR13123(0));
            $ind->setR13124($ind->getR13124(0));

        }
    }

    function setInd132NullToZero()
    {
        if ($this->getQ132() != null && $this->getQ132() == 1) {
            foreach ($this->getInd132s() as $ind) {
                $ind->setR13211($ind->getR13211(0));
                $ind->setR13212($ind->getR13212(0));
                $ind->setR13213($ind->getR13213(0));
                $ind->setR13214($ind->getR13214(0));
            }
            foreach ($this->getInd132Biss() as $ind) {
                $ind->setR13221($ind->getR13221(0));
                $ind->setR13222($ind->getR13222(0));
                $ind->setR13223($ind->getR13223(0));
                $ind->setR13224($ind->getR13224(0));
            }
        }
    }

    function setInd140NullToZero()
    {

        foreach ($this->getInd141s() as $ind) {
            $ind->setR1411($ind->getR1411(0));
            $ind->setR1412($ind->getR1412(0));
        }

        foreach ($this->getInd142s() as $ind) {
            $ind->setR1421($ind->getR1421(0));
            $ind->setR1422($ind->getR1422(0));
            $ind->setR1423($ind->getR1423(0));
            $ind->setR1424($ind->getR1424(0));
            $ind->setR1425($ind->getR1425(0));
            $ind->setR1426($ind->getR1426(0));
        }


        foreach ($this->getInd143s() as $ind) {
            $ind->setR1431($ind->getR1431(0));
            $ind->setR1432($ind->getR1432(0));
            $ind->setR1433($ind->getR1433(0));
            $ind->setR1434($ind->getR1434(0));
        }

        foreach ($this->getInd144s() as $ind) {
            $ind->setR1441($ind->getR1441(0));
            $ind->setR1442($ind->getR1442(0));
        }
    }

    function setInd150NullToZero()
    {

        foreach ($this->getInd1501s() as $ind) {
            $ind->setR15011($ind->getR15011(0));
            $ind->setR15012($ind->getR15012(0));
            $ind->setR15013($ind->getR15013(0));
            $ind->setR15014($ind->getR15014(0));
            $ind->setR15015($ind->getR15015(0));
            $ind->setR15016($ind->getR15016(0));
            $ind->setR15017($ind->getR15017(0));
            $ind->setR15018($ind->getR15018(0));
        }

        foreach ($this->getInd1502s() as $ind) {
            $ind->setR15021($ind->getR15021(0));
            $ind->setR15022($ind->getR15022(0));
            $ind->setR15023($ind->getR15023(0));
            $ind->setR15024($ind->getR15024(0));
            $ind->setR15025($ind->getR15025(0));
            $ind->setR15026($ind->getR15026(0));
            $ind->setR15027($ind->getR15027(0));
            $ind->setR15028($ind->getR15028(0));
        }
    }

    function setInd151NullToZero()
    {

        foreach ($this->getInd1511s() as $ind) {
            $ind->setR15111($ind->getR15111(0));
            $ind->setR15112($ind->getR15112(0));
            $ind->setR15113($ind->getR15113(0));
            $ind->setR15114($ind->getR15114(0));
            $ind->setR15115($ind->getR15115(0));
            $ind->setR15116($ind->getR15116(0));
            $ind->setR15117($ind->getR15117(0));
            $ind->setR15118($ind->getR15118(0));
            $ind->setR15119($ind->getR15119(0));
            $ind->setR151110($ind->getR151110(0));

        }

        foreach ($this->getInd1512s() as $ind) {
            $ind->setR15121($ind->getR15121(0));
            $ind->setR15122($ind->getR15122(0));
            $ind->setR15123($ind->getR15123(0));
            $ind->setR15124($ind->getR15124(0));
            $ind->setR15125($ind->getR15125(0));
            $ind->setR15126($ind->getR15126(0));
            $ind->setR15127($ind->getR15127(0));
            $ind->setR15128($ind->getR15128(0));
            $ind->setR15129($ind->getR15129(0));
            $ind->setR151210($ind->getR151210(0));
        }

        foreach ($this->getInd1513s() as $ind) {
            $ind->setR15131($ind->getR15131(0));
            $ind->setR15132($ind->getR15132(0));
        }
    }

    function setInd152NullToZero()
    {

        foreach ($this->getInd152s() as $ind) {
            $ind->setR1521($ind->getR1521(0));
            $ind->setR1522($ind->getR1522(0));
            $ind->setR1523($ind->getR1523(0));
            $ind->setR1524($ind->getR1524(0));
            $ind->setR1525($ind->getR1525(0));
            $ind->setR1526($ind->getR1526(0));
            $ind->setR1527($ind->getR1527(0));
            $ind->setR1528($ind->getR1528(0));
            $ind->setR1529($ind->getR1529(0));
            $ind->setR15210($ind->getR15210(0));
            $ind->setR15211($ind->getR15211(0));
            $ind->setR15212($ind->getR15212(0));
            $ind->setR15213($ind->getR15213(0));
            $ind->setR15214($ind->getR15214(0));
            $ind->setR15215($ind->getR15215(0));
            $ind->setR15216($ind->getR15216(0));
            $ind->setR15217($ind->getR15217(0));
            $ind->setR15218($ind->getR15218(0));
            $ind->setR15219($ind->getR15219(0));
            $ind->setR15220($ind->getR15220(0));
            $ind->setR15221($ind->getR15221(0));
        }
    }

    function setInd1531NullToZero()
    {

        foreach ($this->getInd1531s() as $ind) {
            $ind->setR15311($ind->getR15311(0));
            $ind->setR15312($ind->getR15312(0));
            $ind->setR15313($ind->getR15313(0));
            $ind->setR15314($ind->getR15314(0));
        }
    }

    function setInd1532NullToZero()
    {

        foreach ($this->getInd1532s() as $ind) {
            $ind->setR15321($ind->getR15321(0));
            $ind->setR15322($ind->getR15322(0));
            $ind->setR15323($ind->getR15323(0));
            $ind->setR15324($ind->getR15324(0));
        }
    }

    function setInd154NullToZero()
    {

        foreach ($this->getInd154s() as $ind) {
            $ind->setR1541($ind->getR1541(0));
            $ind->setR1542($ind->getR1542(0));

        }

        foreach ($this->getInd155s() as $ind) {
            $ind->setR1551($ind->getR1551(0));
            $ind->setR1552($ind->getR1552(0));

        }

//        foreach ($this->getInd156s() as $ind) {
//            $ind->setR1561($ind->getR1561(0));
//            $ind->setR1562($ind->getR1562(0));
//
//        }
    }

    function setInd157NullToZero() {

        foreach ($this->getInd157s() as $ind) {
            $ind->setR1571($ind->getR1571(0));
            $ind->setR1572($ind->getR1572(0));
        }
    }

    function setInd158NullToZero()
    {

        foreach ($this->getInd158s() as $ind) {
            $ind->setR1581($ind->getR1581(0));
            $ind->setR1582($ind->getR1582(0));
            $ind->setR1583($ind->getR1583(0));
            $ind->setR1584($ind->getR1584(0));
            $ind->setR1585($ind->getR1585(0));
            $ind->setR1586($ind->getR1586(0));
            $ind->setR1587($ind->getR1587(0));
            $ind->setR1588($ind->getR1588(0));
        }
    }


    function setInd161NullToZero()
    {

        if ($this->getQ161() != null && $this->getQ161() == 1) {
            foreach ($this->getInd161s() as $ind) {
                $ind->setR1611($ind->getR1611(0));
                $ind->setR1612($ind->getR1612(0));
                $ind->setR1613($ind->getR1613(0));
                $ind->setR1614($ind->getR1614(0));
            }

            foreach ($this->getInd1612s() as $ind) {
                $ind->setR16121($ind->getR16121(0));
                $ind->setR16122($ind->getR16122(0));
                $ind->setR16123($ind->getR16123(0));
                $ind->setR16124($ind->getR16124(0));
            }
        }
    }

    function setInd162NullToZero()
    {
        if ($this->getR16211() == null) $this->setR16211(0);
        if ($this->getR16212() == null) $this->setR16212(0);
        if ($this->getR16213() == null) $this->setR16213(0);
        if ($this->getR16214() == null) $this->setR16214(0);
    }

    function setInd171NullToZero()
    {

        foreach ($this->getInd171s() as $ind) {
            $ind->setR1711($ind->getR1711(0));
            $ind->setR1712($ind->getR1712(0));
            $ind->setR1713($ind->getR1713(0));
        }
    }

    function setInd211NullToZero()
    {

        foreach ($this->getInd2111s() as $ind) {
            $ind->setR21111($ind->getR21111(0));
            $ind->setR21112($ind->getR21112(0));
            $ind->setR21113($ind->getR21113(0));
            $ind->setR21114($ind->getR21114(0));
            $ind->setR21115($ind->getR21115(0));
            $ind->setR21116($ind->getR21116(0));

        }
        foreach ($this->getInd2112s() as $ind) {
            $ind->setR21121($ind->getR21121(0));
            $ind->setR21122($ind->getR21122(0));
            $ind->setR21123($ind->getR21123(0));
            $ind->setR21124($ind->getR21124(0));
            $ind->setR21125($ind->getR21125(0));
            $ind->setR21126($ind->getR21126(0));
            $ind->setR21127($ind->getR21127(0));
            $ind->setR21128($ind->getR21128(0));
            $ind->setR21129($ind->getR21129(0));
            $ind->setR211210($ind->getR211210(0));

        }
        foreach ($this->getInd2113s() as $ind) {
            $ind->setR21131($ind->getR21131(0));
            $ind->setR21132($ind->getR21132(0));
            $ind->setR21133($ind->getR21133(0));
            $ind->setR21134($ind->getR21134(0));
            $ind->setR21135($ind->getR21135(0));
            $ind->setR21136($ind->getR21136(0));
            $ind->setR21137($ind->getR21137(0));
            $ind->setR21138($ind->getR21138(0));
            $ind->setR21139($ind->getR21139(0));
            $ind->setR211310($ind->getR211310(0));

        }

    }

    function setInd212NullToZero()
    {

        foreach ($this->getInd2121s() as $ind) {
            $ind->setR21211($ind->getR21211(0));
            $ind->setR21212($ind->getR21212(0));
            $ind->setR21213($ind->getR21213(0));
            $ind->setR21214($ind->getR21214(0));
            $ind->setR21215($ind->getR21215(0));
            $ind->setR21216($ind->getR21216(0));

        }
        foreach ($this->getInd2122s() as $ind) {
            $ind->setR21221($ind->getR21221(0));
            $ind->setR21222($ind->getR21222(0));
            $ind->setR21223($ind->getR21223(0));
            $ind->setR21224($ind->getR21224(0));
            $ind->setR21225($ind->getR21225(0));
            $ind->setR21226($ind->getR21226(0));
            $ind->setR21227($ind->getR21227(0));
            $ind->setR21228($ind->getR21228(0));
            $ind->setR21229($ind->getR21229(0));
            $ind->setR212210($ind->getR212210(0));

        }
        foreach ($this->getInd2123s() as $ind) {
            $ind->setR21231($ind->getR21231(0));
            $ind->setR21232($ind->getR21232(0));
            $ind->setR21233($ind->getR21233(0));
            $ind->setR21234($ind->getR21234(0));
            $ind->setR21235($ind->getR21235(0));
            $ind->setR21236($ind->getR21236(0));
            $ind->setR21237($ind->getR21237(0));
            $ind->setR21238($ind->getR21238(0));
            $ind->setR21239($ind->getR21239(0));
            $ind->setR212310($ind->getR212310(0));

        }

    }

    function setInd213NullToZero()
    {

        foreach ($this->getInd2131s() as $ind) {
            $ind->setR21311($ind->getR21311(0));
            $ind->setR21312($ind->getR21312(0));
            $ind->setR21313($ind->getR21313(0));
            $ind->setR21314($ind->getR21314(0));
            $ind->setR21315($ind->getR21315(0));
            $ind->setR21316($ind->getR21316(0));

        }
        foreach ($this->getInd2132s() as $ind) {
            $ind->setR21321($ind->getR21321(0));
            $ind->setR21322($ind->getR21322(0));
            $ind->setR21323($ind->getR21323(0));
            $ind->setR21324($ind->getR21324(0));
            $ind->setR21325($ind->getR21325(0));
            $ind->setR21326($ind->getR21326(0));
            $ind->setR21327($ind->getR21327(0));
            $ind->setR21328($ind->getR21328(0));
            $ind->setR21329($ind->getR21329(0));
            $ind->setR213210($ind->getR213210(0));

        }
        foreach ($this->getInd2133s() as $ind) {
            $ind->setR21331($ind->getR21331(0));
            $ind->setR21332($ind->getR21332(0));
            $ind->setR21333($ind->getR21333(0));
            $ind->setR21334($ind->getR21334(0));
            $ind->setR21335($ind->getR21335(0));
            $ind->setR21336($ind->getR21336(0));
            $ind->setR21337($ind->getR21337(0));
            $ind->setR21338($ind->getR21338(0));
            $ind->setR21339($ind->getR21339(0));
            $ind->setR213310($ind->getR213310(0));
        }
    }

    function setInd214NullToZero()
    {

        foreach ($this->getInd214s() as $ind) {
            $ind->setR2141($ind->getR2141(0));
            $ind->setR2142($ind->getR2142(0));
        }
    }

    function setInd215NullToZero()
    {

        foreach ($this->getInd215s() as $ind) {
            $ind->setR2151($ind->getR2151(0));
            $ind->setR2152($ind->getR2152(0));
        }
    }

    function setInd216NullToZero()
    {

        foreach ($this->getInd216s() as $ind) {
            $ind->setR2161($ind->getR2161(0));
            $ind->setR2162($ind->getR2162(0));
        }
    }

    function setInd221NullToZero()
    {

        foreach ($this->getInd221s() as $ind) {
            $ind->setR2211($ind->getR2211(0));
            $ind->setR2212($ind->getR2212(0));

        }
    }

    function setInd222NullToZero()
    {

        foreach ($this->getInd222s() as $ind) {
            $ind->setR2221($ind->getR2221(0));
            $ind->setR2222($ind->getR2222(0));

        }
    }

    function setInd223NullToZero()
    {

        foreach ($this->getInd2231s() as $ind) {
            $ind->setR22311($ind->getR22311(0));
            $ind->setR22312($ind->getR22312(0));
            $ind->setR22313($ind->getR22313(0));
            $ind->setR22314($ind->getR22314(0));

        }

        foreach ($this->getInd2232s() as $ind) {
            $ind->setR22321($ind->getR22321(0));
            $ind->setR22322($ind->getR22322(0));
            $ind->setR22323($ind->getR22323(0));
            $ind->setR22324($ind->getR22324(0));

        }

        foreach ($this->getInd2233s() as $ind) {
            $ind->setR22331($ind->getR22331(0));
            $ind->setR22332($ind->getR22332(0));
            $ind->setR22333($ind->getR22333(0));
            $ind->setR22334($ind->getR22334(0));
            $ind->setR22335($ind->getR22335(0));
            $ind->setR22336($ind->getR22336(0));
            $ind->setR22337($ind->getR22337(0));
            $ind->setR22338($ind->getR22338(0));

        }
    }

    function setInd224NullToZero()
    {

        foreach ($this->getInd224s() as $ind) {
            $ind->setR2241($ind->getR2241(0));
            $ind->setR2242($ind->getR2242(0));
            $ind->setR2243($ind->getR2243(0));
            $ind->setR2244($ind->getR2244(0));
            $ind->setR2245($ind->getR2245(0));
            $ind->setR2246($ind->getR2246(0));
            $ind->setR2247($ind->getR2247(0));
            $ind->setR2248($ind->getR2248(0));
            $ind->setR2249($ind->getR2249(0));
            $ind->setR22410($ind->getR22410(0));
            $ind->setR22411($ind->getR22411(0));
            $ind->setR22412($ind->getR22412(0));
            $ind->setR22413($ind->getR22413(0));
            $ind->setR22414($ind->getR22414(0));
            $ind->setR22415($ind->getR22415(0));
            $ind->setR22416($ind->getR22416(0));
        }
    }


    function setInd226NullToZero()
    {

        foreach ($this->getInd2261s() as $ind) {
            $ind->setR22611($ind->getR22611(0));
            $ind->setR22612($ind->getR22612(0));
            $ind->setR22613($ind->getR22613(0));
            $ind->setR22614($ind->getR22614(0));
            $ind->setR22615($ind->getR22615(0));
            $ind->setR22616($ind->getR22616(0));

        }

        foreach ($this->getInd2262s() as $ind) {
            $ind->setR22621($ind->getR22621(0));
            $ind->setR22622($ind->getR22622(0));
            $ind->setR22623($ind->getR22623(0));
            $ind->setR22624($ind->getR22624(0));
            $ind->setR22625($ind->getR22625(0));
            $ind->setR22626($ind->getR22626(0));

        }

        foreach ($this->getInd2263s() as $ind) {
            $ind->setR22631($ind->getR22631(0));
            $ind->setR22632($ind->getR22632(0));
            $ind->setR22633($ind->getR22633(0));
            $ind->setR22634($ind->getR22634(0));
            $ind->setR22635($ind->getR22635(0));
            $ind->setR22636($ind->getR22636(0));

        }
    }

    function setInd231NullToZero()
    {

        foreach ($this->getInd231s() as $ind) {
            $ind->setR2311($ind->getR2311(0));
            $ind->setR2312($ind->getR2312(0));
        }
    }

    function setInd311NullToZero()
    {

        foreach ($this->getInd311s() as $ind) {
            $ind->setR3111($ind->getR3111(0));
            $ind->setR3112($ind->getR3112(0));
            $ind->setR3113($ind->getR3113(0));
            $ind->setR3114($ind->getR3114(0));
            $ind->setR3115($ind->getR3115(0));
            $ind->setR3116($ind->getR3116(0));
            $ind->setR3117($ind->getR3117(0));
            $ind->setR3118($ind->getR3118(0));
            $ind->setR3119($ind->getR3119(0));
            $ind->setR31110($ind->getR31110(0));
            $ind->setR31111($ind->getR31111(0));
            $ind->setR31112($ind->getR31112(0));

        }
    }

    function setInd321NullToZero()
    {

        foreach ($this->getInd321s() as $ind) {
            $ind->setR3211($ind->getR3211(0));
            $ind->setR3212($ind->getR3212(0));
            $ind->setR3213($ind->getR3213(0));
            $ind->setR3214($ind->getR3214(0));
            $ind->setR3215($ind->getR3215(0));
            $ind->setR3216($ind->getR3216(0));
        }
    }

    function setInd331NullToZero()
    {

        foreach ($this->getInd331s() as $ind) {
            $ind->setR3311($ind->getR3311(0));
            $ind->setR3312($ind->getR3312(0));
        }
    }


    function setInd341NullToZero()
    {
        if ($this->getR3411() == null) $this->setR3411(0);
        if ($this->getR3412() == null) $this->setR3412(0);
    }

    function setInd342NullToZero()
    {
        if ($this->getR342() == null) $this->setR342(0);

    }


    function setInd344NullToZero()
    {

        if ($this->getQ344() != null && $this->getQ344() == 1) {
            foreach ($this->getInd344s() as $ind) {
                $ind->setR3441($ind->getR3441(0));
                $ind->setR3442($ind->getR3442(0));
                $ind->setR3443($ind->getR3443(0));
                $ind->setR3444($ind->getR3444(0));

            }
        }
    }

    function setInd345NullToZero()
    {
        if ($this->getR3451() == null) $this->setR3451(0);
        if ($this->getR3452() == null) $this->setR3452(0);
    }

    function setInd411NullToZero()
    {

        foreach ($this->getInd411s() as $ind) {
            $ind->setR4111($ind->getR4111(0));

        }

        foreach ($this->getInd412s() as $ind) {
            $ind->setR4121($ind->getR4121(0));
            $ind->setR4122($ind->getR4122(0));
            $ind->setR4123($ind->getR4123(0));

        }
    }

    function setInd413NullToZero()
    {
        if ($this->getR4131() == null) $this->setR4131(0);
        if ($this->getR4132() == null) $this->setR4132(0);

    }

    function setInd421NullToZero()
    {

        if ($this->getQ421() != null && $this->getQ421() == 1) {
            foreach ($this->getInd421s() as $ind) {
                $ind->setR4211($ind->getR4211(0));
                $ind->setR4212($ind->getR4212(0));
                $ind->setR4213($ind->getR4213(0));
                $ind->setR4214($ind->getR4214(0));
                $ind->setR4215($ind->getR4215(0));
                $ind->setR4216($ind->getR4216(0));
                $ind->setR4217($ind->getR4217(0));
                $ind->setR4218($ind->getR4218(0));
                $ind->setR4219($ind->getR4219(0));
                $ind->setR42110($ind->getR42110(0));
                $ind->setR42111($ind->getR42111(0));
                $ind->setR42112($ind->getR42112(0));

            }
        }
    }

    function setInd422NullToZero()
    {

        if ($this->getQ422() != null && $this->getQ422() == 1) {
            foreach ($this->getInd422s() as $ind) {
                $ind->setR4221($ind->getR4221(0));
                $ind->setR4222($ind->getR4222(0));
                $ind->setR4223($ind->getR4223(0));
                $ind->setR4224($ind->getR4224(0));
                $ind->setR4225($ind->getR4225(0));
                $ind->setR4226($ind->getR4226(0));
                $ind->setR4227($ind->getR4227(0));
                $ind->setR4228($ind->getR4228(0));

            }
        }
    }

    function setInd423NullToZero()
    {

        foreach ($this->getInd423s() as $ind) {
            $ind->setR4231($ind->getR4231(0));
        }

        foreach ($this->getInd423sFili() as $f) {
            $f->setR4231Fili($f->getR4231Fili(0));
        }
    }

    function setInd424NullToZero()
    {

        foreach ($this->getInd424s() as $ind) {

            $ind->setRTS4241($ind->getRTS4241(0));
            $ind->setRTS4242($ind->getRTS4242(0));
            $ind->setRTS4243($ind->getRTS4243(0));
            $ind->setRTS4244($ind->getRTS4244(0));
            $ind->setRTS4245($ind->getRTS4245(0));
            $ind->setRTS4246($ind->getRTS4246(0));
            $ind->setREMP4241($ind->getREMP4241(0));
            $ind->setREMP4242($ind->getREMP4242(0));
            $ind->setREMP4243($ind->getREMP4243(0));
            $ind->setREMP4244($ind->getREMP4244(0));
            $ind->setREMP4245($ind->getREMP4245(0));
            $ind->setREMP4246($ind->getREMP4246(0));

        }
    }

    function setInd431NullToZero()
    {

        if ($this->getQ4311() != null && $this->getQ4311() == 1) {
            foreach ($this->getInd431s() as $ind) {
                $ind->setR43111($ind->getR43111(0));
                $ind->setR43112($ind->getR43112(0));
            }
        }
        if ($this->getQ4312() != null && $this->getQ4312() == 1) {
            foreach ($this->getInd431s() as $ind) {
                $ind->setR43121($ind->getR43121(0));
                $ind->setR43122($ind->getR43122(0));
            }
        }
        if ($this->getQ4313() != null && $this->getQ4313() == 1) {
            foreach ($this->getInd431s() as $ind) {
                $ind->setR43131($ind->getR43131(0));
                $ind->setR43132($ind->getR43132(0));
            }
        }
    }

    function setInd5111NullToZero()
    {

        foreach ($this->getInd5111s() as $ind) {

            $ind->setR51111($ind->getR51111(0));
            $ind->setR51112($ind->getR51112(0));
            $ind->setR51113($ind->getR51113(0));
            $ind->setR51114($ind->getR51114(0));


        }
    }

    function setInd5112NullToZero()
    {

        foreach ($this->getInd5112s() as $ind) {

            $ind->setR51121($ind->getR51121(0));
            $ind->setR51122($ind->getR51122(0));
            $ind->setR51123($ind->getR51123(0));
            $ind->setR51124($ind->getR51124(0));
            $ind->setR51125($ind->getR51125(0));
            $ind->setR51126($ind->getR51126(0));
            $ind->setR51127($ind->getR51127(0));
            $ind->setR51128($ind->getR51128(0));


        }
    }

    function setInd5113NullToZero()
    {

        foreach ($this->getInd5113s() as $ind) {

            $ind->setR51131($ind->getR51131(0));
            $ind->setR51132($ind->getR51132(0));
            $ind->setR51133($ind->getR51133(0));
            $ind->setR51134($ind->getR51134(0));
            $ind->setR51135($ind->getR51135(0));
            $ind->setR51136($ind->getR51136(0));
            $ind->setR51137($ind->getR51137(0));
            $ind->setR51138($ind->getR51138(0));

        }
    }

    function setInd512NullToZero()
    {

        foreach ($this->getInd5121s() as $ind) {

            $ind->setR51211($ind->getR51211(0));
            $ind->setR51212($ind->getR51212(0));
            $ind->setR51213($ind->getR51213(0));
            $ind->setR51214($ind->getR51214(0));
            $ind->setR51215($ind->getR51215(0));
            $ind->setR51216($ind->getR51216(0));
            $ind->setR51217($ind->getR51217(0));
            $ind->setR51218($ind->getR51218(0));

        }
        foreach ($this->getInd5122s() as $ind) {

            $ind->setR51221($ind->getR51221(0));
            $ind->setR51222($ind->getR51222(0));

        }
    }

    function setInd513NullToZero()
    {


        foreach ($this->getInd513s() as $ind) {

            $ind->setR5131($ind->getR5131(0));
            $ind->setR5132($ind->getR5132(0));
            $ind->setR5133($ind->getR5133(0));
            $ind->setR5134($ind->getR5134(0));

        }
    }

    function setInd514NullToZero()
    {
        if ($this->getR5141() == null) $this->setR5141(0);
        if ($this->getR5142() == null) $this->setR5142(0);
        if ($this->getR5143() == null) $this->setR5143(0);
        if ($this->getR5144() == null) $this->setR5144(0);
    }

    function setInd611NullToZero()
    {
        if ($this->getR6111() == null) $this->setR6111(0);
        if ($this->getR6112() == null) $this->setR6112(0);
        if ($this->getR6117() == null) $this->setR6117(0);


        if ($this->getQ6113() != null && $this->getQ6113() == 1) {
            if ($this->getR6113() == null) $this->setR6113(0);
        }
        if ($this->getQ6114() != null && $this->getQ6114() == 1) {
            if ($this->getR6114() == null) $this->setR6114(0);
            if ($this->getR6115() == null) $this->setR6115(0);
            if ($this->getR6116() == null) $this->setR6116(0);
        }

    }

    function setInd612NullToZero()
    {
        if ($this->getR6121() == null) $this->setR6121(0);
        if ($this->getR6122() == null) $this->setR6122(0);
        if ($this->getR6123() == null) $this->setR6123(0);
        if ($this->getR6124() == null) $this->setR6124(0);
        if ($this->getR6125() == null) $this->setR6125(0);
        if ($this->getR6126() == null) $this->setR6126(0);
    }

    function setInd613NullToZero()
    {

        if ($this->getQ613() != null && $this->getQ613() == 1) {
            foreach ($this->getInd613s() as $ind) {
                $ind->setR6132($ind->getR6132(0));

            }
        }
    }

    function setInd614NullToZero()
    {


        foreach ($this->getInd6141s() as $ind) {
            $ind->setR61411($ind->getR61411(0));

        }

        foreach ($this->getInd6141s() as $ind) {
            $ind->setR61412($ind->getR61412(0));

        }

        foreach ($this->getInd6142s() as $ind) {
            $ind->setR61421($ind->getR61421(0));

        }

        foreach ($this->getInd6142s() as $ind) {
            $ind->setR61422($ind->getR61422(0));

        }
    }

    function setInd714NullToZero()
    {
        if ($this->getQS7141() == true || $this->getQS7142() == true) {
            foreach ($this->getInd7141s() as $ind7141) {
                $ind7141->setR71411($ind7141->getR71411(0));
            }
            foreach ($this->getInd7142s() as $ind7142) {
                $ind7142->setR71421($ind7142->getR71421(0));
            }

            if ($this->getR71411HC() == null) $this->setR71411HC(0);
            if ($this->getR71421HC() == null) $this->setR71421HC(0);

        }

        if ($this->getQP7143() == true || $this->getQP7144() == true) {
            foreach ($this->getInd7141s() as $ind7141) {
                $ind7141->setR71412($ind7141->getR71412(0));
            }
            foreach ($this->getInd7142s() as $ind7142) {
                $ind7142->setR71422($ind7142->getR71422(0));
            }
            if ($this->getR71412HC() == null) $this->setR71412HC(0);
            if ($this->getR71422HC() == null) $this->setR71422HC(0);

        }
    }

    function setRassctAccidentTravailNullToZero()
    {
        foreach ($this->getBscRassctAccidentTravails() as $ind) {
            $ind->setRAccident1($ind->getRAccident1(0));
            $ind->setRAccident2($ind->getRAccident2(0));
        }
    }

    function setRassctRealisationFormationSanteTravailNullToZero()
    {
        foreach ($this->getBscRassctRealisationFormationSanteTravails() as $ind) {
            $ind->setNbPersForm($ind->getNbPersForm(0));

        }
    }

    function setRassctPrevisionFormationSanteTravailNullToZero()
    {
        foreach ($this->getBscRassctPrevisionFormationSanteTravails() as $ind) {
            $ind->setNbPersForm($ind->getNbPersForm(0));

        }
    }

    function setRassctNbMaladieProsNullToZero()
    {

        foreach ($this->getBscRassctMaladieProCaracPros() as $ind) {

            $ind->setRMp1($ind->getRMp1(0));
            $ind->setRMp2($ind->getRMp2(0));

        }
    }

    function setRassctNbMaladiePros2NullToZero()
    {

        foreach ($this->getBscRassctNbMaladiePros() as $ind) {

            $ind->setRNbMpReconnues($ind->getRNbMpReconnues(0));
            $ind->setRNbJourArret($ind->getRNbJourArret(0));

        }
    }

    function setRassctNbAccidentTravail()
    {
        foreach ($this->getBscRassctNbAccidentTravails() as $ind) {

            $ind->setRNbAccidentsSurvenus($ind->getRNbAccidentsSurvenus(0));
            $ind->setRNbJourArretAccidents($ind->getRNbJourArretAccidents(0));

        }
    }

    function setRassctNatureLesion()
    {
        foreach ($this->getBscRassctNatureLesions() as $ind) {

            $ind->setRNbAccidentAvecArret($ind->getRNbAccidentAvecArret(0));
            $ind->setRNbAccidentSansArret($ind->getRNbAccidentSansArret(0));
            $ind->setRNbJourArret($ind->getRNbJourArret(0));

        }
    }

    function setRassctSiegeLesions()
    {
        foreach ($this->getBscRassctSiegeLesions() as $ind) {

            $ind->setRNbAccident($ind->getRNbAccident(0));
            $ind->setRNbJourArret($ind->getRNbJourArret(0));


        }
    }

    function setRassctElementMateriels()
    {
        foreach ($this->getBscRassctElementMateriels() as $ind) {

            $ind->setRNbAccident($ind->getRNbAccident(0));
            $ind->setRNbJourArret($ind->getRNbJourArret(0));


        }
    }

    function setGpeecNbAgentsTituEmpPermaParFoncEtAge()
    {
        foreach ($this->getBscGpeecNbAgentsTituEmpPermaParFoncEtAges() as $ind) {

            $ind->setRNb1($ind->getRNb1(0));
            $ind->setRNb2($ind->getRNb2(0));
            $ind->setRNb3($ind->getRNb3(0));
            $ind->setRNb4($ind->getRNb4(0));
            $ind->setRNb5($ind->getRNb5(0));
            $ind->setRNb6($ind->getRNb6(0));
            $ind->setRNb7($ind->getRNb7(0));
            $ind->setRNb8($ind->getRNb8(0));
            $ind->setRNb9($ind->getRNb9(0));
            $ind->setRNb10($ind->getRNb10(0));


        }
    }

    function setGpeecPlusNbAgentsParSpeEtAges()
    {
        foreach ($this->getBscGpeecPlusNbAgentsParSpeEtAges() as $ind) {

            $ind->setRNb1($ind->getRNb1(0));
            $ind->setRNb2($ind->getRNb2(0));
            $ind->setRNb3($ind->getRNb3(0));
            $ind->setRNb4($ind->getRNb4(0));
            $ind->setRNb5($ind->getRNb5(0));
            $ind->setRNb6($ind->getRNb6(0));
            $ind->setRNb7($ind->getRNb7(0));
            $ind->setRNb8($ind->getRNb8(0));
            $ind->setRNb9($ind->getRNb9(0));
            $ind->setRNb10($ind->getRNb10(0));


        }
    }

    function setHanditorialQuestionsBoethsNullToZero()
    {
        foreach ($this->getBscHanditorialQuestionsBoeths() as $ind) {
            $ind->setCategorieH($ind->getCategorieH(0));
            $ind->setCategorieF($ind->getCategorieF(0));
        }
        foreach ($this->getBscHanditorialNatureHandicaps() as $ind) {
            $ind->setNatureHandicapH($ind->getNatureHandicapH(0));
            $ind->setNatureHandicapF($ind->getNatureHandicapF(0));
        }

        foreach ($this->getBscHanditorialModeEntrees() as $ind) {
            $ind->setModeEntreeH($ind->getModeEntreeH(0));
            $ind->setModeEntreeF($ind->getModeEntreeF(0));
        }

        foreach ($this->getBscHanditorialStatutAgents() as $ind) {
            $ind->setStatutAgentH($ind->getStatutAgentH(0));
            $ind->setStatutAgentF($ind->getStatutAgentF(0));
        }

        foreach ($this->getBscHanditorialModeSortiesTitulaire() as $ind) {
            $ind->setModeSortieTitulaireH($ind->getModeSortieTitulaireH(0));
            $ind->setModeSortieTitulaireF($ind->getModeSortieTitulaireF(0));
        }
        foreach ($this->getBscHanditorialModeSortiesNonTitulaire() as $ind) {
            $ind->setModeSortieNonTitulaireH($ind->getModeSortieNonTitulaireH(0));
            $ind->setModeSortieNonTitulaireF($ind->getModeSortieNonTitulaireF(0));
        }

        foreach ($this->getBscHanditorialDerniersDiplomes() as $ind) {
            $ind->setDernierDiplomeH($ind->getDernierDiplomeH(0));
            $ind->setDernierDiplomeF($ind->getDernierDiplomeF(0));
        }
    }

    function setHanditorialInaptitudeEtReclassementNullToZero()
    {
        if ($this->getQHandiB22() == true || $this->getQHandiB22() == true) {
            foreach ($this->getBscHanditorialAvisInaptitudes() as $ind) {
                $ind->setAvisInaptitudeH($ind->getAvisInaptitudeH(0));
                $ind->setAvisInaptitudeF($ind->getAvisInaptitudeF(0));
            }
            foreach ($this->getBscHanditorialMesureInaptitudes() as $ind) {
                $ind->setMesureInaptitudeH($ind->getMesureInaptitudeH(0));
                $ind->setMesureInaptitudeF($ind->getMesureInaptitudeF(0));
            }
        }

        if ($this->getQHandiB23() == true || $this->getQHandiB23() == true) {
            foreach ($this->getBscHanditorialAvisInaptitudesAvant() as $ind) {
                $ind->setAvisInaptitudeAvantH($ind->getAvisInaptitudeAvantH(0));
                $ind->setAvisInaptitudeAvantF($ind->getAvisInaptitudeAvantF(0));
            }
            foreach ($this->getBscHanditorialMesureInaptitudesAvant() as $ind) {
                $ind->setMesureInaptitudeAvantH($ind->getMesureInaptitudeAvantH(0));
                $ind->setMesureInaptitudeAvantF($ind->getMesureInaptitudeAvantF(0));
            }
        }

        foreach ($this->getBscHanditorialAncienneteAgents() as $ind) {
            $ind->setMoinsUnAnH($ind->getMoinsUnAnH(0));
            $ind->setMoinsUnAnF($ind->getMoinsUnAnF(0));
            $ind->setEntreUnEtTroisH($ind->getEntreUnEtTroisH(0));
            $ind->setEntreUnEtTroisF($ind->getEntreUnEtTroisF(0));
            $ind->setEntreQuatreEtSixH($ind->getEntreQuatreEtSixH(0));
            $ind->setEntreQuatreEtSixF($ind->getEntreQuatreEtSixF(0));
            $ind->setEntreSeptEtDouzeH($ind->getEntreSeptEtDouzeH(0));
            $ind->setEntreSeptEtDouzeF($ind->getEntreSeptEtDouzeF(0));
            $ind->setPlusDouzeH($ind->getPlusDouzeH(0));
            $ind->setPlusDouzeF($ind->getPlusDouzeF(0));
        }
    }

    function setHanditorialCadreEmploisNullToZero()
    {
        foreach ($this->getBscHanditorialCadreEmplois() as $ind) {
            $ind->setCadreEmploiH($ind->getCadreEmploiH(0));
            $ind->setCadreEmploiF($ind->getCadreEmploiF(0));
        }
    }

    function setHanditorialInaptEtReclaCadreEmploisNullToZero()
    {
        foreach ($this->getBscHanditorialInaptEtReclaCadreEmplois() as $ind) {
            $ind->setCadreEmploiH($ind->getCadreEmploiH(0));
            $ind->setCadreEmploiF($ind->getCadreEmploiF(0));
        }
    }

    function setHanditorialMetiersNullToZero()
    {

        foreach ($this->getBscHanditorialMetiers() as $ind) {
            $ind->setMetierH($ind->getMetierH(0));
            $ind->setMetierF($ind->getMetierF(0));
        }
    }

    function setHanditorialInaptEtReclaMetiersNullToZero()
    {

        foreach ($this->getBscHanditorialInaptEtReclaMetiers() as $ind) {
            $ind->setMetierH($ind->getMetierH(0));
            $ind->setMetierF($ind->getMetierF(0));
        }
    }

    function setHanditorialTpstravailNullToZero()
    {

        foreach ($this->getBscHanditorialTempsComplets() as $ind) {
            $ind->setTempsCompletH($ind->getTempsCompletH(0));
            $ind->setTempsCompletF($ind->getTempsCompletF(0));
            $ind->setTempsNonCompletH($ind->getTempsNonCompletH(0));
            $ind->setTempsNonCompletF($ind->getTempsNonCompletF(0));
        }

        foreach ($this->getBscHanditorialTempsPleins() as $ind) {
            $ind->setTempsPleinH($ind->getTempsPleinH(0));
            $ind->setTempsPleinF($ind->getTempsPleinF(0));
            $ind->setTempsPartielH($ind->getTempsPartielH(0));
            $ind->setTempsPartielF($ind->getTempsPartielF(0));
        }
    }

    function setHanditorialInaptEtReclaTempsCompletsNullToZero()
    {

        foreach ($this->getBscHanditorialInaptEtReclaTempsComplets() as $ind) {
            $ind->setTempsCompletH($ind->getTempsCompletH(0));
            $ind->setTempsCompletF($ind->getTempsCompletF(0));
            $ind->setTempsNonCompletH($ind->getTempsNonCompletH(0));
            $ind->setTempsNonCompletF($ind->getTempsNonCompletF(0));
        }

        foreach ($this->getBscHanditorialTempsPleins() as $ind) {
            $ind->setTempsPleinH($ind->getTempsPleinH(0));
            $ind->setTempsPleinF($ind->getTempsPleinF(0));
            $ind->setTempsPartielH($ind->getTempsPartielH(0));
            $ind->setTempsPartielF($ind->getTempsPartielF(0));
        }
    }

    function setEffectifDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);

        foreach ($this->ind1101s as $ind1101) {
            $ind1101->setDtModi($date);
            $ind1101->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1102s as $ind1102) {
            $ind1102->setDtModi($date);
            $ind1102->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1101s as $ind1103) {
            $ind1103->setDtModi($date);
            $ind1103->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind111s as $ind111) {
            $ind111->setDtModi($date);
            $ind111->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind112s as $ind112) {
            $ind112->setDtModi($date);
            $ind112->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind113s as $ind113) {
            $ind113->setDtModi($date);
            $ind113->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind114s as $ind114) {
            $ind114->setDtModi($date);
            $ind114->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind121s as $ind121) {
            $ind121->setDtModi($date);
            $ind121->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind122s as $ind122) {
            $ind122->setDtModi($date);
            $ind122->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind123s as $ind123) {
            $ind123->setDtModi($date);
            $ind123->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind124s as $ind124) {
            $ind124->setDtModi($date);
            $ind124->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1311s as $ind1311) {
            $ind1311->setDtModi($date);
            $ind1311->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1312s as $ind1312) {
            $ind1312->setDtModi($date);
            $ind1312->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind132s as $ind132) {
            $ind132->setDtModi($date);
            $ind132->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind132Biss as $ind132Bis) {
            $ind132Bis->setDtModi($date);
            $ind132Bis->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind141s as $ind141) {
            $ind141->setDtModi($date);
            $ind141->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind142s as $ind142) {
            $ind142->setDtModi($date);
            $ind142->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind143s as $ind143) {
            $ind143->setDtModi($date);
            $ind143->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind144s as $ind144) {
            $ind144->setDtModi($date);
            $ind144->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1501s as $ind1501) {
            $ind1501->setDtModi($date);
            $ind1501->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1502s as $ind1502) {
            $ind1502->setDtModi($date);
            $ind1502->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1511s as $ind1511) {
            $ind1511->setDtModi($date);
            $ind1511->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1512s as $ind1512) {
            $ind1512->setDtModi($date);
            $ind1512->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1513s as $ind1513) {
            $ind1513->setDtModi($date);
            $ind1513->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind152s as $ind152) {
            $ind152->setDtModi($date);
            $ind152->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1531s as $ind1531) {
            $ind1531->setDtModi($date);
            $ind1531->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind1532s as $ind1532) {
            $ind1532->setDtModi($date);
            $ind1532->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind154s as $ind154) {
            $ind154->setDtModi($date);
            $ind154->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind155s as $ind155) {
            $ind155->setDtModi($date);
            $ind155->setCdUtilmodi($cdUtil);
        }
//        foreach ($this->ind156s as $ind156) {
//            $ind156->setDtModi($date);
//            $ind156->setCdUtilmodi($cdUtil);
//        }

        foreach ($this->ind157s as $ind157) {
            $ind157->setDtModi($date);
            $ind157->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind158s as $ind158) {
            $ind158->setDtModi($date);
            $ind158->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind171s as $ind171) {
            $ind171->setDtModi($date);
            $ind171->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind161s as $ind161) {
            $ind161->setDtModi($date);
            $ind161->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind1612s as $ind1612) {
            $ind1612->setDtModi($date);
            $ind1612->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind222s as $ind222) {
            $ind222->setDtModi($date);
            $ind222->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2231s as $ind2231) {
            $ind2231->setDtModi($date);
            $ind2231->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2232s as $ind2232) {
            $ind2232->setDtModi($date);
            $ind2232->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2233s as $ind2233) {
            $ind2233->setDtModi($date);
            $ind2233->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind224s as $ind224) {
            $ind224->setDtModi($date);
            $ind224->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2261s as $ind2261) {
            $ind2261->setDtModi($date);
            $ind2261->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2262s as $ind2262) {
            $ind2262->setDtModi($date);
            $ind2262->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2263s as $ind2263) {
            $ind2263->setDtModi($date);
            $ind2263->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind231s as $ind231) {
            $ind231->setDtModi($date);
            $ind231->setCdUtilmodi($cdUtil);
        }
    }


    function setTpsTravDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);

        foreach ($this->ind2111s as $ind2111) {
            $ind2111->setDtModi($date);
            $ind2111->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2112s as $ind2112) {
            $ind2112->setDtModi($date);
            $ind2112->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2113s as $ind2113) {
            $ind2113->setDtModi($date);
            $ind2113->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind2121s as $ind2121) {
            $ind2121->setDtModi($date);
            $ind2121->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2122s as $ind2122) {
            $ind2122->setDtModi($date);
            $ind2122->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2123s as $ind2123) {
            $ind2123->setDtModi($date);
            $ind2123->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind2131s as $ind2131) {
            $ind2131->setDtModi($date);
            $ind2131->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2132s as $ind2132) {
            $ind2132->setDtModi($date);
            $ind2132->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind2133s as $ind2133) {
            $ind2133->setDtModi($date);
            $ind2133->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind214s as $ind214) {
            $ind214->setDtModi($date);
            $ind214->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind215s as $ind215) {
            $ind215->setDtModi($date);
            $ind215->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind216s as $ind216) {
            $ind216->setDtModi($date);
            $ind216->setCdUtilmodi($cdUtil);
        }

        foreach ($this->ind221s as $ind221) {
            $ind221->setDtModi($date);
            $ind221->setCdUtilmodi($cdUtil);
        }
    }

    function setIndDateAndUserModif($ind, $date, $cdUtil)
    {
        $ind->setDtModi($date);
        $ind->setCdUtilmodi($cdUtil);
    }

    function setRemunerationDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);

        foreach ($this->ind311s as $ind311) {
            $this->setIndDateAndUserModif($ind311, $date, $cdUtil);
        }

        foreach ($this->ind321s as $ind321) {
            $this->setIndDateAndUserModif($ind321, $date, $cdUtil);
        }

        foreach ($this->ind331s as $ind331) {
            $this->setIndDateAndUserModif($ind331, $date, $cdUtil);
        }

        foreach ($this->ind344s as $ind344) {
            $ind344->setDtModi($date);
            $ind344->setCdUtilmodi($cdUtil);
        }

    }

    function setConditionsDateAndUserModif($date, $cdUtil)
    {
        foreach ($this->ind411s as $ind411) {
            $ind411->setDtModi($date);
            $ind411->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind412s as $ind412) {
            $ind412->setDtModi($date);
            $ind412->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind421s as $ind421) {
            $ind421->setDtModi($date);
            $ind421->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind422s as $ind422) {
            $ind422->setDtModi($date);
            $ind422->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind423s as $ind423) {
            $ind423->setDtModi($date);
            $ind423->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind423sFili as $ind423Fili) {
            $ind423Fili->setDtModi($date);
            $ind423Fili->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind424s as $ind424) {
            $ind424->setDtModi($date);
            $ind424->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind431s as $ind431) {
            $ind431->setDtModi($date);
            $ind431->setCdUtilmodi($cdUtil);
        }
    }

    function setFormationDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);

        foreach ($this->ind5111s as $ind5111) {
            $ind5111->setDtModi($date);
            $ind5111->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind5112s as $ind5112) {
            $ind5112->setDtModi($date);
            $ind5112->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind5113s as $ind5113) {
            $ind5113->setDtModi($date);
            $ind5113->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind5121s as $ind5121) {
            $ind5121->setDtModi($date);
            $ind5121->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind5122s as $ind5122) {
            $ind5122->setDtModi($date);
            $ind5122->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind513s as $ind513) {
            $ind513->setDtModi($date);
            $ind513->setCdUtilmodi($cdUtil);
        }
    }

    function setDroitDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);

        foreach ($this->ind613s as $ind613) {
            $ind613->setDtModi($date);
            $ind613->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind6141s as $ind6141) {
            $ind6141->setDtModi($date);
            $ind6141->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind6143s as $ind6143) {
            $ind6143->setDtModi($date);
            $ind6143->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind6144s as $ind6144) {
            $ind6144->setDtModi($date);
            $ind6144->setCdUtilmodi($cdUtil);
        }
        foreach ($this->ind6142s as $ind6142) {
            $ind6142->setDtModi($date);
            $ind6142->setCdUtilmodi($cdUtil);
        }

    }

    function setRassctDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);

        foreach ($this->bscRassctRealisationFormationSanteTravails as $bscRassctRealisationFormationSanteTravail) {
            $bscRassctRealisationFormationSanteTravail->setDtModi($date);
            $bscRassctRealisationFormationSanteTravail->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctPrevisionFormationSanteTravails as $bscRassctPrevisionFormationSanteTravail) {
            $bscRassctPrevisionFormationSanteTravail->setDtModi($date);
            $bscRassctPrevisionFormationSanteTravail->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctAutresMesures as $bscRassctAutreMesure) {
            $bscRassctAutreMesure->setDtModi($date);
            $bscRassctAutreMesure->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctPredictionsAutresMesures as $bscRassctPredictionsAutreMesure) {
            $bscRassctPredictionsAutreMesure->setDtModi($date);
            $bscRassctPredictionsAutreMesure->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctNbMaladiePros as $bscRassctNbMaladiePro) {
            $bscRassctNbMaladiePro->setDtModi($date);
            $bscRassctNbMaladiePro->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctNbAccidentTravails as $bscRassctNbAccidentTravail) {
            $bscRassctNbAccidentTravail->setDtModi($date);
            $bscRassctNbAccidentTravail->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctNatureLesions as $bscRassctNatureLesion) {
            $bscRassctNatureLesion->setDtModi($date);
            $bscRassctNatureLesion->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctSiegeLesions as $bscRassctSiegeLesion) {
            $bscRassctSiegeLesion->setDtModi($date);
            $bscRassctSiegeLesion->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctElementMateriels as $bscRassctElementMateriel) {
            $bscRassctElementMateriel->setDtModi($date);
            $bscRassctElementMateriel->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscRassctMaladieProCaracPros as $bscRassctMaladieProCaracPro) {
            $bscRassctMaladieProCaracPro->setDtModi($date);
            $bscRassctMaladieProCaracPro->setCdUtilmodi($cdUtil);
        }
    }

    function setGpeecDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);

        foreach ($this->bscGpeecNbAgentsTituEmpPermaParFoncEtAges as $bscGpeecNbAgentsTituEmpPermaParFoncEtAge) {
            $bscGpeecNbAgentsTituEmpPermaParFoncEtAge->setDtModi($date);
            $bscGpeecNbAgentsTituEmpPermaParFoncEtAge->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscGpeecPlusNbAgentsParSpeEtAges as $bscGpeecPlusNbAgentsParSpeEtAge) {
            $bscGpeecPlusNbAgentsParSpeEtAge->setDtModi($date);
            $bscGpeecPlusNbAgentsParSpeEtAge->setCdUtilmodi($cdUtil);
        }
    }

    function setHanditorialDateAndUserModif($date, $cdUtil)
    {
        $this->setDtModi($date);
        $this->setCdUtilmodi($cdUtil);
        //$this->bscHanditorialQuestionsGenerales->setDtModi($date);
        //$this->bscHanditorialQuestionsGenerales->setCdUtilmodi($cdUtil);

        foreach ($this->bscHanditorialQuestionsBoeths as $bscHanditorialQuestionsBoeth) {
            $bscHanditorialQuestionsBoeth->setDtModi($date);
            $bscHanditorialQuestionsBoeth->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscHanditorialNatureHandicaps as $bscHanditorialNatureHandicap) {
            $bscHanditorialNatureHandicap->setDtModi($date);
            $bscHanditorialNatureHandicap->setCdUtilmodi($cdUtil);
        }
        foreach ($this->bscHanditorialAvisInaptitudes as $bscHanditorialAvisInaptitude) {
            $bscHanditorialAvisInaptitude->setDtModi($date);
            $bscHanditorialAvisInaptitude->setCdUtilmodi($cdUtil);
        }
    }

    function getBilanSocialAgent()
    {
        return $this->BilanSocialAgent;
    }

    function setBilanSocialAgent($BilanSocialAgent)
    {
        $this->BilanSocialAgent = $BilanSocialAgent;
    }

    function getBlIncoInd110()
    {
        return $this->blIncoInd110;
    }

    function getBlIncoInd111()
    {
        return $this->blIncoInd111;
    }

    function getBlIncoInd112()
    {
        return $this->blIncoInd112;
    }

    function getBlIncoInd113()
    {
        return $this->blIncoInd113;
    }

    function getBlIncoInd114()
    {
        return $this->blIncoInd114;
    }

    function setBlIncoInd110($blIncoInd110)
    {
        $this->blIncoInd110 = $blIncoInd110;
    }

    function setBlIncoInd111($blIncoInd111)
    {
        $this->blIncoInd111 = $blIncoInd111;
    }

    function setBlIncoInd112($blIncoInd112)
    {
        $this->blIncoInd112 = $blIncoInd112;
    }

    function setBlIncoInd113($blIncoInd113)
    {
        $this->blIncoInd113 = $blIncoInd113;
    }

    function setBlIncoInd114($blIncoInd114)
    {
        $this->blIncoInd114 = $blIncoInd114;
    }

    function getMoyenneInd110()
    {
        return $this->moyenneInd110;
    }

    function getMoyenneInd111()
    {
        return $this->moyenneInd111;
    }

    function getMoyenneInd112()
    {
        return $this->moyenneInd112;
    }

    function getMoyenneInd113()
    {
        return $this->moyenneInd113;
    }

    function getMoyenneInd114()
    {
        return $this->moyenneInd114;
    }

    function setMoyenneInd110($moyenneInd110)
    {
        $this->moyenneInd110 = $moyenneInd110;
    }

    function setMoyenneInd111($moyenneInd111)
    {
        $this->moyenneInd111 = $moyenneInd111;
    }

    function setMoyenneInd112($moyenneInd112)
    {
        $this->moyenneInd112 = $moyenneInd112;
    }

    function setMoyenneInd113($moyenneInd113)
    {
        $this->moyenneInd113 = $moyenneInd113;
    }

    function setMoyenneInd114($moyenneInd114)
    {
        $this->moyenneInd114 = $moyenneInd114;
    }

    function getBlIncoEff()
    {
        return $this->blIncoEff;
    }

    function setBlIncoEff($blIncoEff)
    {
        $this->blIncoEff = $blIncoEff;
    }

    function getBlIncoInd121()
    {
        return $this->blIncoInd121;
    }

    function getMoyenneInd121()
    {
        return $this->moyenneInd121;
    }

    function setBlIncoInd121($blIncoInd121)
    {
        $this->blIncoInd121 = $blIncoInd121;
    }

    function setMoyenneInd121($moyenneInd121)
    {
        $this->moyenneInd121 = $moyenneInd121;
    }

    function getBlIncoInd122()
    {
        return $this->blIncoInd122;
    }

    function getMoyenneInd122()
    {
        return $this->moyenneInd122;
    }

    function setBlIncoInd122($blIncoInd122)
    {
        $this->blIncoInd122 = $blIncoInd122;
    }

    function setMoyenneInd122($moyenneInd122)
    {
        $this->moyenneInd122 = $moyenneInd122;
    }

    function getBlIncoInd123()
    {
        return $this->blIncoInd123;
    }

    function getMoyenneInd123()
    {
        return $this->moyenneInd123;
    }

    function setBlIncoInd123($blIncoInd123)
    {
        $this->blIncoInd123 = $blIncoInd123;
    }

    function setMoyenneInd123($moyenneInd123)
    {
        $this->moyenneInd123 = $moyenneInd123;
    }

    function getBlIncoInd124()
    {
        return $this->blIncoInd124;
    }

    function getMoyenneInd124()
    {
        return $this->moyenneInd124;
    }

    function setBlIncoInd124($blIncoInd124)
    {
        $this->blIncoInd124 = $blIncoInd124;
    }

    function setMoyenneInd124($moyenneInd124)
    {
        $this->moyenneInd124 = $moyenneInd124;
    }

    function getBlIncoInd131()
    {
        return $this->blIncoInd131;
    }

    function getMoyenneInd131()
    {
        return $this->moyenneInd131;
    }

    function setBlIncoInd131($blIncoInd131)
    {
        $this->blIncoInd131 = $blIncoInd131;
    }

    function setMoyenneInd131($moyenneInd131)
    {
        $this->moyenneInd131 = $moyenneInd131;
    }

    function getBlIncoInd132()
    {
        return $this->blIncoInd132;
    }

    function getMoyenneInd132()
    {
        return $this->moyenneInd132;
    }

    function getBlIncoInd140()
    {
        return $this->blIncoInd140;
    }

    function getMoyenneInd140()
    {
        return $this->moyenneInd140;
    }

    function setBlIncoInd132($blIncoInd132)
    {
        $this->blIncoInd132 = $blIncoInd132;
    }

    function setMoyenneInd132($moyenneInd132)
    {
        $this->moyenneInd132 = $moyenneInd132;
    }

    function setBlIncoInd140($blIncoInd140)
    {
        $this->blIncoInd140 = $blIncoInd140;
    }

    function setMoyenneInd140($moyenneInd140)
    {
        $this->moyenneInd140 = $moyenneInd140;
    }

    function getBlIncoMouv()
    {
        return $this->blIncoMouv;
    }

    function setBlIncoMouv($blIncoMouv)
    {
        $this->blIncoMouv = $blIncoMouv;
    }

    function getBlIncoInd161()
    {
        return $this->blIncoInd161;
    }

    function setBlIncoInd161($blIncoInd161)
    {
        $this->blIncoInd161 = $blIncoInd161;
    }

    function getMoyenneInd161()
    {
        return $this->moyenneInd161;
    }

    function setMoyenneInd161($moyenneInd161)
    {
        $this->moyenneInd161 = $moyenneInd161;
    }

    function getMoyenneInd150()
    {
        return $this->moyenneInd150;
    }

    function setMoyenneInd150($moyenneInd150)
    {
        $this->moyenneInd150 = $moyenneInd150;
    }

    function getBlIncoInd150()
    {
        return $this->blIncoInd150;
    }

    function setBlIncoInd150($blIncoInd150)
    {
        $this->blIncoInd150 = $blIncoInd150;
    }

    function getMoyenneInd151()
    {
        return $this->moyenneInd151;
    }

    function setMoyenneInd151($moyenneInd151)
    {
        $this->moyenneInd151 = $moyenneInd151;
    }

    function getBlIncoInd151()
    {
        return $this->blIncoInd151;
    }

    function setBlIncoInd151($blIncoInd151)
    {
        $this->blIncoInd151 = $blIncoInd151;
    }

    function getMoyenneInd152()
    {
        return $this->moyenneInd152;
    }

    function setMoyenneInd152($moyenneInd152)
    {
        $this->moyenneInd152 = $moyenneInd152;
    }

    function getBlIncoInd152()
    {
        return $this->blIncoInd152;
    }

    function setBlIncoInd152($blIncoInd152)
    {
        $this->blIncoInd152 = $blIncoInd152;
    }

    function getMoyenneInd1531()
    {
        return $this->moyenneInd1531;
    }

    function setMoyenneInd1531($moyenneInd1531)
    {
        $this->moyenneInd1531 = $moyenneInd1531;
    }

    function getBlIncoInd1531()
    {
        return $this->blIncoInd1531;
    }

    function setBlIncoInd1531($blIncoInd1531)
    {
        $this->blIncoInd1531 = $blIncoInd1531;
    }

    function getMoyenneInd1532()
    {
        return $this->moyenneInd1532;
    }

    function setMoyenneInd1532($moyenneInd1532)
    {
        $this->moyenneInd1532 = $moyenneInd1532;
    }

    function getBlIncoInd1532()
    {
        return $this->blIncoInd1532;
    }

    function setBlIncoInd1532($blIncoInd1532)
    {
        $this->blIncoInd1532 = $blIncoInd1532;
    }

    function getMoyenneInd154()
    {
        return $this->moyenneInd154;
    }

    function setMoyenneInd154($moyenneInd154)
    {
        $this->moyenneInd154 = $moyenneInd154;
    }

    function getBlIncoInd154()
    {
        return $this->blIncoInd154;
    }

    function setBlIncoInd154($blIncoInd154)
    {
        $this->blIncoInd154 = $blIncoInd154;
    }

    function getMoyenneInd155()
    {
        return $this->moyenneInd155;
    }

    function setMoyenneInd155($moyenneInd155)
    {
        $this->moyenneInd155 = $moyenneInd155;
    }

    function getBlIncoInd155()
    {
        return $this->blIncoInd155;
    }

    function setBlIncoInd155($blIncoInd155)
    {
        $this->blIncoInd155 = $blIncoInd155;
    }

//    function getMoyenneInd156() {
//        return $this->moyenneInd156;
//    }

//    function setMoyenneInd156($moyenneInd156) {
//        $this->moyenneInd156 = $moyenneInd156;
//    }
//
//    function getBlIncoInd156() {
//        return $this->blIncoInd156;
//    }
//
//    function setBlIncoInd156($blIncoInd156) {
//        $this->blIncoInd156 = $blIncoInd156;
//    }

    function getMoyenneInd157() {
        return $this->moyenneInd157;
    }

    function setMoyenneInd157($moyenneInd157) {
        $this->moyenneInd157 = $moyenneInd157;
    }

    function getBlIncoInd157() {
        return $this->blIncoInd157;
    }

    function setBlIncoInd157($blIncoInd157) {
        $this->blIncoInd157 = $blIncoInd157;
    }

    function getMoyenneInd158()
    {
        return $this->moyenneInd158;
    }

    function setMoyenneInd158($moyenneInd158)
    {
        $this->moyenneInd158 = $moyenneInd158;
    }

    function getBlIncoInd158()
    {
        return $this->blIncoInd158;
    }

    function setBlIncoInd158($blIncoInd158)
    {
        $this->blIncoInd158 = $blIncoInd158;
    }

    function getMoyenneInd162()
    {
        return $this->moyenneInd162;
    }

    function setMoyenneInd162($moyenneInd162)
    {
        $this->moyenneInd162 = $moyenneInd162;
    }

    function getBlIncoInd162()
    {
        return $this->blIncoInd162;
    }

    function setBlIncoInd162($blIncoInd162)
    {
        $this->blIncoInd162 = $blIncoInd162;
    }

    function getMoyenneInd171()
    {
        return $this->moyenneInd171;
    }

    function setMoyenneInd171($moyenneInd171)
    {
        $this->moyenneInd171 = $moyenneInd171;
    }

    function getBlIncoInd171()
    {
        return $this->blIncoInd171;
    }

    function setBlIncoInd171($blIncoInd171)
    {
        $this->blIncoInd171 = $blIncoInd171;
    }

    function getInd311s()
    {
        return $this->ind311s;
    }

    function getInd321s()
    {
        return $this->ind321s;
    }


    function getInd311sTemp()
    {
        return $this->ind311sTemp;
    }

    function getInd321sTemp()
    {
        return $this->ind321sTemp;
    }

    function setInd311sTemp($ind311sTemp)
    {
        $this->ind311sTemp = $ind311sTemp;
    }

    function setInd321sTemp($ind321sTemp)
    {
        $this->ind321sTemp = $ind321sTemp;
    }

    function getInd311AotmsTemp()
    {
        return $this->ind311AotmsTemp;
    }

    function getInd321AotmsTemp()
    {
        return $this->ind321AotmsTemp;
    }

    function setInd311AotmsTemp($ind311AotmsTemp)
    {
        $this->ind311AotmsTemp = $ind311AotmsTemp;
    }

    function setInd321AotmsTemp($ind321AotmsTemp)
    {
        $this->ind321AotmsTemp = $ind321AotmsTemp;
    }

    function getBlIncoRemuneration()
    {
        return $this->blIncoRemuneration;
    }

    function getBlIncoInd311()
    {
        return $this->blIncoInd311;
    }

    function getBlIncoInd321()
    {
        return $this->blIncoInd321;
    }

    function getMoyenneInd311()
    {
        return $this->moyenneInd311;
    }

    function getMoyenneInd321()
    {
        return $this->moyenneInd321;
    }

    function setInd311s($ind311s)
    {
        $this->ind311s = $ind311s;
    }

    function setInd321s($ind321s)
    {
        $this->ind321s = $ind321s;
    }

    function setBlIncoRemuneration($blIncoRemuneration)
    {
        $this->blIncoRemuneration = $blIncoRemuneration;
    }

    function setBlIncoInd311($blIncoInd311)
    {
        $this->blIncoInd311 = $blIncoInd311;
    }

    function setBlIncoInd321($blIncoInd321)
    {
        $this->blIncoInd321 = $blIncoInd321;
    }

    function setMoyenneInd311($moyenneInd311)
    {
        $this->moyenneInd311 = $moyenneInd311;
    }

    function setMoyenneInd321($moyenneInd321)
    {
        $this->moyenneInd321 = $moyenneInd321;
    }

    function getBlIncoConditions()
    {
        return $this->blIncoConditions;
    }

    function setBlIncoConditions($blIncoConditions)
    {
        $this->blIncoConditions = $blIncoConditions;
    }

    function getMoyenneInd411()
    {
        return $this->moyenneInd411;
    }

    function setMoyenneInd411($moyenneInd411)
    {
        $this->moyenneInd411 = $moyenneInd411;
    }

    function getMoyenneInd413()
    {
        return $this->moyenneInd413;
    }

    function setMoyenneInd413($moyenneInd413)
    {
        $this->moyenneInd413 = $moyenneInd413;
    }

    function getMoyenneInd414()
    {
        return $this->moyenneInd414;
    }

    function setMoyenneInd414($moyenneInd414)
    {
        $this->moyenneInd414 = $moyenneInd414;
    }

    function getMoyenneInd423()
    {
        return $this->moyenneInd423;
    }

    function setMoyenneInd423($moyenneInd423)
    {
        $this->moyenneInd423 = $moyenneInd423;
    }

    function getMoyenneInd424()
    {
        return $this->moyenneInd424;
    }

    function setMoyenneInd424($moyenneInd424)
    {
        $this->moyenneInd424 = $moyenneInd424;
    }

    function getMoyenneInd425()
    {
        return $this->moyenneInd425;
    }

    function setMoyenneInd425($moyenneInd425)
    {
        $this->moyenneInd425 = $moyenneInd425;
    }

    function getMoyenneInd431()
    {
        return $this->moyenneInd431;
    }

    function setMoyenneInd431($moyenneInd431)
    {
        $this->moyenneInd431 = $moyenneInd431;
    }

    function getBlIncoInd411()
    {
        return $this->blIncoInd411;
    }

    function setBlIncoInd411($blIncoInd411)
    {
        $this->blIncoInd411 = $blIncoInd411;
    }

    function getBlIncoInd413()
    {
        return $this->blIncoInd413;
    }

    function setBlIncoInd413($blIncoInd413)
    {
        $this->blIncoInd413 = $blIncoInd413;
    }

    function getBlIncoInd414()
    {
        return $this->blIncoInd414;
    }

    function setBlIncoInd414($blIncoInd414)
    {
        $this->blIncoInd414 = $blIncoInd414;
    }

    function getBlIncoInd423()
    {
        return $this->blIncoInd423;
    }

    function setBlIncoInd423($blIncoInd423)
    {
        $this->blIncoInd423 = $blIncoInd423;
    }

    function getBlIncoInd424()
    {
        return $this->blIncoInd424;
    }

    function setBlIncoInd424($blIncoInd424)
    {
        $this->blIncoInd424 = $blIncoInd424;
    }

    function getBlIncoInd425()
    {
        return $this->blIncoInd425;
    }

    function setBlIncoInd425($blIncoInd425)
    {
        $this->blIncoInd425 = $blIncoInd425;
    }

    function getBlIncoInd431()
    {
        return $this->blIncoInd431;
    }

    function setBlIncoInd431($blIncoInd431)
    {
        $this->blIncoInd431 = $blIncoInd431;
    }

    function getInd331s()
    {
        return $this->ind331s;
    }

    function getBlIncoInd331()
    {
        return $this->blIncoInd331;
    }

    function getMoyenneInd331()
    {
        return $this->moyenneInd331;
    }

    function getBlIncoInd341()
    {
        return $this->blIncoInd341;
    }

    function getMoyenneInd341()
    {
        return $this->moyenneInd341;
    }

    function getBlIncoInd342()
    {
        return $this->blIncoInd342;
    }

    function getMoyenneInd342()
    {
        return $this->moyenneInd342;
    }

    function setInd331s($ind331s)
    {
        $this->ind331s = $ind331s;
    }

    function setBlIncoInd331($blIncoInd331)
    {
        $this->blIncoInd331 = $blIncoInd331;
    }

    function setMoyenneInd331($moyenneInd331)
    {
        $this->moyenneInd331 = $moyenneInd331;
    }

    function setBlIncoInd341($blIncoInd341)
    {
        $this->blIncoInd341 = $blIncoInd341;
    }

    function setMoyenneInd341($moyenneInd341)
    {
        $this->moyenneInd341 = $moyenneInd341;
    }

    function setBlIncoInd342($blIncoInd342)
    {
        $this->blIncoInd342 = $blIncoInd342;
    }

    function setMoyenneInd342($moyenneInd342)
    {
        $this->moyenneInd342 = $moyenneInd342;
    }

    function getR3411()
    {
        return $this->r3411;
    }

    function getR3412()
    {
        return $this->r3412;
    }

    function getQ3423()
    {
        return $this->q3423;
    }

    function getR342()
    {
        return $this->r342;
    }

    function setR3411($r3411)
    {
        $this->r3411 = $r3411;
    }

    function setR3412($r3412)
    {
        $this->r3412 = $r3412;
    }

    function setQ3423($q3423)
    {
        $this->q3423 = $q3423;
    }

    function setR342($r342)
    {
        $this->r342 = $r342;
    }

    function getInd344s()
    {
        return $this->ind344s;
    }

    function getInd344sTemp()
    {
        return $this->ind344sTemp;
    }

    function getInd344AotmsTemp()
    {
        return $this->ind344AotmsTemp;
    }

    function setInd344AotmsTemp($ind344AotmsTemp)
    {
        $this->ind344AotmsTemp = $ind344AotmsTemp;
    }


    function getBlIncoInd343()
    {
        return $this->blIncoInd343;
    }

    function getMoyenneInd343()
    {
        return $this->moyenneInd343;
    }

    function getBlIncoInd344()
    {
        return $this->blIncoInd344;
    }

    function getMoyenneInd344()
    {
        return $this->moyenneInd344;
    }

    function getBlIncoInd345()
    {
        return $this->blIncoInd345;
    }

    function getMoyenneInd345()
    {
        return $this->moyenneInd345;
    }

    function setInd344s($ind344s)
    {
        $this->ind344s = $ind344s;
    }

    function setInd344sTemp($ind344sTemp)
    {
        $this->ind344sTemp = $ind344sTemp;
    }

    function setBlIncoInd343($blIncoInd343)
    {
        $this->blIncoInd343 = $blIncoInd343;
    }

    function setMoyenneInd343($moyenneInd343)
    {
        $this->moyenneInd343 = $moyenneInd343;
    }

    function setBlIncoInd344($blIncoInd344)
    {
        $this->blIncoInd344 = $blIncoInd344;
    }

    function setMoyenneInd344($moyenneInd344)
    {
        $this->moyenneInd344 = $moyenneInd344;
    }

    function setBlIncoInd345($blIncoInd345)
    {
        $this->blIncoInd345 = $blIncoInd345;
    }

    function setMoyenneInd345($moyenneInd345)
    {
        $this->moyenneInd345 = $moyenneInd345;
    }

    function getR5141()
    {
        return $this->r5141;
    }

    function getR5142()
    {
        return $this->r5142;
    }

    function getR5143()
    {
        return $this->r5143;
    }

    function getR5144()
    {
        return $this->r5144;
    }

    function getR6111()
    {
        return $this->r6111;
    }

    function getR6112()
    {
        return $this->r6112;
    }

    function getR6113()
    {
        return $this->r6113;
    }
    function getR7133()
    {
        return $this->r7133;
    }

    function getQ6114()
    {
        return $this->q6114;
    }

    function getQ613()
    {
        return $this->q613;
    }

    function getQ7111()
    {
        return $this->q7111;
    }

    function getQ7112()
    {
        return $this->q7112;
    }

   /* function getQ7121()
    {
        return $this->q7121;
    }*/
    function getQ7122()
    {
        return $this->q7122;
    }

    function getQ7131()
    {
        return $this->q7131;
    }

    function getQ7132()
    {
        return $this->q7132;
    }

    function getQ7133()
    {
        return $this->q7133;
    }

    function getQS7141()
    {
        return $this->qS7141;
    }

    function getQS7142()
    {
        return $this->qS7142;
    }

    function getQP7143()
    {
        return $this->qP7143;
    }

    function getQP7144()
    {
        return $this->qP7144;
    }

    function setR5141($r5141)
    {
        $this->r5141 = $r5141;
    }

    function setR5142($r5142)
    {
        $this->r5142 = $r5142;
    }

    function setR5143($r5143)
    {
        $this->r5143 = $r5143;
    }

    function setR5144($r5144)
    {
        $this->r5144 = $r5144;
    }

    function setR6111($r6111)
    {
        $this->r6111 = $r6111;
    }

    function setR6112($r6112)
    {
        $this->r6112 = $r6112;
    }

    function setR6113($r6113)
    {
        $this->r6113 = $r6113;
    }

    function setR7133($r7133)
    {
        $this->r7133 = $r7133;
    }

    function setQ6114($q6114)
    {
        $this->q6114 = $q6114;
    }

    function setQ613($q613)
    {
        $this->q613 = $q613;
    }

    function setQ7111($q7111)
    {
        $this->q7111 = $q7111;
    }

    function setQ7112($q7112)
    {
        $this->q7112 = $q7112;
    }

   /* function setQ7121($q7121)
    {
        $this->q7121 = $q7121;
    }*/

    function setQ7122($q7122)
    {
        $this->q7122 = $q7122;
    }

    function setQ7131($q7131)
    {
        $this->q7131 = $q7131;
    }

    function setQ7132($q7132)
    {
        $this->q7132 = $q7132;
    }

    function setQ7133($q7133)
    {
        $this->q7133 = $q7133;
    }

    function setQS7141($qS7141)
    {
        $this->qS7141 = $qS7141;
    }

    function setQS7142($qS7142)
    {
        $this->qS7142 = $qS7142;
    }

    function setQP7143($qP7143)
    {
        $this->qP7143 = $qP7143;
    }

    function setQP7144($qP7144)
    {
        $this->qP7144 = $qP7144;
    }

    function getBlIncoFormation()
    {
        return $this->blIncoFormation;
    }

    function getBlIncoInd514()
    {
        return $this->blIncoInd514;
    }

    function getMoyenneInd514()
    {
        return $this->moyenneInd514;
    }

    function setBlIncoFormation($blIncoFormation)
    {
        $this->blIncoFormation = $blIncoFormation;
    }

    function setBlIncoInd514($blIncoInd514)
    {
        $this->blIncoInd514 = $blIncoInd514;
    }

    function setMoyenneInd514($moyenneInd514)
    {
        $this->moyenneInd514 = $moyenneInd514;
    }

    function getBlIncoInd611()
    {
        return $this->blIncoInd611;
    }

    function getMoyenneInd611()
    {
        return $this->moyenneInd611;
    }

    function setBlIncoInd611($blIncoInd611)
    {
        $this->blIncoInd611 = $blIncoInd611;
    }

    function setMoyenneInd611($moyenneInd611)
    {
        $this->moyenneInd611 = $moyenneInd611;
    }

    function getBlIncoDroit()
    {
        return $this->blIncoDroit;
    }

    function setBlIncoDroit($blIncoDroit)
    {
        $this->blIncoDroit = $blIncoDroit;
    }

    function getQ6113()
    {
        return $this->q6113;
    }

    function getR6114()
    {
        return $this->r6114;
    }

    function getR6115()
    {
        return $this->r6115;
    }

    function getR6116()
    {
        return $this->r6116;
    }

    function getR6117()
    {
        return $this->r6117;
    }

    function setQ6113($q6113)
    {
        $this->q6113 = $q6113;
    }

    function setR6114($r6114)
    {
        $this->r6114 = $r6114;
    }

     function setR6115($r6115)
     {
         $this->r6115 = $r6115;
     }

      function setR6116($r6116)
      {
          $this->r6116 = $r6116;
      }

    function setR6117($r6117)
    {
        $this->r6117 = $r6117;
    }

    function getBlIncoInd612()
    {
        return $this->blIncoInd612;
    }

    function getMoyenneInd612()
    {
        return $this->moyenneInd612;
    }

    function getR6121()
    {
        return $this->r6121;
    }

    function getR6122()
    {
        return $this->r6122;
    }

    function getR6123()
    {
        return $this->r6123;
    }

    function getR6124()
    {
        return $this->r6124;
    }

    function getR6125()
    {
        return $this->r6125;
    }

    function getR6126()
    {
        return $this->r6126;
    }

    function setBlIncoInd612($blIncoInd612)
    {
        $this->blIncoInd612 = $blIncoInd612;
    }

    function setMoyenneInd612($moyenneInd612)
    {
        $this->moyenneInd612 = $moyenneInd612;
    }

    function setR6121($r6121)
    {
        $this->r6121 = $r6121;
    }

    function setR6122($r6122)
    {
        $this->r6122 = $r6122;
    }

    function setR6123($r6123)
    {
        $this->r6123 = $r6123;
    }

    function setR6124($r6124)
    {
        $this->r6124 = $r6124;
    }

    function setR6125($r6125)
    {
        $this->r6125 = $r6125;
    }

    function setR6126($r6126)
    {
        $this->r6126 = $r6126;
    }

    function getInd613s()
    {
        return $this->ind613s;
    }

    function getBlIncoInd613()
    {
        return $this->blIncoInd613;
    }

    function getMoyenneInd613()
    {
        return $this->moyenneInd613;
    }

    function setInd613s($ind613s)
    {
        $this->ind613s = $ind613s;
    }

    function setBlIncoInd613($blIncoInd613)
    {
        $this->blIncoInd613 = $blIncoInd613;
    }

    function setMoyenneInd613($moyenneInd613)
    {
        $this->moyenneInd613 = $moyenneInd613;
    }

    function getBlIncoInd711()
    {
        return $this->blIncoInd711;
    }

    function getMoyenneInd711()
    {
        return $this->moyenneInd711;
    }

    function getBlIncoInd712()
    {
        return $this->blIncoInd712;
    }

    function getMoyenneInd712()
    {
        return $this->moyenneInd712;
    }

    function getBlIncoInd713()
    {
        return $this->blIncoInd713;
    }

    function getMoyenneInd713()
    {
        return $this->moyenneInd713;
    }

    function setBlIncoInd711($blIncoInd711)
    {
        $this->blIncoInd711 = $blIncoInd711;
    }

    function setMoyenneInd711($moyenneInd711)
    {
        $this->moyenneInd711 = $moyenneInd711;
    }

    function setBlIncoInd712($blIncoInd712)
    {
        $this->blIncoInd712 = $blIncoInd712;
    }

    function setMoyenneInd712($moyenneInd712)
    {
        $this->moyenneInd712 = $moyenneInd712;
    }

    function setBlIncoInd713($blIncoInd713)
    {
        $this->blIncoInd713 = $blIncoInd713;
    }

    function setMoyenneInd713($moyenneInd713)
    {
        $this->moyenneInd713 = $moyenneInd713;
    }

    function getInd422s()
    {
        return $this->ind422s;
    }

    function getInd422sTemp()
    {
        return $this->ind422sTemp;
    }

    function getBlIncoInd422()
    {
        return $this->blIncoInd422;
    }

    function getMoyenneInd422()
    {
        return $this->moyenneInd422;
    }

    function getQ422()
    {
        return $this->q422;
    }

    function getQ425()
    {
        return $this->q425;
    }

    function setInd422s($ind422s)
    {
        $this->ind422s = $ind422s;
    }

    function setInd422sTemp($ind422sTemp)
    {
        $this->ind422sTemp = $ind422sTemp;
    }

    function setBlIncoInd422($blIncoInd422)
    {
        $this->blIncoInd422 = $blIncoInd422;
    }

    function setMoyenneInd422($moyenneInd422)
    {
        $this->moyenneInd422 = $moyenneInd422;
    }

    function setQ422($q422)
    {
        $this->q422 = $q422;
    }

    function setQ425($q425)
    {
        $this->q425 = $q425;
    }

    function getInd221s()
    {
        return $this->ind221s;
    }

    function getBlIncoInd221()
    {
        return $this->blIncoInd221;
    }

    function getMoyenneInd221()
    {
        return $this->moyenneInd221;
    }

    function setInd221s($ind221s)
    {
        $this->ind221s = $ind221s;
    }

    function setBlIncoInd221($blIncoInd221)
    {
        $this->blIncoInd221 = $blIncoInd221;
    }

    function setMoyenneInd221($moyenneInd221)
    {
        $this->moyenneInd221 = $moyenneInd221;
    }

    function getInd421s()
    {
        return $this->ind421s;
    }

    function getInd421sTemp()
    {
        return $this->ind421sTemp;
    }

    function getInd421AotmsTemp()
    {
        return $this->ind421AotmsTemp;
    }

    function getInd422AotmsTemp()
    {
        return $this->ind422AotmsTemp;
    }

    function setInd421AotmsTemp($ind421AotmsTemp)
    {
        $this->ind421AotmsTemp = $ind421AotmsTemp;
    }

    function setInd422AotmsTemp($ind422AotmsTemp)
    {
        $this->ind422AotmsTemp = $ind422AotmsTemp;
    }

    function getBlIncoInd421()
    {
        return $this->blIncoInd421;
    }

    function getMoyenneInd421()
    {
        return $this->moyenneInd421;
    }

    function getQ421()
    {
        return $this->q421;
    }

    function getR421()
    {
        return $this->r421;
    }

    function setInd421s($ind421s)
    {
        $this->ind421s = $ind421s;
    }

    function setInd421sTemp($ind421sTemp)
    {
        $this->ind421sTemp = $ind421sTemp;
    }

    function setBlIncoInd421($blIncoInd421)
    {
        $this->blIncoInd421 = $blIncoInd421;
    }

    function setMoyenneInd421($moyenneInd421)
    {
        $this->moyenneInd421 = $moyenneInd421;
    }

    function setQ421($q421)
    {
        $this->q421 = $q421;
    }

    function setR421($r421)
    {
        $this->r421 = $r421;
    }

    function getInd5111s()
    {
        return $this->ind5111s;
    }

    function getInd5112s()
    {
        return $this->ind5112s;
    }

    function setInd5111s($ind5111s)
    {
        $this->ind5111s = $ind5111s;
    }

    function setInd5112s($ind5112s)
    {
        $this->ind5112s = $ind5112s;
    }


    function getInd5113s()
    {
        return $this->ind5113s;
    }

    function setInd5113s($ind5113s)
    {
        $this->ind5113s = $ind5113s;
    }

    function getBlIncoRassct()
    {
        return $this->blIncoRassct;
    }

    function getBlIncoRassctAccidentTravail()
    {
        return $this->blIncoRassctAccidentTravail;
    }

    function getMoyenneRassctAccidentTravail()
    {
        return $this->moyenneRassctAccidentTravail;
    }

    function setBlIncoRassct($blIncoRassct)
    {
        $this->blIncoRassct = $blIncoRassct;
    }

    function setBlIncoRassctAccidentTravail($blIncoRassctAccidentTravail)
    {
        $this->blIncoRassctAccidentTravail = $blIncoRassctAccidentTravail;
    }

    function setMoyenneRassctAccidentTravail($moyenneRassctAccidentTravail)
    {
        $this->moyenneRassctAccidentTravail = $moyenneRassctAccidentTravail;
    }

    function getBlIncoRassctRealisationFormationSanteTravail()
    {
        return $this->blIncoRassctRealisationFormationSanteTravail;
    }

    function getMoyenneRassctRealisationFormationSanteTravail()
    {
        return $this->moyenneRassctRealisationFormationSanteTravail;
    }

    function setBlIncoRassctRealisationFormationSanteTravail($blIncoRassctRealisationFormationSanteTravail)
    {
        $this->blIncoRassctRealisationFormationSanteTravail = $blIncoRassctRealisationFormationSanteTravail;
    }

    function setMoyenneRassctRealisationFormationSanteTravail($moyenneRassctRealisationFormationSanteTravail)
    {
        $this->moyenneRassctRealisationFormationSanteTravail = $moyenneRassctRealisationFormationSanteTravail;
    }

    function getBlIncoRassctPrevisionFormationSanteTravail()
    {
        return $this->blIncoRassctPrevisionFormationSanteTravail;
    }

    function getMoyenneRassctPrevisionFormationSanteTravail()
    {
        return $this->moyenneRassctPrevisionFormationSanteTravail;
    }

    function setBlIncoRassctPrevisionFormationSanteTravail($blIncoRassctPrevisionFormationSanteTravail)
    {
        $this->blIncoRassctPrevisionFormationSanteTravail = $blIncoRassctPrevisionFormationSanteTravail;
    }

    function setMoyenneRassctPrevisionFormationSanteTravail($moyenneRassctPrevisionFormationSanteTravail)
    {
        $this->moyenneRassctPrevisionFormationSanteTravail = $moyenneRassctPrevisionFormationSanteTravail;
    }

    function getBlIncoRassctAutresMesures()
    {
        return $this->blIncoRassctAutresMesures;
    }

    function getMoyenneRassctAutresMesures()
    {
        return $this->moyenneRassctAutresMesures;
    }

    function setBlIncoRassctAutresMesures($blIncoRassctAutresMesures)
    {
        $this->blIncoRassctAutresMesures = $blIncoRassctAutresMesures;
    }

    function setMoyenneRassctAutresMesures($moyenneRassctAutresMesures)
    {
        $this->moyenneRassctAutresMesures = $moyenneRassctAutresMesures;
    }

    function getBlIncoRassctPredictionsAutresMesures()
    {
        return $this->blIncoRassctPredictionsAutresMesures;
    }

    function getMoyenneRassctPredictionsAutresMesures()
    {
        return $this->moyenneRassctPredictionsAutresMesures;
    }

    function setBlIncoRassctPredictionsAutresMesures($blIncoRassctPredictionsAutresMesures)
    {
        $this->blIncoRassctPredictionsAutresMesures = $blIncoRassctPredictionsAutresMesures;
    }

    function setMoyenneRassctPredictionsAutresMesures($moyenneRassctPredictionsAutresMesures)
    {
        $this->moyenneRassctPredictionsAutresMesures = $moyenneRassctPredictionsAutresMesures;
    }

    /**
     * Add bscRassctRealisationFormationSanteTravail
     *
     * @param $bscRassctRealisationFormationSanteTravail
     *
     * @return BilanSocialAgent
     */
    public function addBscRassctRealisationFormationSanteTravail($bscRassctRealisationFormationSanteTravail)
    {
        $this->bscRassctRealisationFormationSanteTravails[] = $bscRassctRealisationFormationSanteTravail;

        return $this;
    }

    /**
     * Remove bscRassctRealisationFormationSanteTravail
     *
     * @param $bscRassctRealisationFormationSanteTravail
     */
    public function removeBscRassctRealisationFormationSanteTravail($bscRassctRealisationFormationSanteTravail)
    {
        $this->bscRassctRealisationFormationSanteTravails->removeElement($bscRassctRealisationFormationSanteTravail);
    }

    /**
     * Get bscRassctRealisationFormationSanteTravails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBscRassctRealisationFormationSanteTravails()
    {
        return $this->bscRassctRealisationFormationSanteTravails;
    }

    /**
     * Add bscRassctPrevisionFormationSanteTravail
     *
     * @param $bscRassctPrevisionFormationSanteTravail
     *
     * @return BilanSocialAgent
     */
    public function addBscRassctPrevisionFormationSanteTravail($bscRassctPrevisionFormationSanteTravail)
    {
        $this->bscRassctPrevisionFormationSanteTravails[] = $bscRassctPrevisionFormationSanteTravail;

        return $this;
    }

    /**
     * Remove bscRassctPrevisionFormationSanteTravail
     *
     * @param $bscRassctPrevisionFormationSanteTravail
     */
    public function removeBscRassctPrevisionFormationSanteTravail($bscRassctPrevisionFormationSanteTravail)
    {
        $this->bscRassctPrevisionFormationSanteTravails->removeElement($bscRassctPrevisionFormationSanteTravail);
    }

    /**
     * Get bscRassctPrevisionFormationSanteTravails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBscRassctPrevisionFormationSanteTravails()
    {
        return $this->bscRassctPrevisionFormationSanteTravails;
    }

    /**
     * Add bscRassctAutresMesure
     *
     * @param $bscRassctAutresMesure
     *
     * @return BilanSocialAgent
     */
    public function addBscRassctAutresMesure($bscRassctAutresMesure)
    {
        $this->bscRassctAutresMesures[] = $bscRassctAutresMesure;

        return $this;
    }

    /**
     * Remove bscRassctAutresMesure
     *
     * @param $bscRassctAutresMesure
     */
    public function removeBscRassctAutresMesure($bscRassctAutresMesure)
    {
        $this->bscRassctAutresMesures->removeElement($bscRassctAutresMesure);
    }

    function getInd1612s()
    {
        return $this->ind1612s;
    }

    function setInd1612s($ind1612s)
    {
        $this->ind1612s = $ind1612s;
    }

    function getInd5121s()
    {
        return $this->ind5121s;
    }

    function getInd5122s()
    {
        return $this->ind5122s;
    }

    function getBlIncoInd512()
    {
        return $this->blIncoInd512;
    }

    function getMoyenneInd512()
    {
        return $this->moyenneInd512;
    }

    function setInd5121s($ind5121s)
    {
        $this->ind5121s = $ind5121s;
    }

    function setInd5122s($ind5122s)
    {
        $this->ind5122s = $ind5122s;
    }

    function setBlIncoInd512($blIncoInd512)
    {
        $this->blIncoInd512 = $blIncoInd512;
    }

    function setMoyenneInd512($moyenneInd512)
    {
        $this->moyenneInd512 = $moyenneInd512;
    }

    function getInd513s()
    {
        return $this->ind513s;
    }

    function getBlIncoInd513()
    {
        return $this->blIncoInd513;
    }

    function getMoyenneInd513()
    {
        return $this->moyenneInd513;
    }

    function setInd513s($ind513s)
    {
        $this->ind513s = $ind513s;
    }

    function setBlIncoInd513($blIncoInd513)
    {
        $this->blIncoInd513 = $blIncoInd513;
    }

    function setMoyenneInd513($moyenneInd513)
    {
        $this->moyenneInd513 = $moyenneInd513;
    }

    function getInd6141s()
    {
        return $this->ind6141s;
    }

    function getInd6143s()
    {
        return $this->ind6143s;
    }

    function getInd6144s()
    {
        return $this->ind6144s;
    }

    function getInd6142s()
    {
        return $this->ind6142s;
    }

    function getBlIncoInd614()
    {
        return $this->blIncoInd614;
    }

    function getMoyenneInd614()
    {
        return $this->moyenneInd614;
    }

    function setInd6141s($ind6141s)
    {
        $this->ind6141s = $ind6141s;
    }

    function setInd6143s($ind6143s)
    {
        $this->ind6143s = $ind6143s;
    }
    function setInd6144s($ind6144s)
    {
        $this->ind6144s = $ind6144s;
    }
    function setInd6142s($ind6142s)
    {
        $this->ind6142s = $ind6142s;
    }

    function setBlIncoInd614($blIncoInd614)
    {
        $this->blIncoInd614 = $blIncoInd614;
    }

    function setMoyenneInd614($moyenneInd614)
    {
        $this->moyenneInd614 = $moyenneInd614;
    }

    /**
     * Get bscRassctAutresMesures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBscRassctAutresMesures()
    {
        return $this->bscRassctAutresMesures;
    }

    /**
     * Add bscRassctPredictionsAutresMesure
     *
     * @param $bscRassctPredictionsAutresMesure
     *
     * @return BilanSocialAgent
     */
    public function addBscRassctPredictionsAutresMesure($bscRassctPredictionsAutresMesure)
    {
        $this->bscRassctPredictionsAutresMesures[] = $bscRassctPredictionsAutresMesure;

        return $this;
    }

    /**
     * Remove bscRassctPredictionsAutresMesure
     *
     * @param $bscRassctPredictionsAutresMesure
     */
    public function removeBscRassctPredictionsAutresMesure($bscRassctPredictionsAutresMesure)
    {
        $this->bscRassctPredictionsAutresMesures->removeElement($bscRassctPredictionsAutresMesure);
    }

    /**
     * Get bscRassctPredictionsAutresMesures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBscRassctPredictionsAutresMesures()
    {
        return $this->bscRassctPredictionsAutresMesures;
    }

    function getBscRassctNbMaladiePros()
    {
        return $this->bscRassctNbMaladiePros;
    }

    function getBlIncoRassctNbMaladiePro()
    {
        return $this->blIncoRassctNbMaladiePro;
    }

    function getMoyenneRassctNbMaladiePro()
    {
        return $this->moyenneRassctNbMaladiePro;
    }

    function setBscRassctNbMaladiePros($bscRassctNbMaladiePros)
    {
        $this->bscRassctNbMaladiePros = $bscRassctNbMaladiePros;
    }

    function setBlIncoRassctNbMaladiePro($blIncoRassctNbMaladiePro)
    {
        $this->blIncoRassctNbMaladiePro = $blIncoRassctNbMaladiePro;
    }

    function setMoyenneRassctNbMaladiePro($moyenneRassctNbMaladiePro)
    {
        $this->moyenneRassctNbMaladiePro = $moyenneRassctNbMaladiePro;
    }

    function getBscRassctNbAccidentTravails()
    {
        return $this->bscRassctNbAccidentTravails;
    }

    function getBlIncoRassctNbAccidentTravail()
    {
        return $this->blIncoRassctNbAccidentTravail;
    }

    function getMoyenneRassctNbAccidentTravail()
    {
        return $this->moyenneRassctNbAccidentTravail;
    }

    function setBscRassctNbAccidentTravails($bscRassctNbAccidentTravails)
    {
        $this->bscRassctNbAccidentTravails = $bscRassctNbAccidentTravails;
    }

    function setBlIncoRassctNbAccidentTravail($blIncoRassctNbAccidentTravail)
    {
        $this->blIncoRassctNbAccidentTravail = $blIncoRassctNbAccidentTravail;
    }

    function setMoyenneRassctNbAccidentTravail($moyenneRassctNbAccidentTravail)
    {
        $this->moyenneRassctNbAccidentTravail = $moyenneRassctNbAccidentTravail;
    }

    function getBscRassctNatureLesions()
    {
        return $this->bscRassctNatureLesions;
    }

    function getBlIncoRassctNatureLesion()
    {
        return $this->blIncoRassctNatureLesion;
    }

    function getMoyenneRassctNatureLesion()
    {
        return $this->moyenneRassctNatureLesion;
    }

    function setBscRassctNatureLesions($bscRassctNatureLesions)
    {
        $this->bscRassctNatureLesions = $bscRassctNatureLesions;
    }

    function setBlIncoRassctNatureLesion($blIncoRassctNatureLesion)
    {
        $this->blIncoRassctNatureLesion = $blIncoRassctNatureLesion;
    }

    function setMoyenneRassctNatureLesion($moyenneRassctNatureLesion)
    {
        $this->moyenneRassctNatureLesion = $moyenneRassctNatureLesion;
    }

    function getBscRassctSiegeLesions()
    {
        return $this->bscRassctSiegeLesions;
    }

    function getBlIncoRassctSiegeLesion()
    {
        return $this->blIncoRassctSiegeLesion;
    }

    function getMoyenneRassctSiegeLesion()
    {
        return $this->moyenneRassctSiegeLesion;
    }

    function setBscRassctSiegeLesions($bscRassctSiegeLesions)
    {
        $this->bscRassctSiegeLesions = $bscRassctSiegeLesions;
    }

    function setBlIncoRassctSiegeLesion($blIncoRassctSiegeLesion)
    {
        $this->blIncoRassctSiegeLesion = $blIncoRassctSiegeLesion;
    }

    function setMoyenneRassctSiegeLesion($moyenneRassctSiegeLesion)
    {
        $this->moyenneRassctSiegeLesion = $moyenneRassctSiegeLesion;
    }

    function getBscRassctElementMateriels()
    {
        return $this->bscRassctElementMateriels;
    }

    function getBlIncoRassctElementMateriel()
    {
        return $this->blIncoRassctElementMateriel;
    }

    function getMoyenneRassctElementMateriel()
    {
        return $this->moyenneRassctElementMateriel;
    }

    function setBscRassctElementMateriels($bscRassctElementMateriels)
    {
        $this->bscRassctElementMateriels = $bscRassctElementMateriels;
    }

    function setBlIncoRassctElementMateriel($blIncoRassctElementMateriel)
    {
        $this->blIncoRassctElementMateriel = $blIncoRassctElementMateriel;
    }

    function setMoyenneRassctElementMateriel($moyenneRassctElementMateriel)
    {
        $this->moyenneRassctElementMateriel = $moyenneRassctElementMateriel;
    }

    function getBscRassctMaladieProCaracPros()
    {
        return $this->bscRassctMaladieProCaracPros;
    }

    function getBlIncoRassctMaladieProCaracPro()
    {
        return $this->blIncoRassctMaladieProCaracPro;
    }

    function getMoyenneRassctMaladieProCaracPro()
    {
        return $this->moyenneRassctMaladieProCaracPro;
    }

    function setBscRassctMaladieProCaracPros($bscRassctMaladieProCaracPros)
    {
        $this->bscRassctMaladieProCaracPros = $bscRassctMaladieProCaracPros;
    }

    function setBlIncoRassctMaladieProCaracPro($blIncoRassctMaladieProCaracPro)
    {
        $this->blIncoRassctMaladieProCaracPro = $blIncoRassctMaladieProCaracPro;
    }

    function setMoyenneRassctMaladieProCaracPro($moyenneRassctMaladieProCaracPro)
    {
        $this->moyenneRassctMaladieProCaracPro = $moyenneRassctMaladieProCaracPro;
    }

    function getBlIncoGpeec()
    {
        return $this->blIncoGpeec;
    }

    function setBlIncoGpeec($blIncoGpeec)
    {
        $this->blIncoGpeec = $blIncoGpeec;
    }

    function getBscGpeecNbAgentsTituEmpPermaParFoncEtAges()
    {
        return $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAges;
    }

    function getBlIncoGpeecNbAgentsTituEmpPermaParFoncEtAge()
    {
        return $this->blIncoGpeecNbAgentsTituEmpPermaParFoncEtAge;
    }

    function getMoyenneGpeecNbAgentsTituEmpPermaParFoncEtAge()
    {
        return $this->moyenneGpeecNbAgentsTituEmpPermaParFoncEtAge;
    }

    function setBscGpeecNbAgentsTituEmpPermaParFoncEtAges($bscGpeecNbAgentsTituEmpPermaParFoncEtAges)
    {
        $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAges = $bscGpeecNbAgentsTituEmpPermaParFoncEtAges;
    }

    function setBlIncoGpeecNbAgentsTituEmpPermaParFoncEtAge($blIncoGpeecNbAgentsTituEmpPermaParFoncEtAge)
    {
        $this->blIncoGpeecNbAgentsTituEmpPermaParFoncEtAge = $blIncoGpeecNbAgentsTituEmpPermaParFoncEtAge;
    }

    function setMoyenneGpeecNbAgentsTituEmpPermaParFoncEtAge($moyenneGpeecNbAgentsTituEmpPermaParFoncEtAge)
    {
        $this->moyenneGpeecNbAgentsTituEmpPermaParFoncEtAge = $moyenneGpeecNbAgentsTituEmpPermaParFoncEtAge;
    }

    function getBlIncoGpeecPlusNbAgentsParSpeEtAge()
    {
        return $this->blIncoGpeecPlusNbAgentsParSpeEtAge;
    }

    function getMoyenneGpeecPlusNbAgentsParSpeEtAge()
    {
        return $this->moyenneGpeecPlusNbAgentsParSpeEtAge;
    }

    function setBlIncoGpeecPlusNbAgentsParSpeEtAge($blIncoGpeecPlusNbAgentsParSpeEtAge)
    {
        $this->blIncoGpeecPlusNbAgentsParSpeEtAge = $blIncoGpeecPlusNbAgentsParSpeEtAge;
    }

    function setMoyenneGpeecPlusNbAgentsParSpeEtAge($moyenneGpeecPlusNbAgentsParSpeEtAge)
    {
        $this->moyenneGpeecPlusNbAgentsParSpeEtAge = $moyenneGpeecPlusNbAgentsParSpeEtAge;
    }

    function getBscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp()
    {
        return $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp;
    }

    function setBscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp($bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp)
    {
        $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp = $bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp;
    }

    function getBscGpeecPlusNbAgentsParSpeEtAges()
    {
        return $this->bscGpeecPlusNbAgentsParSpeEtAges;
    }

    function getBscGpeecPlusNbAgentsParSpeEtAgesTemp()
    {
        return $this->bscGpeecPlusNbAgentsParSpeEtAgesTemp;
    }

    function setBscGpeecPlusNbAgentsParSpeEtAges($bscGpeecPlusNbAgentsParSpeEtAges)
    {
        $this->bscGpeecPlusNbAgentsParSpeEtAges = $bscGpeecPlusNbAgentsParSpeEtAges;
    }

    function setBscGpeecPlusNbAgentsParSpeEtAgesTemp($bscGpeecPlusNbAgentsParSpeEtAgesTemp)
    {
        $this->bscGpeecPlusNbAgentsParSpeEtAgesTemp = $bscGpeecPlusNbAgentsParSpeEtAgesTemp;
    }

    function getBlIncoHanditorial()
    {
        return $this->blIncoHanditorial;
    }

    function setBlIncoHanditorial($blIncoHanditorial)
    {
        $this->blIncoHanditorial = $blIncoHanditorial;
    }

    function getBlIncoHanditorialQuestionsGenerales()
    {
        return $this->blIncoHanditorialQuestionsGenerales;
    }

    function getMoyenneHanditorialQuestionsGenerales()
    {
        return $this->moyenneHanditorialQuestionsGenerales;
    }

    function setBlIncoHanditorialQuestionsGenerales($blIncoHanditorialQuestionsGenerales)
    {
        $this->blIncoHanditorialQuestionsGenerales = $blIncoHanditorialQuestionsGenerales;
    }

    function setMoyenneHanditorialQuestionsGenerales($moyenneHanditorialQuestionsGenerales)
    {
        $this->moyenneHanditorialQuestionsGenerales = $moyenneHanditorialQuestionsGenerales;
    }

    function getBscHanditorialQuestionsGenerales()
    {
        return $this->bscHanditorialQuestionsGenerales;
    }

    function setBscHanditorialQuestionsGenerales($bscHanditorialQuestionsGenerales)
    {
        $this->bscHanditorialQuestionsGenerales = $bscHanditorialQuestionsGenerales;
    }

    function getBlIncoHanditorialInaptitudeEtReclassement()
    {
        return $this->blIncoHanditorialInaptitudeEtReclassement;
    }

    function getMoyenneHanditorialInaptitudeEtReclassement()
    {
        return $this->moyenneHanditorialInaptitudeEtReclassement;
    }

    function setBlIncoHanditorialInaptitudeEtReclassement($blIncoHanditorialInaptitudeEtReclassement)
    {
        $this->blIncoHanditorialInaptitudeEtReclassement = $blIncoHanditorialInaptitudeEtReclassement;
    }

    function setMoyenneHanditorialInaptitudeEtReclassement($moyenneHanditorialInaptitudeEtReclassement)
    {
        $this->moyenneHanditorialInaptitudeEtReclassement = $moyenneHanditorialInaptitudeEtReclassement;
    }

    function getBscHanditorialInaptitudeEtReclassement()
    {
        return $this->bscHanditorialInaptitudeEtReclassement;
    }

    function setBscHanditorialInaptitudeEtReclassement($bscHanditorialInaptitudeEtReclassement)
    {
        $this->bscHanditorialInaptitudeEtReclassement = $bscHanditorialInaptitudeEtReclassement;
    }

    function getBlIncoHanditorialQuestionsBoeths()
    {
        return $this->blIncoHanditorialQuestionsBoeths;
    }

    function getMoyenneHanditorialQuestionsBoeths()
    {
        return $this->moyenneHanditorialQuestionsBoeths;
    }


    function setBlIncoHanditorialQuestionsBoeths($blIncoHanditorialQuestionsBoeths)
    {
        $this->blIncoHanditorialQuestionsBoeths = $blIncoHanditorialQuestionsBoeths;
    }

    function setMoyenneHanditorialQuestionsBoeths($moyenneHanditorialQuestionsBoeths)
    {
        $this->moyenneHanditorialQuestionsBoeths = $moyenneHanditorialQuestionsBoeths;
    }

    function getBscHanditorialQuestionsBoeths()
    {
        return $this->bscHanditorialQuestionsBoeths;
    }

    function setBscHanditorialQuestionsBoeths($bscHanditorialQuestionsBoeths)
    {
        $this->bscHanditorialQuestionsBoeths = $bscHanditorialQuestionsBoeths;
    }

    function getBscHanditorialNatureHandicaps()
    {
        return $this->bscHanditorialNatureHandicaps;
    }

    function getBlIncoHanditorialNatureHandicaps()
    {
        return $this->blIncoHanditorialNatureHandicaps;
    }

    function getMoyenneHanditorialNatureHandicaps()
    {
        return $this->moyenneHanditorialNatureHandicaps;
    }

    function setBscHanditorialNatureHandicaps($bscHanditorialNatureHandicaps)
    {
        $this->bscHanditorialNatureHandicaps = $bscHanditorialNatureHandicaps;
    }

    function setBlIncoHanditorialNatureHandicaps($blIncoHanditorialNatureHandicaps)
    {
        $this->blIncoHanditorialNatureHandicaps = $blIncoHanditorialNatureHandicaps;
    }

    function setMoyenneHanditorialNatureHandicaps($moyenneHanditorialNatureHandicaps)
    {
        $this->moyenneHanditorialNatureHandicaps = $moyenneHanditorialNatureHandicaps;
    }

    function getBscHanditorialAvisInaptitudes()
    {
        return $this->bscHanditorialAvisInaptitudes;
    }

    function getBlIncoHanditorialAvisInaptitudes()
    {
        return $this->blIncoHanditorialAvisInaptitudes;
    }

    function getMoyenneHanditorialAvisInaptitudes()
    {
        return $this->moyenneHanditorialAvisInaptitudes;
    }

    function setBscHanditorialAvisInaptitudes($bscHanditorialAvisInaptitudes)
    {
        $this->bscHanditorialAvisInaptitudes = $bscHanditorialAvisInaptitudes;
    }

    function setBlIncoHanditorialAvisInaptitudes($blIncoHanditorialAvisInaptitudes)
    {
        $this->blIncoHanditorialAvisInaptitudes = $blIncoHanditorialAvisInaptitudes;
    }

    function setMoyenneHanditorialAvisInaptitudes($moyenneHanditorialAvisInaptitudes)
    {
        $this->moyenneHanditorialAvisInaptitudes = $moyenneHanditorialAvisInaptitudes;
    }

    function getBscHanditorialMesureInaptitudes()
    {
        return $this->bscHanditorialMesureInaptitudes;
    }

    function setBscHanditorialMesureInaptitudes($bscHanditorialMesureInaptitudes)
    {
        $this->bscHanditorialMesureInaptitudes = $bscHanditorialMesureInaptitudes;
    }

    function getBscHanditorialAvisInaptitudesAvant()
    {
        return $this->bscHanditorialAvisInaptitudesAvant;
    }

    function setBscHanditorialAvisInaptitudesAvant($bscHanditorialAvisInaptitudesAvant)
    {
        $this->bscHanditorialAvisInaptitudesAvant = $bscHanditorialAvisInaptitudesAvant;
    }

    function getBscHanditorialMesureInaptitudesAvant()
    {
        return $this->bscHanditorialMesureInaptitudesAvant;
    }

    function setBscHanditorialMesureInaptitudesAvant($bscHanditorialMesureInaptitudesAvant)
    {
        $this->bscHanditorialMesureInaptitudesAvant = $bscHanditorialMesureInaptitudesAvant;
    }

    function getBscHanditorialAncienneteAgents()
    {
        return $this->bscHanditorialAncienneteAgents;
    }

    function setBscHanditorialAncienneteAgents($bscHanditorialAncienneteAgents)
    {
        $this->bscHanditorialAncienneteAgents = $bscHanditorialAncienneteAgents;
    }

    function getBscHanditorialStatutAgents()
    {
        return $this->bscHanditorialStatutAgents;
    }

    function setBscHanditorialStatutAgents($bscHanditorialStatutAgents)
    {
        $this->bscHanditorialStatutAgents = $bscHanditorialStatutAgents;
    }

    function getBscHanditorialDerniersDiplomes()
    {
        return $this->bscHanditorialDerniersDiplomes;
    }

    function setBscHanditorialDerniersDiplomes($bscHanditorialDerniersDiplomes)
    {
        $this->bscHanditorialDerniersDiplomes = $bscHanditorialDerniersDiplomes;
    }

    function getBscHanditorialArticles()
    {
        return $this->bscHanditorialArticles;
    }

    function setBscHanditorialArticles($bscHanditorialArticles)
    {
        $this->bscHanditorialArticles = $bscHanditorialArticles;
    }

    function getBscHanditorialModeSortiesTitulaire()
    {
        return $this->bscHanditorialModeSortiesTitulaire;
    }

    function setBscHanditorialModeSortiesTitulaire($bscHanditorialModeSortiesTitulaire)
    {
        $this->bscHanditorialModeSortiesTitulaire = $bscHanditorialModeSortiesTitulaire;
    }

    function getBscHanditorialModeSortiesNonTitulaire()
    {
        return $this->bscHanditorialModeSortiesNonTitulaire;
    }

    function setBscHanditorialModeSortiesNonTitulaire($bscHanditorialModeSortiesNonTitulaire)
    {
        $this->bscHanditorialModeSortiesNonTitulaire = $bscHanditorialModeSortiesNonTitulaire;
    }

    function getQHandiB41A()
    {
        return $this->qHandiB41A;
    }

    function getQHandiB41B()
    {
        return $this->qHandiB41B;
    }

    function setQHandiB41A($qHandiB41A)
    {
        $this->qHandiB41A = $qHandiB41A;
    }

    function setQHandiB41B($qHandiB41B)
    {
        $this->qHandiB41B = $qHandiB41B;
    }

    function getBscHanditorialCadreEmplois()
    {
        return $this->bscHanditorialCadreEmplois;
    }

    function setBscHanditorialCadreEmplois($bscHanditorialCadreEmplois)
    {
        $this->bscHanditorialCadreEmplois = $bscHanditorialCadreEmplois;
    }

    function getBscHanditorialCadreEmploisTemp()
    {
        return $this->bscHanditorialCadreEmploisTemp;
    }

    function setBscHanditorialCadreEmploisTemp($bscHanditorialCadreEmploisTemp)
    {
        $this->bscHanditorialCadreEmploisTemp = $bscHanditorialCadreEmploisTemp;
    }

    function getBscHanditorialInaptEtReclaCadreEmplois()
    {
        return $this->bscHanditorialInaptEtReclaCadreEmplois;
    }

    function setBscHanditorialInaptEtReclaCadreEmplois($bscHanditorialInaptEtReclaCadreEmplois)
    {
        $this->bscHanditorialInaptEtReclaCadreEmplois = $bscHanditorialInaptEtReclaCadreEmplois;
    }

    function getBscHanditorialInaptEtReclaCadreEmploisTemp()
    {
        return $this->bscHanditorialInaptEtReclaCadreEmploisTemp;
    }

    function setBscHanditorialInaptEtReclaCadreEmploisTemp($bscHanditorialInaptEtReclaCadreEmploisTemp)
    {
        $this->bscHanditorialInaptEtReclaCadreEmploisTemp = $bscHanditorialInaptEtReclaCadreEmploisTemp;
    }

    function getBscHanditorialMetiers()
    {
        return $this->bscHanditorialMetiers;
    }

    function getBscHanditorialMetiersTemp()
    {
        return $this->bscHanditorialMetiersTemp;
    }

    function setBscHanditorialMetiers($bscHanditorialMetiers)
    {
        $this->bscHanditorialMetiers = $bscHanditorialMetiers;
    }

    function setBscHanditorialMetiersTemp($bscHanditorialMetiersTemp)
    {
        $this->bscHanditorialMetiersTemp = $bscHanditorialMetiersTemp;
    }

    function getBscHanditorialInaptEtReclaMetiers()
    {
        return $this->bscHanditorialInaptEtReclaMetiers;
    }

    function setBscHanditorialInaptEtReclaMetiers($bscHanditorialInaptEtReclaMetiers)
    {
        $this->bscHanditorialInaptEtReclaMetiers = $bscHanditorialInaptEtReclaMetiers;
    }

    function getBscHanditorialInaptEtReclaMetiersTemp()
    {
        return $this->bscHanditorialInaptEtReclaMetiersTemp;
    }

    function setBscHanditorialInaptEtReclaMetiersTemp($bscHanditorialInaptEtReclaMetiersTemp)
    {
        $this->bscHanditorialInaptEtReclaMetiersTemp = $bscHanditorialInaptEtReclaMetiersTemp;
    }

    function getBscHanditorialModeEntrees()
    {
        return $this->bscHanditorialModeEntrees;
    }

    function setBscHanditorialModeEntrees($bscHanditorialModeEntrees)
    {
        $this->bscHanditorialModeEntrees = $bscHanditorialModeEntrees;
    }

    function getBlIncoHanditorialCadreEmplois()
    {
        return $this->blIncoHanditorialCadreEmplois;
    }

    function getBlIncoHanditorialInaptEtReclaCadreEmplois()
    {
        return $this->blIncoHanditorialInaptEtReclaCadreEmplois;
    }

    function getMoyenneHanditorialCadreEmplois()
    {
        return $this->moyenneHanditorialCadreEmplois;
    }

    function getMoyenneHanditorialInaptEtReclaCadreEmplois()
    {
        return $this->moyenneHanditorialInaptEtReclaCadreEmplois;
    }

    function getBlIncoHanditorialMetiers()
    {
        return $this->blIncoHanditorialMetiers;
    }

    function getBlIncoHanditorialInaptEtReclaMetiers()
    {
        return $this->blIncoHanditorialInaptEtReclaMetiers;
    }

    function getMoyenneHanditorialMetiers()
    {
        return $this->moyenneHanditorialMetiers;
    }

    function getMoyenneHanditorialInaptEtReclaMetiers()
    {
        return $this->moyenneHanditorialInaptEtReclaMetiers;
    }

    function getBlIncoHanditorialTempsComplets()
    {
        return $this->blIncoHanditorialTempsComplets;
    }

    function getBlIncoHanditorialInaptEtReclaTempsComplets()
    {
        return $this->blIncoHanditorialInaptEtReclaTempsComplets;
    }

    function getMoyenneHanditorialTempsComplets()
    {
        return $this->moyenneHanditorialTempsComplets;
    }

    function getMoyenneHanditorialInaptEtReclaTempsComplets()
    {
        return $this->moyenneHanditorialInaptEtReclaTempsComplets;
    }

    function setBlIncoHanditorialCadreEmplois($blIncoHanditorialCadreEmplois)
    {
        $this->blIncoHanditorialCadreEmplois = $blIncoHanditorialCadreEmplois;
    }

    function setBlIncoHanditorialInaptEtReclaCadreEmplois($blIncoHanditorialInaptEtReclaCadreEmplois)
    {
        $this->blIncoHanditorialInaptEtReclaCadreEmplois = $blIncoHanditorialInaptEtReclaCadreEmplois;
    }

    function setMoyenneHanditorialCadreEmplois($moyenneHanditorialCadreEmplois)
    {
        $this->moyenneHanditorialCadreEmplois = $moyenneHanditorialCadreEmplois;
    }

    function setMoyenneHanditorialInaptEtReclaCadreEmplois($moyenneHanditorialInaptEtReclaCadreEmplois)
    {
        $this->moyenneHanditorialInaptEtReclaCadreEmplois = $moyenneHanditorialInaptEtReclaCadreEmplois;
    }

    function setBlIncoHanditorialMetiers($blIncoHanditorialMetiers)
    {
        $this->blIncoHanditorialMetiers = $blIncoHanditorialMetiers;
    }

    function setMoyenneHanditorialMetiers($moyenneHanditorialMetiers)
    {
        $this->moyenneHanditorialMetiers = $moyenneHanditorialMetiers;
    }

    function setBlIncoHanditorialInaptEtReclaMetiers($blIncoHanditorialInaptEtReclaMetiers)
    {
        $this->blIncoHanditorialInaptEtReclaMetiers = $blIncoHanditorialInaptEtReclaMetiers;
    }

    function setMoyenneHanditorialInaptEtReclaMetiers($moyenneHanditorialInaptEtReclaMetiers)
    {
        $this->moyenneHanditorialInaptEtReclaMetiers = $moyenneHanditorialInaptEtReclaMetiers;
    }

    function setBlIncoHanditorialTempsComplets($blIncoHanditorialTempsComplets)
    {
        $this->blIncoHanditorialTempsComplets = $blIncoHanditorialTempsComplets;
    }

    function setMoyenneHanditorialTempsComplets($moyenneHanditorialTempsComplets)
    {
        $this->moyenneHanditorialTempsComplets = $moyenneHanditorialTempsComplets;
    }

    function setBlIncoHanditorialInaptEtReclaTempsComplets($blIncoHanditorialInaptEtReclaTempsComplets)
    {
        $this->blIncoHanditorialInaptEtReclaTempsComplets = $blIncoHanditorialInaptEtReclaTempsComplets;
    }

    function setMoyenneHanditorialInaptEtReclaTempsComplets($moyenneHanditorialInaptEtReclaTempsComplets)
    {
        $this->moyenneHanditorialInaptEtReclaTempsComplets = $moyenneHanditorialInaptEtReclaTempsComplets;
    }

    function getBlIncoInd5111()
    {
        return $this->blIncoInd5111;
    }

    function getMoyenneInd5111()
    {
        return $this->moyenneInd5111;
    }

    function getBlIncoInd5112()
    {
        return $this->blIncoInd5112;
    }

    function getMoyenneInd5112()
    {
        return $this->moyenneInd5112;
    }

    function getBlIncoInd5113()
    {
        return $this->blIncoInd5113;
    }

    function getMoyenneInd5113()
    {
        return $this->moyenneInd5113;
    }

    function setBlIncoInd5111($blIncoInd5111)
    {
        $this->blIncoInd5111 = $blIncoInd5111;
    }

    function setMoyenneInd5111($moyenneInd5111)
    {
        $this->moyenneInd5111 = $moyenneInd5111;
    }

    function setBlIncoInd5112($blIncoInd5112)
    {
        $this->blIncoInd5112 = $blIncoInd5112;
    }

    function setMoyenneInd5112($moyenneInd5112)
    {
        $this->moyenneInd5112 = $moyenneInd5112;
    }

    function setBlIncoInd5113($blIncoInd5113)
    {
        $this->blIncoInd5113 = $blIncoInd5113;
    }

    function setMoyenneInd5113($moyenneInd5113)
    {
        $this->moyenneInd5113 = $moyenneInd5113;
    }

    function getBlIncoInd210()
    {
        return $this->blIncoInd210;
    }

    function getMoyenneInd210()
    {
        return $this->moyenneInd210;
    }

    function getR2101()
    {
        return $this->r2101;
    }

    function getR2102()
    {
        return $this->r2102;
    }

    function getR2103()
    {
        return $this->r2103;
    }

    function getR2104()
    {
        return $this->r2104;
    }

    function getBlIncoInd227()
    {
        return $this->blIncoInd227;
    }

    function getMoyenneInd227()
    {
        return $this->moyenneInd227;
    }

    function setBlIncoInd227($blIncoInd227)
    {
        $this->blIncoInd227 = $blIncoInd227;
    }

    function setMoyenneInd227($moyenneInd227)
    {
        $this->moyenneInd227 = $moyenneInd227;
    }


    function getR2271()
    {
        return $this->r2271;
    }

    function getR2272()
    {
        return $this->r2272;
    }


    function getR2171()
    {
        return $this->r2171;
    }

    function getR2172()
    {
        return $this->r2172;
    }

    function getR2173()
    {
        return $this->r2173;
    }

    function getR2174()
    {
        return $this->r2174;
    }

    function getR2175()
    {
        return $this->r2175;
    }

    function getR2176()
    {
        return $this->r2176;
    }

    function getR2177()
    {
        return $this->r2177;
    }

    function getR2178()
    {
        return $this->r2178;
    }
    function getInd2211Cycle()
    {
        return $this->ind2211Cycle;
    }
    function getInd2212Cycle()
    {
        return $this->ind2212Cycle;
    }

    function setBlIncoInd210($blIncoInd210)
    {
        $this->blIncoInd210 = $blIncoInd210;
    }

    function setMoyenneInd210($moyenneInd210)
    {
        $this->moyenneInd210 = $moyenneInd210;
    }

    function setR2101($r2101)
    {
        $this->r2101 = $r2101;
    }

    function setR2102($r2102)
    {
        $this->r2102 = $r2102;
    }

    function setR2103($r2103)
    {
        $this->r2103 = $r2103;
    }

    function setR2104($r2104)
    {
        $this->r2104 = $r2104;
    }

    function setR2271($r2271)
    {
        $this->r2271 = $r2271;
    }

    function setR2272($r2272)
    {
        $this->r2272 = $r2272;
    }

    function setR2171($r2171)
    {
        $this->r2171 = $r2171;
    }

    function setR2172($r2172)
    {
        $this->r2172 = $r2172;
    }

    function setR2173($r2173)
    {
        $this->r2173 = $r2173;
    }

    function setR2174($r2174)
    {
        $this->r2174 = $r2174;
    }

    function setR2175($r2175)
    {
        $this->r2175 = $r2175;
    }

    function setR2176($r2176)
    {
        $this->r2176 = $r2176;
    }

    function setR2177($r2177)
    {
        $this->r2177 = $r2177;
    }

    function setR2178($r2178)
    {
        $this->r2178 = $r2178;
    }

    function setInd2211Cycle($ind2211Cycle)
    {
        $this->ind2211Cycle = $ind2211Cycle;
    }
    function setInd2212Cycle($ind2212Cycle)
    {
        $this->ind2212Cycle = $ind2212Cycle;
    }

    function getInd7141s()
    {
        return $this->ind7141s;
    }

    function getInd7142s()
    {
        return $this->ind7142s;
    }

    function getBlIncoInd714()
    {
        return $this->blIncoInd714;
    }

    function getMoyenneInd714()
    {
        return $this->moyenneInd714;
    }

    function setInd7141s($ind7141s)
    {
        $this->ind7141s = $ind7141s;
    }

    function setInd7142s($ind7142s)
    {
        $this->ind7142s = $ind7142s;
    }

    function setBlIncoInd714($blIncoInd714)
    {
        $this->blIncoInd714 = $blIncoInd714;
    }

    function setMoyenneInd714($moyenneInd714)
    {
        $this->moyenneInd714 = $moyenneInd714;
    }

    function getR71411HC()
    {
        return $this->r71411HC;
    }

    function getR71412HC()
    {
        return $this->r71412HC;
    }

    function getR71421HC()
    {
        return $this->r71421HC;
    }

    function getR71422HC()
    {
        return $this->r71422HC;
    }

    function setR71411HC($r71411HC)
    {
        $this->r71411HC = $r71411HC;
    }

    function setR71412HC($r71412HC)
    {
        $this->r71412HC = $r71412HC;
    }

    function setR71421HC($r71421HC)
    {
        $this->r71421HC = $r71421HC;
    }

    function setR71422HC($r71422HC)
    {
        $this->r71422HC = $r71422HC;
    }

    /*
    *   Dgcl
    */
    function getBlIncoDgcl()
    {
        return $this->blIncoDgcl;
    }

    function setBlIncoDgcl($blIncoDgcl)
    {
        $this->blIncoDgcl = $blIncoDgcl;
    }

    function getBlIncoDgclJoursCarence()
    {
        return $this->blIncoDgclJoursCarence;
    }

    function setBlIncoDgclJoursCarence($blIncoDgclJoursCarence)
    {
        $this->blIncoDgclJoursCarence = $blIncoDgclJoursCarence;
    }

    function getMoyenneDgclJoursCarence()
    {
        return $this->moyenneDgclJoursCarence;
    }

    function setMoyenneDgclJoursCarence($moyenneDgclJoursCarence)
    {
        $this->moyenneDgclJoursCarence = $moyenneDgclJoursCarence;
    }

    function getBlIncoDgclJoursCarenceTitulaire()
    {
        return $this->blIncoDgclJoursCarenceTitulaire;
    }

    function setBlIncoDgclJoursCarenceTitulaire($blIncoDgclJoursCarenceTitulaire)
    {
        $this->blIncoDgclJoursCarenceTitulaire = $blIncoDgclJoursCarenceTitulaire;
    }

    function getMoyenneDgclJoursCarenceTitulaire()
    {
        return $this->moyenneDgclJoursCarenceTitulaire;
    }

    function setMoyenneDgclJoursCarenceTitulaire($moyenneDgclJoursCarenceTitulaire)
    {
        $this->moyenneDgclJoursCarenceTitulaire = $moyenneDgclJoursCarenceTitulaire;
    }

    function getBlIncoDgclJoursCarenceContractuel()
    {
        return $this->blIncoDgclJoursCarenceContractuel;
    }

    function setBlIncoDgclJoursCarenceContractuel($blIncoDgclJoursCarenceContractuel)
    {
        $this->blIncoDgclJoursCarenceContractuel = $blIncoDgclJoursCarenceContractuel;
    }

    function getMoyenneDgclJoursCarenceContractuel()
    {
        return $this->moyenneDgclJoursCarenceContractuel;
    }

    function setMoyenneDgclJoursCarenceContractuel($moyenneDgclJoursCarenceContractuel)
    {
        $this->moyenneDgclJoursCarenceContractuel = $moyenneDgclJoursCarenceContractuel;
    }


    function getNbAgentContractuelEmploiPermanent()
    {
        return $this->nbAgentContractuelEmploiPermanent;
    }

    function getNbAgentContractuelEmploiNonPermament()
    {
        return $this->nbAgentContractuelEmploiNonPermament;
    }

    function getNbAgentEmploiPermanent()
    {
        return $this->nbAgentEmploiPermanent;
    }

    function getNbAgentTitulaire()
    {
        return $this->nbAgentTitulaire;
    }

    /** 06/2018 - FP - Utilisation ORM only. Champ mis à jour via trigger "BSC_BU_On_Statut_Change"
     * @param $nbAgentContractuelEmploiPermanent
     */
    function setNbAgentContractuelEmploiPermanent($nbAgentContractuelEmploiPermanent)
    {
        $this->nbAgentContractuelEmploiPermanent = $nbAgentContractuelEmploiPermanent;
    }

    /** 06/2018 - FP - Utilisation ORM only. Champ mis à jour via trigger "BSC_BU_On_Statut_Change"
     * @param $nbAgentContractuelEmploiNonPermament
     */
    function setNbAgentContractuelEmploiNonPermament($nbAgentContractuelEmploiNonPermament)
    {
        $this->nbAgentContractuelEmploiNonPermament = $nbAgentContractuelEmploiNonPermament;
    }

    /** 06/2018 - FP - Utilisation ORM only. Champ mis à jour via trigger "BSC_BU_On_Statut_Change"
     * @param $nbAgentEmploiPermanent
     */
    function setNbAgentEmploiPermanent($nbAgentEmploiPermanent)
    {
        $this->nbAgentEmploiPermanent = $nbAgentEmploiPermanent;
    }

    /** 06/2018 - FP - Utilisation ORM only. Champ mis à jour via trigger "BSC_BU_On_Statut_Change"
     * @param $nbAgentTitulaire
     */
    function setNbAgentTitulaire($nbAgentTitulaire)
    {
        $this->nbAgentTitulaire = $nbAgentTitulaire;
    }

    function getMoyenneGpeecNiveauDiplome()
    {
        return $this->moyenneGpeecNiveauDiplome;
    }

    function getBlIncoGpeecNiveauDiplome()
    {
        return $this->blIncoGpeecNiveauDiplome;
    }

    function setMoyenneGpeecNiveauDiplome($moyenneGpeecNiveauDiplome)
    {
        $this->moyenneGpeecNiveauDiplome = $moyenneGpeecNiveauDiplome;
    }

    function setBlIncoGpeecNiveauDiplome($blIncoGpeecNiveauDiplome)
    {
        $this->blIncoGpeecNiveauDiplome = $blIncoGpeecNiveauDiplome;
    }

    function getBscGpeecNiveauDiplomes()
    {
        return $this->bscGpeecNiveauDiplomes;
    }

    function setBscGpeecNiveauDiplomes($bscGpeecNiveauDiplomes)
    {
        $this->bscGpeecNiveauDiplomes = $bscGpeecNiveauDiplomes;
    }

    function getInd421HsTemp()
    {
        return $this->ind421HsTemp;
    }

    function getInd422HsTemp()
    {
        return $this->ind422HsTemp;
    }

    function setInd421HsTemp($ind421HsTemp)
    {
        $this->ind421HsTemp = $ind421HsTemp;
    }

    function setInd422HsTemp($ind422HsTemp)
    {
        $this->ind422HsTemp = $ind422HsTemp;
    }

    /**
     * @return mixed
     */
    public function getBscRassctInformationCollectivite()
    {
        return $this->bscRassctInformationCollectivite;
    }

    /**
     * @param mixed $bscRassctInformationCollectivite
     */
    public function setBscRassctInformationCollectivite($bscRassctInformationCollectivite)
    {
        $this->bscRassctInformationCollectivite = $bscRassctInformationCollectivite;
    }

    /**
     * @return mixed
     */
    public function getBlIncoRassctInformationCollectivite()
    {
        return $this->blIncoRassctInformationCollectivite;
    }

    /**
     * @param mixed $blIncoRassctInformationCollectivite
     */
    public function setBlIncoRassctInformationCollectivite($blIncoRassctInformationCollectivite)
    {
        $this->blIncoRassctInformationCollectivite = $blIncoRassctInformationCollectivite;
    }

    /**
     * @return mixed
     */
    public function getMoyenneRassctInformationCollectivite()
    {
        return $this->moyenneRassctInformationCollectivite;
    }

    /**
     * @param mixed $moyenneRassctInformationCollectivite
     */
    public function setMoyenneRassctInformationCollectivite($moyenneRassctInformationCollectivite)
    {
        $this->moyenneRassctInformationCollectivite = $moyenneRassctInformationCollectivite;
    }

    /**
     * Add bscDgclJoursCarenceTitulaire
     *
     * @param $bscDgclJoursCarenceTitulaire
     *
     * @return BilanSocialConsolide
     */
    public function addBscDgclJoursCarenceTitulaire($bscDgclJoursCarenceTitulaire)
    {
        $this->bscDgclJoursCarenceTitulaires[] = $bscDgclJoursCarenceTitulaire;

        return $this;
    }

    /**
     * Remove bscDgclJoursCarenceTitulaire
     *
     * @param $bscDgclJoursCarenceTitulaire
     */
    public function removeBscDgclJoursCarenceTitulaire($bscDgclJoursCarenceTitulaire)
    {
        $this->bscDgclJoursCarenceTitulaires->removeElement($bscDgclJoursCarenceTitulaire);
    }

    /**
     * Get bscDgclJoursCarenceTitulaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBscDgclJoursCarenceTitulaires()
    {
        return $this->bscDgclJoursCarenceTitulaires;
    }

    /**
     * Get bscDgclJoursCarenceTitulaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function setBscDgclJoursCarenceTitulaires($bscDgclJoursCarenceTitulaires)
    {
        return $this->bscDgclJoursCarenceTitulaires = $bscDgclJoursCarenceTitulaires;
    }

    /**
     * Add bscDgclJoursCarenceContractuels
     *
     * @param $bscDgclJoursCarenceContractuels
     *
     * @return BilanSocialConsolide
     */
    public function addBscDgclJoursCarenceContractuel($bscDgclJoursCarenceContractuel)
    {
        $this->bscDgclJoursCarenceContractuels[] = $bscDgclJoursCarenceContractuel;

        return $this;
    }

    /**
     * Remove bscDgclJoursCarenceContractuels
     *
     * @param $bscDgclJoursCarenceContractuels
     */
    public function removeBscDgclJoursCarenceContractuel($bscDgclJoursCarenceContractuel)
    {
        $this->bscDgclJoursCarenceContractuels->removeElement($bscDgclJoursCarenceContractuel);
    }

    /**
     * Get bscDgclJoursCarenceContractuels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBscDgclJoursCarenceContractuels()
    {
        return $this->bscDgclJoursCarenceContractuels;
    }

    /**
     * Get bscDgclJoursCarenceContractuels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function setBscDgclJoursCarenceContractuels($bscDgclJoursCarenceContractuels)
    {
        return $this->bscDgclJoursCarenceContractuels = $bscDgclJoursCarenceContractuels;
    }

    function getBlUpdated()
    {
        return $this->blUpdated;
    }

    function setBlUpdated($blUpdated)
    {
        $this->blUpdated = $blUpdated;
    }

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $setter = "set" . ucfirst($key);
                if (method_exists($this, $setter)) $this->$setter($value);
                else $this->$key = $value;
            }
        }
    }

    public function getIndPileForBy($ind_key, $for = null, $by = null, $options = array())
    {
        $piles = array();
        if (($inds = useGetterOnOr($ind_key, $this)) !== null) {
            $inds = clone $inds;
            $iter_ok = 0;
            foreach ($inds as $iter => $ind) {
                $is_ok = true;
                if($for!=null && $by!=null){
                    $for = is_array($for) ? $for : array($for);
                    $by = is_array($by) ? $by : array($by);
                    $ind_value = clone $ind;
                    foreach ($for as $for_key) {
                        if (($ind_value = useGetterOnOr($for_key, $ind_value, null)) === null) {
                            break;
                        }
                    }
                    $exclude = getFromOr('exclude', $options, false);
                    $exclude_by = array();
                    if ($exclude === true) {
                        $exclude_by = $by;
                    } elseif ($exclude !== false) {
                        $exclude_by = is_array($exclude) ? $exclude : array($exclude);
                    }
                    $is_ok = !in_array($ind_value, $exclude_by);
                    if ($is_ok && $exclude === false) {

                        $is_ok = in_array($ind_value, $by);
                    }
                }
                if ($is_ok) {
                    foreach ($ind->getIndValuesAsArray() as $col_key => $value) {
                        if (!isset($piles[$col_key])) $piles[$col_key] = 0;
                        $piles[$col_key] += is_numeric($value) ? $value : 0;
                    }
                    $iter_ok++;
                }
            }
            if(empty($piles)){
                $default = $this->getFromIndPilesDefault($ind_key);
                if($default!==null){
                    $default_values = $default->getIndValuesAsArray();
                    foreach ($default_values as $default_key => $default_value) {
                        $piles[$default_key] = is_numeric($default_value) ? $default_value : 0;
                    }
                }
            }
        }
        return $piles;
    }

    protected $indPilesDefault;

    public function getIndPilesDefault()
    {
        if ($this->indPilesDefault == null) {
            $this->initIndPilesDefault();
        }
        return $this->indPilesDefault;
    }

    public function initIndPilesDefault()
    {
        $this->indPilesDefault = array(
            'ind1101sTemp'=>new Ind1101(),
            'ind1102sTemp'=>new Ind1102(),
            'ind111s'=>new Ind111(),
            'ind112s'=>new Ind112(),
            'ind114s'=>new Ind114(),
            'ind121s'=>new Ind121(),
            'ind122s'=>new Ind122(),
            'ind124sTemp'=>new Ind124(),
            'ind1501s'=>new Ind1501(),
            'ind1502s'=>new Ind1502(),
            'ind1511s'=>new Ind1511(),
            'ind1512s'=>new Ind1512(),
            'ind1513s'=>new Ind1513(),
            'ind161s'=>new Ind161(),
            'ind1612s'=>new Ind1612(),
            'ind152s'=>new Ind152(),
            'ind1531s'=>new Ind1531(),
            'ind1532s'=>new Ind1532(),
            'ind158s'=>new Ind158(),
            'ind214s'=>new Ind214(),
            'ind221s'=>new Ind221(),
            'ind222s'=>new Ind222(),
            'ind224s'=>new Ind224(),
            'ind171s'=>new Ind171(),
            'ind2111s'=>new Ind2111(),
            'ind2121s'=>new Ind2121(),
            'ind2131s'=>new Ind2131(),
            'ind311s'=>new Ind311(),
            'ind321s'=>new Ind321(),
            'ind331s'=>new Ind331(),
            'ind344s'=>new Ind344(),
            'ind344sTemp'=>new Ind344(),
            'ind412s'=>new Ind412(),
            'ind421s'=>new Ind421(),
            'ind422s'=>new Ind422(),
            'ind423s'=>new Ind423(),
            'ind424s'=>new Ind424(),
            'ind431s'=>new Ind431(),
            'ind5121s'=>new Ind5121(),
            'ind5122s'=>new Ind5122(),
            'ind5111s'=>new Ind5111(),
            'ind513s'=>new Ind513(),
            'ind7141s'=>new Ind7141(),
            'ind7142s'=>new Ind7142(),
            'bscGpeecNbAgentsTituEmpPermaParFoncEtAges' => new BscGpeecNbAgentsTituEmpPermaParFoncEtAge(),
            'bscGpeecPlusNbAgentsParSpeEtAges' => new BscGpeecPlusNbAgentsParSpeEtAge()
        );
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

    public function getFromIndPilesDefault($key)
    {
        return getFromOr($key, $this->getIndPilesDefault());
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



}
