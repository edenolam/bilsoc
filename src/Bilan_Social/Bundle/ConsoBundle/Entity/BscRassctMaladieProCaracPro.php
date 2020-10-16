<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctMaladieProCaracPro {

    /**
     * @var integer
     */
    private $bscRassctMaladieProCaracPro;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $rMp1;

    /**
     * @var integer
     */
    private $rMp2;

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
    private $refMaladieProfessionnelle;

    function getBscRassctMaladieProCaracPro() {
        return $this->bscRassctMaladieProCaracPro;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getRMp1(int $ifNull = null) {
        return $this->rMp1 ?? $ifNull;
    }

    function getRMp2(int $ifNull = null) {
        return $this->rMp2 ?? $ifNull;
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

    function setBscRassctMaladieProCaracPro($bscRassctMaladieProCaracPro) {
        $this->bscRassctMaladieProCaracPro = $bscRassctMaladieProCaracPro;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setRMp1($rMp1) {
        $this->rMp1 = $rMp1;
    }

    function setRMp2($rMp2) {
        $this->rMp2 = $rMp2;
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

    function getRefMaladieProfessionnelle() {
        return $this->refMaladieProfessionnelle;
    }

    function setRefMaladieProfessionnelle($refMaladieProfessionnelle) {
        $this->refMaladieProfessionnelle = $refMaladieProfessionnelle;
    }

}
