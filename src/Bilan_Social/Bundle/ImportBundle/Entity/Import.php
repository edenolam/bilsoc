<?php

namespace Bilan_Social\Bundle\ImportBundle\Entity;

/**
 * Import
 */
class Import
{

    private $idImpo;

    private $nmAnnee;

    private $collectivite;

    private $enquete;

    private $fgTypeimpo;

    private $dtImpo;

    private $dtCrea;

    private $cdUtilcrea;


    function getIdImpo() {
        return $this->idImpo;
    }

    function getNmAnnee() {
        return $this->nmAnnee;
    }

    function getFgTypeimpo() {
        return $this->fgTypeimpo;
    }

    function getDtImpo() {
        return $this->dtImpo;
    }

    function getDtCrea() {
        return $this->dtCrea;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function setIdImpo($idImpo) {
        $this->idImpo = $idImpo;
    }

    function setNmAnnee($nmAnnee) {
        $this->nmAnnee = $nmAnnee;
    }

    function setFgTypeimpo($fgTypeimpo) {
        $this->fgTypeimpo = $fgTypeimpo;
    }

    function setDtImpo($dtImpo) {
        $this->dtImpo = $dtImpo;
    }

    function setDtCrea($dtCrea) {
        $this->dtCrea = $dtCrea;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function getCollectivite() {
        return $this->collectivite;
    }

    function getEnquete() {
        return $this->enquete;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }

    function setEnquete($enquete) {
        $this->enquete = $enquete;
    }

}
