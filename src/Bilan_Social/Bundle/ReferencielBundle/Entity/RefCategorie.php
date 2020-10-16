<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefCategorie
 * @UniqueEntity(
 *      fields="cdCate",
 *      errorPath="cdCate",
 *      message="Ce code est déjà existant."
 * )
 */
class RefCategorie extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdCate;

    /**
     * @var string
     */
    protected $lbCate;

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
    protected $idCate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $sante_categorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $agentremufonctionnaire_categorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $agentremucontperm_categorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RemunerationGlobaleAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RemunerationAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $prevoyance_categorie;

    /**
     * @var boolean
     */
    protected $blCons;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sante_categorie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->prevoyance_categorie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agentremufonctionnaire_categorie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agentremucontperm_categorie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationGlobaleAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationAgent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdCate
     *
     * @param string $cdCate
     *
     * @return RefCategorie
     */
    public function setCdCate($cdCate) {
        $this->cdCate = $cdCate;

        return $this;
    }

    /**
     * Get cdCate
     *
     * @return string
     */
    public function getCdCate() {
        return $this->cdCate;
    }

    /**
     * Set lbCate
     *
     * @param string $lbCate
     *
     * @return RefCategorie
     */
    public function setLbCate($lbCate) {
        $this->lbCate = $lbCate;

        return $this;
    }

    /**
     * Get lbCate
     *
     * @return string
     */
    public function getLbCate() {
        return $this->lbCate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefCategorie
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
     * @return RefCategorie
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
     * @return RefCategorie
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
     * @return RefCategorie
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
     * Get idCate
     *
     * @return integer
     */
    public function getIdCate() {
        return $this->idCate;
    }

    /**
     * Set blCons
     *
     * @param boolean $blCons
     *
     * @return RefCategorie
     */
    public function setBlCons($blCons) {
        $this->blCons = $blCons;

        return $this;
    }

    /**
     * Get blCons
     *
     * @return boolean
     */
    public function getBlCons() {
        return $this->blCons;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefCategorie
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
     * Add RemunerationGlobaleAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent
     *
     * @return RefCategorie
     */
    public function addRemunerationGlobaleAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent) {
        $this->RemunerationGlobaleAgent[] = $RemunerationGlobaleAgent;

        return $this;
    }

    /**
     * Remove RemunerationGlobaleAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent
     */
    public function removeRemunerationGlobaleAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent) {
        $this->RemunerationGlobaleAgent->removeElement($RemunerationGlobaleAgent);
    }

    /**
     * Get RemunerationGlobaleAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRemunerationGlobaleAgent() {
        return $this->RemunerationGlobaleAgent;
    }


    /**
     * Add RemunerationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent
     *
     * @return RefCategorie
     */
    public function addRemunerationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent) {
        $this->RemunerationAgent[] = $RemunerationAgent;

        return $this;
    }

    /**
     * Remove RemunerationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent
     */
    public function removeRemunerationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent) {
        $this->RemunerationAgent->removeElement($RemunerationAgent);
    }

    /**
     * Get RemunerationAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRemunerationAgent() {
        return $this->RemunerationAgent;
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
