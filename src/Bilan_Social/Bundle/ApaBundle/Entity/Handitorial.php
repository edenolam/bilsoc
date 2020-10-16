<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Handitorial
 */
class Handitorial
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth
     */
    private $idMesureInaptitudeEnCoursAnnee;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth
     */
    private $idMesureInaptitudeAvantAnnee;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth
     */
    private $idInaptitudeEnCoursAnnee;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth
     */
    private $idInaptitudeAvantAnnee;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureHandicapBoeth
     */
    private $idNatureHandicapBoeth;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth
     */
    private $idCategorieHanditorialBoeth;

    /**
     * @var bool
     */
    private $blAvisInaptitudeEnCours;

    /**
     * @var bool
     */
    private $blAvisInaptitudeAvant;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idMesureInaptitudeEnCoursAnnee
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth $idMesureInaptitudeEnCoursAnnee
     *
     * @return MesureBoeth
     */
    public function setIdMesureInaptitudeEnCoursAnnee(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth $idMesureInaptitudeEnCoursAnnee = null) {
        $this->idMesureInaptitudeEnCoursAnnee = $idMesureInaptitudeEnCoursAnnee;

        return $this;
    }

    /**
     * Get idMesureInaptitudeEnCoursAnnee
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth
     */
    public function getIdMesureInaptitudeEnCoursAnnee() {
        return $this->idMesureInaptitudeEnCoursAnnee;
    }

    /**
     * Set idMesureInaptitudeAvantAnnee
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth $idMesureInaptitudeAvantAnnee
     *
     * @return MesureBoeth
     */
    public function setIdMesureInaptitudeAvantAnnee(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth $idMesureInaptitudeAvantAnnee = null) {
        $this->idMesureInaptitudeAvantAnnee = $idMesureInaptitudeAvantAnnee;

        return $this;
    }

    /**
     * Get idMesureInaptitudeAvantAnnee
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth
     */
    public function getIdMesureInaptitudeAvantAnnee() {
        return $this->idMesureInaptitudeAvantAnnee;
    }

    /**
     * Set idInaptitudeEnCoursAnnee
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth $idInaptitudeEnCoursAnnee
     *
     * @return Boeth
     */
    public function setIdInaptitudeEnCoursAnnee(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth $idInaptitudeEnCoursAnnee = null) {
        $this->idInaptitudeEnCoursAnnee = $idInaptitudeEnCoursAnnee;

        return $this;
    }

    /**
     * Get idInaptitudeEnCoursAnnee
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth
     */
    public function getIdInaptitudeEnCoursAnnee() {
        return $this->idInaptitudeEnCoursAnnee;
    }

    /**
     * Set idInaptitudeAvantAnnee
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth $idInaptitudeAvantAnnee
     *
     * @return Boeth
     */
    public function setIdInaptitudeAvantAnnee(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth $idInaptitudeAvantAnnee = null) {
        $this->idInaptitudeAvantAnnee = $idInaptitudeAvantAnnee;

        return $this;
    }

    /**
     * Get idInaptitudeAvantAnnee
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth
     */
    public function getIdInaptitudeAvantAnnee() {
        return $this->idInaptitudeAvantAnnee;
    }

    /**
     * Set idNatureHandicapBoeth
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureHandicapBoeth $idNatureHandicapBoeth
     *
     * @return Boeth
     */
    public function setIdNatureHandicapBoeth(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureHandicapBoeth $idNatureHandicapBoeth = null) {
        $this->idNatureHandicapBoeth = $idNatureHandicapBoeth;

        return $this;
    }

    /**
     * Get idNatureHandicapBoeth
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureHandicapBoeth
     */
    public function getIdNatureHandicapBoeth() {
        return $this->idNatureHandicapBoeth;
    }

    /**
     * Set idCategorieHanditorialBoeth
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth $idCategorieHanditorialBoeth
     *
     * @return Boeth
     */
    public function setIdCategorieHanditorialBoeth(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth $idCategorieHanditorialBoeth = null) {
        $this->idCategorieHanditorialBoeth = $idCategorieHanditorialBoeth;

        return $this;
    }

    /**
     * Get idCategorieHanditorialBoeth
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth
     */
    public function getIdCategorieHanditorialBoeth() {
        return $this->idCategorieHanditorialBoeth;
    }

    /**
     * Set idDomaineDiplomeGpeec
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome $idDomaineDiplomeGpeec
     *
     * @return RefDomaineDiplome
     */
    public function setIdDomaineDiplomeGpeec(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome $idDomaineDiplomeGpeec = null) {
        $this->idDomaineDiplomeGpeec = $idDomaineDiplomeGpeec;

        return $this;
    }

    /**
     * Get blAvisInaptitudeEnCours
     *
     * @return bool
     */
    public function getBlAvisInaptitudeEnCours()
    {
        return $this->blAvisInaptitudeEnCours;
    }

    function setBlAvisInaptitudeEnCours($blAvisInaptitudeEnCours) {
        $this->blAvisInaptitudeEnCours = $blAvisInaptitudeEnCours;
    }

    /**
     * Set blAvisInaptitudeAvant
     *
     * @param boolean $blAvisInaptitudeAvant
     *
     * @return Handitorial
     */
    public function setBlAvisInaptitudeAvant($blAvisInaptitudeAvant)
    {
        $this->blAvisInaptitudeAvant = $blAvisInaptitudeAvant;

        return $this;
    }

    /**
     * Get blAvisInaptitudeAvant
     *
     * @return bool
     */
    public function getBlAvisInaptitudeAvant()
    {
        return $this->blAvisInaptitudeAvant;
    }

    /**
     * Set bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return MesureBoeth
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

}
