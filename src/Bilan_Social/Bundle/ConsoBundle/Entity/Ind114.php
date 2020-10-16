<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind114 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id114;

    protected $bilanSocialConsolide;

    protected $refFiliere;

    protected $refCategorie;

//    /**
//     * @var integer
//     */
//    protected $r1141;
//
//    /**
//     * @var integer
//     */
//    protected $r1142;

    /**
     * @var integer
     */
    protected $r1143;

    /**
     * @var integer
     */
    protected $r1144;

    protected $totalFilInd111;



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


    function getId114() {
        return $this->id114;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefFiliere() {
        return $this->refFiliere;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

//    function getR1141(int $ifNull = null) {
//        return $this->r1141 ?? $ifNull;
//    }
//
//    function getR1142(int $ifNull = null) {
//        return $this->r1142 ?? $ifNull;
//    }

    function getR1143(int $ifNull = null) {
        return $this->r1143 ?? $ifNull;
    }

    function getR1144(int $ifNull = null) {
        return $this->r1144 ?? $ifNull;
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

    function setId114($id114) {
        $this->id114 = $id114;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefFiliere($refFiliere) {
        $this->refFiliere = $refFiliere;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

//    function setR1141($r1141) {
//        $this->r1141 = $r1141;
//    }
//
//    function setR1142($r1142) {
//        $this->r1142 = $r1142;
//    }

    function setR1143($r1143) {
        $this->r1143 = $r1143;
    }

    function setR1144($r1144) {
        $this->r1144 = $r1144;
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
    function getTotalFilInd111() {
        return $this->totalFilInd111;
    }

    function setTotalFilInd111($totalFilInd111) {
        $this->totalFilInd111 = $totalFilInd111;
    }




}
