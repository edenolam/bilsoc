<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Prevoyance
 */
class Prevoyance {

    /**
     * @var string
     */
    private $r81421;

    /**
     * @var string
     */
    private $r81422;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var integer
     */
    private $idPrevo;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    private $refCategorie;

    /**
     * Set r81421
     *
     * @param string $r81421
     *
     * @return Prevoyance
     */
    public function setR81421($r81421) {
        $this->r81421 = $r81421;

        return $this;
    }

    /**
     * Get r81421
     *
     * @return string
     */
    public function getR81421() {
        return $this->r81421;
    }

    /**
     * Set r81422
     *
     * @param string $r81422
     *
     * @return Prevoyance
     */
    public function setR81422($r81422) {
        $this->r81422 = $r81422;

        return $this;
    }

    /**
     * Get r81422
     *
     * @return string
     */
    public function getR81422() {
        return $this->r81422;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Prevoyance
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
     * @return Prevoyance
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
     * @return Prevoyance
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
     * @return Prevoyance
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
     * Get idPrevo
     *
     * @return integer
     */
    public function getIdPrevo() {
        return $this->idPrevo;
    }

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return Prevoyance
     */
    public function setIdInfocollagen(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen = null) {
        $this->idInfocollagen = $idInfocollagen;

        return $this;
    }

    /**
     * Get idInfocollagen
     *
     * @return \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    public function getIdInfocollagen() {
        return $this->idInfocollagen;
    }

    /**
     * Set refCategorie
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie
     *
     * @return Prevoyance
     */
    public function setRefCategorie(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie = null) {
        $this->refCategorie = $refCategorie;

        return $this;
    }

    /**
     * Get refCategorie
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    public function getRefCategorie() {
        return $this->refCategorie;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

}
