<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctAccidentTravail {

    /**
     * @var integer
     */
    private $idBscRassctAccidentTravail;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $rAccident_1;

    /**
     * @var integer
     */
    private $rAccident_2;

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

    function getIdBscRassctAccidentTravail() {
        return $this->idBscRassctAccidentTravail;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getRAccident1(int $ifNull = null) {
        return $this->rAccident_1 ?? $ifNull;
    }

    function getRAccident2(int $ifNull = null) {
        return $this->rAccident_2 ?? $ifNull;
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

    function setIdBscRassctAccidentTravail($idBscRassctAccidentTravail) {
        $this->idBscRassctAccidentTravail = $idBscRassctAccidentTravail;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setRAccident1($rAccident_1) {
        $this->rAccident_1 = $rAccident_1;
    }

    function setRAccident2($rAccident_2) {
        $this->rAccident_2 = $rAccident_2;
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

}

