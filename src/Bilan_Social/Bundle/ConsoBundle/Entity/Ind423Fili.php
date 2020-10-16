<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind423Fili
{
    /**
     * @var integer
     */
    private $id423Fili;

    private $bilanSocialConsolide;

    private $refFiliere;

    private $idInap;

    /**
     * @var integer
     */
    private $r4231Fili;


    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
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


    function getId423Fili() {
        return $this->id423Fili;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefFiliere() {
        return $this->refFiliere;
    }

    function getR4231Fili(int $ifNull = null) {
        return $this->r4231Fili ?? $ifNull;
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

    function setId423Fili($id423Fili) {
        $this->id423Fili = $id423Fili;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefFiliere($refFiliere) {
        $this->refFiliere = $refFiliere;
    }

    function setR4231Fili($r4231Fili) {
        $this->r4231Fili = $r4231Fili;
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

    public function setIdInap($idInap)
    {
        $this->idInap = $idInap;
        return $this;
    }

    public function getIdInap()
    {
        return $this->idInap;
    }



}
