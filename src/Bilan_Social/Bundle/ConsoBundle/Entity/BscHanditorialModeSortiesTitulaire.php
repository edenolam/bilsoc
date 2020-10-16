<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialModeSortiesTitulaire {

    /**
     * @var integer
     */
    private $idBscHanditorialModeSortiesTitulaire;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $modeSortieTitulaireH;

    /**
     * @var integer
     */
    private $modeSortieTitulaireF;

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

    function getIdBscHanditorialModeSortiesTitulaire() {
        return $this->idBscHanditorialModeSortiesTitulaire;
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

    function setIdBscHanditorialModeSortiesTitulaire($idBscHanditorialModeSortiesTitulaire) {
        $this->idBscHanditorialModeSortiesTitulaire = $idBscHanditorialModeSortiesTitulaire;
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

    function getModeSortieTitulaireH(int $ifNull = null) {
        return $this->modeSortieTitulaireH ?? $ifNull;
    }

    function getModeSortieTitulaireF(int $ifNull = null) {
        return $this->modeSortieTitulaireF ?? $ifNull;
    }

    function setModeSortieTitulaireH($modeSortieTitulaireH) {
        $this->modeSortieTitulaireH = $modeSortieTitulaireH;
    }

    function setModeSortieTitulaireF($modeSortieTitulaireF) {
        $this->modeSortieTitulaireF = $modeSortieTitulaireF;
    }

    function getRefMotifDepart() {
        return $this->refMotifDepart;
    }

    function setRefMotifDepart($refMotifDepart) {
        $this->refMotifDepart = $refMotifDepart;
    }

}
