<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMotifDepart
 * @UniqueEntity(
 *      fields="cdMotidepa",
 *      errorPath="cdMotidepa",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMotifDepart extends RefAbstractEntity{

    /**
     * @var integer
     */
    protected $idStat;

    /**
     * @var string
     */
    protected $cdMotidepa;

    /**
     * @var string
     */
    protected $lbMotidepa;

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
    protected $idMotidepa;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $statutMotifDeparts;

    /**
     * @var boolean
     */
    protected $blFonc;

    /**
     * @var boolean
     */
    protected $blContperm;

    /**
     * @var boolean
     */
    protected $blDepatemp;

    /**
     * @var boolean
     */
    protected $blDepatempRemu;

    /**
     * @var boolean
     */
    protected $blDepadefi;


    protected $cdMotiN4ds;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statutMotifDeparts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set idStat
     *
     * @param integer $idStat
     *
     * @return RefMotifDepart
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
     * Set cdMotidepa
     *
     * @param string $cdMotidepa
     *
     * @return RefMotifDepart
     */
    public function setCdMotidepa($cdMotidepa) {
        $this->cdMotidepa = $cdMotidepa;

        return $this;
    }

    /**
     * Get cdMotidepa
     *
     * @return string
     */
    public function getCdMotidepa() {
        return $this->cdMotidepa;
    }

    /**
     * Set lbMotidepa
     *
     * @param string $lbMotidepa
     *
     * @return RefMotifDepart
     */
    public function setLbMotidepa($lbMotidepa) {
        $this->lbMotidepa = $lbMotidepa;

        return $this;
    }

    /**
     * Get lbMotidepa
     *
     * @return string
     */
    public function getLbMotidepa() {
        return $this->lbMotidepa;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMotifDepart
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
     * @return RefMotifDepart
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
     * @return RefMotifDepart
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
     * @return RefMotifDepart
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
     * Get idMotidepa
     *
     * @return integer
     */
    public function getIdMotidepa() {
        return $this->idMotidepa;
    }

    /**
     * Set blFonc
     *
     * @param boolean $blFonc
     *
     * @return RefMotifDepart
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
     * @return RefMotifDepart
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

    /**
     * Set blDepatemp
     *
     * @param boolean $blDepatemp
     *
     * @return RefMotifDepart
     */
    public function setBlDepatemp($blDepatemp) {
        $this->blDepatemp = $blDepatemp;

        return $this;
    }

    /**
     * Get blDepatemp
     *
     * @return boolean
     */
    public function getBlDepatemp() {
        return $this->blDepatemp;
    }

    /**
     * Set blDepadefi
     *
     * @param boolean $blDepadefi
     *
     * @return RefMotifDepart
     */
    public function setBlDepadefi($blDepadefi) {
        $this->blDepadefi = $blDepadefi;

        return $this;
    }

    /**
     * Get blDepadefi
     *
     * @return boolean
     */
    public function getBlDepadefi() {
        return $this->blDepadefi;
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
     * @return RefMotifDepart
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
     * Add statut_motif_depart
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifDeparts
     *
     * @return RefMotifStatut
     */
    public function addStatutMotifDeparts(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifDeparts) {
        $this->statutMotifDeparts[] = $statutMotifDeparts;

        return $this;
    }

    /**
     * Remove statut_motif_depart
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifDeparts
     */
    public function removeStatutMotifDeparts(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifDeparts) {
        $this->statutMotifDeparts->removeElement($statutMotifDeparts);
    }

    /**
     * Get statut_motif_depart
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatutMotifDeparts() {
        return $this->statutMotifDeparts;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }
    function getBlDepatempRemu() {
        return $this->blDepatempRemu;
    }

    function setBlDepatempRemu($blDepatempRemu) {
        $this->blDepatempRemu = $blDepatempRemu;
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
