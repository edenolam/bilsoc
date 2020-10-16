<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMotifArrivee
 * @UniqueEntity(
 *      fields="cdMotiarri",
 *      errorPath="cdMotiarri",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMotifArrivee extends RefAbstractEntity{

    /**
     * @var integer
     */
    protected $idStat;

    /**
     * @var string
     */
    protected $cdMotiarri;

    /**
     * @var string
     */
    protected $lbMotiarri;

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
    protected $idMotiarri;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var boolean
     */
    protected $blFonc;

    /**
     * @var boolean
     */
    protected $blContperm;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $statutMotifArrivees;

    protected $cdMotiN4ds;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statutMotifArrivees = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set idStat
     *
     * @param integer $idStat
     *
     * @return RefMotifArrivee
     */
    public function setIdStat($idStat) {
        $this->idStat = $idStat;

        return $this;
    }

    /**
     * Get idStat
     *
     * @return integer
     */
    public function getIdStat() {
        return $this->idStat;
    }

    /**
     * Set cdMotiarri
     *
     * @param string $cdMotiarri
     *
     * @return RefMotifArrivee
     */
    public function setCdMotiarri($cdMotiarri) {
        $this->cdMotiarri = $cdMotiarri;

        return $this;
    }

    /**
     * Get cdMotiarri
     *
     * @return string
     */
    public function getCdMotiarri() {
        return $this->cdMotiarri;
    }

    /**
     * Set lbMotiarri
     *
     * @param string $lbMotiarri
     *
     * @return RefMotifArrivee
     */
    public function setLbMotiarri($lbMotiarri) {
        $this->lbMotiarri = $lbMotiarri;

        return $this;
    }

    /**
     * Get lbMotiarri
     *
     * @return string
     */
    public function getLbMotiarri() {
        return $this->lbMotiarri;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMotifArrivee
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
     * @return RefMotifArrivee
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
     * @return RefMotifArrivee
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
     * @return RefMotifArrivee
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
     * Get idMotiarri
     *
     * @return integer
     */
    public function getIdMotiarri() {
        return $this->idMotiarri;
    }

    /**
     * Set blFonc
     *
     * @param boolean $blFonc
     *
     * @return RefMotifArrivee
     */
    public function setBlFonc($blFonc) {
        $this->blFonc = $blFonc;

        return $this;
    }

    /**
     * Get blFonc
     *
     * @return boolean
     */
    public function getBlFonc() {
        return $this->blFonc;
    }

    /**
     * Set blContperm
     *
     * @param boolean $blContperm
     *
     * @return RefMotifArrivee
     */
    public function setBlContperm($blContperm) {
        $this->blContperm = $blContperm;

        return $this;
    }

    /**
     * Get blContperm
     *
     * @return boolean
     */
    public function getBlContperm() {
        return $this->blContperm;
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
     * @return RefMotifArrivee
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
     * Add statutMotifArrivees
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifArrivees
     *
     * @return RefStatut
     */
    public function addStatutMotifArrivees(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifArrivees) {
        $this->statutMotifArrivees[] = $statutMotifArrivees;

        return $this;
    }

    /**
     * Remove statutMotifArrivees
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifArrivees
     */
    public function removeStatutMotifArrivees(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifArrivees) {
        $this->statutMotifArrivees->removeElement($statutMotifArrivees);
    }

    /**
     * Get statutMotifArrivees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatutMotifArrivees() {
        return $this->statutMotifArrivees;
    }

    /**
     * Get bilanSocialAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgents() {
        return $this->bilanSocialAgents;
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
