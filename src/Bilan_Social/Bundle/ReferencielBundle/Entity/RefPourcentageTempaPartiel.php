<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefPourcentageTempaPartiel
 * @UniqueEntity(
 *      fields="cdPourtemppart",
 *      errorPath="cdPourtemppart",
 *      message="Ce code est déjà existant."
 * )
 */
class RefPourcentageTempaPartiel extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $lbPourtemppart;

    /**
     * @var string
     */
    protected $cdPourtemppart;

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
    protected $idPourtemppart;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    protected $pcBorneMin;
    protected $pcBorneMax;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lbPourtemppart
     *
     * @param string $lbPourtemppart
     *
     * @return RefPourcentageTempaPartiel
     */
    public function setLbPourtemppart($lbPourtemppart) {
        $this->lbPourtemppart = $lbPourtemppart;

        return $this;
    }

    /**
     * Get lbPourtemppart
     *
     * @return string
     */
    public function getLbPourtemppart() {
        return $this->lbPourtemppart;
    }

    /**
     * Set cdPourtemppart
     *
     * @param string $cdPourtemppart
     *
     * @return RefPourcentageTempaPartiel
     */
    public function setCdPourtemppart($cdPourtemppart) {
        $this->cdPourtemppart = $cdPourtemppart;

        return $this;
    }

    /**
     * Get cdPourtemppart
     *
     * @return string
     */
    public function getCdPourtemppart() {
        return $this->cdPourtemppart;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefPourcentageTempaPartiel
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
     * @return RefPourcentageTempaPartiel
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
     * @return RefPourcentageTempaPartiel
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
     * @return RefPourcentageTempaPartiel
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
     * Get idPourtemppart
     *
     * @return integer
     */
    public function getIdPourtemppart() {
        return $this->idPourtemppart;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefPourcentageTempaPartiel
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

    function getPcBorneMin() {
        return $this->pcBorneMin;
    }

    function getPcBorneMax() {
        return $this->pcBorneMax;
    }

    function setPcBorneMin($pcBorneMin) {
        $this->pcBorneMin = $pcBorneMin;
    }

    function setPcBorneMax($pcBorneMax) {
        $this->pcBorneMax = $pcBorneMax;
    }



}
