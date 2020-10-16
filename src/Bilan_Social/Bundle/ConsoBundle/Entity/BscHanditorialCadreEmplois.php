<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialCadreEmplois {

    /**
     * @var integer
     */
    private $bscHanditorialCadreEmplois;
    private $bilanSocialConsolide;
    private $refCadreEmploi;
    private $totalParFiliere;
    private $cadreEmploiH;
    private $cadreEmploiF;

    /**
     * @var string
     */
    private $fgStat;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
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

    public function __construct(bool $isCumulator = false) {
        if ($isCumulator) {
            $this->cadreEmploiF = 0;
            $this->cadreEmploiH = 0;
        }
    }

    public function cumulCadreEmploi($rNbxField) {
        $this->cadreEmploiF += $rNbxField->getCadreEmploiF(0);
        $this->cadreEmploiH += $rNbxField->getCadreEmploiH(0);
        return $this;
    }

    function getBscHanditorialCadreEmplois() {
        return $this->bscHanditorialCadreEmplois;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
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

    function setBscHanditorialCadreEmplois($bscHanditorialCadreEmplois) {
        $this->bscHanditorialCadreEmplois = $bscHanditorialCadreEmplois;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
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

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getCadreEmploiH(int $ifNull = null) {
        return $this->cadreEmploiH ?? $ifNull;
    }

    function getCadreEmploiF(int $ifNull = null) {
        return $this->cadreEmploiF ?? $ifNull;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setCadreEmploiH($cadreEmploiH) {
        $this->cadreEmploiH = $cadreEmploiH;
    }

    function setCadreEmploiF($cadreEmploiF) {
        $this->cadreEmploiF = $cadreEmploiF;
    }

    function getTotalParFiliere() {
        return $this->totalParFiliere + $this->cadreEmploiF + $this->cadreEmploiH;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
