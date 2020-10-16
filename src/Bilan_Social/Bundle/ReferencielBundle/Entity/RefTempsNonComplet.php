<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefTempsNonComplet
 * @UniqueEntity(
 *      fields="cdTempnoncomp",
 *      errorPath="cdTempnoncomp",
 *      message="Ce code est déjà existant."
 * )
 */
class RefTempsNonComplet extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdTempnoncomp;

    /**
     * @var string
     */
    protected $lbTempnoncomp;

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
    protected $idTempnoncomp;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    protected $nbMinuteBorneMin;
    protected $nbMinuteBorneMax;


    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdTempnoncomp
     *
     * @param string $cdTempnoncomp
     *
     * @return RefTempsNonComplet
     */
    public function setCdTempnoncomp($cdTempnoncomp) {
        $this->cdTempnoncomp = $cdTempnoncomp;

        return $this;
    }

    /**
     * Get cdTempnoncomp
     *
     * @return string
     */
    public function getCdTempnoncomp() {
        return $this->cdTempnoncomp;
    }

    /**
     * Set lbTempnoncomp
     *
     * @param string $lbTempnoncomp
     *
     * @return RefTempsNonComplet
     */
    public function setLbTempnoncomp($lbTempnoncomp) {
        $this->lbTempnoncomp = $lbTempnoncomp;

        return $this;
    }

    /**
     * Get lbTempnoncomp
     *
     * @return string
     */
    public function getLbTempnoncomp() {
        return $this->lbTempnoncomp;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefTempsNonComplet
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
     * @return RefTempsNonComplet
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
     * @return RefTempsNonComplet
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
     * @return RefTempsNonComplet
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
     * Get idTempnoncomp
     *
     * @return integer
     */
    public function getIdTempnoncomp() {
        return $this->idTempnoncomp;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefTempsNonComplet
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


    function getNbMinuteBorneMin() {
        return $this->nbMinuteBorneMin;
    }

    function getNbMinuteBorneMax() {
        return $this->nbMinuteBorneMax;
    }

    function setNbMinuteBorneMin($nbMinuteBorneMin) {
        $this->nbMinuteBorneMin = $nbMinuteBorneMin;
    }

    function setNbMinuteBorneMax($nbMinuteBorneMax) {
        $this->nbMinuteBorneMax = $nbMinuteBorneMax;
    }



}
