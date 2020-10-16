<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind157
{
    /**
     * @var integer
     */
    private $id157;

    private $bilanSocialConsolide;

    private $refCategorie;

    /**
     * @var integer
     */
    private $r1571;

    /**
     * @var integer
     */
    private $r1572;



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


    function getId157() {
        return $this->id157;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getR1571(int $ifNull = null) {
        return $this->r1571 ?? $ifNull;
    }

    function getR1572(int $ifNull = null) {
        return $this->r1572 ?? $ifNull;
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

    function setId157($id157) {
        $this->id157 = $id157;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setR1571($r1571) {
        $this->r1571 = $r1571;
    }

    function setR1572($r1572) {
        $this->r1572 = $r1572;
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


