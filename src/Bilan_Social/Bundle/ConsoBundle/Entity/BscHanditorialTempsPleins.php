<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialTempsPleins {

    /**
     * @var integer
     */
    private $idBscHanditorialTempsPleins;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $tempsPleinH;

    /**
     * @var integer
     */
    private $tempsPleinF;

    /**
     * @var integer
     */
    private $tempsPartielH;

    /**
     * @var integer
     */
    private $tempsPartielF;

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

    function getIdBscHanditorialTempsPleins() {
        return $this->idBscHanditorialTempsPleins;
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

    function setIdBscHanditorialTempsPleins($idBscHanditorialTempsPleins) {
        $this->idBscHanditorialTempsPleins = $idBscHanditorialTempsPleins;
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

    function getTempsPleinH(int $ifNull = null) {
        return $this->tempsPleinH ?? $ifNull;
    }

    function getTempsPleinF(int $ifNull = null) {
        return $this->tempsPleinF ?? $ifNull;
    }

    function getTempsPartielH(int $ifNull = null) {
        return $this->tempsPartielH ?? $ifNull;
    }

    function getTempsPartielF(int $ifNull = null) {
        return $this->tempsPartielF ?? $ifNull;
    }

    function setTempsPleinH($tempsPleinH) {
        $this->tempsPleinH = $tempsPleinH;
    }

    function setTempsPleinF($tempsPleinF) {
        $this->tempsPleinF = $tempsPleinF;
    }

    function setTempsPartielH($tempsPartielH) {
        $this->tempsPartielH = $tempsPartielH;
    }

    function setTempsPartielF($tempsPartielF) {
        $this->tempsPartielF = $tempsPartielF;
    }

}
