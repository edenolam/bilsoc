<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * AgentRemunerationContractuelPermanent
 */
class AgentRemunerationContractuelPermanent {

    /**
     * @var integer
     *  @Assert\Expression(
     *     "(this.getR3211h() + this.getR3114h()) <= this.getR321h()",
     *     message="Le montant total des rémunérations annuelles brutes pour les hommes doit être supérieur ou égal à la somme des autres rémunérations pour les hommes!"
     * )
     */
    private $r321h;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3211f() + this.getR3114f()) <= this.getR321f()",
     *     message="Le montant total des rémunérations annuelles brutes pour les femmes doit être supérieur ou égal à la somme des autres rémunérations pour les femmes!"
     * )
     */
    private $r321f;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3211h() + this.getR3114h()) <= this.getR321h()",
     *     message=""
     * )
     */
    private $r3211h;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3211f() + this.getR3114f()) <= this.getR321f()",
     *     message=""
     * )
     */
    private $r3211f;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3211h() + this.getR3114h()) <= this.getR321h()",
     *     message=""
     * )
     */
    private $r3114h;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3211f() + this.getR3114f()) <= this.getR321f()",
     *     message=""
     * )
     */
    private $r3114f;

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
    private $idAgentRemunerationContratuelPermanent;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale
     */
    private $idInfoGene;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    private $refCategorie;

    /**
     * Set r321h
     *
     * @param integer $r321h
     *
     * @return AgentRemunerationContractuelPermanent
     */
    public function setR321h($r321h) {
        $this->r321h = $r321h;

        return $this;
    }

    /**
     * Get r321h
     *
     * @return integer
     */
    public function getR321h() {
        return $this->r321h;
    }

    /**
     * Set r321f
     *
     * @param integer $r321f
     *
     * @return AgentRemunerationContractuelPermanent
     */
    public function setR321f($r321f) {
        $this->r321f = $r321f;

        return $this;
    }

    /**
     * Get r321f
     *
     * @return integer
     */
    public function getR321f() {
        return $this->r321f;
    }

    /**
     * Set r3211h
     *
     * @param integer $r3211h
     *
     * @return AgentRemunerationContractuelPermanent
     */
    public function setR3211h($r3211h) {
        $this->r3211h = $r3211h;

        return $this;
    }

    /**
     * Get r3211h
     *
     * @return integer
     */
    public function getR3211h() {
        return $this->r3211h;
    }

    /**
     * Set r3211f
     *
     * @param integer $r3211f
     *
     * @return AgentRemunerationContractuelPermanent
     */
    public function setR3211f($r3211f) {
        $this->r3211f = $r3211f;

        return $this;
    }

    /**
     * Get r3211f
     *
     * @return integer
     */
    public function getR3211f() {
        return $this->r3211f;
    }

    /**
     * Set r3114h
     *
     * @param integer $r3114h
     *
     * @return AgentRemunerationContractuelPermanent
     */
    public function setR3114h($r3114h) {
        $this->r3114h = $r3114h;

        return $this;
    }

    /**
     * Get r3114h
     *
     * @return integer
     */
    public function getR3114h() {
        return $this->r3114h;
    }

    /**
     * Set r3114f
     *
     * @param integer $r3114f
     *
     * @return AgentRemunerationContractuelPermanent
     */
    public function setR3114f($r3114f) {
        $this->r3114f = $r3114f;

        return $this;
    }

    /**
     * Get r3114f
     *
     * @return integer
     */
    public function getR3114f() {
        return $this->r3114f;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return AgentRemunerationContractuelPermanent
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
     * @return AgentRemunerationContractuelPermanent
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
     * @return AgentRemunerationContractuelPermanent
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
     * @return AgentRemunerationContractuelPermanent
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
     * Get idAgentRemunerationContratuelPermanent
     *
     * @return integer
     */
    public function getIdAgentRemunerationContratuelPermanent() {
        return $this->idAgentRemunerationContratuelPermanent;
    }

    /**
     * Set idInfoGene
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale $idInfoGene
     *
     * @return AgentRemunerationContractuelPermanent
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
     * Set refCategorie
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie
     *
     * @return AgentRemunerationContractuelPermanent
     */
    public function setRefCategorie(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie = null) {
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

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

}
