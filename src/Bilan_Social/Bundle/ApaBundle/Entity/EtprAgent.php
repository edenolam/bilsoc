<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * EtprAgent
 */
class EtprAgent {

    /**
     * @var integer
     */
    private $nbHeure;

    private $nbHeureEtpr;

    /**
     * @var string
     */
    private $dateIn;

    /**
     * @var string
     */
    private $dateOut;

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
    private $idEtprAgent;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    private $refStatut;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    private $refFiliere;
    
    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    private $refEmploiNonPermanent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi
     */
    private $refCadreEmploi;

    /**
     * Set nbHeure
     *
     * @param integer $nbHeure
     *
     * @return EtprAgent
     */
    public function setNbHeure($nbHeure) {
        $this->nbHeure = $nbHeure;

        return $this;
    }

    function getDateIn() {
        return $this->dateIn;
    }

    function getDateOut() {
        return $this->dateOut;
    }

    function setDateIn($dateIn) {
        $this->dateIn = $dateIn;
    }

    function setDateOut($dateOut) {
        $this->dateOut = $dateOut;
    }

    /**
     * Get nbHeure
     *
     * @return integer
     */
    public function getNbHeure() {
        return $this->nbHeure;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return EtprAgent
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
     * @return EtprAgent
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
     * @return EtprAgent
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
     * @return EtprAgent
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
     * Get idEtprAgent
     *
     * @return integer
     */
    public function getIdEtprAgent() {
        return $this->idEtprAgent;
    }

    /**
     * Set bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return EtprAgent
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
     * @return EtprAgent
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
     * @return EtprAgent
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
     * Set refEmploiNonPermanent
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent
     *
     * @return EtprAgent
     */
    public function setRefEmploiNonPermanent(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent = null) {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;

        return $this;
    }

    /**
     * Get refEmploiNonPermanent
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    public function getRefEmploiNonPermanent() {
        return $this->refEmploiNonPermanent;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

    function getRefCadreEmploi(){
        return $this->refCadreEmploi;
    }

    function setRefCadreEmploi(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi $refCadreEmploi = null) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function getNbHeureEtpr() {
        return $this->nbHeureEtpr;
    }

    function setNbHeureEtpr($nbHeureEtpr) {
        $this->nbHeureEtpr = $nbHeureEtpr;
    }



}
