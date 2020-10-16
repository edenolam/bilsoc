<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind321 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id321;

    protected $bilanSocialConsolide;

    protected $refFiliere;

    protected $refCategorie;


    /**
     * @var integer
     */
    protected $r3211;

    /**
     * @var integer
     */
    protected $r3212;
    /**
     * @var integer
     */
    protected $r3213;
    /**
     * @var integer
     */
    protected $r3214;
    /**
     * @var integer
     */
    protected $r3215;
    /**
     * @var integer
     */
    protected $r3216;


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


    function getId321() {
        return $this->id321;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getRefFiliere() {
        return $this->refFiliere;
    }

    function getR3211(int $ifNull = null) {
        return $this->r3211 ?? $ifNull;
    }

    function getR3212(int $ifNull = null) {
        return $this->r3212 ?? $ifNull;
    }

    function getR3213(int $ifNull = null) {
        return $this->r3213 ?? $ifNull;
    }

    function getR3214(int $ifNull = null) {
        return $this->r3214 ?? $ifNull;
    }

    function getR3215(int $ifNull = null) {
        return $this->r3215 ?? $ifNull;
    }

    function getR3216(int $ifNull = null) {
        return $this->r3216 ?? $ifNull;
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

    function setId321($id321) {
        $this->id321 = $id321;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setRefFiliere($refFiliere) {
        $this->refFiliere = $refFiliere;
    }

    function setR3211($r3211) {
        $this->r3211 = $r3211;
    }

    function setR3212($r3212) {
        $this->r3212 = $r3212;
    }

    function setR3213($r3213) {
        $this->r3213 = $r3213;
    }

    function setR3214($r3214) {
        $this->r3214 = $r3214;
    }

    function setR3215($r3215) {
        $this->r3215 = $r3215;
    }

    function setR3216($r3216) {
        $this->r3216 = $r3216;
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
