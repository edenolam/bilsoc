<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind7142 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id7142;

    protected $bilanSocialConsolide;

    protected $refCategorie;

    /**
     * @var integer
     */
    protected $r71421;

    /**
     * @var integer
     */
    protected $r71422;


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

    function getId7142() {
        return $this->id7142;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function getR71421(int $ifNull = null) {
        return $this->r71421 ?? $ifNull;
    }

    function getR71422(int $ifNull = null) {
        return $this->r71422 ?? $ifNull;
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

    function setId7142($id7142) {
        $this->id7142 = $id7142;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

    function setR71421($r71421) {
        
        if($r71421 == '' || $r71421 == null){
            $r71421 = 0;
        }
        $this->r71421 = $r71421;
    }

    function setR71422($r71422) {
        if($r71422 == '' || $r71422 == null){
            $r71422 = 0;
        }
        $this->r71422 = $r71422;
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
