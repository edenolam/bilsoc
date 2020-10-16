<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMaladieProfessionnelle
 * @UniqueEntity(
 *      fields="cdMaladiepro",
 *      errorPath="cdMaladiepro",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMaladieProfessionnelle extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdMaladiepro;

    /**
     * @var string
     */
    protected $lbMaladiepro;

    /**
     * @var string
     */
    protected $numTabl;

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
    protected $idMaladiepro;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idMaladieProfessionnelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idMaladieProfessionnelle = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdMaladiepro
     *
     * @param string $cdMaladiepro
     *
     * @return RefMaladieProfessionnelle
     */
    public function setCdMaladiepro($cdMaladiepro) {
        $this->cdMaladiepro = $cdMaladiepro;

        return $this;
    }

    /**
     * Get cdMaladiepro
     *
     * @return string
     */
    public function getCdMaladiepro() {
        return $this->cdMaladiepro;
    }

    /**
     * Set lbMaladiepro
     *
     * @param string $lbMaladiepro
     *
     * @return RefMaladieProfessionnelle
     */
    public function setLbMaladiepro($lbMaladiepro) {
        $this->lbMaladiepro = $lbMaladiepro;

        return $this;
    }

    /**
     * Get lbMaladiepro
     *
     * @return string
     */
    public function getLbMaladiepro() {
        return $this->lbMaladiepro;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMaladieProfessionnelle
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
     * @return RefMaladieProfessionnelle
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
     * @return RefMaladieProfessionnelle
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
     * @return RefMaladieProfessionnelle
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
     * Get idMaladiepro
     *
     * @return integer
     */
    public function getIdMaladiepro() {
        return $this->idMaladiepro;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefMaladieProfessionnelle
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
     * Add IdMaladieProfessionnelle
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idMaladieProfessionnelles
     *
     * @return RefMaladieProfessionnelle
     */
    public function addIdMaladieProfessionnelle(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idMaladieProfessionnelles) {
        $this->idMaladieProfessionnelles[] = $idMaladieProfessionnelles;

        return $this;
    }

    /**
     * Remove Rassct
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Rassct $idMaladieProfessionnelles
     */
    public function removeIdMaladieProfessionnelle(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idMaladieProfessionnelles) {
        $this->idMaladieProfessionnelles->removeElement($idMaladieProfessionnelles);
    }

    /**
     * Get idMaladieProfessionnelles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdMaladieProfessionnelles() {
        return $this->idMaladieProfessionnelles;
    }

    
    function getNumTabl() {
        return $this->numTabl;
    }

    function setNumTabl($numTabl) {
        $this->numTabl = $numTabl;
    }

}
