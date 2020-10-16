<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind331 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id331;

    protected $bilanSocialConsolide;

    protected $refEmploiNonPermanent;


    /**
     * @var integer
     */
    protected $r3311;

    /**
     * @var integer
     */
    protected $r3312;


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


    function getId331() {
        return $this->id331;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

    function getR3311(int $ifNull = null) {
        return $this->r3311 ?? $ifNull;
    }

    function getR3312(int $ifNull = null) {
        return $this->r3312 ?? $ifNull;
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

    function setId331($id331) {
        $this->id331 = $id331;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefEmploiNonPermanent($refEmploiNonPermanent) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;
    }

    function setR3311($r3311) {
        $this->r3311 = $r3311;
    }

    function setR3312($r3312) {
        $this->r3312 = $r3312;
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
