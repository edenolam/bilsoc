<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefValidationExperience
 * @UniqueEntity(
 *      fields="cdEbcf",
 *      errorPath="cdEbcf",
 *      message="Ce code est déjà existant."
 * )
 */
class RefValidationExperience extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdEbcf;

    /**
     * @var string
     */
    protected $lbEbcf;

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
    protected $idEbcf;

    protected $cdDGCL;

    /**
     * Set cdEbcf
     *
     * @param string $cdEbcf
     *
     * @return RefValidationExperience
     */
    public function setCdEbcf($cdEbcf) {
        $this->cdEbcf = $cdEbcf;

        return $this;
    }

    /**
     * Get cdEbcf
     *
     * @return string
     */
    public function getCdEbcf() {
        return $this->cdEbcf;
    }

    /**
     * Set lbEbcf
     *
     * @param string $lbEbcf
     *
     * @return RefValidationExperience
     */
    public function setLbEbcf($lbEbcf) {
        $this->lbEbcf = $lbEbcf;

        return $this;
    }

    /**
     * Get lbEbcf
     *
     * @return string
     */
    public function getLbEbcf() {
        return $this->lbEbcf;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefValidationExperience
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
     * @return RefValidationExperience
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
     * @return RefValidationExperience
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
     * @return RefValidationExperience
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
     * Get idEbcf
     *
     * @return integer
     */
    public function getIdEbcf() {
        return $this->idEbcf;
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
