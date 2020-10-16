<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2111 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id2111;

    /**
     * @var integer
     */
    protected $refMotifAbsence;

    protected $bilanSocialConsolide;

    protected $nbRowspan;

    /**
     * @var integer
     */
    protected $r21111;

    /**
     * @var integer
     */
    protected $r21112;

    /**
     * @var integer
     */
    protected $r21113;

    /**
     * @var integer
     */
    protected $r21114;

    /**
     * @var integer
     */
    protected $r21115;

    /**
     * @var integer
     */
    protected $r21116;


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

    function getId2111() {
        return $this->id2111;
    }

    function getRefMotifAbsence() {
        return $this->refMotifAbsence;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR21111(int $ifNull = null) {
        return $this->r21111 ?? $ifNull;
    }

    function getR21112(int $ifNull = null) {
        return $this->r21112 ?? $ifNull;
    }

    function getR21113(int $ifNull = null) {
        return $this->r21113 ?? $ifNull;
    }

    function getR21114(int $ifNull = null) {
        return $this->r21114 ?? $ifNull;
    }

    function getR21115(int $ifNull = null) {
        return $this->r21115 ?? $ifNull;
    }

    function getR21116(int $ifNull = null) {
        return $this->r21116 ?? $ifNull;
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

    function setId2111($id2111) {
        $this->id2111 = $id2111;
    }

    function setRefMotifAbsence($refMotifAbsence) {
        $this->refMotifAbsence = $refMotifAbsence;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR21111($r21111) {
        $this->r21111 = $r21111;
    }

    function setR21112($r21112) {
        $this->r21112 = $r21112;
    }

    function setR21113($r21113) {
        $this->r21113 = $r21113;
    }

    function setR21114($r21114) {
        $this->r21114 = $r21114;
    }

    function setR21115($r21115) {
        $this->r21115 = $r21115;
    }

    function setR21116($r21116) {
        $this->r21116 = $r21116;
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
