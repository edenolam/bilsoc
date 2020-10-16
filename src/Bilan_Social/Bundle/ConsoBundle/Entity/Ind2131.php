<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2131 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id2131;

    /**
     * @var integer
     */
    protected $refMotifAbsence;

    protected $bilanSocialConsolide;

    protected $nbRowspan;

    /**
     * @var integer
     */
    protected $r21311;

    /**
     * @var integer
     */
    protected $r21312;

    /**
     * @var integer
     */
    protected $r21313;

    /**
     * @var integer
     */
    protected $r21314;

    /**
     * @var integer
     */
    protected $r21315;

    /**
     * @var integer
     */
    protected $r21316;



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

    function getId2131() {
        return $this->id2131;
    }

    function getRefMotifAbsence() {
        return $this->refMotifAbsence;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR21311(int $ifNull = null) {
        return $this->r21311 ?? $ifNull;
    }

    function getR21312(int $ifNull = null) {
        return $this->r21312 ?? $ifNull;
    }

    function getR21313(int $ifNull = null) {
        return $this->r21313 ?? $ifNull;
    }

    function getR21314(int $ifNull = null) {
        return $this->r21314 ?? $ifNull;
    }

    function getR21315(int $ifNull = null) {
        return $this->r21315 ?? $ifNull;
    }

    function getR21316(int $ifNull = null) {
        return $this->r21316 ?? $ifNull;
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

    function setId2131($id2131) {
        $this->id2131 = $id2131;
    }

    function setRefMotifAbsence($refMotifAbsence) {
        $this->refMotifAbsence = $refMotifAbsence;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR21311($r21311) {
        $this->r21311 = $r21311;
    }

    function setR21312($r21312) {
        $this->r21312 = $r21312;
    }

    function setR21313($r21313) {
        $this->r21313 = $r21313;
    }

    function setR21314($r21314) {
        $this->r21314 = $r21314;
    }

    function setR21315($r21315) {
        $this->r21315 = $r21315;
    }

    function setR21316($r21316) {
        $this->r21316 = $r21316;
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

    function getNbRowspan() {
        return $this->nbRowspan;
    }

    function setNbRowspan($nbRowspan) {
        $this->nbRowspan = $nbRowspan;
    }



}
