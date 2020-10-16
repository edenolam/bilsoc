<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind171 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id171;

    protected $bilanSocialConsolide;

    protected $refTrancheAge;

    protected $fgGenr;

    protected $nbRowspan;


    protected $lastGenre;

    /**
     * @var integer
     */
    protected $r1711;

    /**
     * @var integer
     */
    protected $r1712;

    /**
     * @var integer
     */
    protected $r1713;



    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
     * @var string
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


    function getId171() {
        return $this->id171;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefTrancheAge() {
        return $this->refTrancheAge;
    }

    function getFgGenr() {
        return $this->fgGenr;
    }

    function getR1711(int $ifNull = null) {
        return $this->r1711 ?? $ifNull;
    }

    function getR1712(int $ifNull = null) {
        return $this->r1712 ?? $ifNull;
    }

    function getR1713(int $ifNull = null) {
        return $this->r1713 ?? $ifNull;
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

    function setId171($id171) {
        $this->id171 = $id171;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefTrancheAge($refTrancheAge) {
        $this->refTrancheAge = $refTrancheAge;
    }

    function setFgGenr($fgGenr) {
        $this->fgGenr = $fgGenr;
    }

    function setR1711($r1711) {
        $this->r1711 = $r1711;
    }

    function setR1712($r1712) {
        $this->r1712 = $r1712;
    }

    function setR1713($r1713) {
        $this->r1713 = $r1713;
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

    function getNbRowspan() {
        return $this->nbRowspan;
    }

    function setNbRowspan($nbRowspan) {
        $this->nbRowspan = $nbRowspan;
    }

    function getLastGenre() {
        return $this->lastGenre;
    }

    function setLastGenre($lastGenre) {
        $this->lastGenre = $lastGenre;
    }


}
