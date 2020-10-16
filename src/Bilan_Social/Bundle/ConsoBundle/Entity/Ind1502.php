<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind1502 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1502;

    protected $bilanSocialConsolide;

    protected $refMotifDepart;

    protected $nbRowspan;

    /**
     * @var integer
     */
    protected $r15021;

    /**
     * @var integer
     */
    protected $r15022;

    /**
     * @var integer
     */
    protected $r15023;

    /**
     * @var integer
     */
    protected $r15024;

    /**
     * @var integer
     */
    protected $r15025;

    /**
     * @var integer
     */
    protected $r15026;
    /**
     * @var integer
     */
    protected $r15027;
    /**
     * @var integer
     */
    protected $r15028;



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

    function getId1502() {
        return $this->id1502;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefMotifDepart() {
        return $this->refMotifDepart;
    }

    function getR15021(int $ifNull = null) {
        return $this->r15021 ?? $ifNull;
    }

    function getR15022(int $ifNull = null) {
        return $this->r15022 ?? $ifNull;
    }

    function getR15023(int $ifNull = null) {
        return $this->r15023 ?? $ifNull;
    }

    function getR15024(int $ifNull = null) {
        return $this->r15024 ?? $ifNull;
    }

    function getR15025(int $ifNull = null) {
        return $this->r15025 ?? $ifNull;
    }

    function getR15026(int $ifNull = null) {
        return $this->r15026 ?? $ifNull;
    }

    function getR15027(int $ifNull = null) {
        return $this->r15027 ?? $ifNull;
    }

    function getR15028(int $ifNull = null) {
        return $this->r15028 ?? $ifNull;
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

    function setId1502($id1502) {
        $this->id1502 = $id1502;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefMotifDepart($refMotifDepart) {
        $this->refMotifDepart = $refMotifDepart;
    }

    function setR15021($r15021) {
        $this->r15021 = $r15021;
    }

    function setR15022($r15022) {
        $this->r15022 = $r15022;
    }

    function setR15023($r15023) {
        $this->r15023 = $r15023;
    }

    function setR15024($r15024) {
        $this->r15024 = $r15024;
    }

    function setR15025($r15025) {
        $this->r15025 = $r15025;
    }

    function setR15026($r15026) {
        $this->r15026 = $r15026;
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


    function setR15027($r15027) {
        $this->r15027 = $r15027;
    }

    function setR15028($r15028) {
        $this->r15028 = $r15028;
    }









}


