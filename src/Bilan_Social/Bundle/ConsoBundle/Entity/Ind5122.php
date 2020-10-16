<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind5122 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id5122;

    protected $bilanSocialConsolide;

    protected $refEmploiNonPermanent;

    /**
     * @var integer
     */
    protected $r51221;

    /**
     * @var integer
     */
    protected $r51222;


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


    function getId5122() {
        return $this->id5122;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR51221(int $ifNull = null) {
        return $this->r51221 ?? $ifNull;
    }

    function getR51222(int $ifNull = null) {
        return $this->r51222 ?? $ifNull;
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

    function setId5122($id5122) {
        $this->id5122 = $id5122;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR51221($r51221) {
        $this->r51221 = $r51221;
    }

    function setR51222($r51222) {
        $this->r51222 = $r51222;
    }

    function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

    function setRefEmploiNonPermanent($refEmploiNonPermanent) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;
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
