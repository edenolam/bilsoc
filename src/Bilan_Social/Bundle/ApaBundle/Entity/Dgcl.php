<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * GpeecPlus
 */
class Dgcl {
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
     * @var boolean
     */
    private $blJoursCarence;

    /**
     * @var integer
     */
    private $nbJoursCarence;

    /**
     * @var float
     */
    private $nbMontantCarence;

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return GpeecPlus
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
     * @return GpeecPlus
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
     * @return GpeecPlus
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
     * @return GpeecPlus
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
     * @return GpeecPlus
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
     * Set blJoursCarence
     *
     * @param string $blJoursCarence
     *
     * @return Dgcl
     */
    public function setBlJoursCarence($blJoursCarence)
    {
        $this->blJoursCarence = $blJoursCarence;

        return $this;
    }

    /**
     * Get blJoursCarence
     *
     * @return string
     */
    public function getBlJoursCarence()
    {
        return $this->blJoursCarence;
    }

    /**
     * Set nbJoursCarence
     *
     * @param string $nbJoursCarence
     *
     * @return Dgcl
     */
    public function setNbJoursCarence($nbJoursCarence)
    {
        $this->nbJoursCarence = $nbJoursCarence;

        return $this;
    }

    /**
     * Get blJoursCarence
     *
     * @return string
     */
    public function getNbJoursCarence()
    {
        return $this->nbJoursCarence;
    }

    /**
     * Set nbMontantCarence
     *
     * @param string $nbMontantCarence
     *
     * @return Dgcl
     */
    public function setNbMontantCarence($nbMontantCarence)
    {
        $this->nbMontantCarence = $nbMontantCarence;

        return $this;
    }

    /**
     * Get blJoursCarence
     *
     * @return string
     */
    public function getNbMontantCarence()
    {
        return $this->nbMontantCarence;
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

