<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefPositionStatutaire
 * @UniqueEntity(
 *      fields="cdPosistat",
 *      errorPath="cdPosistat",
 *      message="Ce code est déjà existant."
 * )
 */
class RefPositionStatutaire extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdPosistat;

    /**
     * @var string
     */
    protected $lbPosistat;

    protected $lbCompl;

    protected $lbComm;

    /**
     * @var boolean
     */
    protected $blCdg;

    protected $blInd142;
    protected $blInd143;
    protected $blInd144;

    protected $cdMotiN4ds;

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
    protected $idPosistat;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;
    /**
    * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefGroupePositionStatutaire
    */
     protected $refGroupePositionStatutaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgentsNonRemu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $statutPositionStatutaires;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bilanSocialAgentsNonRemu = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statutPositionStatutaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdPosistat
     *
     * @param string $cdPosistat
     *
     * @return RefPositionStatutaire
     */
    public function setCdPosistat($cdPosistat) {
        $this->cdPosistat = $cdPosistat;

        return $this;
    }

    /**
     * Get cdPosistat
     *
     * @return string
     */
    public function getCdPosistat() {
        return $this->cdPosistat;
    }

    /**
     * Set lbPosistat
     *
     * @param string $lbPosistat
     *
     * @return RefPositionStatutaire
     */
    public function setLbPosistat($lbPosistat) {
        $this->lbPosistat = $lbPosistat;

        return $this;
    }

    /**
     * Get lbPosistat
     *
     * @return string
     */
    public function getLbPosistat() {
        return $this->lbPosistat;
    }

    /**
     * Set blCdg
     *
     * @param boolean $blCdg
     *
     * @return RefPositionStatutaire
     */
    public function setBlCdg($blCdg) {
        $this->blCdg = $blCdg;

        return $this;
    }

    /**
     * Get blCdg
     *
     * @return boolean
     */
    public function getBlCdg() {
        return $this->blCdg;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefPositionStatutaire
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
     * @return RefPositionStatutaire
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
     * @return RefPositionStatutaire
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
     * @return RefPositionStatutaire
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
     * Get idPosistat
     *
     * @return integer
     */
    public function getIdPosistat() {
        return $this->idPosistat;
    }


    function getLbCompl() {
        return $this->lbCompl;
    }

    function getLbComm() {
        return $this->lbComm;
    }

    function setLbCompl($lbCompl) {
        $this->lbCompl = $lbCompl;
    }

    function setLbComm($lbComm) {
        $this->lbComm = $lbComm;
    }


    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefPositionStatutaire
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

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getRefGroupePositionStatutaire() {
        return $this->refGroupePositionStatutaire;
    }

    function setRefGroupePositionStatutaire($refGroupePositionStatutaire) {
        $this->refGroupePositionStatutaire = $refGroupePositionStatutaire;
    }

    function getBlInd142() {
        return $this->blInd142;
    }

    function getBlInd143() {
        return $this->blInd143;
    }

    function getBlInd144() {
        return $this->blInd144;
    }

    function setBlInd142($blInd142) {
        $this->blInd142 = $blInd142;
    }

    function setBlInd143($blInd143) {
        $this->blInd143 = $blInd143;
    }

    function setBlInd144($blInd144) {
        $this->blInd144 = $blInd144;
    }

    public function getLbGroupePositionStatutaire()
    {
        // safety measure in-case a part hasn't been assigned to a project
        if (null === $this->getRefGroupePositionStatutaire()) {
            return null;
        }
        $lbGroupe = $this->getRefGroupePositionStatutaire()->getLbGrouPosistat().' '.$this->getRefGroupePositionStatutaire()->getLbGrouCompl();
        return $lbGroupe;
    }

    public function getLbPositionStatutaireComplet()
    {
        $lbPosistat = $this->getLbPosistat().' '.$this->getLbCompl();
        return $lbPosistat;
    }

    /**
     * Add bilanSocialAgentsNonRemu
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsNonRemu
     *
     * @return RefPositionStatutaire
     */
    public function addBilanSocialAgentNonRemu(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentNonRemu) {
        $this->bilanSocialAgentsNonRemu[] = $bilanSocialAgentNonRemu;

        return $this;
    }

    /**
     * Remove bilanSocialAgentsNonRemu
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentsNonRemu
     */
    public function removeBilanSocialAgentNonRemu(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgentNonRemu) {
        $this->bilanSocialAgentsNonRemu->removeElement($bilanSocialAgentNonRemu);
    }

    /**
     * Add statutPositionStatutaires
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifDeparts
     *
     * @return RefStatut
     */
    public function addStatutPositionStatutaires(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutPositionStatutaires) {
        $this->statutPositionStatutaires[] = $statutPositionStatutaires;

        return $this;
    }

    /**
     * Remove statutPositionStatutaires
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMotifDeparts
     */
    public function removeStatutPositionStatutaires(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutPositionStatutaires) {
        $this->statutPositionStatutaires->removeElement($statutPositionStatutaires);
    }

    /**
     * Get statut_motif_depart
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStatutPositionStatutaires() {
        return $this->statutPositionStatutaires;
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
