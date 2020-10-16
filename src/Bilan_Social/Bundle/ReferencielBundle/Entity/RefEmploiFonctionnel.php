<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefEmploiFonctionnel
 * @UniqueEntity(
 *      fields="cdEmplfonc",
 *      errorPath="cdEmplfonc",
 *      message="Ce code est déjà existant."
 * )
 */
class RefEmploiFonctionnel extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdEmplfonc;

    /**
     * @var string
     */
    protected $lbEmplfonc;

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
    protected $idEmplfonc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    protected $refFiliere;

    /**
     * @var string
     */
    protected $cdMotiN4ds;

    /**
     * @var string
     */
    protected $cdMotiBcCiril;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdEmplfonc
     *
     * @param string $cdEmplfonc
     *
     * @return RefEmploiFonctionnel
     */
    public function setCdEmplfonc($cdEmplfonc) {
        $this->cdEmplfonc = $cdEmplfonc;

        return $this;
    }

    /**
     * Get cdEmplfonc
     *
     * @return string
     */
    public function getCdEmplfonc() {
        return $this->cdEmplfonc;
    }

    /**
     * Set lbEmplfonc
     *
     * @param string $lbEmplfonc
     *
     * @return RefEmploiFonctionnel
     */
    public function setLbEmplfonc($lbEmplfonc) {
        $this->lbEmplfonc = $lbEmplfonc;

        return $this;
    }

    /**
     * Get lbEmplfonc
     *
     * @return string
     */
    public function getLbEmplfonc() {
        return $this->lbEmplfonc;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefEmploiFonctionnel
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
     * @return RefEmploiFonctionnel
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
     * @return RefEmploiFonctionnel
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
     * @return RefEmploiFonctionnel
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
     * Get idEmplfonc
     *
     * @return integer
     */
    public function getIdEmplfonc() {
        return $this->idEmplfonc;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefEmploiFonctionnel
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
     * Set refFiliere
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
     *
     * @return RefFiliere
     */
    public function setRefCadreEmploi(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refFiliere) {
        $this->refFiliere = $refFiliere;

        return $this;
    }

    /**
     * Get refFiliere
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getRefCadreEmploi() {
        return $this->refFiliere;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getCdMotiN4ds() {
        return $this->cdMotiN4ds;
    }

    function setCdMotiN4ds($cdMotiN4ds) {
        $this->cdMotiN4ds = $cdMotiN4ds;
    }

    function getCdMotiBcCiril() {
        return $this->cdMotiBcCiril;
    }

    function setCdMotiBcCiril($cdMotiBcCiril) {
        $this->cdMotiBcCiril = $cdMotiBcCiril;
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }
    


}
