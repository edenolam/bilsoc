<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialModeSortiesNonTitulaire {

    /**
     * @var integer
     */
    private $idBscHanditorialModeSortiesNonTitulaire;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $modeSortieNonTitulaireH;

    /**
     * @var integer
     */
    private $modeSortieNonTitulaireF;

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
    private $refMotifDepart;

    function getIdBscHanditorialModeSortiesNonTitulaire() {
        return $this->idBscHanditorialModeSortiesNonTitulaire;
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

    function setIdBscHanditorialModeSortiesNonTitulaire($idBscHanditorialModeSortiesNonTitulaire) {
        $this->idBscHanditorialModeSortiesNonTitulaire = $idBscHanditorialModeSortiesNonTitulaire;
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

    function getModeSortieNonTitulaireH(int $ifNull = null) {
        return $this->modeSortieNonTitulaireH ?? $ifNull;
    }

    function getModeSortieNonTitulaireF(int $ifNull = null) {
        return $this->modeSortieNonTitulaireF ?? $ifNull;
    }

    function setModeSortieNonTitulaireH($modeSortieNonTitulaireH) {
        $this->modeSortieNonTitulaireH = $modeSortieNonTitulaireH;
    }

    function setModeSortieNonTitulaireF($modeSortieNonTitulaireF) {
        $this->modeSortieNonTitulaireF = $modeSortieNonTitulaireF;
    }

    function getRefMotifDepart() {
        return $this->refMotifDepart;
    }

    function setRefMotifDepart($refMotifDepart) {
        $this->refMotifDepart = $refMotifDepart;
    }

}
