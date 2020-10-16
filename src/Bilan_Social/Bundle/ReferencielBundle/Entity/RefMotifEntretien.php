<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMotifEntretien
 * @UniqueEntity(
 *      fields="cdMotientr",
 *      errorPath="cdMotientr",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMotifEntretien extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdMotientr;

    /**
     * @var string
     */
    protected $lbMotientr;

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
    protected $idMotientr;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgentsRetour;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgentsDepart;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgentsRetour = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bilanSocialAgentsDepart = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdMotientr
     *
     * @param string $cdMotientr
     *
     * @return RefMotifEntretien
     */
    public function setCdMotientr($cdMotientr) {
        $this->cdMotientr = $cdMotientr;

        return $this;
    }

    /**
     * Get cdMotientr
     *
     * @return string
     */
    public function getCdMotientr() {
        return $this->cdMotientr;
    }

    /**
     * Set lbMotientr
     *
     * @param string $lbMotientr
     *
     * @return RefMotifEntretien
     */
    public function setLbMotientr($lbMotientr) {
        $this->lbMotientr = $lbMotientr;

        return $this;
    }

    /**
     * Get lbMotientr
     *
     * @return string
     */
    public function getLbMotientr() {
        return $this->lbMotientr;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMotifEntretien
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
     * @return RefMotifEntretien
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
     * @return RefMotifEntretien
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
     * @return RefMotifEntretien
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
     * Get idMotientr
     *
     * @return integer
     */
    public function getIdMotientr() {
        return $this->idMotientr;
    }

    /**
     * Add bilanSocialAgentsRetour
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsRetour
     *
     * @return RefMotifEntretien
     */
    public function addBilanSocialAgentsRetour(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsRetour) {
        $this->bilanSocialAgentsRetour[] = $bilanSocialAgentsRetour;

        return $this;
    }

    /**
     * Remove bilanSocialAgentsRetour
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsRetour
     */
    public function removeBilanSocialAgentsRetour(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsRetour) {
        $this->bilanSocialAgentsRetour->removeElement($bilanSocialAgentsRetour);
    }

    /**
     * Get bilanSocialAgentsRetour
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgentsRetour() {
        return $this->bilanSocialAgentsRetour;
    }

    /**
     * Add bilanSocialAgentsDepart
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsDepart
     *
     * @return RefMotifEntretien
     */
    public function addBilanSocialAgentsDepart(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsDepart) {
        $this->bilanSocialAgentsDepart[] = $bilanSocialAgentsDepart;

        return $this;
    }

    /**
     * Remove bilanSocialAgentsRetour
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsDepart
     */
    public function removeBilanSocialAgentsDepart(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsDepart) {
        $this->bilanSocialAgentsDepart->removeElement($bilanSocialAgentsDepart);
    }

    /**
     * Get bilanSocialAgentsDepart
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgentsDepart() {
        return $this->bilanSocialAgentsDepart;
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
