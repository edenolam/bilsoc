<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2121 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id2121;

    /**
     * @var integer
     */
    protected $refMotifAbsence;

    protected $bilanSocialConsolide;

    protected $nbRowspan;

    /**
     * @var integer
     */
    protected $r21211;

    /**
     * @var integer
     */
    protected $r21212;

    /**
     * @var integer
     */
    protected $r21213;

    /**
     * @var integer
     */
    protected $r21214;

    /**
     * @var integer
     */
    protected $r21215;

    /**
     * @var integer
     */
    protected $r21216;



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

    function getId2121() {
        return $this->id2121;
    }

    function getRefMotifAbsence() {
        return $this->refMotifAbsence;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR21211(int $ifNull = null) {
        return $this->r21211 ?? $ifNull;
    }

    function getR21212(int $ifNull = null) {
        return $this->r21212 ?? $ifNull;
    }

    function getR21213(int $ifNull = null) {
        return $this->r21213 ?? $ifNull;
    }

    function getR21214(int $ifNull = null) {
        return $this->r21214 ?? $ifNull;
    }

    function getR21215(int $ifNull = null) {
        return $this->r21215 ?? $ifNull;
    }

    function getR21216(int $ifNull = null) {
        return $this->r21216 ?? $ifNull;
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

    function setId2121($id2121) {
        $this->id2121 = $id2121;
    }

    function setRefMotifAbsence($refMotifAbsence) {
        $this->refMotifAbsence = $refMotifAbsence;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR21211($r21211) {
        $this->r21211 = $r21211;
    }

    function setR21212($r21212) {
        $this->r21212 = $r21212;
    }

    function setR21213($r21213) {
        $this->r21213 = $r21213;
    }

    function setR21214($r21214) {
        $this->r21214 = $r21214;
    }

    function setR21215($r21215) {
        $this->r21215 = $r21215;
    }

    function setR21216($r21216) {
        $this->r21216 = $r21216;
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
