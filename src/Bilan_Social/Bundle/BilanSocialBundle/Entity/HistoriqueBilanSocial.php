<?php

namespace Bilan_Social\Bundle\BilanSocialBundle\Entity;

/**
 * HistoriqueBilanSocial
 */
class HistoriqueBilanSocial
{
    private $enquete;
    private $collectivite;
    private $departement;
    private $fgStat;
    private $cdTypebilasoci;
    private $dtChgt;
    private $idHistbilasoci;
    
    function getEnquete() {
        return $this->enquete;
    }

    function getCollectivite() {
        return $this->collectivite;
    }

    function setEnquete($enquete) {
        $this->enquete = $enquete;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }
    
    function getDepartement() {
        return $this->departement;
    }
    
    function setDepartement($departement) {
        $this->departement = $departement;
    }

    function getFgStat() {
        return $this->fgStat;
    }

    function setFgStat($fgStat) {
        $this->fgStat = $fgStat;
    }

    function getDtChgt() {
        return $this->dtChgt;
    }

    function setDtChgt($dtChgt) {
        $this->dtChgt = $dtChgt;
    }

    function getCdTypebilasoci() {
        return $this->cdTypebilasoci;
    }

    function setCdTypebilasoci($cdTypebilasoci) {
        $this->cdTypebilasoci = $cdTypebilasoci;
    }

    function setIdHistbilasoci($idHistbilasoci) {
        $this->idHistbilasoci = $idHistbilasoci;
    }
    
}