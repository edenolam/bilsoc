<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * Departement
 */
class Departement
{
    /**
     * @var string
     */
    private $cdDepa;

    /**
     * @var string
     */
    private $lbDepa;

    /**
     * @var int
     */
    private $nbSIASP;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var integer
     */
    private $idDepa;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $collectivites;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $historiqueCollectivites;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $enquetes;
    
    /*
     * $maps
     */
    
    private $maps;
    
    /*
     * $groups
     */
    
    private $groups;

    private $user;

    /**
     * Constructor
     */
    public function __construct() {
        $this->collectivites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->historiqueCollectivites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enquetes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->maps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set cdDepa
     *
     * @param string $cdDepa
     *
     * @return Departement
     */
    public function setCdDepa($cdDepa)
    {
        $this->cdDepa = $cdDepa;

        return $this;
    }

    /**
     * Get cdDepa
     *
     * @return string
     */
    public function getCdDepa()
    {
        return $this->cdDepa;
    }

    /**
     * Set lbDepa
     *
     * @param string $lbDepa
     *
     * @return Departement
     */
    public function setLbDepa($lbDepa)
    {
        $this->lbDepa = $lbDepa;

        return $this;
    }

    /**
     * Get lbDepa
     *
     * @return string
     */
    public function getLbDepa()
    {
        return $this->lbDepa;
    }

    /**
     * Set nbSIASP
     *
     * @param string $nbSIASP
     *
     * @return Departement
     */
    public function setNbSIASP($nbSIASP)
    {
        $this->nbSIASP = $nbSIASP;
        return $this;
    }

    /**
     * Get nbSIASP
     *
     * @return string
     */
    public function getNbSIASP()
    {
        return $this->nbSIASP;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return Departement
     */
    public function setCdUtilcrea($cdUtilcrea)
    {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea()
    {
        return $this->cdUtilcrea;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return Departement
     */
    public function setDtCrea($dtCrea)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea()
    {
        return $this->dtCrea;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return Departement
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi()
    {
        return $this->cdUtilmodi;
    }

    /**
     * Set dtModi
     *
     * @param \DateTime $dtModi
     *
     * @return Departement
     */
    public function setDtModi($dtModi)
    {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi()
    {
        return $this->dtModi;
    }

    /**
     * Get idDepa
     *
     * @return integer
     */
    public function getIdDepa()
    {
        return $this->idDepa;
    }
    
    /**
     * Add collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return Retourne la liste des collectivités d'un département
     */
    public function addCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivites[] = $collectivite;

        return $this;
    }

    /**
     * Remove collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     */
    public function removeCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivites->removeElement($collectivite);
    }

    /**
     * Get collectivites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCollectivites() {
        return $this->collectivites;
    }
    /**
     * Add historiqueCollectivites
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivites
     *
     * @return Retourne la liste des historiques collectivités d'un département
     */
    public function addHistoriqueCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivites) {
        $this->historiqueCollectivites[] = $historiqueCollectivites;

        return $this;
    }

    /**
     * Remove historiqueCollectivites
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     */
    public function removeHistoriqueCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivites) {
        $this->historiqueCollectivites->removeElement($historiqueCollectivites);
    }

    /**
     * Get historiqueCollectivites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoriqueCollectivites() {
        return $this->historiqueCollectivites;
    }
    
    /**
     * Add enquete
     *
     * @param \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete
     *
     * @return Retourne la liste des collectivités d'un département
     */
    public function addEnquete(\Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete) {
        
        if(!$this->enquetes->contains($enquete)){
            $this->enquetes->add($enquete);
        }

        return $this;
    }

    /**
     * Remove enquete
     *
     * @param \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete
     */
    public function removeEnquete(\Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete) {
        $this->enquetes->removeElement($enquete);
    }

    /**
     * Get enquetes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnquetes() {
        return $this->enquetes;
    }
    
    /**
     * Add Maps
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return Retourne la liste des collectivités d'un département
     */
    public function addMaps(\Bilan_Social\Bundle\CollectiviteBundle\Entity\UrlMap $maps) {
        $this->maps[] = $maps;

        return $this;
    }

    /**
     * Remove Maps
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\UrlMap $maps
     */
    public function removeMaps(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $maps) {
        $this->maps->removeElement($maps);
    }
    /**
     * Get maps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaps() {
        return $this->maps;
    }
   
    
    /**
     * Add DepartementsGroups
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\DepartementsGroups $groups
     *
     * @return Retourne la liste des collectivités d'un département
     */
    public function addGroups(\Bilan_Social\Bundle\CollectiviteBundle\Entity\DepartementsGroups $groups) {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove DepartementsGroups
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\DepartementsGroups $groups
     */
    public function removeGroups(\Bilan_Social\Bundle\CollectiviteBundle\Entity\DepartementsGroups $groups) {
        $this->groups->removeElement($groups);
    }
    /**
     * Get DepartementsGroups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups() {
        return $this->groups;
    }


}
