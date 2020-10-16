<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind5121 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id5121;

    protected $bilanSocialConsolide;

    protected $refEmploiNonPermanent;

    /**
     * @var integer
     */
    protected $r51211;

    /**
     * @var integer
     */
    protected $r51212;
    /**
     * @var integer
     */
    protected $r51213;
    /**
     * @var integer
     */
    protected $r51214;
    /**
     * @var integer
     */
    protected $r51215;
    /**
     * @var integer
     */
    protected $r51216;
    /**
     * @var integer
     */
    protected $r51217;
    /**
     * @var integer
     */
    protected $r51218;

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


    function getId5121() {
        return $this->id5121;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR51211(int $ifNull = null) {
        return $this->r51211 ?? $ifNull;
    }

    function getR51212(int $ifNull = null) {
        return $this->r51212 ?? $ifNull;
    }

    function getR51213(int $ifNull = null) {
        return $this->r51213 ?? $ifNull;
    }

    function getR51214(int $ifNull = null) {
        return $this->r51214 ?? $ifNull;
    }

    function getR51215(int $ifNull = null) {
        return $this->r51215 ?? $ifNull;
    }

    function getR51216(int $ifNull = null) {
        return $this->r51216 ?? $ifNull;
    }

    function getR51217(int $ifNull = null) {
        return $this->r51217 ?? $ifNull;
    }

    function getR51218(int $ifNull = null) {
        return $this->r51218 ?? $ifNull;
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

    function setId5121($id5121) {
        $this->id5121 = $id5121;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }


    function setR51211($r51211) {
        $this->r51211 = $r51211;
    }

    function setR51212($r51212) {
        $this->r51212 = $r51212;
    }

    function setR51213($r51213) {
        $this->r51213 = $r51213;
    }

    function setR51214($r51214) {
        $this->r51214 = $r51214;
    }

    function setR51215($r51215) {
        $this->r51215 = $r51215;
    }

    function setR51216($r51216) {
        $this->r51216 = $r51216;
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

    function setR51217($r51217) {
        $this->r51217 = $r51217;
    }

    function setR51218($r51218) {
        $this->r51218 = $r51218;
    }

    function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

    function setRefEmploiNonPermanent($refEmploiNonPermanent) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;
    }



}
