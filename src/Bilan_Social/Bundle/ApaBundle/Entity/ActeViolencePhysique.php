<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * ActeViolencePhysique
 */
class ActeViolencePhysique {

    /**
     * @var integer
     */
    private $r5311;

    /**
     * @var integer
     */
    private $r5312;

    /**
     * @var integer
     */
    private $r4313;

    /**
     * @var integer
     */
    private $r4314;

    /**
     * @var integer
     */
    private $r4315;

    /**
     * @var integer
     */
    private $r4316;

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
    private $idViolphsy;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $collectivite;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique
     */
    private $RefActeViolencePhysique;

    /**
     * Set r5311
     *
     * @param integer $r5311
     *
     * @return ActeViolencePhysique
     */
    public function setR5311($r5311) {
        $this->r5311 = $r5311;

        return $this;
    }

    /**
     * Get r5311
     *
     * @return integer
     */
    public function getR5311() {
        return $this->r5311;
    }

    /**
     * Set r5312
     *
     * @param integer $r5312
     *
     * @return ActeViolencePhysique
     */
    public function setR5312($r5312) {
        $this->r5312 = $r5312;

        return $this;
    }

    /**
     * Get r5312
     *
     * @return integer
     */
    public function getR5312() {
        return $this->r5312;
    }

    /**
     * Set r4313
     *
     * @param integer $r4313
     *
     * @return ActeViolencePhysique
     */
    public function setR4313($r4313) {
        $this->r4313 = $r4313;

        return $this;
    }

    /**
     * Get r4313
     *
     * @return integer
     */
    public function getR4313() {
        return $this->r4313;
    }
    
    /**
     * Set r4314
     *
     * @param integer $r4314
     *
     * @return ActeViolencePhysique
     */
    public function setR4314($r4314) {
        $this->r4314 = $r4314;

        return $this;
    }

    /**
     * Get r4314
     *
     * @return integer
     */
    public function getR4314() {
        return $this->r4314;
    }


    /**
     * Set r4315
     *
     * @param integer $r4315
     *
     * @return ActeViolencePhysique
     */
    public function setR4315($r4315) {
        $this->r4315 = $r4315;

        return $this;
    }

    /**
     * Get r4315
     *
     * @return integer
     */
    public function getR4315() {
        return $this->r4315;
    }

    /**
     * Set r4316
     *
     * @param integer $r4316
     *
     * @return ActeViolencePhysique
     */
    public function setR4316($r4316) {
        $this->r4316 = $r4316;

        return $this;
    }

    /**
     * Get r4316
     *
     * @return integer
     */
    public function getR4316() {
        return $this->r4316;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ActeViolencePhysique
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
     * @return ActeViolencePhysique
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
     * @return ActeViolencePhysique
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
     * @return ActeViolencePhysique
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
     * Get idViolphsy
     *
     * @return integer
     */
    public function getIdViolphsy() {
        return $this->idViolphsy;
    }

    /**
     * Set collectivite
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $collectivite
     *
     * @return ActeViolencePhysique
     */
    public function setCollectivite(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $collectivite = null) {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    public function getCollectivite() {
        return $this->collectivite;
    }

    /**
     * Set refActeViolencePhysique
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique $refActeViolencePhysique
     *
     * @return ActeViolencePhysique
     */
    public function setRefActeViolencePhysique(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique $refActeViolencePhysique = null) {
        $this->RefActeViolencePhysique = $refActeViolencePhysique;

        return $this;
    }

    /**
     * Get refActeViolencePhysique
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique
     */
    public function getRefActeViolencePhysique() {
        return $this->RefActeViolencePhysique;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

}
