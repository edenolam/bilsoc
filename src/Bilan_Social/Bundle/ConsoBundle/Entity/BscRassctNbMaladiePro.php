<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctNbMaladiePro {

    /**
     * @var integer
     */
    private $bscRassctNbMaladiePro;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $rNbMpReconnues;

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
    private $refTypeActivite;

    function getBscRassctNbMaladiePro() {
        return $this->bscRassctNbMaladiePro;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getRNbMpReconnues(int $ifNull = null) {
        return $this->rNbMpReconnues ?? $ifNull;
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

    function setBscRassctNbMaladiePro($bscRassctNbMaladiePro) {
        $this->bscRassctNbMaladiePro = $bscRassctNbMaladiePro;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setRNbMpReconnues($rNbMpReconnues) {
        $this->rNbMpReconnues = $rNbMpReconnues;
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

    function getRefTypeActivite() {
        return $this->refTypeActivite;
    }

    function setRefTypeActivite($refTypeActivite) {
        $this->refTypeActivite = $refTypeActivite;
    }

}
