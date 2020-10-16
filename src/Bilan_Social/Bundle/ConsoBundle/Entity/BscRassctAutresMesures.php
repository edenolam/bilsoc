<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctAutresMesures {

    /**
     * @var integer
     */
    private $idAutresMesures;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var string
     */
    private $mesuresTechniques;

    /**
     * @var string
     */
    private $mesuresOrgani;

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

    function getIdAutresMesures() {
        return $this->idAutresMesures;
    }

    function getMesuresTechniques() {
        return $this->mesuresTechniques;
    }

    function getMesuresOrgani() {
        return $this->mesuresOrgani;
    }

    function setIdAutresMesures($idAutresMesures) {
        $this->idAutresMesures = $idAutresMesures;
    }

    function setMesuresTechniques($mesuresTechniques) {
        $this->mesuresTechniques = $mesuresTechniques;
    }

    function setMesuresOrgani($mesuresOrgani) {
        $this->mesuresOrgani = $mesuresOrgani;
    }

}
