<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * UrlMap
 */
class UrlMap
{
    /**
     * @var int
     */
    private $id_urlmap;

    /**
     * @var string
     */
    private $lbUrlMap;
    
    private $departement;

    
    function getId_urlmap() {
        return $this->id_urlmap;
    }

    function getLbUrlMap() {
        return $this->lbUrlMap;
    }

    function setId_urlmap($id_urlmap) {
        $this->id_urlmap = $id_urlmap;
    }

    function setLbUrlMap($lbUrlMap) {
        $this->lbUrlMap = $lbUrlMap;
    }
    
    function getDepartements() {
        return $this->departements;
    }

    function setDepartements($departements) {
        $this->departements = $departements;
    }




}

