<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefNatureHandicapBoeth
 * @UniqueEntity(
 *      fields="cdNathandiboeth",
 *      errorPath="cdNathandiboeth",
 *      message="Ce code est déjà existant."
 * )
 */
class RefNatureHandicapBoeth extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdNathandiboeth;

    /**
     * @var string
     */
    protected $lbNathandiboeth;

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
    protected $idNathandiboeth;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idNatureHandicapBoeth;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idNatureHandicapBoethSauvegarde;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idNatureHandicapBoeth = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idNatureHandicapBoethSauvegarde = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdNathandiboeth
     *
     * @param string $cdNathandiboeth
     *
     * @return RefNatureHandicapBoeth
     */
    public function setCdNathandiboeth($cdNathandiboeth) {
        $this->cdNathandiboeth = $cdNathandiboeth;

        return $this;
    }

    /**
     * Get cdNathandiboeth
     *
     * @return string
     */
    public function getCdNathandiboeth() {
        return $this->cdNathandiboeth;
    }

    /**
     * Set lbNathandiboeth
     *
     * @param string $lbNathandiboeth
     *
     * @return RefNatureHandicapBoeth
     */
    public function setLbNathandiboeth($lbNathandiboeth) {
        $this->lbNathandiboeth = $lbNathandiboeth;

        return $this;
    }

    /**
     * Get lbNathandiboeth
     *
     * @return string
     */
    public function getLbNathandiboeth() {
        return $this->lbNathandiboeth;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefNatureHandicapBoeth
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
     * @return RefNatureHandicapBoeth
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
     * @return RefNatureHandicapBoeth
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
     * @return RefNatureHandicapBoeth
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
     * Get idNathandiboeth
     *
     * @return integer
     */
    public function getIdNathandiboeth() {
        return $this->idNathandiboeth;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefNatureHandicapBoeth
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
     * Add IdNatureHandicapBoeth
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idNatureHandicapBoeths
     *
     * @return RefNatureHandicapBoeth
     */
    public function addIdNatureHandicapBoeth(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idNatureHandicapBoeths) {
        $this->idNatureHandicapBoeths[] = $idNatureHandicapBoeths;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idNatureHandicapBoeths
     */
    public function removeIdNatureHandicapBoeth(\Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idNatureHandicapBoeths) {
        $this->idNatureHandicapBoeths->removeElement($idNatureHandicapBoeths);
    }

    /**
     * Get idNatureHandicapBoeths
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdNatureHandicapBoeths() {
        return $this->idNatureHandicapBoeths;
    }

    /**
     * Add IdNatureHandicapBoeth
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idNatureHandicapBoeths
     *
     * @return RefNatureHandicapBoeth
     */
    public function addIdNatureHandicapBoethSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idNatureHandicapBoethSauvegardes) {
        $this->idNatureHandicapBoethSauvegardes[] = $idNatureHandicapBoethSauvegardes;

        return $this;
    }

    /**
     * Remove Handitorial
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Handitorial $idNatureHandicapBoeths
     */
    public function removeIdNatureHandicapBoethSauvegarde(\Bilan_Social\Bundle\ApaBundle\Entity\SauvegardeDonneesAgents $idNatureHandicapBoethSauvegardes) {
        $this->idNatureHandicapBoethSauvegardes->removeElement($idNatureHandicapBoethSauvegardes);
    }

    /**
     * Get idNatureHandicapBoeths
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdNatureHandicapBoethSauvegardes() {
        return $this->idNatureHandicapBoethSauvegardes;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

}
