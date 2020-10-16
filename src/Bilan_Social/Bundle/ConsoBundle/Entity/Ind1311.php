<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind1311
{
    /**
     * @var integer
     */
    private $id1311;

    private $bilanSocialConsolide;

    private $refEmploiNonPermanent;

    /**
     * @var integer
     */
    private $r13111;

    /**
     * @var integer
     */
    private $r13112;

    /**
     * @var integer
     */
    private $r13113;

    /**
     * @var integer
     */
    private $r13114;

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



    function getId1311() {
        return $this->id1311;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

    function getR13111(int $ifNull = null) {
        return $this->r13111 ?? $ifNull;
    }

    function getR13112(int $ifNull = null) {
        return $this->r13112 ?? $ifNull;
    }

    function getR13113(int $ifNull = null) {
        return $this->r13113 ?? $ifNull;
    }

    function getR13114(int $ifNull = null) {
        return $this->r13114 ?? $ifNull;
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

    function setId1311($id1311) {
        $this->id1311 = $id1311;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefEmploiNonPermanent($refEmploiNonPermanent) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;
    }

    function setR13111($r13111) {
        $this->r13111 = $r13111;
    }

    function setR13112($r13112) {
        $this->r13112 = $r13112;
    }

    function setR13113($r13113) {
        $this->r13113 = $r13113;
    }

    function setR13114($r13114) {
        $this->r13114 = $r13114;
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
