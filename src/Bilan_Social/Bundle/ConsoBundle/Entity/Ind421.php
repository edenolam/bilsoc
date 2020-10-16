<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind421 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id421;

    protected $totalParFiliere;
    protected $bilanSocialConsolide;

    protected $refCadreEmploi;

    /**
     * @var integer
     */
    protected $r4211;

    /**
     * @var integer
     */
    protected $r4212;

    /**
     * @var integer
     */
    protected $r4213;

    /**
     * @var integer
     */
    protected $r4214;

    /**
     * @var integer
     */
    protected $r4215;

    /**
     * @var integer
     */
    protected $r4216;

    /**
     * @var integer
     */
    protected $r4217;

    /**
     * @var integer
     */
    protected $r4218;

    /**
     * @var integer
     */
    protected $r4219;

    /**
     * @var integer
     */
    protected $r42110;

    /**
     * @var integer
     */
    protected $r42111;

    /**
     * @var integer
     */
    protected $r42112;


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
            $this->r4211 = 0;
            $this->r4212 = 0;
            $this->r4213 = 0;
            $this->r4214 = 0;
            $this->r4215 = 0;
            $this->r4216 = 0;
            $this->r4217 = 0;
            $this->r4218 = 0;
            $this->r4219 = 0;
            $this->r42110 = 0;
            $this->r42111 = 0;
            $this->r42112 = 0;
        }
    }

    public function cumulR421x($r421xField) {
        $this->r4211 += $r421xField->getR4211(0);
        $this->r4212 += $r421xField->getR4212(0);
        $this->r4213 += $r421xField->getR4213(0);
        $this->r4214 += $r421xField->getR4214(0);
        $this->r4215 += $r421xField->getR4215(0);
        $this->r4216 += $r421xField->getR4216(0);
        $this->r4217 += $r421xField->getR4217(0);
        $this->r4218 += $r421xField->getR4218(0);
        $this->r4219 += $r421xField->getR4219(0);
        $this->r42110 += $r421xField->getR42110(0);
        $this->r42111 += $r421xField->getR42111(0);
        $this->r42112 += $r421xField->getR42112(0);
        return $this;
    }

    public function cumulByFiliere421($r421xField) {
        $this->r4211 = $r421xField->getR4211(0);
        $this->r4212 = $r421xField->getR4212(0);
        $this->r4213 = $r421xField->getR4213(0);
        $this->r4214 = $r421xField->getR4214(0);
        $this->r4215 = $r421xField->getR4215(0);
        $this->r4216 = $r421xField->getR4216(0);
        $this->r4217 = $r421xField->getR4217(0);
        $this->r4218 = $r421xField->getR4218(0);
        $this->r4219 = $r421xField->getR4219(0);
        $this->r42110 = $r421xField->getR42110(0);
        $this->r42111 = $r421xField->getR42111(0);
        $this->r42112 = $r421xField->getR42112(0);
        return $this;
    }

    public function initR421xToNull() {
        $this->r4211 = null;
        $this->r4212 = null;
        $this->r4213 = null;
        $this->r4214 = null;
        $this->r4215 = null;
        $this->r4216 = null;
        $this->r4217 = null;
        $this->r4218 = null;
        $this->r4219 = null;
        $this->r42110 = null;
        $this->r42111 = null;
        $this->r42112 = null;
    }

    function getId421() {
        return $this->id421;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getR4211(int $ifNull = null) {
        return $this->r4211 ?? $ifNull;
    }

    function getR4212(int $ifNull = null) {
        return $this->r4212 ?? $ifNull;
    }

    function getR4213(int $ifNull = null) {
        return $this->r4213 ?? $ifNull;
    }

    function getR4214(int $ifNull = null) {
        return $this->r4214 ?? $ifNull;
    }

    function getR4215(int $ifNull = null) {
        return $this->r4215 ?? $ifNull;
    }

    function getR4216(int $ifNull = null) {
        return $this->r4216 ?? $ifNull;
    }

    function getR4217(int $ifNull = null) {
        return $this->r4217 ?? $ifNull;
    }

    function getR4218(int $ifNull = null) {
        return $this->r4218 ?? $ifNull;
    }

    function getR4219(int $ifNull = null) {
        return $this->r4219 ?? $ifNull;
    }

    function getR42110(int $ifNull = null) {
        return $this->r42110 ?? $ifNull;
    }

    function getR42111(int $ifNull = null) {
        return $this->r42111 ?? $ifNull;
    }

    function getR42112(int $ifNull = null) {
        return $this->r42112 ?? $ifNull;
    }

    function setR4219($r4219) {
        $this->r4219 = $r4219;
    }

    function setR42110($r42110) {
        $this->r42110 = $r42110;
    }

    function setR42111($r42111) {
        $this->r42111 = $r42111;
    }

    function setR42112($r42112) {
        $this->r42112 = $r42112;
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

    function setId421($id421) {
        $this->id421 = $id421;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setR4211($r4211) {
        $this->r4211 = $r4211;
    }

    function setR4212($r4212) {
        $this->r4212 = $r4212;
    }

    function setR4213($r4213) {
        $this->r4213 = $r4213;
    }

    function setR4214($r4214) {
        $this->r4214 = $r4214;
    }

    function setR4215($r4215) {
        $this->r4215 = $r4215;
    }

    function setR4216($r4216) {
        $this->r4216 = $r4216;
    }

    function setR4217($r4217) {
        $this->r4217 = $r4217;
    }

    function setR4218($r4218) {
        $this->r4218 = $r4218;
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
        return $this->totalParFiliere + $this->r4211 + $this->r4212 +  $this->r4215 + $this->r4216;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
