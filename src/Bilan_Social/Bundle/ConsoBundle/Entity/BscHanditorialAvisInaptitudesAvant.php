<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialAvisInaptitudesAvant {

    /**
     * @var integer
     */
    private $idBscHanditorialAvisInaptitudesAvant;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $avisInaptitudeAvantH;

    /**
     * @var integer
     */
    private $avisInaptitudeAvantF;

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

    function getIdBscHanditorialAvisInaptitudesAvant() {
        return $this->idBscHanditorialAvisInaptitudesAvant;
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

    function setIdBscHanditorialAvisInaptitudesAvant($idBscHanditorialAvisInaptitudesAvant) {
        $this->idBscHanditorialAvisInaptitudesAvant = $idBscHanditorialAvisInaptitudesAvant;
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

    function getRefInaptitudeBoeth() {
        return $this->refInaptitudeBoeth;
    }

    function setRefInaptitudeBoeth($refInaptitudeBoeth) {
        $this->refInaptitudeBoeth = $refInaptitudeBoeth;
    }

    function getAvisInaptitudeAvantH(int $ifNull = null) {
        return $this->avisInaptitudeAvantH ?? $ifNull;
    }

    function getAvisInaptitudeAvantF(int $ifNull = null) {
        return $this->avisInaptitudeAvantF ?? $ifNull;
    }

    function setAvisInaptitudeAvantH($avisInaptitudeAvantH) {
        $this->avisInaptitudeAvantH = $avisInaptitudeAvantH;
    }

    function setAvisInaptitudeAvantF($avisInaptitudeAvantF) {
        $this->avisInaptitudeAvantF = $avisInaptitudeAvantF;
    }

}
