<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscDgclJoursCarenceBase {

    /**
     * @var integer
     */
    #protected $idBscBscDgclJoursCarence;
    protected $bilanSocialConsolide;

    /**
     * @var integer
     */
    protected $nbJoursCarencePrelevesH;

    /**
     * @var integer
     */
    protected $nbJoursCarencePrelevesF;

    /**
     * @var integer
     */
    protected $nbSommeDelaiCarenceH;

    /**
     * @var integer
     */
    protected $nbSommeDelaiCarenceF;

    /**
     * @var integer
     */
    protected $nbTotalAgentRemuneresH;

    /**
     * @var integer
     */
    protected $nbTotalAgentRemuneresF;

    /**
     * @var integer
     */
    protected $nbTotalAgentJoursCarenceH;

    /**
     * @var integer
     */
    protected $nbTotalAgentJoursCarenceF;

    /**
     * @var integer
     */
    protected $nbArretMaladiesH;

    /**
     * @var integer
     */
    protected $nbArretMaladiesF;

    /**
     * @var integer
     */
    protected $idBilasocicons;

    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $dtModi;

    /**
     * @var string
     */
    protected $cdUtilmodi;

    protected $refCategorie;

    function getIdBscDgclJoursCarence() {
        return $this->idBscBscDgclJoursCarence;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getDtCrea(): \DateTime {
        return $this->dtCrea;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function getDtModi(): \DateTime {
        return $this->dtModi;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function setIdIdBscDgclJoursCarence($idBscIdBscDgclJoursCarence) {
        $this->idIdBscDgclJoursCarence = $idBscIdBscDgclJoursCarence;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setDtCrea(\DateTime $dtCrea) {
        $this->dtCrea = $dtCrea;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function setDtModi(\DateTime $dtModi) {
        $this->dtModi = $dtModi;
    }

    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    /*
    * nbJoursCarencePreleves H et F
    */
    function getNbJoursCarencePrelevesH(int $ifNull = null) {
        return $this->nbJoursCarencePrelevesH ?? $ifNull;
    }

    function getNbJoursCarencePrelevesF(int $ifNull = null) {
        return $this->nbJoursCarencePrelevesF ?? $ifNull;
    }

    function setNbJoursCarencePrelevesH($nbJoursCarencePrelevesH) {
        $this->nbJoursCarencePrelevesH = $nbJoursCarencePrelevesH;
    }

    function setNbJoursCarencePrelevesF($nbJoursCarencePrelevesF) {
        $this->nbJoursCarencePrelevesF = $nbJoursCarencePrelevesF;
    }

    /*
    * nbSommeDelaiCarence H et F
    */
    function getNbSommeDelaiCarenceH(int $ifNull = null) {
        return $this->nbSommeDelaiCarenceH ?? $ifNull;
    }

    function getNbSommeDelaiCarenceF(int $ifNull = null) {
        return $this->nbSommeDelaiCarenceF ?? $ifNull;
    }

    function setNbSommeDelaiCarenceH($nbSommeDelaiCarenceH) {
        $this->nbSommeDelaiCarenceH = $nbSommeDelaiCarenceH;
    }

    function setNbSommeDelaiCarenceF($nbSommeDelaiCarenceF) {
        $this->nbSommeDelaiCarenceF = $nbSommeDelaiCarenceF;
    }

    /*
    * nbTotalAgentRemuneres H et F
    */
    function getNbTotalAgentRemuneresH(int $ifNull = null) {
        return $this->nbTotalAgentRemuneresH ?? $ifNull;
    }

    function getNbTotalAgentRemuneresF(int $ifNull = null) {
        return $this->nbTotalAgentRemuneresF ?? $ifNull;
    }

    function setNbTotalAgentRemuneresH($nbTotalAgentRemuneresH) {
        $this->nbTotalAgentRemuneresH = $nbTotalAgentRemuneresH;
    }

    function setNbTotalAgentRemuneresF($nbTotalAgentRemuneresF) {
        $this->nbTotalAgentRemuneresF = $nbTotalAgentRemuneresF;
    }

    /*
    * nbTotalAgentJoursCarence H et F
    */
    
    function getNbTotalAgentJoursCarenceH(int $ifNull = null) {
        return $this->nbTotalAgentJoursCarenceH ?? $ifNull;
    }

    function getNbTotalAgentJoursCarenceF(int $ifNull = null) {
        return $this->nbTotalAgentJoursCarenceF ?? $ifNull;
    }

    function setNbTotalAgentJoursCarenceH($nbTotalAgentJoursCarenceH) {
        $this->nbTotalAgentJoursCarenceH = $nbTotalAgentJoursCarenceH;
    }

    function setNbTotalAgentJoursCarenceF($nbTotalAgentJoursCarenceF) {
        $this->nbTotalAgentJoursCarenceF = $nbTotalAgentJoursCarenceF;
    }

    /*
    * nbArretMaladies H et F
    */
    
    function getNbArretMaladiesH(int $ifNull = null) {
        return $this->nbArretMaladiesH ?? $ifNull;
    }

    function getNbArretMaladiesF(int $ifNull = null) {
        return $this->nbArretMaladiesF ?? $ifNull;
    }

    function setNbArretMaladiesH($nbArretMaladiesH) {
        $this->nbArretMaladiesH = $nbArretMaladiesH;
    }

    function setNbArretMaladiesF($nbArretMaladiesF) {
        $this->nbArretMaladiesF = $nbArretMaladiesF;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

}
