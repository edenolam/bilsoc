<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefElementMateriel
 * @UniqueEntity(
 *      fields="cdElementmat",
 *      errorPath="cdElementmat",
 *      message="Ce code est déjà existant."
 * )
 */
class RefElementMateriel extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdElementmat;

    /**
     * @var string
     */
    protected $lbElementmat;

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
    protected $idElementmat;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idElementMateriel;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idElementMateriel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdElementmat
     *
     * @param string $cdElementmat
     *
     * @return RefElementMateriel
     */
    public function setCdElementmat($cdElementmat) {
        $this->cdElementmat = $cdElementmat;

        return $this;
    }

    /**
     * Get cdElementmat
     *
     * @return string
     */
    public function getCdElementmat() {
        return $this->cdElementmat;
    }

    /**
     * Set lbElementmat
     *
     * @param string $lbElementmat
     *
     * @return RefElementMateriel
     */
    public function setLbElementmat($lbElementmat) {
        $this->lbElementmat = $lbElementmat;

        return $this;
    }

    /**
     * Get lbElementmat
     *
     * @return string
     */
    public function getLbElementmat() {
        return $this->lbElementmat;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefElementMateriel
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
     * @return RefElementMateriel
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
     * @return RefElementMateriel
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
     * @return RefElementMateriel
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
     * Get idElementmat
     *
     * @return integer
     */
    public function getIdElementmat() {
        return $this->idElementmat;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefElementMateriel
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
     * Add IdElementMateriel
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idElementsMateriels
     *
     * @return RefElementMateriel
     */
    public function addIdElementMateriel(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idElementsMateriels) {
        $this->idElementsMateriels[] = $idElementsMateriels;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idElementsMateriels
     */
    public function removeIdElementMateriel(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idElementsMateriels) {
        $this->idElementsMateriels->removeElement($idElementsMateriels);
    }

    /**
     * Get idElementsMateriels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdElementsMateriels() {
        return $this->idElementsMateriels;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

}
