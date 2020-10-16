<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind513 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id513;

    protected $bilanSocialConsolide;

    protected $refValidationExperience;

    protected $type;

    protected $firstType;

    /**
     * @var integer
     */
    protected $r5131;

    /**
     * @var integer
     */
    protected $r5132;
    /**
     * @var integer
     */
    protected $r5133;
    /**
     * @var integer
     */
    protected $r5134;


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


    function getId513() {
        return $this->id513;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR5131(int $ifNull = null) {
        return $this->r5131 ?? $ifNull;
    }

    function getR5132(int $ifNull = null) {
        return $this->r5132 ?? $ifNull;
    }

    function getR5133(int $ifNull = null) {
        return $this->r5133 ?? $ifNull;
    }

    function getR5134(int $ifNull = null) {
        return $this->r5134 ?? $ifNull;
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

    function setId513($id513) {
        $this->id513 = $id513;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR5131($r5131) {
        $this->r5131 = $r5131;
    }

    function setR5132($r5132) {
        $this->r5132 = $r5132;
    }

    function setR5133($r5133) {
        $this->r5133 = $r5133;
    }

    function setR5134($r5134) {
        $this->r5134 = $r5134;
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

    function getRefValidationExperience() {
        return $this->refValidationExperience;
    }

    function getType() {
        return $this->type;
    }

    function setRefValidationExperience($refValidationExperience) {
        $this->refValidationExperience = $refValidationExperience;
    }

    function setType($type) {
        $this->type = $type;
    }

    function getFirstType() {
        return $this->firstType;
    }

    function setFirstType($firstType) {
        $this->firstType = $firstType;
    }




}
