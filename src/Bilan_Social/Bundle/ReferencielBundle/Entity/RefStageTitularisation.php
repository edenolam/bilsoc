<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefStageTitularisation
 * @UniqueEntity(
 *      fields="cdStagtitu",
 *      errorPath="cdStagtitu",
 *      message="Ce code est déjà existant."
 * )
 */
class RefStageTitularisation extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdStagtitu;

    /**
     * @var string
     */
    protected $lbStagtitu;

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
    protected $idStagtitu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdStagtitu
     *
     * @param string $cdStagtitu
     *
     * @return RefStageTitularisation
     */
    public function setCdStagtitu($cdStagtitu) {
        $this->cdStagtitu = $cdStagtitu;

        return $this;
    }

    /**
     * Get cdStagtitu
     *
     * @return string
     */
    public function getCdStagtitu() {
        return $this->cdStagtitu;
    }

    /**
     * Set lbStagtitu
     *
     * @param string $lbStagtitu
     *
     * @return RefStageTitularisation
     */
    public function setLbStagtitu($lbStagtitu) {
        $this->lbStagtitu = $lbStagtitu;

        return $this;
    }

    /**
     * Get lbStagtitu
     *
     * @return string
     */
    public function getLbStagtitu() {
        return $this->lbStagtitu;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefStageTitularisation
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
     * @return RefStageTitularisation
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
     * @return RefStageTitularisation
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
     * @return RefStageTitularisation
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
     * Get idStagtitu
     *
     * @return integer
     */
    public function getIdStagtitu() {
        return $this->idStagtitu;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefStageTitularisation
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

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
