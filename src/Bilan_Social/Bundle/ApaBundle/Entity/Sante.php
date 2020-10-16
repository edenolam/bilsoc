<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Sante
 */
class Sante {

    /**
     * @var integer
     */
    private $r81411;

    /**
     * @var integer
     */
    private $r81412;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $idSant;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    private $refCategorie;
    private $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set r81411
     *
     * @param integer $r81411
     *
     * @return Sante
     */
    public function setR81411($r81411) {
        $this->r81411 = $r81411;

        return $this;
    }

    /**
     * Get r81411
     *
     * @return integer
     */
    public function getR81411() {
        return $this->r81411;
    }

    /**
     * Set r81412
     *
     * @param integer $r81412
     *
     * @return Sante
     */
    public function setR81412($r81412) {
        $this->r81412 = $r81412;

        return $this;
    }

    /**
     * Get r81412
     *
     * @return integer
     */
    public function getR81412() {
        return $this->r81412;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return Sante
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
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return Sante
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Sante
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
     * @return Sante
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
     * Get idSant
     *
     * @return integer
     */
    public function getIdSant() {
        return $this->idSant;
    }

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return Sante
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
     * @return Sante
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

    public function addInformationColectiviteAgent(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen) {

        if (!$this->InformationColectiviteAgent->contains($idInfocollagen)) {
            $this->InformationColectiviteAgent->add($idInfocollagen);
        }
    }

}
