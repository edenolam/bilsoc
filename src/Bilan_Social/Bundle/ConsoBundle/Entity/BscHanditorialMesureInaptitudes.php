<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialMesureInaptitudes {

    /**
     * @var integer
     */
    private $idBscHanditorialMesureInaptitudes;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $mesureInaptitudeH;

    /**
     * @var integer
     */
    private $mesureInaptitudeF;

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
    private $refMesureBoeth;

    function getIdBscHanditorialMesureInaptitudes() {
        return $this->idBscHanditorialMesureInaptitudes;
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

    function setIdBscHanditorialMesureInaptitudes($idBscHanditorialMesureInaptitudes) {
        $this->idBscHanditorialMesureInaptitudes = $idBscHanditorialMesureInaptitudes;
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

    function getMesureInaptitudeH(int $ifNull = null) {
        return $this->mesureInaptitudeH ?? $ifNull;
    }

    function getMesureInaptitudeF(int $ifNull = null) {
        return $this->mesureInaptitudeF ?? $ifNull;
    }

    function getRefMesureBoeth() {
        return $this->refMesureBoeth;
    }

    function setMesureInaptitudeH($mesureInaptitudeH) {
        $this->mesureInaptitudeH = $mesureInaptitudeH;
    }

    function setMesureInaptitudeF($mesureInaptitudeF) {
        $this->mesureInaptitudeF = $mesureInaptitudeF;
    }

    function setRefMesureBoeth($refMesureBoeth) {
        $this->refMesureBoeth = $refMesureBoeth;
    }

}
