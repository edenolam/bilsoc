<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind123
{
    /**
     * @var integer
     */
    private $id123;

    private $bilanSocialConsolide;

    private $refCategorie;

    private $totalInd122;

    /**
     * @var string
     */
    private $fgGenr;

    /**
     * @var integer
     */
    private $r1231;

    /**
     * @var integer
     */
    private $r1232;



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



    function getId123() {
        return $this->id123;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getFgGenr() {
        return $this->fgGenr;
    }

    function getR1231(int $ifNull = null) {
        return $this->r1231 ?? $ifNull;
    }

    function getR1232(int $ifNull = null) {
        return $this->r1232 ?? $ifNull;
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

    function setId123($id123) {
        $this->id123 = $id123;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setFgGenr($fgGenr) {
        $this->fgGenr = $fgGenr;
    }

    function setR1231($r1231) {
        $this->r1231 = $r1231;
    }

    function setR1232($r1232) {
        $this->r1232 = $r1232;
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

    function getTotalInd122() {
        return $this->totalInd122;
    }

    function setTotalInd122($totalInd122) {
        $this->totalInd122 = $totalInd122;
    }



}
