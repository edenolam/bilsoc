<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2113
{
    /**
     * @var integer
     */
    private $id2113;

    /**
     * @var integer
     */
    private $refMotifAbsence;

    private $bilanSocialConsolide;

    private $nbRowspan;

    /**
     * @var integer
     */
    private $r21131;

    /**
     * @var integer
     */
    private $r21132;

    /**
     * @var integer
     */
    private $r21133;

    /**
     * @var integer
     */
    private $r21134;

    /**
     * @var integer
     */
    private $r21135;

    /**
     * @var integer
     */
    private $r21136;
    /**
     * @var integer
     */
    private $r21137;
    /**
     * @var integer
     */
    private $r21138;
    /**
     * @var integer
     */
    private $r21139;
    /**
     * @var integer
     */
    private $r211310;

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

    function getId2113() {
        return $this->id2113;
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

    function getR21131(int $ifNull = null) {
        return $this->r21131 ?? $ifNull;
    }

    function getR21132(int $ifNull = null) {
        return $this->r21132 ?? $ifNull;
    }

    function getR21133(int $ifNull = null) {
        return $this->r21133 ?? $ifNull;
    }

    function getR21134(int $ifNull = null) {
        return $this->r21134 ?? $ifNull;
    }

    function getR21135(int $ifNull = null) {
        return $this->r21135 ?? $ifNull;
    }

    function getR21136(int $ifNull = null) {
        return $this->r21136 ?? $ifNull;
    }

    function getR21137(int $ifNull = null) {
        return $this->r21137 ?? $ifNull;
    }

    function getR21138(int $ifNull = null) {
        return $this->r21138 ?? $ifNull;
    }

    function getR21139(int $ifNull = null) {
        return $this->r21139 ?? $ifNull;
    }

    function getR211310(int $ifNull = null) {
        return $this->r211310 ?? $ifNull;
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

    function setId2113($id2113) {
        $this->id2113 = $id2113;
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

    function setR21131($r21131) {
        $this->r21131 = $r21131;
    }

    function setR21132($r21132) {
        $this->r21132 = $r21132;
    }

    function setR21133($r21133) {
        $this->r21133 = $r21133;
    }

    function setR21134($r21134) {
        $this->r21134 = $r21134;
    }

    function setR21135($r21135) {
        $this->r21135 = $r21135;
    }

    function setR21136($r21136) {
        $this->r21136 = $r21136;
    }

    function setR21137($r21137) {
        $this->r21137 = $r21137;
    }

    function setR21138($r21138) {
        $this->r21138 = $r21138;
    }

    function setR21139($r21139) {
        $this->r21139 = $r21139;
    }

    function setR211310($r211310) {
        $this->r211310 = $r211310;
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
