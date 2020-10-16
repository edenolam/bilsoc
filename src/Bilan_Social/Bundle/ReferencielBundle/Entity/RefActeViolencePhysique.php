<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefActeViolencePhysique
 * @UniqueEntity(
 *      fields="cdActviolphys",
 *      errorPath="cdActviolphys",
 *      message="Ce code est déjà existant."
 * )
 *  @Table(name="ref_acte_violence_physique",uniqueConstraints={@UniqueConstraint(name="cdActviolphys", columns={"cdActviolphys"})})
 */
class RefActeViolencePhysique extends RefAbstractEntity{

    /** Emanant du personnel avec arrêt de travail */
    const AVP001 = 'AVP001';
    /** Emanant des usagers avec arrêt de travail */
    const AVP003 = 'AVP003';

    /**
     * @var string
     */
    protected $cdActviolphys;

    /**
     * @var string
     */
    protected $lbActviolphys;

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
    protected $idActeviolphys;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $ActeViolencePhysique;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ActeViolencePhysique = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdActviolphys
     *
     * @param string $cdActviolphys
     *
     * @return RefActeViolencePhysique
     */
    public function setCdActviolphys($cdActviolphys) {
        $this->cdActviolphys = $cdActviolphys;

        return $this;
    }

    /**
     * Get cdActviolphys
     *
     * @return string
     */
    public function getCdActviolphys() {
        return $this->cdActviolphys;
    }

    /**
     * Set lbActviolphys
     *
     * @param string $lbActviolphys
     *
     * @return RefActeViolencePhysique
     */
    public function setLbActviolphys($lbActviolphys) {
        $this->lbActviolphys = $lbActviolphys;

        return $this;
    }

    /**
     * Get lbActviolphys
     *
     * @return string
     */
    public function getLbActviolphys() {
        return $this->lbActviolphys;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefActeViolencePhysique
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
     * @return RefActeViolencePhysique
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
     * @return RefActeViolencePhysique
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
     * @return RefActeViolencePhysique
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
     * Get idActeviolphys
     *
     * @return integer
     */
    public function getIdActeviolphys() {
        return $this->idActeviolphys;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefActeViolencePhysique
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
     * Add $ActeViolencePhysique
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $ActeViolencePhysique
     *
     * @return RefActeViolencePhysique
     */
    public function addActeViolencePhysique(\Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $ActeViolencePhysique) {
        $this->ActeViolencePhysique[] = $ActeViolencePhysique;

        return $this;
    }

    /**
     * Remove bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $ActeViolencePhysique
     */
    public function removeActeViolencePhysique(\Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique $ActeViolencePhysique) {
        $this->ActeViolencePhysique->removeElement($ActeViolencePhysique);
    }

    /**
     * Get bilanSocialAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActeViolencePhysique() {
        return $this->ActeViolencePhysique;
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
