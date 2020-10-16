<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefGrade
 * @UniqueEntity(
 *      fields="cdGrad",
 *      errorPath="cdGrad",
 *      message="Ce code est déjà existant."
 * )
 */
class RefGrade extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdGrad;

    /**
     * @var string
     */
    protected $lbGrad;

    /**
     * @var boolean
     */
    protected $blDeta;

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
    protected $idGrad;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents_deta;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    protected $refCadreEmploi;

    /**
     * @var boolean
     */
    protected $blCons;

    protected $cdMotiN4ds;

    protected $cdMotiBcCiril;


    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bilanSocialAgents_deta = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdGrad
     *
     * @param string $cdGrad
     *
     * @return RefGrade
     */
    public function setCdGrad($cdGrad) {
        $this->cdGrad = $cdGrad;

        return $this;
    }

    /**
     * Get cdGrad
     *
     * @return string
     */
    public function getCdGrad() {
        return $this->cdGrad;
    }

    /**
     * Set lbGrad
     *
     * @param string $lbGrad
     *
     * @return RefGrade
     */
    public function setLbGrad($lbGrad) {
        $this->lbGrad = $lbGrad;

        return $this;
    }

    /**
     * Get lbGrad
     *
     * @return string
     */
    public function getLbGrad() {
        return $this->lbGrad;
    }

    /**
     * Set blDeta
     *
     * @param boolean $blDeta
     *
     * @return RefGrade
     */
    public function setBlDeta($blDeta) {
        $this->blDeta = $blDeta;

        return $this;
    }

    /**
     * Get blDeta
     *
     * @return boolean
     */
    public function getBlDeta() {
        return $this->blDeta;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefGrade
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
     * @return RefGrade
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
     * @return RefGrade
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
     * @return RefGrade
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
     * Get idGrad
     *
     * @return integer
     */
    public function getIdGrad() {
        return $this->idGrad;
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

    function getCdMotiN4ds() {
        return $this->cdMotiN4ds;
    }

    function setCdMotiN4ds($cdMotiN4ds) {
        $this->cdMotiN4ds = $cdMotiN4ds;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefGrade
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
     * Add bilanSocialAgents_deta
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deta
     *
     * @return RefGrade
     */
    public function addBilanSocialAgents_deta(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deta) {
        $this->bilanSocialAgents_deta[] = $bilanSocialAgents_deta;

        return $this;
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

    /**
     * Set refCadreEmploi
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploi
     *
     * @return RefGrade
     */
    public function setRefCadreEmploi(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;

        return $this;
    }

    /**
     * Get refCadreEmploi
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    public function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getCdMotiBcCiril() {
        return $this->cdMotiBcCiril;
    }

    function setCdMotiBcCiril($cdMotiBcCiril) {
        $this->cdMotiBcCiril = $cdMotiBcCiril;
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
