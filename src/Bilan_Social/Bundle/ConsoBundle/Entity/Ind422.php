<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind422 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id422;
    protected $totalParFiliere;
    protected $bilanSocialConsolide;

    protected $refCadreEmploi;

    /**
     * @var integer
     */
    protected $r4221;

    /**
     * @var integer
     */
    protected $r4222;

    /**
     * @var integer
     */
    protected $r4223;

    /**
     * @var integer
     */
    protected $r4224;

    /**
     * @var integer
     */
    protected $r4225;

    /**
     * @var integer
     */
    protected $r4226;

    /**
     * @var integer
     */
    protected $r4227;

    /**
     * @var integer
     */
    protected $r4228;


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
            $this->r4221 = 0;
            $this->r4222 = 0;
            $this->r4223 = 0;
            $this->r4224 = 0;
            $this->r4225 = 0;
            $this->r4226 = 0;
            $this->r4227 = 0;
            $this->r4228 = 0;
        }
    }

    public function cumulR422x($r422xField) {
        $this->r4221 += $r422xField->getR4221(0);
        $this->r4222 += $r422xField->getR4222(0);
        $this->r4223 += $r422xField->getR4223(0);
        $this->r4224 += $r422xField->getR4224(0);
        $this->r4225 += $r422xField->getR4225(0);
        $this->r4226 += $r422xField->getR4226(0);
        $this->r4227 += $r422xField->getR4227(0);
        $this->r4228 += $r422xField->getR4228(0);
        return $this;
    }

    public function initR422xToNull() {
        $this->r4221 = null;
        $this->r4222 = null;
        $this->r4223 = null;
        $this->r4224 = null;
        $this->r4225 = null;
        $this->r4226 = null;
        $this->r4227 = null;
        $this->r4228 = null;
    }

    function getId422() {
        return $this->id422;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getR4221(int $ifNull = null) {
        return $this->r4221 ?? $ifNull;
    }

    function getR4222(int $ifNull = null) {
        return $this->r4222 ?? $ifNull;
    }

    function getR4223(int $ifNull = null) {
        return $this->r4223 ?? $ifNull;
    }

    function getR4224(int $ifNull = null) {
        return $this->r4224 ?? $ifNull;
    }

    function getR4225(int $ifNull = null) {
        return $this->r4225 ?? $ifNull;
    }

    function getR4226(int $ifNull = null) {
        return $this->r4226 ?? $ifNull;
    }

    function getR4227(int $ifNull = null) {
        return $this->r4227 ?? $ifNull;
    }

    function getR4228(int $ifNull = null) {
        return $this->r4228 ?? $ifNull;
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

    function setId422($id422) {
        $this->id422 = $id422;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setR4221($r4221) {
        $this->r4221 = $r4221;
    }

    function setR4222($r4222) {
        $this->r4222 = $r4222;
    }

    function setR4223($r4223) {
        $this->r4223 = $r4223;
    }

    function setR4224($r4224) {
        $this->r4224 = $r4224;
    }

    function setR4225($r4225) {
        $this->r4225 = $r4225;
    }

    function setR4226($r4226) {
        $this->r4226 = $r4226;
    }

    function setR4227($r4227) {
        $this->r4227 = $r4227;
    }

    function setR4228($r4228) {
        $this->r4228 = $r4228;
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

    function getTotalParFiliere() {
        return $this->totalParFiliere + $this->r4221 + $this->r4222 + $this->r4223 + $this->r4224;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
