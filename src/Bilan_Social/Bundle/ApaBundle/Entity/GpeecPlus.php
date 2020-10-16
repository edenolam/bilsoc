<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * GpeecPlus
 */
class GpeecPlus {
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
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialites
     */
    private $refSpecialite;

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
     * Set refSpecialite
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite $refSpecialite
     *
     * @return GpeecPlus
     */
    public function setRefSpecialite(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite $refSpecialite = null) {
        $this->refSpecialite = $refSpecialite;

        return $this;
    }

    /**
     * Get refSpecialite
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite
     */
    public function getRefSpecialite() {
        return $this->refSpecialite;
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

