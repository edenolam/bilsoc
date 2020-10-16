<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctNatureLesion {

    /**
     * @var integer
     */
    private $bscRassctNatureLesion;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $rNbAccidentAvecArret;

    /**
     * @var integer
     */
    private $rNbAccidentSansArret;

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
    private $refNatureLesion;

    function getBscRassctNatureLesion() {
        return $this->bscRassctNatureLesion;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getRNbAccidentAvecArret(int $ifNull = null) {
        return $this->rNbAccidentAvecArret ?? $ifNull;
    }

    function getRNbAccidentSansArret(int $ifNull = null) {
        return $this->rNbAccidentSansArret ?? $ifNull;
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

    function setBscRassctNatureLesion($bscRassctNatureLesion) {
        $this->bscRassctNatureLesion = $bscRassctNatureLesion;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setRNbAccidentAvecArret($rNbAccidentAvecArret) {
        $this->rNbAccidentAvecArret = $rNbAccidentAvecArret;
    }

    function setRNbAccidentSansArret($rNbAccidentSansArret) {
        $this->rNbAccidentSansArret = $rNbAccidentSansArret;
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

    function getRefNatureLesion() {
        return $this->refNatureLesion;
    }

    function setRefNatureLesion($refNatureLesion) {
        $this->refNatureLesion = $refNatureLesion;
    }

}
