<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialModeEntrees {

    /**
     * @var integer
     */
    private $idBscHanditorialModeEntrees;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $modeEntreeH;

    /**
     * @var integer
     */
    private $modeEntreeF;

    /**
     * @var integer
     */
    private $idBilasocicons;

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
    private $refMotifArrivee;

    function getIdBscHanditorialModeEntrees() {
        return $this->idBscHanditorialModeEntrees;
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

    function setIdBscHanditorialModeEntrees($idBscHanditorialModeEntrees) {
        $this->idBscHanditorialModeEntrees = $idBscHanditorialModeEntrees;
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

    function getModeEntreeH(int $ifNull = null) {
        return $this->modeEntreeH ?? $ifNull;
    }

    function getModeEntreeF(int $ifNull = null) {
        return $this->modeEntreeF ?? $ifNull;
    }

    function getRefMotifArrivee() {
        return $this->refMotifArrivee;
    }

    function setModeEntreeH($modeEntreeH) {
        $this->modeEntreeH = $modeEntreeH;
    }

    function setModeEntreeF($modeEntreeF) {
        $this->modeEntreeF = $modeEntreeF;
    }

    function setRefMotifArrivee($refMotifArrivee) {
        $this->refMotifArrivee = $refMotifArrivee;
    }

}
