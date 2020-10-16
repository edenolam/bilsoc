<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind7141 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id7141;

    protected $bilanSocialConsolide;

    protected $refCategorie;

    /**
     * @var integer
     */
    protected $r71411;

    /**
     * @var integer
     */
    protected $r71412;


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

    function getId7141() {
        return $this->id7141;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getR71411(int $ifNull = null) {
        return $this->r71411 ?? $ifNull;
    }

    function getR71412(int $ifNull = null) {
        return $this->r71412 ?? $ifNull;
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

    function setId7141($id7141) {
        $this->id7141 = $id7141;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setR71411($r71411) {
        if($r71411 == '' || $r71411 == null){
            $r71411 = 0;
        }
        $this->r71411 = $r71411;
    }

    function setR71412($r71412 = 0) {
        if($r71412 == '' || $r71412 == null){
            $r71412 = 0;
        }
        $this->r71412 = $r71412;
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
