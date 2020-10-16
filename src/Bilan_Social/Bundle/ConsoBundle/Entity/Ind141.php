<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind141 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id141;

    protected $bilanSocialConsolide;

    protected $refPositionStatutaire;

    protected $idGrouPosistat;
    protected $lbGrouPosistat;
    protected $lbGrouCompl;
    protected $lbGrouComm;
    protected $newGroupe;
    protected $lastGroupe;


    /**
     * @var integer
     */
    protected $r1411;

    /**
     * @var integer
     */
    protected $r1412;



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


    function getId141() {
        return $this->id141;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefPositionStatutaire() {
        return $this->refPositionStatutaire;
    }

    function getR1411(int $ifNull = null) {
        return $this->r1411 ?? $ifNull;
    }

    function getR1412(int $ifNull = null) {
        return $this->r1412 ?? $ifNull;
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

    function setId141($id141) {
        $this->id141 = $id141;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefPositionStatutaire($refPositionStatutaire) {
        $this->refPositionStatutaire = $refPositionStatutaire;
    }

    function setR1411($r1411) {
        $this->r1411 = $r1411;
    }

    function setR1412($r1412) {
        $this->r1412 = $r1412;
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
