<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind6141
{
    /**
     * @var integer
     */
    private $id6141;

    private $bilanSocialConsolide;

    private $refSanctionDisciplinaire;

    private $firstGroupe1;
    private $firstGroupe2;
    private $firstGroupe3;
    private $firstGroupe4;
    private $firstGroupe5;
    private $firstGroupe6;
    private $groupe;

    /**
     * @var integer
     */
    private $r61411;
    /**
     * @var integer
     */
    private $r61412;



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


    function getId6141() {
        return $this->id6141;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getR61411(int $ifNull = null) {
        return $this->r61411 ?? $ifNull;
    }

    function getR61412(int $ifNull = null) {
        return $this->r61412 ?? $ifNull;
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

    function setId6141($id6141) {
        $this->id6141 = $id6141;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setR61411($r61411) {
        $this->r61411 = $r61411;
    }

    function setR61412($r61412) {
        $this->r61412 = $r61412;
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

    function getRefSanctionDisciplinaire() {
        return $this->refSanctionDisciplinaire;
    }

    function setRefSanctionDisciplinaire($refSanctionDisciplinaire) {
        $this->refSanctionDisciplinaire = $refSanctionDisciplinaire;
    }

    function getFirstGroupe1() {
        return $this->firstGroupe1;
    }

    function getFirstGroupe2() {
        return $this->firstGroupe2;
    }

    function getFirstGroupe3() {
        return $this->firstGroupe3;
    }

    function getFirstGroupe4() {
        return $this->firstGroupe4;
    }

    function getFirstGroupe5() {
        return $this->firstGroupe5;
    }

    function getFirstGroupe6() {
        return $this->firstGroupe6;
    }

    function getGroupe() {
        return $this->groupe;
    }

    function setFirstGroupe1($firstGroupe1) {
        $this->firstGroupe1 = $firstGroupe1;
    }

    function setFirstGroupe2($firstGroupe2) {
        $this->firstGroupe2 = $firstGroupe2;
    }

    function setFirstGroupe3($firstGroupe3) {
        $this->firstGroupe3 = $firstGroupe3;
    }

    function setFirstGroupe4($firstGroupe4) {
        $this->firstGroupe4 = $firstGroupe4;
    }

    function setFirstGroupe5($firstGroupe5) {
        $this->firstGroupe5 = $firstGroupe5;
    }

    function setFirstGroupe6($firstGroupe6) {
        $this->firstGroupe6 = $firstGroupe6;
    }

    function setGroupe($groupe) {
        $this->groupe = $groupe;
    }



}
