<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefTrancheAge
 * @UniqueEntity(
 *      fields="cdTranage",
 *      errorPath="cdTranage",
 *      message="Ce code est déjà existant."
 * )
 */
class RefTrancheAge extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdTranage;

    /**
     * @var string
     */
    protected $lbTranage;

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
    protected $idTranage;

    protected $cdDGCL;

    /**
     * Set cdTranage
     *
     * @param string $cdTranage
     *
     * @return RefTrancheAge
     */
    public function setCdTranage($cdTranage) {
        $this->cdTranage = $cdTranage;

        return $this;
    }

    /**
     * Get cdTranage
     *
     * @return string
     */
    public function getCdTranage() {
        return $this->cdTranage;
    }

    /**
     * Set lbTranage
     *
     * @param string $lbTranage
     *
     * @return RefTrancheAge
     */
    public function setLbTranage($lbTranage) {
        $this->lbTranage = $lbTranage;

        return $this;
    }

    /**
     * Get lbTranage
     *
     * @return string
     */
    public function getLbTranage() {
        return $this->lbTranage;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefTrancheAge
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
     * @return RefTrancheAge
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
     * @return RefTrancheAge
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
     * @return RefTrancheAge
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
     * Get idTranage
     *
     * @return integer
     */
    public function getIdTranage() {
        return $this->idTranage;
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
