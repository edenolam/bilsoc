<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialDerniersDiplomes {

    /**
     * @var integer
     */
    private $idBscHanditorialDerniersDiplomes;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $dernierDiplomeH;

    /**
     * @var integer
     */
    private $dernierDiplomeF;

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
    private $refDomaineDiplome;

    function getIdBscHanditorialDerniersDiplomes() {
        return $this->idBscHanditorialDerniersDiplomes;
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

    function setIdBscHanditorialDerniersDiplomes($idBscHanditorialDerniersDiplomes) {
        $this->idBscHanditorialDerniersDiplomes = $idBscHanditorialDerniersDiplomes;
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

    function getDernierDiplomeH(int $ifNull = null) {
        return $this->dernierDiplomeH ?? $ifNull;
    }

    function getDernierDiplomeF(int $ifNull = null) {
        return $this->dernierDiplomeF ?? $ifNull;
    }

    function getRefDomaineDiplome() {
        return $this->refDomaineDiplome;
    }

    function setDernierDiplomeH($dernierDiplomeH) {
        $this->dernierDiplomeH = $dernierDiplomeH;
    }

    function setDernierDiplomeF($dernierDiplomeF) {
        $this->dernierDiplomeF = $dernierDiplomeF;
    }

    function setRefDomaineDiplome($refDomaineDiplome) {
        $this->refDomaineDiplome = $refDomaineDiplome;
    }

}
