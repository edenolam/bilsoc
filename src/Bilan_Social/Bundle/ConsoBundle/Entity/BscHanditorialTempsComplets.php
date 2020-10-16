<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialTempsComplets {

    /**
     * @var integer
     */
    private $idBscHanditorialTempsComplets;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $tempsCompletH;

    /**
     * @var integer
     */
    private $tempsCompletF;

    /**
     * @var integer
     */
    private $tempsNonCompletH;

    /**
     * @var integer
     */
    private $tempsNonCompletF;

    /**
     * @var string
     */
    private $fgStat;

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

    function getIdBscHanditorialTempsComplets() {
        return $this->idBscHanditorialTempsComplets;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getFgStat() {
        return $this->fgStat;
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

    function setIdBscHanditorialTempsComplets($idBscHanditorialTempsComplets) {
        $this->idBscHanditorialTempsComplets = $idBscHanditorialTempsComplets;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setFgStat($fgStat) {
        $this->fgStat = $fgStat;
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

    function getTempsCompletH(int $ifNull = null) {
        return $this->tempsCompletH ?? $ifNull;
    }

    function getTempsCompletF(int $ifNull = null) {
        return $this->tempsCompletF ?? $ifNull;
    }

    function getTempsNonCompletH(int $ifNull = null) {
        return $this->tempsNonCompletH ?? $ifNull;
    }

    function getTempsNonCompletF(int $ifNull = null) {
        return $this->tempsNonCompletF ?? $ifNull;
    }

    function setTempsCompletH($tempsCompletH) {
        $this->tempsCompletH = $tempsCompletH;
    }

    function setTempsCompletF($tempsCompletF) {
        $this->tempsCompletF = $tempsCompletF;
    }

    function setTempsNonCompletH($tempsNonCompletH) {
        $this->tempsNonCompletH = $tempsNonCompletH;
    }

    function setTempsNonCompletF($tempsNonCompletF) {
        $this->tempsNonCompletF = $tempsNonCompletF;
    }

}
