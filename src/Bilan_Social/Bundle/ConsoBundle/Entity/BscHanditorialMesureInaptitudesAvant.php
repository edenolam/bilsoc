<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialMesureInaptitudesAvant {

    /**
     * @var integer
     */
    private $idBscHanditorialMesureInaptitudesAvant;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $mesureInaptitudeAvantH;

    /**
     * @var integer
     */
    private $mesureInaptitudeAvantF;

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

    function getIdBscHanditorialMesureInaptitudesAvant() {
        return $this->idBscHanditorialMesureInaptitudesAvant;
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

    function setIdBscHanditorialMesureInaptitudesAvant($idBscHanditorialMesureInaptitudesAvant) {
        $this->idBscHanditorialMesureInaptitudesAvant = $idBscHanditorialMesureInaptitudesAvant;
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

    function getRefMesureBoeth() {
        return $this->refMesureBoeth;
    }

    function setRefMesureBoeth($refMesureBoeth) {
        $this->refMesureBoeth = $refMesureBoeth;
    }

    function getMesureInaptitudeAvantH(int $ifNull = null) {
        return $this->mesureInaptitudeAvantH ?? $ifNull;
    }

    function getMesureInaptitudeAvantF(int $ifNull = null) {
        return $this->mesureInaptitudeAvantF ?? $ifNull;
    }

    function setMesureInaptitudeAvantH($mesureInaptitudeAvantH) {
        $this->mesureInaptitudeAvantH = $mesureInaptitudeAvantH;
    }

    function setMesureInaptitudeAvantF($mesureInaptitudeAvantF) {
        $this->mesureInaptitudeAvantF = $mesureInaptitudeAvantF;
    }

}
