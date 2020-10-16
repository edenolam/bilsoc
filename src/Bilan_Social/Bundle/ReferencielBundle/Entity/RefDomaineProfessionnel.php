<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefDomaineProfessionnel
 * @UniqueEntity(
 *      fields="cdDomaineProfessionnel",
 *      errorPath="cdDomaineProfessionnel",
 *      message="Ce code est déjà existant."
 * )
 */
class RefDomaineProfessionnel extends RefAbstractEntity
{
    /**
     * @var string
     */
    protected $cdDomaineProfessionnel;

    /**
     * @var string
     */
    protected $lbDomaineProfessionnel;

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
    protected $idDomaineProfessionnel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RefFamilleMetier;

    /**
     * Constructor
     */
    public function __construct() {
        $this->RefFamilleMetier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdDomaineProfessionnel
     *
     * @param string $cdDomaineProfessionnel
     *
     * @return RefDomaineProfessionnel
     */
    public function setCdDomaineProfessionnel($cdDomaineProfessionnel)
    {
        $this->cdDomaineProfessionnel = $cdDomaineProfessionnel;

        return $this;
    }

    /**
     * Get cdDomaineProfessionnel
     *
     * @return string
     */
    public function getCdDomaineProfessionnel()
    {
        return $this->cdDomaineProfessionnel;
    }

    /**
     * Set lbDomaineProfessionnel
     *
     * @param string $lbDomaineProfessionnel
     *
     * @return RefDomaineProfessionnel
     */
    public function setLbDomaineProfessionnel($lbDomaineProfessionnel)
    {
        $this->lbDomaineProfessionnel = $lbDomaineProfessionnel;

        return $this;
    }

    /**
     * Get lbDomaineProfessionnel
     *
     * @return string
     */
    public function getLbDomaineProfessionnel()
    {
        return $this->lbDomaineProfessionnel;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefDomaineProfessionnel
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
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefDomaineProfessionnel
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefDomaineProfessionnel
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
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefDomaineProfessionnel
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
     * Get idDomaineProfessionnel
     *
     * @return integer
     */
    public function getIdDomaineProfessionnel()
    {
        return $this->idDomaineProfessionnel;
    }
   
    public function setCreatedAtValue()
    {
        // Add your code here
    }

  
    public function setUpdateDateValue()
    {
        // Add your code here
    }
   

    /**
     * Add refFamilleMetier
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier $refFamilleMetier
     *
     * @return RefDomaineProfessionnel
     */
    public function addRefFamilleMetier(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier $refFamilleMetier)
    {
        $this->RefFamilleMetier[] = $refFamilleMetier;

        return $this;
    }

    /**
     * Remove refFamilleMetier
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier $refFamilleMetier
     */
    public function removeRefFamilleMetier(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier $refFamilleMetier)
    {
        $this->RefFamilleMetier->removeElement($refFamilleMetier);
    }

    /**
     * Get refFamilleMetier
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefFamilleMetier()
    {
        return $this->RefFamilleMetier;
    }
}
