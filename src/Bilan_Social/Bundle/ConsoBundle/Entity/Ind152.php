<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind152 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id152;

    protected $bilanSocialConsolide;
    protected $totalParFiliere;
    protected $refCadreEmploi;

    /**
     * @var integer
     */
    protected $r1521;

    /**
     * @var integer
     */
    protected $r1522;

    /**
     * @var integer
     */
    protected $r1523;

    /**
     * @var integer
     */
    protected $r1524;

    /**
     * @var integer
     */
    protected $r1525;

    /**
     * @var integer
     */
    protected $r1526;

    /**
     * @var integer
     */
    protected $r1527;

    /**
     * @var integer
     */
    protected $r1528;

    /**
     * @var integer
     */
    protected $r1529;

    /**
     * @var integer
     */
    protected $r15210;

    /**
     * @var integer
     */
    protected $r15211;

    /**
     * @var integer
     */
    protected $r15212;

    /**
     * @var integer
     */
    protected $r15213;

    /**
     * @var integer
     */
    protected $r15214;

    /**
     * @var integer
     */
    protected $r15215;

    /**
     * @var integer
     */
    protected $r15216;

    /**
     * @var integer
     */
    protected $r15217;

    /**
     * @var integer
     */
    protected $r15218;
    /**
     * @var integer
     */
    protected $r15219;
    /**
     * @var integer
     */
    protected $r15220;
    /**
     * @var integer
     */
    protected $r15221;

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
            $this->r1521 = 0;
            $this->r1522 = 0;
            $this->r1523 = 0;
            $this->r1524 = 0;
            $this->r1525 = 0;
            $this->r1526 = 0;
            $this->r1527 = 0;
            $this->r1528 = 0;
            $this->r1529 = 0;
            $this->r15210 = 0;
            $this->r15211 = 0;
            $this->r15212 = 0;
            $this->r15213 = 0;
            $this->r15214 = 0;
            $this->r15215 = 0;
            $this->r15216 = 0;
            $this->r15217 = 0;
            $this->r15218 = 0;
            $this->r15219 = 0;
            $this->r15220 = 0;
            $this->r15221 = 0;
        }
    }

    public function cumulR152x($r152xField) {
        $this->r1521 += $r152xField->getR1521(0);
        $this->r1522 += $r152xField->getR1522(0);
        $this->r1523 += $r152xField->getR1523(0);
        $this->r1524 += $r152xField->getR1524(0);
        $this->r1525 += $r152xField->getR1525(0);
        $this->r1526 += $r152xField->getR1526(0);
        $this->r1527 += $r152xField->getR1527(0);
        $this->r1528 += $r152xField->getR1528(0);
        $this->r1529 += $r152xField->getR1529(0);
        $this->r15210 += $r152xField->getR15210(0);
        $this->r15211 += $r152xField->getR15211(0);
        $this->r15212 += $r152xField->getR15212(0);
        $this->r15213 += $r152xField->getR15213(0);
        $this->r15214 += $r152xField->getR15214(0);
        $this->r15215 += $r152xField->getR15215(0);
        $this->r15216 += $r152xField->getR15216(0);
        $this->r15217 += $r152xField->getR15217(0);
        $this->r15218 += $r152xField->getR15218(0);
        $this->r15219 += $r152xField->getR15219(0);
        $this->r15220 += $r152xField->getR15220(0);
        $this->r15221 += $r152xField->getR15221(0);
        return $this;
    }


    function getId152() {
        return $this->id152;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getR1521(int $ifNull = null) {
        return $this->r1521 ?? $ifNull;
    }

    function getR1522(int $ifNull = null) {
        return $this->r1522 ?? $ifNull;
    }

    function getR1523(int $ifNull = null) {
        return $this->r1523 ?? $ifNull;
    }

    function getR1524(int $ifNull = null) {
        return $this->r1524 ?? $ifNull;
    }

    function getR1525(int $ifNull = null) {
        return $this->r1525 ?? $ifNull;
    }

    function getR1526(int $ifNull = null) {
        return $this->r1526 ?? $ifNull;
    }

    function getR1527(int $ifNull = null) {
        return $this->r1527 ?? $ifNull;
    }

    function getR1528(int $ifNull = null) {
        return $this->r1528 ?? $ifNull;
    }

    function getR1529(int $ifNull = null) {
        return $this->r1529 ?? $ifNull;
    }

    function getR15210(int $ifNull = null) {
        return $this->r15210 ?? $ifNull;
    }

    function getR15211(int $ifNull = null) {
        return $this->r15211 ?? $ifNull;
    }

    function getR15212(int $ifNull = null) {
        return $this->r15212 ?? $ifNull;
    }

    function getR15213(int $ifNull = null) {
        return $this->r15213 ?? $ifNull;
    }

    function getR15214(int $ifNull = null) {
        return $this->r15214 ?? $ifNull;
    }

    function getR15215(int $ifNull = null) {
        return $this->r15215 ?? $ifNull;
    }

    function getR15216(int $ifNull = null) {
        return $this->r15216 ?? $ifNull;
    }

    function getR15217(int $ifNull = null) {
        return $this->r15217 ?? $ifNull;
    }

    function getR15218(int $ifNull = null) {
        return $this->r15218 ?? $ifNull;
    }

    function getR15219(int $ifNull = null) {
        return $this->r15219 ?? $ifNull;
    }

    function getR15220(int $ifNull = null) {
        return $this->r15220 ?? $ifNull;
    }

    function getR15221(int $ifNull = null) {
        return $this->r15221 ?? $ifNull;
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

    function setId152($id152) {
        $this->id152 = $id152;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setR1521($r1521) {
        $this->r1521 = $r1521;
    }

    function setR1522($r1522) {
        $this->r1522 = $r1522;
    }

    function setR1523($r1523) {
        $this->r1523 = $r1523;
    }

    function setR1524($r1524) {
        $this->r1524 = $r1524;
    }

    function setR1525($r1525) {
        $this->r1525 = $r1525;
    }

    function setR1526($r1526) {
        $this->r1526 = $r1526;
    }

    function setR1527($r1527) {
        $this->r1527 = $r1527;
    }

    function setR1528($r1528) {
        $this->r1528 = $r1528;
    }

    function setR1529($r1529) {
        $this->r1529 = $r1529;
    }

    function setR15210($r15210) {
        $this->r15210 = $r15210;
    }

    function setR15211($r15211) {
        $this->r15211 = $r15211;
    }

    function setR15212($r15212) {
        $this->r15212 = $r15212;
    }

    function setR15213($r15213) {
        $this->r15213 = $r15213;
    }

    function setR15214($r15214) {
        $this->r15214 = $r15214;
    }

    function setR15215($r15215) {
        $this->r15215 = $r15215;
    }

    function setR15216($r15216) {
        $this->r15216 = $r15216;
    }

    function setR15217($r15217) {
        $this->r15217 = $r15217;
    }

    function setR15218($r15218) {
        $this->r15218 = $r15218;
    }

    function setR15219($r15219) {
        $this->r15219 = $r15219;
    }

    function setR15220($r15220) {
        $this->r15220 = $r15220;
    }
    function setR15221($r15221) {
        $this->r15221 = $r15221;
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
        return $this->totalParFiliere
                //+ $this->r1521 + $this->r1522 + $this->r1523 + $this->r1524 + $this->r1525 + $this->r1526 + $this->r1527 + $this->r1528 +
                //$this->r1529 + $this->r15210 + $this->r15211 + $this->r15212 + $this->r15213 + $this->r15214
                + $this->r15218 + $this->r15219 + $this->r15220 + $this->r15221;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
