<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefTypeActivite
 * @UniqueEntity(
 *      fields="cdTypeActi",
 *      errorPath="cdTypeActi",
 *      message="Ce code est déjà existant."
 * )
 */
class RefTypeActivite extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdTypeActi;

    /**
     * @var string
     */
    protected $lbTypeActi;

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
    protected $idTypeActi;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idTypeActiviteMaladiePro;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idTypeActiviteArretTravail;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idTypeActiviteMaladiePro = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idTypeActiviteArretTravail = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdTypeActi
     *
     * @param string $cdTypeActi
     *
     * @return RefTypeActivite
     */
    public function setCdTypeActi($cdTypeActi) {
        $this->cdTypeActi = $cdTypeActi;

        return $this;
    }

    /**
     * Get cdTypeActi
     *
     * @return string
     */
    public function getCdTypeActi() {
        return $this->cdTypeActi;
    }

    /**
     * Set lbTypeActi
     *
     * @param string $lbTypeActi
     *
     * @return RefTypeActivite
     */
    public function setLbTypeActi($lbTypeActi) {
        $this->lbTypeActi = $lbTypeActi;

        return $this;
    }

    /**
     * Get lbTypeActi
     *
     * @return string
     */
    public function getLbTypeActi() {
        return $this->lbTypeActi;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefTypeActivite
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
     * @return RefTypeActivite
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
     * @return RefTypeActivite
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
     * @return RefTypeActivite
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
     * Get idTypeActi
     *
     * @return integer
     */
    public function getIdTypeActi() {
        return $this->idTypeActi;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefTypeActivite
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
     * Add IdTypeActiviteMaladiePro
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteMaladiePros
     *
     * @return RefTypeActivite
     */
    public function addIdTypeActiviteMaladiePro(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteMaladiePros) {
        $this->idTypeActiviteMaladiePros[] = $idTypeActiviteMaladiePros;

        return $this;
    }

    /**
     * Remove Rassct
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteMaladiePros
     */
    public function removeIdTypeActiviteMaladiePro(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteMaladiePros) {
        $this->idTypeActiviteMaladiePros->removeElement($idTypeActiviteMaladiePros);
    }

    /**
     * Get idTypeActiviteMaladiePros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdTypeActiviteMaladiePros() {
        return $this->idTypeActiviteMaladiePros;
    }

    /**
     * Add IdTypeActiviteArretTravail
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteArretTravails
     *
     * @return RefTypeActivite
     */
    public function addIdTypeActiviteArretTravail(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteArretTravails) {
        $this->idTypeActiviteArretTravails[] = $idTypeActiviteArretTravails;

        return $this;
    }

    /**
     * Remove Rassct
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteArretTravails
     */
    public function removeIdTypeActiviteArretTravail(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idTypeActiviteArretTravails) {
        $this->idTypeActiviteArretTravails->removeElement($idTypeActiviteArretTravails);
    }

    /**
     * Get idTypeActiviteArretTravails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdTypeActiviteArretTravails() {
        return $this->idTypeActiviteArretTravails;
    }

}
