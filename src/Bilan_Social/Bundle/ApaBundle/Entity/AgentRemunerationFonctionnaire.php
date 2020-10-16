<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * AgentRemunerationFonctionnaire
 * 
 */
class AgentRemunerationFonctionnaire {
    
    /**
     * @var integer
     *  @Assert\Expression(
     *     "(this.getR3111h() + this.getR3113h() + this.getR3114h()) <= this.getR311h()",
     *     message="Le montant total des rémunérations annuelles brutes pour les hommes doit être supérieur ou égal à la somme des autres rémunérations pour les hommes!"
     * )
     */
    private $r311h;
   
    /**
     * @var integer
     * 
     * @Assert\Expression(
     *     "(this.getR3111f()  + this.getR3112f() + this.getR3113f() + this.getR3114f()) <= this.getR311f()",
     *     message="Le montant total des rémunérations annuelles brutes pour les femmes doit être supérieur ou égal à la somme des autres rémunérations pour les femmes!"
     * )
     */
    private $r311f;
     
    
    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111h()  + this.getR3112h() + this.getR3113h() + this.getR3114h()) <= this.getR311h()",
     *     message=""
     * )
     */
    private $r3111h;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111f() + this.getR3112f() + this.getR3113f() + this.getR3114f()) <= this.getR311f()",
     *     message=""
     * )
     */
    private $r3111f;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111h()  + this.getR3112h() + this.getR3113h() + this.getR3114h()) <= this.getR311h()",
     *     message=""
     * )
     */
    private $r3112h;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111f() + this.getR3112f() + this.getR3113f() + this.getR3114f()) <= this.getR311f()",
     *     message=""
     * )
     */
    private $r3112f;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111h()  + this.getR3112h() + this.getR3113h() + this.getR3114h()) <= this.getR311h()",
     *     message=""
     * )
     */
    private $r3113h;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111f() + this.getR3112f() + this.getR3113f() + this.getR3114f()) <= this.getR311f()",
     *     message=""
     * )
     */
    private $r3113f;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111h()  + this.getR3112h() + this.getR3113h() + this.getR3114h()) <= this.getR311h()",
     *     message=""
     * )
     */
    private $r3114h;

    /**
     * @var integer
     * @Assert\Expression(
     *     "(this.getR3111f() + this.getR3112f() + this.getR3113f() + this.getR3114f()) <= this.getR311f()",
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
    private $idAgentRemunerationFonctionnaire;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale
     */
    private $idInfoGene;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    private $refCategorie;

    /**
     * Set r311h
     *
     * @param integer $r311h
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR311h($r311h) {
        $this->r311h = $r311h;

        return $this;
    }

    /**
     * Get r311h
     *
     * @return integer
     */
    public function getR311h() {
        return $this->r311h;
    }

    /**
     * Set r311f
     *
     * @param integer $r311f
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR311f($r311f) {
        $this->r311f = $r311f;

        return $this;
    }

    /**
     * Get r311f
     *
     * @return integer
     */
    public function getR311f() {
        return $this->r311f;
    }

    /**
     * Set r3111h
     *
     * @param integer $r3111h
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR3111h($r3111h) {
        $this->r3111h = $r3111h;

        return $this;
    }

    /**
     * Get r3111h
     *
     * @return integer
     */
    public function getR3111h() {
        return $this->r3111h;
    }

    /**
     * Set r3111f
     *
     * @param integer $r3111f
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR3111f($r3111f) {
        $this->r3111f = $r3111f;

        return $this;
    }

    /**
     * Get r3111f
     *
     * @return integer
     */
    public function getR3111f() {
        return $this->r3111f;
    }

    /**
     * Set r3112h
     *
     * @param integer $r3112h
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR3112h($r3112h) {
        $this->r3112h = $r3112h;

        return $this;
    }

    /**
     * Get r3112h
     *
     * @return integer
     */
    public function getR3112h() {
        return $this->r3112h;
    }

    /**
     * Set r3112f
     *
     * @param integer $r3112f
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR3112f($r3112f) {
        $this->r3112f = $r3112f;

        return $this;
    }

    /**
     * Get r3112f
     *
     * @return integer
     */
    public function getR3112f() {
        return $this->r3112f;
    }

    /**
     * Set r3113h
     *
     * @param integer $r3113h
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR3113h($r3113h) {
        $this->r3113h = $r3113h;

        return $this;
    }

    /**
     * Get r3113h
     *
     * @return integer
     */
    public function getR3113h() {
        return $this->r3113h;
    }

    /**
     * Set r3113f
     *
     * @param integer $r3113f
     *
     * @return AgentRemunerationFonctionnaire
     */
    public function setR3113f($r3113f) {
        $this->r3113f = $r3113f;

        return $this;
    }

    /**
     * Get r3113f
     *
     * @return integer
     */
    public function getR3113f() {
        return $this->r3113f;
    }

    /**
     * Set r3114h
     *
     * @param integer $r3114h
     *
     * @return AgentRemunerationFonctionnaire
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
     * @return AgentRemunerationFonctionnaire
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
     * @return AgentRemunerationFonctionnaire
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
     * @return AgentRemunerationFonctionnaire
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
     * @return AgentRemunerationFonctionnaire
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
     * @return AgentRemunerationFonctionnaire
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
     * Get idAgentRemunerationFonctionnaire
     *
     * @return integer
     */
    public function getIdAgentRemunerationFonctionnaire() {
        return $this->idAgentRemunerationFonctionnaire;
    }

    /**
     * Set idInfoGene
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale $idInfoGene
     *
     * @return AgentRemunerationFonctionnaire
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
     * @return AgentRemunerationFonctionnaire
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
