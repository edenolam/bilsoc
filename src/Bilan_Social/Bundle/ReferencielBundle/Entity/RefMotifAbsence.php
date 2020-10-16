<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMotifAbsence
 * @UniqueEntity(
 *      fields="cdMotiabse",
 *      errorPath="cdMotiabse",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMotifAbsence extends RefAbstractEntity{

    /** Pour maladie ordinaire */
    const ABS001 = 'ABS001';
    
    /** Pour accidents du travail imputables au service */
    const ABS003 = 'ABS003';

    /** Pour accidents du travail imputables au trajet */
    const ABS004 = 'ABS004';

    /**
     * @var string
     */
    protected $cdMotiabse;

    /**
     * @var string
     */
    protected $lbMotiabse;

    /**
     * @var boolean
     */
    protected $blAbsecomp;

    /**
     * @var boolean
     */
    protected $blAbsemedi;

    /**
     * @var boolean
     */
    protected $blAbseautrrais;

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
    protected $idMotiabse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $AbsenceArretAgents;

    /**
     * @var boolean
     */
    protected $blAbsage;

    protected $cdMotiN4ds;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->AbsenceArretAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdMotiabse
     *
     * @param string $cdMotiabse
     *
     * @return RefMotifAbsence
     */
    public function setCdMotiabse($cdMotiabse) {
        $this->cdMotiabse = $cdMotiabse;

        return $this;
    }

    /**
     * Get cdMotiabse
     *
     * @return string
     */
    public function getCdMotiabse() {
        return $this->cdMotiabse;
    }

    /**
     * Set lbMotiabse
     *
     * @param string $lbMotiabse
     *
     * @return RefMotifAbsence
     */
    public function setLbMotiabse($lbMotiabse) {
        $this->lbMotiabse = $lbMotiabse;

        return $this;
    }

    /**
     * Get lbMotiabse
     *
     * @return string
     */
    public function getLbMotiabse() {
        return $this->lbMotiabse;
    }

    /**
     * Set blAbsecomp
     *
     * @param boolean $blAbsecomp
     *
     * @return RefMotifAbsence
     */
    public function setBlAbsecomp($blAbsecomp) {
        $this->blAbsecomp = $blAbsecomp;

        return $this;
    }

    /**
     * Get blAbsecomp
     *
     * @return boolean
     */
    public function getBlAbsecomp() {
        return $this->blAbsecomp;
    }

    /**
     * Set blAbsemedi
     *
     * @param boolean $blAbsemedi
     *
     * @return RefMotifAbsence
     */
    public function setBlAbsemedi($blAbsemedi) {
        $this->blAbsemedi = $blAbsemedi;

        return $this;
    }

    /**
     * Get blAbsemedi
     *
     * @return boolean
     */
    public function getBlAbsemedi() {
        return $this->blAbsemedi;
    }

    /**
     * Set blAbseautrrais
     *
     * @param boolean $blAbseautrrais
     *
     * @return RefMotifAbsence
     */
    public function setBlAbseautrrais($blAbseautrrais) {
        $this->blAbseautrrais = $blAbseautrrais;

        return $this;
    }

    /**
     * Get blAbseautrrais
     *
     * @return boolean
     */
    public function getBlAbseautrrais() {
        return $this->blAbseautrrais;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMotifAbsence
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
     * @return RefMotifAbsence
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
     * @return RefMotifAbsence
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
     * @return RefMotifAbsence
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
     * Get idMotiabse
     *
     * @return integer
     */
    public function getIdMotiabse() {
        return $this->idMotiabse;
    }

    /**
     * Set blAbsage
     *
     * @param boolean $blAbsage
     *
     * @return RefMotifAbsence
     */
    public function setBlAbsage($blAbsage) {
        $this->blAbsage = $blAbsage;

        return $this;
    }

    /**
     * Get blAbsage
     *
     * @return boolean
     */
    public function getBlAbsage() {
        return $this->blAbsage;
    }

    /**
     * Add absenceArretAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $absenceArretAgent
     *
     * @return RefMotifAbsence
     */
    public function addAbsenceArretAgent(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $absenceArretAgent) {
        $this->AbsenceArretAgents[] = $absenceArretAgent;

        return $this;
    }

    /**
     * Remove absenceArretAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $absenceArretAgent
     */
    public function removeAbsenceArretAgent(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent $absenceArretAgent) {
        $this->AbsenceArretAgents->removeElement($absenceArretAgent);
    }

    /**
     * Get absenceArretAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbsenceArretAgents() {
        return $this->AbsenceArretAgents;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }

    function getCdMotiN4ds() {
        return $this->cdMotiN4ds;
    }

    function setCdMotiN4ds($cdMotiN4ds) {
        $this->cdMotiN4ds = $cdMotiN4ds;
    }



    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
