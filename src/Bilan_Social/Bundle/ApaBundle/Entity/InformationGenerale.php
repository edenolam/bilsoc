<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;

/**
 * InformationGenerale
 */
class InformationGenerale extends AbstractEntity {

    /**
     * @var boolean
     */
    protected $q1;

    /**
     * @var boolean
     */
    protected $q2;

    /**
     * @var boolean
     */
    protected $q3;

//    /**
//     * @var boolean
//     */
//    protected $q4;
//
//    /**
//     * @var boolean
//     */
//    protected $q5;

    /**
     * @var boolean
     */
    protected $q6;

    /**
     * @var boolean
     */
    protected $q7;

    /**
     * @var boolean
     */
    private $blHeursupp;

    /**
     * @var boolean
     */
    private $blHeurcomp;

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
    protected $idInfogene;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Assert\Valid
     */
    protected $agentremufonctionnaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $agentremucontnonperm;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $agentremucontperm;

    /**
     * @var \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete
     */
    protected $enquete;

    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    protected $collectivite;

    public function __construct() {
        $this->agentremufonctionnaire = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agentremucontnonperm = new \Doctrine\Common\Collections\ArrayCollection();
        $this->agentremucontperm = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set q1
     *
     * @param boolean $q1
     *
     * @return InformationGenerale
     */
    public function setQ1($q1) {
        $this->q1 = $q1;

        return $this;
    }

    /**
     * Get q1
     *
     * @return boolean
     */
    public function getQ1() {
        return $this->q1;
    }

    /**
     * Set q2
     *
     * @param boolean $q2
     *
     * @return InformationGenerale
     */
    public function setQ2($q2) {
        $this->q2 = $q2;

        return $this;
    }

    /**
     * Get q2
     *
     * @return boolean
     */
    public function getQ2() {
        return $this->q2;
    }

    /**
     * Set q3
     *
     * @param boolean $q3
     *
     * @return InformationGenerale
     */
    public function setQ3($q3) {
        $this->q3 = $q3;

        return $this;
    }

    /**
     * Get q3
     *
     * @return boolean
     */
    public function getQ3() {
        return $this->q3;
    }

//    /**
//     * Set q4
//     *
//     * @param boolean $q4
//     *
//     * @return InformationGenerale
//     */
//    public function setQ4($q4) {
//        $this->q4 = $q4;
//
//        return $this;
//    }
//
//    /**
//     * Get q4
//     *
//     * @return boolean
//     */
//    public function getQ4() {
//        return $this->q4;
//    }
//
//    /**
//     * Set q5
//     *
//     * @param boolean $q5
//     *
//     * @return InformationGenerale
//     */
//    public function setQ5($q5) {
//        $this->q5 = $q5;
//
//        return $this;
//    }
//
//    /**
//     * Get q5
//     *
//     * @return boolean
//     */
//    public function getQ5() {
//        return $this->q5;
//    }

    /**
     * Set q6
     *
     * @param boolean $q6
     *
     * @return InformationGenerale
     */
    public function setQ6($q6) {
        $this->q6 = $q6;

        return $this;
    }

    /**
     * Get q6
     *
     * @return boolean
     */
    public function getQ6() {
        return $this->q6;
    }

    /**
     * Set q7
     *
     * @param boolean $q7
     *
     * @return InformationGenerale
     */
    public function setQ7($q7) {
        $this->q7 = $q7;

        return $this;
    }

    /**
     * Get q7
     *
     * @return boolean
     */
    public function getQ7() {
        return $this->q7;
    }

    /**
     * Set blHeursupp
     *
     * @param boolean $blHeursupp
     *
     * @return InformationColectiviteAgent
     */
    public function setBlHeursupp($blHeursupp) {
        $this->blHeursupp = $blHeursupp;

        return $this;
    }

    /**
     * Get blHeursupp
     *
     * @return boolean
     */
    public function getBlHeursupp() {
        return $this->blHeursupp;
    }

    /**
     * Set blHeurcomp
     *
     * @param boolean $blHeurcomp
     *
     * @return InformationColectiviteAgent
     */
    public function setBlHeurcomp($blHeurcomp) {
        $this->blHeurcomp = $blHeurcomp;

        return $this;
    }

    /**
     * Get blHeurcomp
     *
     * @return boolean
     */
    public function getBlHeurcomp() {
        return $this->blHeurcomp;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return InformationGenerale
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
     * @return InformationGenerale
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
     * @return InformationGenerale
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
     * @return InformationGenerale
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
     * Get idInfogene
     *
     * @return integer
     */
    public function getIdInfogene() {
        return $this->idInfogene;
    }

    /**
     * Set enquete
     *
     * @param \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete
     *
     * @return InformationGenerale
     */
    public function setEnquete(\Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete = null) {
        $this->enquete = $enquete;

        return $this;
    }

    /**
     * Get enquete
     *
     * @return \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete
     */
    public function getEnquete() {
        return $this->enquete;
    }

    /**
     * Set collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return InformationGenerale
     */
    public function setCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite = null) {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    public function getCollectivite() {
        return $this->collectivite;
    }

    /**
     * Add agentremufonctionnaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationFonctionnaire $agentremufonctionnaire
     *
     * @return agentremufonctionnaire
     */
    public function addAgentRemuFonctionnaire(\Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationFonctionnaire $agentremufonctionnaire) {
        $this->agentremufonctionnaire[] = $agentremufonctionnaire;

        return $this;
    }

    /**
     * Remove agentremufonctionnaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationFonctionnaire $agentremufonctionnaire
     */
    public function removeAgentRemuFonctionnaire(\Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationFonctionnaire $agentremufonctionnaire) {
        $this->agentremufonctionnaire->removeElement($agentremufonctionnaire);
    }

    /**
     * Get agentremufonctionnaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgentRemuFonctionnaire() {
        return $this->agentremufonctionnaire;
    }

    /**
     * Add agentremucontnonperm
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelNonPermament $agentremucontnonperm
     *
     * @return agentremucontnonperm
     */
    public function addAgentRemuContNonPerm(\Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelNonPermanent $agentremucontnonperm) {
        $this->agentremucontnonperm[] = $agentremucontnonperm;

        return $this;
    }

    /**
     * Remove agentremucontnonperm
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelNonPermament $agentremucontnonperm
     */
    public function removeAgentRemuContNonPerm(\Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelNonPermanent $agentremucontnonperm) {
        $this->agentremucontnonperm->removeElement($agentremucontnonperm);
    }

    /**
     * Get agentremucontnonperm
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgentRemuContNonPerm() {
        return $this->agentremucontnonperm;
    }

    /**
     * Add agentremucontperm
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelPermament $agentremucontperm
     *
     * @return agentremucontperm
     */
    public function addAgentRemuContPerm(\Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelPermanent $agentremucontperm) {
        $this->agentremucontperm[] = $agentremucontperm;

        return $this;
    }

    /**
     * Remove agentremucontperm
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelPermament $agentremucontperm
     */
    public function removeAgentRemuContPerm(\Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelPermanent $agentremucontperm) {
        $this->agentremucontperm->removeElement($agentremucontperm);
    }

    /**
     * Get agentremucontperm
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAgentRemuContPerm() {
        return $this->agentremucontperm;
    }

    public function setCreatedAtValue() {
// Add your code here
    }

    public function setUpdateDateValue() {
// Add your code here
    }

}
