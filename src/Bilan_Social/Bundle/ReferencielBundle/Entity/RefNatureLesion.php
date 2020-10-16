<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefNatureLesion
 * @UniqueEntity(
 *      fields="cdNaturelesi",
 *      errorPath="cdNaturelesi",
 *      message="Ce code est déjà existant."
 * )
 */
class RefNatureLesion extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdNaturelesi;

    /**
     * @var string
     */
    protected $lbNaturelesi;

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
    protected $idNaturelesi;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idNatureLesion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idNatureLesion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdNaturelesi
     *
     * @param string $cdNaturelesi
     *
     * @return RefNatureLesion
     */
    public function setCdNaturelesi($cdNaturelesi) {
        $this->cdNaturelesi = $cdNaturelesi;

        return $this;
    }

    /**
     * Get cdNaturelesi
     *
     * @return string
     */
    public function getCdNaturelesi() {
        return $this->cdNaturelesi;
    }

    /**
     * Set lbNaturelesi
     *
     * @param string $lbNaturelesi
     *
     * @return RefNatureLesion
     */
    public function setLbNaturelesi($lbNaturelesi) {
        $this->lbNaturelesi = $lbNaturelesi;

        return $this;
    }

    /**
     * Get lbNaturelesi
     *
     * @return string
     */
    public function getLbNaturelesi() {
        return $this->lbNaturelesi;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefNatureLesion
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
     * @return RefNatureLesion
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
     * @return RefNatureLesion
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
     * @return RefNatureLesion
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
     * Get idNaturelesi
     *
     * @return integer
     */
    public function getIdNaturelesi() {
        return $this->idNaturelesi;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefNatureLesion
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
     * Add IdNatureLesion
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idNatureLesions
     *
     * @return RefNatureLesion
     */
    public function addIdNatureLesion(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idNatureLesions) {
        $this->idNatureLesions[] = $idNatureLesions;

        return $this;
    }

    /**
     * Remove AbsenceArretAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idNatureLesions
     */
    public function removeIdNatureLesion(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idNatureLesions) {
        $this->idNatureLesions->removeElement($idNatureLesions);
    }

    /**
     * Get idNatureLesions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdNatureLesions() {
        return $this->idNatureLesions;
    }

}
