<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefInaptitudeBoeth
 * @UniqueEntity(
 *      fields="cdInaptitudeboeth",
 *      errorPath="cdInaptitudeboeth",
 *      message="Ce code est déjà existant."
 * )
 */
class RefInaptitudeBoeth extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdInaptitudeboeth;

    /**
     * @var string
     */
    protected $lbInaptitudeboeth;

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
    protected $idInaptitudeboeth;

    /**
     * @var integer
     */
    protected $idInaptitudeAvantAnnee;

    /**
     * @var integer
     */
    protected $idInaptitudeEnCoursAnnee;

    /**
     * @var integer
     */
    protected $idInaptitudeAvantAnneeSauvegarde;

    /**
     * @var integer
     */
    protected $idInaptitudeEnCoursAnneeSauvegarde;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idInaptitudeAvantAnnee = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idInaptitudeEnCoursAnnee = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idInaptitudeAvantAnneeSauvegarde = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idInaptitudeEnCoursAnneeSauvegarde = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdInaptitudeboeth
     *
     * @param string $cdInaptitudeboeth
     *
     * @return RefInaptitudeBoeth
     */
    public function setCdInaptitudeboeth($cdInaptitudeboeth) {
        $this->cdInaptitudeboeth = $cdInaptitudeboeth;

        return $this;
    }

    /**
     * Get cdInaptitudeboeth
     *
     * @return string
     */
    public function getCdInaptitudeboeth() {
        return $this->cdInaptitudeboeth;
    }

    /**
     * Set lbInaptitudeboeth
     *
     * @param string $lbInaptitudeboeth
     *
     * @return RefInaptitudeBoeth
     */
    public function setLbInaptitudeboeth($lbInaptitudeboeth) {
        $this->lbInaptitudeboeth = $lbInaptitudeboeth;

        return $this;
    }

    /**
     * Get lbInaptitudeboeth
     *
     * @return string
     */
    public function getLbInaptitudeboeth() {
        return $this->lbInaptitudeboeth;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefInaptitudeBoeth
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
     * @return RefInaptitudeBoeth
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
     * @return RefInaptitudeBoeth
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
     * @return RefInaptitudeBoeth
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
     * Get idInaptitudeboeth
     *
     * @return integer
     */
    public function getIdInaptitudeboeth() {
        return $this->idInaptitudeboeth;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefInaptitudeBoeth
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

    /**
     * Add IdInaptitudeAvantAnnee
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeAvantAnnees
     *
     * @return RefInaptitudeBoeth
     */
    public function addIdInaptitudeAvantAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeAvantAnnees) {
        $this->idInaptitudeAvantAnnees[] = $idInaptitudeAvantAnnees;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeAvantAnnees
     */
    public function removeIdInaptitudeAvantAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeAvantAnnees) {
        $this->idInaptitudeAvantAnnees->removeElement($idInaptitudeAvantAnnees);
    }

    /**
     * Get idInaptitudeAvantAnnees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdInaptitudeAvantAnnees() {
        return $this->idInaptitudeAvantAnnees;
    }

    /**
     * Add IdInaptitudeEnCoursAnnee
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeEnCoursAnnees
     *
     * @return RefInaptitudeBoeth
     */
    public function addIdInaptitudeEnCoursAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeEnCoursAnnees) {
        $this->idInaptitudeEnCoursAnnees[] = $idInaptitudeEnCoursAnnees;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeEnCoursAnnees
     */
    public function removeIdInaptitudeEnCoursAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idInaptitudeEnCoursAnnees) {
        $this->idInaptitudeEnCoursAnnees->removeElement($idInaptitudeEnCoursAnnees);
    }

    /**
     * Get idInaptitudeEnCoursAnnees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdInaptitudeEnCoursAnnees() {
        return $this->idInaptitudeEnCoursAnnees;
    }

    /**
     * Add IdInaptitudeAvantAnnee
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeAvantAnneeSauvegardes
     *
     * @return RefInaptitudeBoeth
     */
    public function addIdInaptitudeAvantAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeAvantAnneeSauvegardes) {
        $this->idInaptitudeAvantAnneeSauvegardes[] = $idInaptitudeAvantAnneeSauvegardes;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeAvantAnneeSauvegardes
     */
    public function removeIdInaptitudeAvantAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeAvantAnneeSauvegardes) {
        $this->idInaptitudeAvantAnneeSauvegardes->removeElement($idInaptitudeAvantAnneeSauvegardes);
    }

    /**
     * Get idInaptitudeAvantAnneeSauvegardes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getidInaptitudeAvantAnneeSauvegardes() {
        return $this->idInaptitudeAvantAnneeSauvegardes;
    }

    /**
     * Add IdInaptitudeEnCoursAnneeSauvegarde
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeEnCoursAnneeSauvegardes
     *
     * @return RefInaptitudeBoeth
     */
    public function addIdInaptitudeEnCoursAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeEnCoursAnneeSauvegardes) {
        $this->idInaptitudeEnCoursAnneeSauvegardes[] = $idInaptitudeEnCoursAnneeSauvegardes;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeEnCoursAnneeSauvegardes
     */
    public function removeIdInaptitudeEnCoursAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idInaptitudeEnCoursAnneeSauvegardes) {
        $this->idInaptitudeEnCoursAnneeSauvegardes->removeElement($idInaptitudeEnCoursAnneeSauvegardes);
    }

    /**
     * Get idInaptitudeEnCoursAnneeSauvegardes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getidInaptitudeEnCoursAnneeSauvegardes() {
        return $this->idInaptitudeEnCoursAnneeSauvegardes;
    }

}
