<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind156
{
    /**
     * @var integer
     */
    private $id156;
//
//    private $bilanSocialConsolide;
//
//    private $refCategorie;
//
//    /**
//     * @var integer
//     */
//    private $r1561;
//
//    /**
//     * @var integer
//     */
//    private $r1562;
//
//

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


    function getId156() {
        return $this->id156;
    }
//
//    function getBilanSocialConsolide() {
//        return $this->bilanSocialConsolide;
//    }
//
//    function getRefCategorie() {
//        return $this->refCategorie;
//    }
//
//    function getR1561(int $ifNull = null) {
//        return $this->r1561 ?? $ifNull;
//    }
//
//    function getR1562(int $ifNull = null) {
//        return $this->r1562 ?? $ifNull;
//    }
//
//
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

    function setId156($id156) {
        $this->id156 = $id156;
    }
//
//    function setBilanSocialConsolide($bilanSocialConsolide) {
//        $this->bilanSocialConsolide = $bilanSocialConsolide;
//    }
//
//    function setRefCategorie($refCategorie) {
//        $this->refCategorie = $refCategorie;
//    }
//
//    function setR1561($r1561) {
//        $this->r1561 = $r1561;
//    }
//
//    function setR1562($r1562) {
//        $this->r1562 = $r1562;
//    }
//
//
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


