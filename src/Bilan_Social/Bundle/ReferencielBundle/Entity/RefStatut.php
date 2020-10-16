<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefStatut
 * @UniqueEntity(
 *      fields="cdStat",
 *      errorPath="cdStat",
 *      message="Ce code est déjà existant."
 * )
 */
class RefStatut extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $lbStat;

    /**
     * @var string
     */
    protected $cdStat;

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
     * @var string
     */
    protected $cdMotiN4ds;

    /**
     * @var integer
     */
    protected $idStat;

    /**
     * @var integer
     */
    protected $bl424;
    
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
    protected $RemunerationGlobaleAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RemunerationAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $HeuCompReaRemAgent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $refMotifDepart;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $refMouvinteanne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $refMotifArrivee;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $refPositionStatutaires;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->EtprAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->BilanQ30Alerte = new \Doctrine\Common\Collections\ArrayCollection();
        $this->HeuSuppReaRemAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->refMotifDepart = new \Doctrine\Common\Collections\ArrayCollection();
        $this->refMotifArrivee = new \Doctrine\Common\Collections\ArrayCollection();
        $this->HeuCompReaRemAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->refPositionStatutaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationGlobaleAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->RemunerationAgent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->refMouvinteanne = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lbStat
     *
     * @param string $lbStat
     *
     * @return RefStatut
     */
    public function setLbStat($lbStat) {
        $this->lbStat = $lbStat;

        return $this;
    }

    /**
     * Get lbStat
     *
     * @return string
     */
    public function getLbStat() {
        return $this->lbStat;
    }

    /**
     * Set cdStat
     *
     * @param string $cdStat
     *
     * @return RefStatut
     */
    public function setCdStat($cdStat) {
        $this->cdStat = $cdStat;

        return $this;
    }

    /**
     * Get cdStat
     *
     * @return string
     */
    public function getCdStat() {
        return $this->cdStat;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefStatut
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
     * @return RefStatut
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

    function getCdMotiN4ds() {
        return $this->cdMotiN4ds;
    }

    function setCdMotiN4ds($cdMotiN4ds) {
        $this->cdMotiN4ds = $cdMotiN4ds;
    }

    function getBl424() {
        return $this->bl424;
    }

    function setBl424($bl424) {
        $this->bl424 = $bl424;
    }    
    

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefStatut
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
     * @return RefStatut
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
     * Get idStat
     *
     * @return integer
     */
    public function getIdStat() {
        return $this->idStat;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefStatut
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
     * Add refMotifDepart
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart $refMotifDepart
     *
     * @return RefStatut
     */
    public function addRefMotifDepart(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart $refMotifDepart) {
        $this->refMotifDepart[] = $refMotifDepart;

        return $this;
    }

    /**
     * Remove refMotifDepart
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart $refMotifDepart
     */
    public function removeRefMotifDepart(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart $refMotifDepart) {
        $this->refMotifDepart->removeElement($refMotifDepart);
    }

    /**
     * Get refMotifDepart
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefMotifDepart() {
        return $this->refMotifDepart;
    }

    /**
     * Add refMotifArrivee
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee $refMotifArrivee
     *
     * @return RefStatut
     */
    public function addRefMotifArrivee(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee $refMotifArrivee) {
        $this->refMotifArrivee[] = $refMotifArrivee;

        return $this;
    }

    /**
     * Remove refMotifArrivee
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee $refMotifArrivee
     */
    public function removeRefMotifArrivee(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee $refMotifArrivee) {
        $this->refMotifArrivee->removeElement($refMotifArrivee);
    }

    /**
     * Get refMotifArrivee
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefMotifArrivee() {
        return $this->refMotifArrivee;
    }

    /**
     * Add EtprAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent $EtprAgent
     *
     * @return RefStatut
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
     * @return RefStatut
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
     * Add RemunerationGlobaleAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent $RemunerationGlobaleAgent
     *
     * @return RefStatut
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
     * @return RefStatut
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

    /**
     * Add HeuCompReaRemAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\HeuCompReaRemAgent $HeuCompReaRemAgent
     *
     * @return RefStatut
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

   

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Add refPositionStatutaires
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutaires
     *
     * @return RefStatut
     */
    public function addRefPositionStatutaires(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutaires) {
        $this->refPositionStatutaires[] = $refPositionStatutaires;

        return $this;
    }

    /**
     * Remove refPositionStatutaires
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutaires
     */
    public function removeRefPositionStatutaires(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire $refPositionStatutaires) {
        $this->refPositionStatutaires->removeElement($refPositionStatutaires);
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
     * Add refMouvinteanne
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne $refMouvinteanne
     *
     * @return RefStatut
     */
    public function addRefMouvinteanne(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne $refMouvinteanne) {
        $this->refMouvinteanne[] = $refMouvinteanne;

        return $this;
    }

    /**
     * Remove refMouvinteanne
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne $refMouvinteanne
     */
    public function removeRefMouvinteanne(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne $refMouvinteanne) {
        $this->refMouvinteanne->removeElement($refMouvinteanne);
    }

    /**
     * Get refMouvinteanne
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefMouvinteanne() {
        return $this->refMouvinteanne;
    }

}
