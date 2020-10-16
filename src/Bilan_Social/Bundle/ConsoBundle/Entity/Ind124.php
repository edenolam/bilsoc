<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind124 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id124;

    protected $bilanSocialConsolide;

    protected $refFiliere;

    protected $refCategorie;


    /**
     * @var integer
     */
    protected $r1243;

    /**
     * @var integer
     */
    protected $r1244;

    protected $totalFilInd121;



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


    function getId124() {
        return $this->id124;
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

    function getR1243(int $ifNull = null) {
        return $this->r1243 ?? $ifNull;
    }

    function getR1244(int $ifNull = null) {
        return $this->r1244 ?? $ifNull;
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

    function setId124($id124) {
        $this->id124 = $id124;
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

    function setR1243($r1243) {
        $this->r1243 = $r1243;
    }

    function setR1244($r1244) {
        $this->r1244 = $r1244;
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

    function getTotalFilInd121() {
        return $this->totalFilInd121;
    }

    function setTotalFilInd121($totalFilInd121) {
        $this->totalFilInd121 = $totalFilInd121;
    }




}
