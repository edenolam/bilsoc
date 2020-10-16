<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefOrganismeFormation
 * @UniqueEntity(
 *      fields="cdOrgaform",
 *      errorPath="cdOrgaform",
 *      message="Ce code est déjà existant."
 * )
 */
class RefOrganismeFormation extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdOrgaform;

    /**
     * @var string
     */
    protected $lbOrgaform;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $FormationAgents;

    /**
     * @var integer
     */
    protected $idOrgaform;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * Constructor
     */
    public function __construct() {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->FormationAgents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdOrgaform
     *
     * @param string $cdOrgaform
     *
     * @return RefOrganismeFormation
     */
    public function setCdOrgaform($cdOrgaform) {
        $this->cdOrgaform = $cdOrgaform;

        return $this;
    }

    /**
     * Get cdOrgaform
     *
     * @return string
     */
    public function getCdOrgaform() {
        return $this->cdOrgaform;
    }

    /**
     * Set lbOrgaform
     *
     * @param string $lbOrgaform
     *
     * @return RefOrganismeFormation
     */
    public function setLbOrgaform($lbOrgaform) {
        $this->lbOrgaform = $lbOrgaform;

        return $this;
    }

    /**
     * Get lbOrgaform
     *
     * @return string
     */
    public function getLbOrgaform() {
        return $this->lbOrgaform;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefOrganismeFormation
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
     * @return RefOrganismeFormation
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
     * @return RefOrganismeFormation
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
     * @return RefOrganismeFormation
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
     * Get idOrgaform
     *
     * @return integer
     */
    public function getIdOrgaform() {
        return $this->idOrgaform;
    }

    /**
     * Add bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RefOrganismeFormation
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
     * Add FormationAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents
     *
     * @return RefOrganismeFormation
     */
    public function addFormationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents) {
        $this->FormationAgents[] = $FormationAgents;

        return $this;
    }

    /**
     * Remove bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents
     */
    public function removeFormationAgent(\Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent $FormationAgents) {
        $this->FormationAgents->removeElement($FormationAgents);
    }

    /**
     * Get bilanSocialAgents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFormationAgents() {
        return $this->FormationAgents;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

}
