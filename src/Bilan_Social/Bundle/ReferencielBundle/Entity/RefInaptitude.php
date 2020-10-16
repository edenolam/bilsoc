<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefInaptitude
 * @UniqueEntity(
 *      fields="cdInap",
 *      errorPath="cdInap",
 *      message="Ce code est déjà existant."
 * )
 */
class RefInaptitude extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdInap;

    /**
     * @var string
     */
    protected $lbInap;

    /**
     * @var boolean
     */
    protected $blDema;

    /**
     * @var boolean
     */
    protected $blDeci;

    /**
     * @var boolean
     */
    protected $blVisuagen;

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
    protected $idInap;

    /*
     * boolean
     */
    protected $blFili;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents_deci;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents_dema;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents_deci = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bilanSocialAgents_dema = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getBlFili() {
        return $this->blFili;
    }

    function setBlFili($blFili) {
        $this->blFili = $blFili;
    }

    /**
     * Set cdInap
     *
     * @param string $cdInap
     *
     * @return RefInaptitude
     */
    public function setCdInap($cdInap) {
        $this->cdInap = $cdInap;

        return $this;
    }

    /**
     * Get cdInap
     *
     * @return string
     */
    public function getCdInap() {
        return $this->cdInap;
    }

    /**
     * Set lbInap
     *
     * @param string $lbInap
     *
     * @return RefInaptitude
     */
    public function setLbInap($lbInap) {
        $this->lbInap = $lbInap;

        return $this;
    }

    /**
     * Get lbInap
     *
     * @return string
     */
    public function getLbInap() {
        return $this->lbInap;
    }

    /**
     * Set blDema
     *
     * @param boolean $blDema
     *
     * @return RefInaptitude
     */
    public function setBlDema($blDema) {
        $this->blDema = $blDema;

        return $this;
    }

    /**
     * Get blDema
     *
     * @return boolean
     */
    public function getBlDema() {
        return $this->blDema;
    }

    /**
     * Set blDeci
     *
     * @param boolean $blDeci
     *
     * @return RefInaptitude
     */
    public function setBlDeci($blDeci) {
        $this->blDeci = $blDeci;

        return $this;
    }

    /**
     * Get blDeci
     *
     * @return boolean
     */
    public function getBlDeci() {
        return $this->blDeci;
    }

    /**
     * Set blVisuagen
     *
     * @param boolean $blVisuagen
     *
     * @return RefInaptitude
     */
    public function setBlVisuagen($blVisuagen) {
        $this->blVisuagen = $blVisuagen;

        return $this;
    }

    /**
     * Get blVisuagen
     *
     * @return boolean
     */
    public function getBlVisuagen() {
        return $this->blVisuagen;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefInaptitude
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
     * @return RefInaptitude
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
     * @return RefInaptitude
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
     * @return RefInaptitude
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
     * Get idInap
     *
     * @return integer
     */
    public function getIdInap() {
        return $this->idInap;
    }

    /**
     * Add bilanSocialAgents_deci
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deci
     *
     * @return RefInaptitude
     */
    public function addBilanSocialAgentDeci(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deci) {
        $this->bilanSocialAgents_deci[] = $bilanSocialAgents_deci;

        return $this;
    }

    /**
     * Remove bilanSocialAgents_deci
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deci
     */
    public function removeBilanSocialAgentDeci(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_deci) {
        $this->bilanSocialAgents_deci->removeElement($bilanSocialAgents_deci);
    }

    /**
     * Get bilanSocialAgents_deci
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgentsDeci() {
        return $this->bilanSocialAgents_deci;
    }

    /**
     * Add bilanSocialAgents_dema
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_dema
     *
     * @return RefInaptitude
     */
    public function addBilanSocialAgentDema(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_dema) {
        $this->bilanSocialAgents_dema[] = $bilanSocialAgents_dema;

        return $this;
    }

    /**
     * Remove bilanSocialAgents_dema
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_dema
     */
    public function removeBilanSocialAgentDema(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_dema) {
        $this->bilanSocialAgents_dema->removeElement($bilanSocialAgents_dema);
    }

    /**
     * Get bilanSocialAgents_dema
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgentsDema() {
        return $this->bilanSocialAgents_dema;
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
