<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2123
{
    /**
     * @var integer
     */
    private $id2123;

    /**
     * @var integer
     */
    private $refMotifAbsence;

    private $bilanSocialConsolide;

    private $nbRowspan;

    /**
     * @var integer
     */
    private $r21231;

    /**
     * @var integer
     */
    private $r21232;

    /**
     * @var integer
     */
    private $r21233;

    /**
     * @var integer
     */
    private $r21234;

    /**
     * @var integer
     */
    private $r21235;

    /**
     * @var integer
     */
    private $r21236;
    /**
     * @var integer
     */
    private $r21237;
    /**
     * @var integer
     */
    private $r21238;
    /**
     * @var integer
     */
    private $r21239;
    /**
     * @var integer
     */
    private $r212310;

    private $total2121;


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

    function getId2123() {
        return $this->id2123;
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

    function getR21231(int $ifNull = null) {
        return $this->r21231 ?? $ifNull;
    }

    function getR21232(int $ifNull = null) {
        return $this->r21232 ?? $ifNull;
    }

    function getR21233(int $ifNull = null) {
        return $this->r21233 ?? $ifNull;
    }

    function getR21234(int $ifNull = null) {
        return $this->r21234 ?? $ifNull;
    }

    function getR21235(int $ifNull = null) {
        return $this->r21235 ?? $ifNull;
    }

    function getR21236(int $ifNull = null) {
        return $this->r21236 ?? $ifNull;
    }

    function getR21237(int $ifNull = null) {
        return $this->r21237 ?? $ifNull;
    }

    function getR21238(int $ifNull = null) {
        return $this->r21238 ?? $ifNull;
    }

    function getR21239(int $ifNull = null) {
        return $this->r21239 ?? $ifNull;
    }

    function getR212310(int $ifNull = null) {
        return $this->r212310 ?? $ifNull;
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

    function setId2123($id2123) {
        $this->id2123 = $id2123;
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

    function setR21231($r21231) {
        $this->r21231 = $r21231;
    }

    function setR21232($r21232) {
        $this->r21232 = $r21232;
    }

    function setR21233($r21233) {
        $this->r21233 = $r21233;
    }

    function setR21234($r21234) {
        $this->r21234 = $r21234;
    }

    function setR21235($r21235) {
        $this->r21235 = $r21235;
    }

    function setR21236($r21236) {
        $this->r21236 = $r21236;
    }

    function setR21237($r21237) {
        $this->r21237 = $r21237;
    }

    function setR21238($r21238) {
        $this->r21238 = $r21238;
    }

    function setR21239($r21239) {
        $this->r21239 = $r21239;
    }

    function setR212310($r212310) {
        $this->r212310 = $r212310;
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

    function getTotal2121() {
        return $this->total2121;
    }

    function setTotal2121($total2121) {
        $this->total2121 = $total2121;
    }




}
