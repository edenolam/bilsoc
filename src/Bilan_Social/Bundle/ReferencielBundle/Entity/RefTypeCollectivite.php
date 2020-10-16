<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefTypeCollectivite
 * @UniqueEntity(
 *      fields="cdTypecoll",
 *      errorPath="cdTypecoll",
 *      message="Ce code est déjà existant."
 * )
 */
class RefTypeCollectivite extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdTypecoll;

    /**
     * @var string
     */
    protected $lbTypeColl;

    /**
     * @var string
     */
    protected $cdUtilcrea;
    
    /**
     * @var string
     */
    protected $cdDGCL;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $cdUtilmodi;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var integer
     */
    protected $idTypeColl;

    /**
     * Set cdTypecoll
     *
     * @param string $cdTypecoll
     *
     * @return RefTypeCollectivite
     */
    public function setCdTypecoll($cdTypecoll) {
        $this->cdTypecoll = $cdTypecoll;

        return $this;
    }

    /**
     * Get cdTypecoll
     *
     * @return string
     */
    public function getCdTypecoll() {
        return $this->cdTypecoll;
    }

    /**
     * Set lbTypeColl
     *
     * @param string $lbTypeColl
     *
     * @return RefTypeCollectivite
     */
    public function setLbTypeColl($lbTypeColl) {
        $this->lbTypeColl = $lbTypeColl;

        return $this;
    }

    /**
     * Get lbTypeColl
     *
     * @return string
     */
    public function getLbTypeColl() {
        return $this->lbTypeColl;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefTypeCollectivite
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefTypeCollectivite
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
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefTypeCollectivite
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefTypeCollectivite
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
     * Get idTypeColl
     *
     * @return integer
     */
    public function getIdTypeColl() {
        return $this->idTypeColl;
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
