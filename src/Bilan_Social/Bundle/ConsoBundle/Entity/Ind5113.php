<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind5113
{
    /**
     * @var integer
     */
    private $id5113;

    private $bilanSocialConsolide;

    private $refCategorie;

    private $refFormation;

    private $newCateg;
    private $lastCateg;


    /**
     * @var integer
     */
    private $r51131;

    /**
     * @var integer
     */
    private $r51132;
    /**
     * @var integer
     */
    private $r51133;
    /**
     * @var integer
     */
    private $r51134;
    /**
     * @var integer
     */
    private $r51135;
    /**
     * @var integer
     */
    private $r51136;
    /**
     * @var integer
     */
    private $r51137;
    /**
     * @var integer
     */
    private $r51138;

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


    function getId5113() {
        return $this->id5113;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getR51131(int $ifNull = null) {
        return $this->r51131 ?? $ifNull;
    }

    function getR51132(int $ifNull = null) {
        return $this->r51132 ?? $ifNull;
    }

    function getR51133(int $ifNull = null) {
        return $this->r51133 ?? $ifNull;
    }

    function getR51134(int $ifNull = null) {
        return $this->r51134 ?? $ifNull;
    }

    function getR51135(int $ifNull = null) {
        return $this->r51135 ?? $ifNull;
    }

    function getR51136(int $ifNull = null) {
        return $this->r51136 ?? $ifNull;
    }

    function getR51137(int $ifNull = null) {
        return $this->r51137 ?? $ifNull;
    }

    function getR51138(int $ifNull = null) {
        return $this->r51138 ?? $ifNull;
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

    function setId5113($id5113) {
        $this->id5113 = $id5113;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setR51131($r51131) {
        $this->r51131 = $r51131;
    }

    function setR51132($r51132) {
        $this->r51132 = $r51132;
    }

    function setR51133($r51133) {
        $this->r51133 = $r51133;
    }

    function setR51134($r51134) {
        $this->r51134 = $r51134;
    }

    function setR51135($r51135) {
        $this->r51135 = $r51135;
    }

    function setR51136($r51136) {
        $this->r51136 = $r51136;
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

    function setR51137($r51137) {
        $this->r51137 = $r51137;
    }

    function setR51138($r51138) {
        $this->r51138 = $r51138;
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
