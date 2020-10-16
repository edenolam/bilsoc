<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefActionPrevention
 * @UniqueEntity(
 *      fields="cdActionprev",
 *      errorPath="cdActionprev",
 *      message="Ce code est déjà existant."
 * )
 */
class RefActionPrevention extends RefAbstractEntity{

    /** Dépenses correspondant aux mesures prises dans l'année pour l'amélioration des conditions de travail. Cet indicateur regroupe l'ensemble des frais liés à l'amélioration des conditions d'hygiène et de prévention (autres formations, investissements, Equipements de Protection Individuelle…) */
    const AP005 = 'AP005';

    /**
     * @var integer
     */
    protected $idTypeColl;

    /**
     * @var string
     */
    protected $cdActionprev;

    /**
     * @var string
     */
    protected $lbActionprev;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $cdUtilmodi;

    /**
     * @var integer
     */
    protected $idActionprev;

    /**
     * @var integer
     */
    protected $blNbjour;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

     /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $informationCollectiviteAgent;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->informationCollectiviteAgent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set idTypeColl
     *
     * @param integer $idTypeColl
     *
     * @return RefActionPrevention
     */
    public function setIdTypeColl($idTypeColl) {
        $this->idTypeColl = $idTypeColl;

        return $this;
    }

    /**
     * Get idTypeColl
     *
     * @return integer
     */
    public function getIdTypeColl() {
        return $this->idTypeColl;
    }

    /**
     * Set cdActionprev
     *
     * @param string $cdActionprev
     *
     * @return RefActionPrevention
     */
    public function setCdActionprev($cdActionprev) {
        $this->cdActionprev = $cdActionprev;

        return $this;
    }

    /**
     * Get cdActionprev
     *
     * @return string
     */
    public function getCdActionprev() {
        return $this->cdActionprev;
    }

    /**
     * Set lbActionprev
     *
     * @param string $lbActionprev
     *
     * @return RefActionPrevention
     */
    public function setLbActionprev($lbActionprev) {
        $this->lbActionprev = $lbActionprev;

        return $this;
    }

    /**
     * Get lbActionprev
     *
     * @return string
     */
    public function getLbActionprev() {
        return $this->lbActionprev;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefActionPrevention
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefActionPrevention
     */
    public function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefActionPrevention
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefActionPrevention
     */
    public function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    /**
     * Get idActionprev
     *
     * @return integer
     */
    public function getIdActionprev() {
        return $this->idActionprev;
    }

    /**
     * Get blNbjour
     *
     * @return integer
     */
    public function getBlNbjour() {
        return $this->blNbjour;
    }

    /**
     * Set blNbjour
     *
     * @param integer $blNbjour
     *
     * @return RefActionPrevention
     */
    public function setBlNbjour($blNbjour) {
        $this->blNbjour = $blNbjour;

        return $this;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefActionPrevention
     */
    public function addBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent) {
        $this->bilanSocialAgents[] = $bilanSocialAgent;

        return $this;
    }

    /**
     * Remove bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     */
    public function removeBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent) {
        $this->bilanSocialAgents->removeElement($bilanSocialAgent);
    }

    /**
     * Get bilanSocialAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgents() {
        return $this->bilanSocialAgents;
    }
    /**
     * Add informationCollectiviteAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\informationCollectiviteAgent $informationCollectiviteAgent
     *
     * @return RefActionPrevention
     */
    public function addInformationCollectiviteAgent(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $informationCollectiviteAgent) {
        $this->informationCollectiviteAgent[] = $informationCollectiviteAgent;

        return $this;
    }

    /**
     * Remove informationCollectiviteAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $informationCollectiviteAgent
     */
    public function removeInformationCollectiviteAgent(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $informationCollectiviteAgent) {
        $this->removeElement($informationCollectiviteAgent);
    }

    /**
     * Get informationCollectiviteAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInformationCollectiviteAgent() {
        return $this->informationCollectiviteAgent;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
