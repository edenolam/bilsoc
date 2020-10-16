<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind158 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id158;

    protected $bilanSocialConsolide;

    protected $refFiliere;

    /**
     * @var integer
     */
    protected $r1581;

    /**
     * @var integer
     */
    protected $r1582;

    /**
     * @var integer
     */
    protected $r1583;

    /**
     * @var integer
     */
    protected $r1584;

    /**
     * @var integer
     */
    protected $r1585;

    /**
     * @var integer
     */
    protected $r1586;
    /**
     * @var integer
     */
    protected $r1587;
    /**
     * @var integer
     */
    protected $r1588;



    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
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


    function getId158() {
        return $this->id158;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefFiliere() {
        return $this->refFiliere;
    }

    function getR1581(int $ifNull = null) {
        return $this->r1581 ?? $ifNull;
    }

    function getR1582(int $ifNull = null) {
        return $this->r1582 ?? $ifNull;
    }

    function getR1583(int $ifNull = null) {
        return $this->r1583 ?? $ifNull;
    }

    function getR1584(int $ifNull = null) {
        return $this->r1584 ?? $ifNull;
    }

    function getR1585(int $ifNull = null) {
        return $this->r1585 ?? $ifNull;
    }

    function getR1586(int $ifNull = null) {
        return $this->r1586 ?? $ifNull;
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

    function setId158($id158) {
        $this->id158 = $id158;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefFiliere($refFiliere) {
        $this->refFiliere = $refFiliere;
    }

    function setR1581($r1581) {
        $this->r1581 = $r1581;
    }

    function setR1582($r1582) {
        $this->r1582 = $r1582;
    }

    function setR1583($r1583) {
        $this->r1583 = $r1583;
    }

    function setR1584($r1584) {
        $this->r1584 = $r1584;
    }

    function setR1585($r1585) {
        $this->r1585 = $r1585;
    }

    function setR1586($r1586) {
        $this->r1586 = $r1586;
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

    function getR1587(int $ifNull = null) {
        return $this->r1587 ?? $ifNull;
    }

    function getR1588(int $ifNull = null) {
        return $this->r1588 ?? $ifNull;
    }

    function setR1587($r1587) {
        $this->r1587 = $r1587;
    }

    function setR1588($r1588) {
        $this->r1588 = $r1588;
    }




}
