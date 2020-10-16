<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2132
{
    /**
     * @var integer
     */
    private $id2132;

    /**
     * @var integer
     */
    private $refMotifAbsence;

    private $bilanSocialConsolide;

    private $nbRowspan;

    /**
     * @var integer
     */
    private $r21321;

    /**
     * @var integer
     */
    private $r21322;

    /**
     * @var integer
     */
    private $r21323;

    /**
     * @var integer
     */
    private $r21324;

    /**
     * @var integer
     */
    private $r21325;

    /**
     * @var integer
     */
    private $r21326;
    /**
     * @var integer
     */
    private $r21327;
    /**
     * @var integer
     */
    private $r21328;
    /**
     * @var integer
     */
    private $r21329;
    /**
     * @var integer
     */
    private $r213210;

    private $total2131;



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

    function getId2132() {
        return $this->id2132;
    }

    function getRefMotifAbsence() {
        return $this->refMotifAbsence;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getNbRowspan() {
        return $this->nbRowspan;
    }

    function getR21321(int $ifNull = null) {
        return $this->r21321 ?? $ifNull;
    }

    function getR21322(int $ifNull = null) {
        return $this->r21322 ?? $ifNull;
    }

    function getR21323(int $ifNull = null) {
        return $this->r21323 ?? $ifNull;
    }

    function getR21324(int $ifNull = null) {
        return $this->r21324 ?? $ifNull;
    }

    function getR21325(int $ifNull = null) {
        return $this->r21325 ?? $ifNull;
    }

    function getR21326(int $ifNull = null) {
        return $this->r21326 ?? $ifNull;
    }

    function getR21327(int $ifNull = null) {
        return $this->r21327 ?? $ifNull;
    }

    function getR21328(int $ifNull = null) {
        return $this->r21328 ?? $ifNull;
    }

    function getR21329(int $ifNull = null) {
        return $this->r21329 ?? $ifNull;
    }

    function getR213210(int $ifNull = null) {
        return $this->r213210 ?? $ifNull;
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

    function setId2132($id2132) {
        $this->id2132 = $id2132;
    }

    function setRefMotifAbsence($refMotifAbsence) {
        $this->refMotifAbsence = $refMotifAbsence;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setNbRowspan($nbRowspan) {
        $this->nbRowspan = $nbRowspan;
    }

    function setR21321($r21321) {
        $this->r21321 = $r21321;
    }

    function setR21322($r21322) {
        $this->r21322 = $r21322;
    }

    function setR21323($r21323) {
        $this->r21323 = $r21323;
    }

    function setR21324($r21324) {
        $this->r21324 = $r21324;
    }

    function setR21325($r21325) {
        $this->r21325 = $r21325;
    }

    function setR21326($r21326) {
        $this->r21326 = $r21326;
    }

    function setR21327($r21327) {
        $this->r21327 = $r21327;
    }

    function setR21328($r21328) {
        $this->r21328 = $r21328;
    }

    function setR21329($r21329) {
        $this->r21329 = $r21329;
    }

    function setR213210($r213210) {
        $this->r213210 = $r213210;
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

    function getTotal2131() {
        return $this->total2131;
    }

    function setTotal2131($total2131) {
        $this->total2131 = $total2131;
    }




}
