<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind1312
{
    /**
     * @var integer
     */
    private $id1312;

    private $bilanSocialConsolide;

    private $refEmploiNonPermanent;

//    /**
//     * @var integer
//     */
//    private $r13121;
//
//    /**
//     * @var integer
//     */
//    private $r13122;

    /**
     * @var integer
     */
    private $r13123;

    /**
     * @var integer
     */
    private $r13124;


    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
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



    function getId1312() {
        return $this->id1312;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

//    function getR13121(int $ifNull = null) {
//        return $this->r13121 ?? $ifNull;
//    }
//
//    function getR13122(int $ifNull = null) {
//        return $this->r13122 ?? $ifNull;
//    }

    function getR13123(int $ifNull = null) {
        return $this->r13123 ?? $ifNull;
    }

    function getR13124(int $ifNull = null) {
        return $this->r13124 ?? $ifNull;
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

    function setId1312($id1312) {
        $this->id1312 = $id1312;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefEmploiNonPermanent($refEmploiNonPermanent) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;
    }

//    function setR13121($r13121) {
//        $this->r13121 = $r13121;
//    }
//
//    function setR13122($r13122) {
//        $this->r13122 = $r13122;
//    }

    function setR13123($r13123) {
        $this->r13123 = $r13123;
    }

    function setR13124($r13124) {
        $this->r13124 = $r13124;
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
