<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind5111 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id5111;

    protected $bilanSocialConsolide;

    protected $refCategorie;


    /**
     * @var integer
     */
    protected $r51111;

    /**
     * @var integer
     */
    protected $r51112;
    /**
     * @var integer
     */
    protected $r51113;
    /**
     * @var integer
     */
    protected $r51114;


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


    function getId5111() {
        return $this->id5111;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getR51111(int $ifNull = null) {
        return $this->r51111 ?? $ifNull;
    }

    function getR51112(int $ifNull = null) {
        return $this->r51112 ?? $ifNull;
    }

    function getR51113(int $ifNull = null) {
        return $this->r51113 ?? $ifNull;
    }

    function getR51114(int $ifNull = null) {
        return $this->r51114 ?? $ifNull;
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

    function setId5111($id5111) {
        $this->id5111 = $id5111;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setR51111($r51111) {
        $this->r51111 = $r51111;
    }

    function setR51112($r51112) {
        $this->r51112 = $r51112;
    }

    function setR51113($r51113) {
        $this->r51113 = $r51113;
    }

    function setR51114($r51114) {
        $this->r51114 = $r51114;
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
