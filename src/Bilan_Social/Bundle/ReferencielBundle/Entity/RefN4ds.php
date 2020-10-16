<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefN4ds
 * @UniqueEntity(
 *      fields="cdN4ds",
 *      errorPath="cdN4ds",
 *      message="Ce code est déjà existant."
 * )
 */
class RefN4ds extends RefAbstractEntity{


    /**
     * @var string
     */
    protected $cdN4ds;

    /**
     * @var string
     */
    protected $cdValeur;

    /**
     * @var string
     */
    protected $blObligatoire;

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
    protected $idN4ds;


    function getCdN4ds() {
        return $this->cdN4ds;
    }

    function getCdValeur() {
        return $this->cdValeur;
    }

    function getBlObligatoire() {
        return $this->blObligatoire;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }



    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function getIdN4ds() {
        return $this->idN4ds;
    }

    function setCdN4ds($cdN4ds) {
        $this->cdN4ds = $cdN4ds;
    }

    function setCdValeur($cdValeur) {
        $this->cdValeur = $cdValeur;
    }

    function setBlObligatoire($blObligatoire) {
        $this->blObligatoire = $blObligatoire;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }



    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    function setIdN4ds($idN4ds) {
        $this->idN4ds = $idN4ds;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

        /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefGrade
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefGrade
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

}
