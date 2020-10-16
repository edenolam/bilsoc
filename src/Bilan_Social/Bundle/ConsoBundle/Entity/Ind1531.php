<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind1531 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1531;

    protected $bilanSocialConsolide;

    protected $refMotifArrivee;


    /**
     * @var integer
     */
    protected $r15311;

    /**
     * @var integer
     */
    protected $r15312;

    /**
     * @var integer
     */
    protected $r15313;

    /**
     * @var integer
     */
    protected $r15314;




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



    function getId1531() {
        return $this->id1531;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefMotifArrivee() {
        return $this->refMotifArrivee;
    }

    function getR15311(int $ifNull = null) {
        return $this->r15311 ?? $ifNull;
    }

    function getR15312(int $ifNull = null) {
        return $this->r15312 ?? $ifNull;
    }

    function getR15313(int $ifNull = null) {
        return $this->r15313 ?? $ifNull;
    }

    function getR15314(int $ifNull = null) {
        return $this->r15314 ?? $ifNull;
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

    function setId1531($id1531) {
        $this->id1531 = $id1531;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefMotifArrivee($refMotifArrivee) {
        $this->refMotifArrivee = $refMotifArrivee;
    }

    function setR15311($r15311) {
        $this->r15311 = $r15311;
    }

    function setR15312($r15312) {
        $this->r15312 = $r15312;
    }

    function setR15313($r15313) {
        $this->r15313 = $r15313;
    }

    function setR15314($r15314) {
        $this->r15314 = $r15314;
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



}


