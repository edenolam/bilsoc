<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind613
{
    /**
     * @var integer
     */
    private $id613;

    private $bilanSocialConsolide;

    private $refMotifGreve;

    /**
     * @var integer
     */
    private $r6132;



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


    function getId613() {
        return $this->id613;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR6132(int $ifNull = null) {
        return $this->r6132 ?? $ifNull;
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

    function setId613($id613) {
        $this->id613 = $id613;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR6132($r6132) {
        $this->r6132 = $r6132;
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

    function getRefMotifGreve() {
        return $this->refMotifGreve;
    }

    function setRefMotifGreve($refMotifGreve) {
        $this->refMotifGreve = $refMotifGreve;
    }



}
