<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctNbAccidentTravail {

    /**
     * @var integer
     */
    private $bscRassctNbAccidentTravail;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $rNbAccidentsSurvenus;

    /**
     * @var integer
     */
    private $rNbJourArretAccidents;

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
    private $refTypeActivite;

    function getBscRassctNbAccidentTravail() {
        return $this->bscRassctNbAccidentTravail;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getRNbAccidentsSurvenus(int $ifNull = null) {
        return $this->rNbAccidentsSurvenus ?? $ifNull;
    }

    function getRNbJourArretAccidents(int $ifNull = null) {
        return $this->rNbJourArretAccidents ?? $ifNull;
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

    function setBscRassctNbAccidentTravail($bscRassctNbAccidentTravail) {
        $this->bscRassctNbAccidentTravail = $bscRassctNbAccidentTravail;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }


    function setRNbAccidentsSurvenus($rNbAccidentsSurvenus) {
        $this->rNbAccidentsSurvenus = $rNbAccidentsSurvenus;
    }

    function setRNbJourArretAccidents($rNbJourArretAccidents) {
        $this->rNbJourArretAccidents = $rNbJourArretAccidents;
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

    function getRefTypeActivite() {
        return $this->refTypeActivite;
    }

    function setRefTypeActivite($refTypeActivite) {
        $this->refTypeActivite = $refTypeActivite;
    }

}
