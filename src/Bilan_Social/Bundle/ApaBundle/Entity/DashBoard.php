<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Description of DashBoard
 *
 * @author mbusson
 */
class DashBoard {
    
   /**
     * @var integer
     */
    private $lbStat;

    /**
     * @var integer
     */
    private $nbDeparts;
    /**
     * @var integer
     */
    private $nbArrivees;
    
    /**
     * @var integer
     */
    private $nbAgentsValide;
    
    /**
     * @var integer
     */
    private $nbAgentsNonValide;
    
    /**
     * @var integer
     */
    private $nbAgents3112;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $ListesAgents;
    
     /**
     * Constructor
     */
    public function __construct() {
        $this->ListesAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function getLbStat() {
        return $this->lbStat;
    }

    function getNbDeparts() {
        return $this->nbDeparts;
    }

    function getNbArrivees() {
        return $this->nbArrivees;
    }

    function getNbAgentsValide() {
        return $this->nbAgentsValide;
    }

    function getNbAgentsNonValide() {
        return $this->nbAgentsNonValide;
    }

    function getNbAgents3112() {
        return $this->nbAgents3112;
    }

    function setLbStat($lbStat) {
        $this->lbStat = $lbStat;
    }

    function setNbDeparts($nbDeparts) {
        $this->nbDeparts = $nbDeparts;
    }

    function setNbArrivees($nbArrivees) {
        $this->nbArrivees = $nbArrivees;
    }

    function setNbAgentsValide($nbAgentsValide) {
        $this->nbAgentsValide = $nbAgentsValide;
    }

    function setNbAgentsNonValide($nbAgentsNonValide) {
        $this->nbAgentsNonValide = $nbAgentsNonValide;
    }

    function setNbAgents3112($nbAgents3112) {
        $this->nbAgents3112 = $nbAgents3112;
    }
    
    /**
     * Add ListesAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\DashBoard $ListesAgents
     *
     * @return ListesAgents
     */
    public function addListesAgents(\Bilan_Social\Bundle\ApaBundle\Entity\DashBoard $ListesAgents) {
        $this->ListesAgents[] = $ListesAgents;

        return $this;
    }

    /**
     * Remove ListesAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\DashBoard $ListesAgents
     */
    public function removeListesAgents(\Bilan_Social\Bundle\ApaBundle\Entity\DashBoard $ListesAgents) {
        $this->ListesAgents->removeElement($ListesAgents);
    }

    /**
     * Get ListesAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListesAgents() {
        return $this->ListesAgents;
    }


}
