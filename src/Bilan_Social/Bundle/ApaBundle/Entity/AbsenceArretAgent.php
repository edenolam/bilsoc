<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * AbsenceArretAgent
 */
class AbsenceArretAgent {

    /**
     * @var integer
     */
    private $idBilasociagen;

    /**
     * @var float
     */
    private $nbJourabse;

    /**
     * @var integer
     */
    private $accidentAvecArret;

    /**
     * @var integer
     */
    private $nbArre;

    /**
     * @integer
     */
    private $anneeEvenement;

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
    private $idAbsearreagen;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence
     */
    private $RefMotifAbsence;

    private $lbMotiAbseN4ds;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    //private $rassctMotifAbsence;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureLesion
     */
    private $idNatureLesion;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefElementMateriel
     */
    private $idElementMateriel;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSiegeLesion
     */
    private $idSiegeLesion;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMaladieProfessionnelle
     */
    private $idMaladieProfessionnelle;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeActivite
     */
    private $idTypeActiviteMaladiePro;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeActivite
     */
    private $idTypeActiviteArretTravail;

    public function __construct() {
    }

    /**
     * Set nbJourabse
     *
     * @param float $nbJourabse
     *
     * @return AbsenceArretAgent
     */
    public function setNbJourabse($nbJourabse) {
        $this->nbJourabse = $nbJourabse;

        return $this;
    }

    /**
     * Get nbJourabse
     *
     * @return float
     */
    public function getNbJourabse() {
        return $this->nbJourabse;
    }

    function getAccidentAvecArret() {
        return $this->accidentAvecArret;
    }

    function setAccidentAvecArret($accidentAvecArret) {
        $this->accidentAvecArret = $accidentAvecArret;
    }

    /**
     * Set nbArre
     *
     * @param integer $nbArre
     *
     * @return AbsenceArretAgent
     */
    public function setNbArre($nbArre) {
        $this->nbArre = $nbArre;

        return $this;
    }

    /**
     * Get nbArre
     *
     * @return integer
     */
    public function getNbArre() {
        return $this->nbArre;
    }

    function getAnneeEvenement() {
        return $this->anneeEvenement;
    }

    function setAnneeEvenement($anneeEvenement) {
        $this->anneeEvenement = $anneeEvenement;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return AbsenceArretAgent
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
     * @return AbsenceArretAgent
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
     * @return AbsenceArretAgent
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
     * @return AbsenceArretAgent
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
     * Get idAbsearreagen
     *
     * @return integer
     */
    public function getIdAbsearreagen() {
        return $this->idAbsearreagen;
    }

    /**
     * Set bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return AbsenceArretAgent
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
     * Set refMotifAbsence
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence $refMotifAbsence
     *
     * @return AbsenceArretAgent
     */
    public function setRefMotifAbsence(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence $refMotifAbsence = null) {
        $this->RefMotifAbsence = $refMotifAbsence;

        return $this;
    }

    /**
     * Get refMotifAbsence
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence
     */
    public function getRefMotifAbsence() {
        return $this->RefMotifAbsence;
    }

    function getIdBilasociagen() {
        return $this->idBilasociagen;
    }

    function setIdBilasociagen($idBilasociagen) {
        $this->idBilasociagen = $idBilasociagen;
    }

    public function addBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $BilanSocialAgent) {

        if (!$this->BilanSocialAgent->contains($BilanSocialAgent)) {
            $this->BilanSocialAgent->add($BilanSocialAgent);
        }
    }

    public function setCreatedAtValue() {
        $this->createdAt = new \DateTime();
    }

    public function setUpdateDateValue() {
        $this->updatedAt = new \DateTime();
    }

    function getLbMotiAbseN4ds() {
        return $this->lbMotiAbseN4ds;
    }

    function setLbMotiAbseN4ds($lbMotiAbseN4ds) {
        $this->lbMotiAbseN4ds = $lbMotiAbseN4ds;
    }

    /**
     * Add rassctMotifAbsence
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Rassct $rassctMotifAbsence
     *
     * @return rassctMotifAbsence
     */
    /*public function addRassctMotifAbsence(\Bilan_Social\Bundle\ApaBundle\Entity\Rassct $rassctMotifAbsence) {
        $this->rassctMotifAbsence[] = $rassctMotifAbsence;

        return $this;
    }*/

    /**
     * Remove rassctMotifAbsence
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\Rassct $rassctMotifAbsence
     */
    /*public function removeRassctMotifAbsence(\Bilan_Social\Bundle\ApaBundle\Entity\Rassct $rassctMotifAbsence) {
        $this->rassctMotifAbsence->removeElement($rassctMotifAbsence);
    }*/

    /**
     * Get rassctMotifAbsence
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    /*public function getRassctMotifAbsence() {
        return $this->rassctMotifAbsence;
    }*/

    function getIdNatureLesion() {
        return $this->idNatureLesion;
    }

    function getIdElementMateriel() {
        return $this->idElementMateriel;
    }

    function getIdSiegeLesion() {
        return $this->idSiegeLesion;
    }

    function setIdNatureLesion(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureLesion $idNatureLesion = null) {
        $this->idNatureLesion = $idNatureLesion;
    }

    function setIdElementMateriel(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefElementMateriel $idElementMateriel = null) {
        $this->idElementMateriel = $idElementMateriel;
    }

    function setIdSiegeLesion(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefSiegeLesion $idSiegeLesion = null) {
        $this->idSiegeLesion = $idSiegeLesion;
    }

    function getIdMaladieProfessionnelle() {
        return $this->idMaladieProfessionnelle;
    }

    function getIdTypeActiviteMaladiePro() {
        return $this->idTypeActiviteMaladiePro;
    }

    function getIdTypeActiviteArretTravail() {
        return $this->idTypeActiviteArretTravail;
    }

    function setIdMaladieProfessionnelle(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMaladieProfessionnelle $idMaladieProfessionnelle = null) {
        $this->idMaladieProfessionnelle = $idMaladieProfessionnelle;
    }

    function setIdTypeActiviteMaladiePro(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeActivite $idTypeActiviteMaladiePro = null) {
        $this->idTypeActiviteMaladiePro = $idTypeActiviteMaladiePro;
    }

    function setIdTypeActiviteArretTravail(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeActivite $idTypeActiviteArretTravail = null) {
        $this->idTypeActiviteArretTravail = $idTypeActiviteArretTravail;
    }

    /*function getAbsenceRasscts() {
        return $this->AbsenceRasscts;
    }

    function setAbsenceRasscts(\Bilan_Social\Bundle\ApaBundle\Entity\AbsenceRassct $AbsenceRasscts) {
        $this->AbsenceRasscts = $AbsenceRasscts;
    }*/

}
