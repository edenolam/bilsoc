<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2133
{
    /**
     * @var integer
     */
    private $id2133;

    /**
     * @var integer
     */
    private $refMotifAbsence;

    private $bilanSocialConsolide;

    private $nbRowspan;

    /**
     * @var integer
     */
    private $r21331;

    /**
     * @var integer
     */
    private $r21332;

    /**
     * @var integer
     */
    private $r21333;

    /**
     * @var integer
     */
    private $r21334;

    /**
     * @var integer
     */
    private $r21335;

    /**
     * @var integer
     */
    private $r21336;
    /**
     * @var integer
     */
    private $r21337;
    /**
     * @var integer
     */
    private $r21338;
    /**
     * @var integer
     */
    private $r21339;
    /**
     * @var integer
     */
    private $r213310;

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

    function getId2133() {
        return $this->id2133;
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

    function getR21331(int $ifNull = null) {
        return $this->r21331 ?? $ifNull;
    }

    function getR21332(int $ifNull = null) {
        return $this->r21332 ?? $ifNull;
    }

    function getR21333(int $ifNull = null) {
        return $this->r21333 ?? $ifNull;
    }

    function getR21334(int $ifNull = null) {
        return $this->r21334 ?? $ifNull;
    }

    function getR21335(int $ifNull = null) {
        return $this->r21335 ?? $ifNull;
    }

    function getR21336(int $ifNull = null) {
        return $this->r21336 ?? $ifNull;
    }

    function getR21337(int $ifNull = null) {
        return $this->r21337 ?? $ifNull;
    }

    function getR21338(int $ifNull = null) {
        return $this->r21338 ?? $ifNull;
    }

    function getR21339(int $ifNull = null) {
        return $this->r21339 ?? $ifNull;
    }

    function getR213310(int $ifNull = null) {
        return $this->r213310 ?? $ifNull;
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

    function setId2133($id2133) {
        $this->id2133 = $id2133;
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

    function setR21331($r21331) {
        $this->r21331 = $r21331;
    }

    function setR21332($r21332) {
        $this->r21332 = $r21332;
    }

    function setR21333($r21333) {
        $this->r21333 = $r21333;
    }

    function setR21334($r21334) {
        $this->r21334 = $r21334;
    }

    function setR21335($r21335) {
        $this->r21335 = $r21335;
    }

    function setR21336($r21336) {
        $this->r21336 = $r21336;
    }

    function setR21337($r21337) {
        $this->r21337 = $r21337;
    }

    function setR21338($r21338) {
        $this->r21338 = $r21338;
    }

    function setR21339($r21339) {
        $this->r21339 = $r21339;
    }

    function setR213310($r213310) {
        $this->r213310 = $r213310;
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
