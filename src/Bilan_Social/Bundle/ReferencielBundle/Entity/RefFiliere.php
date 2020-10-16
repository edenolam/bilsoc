<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefFiliere
 * @UniqueEntity(
 *      fields="cdFili",
 *      errorPath="cdFili",
 *      message="Ce code est déjà existant."
 * )
 */
class RefFiliere extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdFili;

    /**
     * @var string
     */
    protected $lbFili;

    /**
     * @var boolean
     */
    protected $blEmpFonc;

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
    protected $idFili;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    protected $Etpr114AnneePrecedente;
//
//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     */
//    protected $Etpr124AnneePrecedente;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents_inapFili;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents_FiliEmpFonc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $EtprAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $BilanQ30Alerte;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $HeuSuppReaRemAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $HeuCompReaRemAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $EmpFoncFiliere;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RemunerationGlobaleAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RemunerationAgent;

    /**
     * .@var boolean
     */
    protected $blCons;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {

        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bilanSocialAgents_FiliEmpFonc = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bilanSocialAgents_inapFili = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->Etpr114AnneePrecedente = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->Etpr124AnneePrecedente = new \Doctrine\Common\Collections\ArrayCollection();
        $this->EtprAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationGlobaleAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->BilanQ30Alerte = new \Doctrine\Common\Collections\ArrayCollection();
        $this->HeuCompReaRemAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->EmpFoncFiliere = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getBlEmpFonc() {
        return $this->blEmpFonc;
    }

    function setBlEmpFonc($blEmpFonc) {
        $this->blEmpFonc = $blEmpFonc;
    }

    /**
     * Set cdFili
     *
     * @param string $cdFili
     *
     * @return RefFiliere
     */
    public function setCdFili($cdFili) {
        $this->cdFili = $cdFili;

        return $this;
    }

    /**
     * Get cdFili
     *
     * @return string
     */
    public function getCdFili() {
        return $this->cdFili;
    }

    /**
     * Set lbFili
     *
     * @param string $lbFili
     *
     * @return RefFiliere
     */
    public function setLbFili($lbFili) {
        $this->lbFili = $lbFili;

        return $this;
    }

    /**
     * Get lbFili
     *
     * @return string
     */
    public function getLbFili() {
        return $this->lbFili;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefFiliere
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
     * @return RefFiliere
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
     * @return RefFiliere
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
     * @return RefFiliere
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
     * Get idFili
     *
     * @return integer
     */
    public function getIdFili() {
        return $this->idFili;
    }

    /**
     * Set blCons
     *
     * @param boolean $blCons
     *
     * @return RefCategorie
     */
    public function setBlCons($blCons) {
        $this->blCons = $blCons;

        return $this;
    }

    /**
     * Get blCons
     *
     * @return boolean
     */
    public function getBlCons() {
        return $this->blCons;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefFiliere
     */
    public function addBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent) {
        $this->bilanSocialAgents[] = $bilanSocialAgent;

        return $this;
    }

    /**
     * Remove bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     */
    public function removeBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent) {
        $this->bilanSocialAgents->removeElement($bilanSocialAgent);
    }

    /**
     * Get bilanSocialAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgents() {
        return $this->bilanSocialAgents;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent_inapFili
     *
     * @return RefFiliere
     */
    public function addBilanSocialAgents_inapFili(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent_inapFili) {
        $this->bilanSocialAgents_inapFili[] = $bilanSocialAgent_inapFili;

        return $this;
    }

    /**
     * Remove bilanSocialAgent_inapFili
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent_inapFili
     */
    public function removeBilanSocialAgent_inapFili(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent_inapFili) {
        $this->bilanSocialAgents_inapFili->removeElement($bilanSocialAgent_inapFili);
    }

    /**
     * Get bilanSocialAgents_inapFili
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgents_inapFili() {
        return $this->bilanSocialAgents_inapFili;
    }

    /**
     * Add bilanSocialAgents_FiliEmpFonc
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_FiliEmpFonc
     *
     * @return RefFiliere
     */
    public function addBilanSocialAgents_FiliEmpFonc(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_FiliEmpFonc) {
        $this->bilanSocialAgents_FiliEmpFonc[] = $bilanSocialAgents_FiliEmpFonc;

        return $this;
    }

    /**
     * Remove bilanSocialAgents_FiliEmpFonc
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_FiliEmpFonc
     */
    public function removeBilanSocialAgents_FiliEmpFonc(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents_FiliEmpFonc) {
        $this->bilanSocialAgents_FiliEmpFonc->removeElement($bilanSocialAgents_FiliEmpFonc);
    }

    /**
     * Get bilanSocialAgents_FiliEmpFonc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanSocialAgents_FiliEmpFonc() {
        return $this->bilanSocialAgents_FiliEmpFonc;
    }

//    /**
//     * Add Etpr114AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $Etpr114AnneePrecedente
//     *
//     * @return RefFiliere
//     */
//    public function addEtpr114AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $Etpr114AnneePrecedente) {
//        $this->Etpr114AnneePrecedente[] = $Etpr114AnneePrecedente;
//
//        return $this;
//    }
//
//    /**
//     * Remove Etpr114AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $Etpr114AnneePrecedente
//     */
//    public function removeEtpr114AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente $Etpr114AnneePrecedente) {
//        $this->Etpr114AnneePrecedente->removeElement($Etpr114AnneePrecedente);
//    }
//
//    /**
//     * Get Etpr114AnneePrecedente
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getEtpr114AnneePrecedente() {
//        return $this->Etpr114AnneePrecedente;
//    }

//    /**
//     * Add Etpr124AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $Etpr124AnneePrecedente
//     *
//     * @return RefFiliere
//     */
//    public function addEtpr124AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $Etpr124AnneePrecedente) {
//        $this->Etpr124AnneePrecedente[] = $Etpr124AnneePrecedente;
//
//        return $this;
//    }
//
//    /**
//     * Remove Etpr124AnneePrecedente
//     *
//     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $Etpr124AnneePrecedente
//     */
//    public function removeEtpr124AnneePrecedente(\Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente $Etpr124AnneePrecedente) {
//        $this->Etpr124AnneePrecedente->removeElement($Etpr124AnneePrecedente);
//    }
//
//    /**
//     * Get Etpr124AnneePrecedente
//     *
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getEtpr124AnneePrecedente() {
//        return $this->Etpr124AnneePrecedente;
//    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Add EtprAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent
     *
     * @return RefFiliere
     */
    public function addEtprAgent(\Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent) {
        $this->EtprAgent[] = $EtprAgent;

        return $this;
    }

    /**
     * Remove EtprAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent
     */
    public function removeEtprAgent(\Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent) {
        $this->EtprAgent->removeElement($EtprAgent);
    }

    /**
     * Get EtprAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtprAgent() {
        return $this->etprAgent;
    }

    /**
     * Add HeuSuppReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent
     *
     * @return RefFili
     */
    public function addHeuSuppReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent) {
        $this->HeuSuppReaRemAgent[] = $HeuSuppReaRemAgent;

        return $this;
    }

    /**
     * Remove HeuSuppReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent
     */
    public function removeHeuSuppReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent $HeuSuppReaRemAgent) {
        $this->HeuSuppReaRemAgent->removeElement($HeuSuppReaRemAgent);
    }

    /**
     * Get HeuSuppReaRemAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeuSuppReaRemAgent() {
        return $this->HeuSuppReaRemAgent;
    }

    /**
     * Add HeuCompReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent
     *
     * @return RefFili
     */
    public function addHeuCompReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent) {
        $this->HeuCompReaRemAgent[] = $HeuCompReaRemAgent;

        return $this;
    }

    /**
     * Remove HeuCompReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent
     */
    public function removeHeuCompReaRemAgent(\Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent) {
        $this->HeuCompReaRemAgent->removeElement($HeuCompReaRemAgent);
    }

    /**
     * Get HeuCompReaRemAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeuCompReaRemAgent() {
        return $this->HeuCompReaRemAgent;
    }


    /**
     * Add BilanQ30Alerte
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte
     *
     * @return BilanQ30Alerte
     */
    public function addBilanQ30Alerte(\Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte) {
        $this->BilanQ30Alerte[] = $BilanQ30Alerte;

        return $this;
    }

    /**
     * Remove BilanQ30Alerte
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte
     */
    public function removeBilanQ30Alerte(\Bilan_Social\Bundle\ApaBundle\Entity\BilanQ30Alerte $BilanQ30Alerte) {
        $this->BilanQ30Alerte->removeElement($BilanQ30Alerte);
    }

    /**
     * Get BilanQ30Alerte
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBilanQ30Alerte() {
        return $this->BilanQ30Alerte;
    }

    /**
     * Add RemunerationGlobaleAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent
     *
     * @return RemunerationGlobaleAgent
     */
    public function addRemunerationGlobaleAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent) {
        $this->RemunerationGlobaleAgent[] = $RemunerationGlobaleAgent;

        return $this;
    }

    /**
     * Remove RemunerationGlobaleAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent
     */
    public function removeRemunerationGlobaleAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent) {
        $this->RemunerationGlobaleAgent->removeElement($RemunerationGlobaleAgent);
    }

    /**
     * Get RemunerationGlobaleAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRemunerationGlobaleAgent() {
        return $this->RemunerationGlobaleAgent;
    }


    /**
     * Add RemunerationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent
     *
     * @return RemunerationAgent
     */
    public function addRemunerationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent) {
        $this->RemunerationAgent[] = $RemunerationAgent;

        return $this;
    }

    /**
     * Remove RemunerationAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent
     */
    public function removeRemunerationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent $RemunerationAgent) {
        $this->RemunerationAgent->removeElement($RemunerationAgent);
    }

    /**
     * Get RemunerationAgent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRemunerationAgent() {
        return $this->RemunerationAgent;
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
