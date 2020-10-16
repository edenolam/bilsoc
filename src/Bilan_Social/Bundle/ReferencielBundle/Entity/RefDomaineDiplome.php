<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefDomaineDiplome
 * @UniqueEntity(
 *      fields="cdDomaineDiplome",
 *      errorPath="cdDomaineDiplome",
 *      message="Ce code est déjà existant."
 * )
 */
class RefDomaineDiplome extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdDomaineDiplome;

    /**
     * @var string
     */
    protected $lbDomaineDiplome;

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
    protected $idDomaineDiplome;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idDernierDiplome;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idDomaineDiplomeGpeec;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idDomaineDiplomeGpeecSauvegarde;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idDernierDiplome = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idDomaineDiplomeGpeec = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idDomaineDiplomeGpeecSauvegarde = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdDomaineDiplome
     *
     * @param string $cdDomaineDiplome
     *
     * @return RefDomaineDiplome
     */
    public function setCdDomaineDiplome($cdDomaineDiplome) {
        $this->cdDomaineDiplome = $cdDomaineDiplome;

        return $this;
    }

    /**
     * Get cdDomaineDiplome
     *
     * @return string
     */
    public function getCdDomaineDiplome() {
        return $this->cdDomaineDiplome;
    }

    /**
     * Set lbDomaineDiplome
     *
     * @param string $lbDomaineDiplome
     *
     * @return RefDomaineDiplome
     */
    public function setLbDomaineDiplome($lbDomaineDiplome) {
        $this->lbDomaineDiplome = $lbDomaineDiplome;

        return $this;
    }

    /**
     * Get lbDomaineDiplome
     *
     * @return string
     */
    public function getLbDomaineDiplome() {
        return $this->lbDomaineDiplome;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefDomaineDiplome
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
     * @return RefDomaineDiplome
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
     * @return RefDomaineDiplome
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
     * @return RefDomaineDiplome
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
     * Get idDomaineDiplome
     *
     * @return integer
     */
    public function getIdDomaineDiplome() {
        return $this->idDomaineDiplome;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Add IdDernierDiplome
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idDernierDiplomes
     *
     * @return RefDernierDiplome
     */
    public function addIdDernierDiplome(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idDernierDiplomes) {
        $this->idDernierDiplomes[] = $idDernierDiplomes;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idDernierDiplomes
     */
    public function removeIdDernierDiplome(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idDernierDiplomes) {
        $this->idDernierDiplomes->removeElement($idDernierDiplomes);
    }

    /**
     * Get idDernierDiplomes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdDernierDiplomes() {
        return $this->idDernierDiplomes;
    }

    /**
     * Add IdDomaineDiplomeGpeec
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Gpeec $idDomaineDiplomeGpeecs
     *
     * @return RefDomaineDiplomeGpeec
     */
    public function addIdDomaineDiplomeGpeec(\Bilan_Social\Bundle\ApaBundle\Entity\Gpeec $idDomaineDiplomeGpeecs) {
        $this->idDomaineDiplomeGpeecs[] = $idDomaineDiplomeGpeecs;

        return $this;
    }

    /**
     * Remove Gpeec
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Gpeec $idDomaineDiplomeGpeecs
     */
    public function removeIdDomaineDiplomeGpeec(\Bilan_Social\Bundle\ApaBundle\Entity\Gpeec $idDomaineDiplomeGpeecs) {
        $this->idDomaineDiplomeGpeecs->removeElement($idDomaineDiplomeGpeecs);
    }

    /**
     * Get idDomaineDiplomeGpeecs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdDomaineDiplomeGpeecs() {
        return $this->idDomaineDiplomeGpeecs;
    }

    /**
     * Add IdDomaineDiplomeGpeec
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Gpeec $idDomaineDiplomeGpeecs
     *
     * @return RefDomaineDiplomeGpeec
     */
    public function addIdDomaineDiplomeGpeecSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idDomaineDiplomeGpeecSauvegardes) {
        $this->idDomaineDiplomeGpeecSauvegardes[] = $idDomaineDiplomeGpeecSauvegardes;

        return $this;
    }

    /**
     * Remove Gpeec
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Gpeec $idDomaineDiplomeGpeecs
     */
    public function removeIdDomaineDiplomeGpeecSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idDomaineDiplomeGpeecSauvegardes) {
        $this->idDomaineDiplomeGpeecSauvegardes->removeElement($idDomaineDiplomeGpeecSauvegardes);
    }

    /**
     * Get idDomaineDiplomeGpeecs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdDomaineDiplomeGpeecSauvegardes() {
        return $this->idDomaineDiplomeGpeecSauvegardes;
    }

}
