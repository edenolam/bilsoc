<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2122
{
    /**
     * @var integer
     */
    private $id2122;

    /**
     * @var integer
     */
    private $refMotifAbsence;

    private $bilanSocialConsolide;

    private $nbRowspan;

    /**
     * @var integer
     */
    private $r21221;

    /**
     * @var integer
     */
    private $r21222;

    /**
     * @var integer
     */
    private $r21223;

    /**
     * @var integer
     */
    private $r21224;

    /**
     * @var integer
     */
    private $r21225;

    /**
     * @var integer
     */
    private $r21226;
    /**
     * @var integer
     */
    private $r21227;
    /**
     * @var integer
     */
    private $r21228;
    /**
     * @var integer
     */
    private $r21229;
    /**
     * @var integer
     */
    private $r212210;

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

    function getId2122() {
        return $this->id2122;
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

    function getR21221(int $ifNull = null) {
        return $this->r21221 ?? $ifNull;
    }

    function getR21222(int $ifNull = null) {
        return $this->r21222 ?? $ifNull;
    }

    function getR21223(int $ifNull = null) {
        return $this->r21223 ?? $ifNull;
    }

    function getR21224(int $ifNull = null) {
        return $this->r21224 ?? $ifNull;
    }

    function getR21225(int $ifNull = null) {
        return $this->r21225 ?? $ifNull;
    }

    function getR21226(int $ifNull = null) {
        return $this->r21226 ?? $ifNull;
    }

    function getR21227(int $ifNull = null) {
        return $this->r21227 ?? $ifNull;
    }

    function getR21228(int $ifNull = null) {
        return $this->r21228 ?? $ifNull;
    }

    function getR21229(int $ifNull = null) {
        return $this->r21229 ?? $ifNull;
    }

    function getR212210(int $ifNull = null) {
        return $this->r212210 ?? $ifNull;
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

    function setId2122($id2122) {
        $this->id2122 = $id2122;
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

    function setR21221($r21221) {
        $this->r21221 = $r21221;
    }

    function setR21222($r21222) {
        $this->r21222 = $r21222;
    }

    function setR21223($r21223) {
        $this->r21223 = $r21223;
    }

    function setR21224($r21224) {
        $this->r21224 = $r21224;
    }

    function setR21225($r21225) {
        $this->r21225 = $r21225;
    }

    function setR21226($r21226) {
        $this->r21226 = $r21226;
    }

    function setR21227($r21227) {
        $this->r21227 = $r21227;
    }

    function setR21228($r21228) {
        $this->r21228 = $r21228;
    }

    function setR21229($r21229) {
        $this->r21229 = $r21229;
    }

    function setR212210($r212210) {
        $this->r212210 = $r212210;
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
