<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind423 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id423;

    protected $ind423sFili;

    protected $bilanSocialConsolide;

    protected $refInaptitude;

    /**
     * @var integer
     */
    protected $r4231;


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


    function getId423() {
        return $this->id423;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefInaptitude() {
        return $this->refInaptitude;
    }

    function getR4231(int $ifNull = null) {
        return $this->r4231 ?? $ifNull;
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

    function getInd423sFili() {
        return $this->ind423sFili;
    }

    function setId423($id423) {
        $this->id423 = $id423;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefInaptitude($refInaptitude) {
        $this->refInaptitude = $refInaptitude;
    }

    function setR4231($r4231) {
        $this->r4231 = $r4231;
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

    function setInd423sFili($ind423sFili) {
        $this->ind423sFili = $ind423sFili;
    }


}
