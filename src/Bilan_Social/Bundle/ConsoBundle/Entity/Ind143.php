<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind143
{
    /**
     * @var integer
     */
    private $id143;

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
    private $r1431;

    /**
     * @var integer
     */
    private $r1432;

    /**
     * @var integer
     */
    private $r1433;

    /**
     * @var integer
     */
    private $r1434;




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

    function getId143() {
        return $this->id143;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefPositionStatutaire() {
        return $this->refPositionStatutaire;
    }

    function getR1431(int $ifNull = null) {
        return $this->r1431 ?? $ifNull;
    }

    function getR1432(int $ifNull = null) {
        return $this->r1432 ?? $ifNull;
    }

    function getR1433(int $ifNull = null) {
        return $this->r1433 ?? $ifNull;
    }

    function getR1434(int $ifNull = null) {
        return $this->r1434 ?? $ifNull;
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

    function setId143($id143) {
        $this->id143 = $id143;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefPositionStatutaire($refPositionStatutaire) {
        $this->refPositionStatutaire = $refPositionStatutaire;
    }

    function setR1431($r1431) {
        $this->r1431 = $r1431;
    }

    function setR1432($r1432) {
        $this->r1432 = $r1432;
    }

    function setR1433($r1433) {
        $this->r1433 = $r1433;
    }

    function setR1434($r1434) {
        $this->r1434 = $r1434;
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
