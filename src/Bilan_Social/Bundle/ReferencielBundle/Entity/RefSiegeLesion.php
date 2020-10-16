<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefSiegeLesion
 * @UniqueEntity(
 *      fields="cdSiegelesi",
 *      errorPath="cdSiegelesi",
 *      message="Ce code est déjà existant."
 * )
 */
class RefSiegeLesion extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdSiegelesi;

    /**
     * @var string
     */
    protected $lbSiegelesi;

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
    protected $idSiegelesi;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $idSiegeLesion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idSiegeLesion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdSiegelesi
     *
     * @param string $cdSiegelesi
     *
     * @return RefSiegeLesion
     */
    public function setCdSiegelesi($cdSiegelesi) {
        $this->cdSiegelesi = $cdSiegelesi;

        return $this;
    }

    /**
     * Get cdSiegelesi
     *
     * @return string
     */
    public function getCdSiegelesi() {
        return $this->cdSiegelesi;
    }

    /**
     * Set lbSiegelesi
     *
     * @param string $lbSiegelesi
     *
     * @return RefSiegeLesion
     */
    public function setLbSiegelesi($lbSiegelesi) {
        $this->lbSiegelesi = $lbSiegelesi;

        return $this;
    }

    /**
     * Get lbSiegelesi
     *
     * @return string
     */
    public function getLbSiegelesi() {
        return $this->lbSiegelesi;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefSiegeLesion
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
     * @return RefSiegeLesion
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
     * @return RefSiegeLesion
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
     * @return RefSiegeLesion
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
     * Get idSiegelesi
     *
     * @return integer
     */
    public function getIdSiegelesi() {
        return $this->idSiegelesi;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefSiegeLesion
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
     * Add IdSiegeLesion
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idSiegeLesions
     *
     * @return RefSiegeLesion
     */
    public function addIdSiegeLesion(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idSiegeLesions) {
        $this->idSiegeLesions[] = $idSiegeLesions;

        return $this;
    }

    /**
     * Remove AbsenceArretAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idSiegeLesions
     */
    public function removeIdSiegeLesion(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $idSiegeLesions) {
        $this->idSiegeLesions->removeElement($idSiegeLesions);
    }

    /**
     * Get idSiegeLesions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdSiegeLesions() {
        return $this->idSiegeLesions;
    }

}
