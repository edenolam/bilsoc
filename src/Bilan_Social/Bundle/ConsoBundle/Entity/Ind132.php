<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind132
{
    /**
     * @var integer
     */
    private $id132;

    private $bilanSocialConsolide;

    private $refFiliere;

    /**
     * @var integer
     */
    private $r13211;

    /**
     * @var integer
     */
    private $r13212;

    /**
     * @var integer
     */
    private $r13213;

    /**
     * @var integer
     */
    private $r13214;

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


    function getId132() {
        return $this->id132;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR13211(int $ifNull = null) {
        return $this->r13211 ?? $ifNull;
    }

    function getR13212(int $ifNull = null) {
        return $this->r13212 ?? $ifNull;
    }

    function getR13213(int $ifNull = null) {
        return $this->r13213 ?? $ifNull;
    }

    function getR13214(int $ifNull = null) {
        return $this->r13214 ?? $ifNull;
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

    function setId132($id132) {
        $this->id132 = $id132;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR13211($r13211) {
        $this->r13211 = $r13211;
    }

    function setR13212($r13212) {
        $this->r13212 = $r13212;
    }

    function setR13213($r13213) {
        $this->r13213 = $r13213;
    }

    function setR13214($r13214) {
        $this->r13214 = $r13214;
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

    function getRefFiliere() {
        return $this->refFiliere;
    }

    function setRefFiliere($refFiliere) {
        $this->refFiliere = $refFiliere;
    }

}
