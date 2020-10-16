<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Gpeec
 */
class Gpeec
{
    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier
     */
    private $refMetier;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome
     */
    private $idDomaineDiplomeGpeec;

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return Gpeec
     */
    public function setCdUtilcrea($cdUtilcrea)
    {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea()
    {
        return $this->cdUtilcrea;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return Gpeec
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi()
    {
        return $this->cdUtilmodi;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Gpeec
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Gpeec
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return Gpeec
     */
    public function setBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent = null)
    {
        $this->BilanSocialAgent = $bilanSocialAgent;

        return $this;
    }

    /**
     * Get bilanSocialAgent
     *
     * @return \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    public function getBilanSocialAgent()
    {
        return $this->BilanSocialAgent;
    }

    /**
     * Set refMetier
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier $refMetier
     *
     * @return Gpeec
     */
    public function setRefMetier(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier $refMetier = null)
    {
        $this->refMetier = $refMetier;

        return $this;
    }

    /**
     * Get refMetier
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier
     */
    public function getRefMetier()
    {
        return $this->refMetier;
    }

    /**
     * Get idDomaineDiplomeGpeec
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome
     */
    public function getIdDomaineDiplomeGpeec() {
        return $this->idDomaineDiplomeGpeec;
    }
    
    function setIdDomaineDiplomeGpeec(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome $idDomaineDiplomeGpeec = null) {
        $this->idDomaineDiplomeGpeec = $idDomaineDiplomeGpeec;
    }

    
    /**
     * Set blAvisInaptitudeEnCours
     *
     * @param boolean $blAvisInaptitudeEnCours
     *
     * @return Handitorial
     */
    public function setBlAvisInaptitudeEnCours($blAvisInaptitudeEnCours) {
        $this->blAvisInaptitudeEnCours = $blAvisInaptitudeEnCours;

        return $this;
    }

   
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    public function setUpdateDateValue()
    {
        // Add your code here
    }
}

