<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind1513 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1513;

    protected $bilanSocialConsolide;

    protected $refEmploiFonctionnel;

    /**
     * @var integer
     */
    protected $r15131;

    /**
     * @var integer
     */
    protected $r15132;




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



    function getId1513() {
        return $this->id1513;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefEmploiFonctionnel() {
        return $this->refEmploiFonctionnel;
    }

    function getR15131(int $ifNull = null) {
        return $this->r15131 ?? $ifNull;
    }

    function getR15132(int $ifNull = null) {
        return $this->r15132 ?? $ifNull;
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

    function setId1513($id1513) {
        $this->id1513 = $id1513;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefEmploiFonctionnel($refEmploiFonctionnel) {
        $this->refEmploiFonctionnel = $refEmploiFonctionnel;
    }

    function setR15131($r15131) {
        $this->r15131 = $r15131;
    }

    function setR15132($r15132) {
        $this->r15132 = $r15132;
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
