<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind5112
{
    /**
     * @var integer
     */
    private $id5112;

    private $bilanSocialConsolide;

    private $refCategorie;

    private $refFormation;

    private $newCateg;
    private $lastCateg;


    /**
     * @var integer
     */
    private $r51121;

    /**
     * @var integer
     */
    private $r51122;
    /**
     * @var integer
     */
    private $r51123;
    /**
     * @var integer
     */
    private $r51124;
    /**
     * @var integer
     */
    private $r51125;
    /**
     * @var integer
     */
    private $r51126;
    /**
     * @var integer
     */
    private $r51127;
    /**
     * @var integer
     */
    private $r51128;


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


    function getId5112() {
        return $this->id5112;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getR51121(int $ifNull = null) {
        return $this->r51121 ?? $ifNull;
    }

    function getR51122(int $ifNull = null) {
        return $this->r51122 ?? $ifNull;
    }

    function getR51123(int $ifNull = null) {
        return $this->r51123 ?? $ifNull;
    }

    function getR51124(int $ifNull = null) {
        return $this->r51124 ?? $ifNull;
    }

    function getR51125(int $ifNull = null) {
        return $this->r51125 ?? $ifNull;
    }

    function getR51126(int $ifNull = null) {
        return $this->r51126 ?? $ifNull;
    }

    function getR51127(int $ifNull = null) {
        return $this->r51127 ?? $ifNull;
    }

    function getR51128(int $ifNull = null) {
        return $this->r51128 ?? $ifNull;
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

    function setId5112($id5112) {
        $this->id5112 = $id5112;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setR51121($r51121) {
        $this->r51121 = $r51121;
    }

    function setR51122($r51122) {
        $this->r51122 = $r51122;
    }

    function setR51123($r51123) {
        $this->r51123 = $r51123;
    }

    function setR51124($r51124) {
        $this->r51124 = $r51124;
    }

    function setR51125($r51125) {
        $this->r51125 = $r51125;
    }

    function setR51126($r51126) {
        $this->r51126 = $r51126;
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

    function setR51127($r51127) {
        $this->r51127 = $r51127;
    }

    function setR51128($r51128) {
        $this->r51128 = $r51128;
    }


    function getRefFormation() {
        return $this->refFormation;
    }

    function getNewCateg() {
        return $this->newCateg;
    }

    function getLastCateg() {
        return $this->lastCateg;
    }

    function setNewCateg($newCateg) {
        $this->newCateg = $newCateg;
    }

    function setLastCateg($lastCateg) {
        $this->lastCateg = $lastCateg;
    }

    function setRefFormation($refFormation) {
        $this->refFormation = $refFormation;
    }


}
