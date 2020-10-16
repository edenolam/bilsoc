<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * HeuCompReaRemAgent
 */
class HeuCompReaRemAgent {

    /**
     * @var integer
     */
    private $nbHeure;

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
    private $idHeuCompReaRemAgent;

    /**
     * @var integer
     */
    private $blTempsComplet;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    private $refStatut;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    private $refFiliere;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    private $refCadreEmploi;

    function getNbHeure() {
        return $this->nbHeure;
    }

    function setNbHeure($nbHeure) {
        $this->nbHeure = $nbHeure;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return HeuCompReaRemAgent
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
     * @return HeuCompReaRemAgent
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
     * @return HeuCompReaRemAgent
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
     * @return HeuCompReaRemAgent
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
     * Get idHeuCompReaRemAgent
     *
     * @return integer
     */
    public function getIdHeuCompReaRemAgent() {
        return $this->idHeuCompReaRemAgent;
    }

    /**
     * Set bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return HeuCompReaRemAgent
     */
    public function setBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent = null) {
        $this->BilanSocialAgent = $bilanSocialAgent;

        return $this;
    }

    /**
     * Get bilanSocialAgent
     *
     * @return \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    public function getBilanSocialAgent() {
        return $this->BilanSocialAgent;
    }

    /**
     * Set refStatut
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $refStatut
     *
     * @return HeuCompReaRemAgent
     */
    public function setRefStatut(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $refStatut = null) {
        $this->refStatut = $refStatut;

        return $this;
    }

    /**
     * Get refStatut
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    public function getRefStatut() {
        return $this->refStatut;
    }

    /**
     * Set refFiliere
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
     *
     * @return HeuCompReaRemAgent
     */
    public function setRefFiliere(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere = null) {
        $this->refFiliere = $refFiliere;

        return $this;
    }

    /**
     * Get refFiliere
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getRefFiliere() {
        return $this->refFiliere;
    }

    /**
     * Set refCadreEmploi
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploi
     *
     * @return HeuCompReaRemAgent
     */
    public function setRefCadreEmploi(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploi = null) {
        $this->refCadreEmploi = $refCadreEmploi;

        return $this;
    }

    /**
     * Get refCadreEmploi
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    public function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

    /**
     * @return int
     */
    public function getBlTempsComplet()
    {
        return $this->blTempsComplet;
    }

    /**
     * @param int $blTempsComplet
     */
    public function setBlTempsComplet($blTempsComplet = null)
    {
        $this->blTempsComplet = $blTempsComplet;
    }


}
