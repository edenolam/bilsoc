<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * AgentRemunerationContractuelNonPermanent
 */
class AgentRemunerationContractuelNonPermanent {

    /**
     * @var integer
     */
    private $r331h;

    /**
     * @var integer
     */
    private $r331f;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $idAgentRemunerationContratuelNonPermanent;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale
     */
    private $idInfoGene;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    private $refEmploiNonPermanent;

    /**
     * Set r331h
     *
     * @param integer $r331h
     *
     * @return AgentRemunerationContractuelNonPermanent
     */
    public function setR331h($r331h) {
        $this->r331h = $r331h;

        return $this;
    }

    /**
     * Get r331h
     *
     * @return integer
     */
    public function getR331h() {
        return $this->r331h;
    }

    /**
     * Set r331f
     *
     * @param integer $r331f
     *
     * @return AgentRemunerationContractuelNonPermanent
     */
    public function setR331f($r331f) {
        $this->r331f = $r331f;

        return $this;
    }

    /**
     * Get r331f
     *
     * @return integer
     */
    public function getR331f() {
        return $this->r331f;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return AgentRemunerationContractuelNonPermanent
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
     * @return AgentRemunerationContractuelNonPermanent
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AgentRemunerationContractuelNonPermanent
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return AgentRemunerationContractuelNonPermanent
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
     * Get idAgentRemunerationContratuelNonPermanent
     *
     * @return integer
     */
    public function getIdAgentRemunerationContratuelNonPermanent() {
        return $this->idAgentRemunerationContratuelNonPermanent;
    }

    /**
     * Set idInfoGene
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale $idInfoGene
     *
     * @return AgentRemunerationContractuelNonPermanent
     */
    public function setIdInfoGene(\Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale $idInfoGene = null) {
        $this->idInfoGene = $idInfoGene;

        return $this;
    }

    /**
     * Get idInfoGene
     *
     * @return \Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale
     */
    public function getIdInfoGene() {
        return $this->idInfoGene;
    }

    /**
     * Set refEmploiNonPermanent
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent
     *
     * @return AgentRemunerationContractuelNonPermanent
     */
    public function setRefEmploiNonPermanent(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent = null) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;

        return $this;
    }

    /**
     * Get refEmploiNonPermanent
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    public function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

}
