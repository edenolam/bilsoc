<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialStatutAgents {

    /**
     * @var integer
     */
    private $idBscHanditorialStatutAgents;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $statutAgentH;

    /**
     * @var integer
     */
    private $statutAgentF;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var string
     */
    private $fgStat;

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
    private $refStatut;

    function getIdBscHanditorialStatutAgents() {
        return $this->idBscHanditorialStatutAgents;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getFgStat() {
        return $this->fgStat;
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

    function setIdBscHanditorialStatutAgents($idBscHanditorialStatutAgents) {
        $this->idBscHanditorialStatutAgents = $idBscHanditorialStatutAgents;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setFgStat($fgStat) {
        $this->fgStat = $fgStat;
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

    function getStatutAgentH(int $ifNull = null) {
        return $this->statutAgentH ?? $ifNull;
    }

    function getStatutAgentF(int $ifNull = null) {
        return $this->statutAgentF ?? $ifNull;
    }

    function getRefStatut() {
        return $this->refStatut;
    }

    function setStatutAgentH($statutAgentH) {
        $this->statutAgentH = $statutAgentH;
    }

    function setStatutAgentF($statutAgentF) {
        $this->statutAgentF = $statutAgentF;
    }

    function setRefStatut($refStatut) {
        $this->refStatut = $refStatut;
    }

}
