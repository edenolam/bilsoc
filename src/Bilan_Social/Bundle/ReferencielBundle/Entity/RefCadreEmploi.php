<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefCadreEmploi
 * @UniqueEntity(
 *      fields="cdCadrempl",
 *      errorPath="cdCadrempl",
 *      message="Ce code est déjà existant."
 * )
 */
class RefCadreEmploi extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdCadrempl;

    /**
     * @var string
     */
    protected $lbCadrempl;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var string
     */
    protected $cdUtilmodi;

    /**
     * @var integer
     */
    protected $idCadrempl;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgentCadreEmploiOrigin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $HeuSuppReaRemAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $HeuCompReaRemAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    protected $refFiliere;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    protected $refCategorie;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents_deta;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

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
        $this->bilanSocialAgentCadreEmploiOrigin = new \Doctrine\Common\Collections\ArrayCollection();
        $this->HeuSuppReaRemAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->HeuCompReaRemAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bilanSocialAgents_deta = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cdCadrempl
     *
     * @param string $cdCadrempl
     *
     * @return RefCadreEmploi
     */
    public function setCdCadrempl($cdCadrempl) {
        $this->cdCadrempl = $cdCadrempl;

        return $this;
    }

    /**
     * Get cdCadrempl
     *
     * @return string
     */
    public function getCdCadrempl() {
        return $this->cdCadrempl;
    }

    /**
     * Set lbCadrempl
     *
     * @param string $lbCadrempl
     *
     * @return RefCadreEmploi
     */
    public function setLbCadrempl($lbCadrempl) {
        $this->lbCadrempl = $lbCadrempl;

        return $this;
    }

    /**
     * Get lbCadrempl
     *
     * @return string
     */
    public function getLbCadrempl() {
        return $this->lbCadrempl;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefCadreEmploi
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
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefCadreEmploi
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
     * Get idCadrempl
     *
     * @return integer
     */
    public function getIdCadrempl() {
        return $this->idCadrempl;
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
     * @return RefCadreEmploi
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
     * Add bilanSocialAgentCadreEmploiOrigin
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentCadreEmploiOrigin
     *
     * @return RefCadreEmploi
     */
    public function addBilanSocialAgentCadreEmploiOrigin(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentCadreEmploiOrigin) {
        $this->bilanSocialAgentCadreEmploiOrigin[] = $bilanSocialAgentCadreEmploiOrigin;

        return $this;
    }

    /**
     * Remove bilanSocialAgentCadreEmploiOrigin
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentCadreEmploiOrigin
     */
    public function removeBilanSocialAgentCadreEmploiOrigin(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentCadreEmploiOrigin) {
        $this->bilanSocialAgentCadreEmploiOrigin->removeElement($bilanSocialAgentCadreEmploiOrigin);
    }

    /**
     * Get bilanSocialAgentCadreEmploiOrigin
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgentCadreEmploiOrigin() {
        return $this->bilanSocialAgentCadreEmploiOrigin;
    }

    /**
     * Add HeuSuppReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent
     *
     * @return RefCadreEmploi
     */
    public function addHeuSuppReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent) {
        $this->HeuSuppReaRemAgent[] = $HeuSuppReaRemAgent;

        return $this;
    }

    /**
     * Remove HeuSuppReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent
     */
    public function removeHeuSuppReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent) {
        $this->HeuSuppReaRemAgent->removeElement($HeuSuppReaRemAgent);
    }

    /**
     * Get HeuSuppReaRemAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeuSuppReaRemAgent() {
        return $this->HeuSuppReaRemAgent;
    }

    /**
     * Add HeuCompReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent
     *
     * @return RefCadreEmploi
     */
    public function addHeuCompReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent) {
        $this->HeuCompReaRemAgent[] = $HeuCompReaRemAgent;

        return $this;
    }

    /**
     * Remove HeuCompReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent
     */
    public function removeHeuCompReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent) {
        $this->HeuCompReaRemAgent->removeElement($HeuCompReaRemAgent);
    }

    /**
     * Get HeuCompReaRemAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeuCompReaRemAgent() {
        return $this->HeuCompReaRemAgent;
    }

    /**
     * Set refFiliere
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
     *
     * @return RefCadreEmploi
     */
    public function setRefFiliere(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere) {
        $this->refFiliere = $refFiliere;

        return $this;
    }

    /**
     * Get refFiliere
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getRefFiliere() {
        return $this->refFiliere;
    }

    /**
     * Set refCategorie
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie
     *
     * @return RefCadreEmploi
     */
    public function setRefCategorie(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie) {
        $this->refCategorie = $refCategorie;

        return $this;
    }

    /**
     * Get refCategorie
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    public function getRefCategorie() {
        return $this->refCategorie;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Remove bilanSocialAgents_deta
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deta
     */
    public function removeBilanSocialAgents_deta(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deta) {
        $this->bilanSocialAgents_deta->removeElement($bilanSocialAgents_deta);
    }

    /**
     * Get bilanSocialAgents_deta
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgents_deta() {
        return $this->bilanSocialAgents_deta;
    }


    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }


}
