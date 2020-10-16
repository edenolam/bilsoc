<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind6142
{
    /**
     * @var integer
     */
    private $id6142;

    private $bilanSocialConsolide;

    private $refMotifSanctionDisciplinaire;

    /**
     * @var integer
     */
    private $r61421;

    /**
     * @var integer
     */
    private $r61422;





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


    function getId6142() {
        return $this->id6142;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR61421(int $ifNull = null) {
        return $this->r61421 ?? $ifNull;
    }

    function getR61422(int $ifNull = null) {
        return $this->r61422 ?? $ifNull;
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

    function setId6142($id6142) {
        $this->id6142 = $id6142;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR61421($r61421) {
        $this->r61421 = $r61421;
    }

    function setR61422($r61422) {
        $this->r61422 = $r61422;
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

    function getRefMotifSanctionDisciplinaire() {
        return $this->refMotifSanctionDisciplinaire;
    }

    function setRefMotifSanctionDisciplinaire($refMotifSanctionDisciplinaire) {
        $this->refMotifSanctionDisciplinaire = $refMotifSanctionDisciplinaire;
    }



}
