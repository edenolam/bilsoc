<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefCycleTravail
 * @UniqueEntity(
 *      fields="cdCycltrav",
 *      errorPath="cdCycltrav",
 *      message="Ce code est déjà existant."
 * )
 */
class RefCycleTravail extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdCycltrav;

    /**
     * @var string
     */
    protected $lbCycltrav;

    /**
     * @var string
     */
    protected $lbGroupeCycltrav;

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
    protected $idCycltrav;

    protected $cdDGCL;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdCycltrav
     *
     * @param string $cdCycltrav
     *
     * @return RefCycleTravail
     */
    public function setCdCycltrav($cdCycltrav) {
        $this->cdCycltrav = $cdCycltrav;

        return $this;
    }

    /**
     * Get cdCycltrav
     *
     * @return string
     */
    public function getCdCycltrav() {
        return $this->cdCycltrav;
    }

    /**
     * Set lbCycltrav
     *
     * @param string $lbCycltrav
     *
     * @return RefCycleTravail
     */
    public function setLbCycltrav($lbCycltrav) {
        $this->lbCycltrav = $lbCycltrav;

        return $this;
    }

    /**
     * Get lbCycltrav
     *
     * @return string
     */
    public function getLbCycltrav() {
        return $this->lbCycltrav;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefCycleTravail
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
     * @return RefCycleTravail
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
     * @return RefCycleTravail
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
     * @return RefCycleTravail
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
     * Get idCycltrav
     *
     * @return integer
     */
    public function getIdCycltrav() {
        return $this->idCycltrav;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefCycleTravail
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

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getLbGroupeCycltrav() {
        return $this->lbGroupeCycltrav;
    }

    function setLbGroupeCycltrav($lbGroupeCycltrav) {
        $this->lbGroupeCycltrav = $lbGroupeCycltrav;
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
