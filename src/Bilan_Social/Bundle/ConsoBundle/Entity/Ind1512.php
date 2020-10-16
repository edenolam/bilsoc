<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind1512 extends  IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1512;

    protected $bilanSocialConsolide;

    protected $refEmploiFonctionnel;

    /**
     * @var integer
     */
    protected $r15121;

    /**
     * @var integer
     */
    protected $r15122;

    /**
     * @var integer
     */
    protected $r15123;

    /**
     * @var integer
     */
    protected $r15124;

    /**
     * @var integer
     */
    protected $r15125;

    /**
     * @var integer
     */
    protected $r15126;

    /**
     * @var integer
     */
    protected $r15127;

    /**
     * @var integer
     */
    protected $r15128;
    protected $r15129;
    protected $r151210;



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



    function getId1512() {
        return $this->id1512;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefEmploiFonctionnel() {
        return $this->refEmploiFonctionnel;
    }

    function getR15121(int $ifNull = null) {
        return $this->r15121 ?? $ifNull;
    }

    function getR15122(int $ifNull = null) {
        return $this->r15122 ?? $ifNull;
    }

    function getR15123(int $ifNull = null) {
        return $this->r15123 ?? $ifNull;
    }

    function getR15124(int $ifNull = null) {
        return $this->r15124 ?? $ifNull;
    }

    function getR15125(int $ifNull = null) {
        return $this->r15125 ?? $ifNull;
    }

    function getR15126(int $ifNull = null) {
        return $this->r15126 ?? $ifNull;
    }

    function getR15127(int $ifNull = null) {
        return $this->r15127 ?? $ifNull;
    }

    function getR15128(int $ifNull = null) {
        return $this->r15128 ?? $ifNull;
    }

    function getR15129(int $ifNull = null) {
        return $this->r15129 ?? $ifNull;
    }

    function getR151210(int $ifNull = null) {
        return $this->r151210 ?? $ifNull;
    }

    function setR15129($r15129) {
        $this->r15129 = $r15129;
    }

    function setR151210($r151210) {
        $this->r151210 = $r151210;
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

    function setId1512($id1512) {
        $this->id1512 = $id1512;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefEmploiFonctionnel($refEmploiFonctionnel) {
        $this->refEmploiFonctionnel = $refEmploiFonctionnel;
    }

    function setR15121($r15121) {
        $this->r15121 = $r15121;
    }

    function setR15122($r15122) {
        $this->r15122 = $r15122;
    }

    function setR15123($r15123) {
        $this->r15123 = $r15123;
    }

    function setR15124($r15124) {
        $this->r15124 = $r15124;
    }

    function setR15125($r15125) {
        $this->r15125 = $r15125;
    }

    function setR15126($r15126) {
        $this->r15126 = $r15126;
    }

    function setR15127($r15127) {
        $this->r15127 = $r15127;
    }

    function setR15128($r15128) {
        $this->r15128 = $r15128;
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



}
