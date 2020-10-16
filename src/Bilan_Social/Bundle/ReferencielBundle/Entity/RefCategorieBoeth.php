<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefCategorieBoeth
 * @UniqueEntity(
 *      fields="cdCategorieboeth",
 *      errorPath="cdCategorieboeth",
 *      message="Ce code est déjà existant."
 * )
 */
class RefCategorieBoeth extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdCategorieboeth;

    /**
     * @var string
     */
    protected $lbCategorieboeth;

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
    protected $idCategorieboeth;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idCategorieHanditorial;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idCategorieHanditorialSauvegarde;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCategorieHanditorial = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idCategorieHanditorialSauvegarde = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdCategorieboeth
     *
     * @param string $cdCategorieboeth
     *
     * @return RefCategorieBoeth
     */
    public function setCdCategorieboeth($cdCategorieboeth) {
        $this->cdCategorieboeth = $cdCategorieboeth;

        return $this;
    }

    /**
     * Get cdCategorieboeth
     *
     * @return string
     */
    public function getCdCategorieboeth() {
        return $this->cdCategorieboeth;
    }

    /**
     * Set lbCategorieboeth
     *
     * @param string $lbCategorieboeth
     *
     * @return RefCategorieBoeth
     */
    public function setLbCategorieboeth($lbCategorieboeth) {
        $this->lbCategorieboeth = $lbCategorieboeth;

        return $this;
    }

    /**
     * Get lbCategorieboeth
     *
     * @return string
     */
    public function getLbCategorieboeth() {
        return $this->lbCategorieboeth;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefCategorieBoeth
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
     * @return RefCategorieBoeth
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
     * @return RefCategorieBoeth
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
     * @return RefCategorieBoeth
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
     * Get idCategorieboeth
     *
     * @return integer
     */
    public function getIdCategorieboeth() {
        return $this->idCategorieboeth;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefCategorieBoeth
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
     * Add idCategorieHanditorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idCategorieHanditorial
     *
     * @return RefCategorieBoeth
     */
    public function addIdCategorieHanditorial(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idCategorieHanditorial) {
        $this->idCategorieHanditorial[] = $idCategorieHanditorial;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idCategorieHanditorial
     */
    public function removeIdCategorieHanditorial(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idCategorieHanditorial) {
        $this->idCategorieHanditorial->removeElement($idCategorieHanditorial);
    }

    /**
     * Get idCategorieHanditorial
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdCategorieHanditorial() {
        return $this->idCategorieHanditorial;
    }

    /**
     * Add idCategorieHanditorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idCategorieHanditorial
     *
     * @return RefCategorieBoeth
     */
    public function addIdCategorieHanditorialSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idCategorieHanditorialSauvegarde) {
        $this->idCategorieHanditorialSauvegarde[] = $idCategorieHanditorialSauvegarde;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idCategorieHanditorial
     */
    public function removeIdCategorieHanditorialSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idCategorieHanditorialSauvegarde) {
        $this->idCategorieHanditorialSauvegarde->removeElement($idCategorieHanditorialSauvegarde);
    }

    /**
     * Get idCategorieHanditorial
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdCategorieHanditorialSauvegarde() {
        return $this->idCategorieHanditorialSauvegarde;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }
}
