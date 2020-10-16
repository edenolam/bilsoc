<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind132Bis
{
    /**
     * @var integer
     */
    private $id132Bis;

    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $r13221;

    /**
     * @var integer
     */
    private $r13222;

    /**
     * @var integer
     */
    private $r13223;

    /**
     * @var integer
     */
    private $r13224;


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


    function getId132Bis() {
        return $this->id132Bis;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR13221(int $ifNull = null) {
        return $this->r13221 ?? $ifNull;
    }

    function getR13222(int $ifNull = null) {
        return $this->r13222 ?? $ifNull;
    }

    function getR13223(int $ifNull = null) {
        return $this->r13223 ?? $ifNull;
    }

    function getR13224(int $ifNull = null) {
        return $this->r13224 ?? $ifNull;
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

    function setId132Bis($id132Bis) {
        $this->id132Bis = $id132Bis;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR13221($r13221) {
        $this->r13221 = $r13221;
    }

    function setR13222($r13222) {
        $this->r13222 = $r13222;
    }

    function setR13223($r13223) {
        $this->r13223 = $r13223;
    }

    function setR13224($r13224) {
        $this->r13224 = $r13224;
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
