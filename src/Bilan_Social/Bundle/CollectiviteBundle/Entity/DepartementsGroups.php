<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * DepartementsGroups
 */
class DepartementsGroups
{
    /**
     * @var int
     */
    private $idGroup;

    /**
     * @var int
     */
    private $departement;

    /**
     * @var int
     */
    private $nmGroup;


    /**
     * Get id
     *
     * @return int
     */
    public function getIdGroup()
    {
        return $this->idGroup;
    }
    
    function setIdGroup($idGroup) {
        $this->idGroup = $idGroup;
    }

    function getDepartement() {
        return $this->departement;
    }

    function setDepartement($departement) {
        $this->departement = $departement;
    }

        /**
     * Set nmGroup
     *
     * @param integer $nmGroup
     *
     * @return DepartementsGroups
     */
    public function setNmGroup($nmGroup)
    {
        $this->nmGroup = $nmGroup;

        return $this;
    }

    /**
     * Get nmGroup
     *
     * @return int
     */
    public function getNmGroup()
    {
        return $this->nmGroup;
    }
}

