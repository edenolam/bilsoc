<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialNatureHandicaps {

    /**
     * @var integer
     */
    private $idBscHanditorialNatureHandicaps;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $natureHandicapH;

    /**
     * @var integer
     */
    private $natureHandicapF;

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
    private $refNatureHandicapBoeth;

    function getIdBscHanditorialNatureHandicaps() {
        return $this->idBscHanditorialNatureHandicaps;
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

    function setIdBscHanditorialNatureHandicaps($idBscHanditorialNatureHandicaps) {
        $this->idBscHanditorialNatureHandicaps = $idBscHanditorialNatureHandicaps;
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

    function getNatureHandicapH(int $ifNull = null) {
        return $this->natureHandicapH ?? $ifNull;
    }

    function getNatureHandicapF(int $ifNull = null) {
        return $this->natureHandicapF ?? $ifNull;
    }

    function getRefNatureHandicapBoeth() {
        return $this->refNatureHandicapBoeth;
    }

    function setNatureHandicapH($natureHandicapH) {
        $this->natureHandicapH = $natureHandicapH;
    }

    function setNatureHandicapF($natureHandicapF) {
        $this->natureHandicapF = $natureHandicapF;
    }

    function setRefNatureHandicapBoeth($refNatureHandicapBoeth) {
        $this->refNatureHandicapBoeth = $refNatureHandicapBoeth;
    }

}
