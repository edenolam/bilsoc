<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialQuestionsBoeths {

    /**
     * @var integer
     */
    private $idBscHanditorialQuestionsBoeths;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $categorieH;

    /**
     * @var integer
     */
    private $categorieF;

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
    private $refCategorieBoeth;

    function getIdBscHanditorialQuestionsBoeths() {
        return $this->idBscHanditorialQuestionsBoeths;
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

    function setIdBscHanditorialQuestionsBoeths($idBscHanditorialQuestionsBoeths) {
        $this->idBscHanditorialQuestionsBoeths = $idBscHanditorialQuestionsBoeths;
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

    function getCategorieH(int $ifNull = null) {
        return $this->categorieH ?? $ifNull;
    }

    function getCategorieF(int $ifNull = null) {
        return $this->categorieF ?? $ifNull;
    }

    function getRefCategorieBoeth() {
        return $this->refCategorieBoeth;
    }

    function setCategorieH($categorieH) {
        $this->categorieH = $categorieH;
    }

    function setCategorieF($categorieF) {
        $this->categorieF = $categorieF;
    }

    function setRefCategorieBoeth($refCategorieBoeth) {
        $this->refCategorieBoeth = $refCategorieBoeth;
    }

}
