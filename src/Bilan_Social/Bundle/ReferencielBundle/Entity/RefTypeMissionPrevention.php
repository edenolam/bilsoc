<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefTypeMissionPrevention
 * @UniqueEntity(
 *      fields="cdTypemissprev",
 *      errorPath="cdTypemissprev",
 *      message="Ce code est déjà existant."
 * )
 */
class RefTypeMissionPrevention extends RefAbstractEntity{

    /**
     * @var integer
     */
    protected $idTypeColl;

    /**
     * @var string
     */
    protected $cdTypemissprev;

    /**
     * @var string
     */
    protected $lbTypemissprev;

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
    protected $idTypemissprev;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set idTypeColl
     *
     * @param integer $idTypeColl
     *
     * @return RefTypeMissionPrevention
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
     * Set cdTypemissprev
     *
     * @param string $cdTypemissprev
     *
     * @return RefTypeMissionPrevention
     */
    public function setCdTypemissprev($cdTypemissprev) {
        $this->cdTypemissprev = $cdTypemissprev;

        return $this;
    }

    /**
     * Get cdTypemissprev
     *
     * @return string
     */
    public function getCdTypemissprev() {
        return $this->cdTypemissprev;
    }

    /**
     * Set lbTypemissprev
     *
     * @param string $lbTypemissprev
     *
     * @return RefTypeMissionPrevention
     */
    public function setLbTypemissprev($lbTypemissprev) {
        $this->lbTypemissprev = $lbTypemissprev;

        return $this;
    }

    /**
     * Get lbTypemissprev
     *
     * @return string
     */
    public function getLbTypemissprev() {
        return $this->lbTypemissprev;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefTypeMissionPrevention
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
     * @return RefTypeMissionPrevention
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
     * @return RefTypeMissionPrevention
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
     * @return RefTypeMissionPrevention
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
     * Get idTypemissprev
     *
     * @return integer
     */
    public function getIdTypemissprev() {
        return $this->idTypemissprev;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefTypeMissionPrevention
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

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
