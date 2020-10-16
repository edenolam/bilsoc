<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind1501 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1501;

    protected $bilanSocialConsolide;

    protected $refMotifDepart;

    protected $nbRowspan;

    /**
     * @var integer
     */
    protected $r15011;

    /**
     * @var integer
     */
    protected $r15012;

    /**
     * @var integer
     */
    protected $r15013;

    /**
     * @var integer
     */
    protected $r15014;

    /**
     * @var integer
     */
    protected $r15015;

    /**
     * @var integer
     */
    protected $r15016;
    /**
     * @var integer
     */
    protected $r15017;
    /**
     * @var integer
     */
    protected $r15018;



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



    function getId1501() {
        return $this->id1501;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefMotifDepart() {
        return $this->refMotifDepart;
    }

    function getR15011(int $ifNull = null) {
        return $this->r15011 ?? $ifNull;
    }

    function getR15012(int $ifNull = null) {
        return $this->r15012 ?? $ifNull;
    }

    function getR15013(int $ifNull = null) {
        return $this->r15013 ?? $ifNull;
    }

    function getR15014(int $ifNull = null) {
        return $this->r15014 ?? $ifNull;
    }

    function getR15015(int $ifNull = null) {
        return $this->r15015 ?? $ifNull;
    }

    function getR15016(int $ifNull = null) {
        return $this->r15016 ?? $ifNull;
    }

    function getR15017(int $ifNull = null) {
        return $this->r15017 ?? $ifNull;
    }

    function getR15018(int $ifNull = null) {
        return $this->r15018 ?? $ifNull;
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

    function setId1501($id1501) {
        $this->id1501 = $id1501;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefMotifDepart($refMotifDepart) {
        $this->refMotifDepart = $refMotifDepart;
    }

    function setR15011($r15011) {
        $this->r15011 = $r15011;
    }

    function setR15012($r15012) {
        $this->r15012 = $r15012;
    }

    function setR15013($r15013) {
        $this->r15013 = $r15013;
    }

    function setR15014($r15014) {
        $this->r15014 = $r15014;
    }

    function setR15015($r15015) {
        $this->r15015 = $r15015;
    }

    function setR15016($r15016) {
        $this->r15016 = $r15016;
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


    function setR15017($r15017) {
        $this->r15017 = $r15017;
    }

    function setR15018($r15018) {
        $this->r15018 = $r15018;
    }




}


