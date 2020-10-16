<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctSiegeLesion {

    /**
     * @var integer
     */
    private $bscRassctSiegeLesion;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $rNbAccident;

    /**
     * @var integer
     */
    private $rNbJourArret;

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

    /**
     * @return integer
     */
    private $refSiegeLesion;

    function getBscRassctSiegeLesion() {
        return $this->bscRassctSiegeLesion;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getRNbAccident(int $ifNull = null) {
        return $this->rNbAccident ?? $ifNull;
    }

    function getRNbJourArret(int $ifNull = null) {
        return $this->rNbJourArret ?? $ifNull;
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

    function setBscRassctSiegeLesion($bscRassctSiegeLesion) {
        $this->bscRassctSiegeLesion = $bscRassctSiegeLesion;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setRNbAccident($rNbAccident) {
        $this->rNbAccident = $rNbAccident;
    }

    function setRNbJourArret($rNbJourArret) {
        $this->rNbJourArret = $rNbJourArret;
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

    function getRefSiegeLesion() {
        return $this->refSiegeLesion;
    }

    function setRefSiegeLesion($refSiegeLesion) {
        $this->refSiegeLesion = $refSiegeLesion;
    }

}
