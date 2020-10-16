<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialAncienneteAgents {

    /**
     * @var integer
     */
    private $idBscHanditorialAncienneteAgents;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $moinsUnAnH;

    /**
     * @var integer
     */
    private $moinsUnAnF;

    /**
     * @var integer
     */
    private $entreUnEtTroisH;

    /**
     * @var integer
     */
    private $entreUnEtTroisF;

    /**
     * @var integer
     */
    private $entreQuatreEtSixH;

    /**
     * @var integer
     */
    private $entreQuatreEtSixF;

    /**
     * @var integer
     */
    private $entreSeptEtDouzeH;

    /**
     * @var integer
     */
    private $entreSeptEtDouzeF;

    /**
     * @var integer
     */
    private $plusDouzeH;

    /**
     * @var integer
     */
    private $plusDouzeF;

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

    function getIdBscHanditorialAncienneteAgents() {
        return $this->idBscHanditorialAncienneteAgents;
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

    function setIdBscHanditorialAncienneteAgents($idBscHanditorialAncienneteAgents) {
        $this->idBscHanditorialAncienneteAgents = $idBscHanditorialAncienneteAgents;
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

    function getMoinsUnAnH(int $ifNull = null) {
        return $this->moinsUnAnH ?? $ifNull;
    }

    function getMoinsUnAnF(int $ifNull = null) {
        return $this->moinsUnAnF ?? $ifNull;
    }

    function getEntreUnEtTroisH(int $ifNull = null) {
        return $this->entreUnEtTroisH ?? $ifNull;
    }

    function getEntreUnEtTroisF(int $ifNull = null) {
        return $this->entreUnEtTroisF ?? $ifNull;
    }

    function getEntreQuatreEtSixH(int $ifNull = null) {
        return $this->entreQuatreEtSixH ?? $ifNull;
    }

    function getEntreQuatreEtSixF(int $ifNull = null) {
        return $this->entreQuatreEtSixF ?? $ifNull;
    }

    function getEntreSeptEtDouzeH(int $ifNull = null) {
        return $this->entreSeptEtDouzeH ?? $ifNull;
    }

    function getEntreSeptEtDouzeF(int $ifNull = null) {
        return $this->entreSeptEtDouzeF ?? $ifNull;
    }

    function getPlusDouzeH(int $ifNull = null) {
        return $this->plusDouzeH ?? $ifNull;
    }

    function getPlusDouzeF(int $ifNull = null) {
        return $this->plusDouzeF ?? $ifNull;
    }

    function setMoinsUnAnH($moinsUnAnH) {
        $this->moinsUnAnH = $moinsUnAnH;
    }

    function setMoinsUnAnF($moinsUnAnF) {
        $this->moinsUnAnF = $moinsUnAnF;
    }

    function setEntreUnEtTroisH($entreUnEtTroisH) {
        $this->entreUnEtTroisH = $entreUnEtTroisH;
    }

    function setEntreUnEtTroisF($entreUnEtTroisF) {
        $this->entreUnEtTroisF = $entreUnEtTroisF;
    }

    function setEntreQuatreEtSixH($entreQuatreEtSixH) {
        $this->entreQuatreEtSixH = $entreQuatreEtSixH;
    }

    function setEntreQuatreEtSixF($entreQuatreEtSixF) {
        $this->entreQuatreEtSixF = $entreQuatreEtSixF;
    }

    function setEntreSeptEtDouzeH($entreSeptEtDouzeH) {
        $this->entreSeptEtDouzeH = $entreSeptEtDouzeH;
    }

    function setEntreSeptEtDouzeF($entreSeptEtDouzeF) {
        $this->entreSeptEtDouzeF = $entreSeptEtDouzeF;
    }

    function setPlusDouzeH($plusDouzeH) {
        $this->plusDouzeH = $plusDouzeH;
    }

    function setPlusDouzeF($plusDouzeF) {
        $this->plusDouzeF = $plusDouzeF;
    }

}
