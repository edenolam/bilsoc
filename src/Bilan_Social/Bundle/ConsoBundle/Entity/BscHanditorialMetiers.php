<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialMetiers {

    /**
     * @var integer
     */
    private $bscHanditorialMetiers;
    private $bilanSocialConsolide;
    private $totalParFamille;
    private $refMetier;

    /**
     * @var integer
     */
    private $metierH;

    /**
     * @var integer
     */
    private $metierF;

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
            $this->metierH = 0;
            $this->metierF = 0;
        }
    }

    public function cumulRNbx($rNbxField) {
        $this->metierH += $rNbxField->getMetierH(0);
        $this->metierF += $rNbxField->getMetierF(0);
        return $this;
    }

    function getBscHanditorialMetiers() {
        return $this->bscHanditorialMetiers;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefMetier() {
        return $this->refMetier;
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

    function setBscHanditorialMetiers($bscHanditorialMetiers) {
        $this->bscHanditorialMetiers = $bscHanditorialMetiers;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefMetier($refMetier) {
        $this->refMetier = $refMetier;
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

    function getMetierH(int $ifNull = null) {
        return $this->metierH ?? $ifNull;
    }

    function getMetierF(int $ifNull = null) {
        return $this->metierF ?? $ifNull;
    }

    function setMetierH($metierH) {
        $this->metierH = $metierH;
    }

    function setMetierF($metierF) {
        $this->metierF = $metierF;
    }

    function getTotalParFamille() {
        return $this->totalParFamille + $this->metierF + $this->metierH;
    }

    function setTotalParFamille($totalParFamille) {
        $this->totalParFamille = $totalParFamille;
    }

}
