<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscGpeecNbAgentsTituEmpPermaParFoncEtAge extends IndBaseEntity{

    /**
     * @var integer
     */
    protected $bscGpeecNbAgentsTituEmpPermaParFoncEtAge;
    protected $bilanSocialConsolide;
    protected $totalParFamille;
    protected $refMetier;

    /**
     * @var integer
     */
    protected $rNb1;

    /**
     * @var integer
     */
    protected $rNb2;

    /**
     * @var integer
     */
    protected $rNb3;

    /**
     * @var integer
     */
    protected $rNb4;

    /**
     * @var integer
     */
    protected $rNb5;

    /**
     * @var integer
     */
    protected $rNb6;

    /**
     * @var integer
     */
    protected $rNb7;

    /**
     * @var integer
     */
    protected $rNb8;

    /**
     * @var integer
     */
    protected $rNb9;

    /**
     * @var integer
     */
    protected $rNb10;

    /**
     * @var string
     */
    protected $fgStat;

    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $dtModi;

    /**
     * @var string
     */
    protected $cdUtilmodi;

    public function __construct(bool $isCumulator = false) {
        if ($isCumulator) {
            $this->rNb1 = 0;
            $this->rNb2 = 0;
            $this->rNb3 = 0;
            $this->rNb4 = 0;
            $this->rNb5 = 0;
            $this->rNb6 = 0;
            $this->rNb7 = 0;
            $this->rNb8 = 0;
            $this->rNb9 = 0;
            $this->rNb10 = 0;
        }
    }

    public function cumulRNbx($rNbxField) {
        $this->rNb1 += $rNbxField->getRNb1(0);
        $this->rNb2 += $rNbxField->getRNb2(0);
        $this->rNb3 += $rNbxField->getRNb3(0);
        $this->rNb4 += $rNbxField->getRNb4(0);
        $this->rNb5 += $rNbxField->getRNb5(0);
        $this->rNb6 += $rNbxField->getRNb6(0);
        $this->rNb7 += $rNbxField->getRNb7(0);
        $this->rNb8 += $rNbxField->getRNb8(0);
        $this->rNb9 += $rNbxField->getRNb9(0);
        $this->rNb10 += $rNbxField->getRNb10(0);
        return $this;
    }

    function getBscGpeecNbAgentsTituEmpPermaParFoncEtAge() {
        return $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAge;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefMetier() {
        return $this->refMetier;
    }

    function getRNb1(int $ifNull = null) {
        return $this->rNb1 ?? $ifNull;
    }

    function getRNb2(int $ifNull = null) {
        return $this->rNb2 ?? $ifNull;
    }

    function getRNb3(int $ifNull = null) {
        return $this->rNb3 ?? $ifNull;
    }

    function getRNb4(int $ifNull = null) {
        return $this->rNb4 ?? $ifNull;
    }

    function getRNb5(int $ifNull = null) {
        return $this->rNb5 ?? $ifNull;
    }

    function getRNb6(int $ifNull = null) {
        return $this->rNb6 ?? $ifNull;
    }

    function getRNb7(int $ifNull = null) {
        return $this->rNb7 ?? $ifNull;
    }

    function getRNb8(int $ifNull = null) {
        return $this->rNb8 ?? $ifNull;
    }

    function getRNb9(int $ifNull = null) {
        return $this->rNb9 ?? $ifNull;
    }

    function getRNb10(int $ifNull = null) {
        return $this->rNb10 ?? $ifNull;
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

    function setBscGpeecNbAgentsTituEmpPermaParFoncEtAge($bscGpeecNbAgentsTituEmpPermaParFoncEtAge) {
        $this->bscGpeecNbAgentsTituEmpPermaParFoncEtAge = $bscGpeecNbAgentsTituEmpPermaParFoncEtAge;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefMetier($refMetier) {
        $this->refMetier = $refMetier;
    }

    function setRNb1($rNb1) {
        $this->rNb1 = $rNb1;
    }

    function setRNb2($rNb2) {
        $this->rNb2 = $rNb2;
    }

    function setRNb3($rNb3) {
        $this->rNb3 = $rNb3;
    }

    function setRNb4($rNb4) {
        $this->rNb4 = $rNb4;
    }

    function setRNb5($rNb5) {
        $this->rNb5 = $rNb5;
    }

    function setRNb6($rNb6) {
        $this->rNb6 = $rNb6;
    }

    function setRNb7($rNb7) {
        $this->rNb7 = $rNb7;
    }

    function setRNb8($rNb8) {
        $this->rNb8 = $rNb8;
    }

    function setRNb9($rNb9) {
        $this->rNb9 = $rNb9;
    }

    function setRNb10($rNb10) {
        $this->rNb10 = $rNb10;
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

    function getTotalParFamille() {
        return $this->totalParFamille + $this->rNb1 + $this->rNb2 + $this->rNb3 + $this->rNb4 + $this->rNb5 + $this->rNb6 + $this->rNb7 + $this->rNb8 + $this->rNb9 + $this->rNb10;
    }

    function setTotalParFamille($totalParFamille) {
        $this->totalParFamille = $totalParFamille;
    }

}
