<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialAvisInaptitudes {

    /**
     * @var integer
     */
    private $idBscHanditorialAvisInaptitudes;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $avisInaptitudeH;

    /**
     * @var integer
     */
    private $avisInaptitudeF;

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
    private $refInaptitudeBoeth;

    function getIdBscHanditorialAvisInaptitudes() {
        return $this->idBscHanditorialAvisInaptitudes;
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

    function setIdBscHanditorialAvisInaptitudes($idBscHanditorialAvisInaptitudes) {
        $this->idBscHanditorialAvisInaptitudes = $idBscHanditorialAvisInaptitudes;
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

    function getAvisInaptitudeH(int $ifNull = null) {
        return $this->avisInaptitudeH ?? $ifNull;
    }

    function getAvisInaptitudeF(int $ifNull = null) {
        return $this->avisInaptitudeF ?? $ifNull;
    }

    function getRefInaptitudeBoeth() {
        return $this->refInaptitudeBoeth;
    }

    function setAvisInaptitudeH($avisInaptitudeH) {
        $this->avisInaptitudeH = $avisInaptitudeH;
    }

    function setAvisInaptitudeF($avisInaptitudeF) {
        $this->avisInaptitudeF = $avisInaptitudeF;
    }

    function setRefInaptitudeBoeth($refInaptitudeBoeth) {
        $this->refInaptitudeBoeth = $refInaptitudeBoeth;
    }

}
