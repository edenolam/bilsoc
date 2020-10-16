<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind1511 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1511;

    protected $bilanSocialConsolide;

    protected $refEmploiFonctionnel;

    /**
     * @var integer
     */
    protected $r15111;

    /**
     * @var integer
     */
    protected $r15112;

    /**
     * @var integer
     */
    protected $r15113;

    /**
     * @var integer
     */
    protected $r15114;

    /**
     * @var integer
     */
    protected $r15115;

    /**
     * @var integer
     */
    protected $r15116;

    /**
     * @var integer
     */
    protected $r15117;

    /**
     * @var integer
     */
    protected $r15118;
    protected $r15119;
    protected $r151110;



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



    function getId1511() {
        return $this->id1511;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefEmploiFonctionnel() {
        return $this->refEmploiFonctionnel;
    }

    function getR15111(int $ifNull = null) {
        return $this->r15111 ?? $ifNull;
    }

    function getR15112(int $ifNull = null) {
        return $this->r15112 ?? $ifNull;
    }

    function getR15113(int $ifNull = null) {
        return $this->r15113 ?? $ifNull;
    }

    function getR15114(int $ifNull = null) {
        return $this->r15114 ?? $ifNull;
    }

    function getR15115(int $ifNull = null) {
        return $this->r15115 ?? $ifNull;
    }

    function getR15116(int $ifNull = null) {
        return $this->r15116 ?? $ifNull;
    }

    function getR15117(int $ifNull = null) {
        return $this->r15117 ?? $ifNull;
    }

    function getR15118(int $ifNull = null) {
        return $this->r15118 ?? $ifNull;
    }

    function getR15119(int $ifNull = null) {
        return $this->r15119 ?? $ifNull;
    }

    function getR151110(int $ifNull = null) {
        return $this->r151110 ?? $ifNull;
    }

    function setR15119($r15119) {
        $this->r15119 = $r15119;
    }

    function setR151110($r151110) {
        $this->r151110 = $r151110;
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

    function setId1511($id1511) {
        $this->id1511 = $id1511;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefEmploiFonctionnel($refEmploiFonctionnel) {
        $this->refEmploiFonctionnel = $refEmploiFonctionnel;
    }

    function setR15111($r15111) {
        $this->r15111 = $r15111;
    }

    function setR15112($r15112) {
        $this->r15112 = $r15112;
    }

    function setR15113($r15113) {
        $this->r15113 = $r15113;
    }

    function setR15114($r15114) {
        $this->r15114 = $r15114;
    }

    function setR15115($r15115) {
        $this->r15115 = $r15115;
    }

    function setR15116($r15116) {
        $this->r15116 = $r15116;
    }

    function setR15117($r15117) {
        $this->r15117 = $r15117;
    }

    function setR15118($r15118) {
        $this->r15118 = $r15118;
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
