<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind154
{
    /**
     * @var integer
     */
    private $id154;

    private $bilanSocialConsolide;

    private $refStageTitularisation;

    /**
     * @var integer
     */
    private $r1541;

    /**
     * @var integer
     */
    private $r1542;



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


    function getId154() {
        return $this->id154;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefStageTitularisation() {
        return $this->refStageTitularisation;
    }

    function getR1541(int $ifNull = null) {
        return $this->r1541 ?? $ifNull;
    }

    function getR1542(int $ifNull = null) {
        return $this->r1542 ?? $ifNull;
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

    function setId154($id154) {
        $this->id154 = $id154;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefStageTitularisation($refStageTitularisation) {
        $this->refStageTitularisation = $refStageTitularisation;
    }

    function setR1541($r1541) {
        $this->r1541 = $r1541;
    }

    function setR1542($r1542) {
        $this->r1542 = $r1542;
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


