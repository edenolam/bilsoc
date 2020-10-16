<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind142
{
    /**
     * @var integer
     */
    private $id142;

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
    private $r1421;

    /**
     * @var integer
     */
    private $r1422;

    /**
     * @var integer
     */
    private $r1423;

    /**
     * @var integer
     */
    private $r1424;

    /**
     * @var integer
     */
    private $r1425;

    /**
     * @var integer
     */
    private $r1426;



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

    function getId142() {
        return $this->id142;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefPositionStatutaire() {
        return $this->refPositionStatutaire;
    }

    function getR1421(int $ifNull = null) {
        return $this->r1421 ?? $ifNull;
    }

    function getR1422(int $ifNull = null) {
        return $this->r1422 ?? $ifNull;
    }

    function getR1423(int $ifNull = null) {
        return $this->r1423 ?? $ifNull;
    }

    function getR1424(int $ifNull = null) {
        return $this->r1424 ?? $ifNull;
    }

    function getR1425(int $ifNull = null) {
        return $this->r1425 ?? $ifNull;
    }

    function getR1426(int $ifNull = null) {
        return $this->r1426 ?? $ifNull;
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

    function setId142($id142) {
        $this->id142 = $id142;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefPositionStatutaire($refPositionStatutaire) {
        $this->refPositionStatutaire = $refPositionStatutaire;
    }

    function setR1421($r1421) {
        $this->r1421 = $r1421;
    }

    function setR1422($r1422) {
        $this->r1422 = $r1422;
    }

    function setR1423($r1423) {
        $this->r1423 = $r1423;
    }

    function setR1424($r1424) {
        $this->r1424 = $r1424;
    }

    function setR1425($r1425) {
        $this->r1425 = $r1425;
    }

    function setR1426($r1426) {
        $this->r1426 = $r1426;
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
