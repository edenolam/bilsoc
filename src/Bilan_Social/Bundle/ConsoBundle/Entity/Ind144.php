<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind144
{
    /**
     * @var integer
     */
    private $id144;

    private $bilanSocialConsolide;

    private $refPositionStatutaire;

    private $idGrouPosistat;
    private $lbGrouPosistat;
    private $lbGrouCompl;
    private $lbGrouComm;
    private $newGroupe;
    private $lastGroupe;


    /**
     * @var integer
     */
    private $r1441;

    /**
     * @var integer
     */
    private $r1442;



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


    function getId144() {
        return $this->id144;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefPositionStatutaire() {
        return $this->refPositionStatutaire;
    }

    function getR1441(int $ifNull = null) {
        return $this->r1441 ?? $ifNull;
    }

    function getR1442(int $ifNull = null) {
        return $this->r1442 ?? $ifNull;
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

    function setId144($id144) {
        $this->id144 = $id144;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefPositionStatutaire($refPositionStatutaire) {
        $this->refPositionStatutaire = $refPositionStatutaire;
    }

    function setR1441($r1441) {
        $this->r1441 = $r1441;
    }

    function setR1442($r1442) {
        $this->r1442 = $r1442;
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

    function getIdGrouPosistat() {
        return $this->idGrouPosistat;
    }

    function getLbGrouPosistat() {
        return $this->lbGrouPosistat;
    }

    function getNewGroupe() {
        return $this->newGroupe;
    }

    function getLastGroupe() {
        return $this->lastGroupe;
    }

    function setIdGrouPosistat($idGrouPosistat) {
        $this->idGrouPosistat = $idGrouPosistat;
    }

    function setLbGrouPosistat($lbGrouPosistat) {
        $this->lbGrouPosistat = $lbGrouPosistat;
    }

    function setNewGroupe($newGroupe) {
        $this->newGroupe = $newGroupe;
    }

    function setLastGroupe($lastGroupe) {
        $this->lastGroupe = $lastGroupe;
    }


    function getLbGrouCompl() {
        return $this->lbGrouCompl;
    }

    function setLbGrouCompl($lbGrouCompl) {
        $this->lbGrouCompl = $lbGrouCompl;
    }

    function getLbGrouComm() {
        return $this->lbGrouComm;
    }

    function setLbGrouComm($lbGrouComm) {
        $this->lbGrouComm = $lbGrouComm;
    }


}
