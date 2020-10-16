<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMesureBoeth
 * @UniqueEntity(
 *      fields="cdMesureboeth",
 *      errorPath="cdMesureboeth",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMesureBoeth extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdMesureboeth;

    /**
     * @var string
     */
    protected $lbMesureboeth;

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
    protected $idMesureboeth;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idMesureInaptitudeAvantAnnee;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idMesureInaptitudeEnCoursAnnee;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idMesureInaptitudeAvantAnneeSauvegarde;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idMesureInaptitudeEnCoursAnneeSauvegarde;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idMesureInaptitudeAvantAnnee = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idMesureInaptitudeEnCoursAnnee = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idMesureInaptitudeAvantAnneeSauvegarde = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idMesureInaptitudeEnCoursAnneeSauvegarde = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdMesureboeth
     *
     * @param string $cdMesureboeth
     *
     * @return RefMesureBoeth
     */
    public function setCdMesureboeth($cdMesureboeth) {
        $this->cdMesureboeth = $cdMesureboeth;

        return $this;
    }

    /**
     * Get cdMesureboeth
     *
     * @return string
     */
    public function getCdMesureboeth() {
        return $this->cdMesureboeth;
    }

    /**
     * Set lbMesureboeth
     *
     * @param string $lbMesureboeth
     *
     * @return RefMesureBoeth
     */
    public function setLbMesureboeth($lbMesureboeth) {
        $this->lbMesureboeth = $lbMesureboeth;

        return $this;
    }

    /**
     * Get lbMesureboeth
     *
     * @return string
     */
    public function getLbMesureboeth() {
        return $this->lbMesureboeth;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMesureBoeth
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
     * @return RefMesureBoeth
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
     * @return RefMesureBoeth
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
     * @return RefMesureBoeth
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
     * Get idMesureboeth
     *
     * @return integer
     */
    public function getIdMesureboeth() {
        return $this->idMesureboeth;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefMesureBoeth
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
     * Add IdMesureInaptitudeAvantAnnee
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeAvantAnnees
     *
     * @return RefMesureBoeth
     */
    public function addIdMesureInaptitudeAvantAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeAvantAnnees) {
        $this->idMesureInaptitudeAvantAnnees[] = $idMesureInaptitudeAvantAnnees;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeAvantAnnees
     */
    public function removeIdMesureInaptitudeAvantAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeAvantAnnees) {
        $this->idMesureInaptitudeAvantAnnees->removeElement($idMesureInaptitudeAvantAnnees);
    }

    /**
     * Get idMesureInaptitudeAvantAnnees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdMesureInaptitudeAvantAnnees() {
        return $this->idMesureInaptitudeAvantAnnees;
    }

    /**
     * Add IdMesureInaptitudeEnCoursAnnee
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeEnCoursAnnees
     *
     * @return RefMesureBoeth
     */
    public function addIdMesureInaptitudeEnCoursAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeEnCoursAnnees) {
        $this->idMesureInaptitudeEnCoursAnnees[] = $idMesureInaptitudeEnCoursAnnees;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeEnCoursAnnees
     */
    public function removeIdMesureInaptitudeEnCoursAnnee(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idMesureInaptitudeEnCoursAnnees) {
        $this->idMesureInaptitudeEnCoursAnnees->removeElement($idMesureInaptitudeEnCoursAnnees);
    }

    /**
     * Get idMesureInaptitudeEnCoursAnnees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdMesureInaptitudeEnCoursAnnees() {
        return $this->idMesureInaptitudeEnCoursAnnees;
    }

    /**
     * Add IdMesureInaptitudeAvantAnnee
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeAvantAnnees
     *
     * @return RefMesureBoeth
     */
    public function addIdMesureInaptitudeAvantAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeAvantAnneeSauvegardes) {
        $this->idMesureInaptitudeAvantAnneeSauvegardes[] = $idMesureInaptitudeAvantAnneeSauvegardes;

        return $this;
    }

    /**
     * Remove SauvegardeDonneesAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeAvantAnneeSauvegardes
     */
    public function removeIdMesureInaptitudeAvantAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeAvantAnneeSauvegardes) {
        $this->idMesureInaptitudeAvantAnneeSauvegardes->removeElement($idMesureInaptitudeAvantAnneeSauvegardes);
    }

    /**
     * Get idMesureInaptitudeAvantAnneeSauvegardes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdMesureInaptitudeAvantAnneeSauvegardes() {
        return $this->idMesureInaptitudeAvantAnneeSauvegardes;
    }

    /**
     * Add IdMesureInaptitudeEnCoursAnneeSauvegarde
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeEnCoursAnneeSauvegardes
     *
     * @return RefMesureBoeth
     */
    public function addIdMesureInaptitudeEnCoursAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeEnCoursAnneeSauvegardes) {
        $this->idMesureInaptitudeEnCoursAnneeSauvegardes[] = $idMesureInaptitudeEnCoursAnneeSauvegardes;

        return $this;
    }

    /**
     * Remove SauvegardeDonneesAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeEnCoursAnneeSauvegardes
     */
    public function removeIdMesureInaptitudeEnCoursAnneeSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idMesureInaptitudeEnCoursAnneeSauvegardes) {
        $this->idMesureInaptitudeEnCoursAnneeSauvegardes->removeElement($idMesureInaptitudeEnCoursAnneeSauvegardes);
    }

    /**
     * Get idMesureInaptitudeEnCoursAnneeSauvegardes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdMesureInaptitudeEnCoursAnneeSauvegardes() {
        return $this->idMesureInaptitudeEnCoursAnneeSauvegardes;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }
}
