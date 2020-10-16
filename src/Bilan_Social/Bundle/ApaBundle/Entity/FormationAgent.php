<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * FormationAgent
 */
class FormationAgent {

    /**
     * @var integer
     */
    private $nbjourForm;

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
    private $idFormagen;
    
    /**
     * @var boolean
     */
    private $blCpf ;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefOrganismeFormation
     */
    private $refOrganismeFormation;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFormation
     */
    private $refFormation;

    /**
     * Set nbjourForm
     *
     * @param integer $nbjourForm
     *
     * @return FormationAgent
     */
    public function setNbjourForm($nbjourForm) {
        $this->nbjourForm = $nbjourForm;

        return $this;
    }

    /**
     * Get nbjourForm
     *
     * @return integer
     */
    public function getNbjourForm() {
        return $this->nbjourForm;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return FormationAgent
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
     * @return FormationAgent
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
     * @return FormationAgent
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
     * @return FormationAgent
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
     * Get idFormagen
     *
     * @return integer
     */
    public function getIdFormagen() {
        return $this->idFormagen;
    }

    /**
     * Set bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return FormationAgent
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
     * Set refOrganismeFormation
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefOrganismeFormation $refOrganismeFormation
     *
     * @return FormationAgent
     */
    public function setRefOrganismeFormation(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefOrganismeFormation $refOrganismeFormation = null) {
        $this->refOrganismeFormation = $refOrganismeFormation;

        return $this;
    }

    /**
     * Get refOrganismeFormation
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefOrganismeFormation
     */
    public function getRefOrganismeFormation() {
        return $this->refOrganismeFormation;
    }

    /**
     * Set refFormation
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFormation $refFormation
     *
     * @return FormationAgent
     */
    public function setRefFormation(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFormation $refFormation = null) {
        $this->refFormation = $refFormation;

        return $this;
    }

    /**
     * Get refFormation
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFormation
     */
    public function getRefFormation() {
        return $this->refFormation;
    }

    public function setCreatedAtValue() {
        // Add your code here
    }

    public function setUpdateDateValue() {
        // Add your code here
    }
    function getBlCpf() {
        return $this->blCpf;
    }

    function setBlCpf($blCpf) {
        $this->blCpf = $blCpf;
    }



}
