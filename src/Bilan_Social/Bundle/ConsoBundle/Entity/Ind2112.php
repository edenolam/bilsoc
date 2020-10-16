<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2112
{
    /**
     * @var integer
     */
    private $id2112;

    /**
     * @var integer
     */
    private $refMotifAbsence;

    private $bilanSocialConsolide;

    private $nbRowspan;

    /**
     * @var integer
     */
    private $r21121;

    /**
     * @var integer
     */
    private $r21122;

    /**
     * @var integer
     */
    private $r21123;

    /**
     * @var integer
     */
    private $r21124;

    /**
     * @var integer
     */
    private $r21125;

    /**
     * @var integer
     */
    private $r21126;
    /**
     * @var integer
     */
    private $r21127;
    /**
     * @var integer
     */
    private $r21128;
    /**
     * @var integer
     */
    private $r21129;
    /**
     * @var integer
     */
    private $r211210;


    private $total2111;

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

    function getId2112() {
        return $this->id2112;
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

    function getR21121(int $ifNull = null) {
        return $this->r21121 ?? $ifNull;
    }

    function getR21122(int $ifNull = null) {
        return $this->r21122 ?? $ifNull;
    }

    function getR21123(int $ifNull = null) {
        return $this->r21123 ?? $ifNull;
    }

    function getR21124(int $ifNull = null) {
        return $this->r21124 ?? $ifNull;
    }

    function getR21125(int $ifNull = null) {
        return $this->r21125 ?? $ifNull;
    }

    function getR21126(int $ifNull = null) {
        return $this->r21126 ?? $ifNull;
    }

    function getR21127(int $ifNull = null) {
        return $this->r21127 ?? $ifNull;
    }

    function getR21128(int $ifNull = null) {
        return $this->r21128 ?? $ifNull;
    }

    function getR21129(int $ifNull = null) {
        return $this->r21129 ?? $ifNull;
    }

    function getR211210(int $ifNull = null) {
        return $this->r211210 ?? $ifNull;
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

    function setId2112($id2112) {
        $this->id2112 = $id2112;
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

    function setR21121($r21121) {
        $this->r21121 = $r21121;
    }

    function setR21122($r21122) {
        $this->r21122 = $r21122;
    }

    function setR21123($r21123) {
        $this->r21123 = $r21123;
    }

    function setR21124($r21124) {
        $this->r21124 = $r21124;
    }

    function setR21125($r21125) {
        $this->r21125 = $r21125;
    }

    function setR21126($r21126) {
        $this->r21126 = $r21126;
    }

    function setR21127($r21127) {
        $this->r21127 = $r21127;
    }

    function setR21128($r21128) {
        $this->r21128 = $r21128;
    }

    function setR21129($r21129) {
        $this->r21129 = $r21129;
    }

    function setR211210($r211210) {
        $this->r211210 = $r211210;
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

    function getTotal2111() {
        return $this->total2111;
    }

    function setTotal2111($total2111) {
        $this->total2111 = $total2111;
    }



}
