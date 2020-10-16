<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class BscHanditorialArticles {

    /**
     * @var integer
     */
    private $idBscHanditorialArticles;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $articleH;

    /**
     * @var integer
     */
    private $articleF;

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
    private $refArticle;

    function getIdBscHanditorialArticles() {
        return $this->idBscHanditorialArticles;
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

    function setIdBscHanditorialArticles($idBscHanditorialArticles) {
        $this->idBscHanditorialArticles = $idBscHanditorialArticles;
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

    function getArticleH() {
        return $this->articleH;
    }

    function getArticleF() {
        return $this->articleF;
    }

    function getRefArticle() {
        return $this->refArticle;
    }

    function setArticleH($articleH) {
        $this->articleH = $articleH;
    }

    function setArticleF($articleF) {
        $this->articleF = $articleF;
    }

    function setRefArticle($refArticle) {
        $this->refArticle = $refArticle;
    }

}
