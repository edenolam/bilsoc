<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscRassctPrevisionFormationSanteTravail {

    /**
     * @var integer
     */
    private $idPrevFormSanteTrav;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var string
     */
    private $themeAction;

    /**
     * @var integer
     */
    private $nbPersForm;

    /**
     * @var string
     */
    private $orgaForm;

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

    function getIdPrevFormSanteTrav() {
        return $this->idPrevFormSanteTrav;
    }

    function setIdPrevFormSanteTrav($idPrevFormSanteTrav) {
        $this->idPrevFormSanteTrav = $idPrevFormSanteTrav;
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

    function getThemeAction() {
        return $this->themeAction;
    }

    function getNbPersForm(int $ifNull = null) {
        return $this->nbPersForm ?? $ifNull;
    }

    function getOrgaForm() {
        return $this->orgaForm;
    }

    function setThemeAction($themeAction) {
        $this->themeAction = $themeAction;
    }

    function setNbPersForm($nbPersForm) {
        $this->nbPersForm = $nbPersForm;
    }

    function setOrgaForm($orgaForm) {
        $this->orgaForm = $orgaForm;
    }

}
