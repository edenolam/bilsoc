<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind1532 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1532;

    protected $bilanSocialConsolide;
    protected $totalParFiliere;
    protected $refCadreEmploi;

    /**
     * @var integer
     */
    protected $r15321;

    /**
     * @var integer
     */
    protected $r15322;

    /**
     * @var integer
     */
    protected $r15323;

    /**
     * @var integer
     */
    protected $r15324;


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
            $this->r15321 = 0;
            $this->r15322 = 0;
            $this->r15323 = 0;
            $this->r15324 = 0;
        }
    }

    public function cumulR1532x($r1532xField) {
        $this->r15321 += $r1532xField->getR15321(0);
        $this->r15322 += $r1532xField->getR15322(0);
        $this->r15323 += $r1532xField->getR15323(0);
        $this->r15324 += $r1532xField->getR15324(0);
        return $this;
    }


    function getId1532() {
        return $this->id1532;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getR15321(int $ifNull = null) {
        return $this->r15321 ?? $ifNull;
    }

    function getR15322(int $ifNull = null) {
        return $this->r15322 ?? $ifNull;
    }

    function getR15323(int $ifNull = null) {
        return $this->r15323 ?? $ifNull;
    }

    function getR15324(int $ifNull = null) {
        return $this->r15324 ?? $ifNull;
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

    function setId1532($id1532) {
        $this->id1532 = $id1532;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setR15321($r15321) {
        $this->r15321 = $r15321;
    }

    function setR15322($r15322) {
        $this->r15322 = $r15322;
    }

    function setR15323($r15323) {
        $this->r15323 = $r15323;
    }

    function setR15324($r15324) {
        $this->r15324 = $r15324;
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
        return $this->totalParFiliere + $this->r15321 + $this->r15322 + $this->r15323 + $this->r15324;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
