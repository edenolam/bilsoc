<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefEmploiNonPermanent
 * @UniqueEntity(
 *      fields="cdEmplnonperm",
 *      errorPath="cdEmplnonperm",
 *      message="Ce code est déjà existant."
 * )
 */
class RefEmploiNonPermanent extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdEmplnonperm;

    /**
     * @var string
     */
    protected $lbEmplnonperm;

    /**
     * @var boolean
     */
    protected $blCdg;

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
    protected $idEmplnonperm;
    protected $cdMotiN4ds;

    protected $cdMotiBcCiril;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $Etpr131AnneePrecedente;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $EtprAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RemunerationAgent;

    protected $cdDGCL;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $agentremucontnonperm_EmploiNonPermanent;

    /**
     * @var boolean
     */
    protected $blApa;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Etpr131AnneePrecedente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agentremucontnonperm_EmploiNonPermanent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->EtprAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationAgent = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdEmplnonperm
     *
     * @param string $cdEmplnonperm
     *
     * @return RefEmploiNonPermanent
     */
    public function setCdEmplnonperm($cdEmplnonperm) {
        $this->cdEmplnonperm = $cdEmplnonperm;

        return $this;
    }

    /**
     * Get cdEmplnonperm
     *
     * @return string
     */
    public function getCdEmplnonperm() {
        return $this->cdEmplnonperm;
    }

    /**
     * Set lbEmplnonperm
     *
     * @param string $lbEmplnonperm
     *
     * @return RefEmploiNonPermanent
     */
    public function setLbEmplnonperm($lbEmplnonperm) {
        $this->lbEmplnonperm = $lbEmplnonperm;

        return $this;
    }

    /**
     * Get lbEmplnonperm
     *
     * @return string
     */
    public function getLbEmplnonperm() {
        return $this->lbEmplnonperm;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefEmploiNonPermanent
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
     * @return RefEmploiNonPermanent
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
     * @return RefEmploiNonPermanent
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
     * @return RefEmploiNonPermanent
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
     * Get idEmplnonperm
     *
     * @return integer
     */
    public function getIdEmplnonperm() {
        return $this->idEmplnonperm;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefEmploiNonPermanent
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
     * Add Etpr131AnneePrecedente
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $Etpr131AnneePrecedente
     *
     * @return RefEmploiNonPermanent
     */
    public function addEtpr131AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $Etpr131AnneePrecedente) {
        $this->Etpr131AnneePrecedente[] = $Etpr131AnneePrecedente;

        return $this;
    }

    /**
     * Remove Etpr131AnneePrecedente
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $Etpr131AnneePrecedente
     */
    public function removeEtpr131AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente $Etpr131AnneePrecedente) {
        $this->Etpr131AnneePrecedente->removeElement($Etpr131AnneePrecedente);
    }

    /**
     * Get Etpr131AnneePrecedente
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtpr131AnneePrecedente() {
        return $this->Etpr131AnneePrecedente;
    }
    /**
     * Add EtprAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent
     *
     * @return RefEmploiNonPermanent
     */
    public function addEtprAgent(\Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent) {
        $this->EtprAgent[] = $EtprAgent;

        return $this;
    }

    /**
     * Remove EtprAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent
     */
    public function removeEtprAgent(\Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent) {
        $this->EtprAgent->removeElement($EtprAgent);
    }

    /**
     * Get EtprAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtprAgent() {
        return $this->EtprAgent;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getCdMotiN4ds() {
        return $this->cdMotiN4ds;
    }

    function setCdMotiN4ds($cdMotiN4ds) {
        $this->cdMotiN4ds = $cdMotiN4ds;
    }
    function getBlCdg() {
        return $this->blCdg;
    }

    function setBlCdg($blCdg) {
        $this->blCdg = $blCdg;
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

    /**
     * Set blApa
     *
     * @param boolean $blApa
     *
     * @return RefEmploiNonPermanent
     */
    public function setBlApa($blApa) {
        $this->blApa = $blApa;

        return $this;
    }

    /**
     * Get blApa
     *
     * @return boolean
     */
    public function getBlApa() {
        return $this->blApa;
    }


    /**
     * Add RemunerationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent
     *
     * @return RefEmploiNonPermanent
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

}
