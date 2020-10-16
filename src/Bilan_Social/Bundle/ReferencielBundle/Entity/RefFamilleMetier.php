<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefFamilleMetier
 * @UniqueEntity(
 *      fields="cdFamilleMetier",
 *      errorPath="cdFamilleMetier",
 *      message="Ce code est déjà existant."
 * )
 */
class RefFamilleMetier extends RefAbstractEntity
{
    /**
     * @var integer
     */
    protected $idDomaineProfessionnel;

    /**
     * @var string
     */
    protected $cdFamilleMetier;

    /**
     * @var string
     */
    protected $lbFamilleMetier;

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
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineProfessionnel
     */
    protected $refDomaineProfessionnel;

    /**
     * @var integer
     */
    protected $idFamilleMetier;


    /**
     * Set idDomaineProfessionnel
     *
     * @param integer $idDomaineProfessionnel
     *
     * @return RefFamilleMetier
     */
    public function setIdDomaineProfessionnel($idDomaineProfessionnel)
    {
        $this->idDomaineProfessionnel = $idDomaineProfessionnel;

        return $this;
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

    /**
     * Set cdFamilleMetier
     *
     * @param string $cdFamilleMetier
     *
     * @return RefFamilleMetier
     */
    public function setCdFamilleMetier($cdFamilleMetier)
    {
        $this->cdFamilleMetier = $cdFamilleMetier;

        return $this;
    }

    /**
     * Get cdFamilleMetier
     *
     * @return string
     */
    public function getCdFamilleMetier()
    {
        return $this->cdFamilleMetier;
    }

    /**
     * Set lbFamilleMetier
     *
     * @param string $lbFamilleMetier
     *
     * @return RefFamilleMetier
     */
    public function setLbFamilleMetier($lbFamilleMetier)
    {
        $this->lbFamilleMetier = $lbFamilleMetier;

        return $this;
    }

    /**
     * Get lbFamilleMetier
     *
     * @return string
     */
    public function getLbFamilleMetier()
    {
        return $this->lbFamilleMetier;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefFamilleMetier
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
     * @return RefFamilleMetier
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
     * @return RefFamilleMetier
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
     * @return RefFamilleMetier
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
     * Get idFamilleMetier
     *
     * @return integer
     */
    public function getIdFamilleMetier()
    {
        return $this->idFamilleMetier;
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
     * Set refDomaineProfessionnel
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineProfessionnel $refDomaineProfessionnel
     *
     * @return RefFamilleMetier
     */
    public function setRefDomaineProfessionnel(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineProfessionnel $refDomaineProfessionnel = null)
    {
        $this->refDomaineProfessionnel = $refDomaineProfessionnel;

        return $this;
    }

    /**
     * Get refDomaineProfessionnel
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineProfessionnel
     */
    public function getRefDomaineProfessionnel()
    {
        return $this->refDomaineProfessionnel;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $RefMetier;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->RefMetier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add refMetier
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier $refMetier
     *
     * @return RefFamilleMetier
     */
    public function addRefMetier(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier $refMetier)
    {
        $this->RefMetier[] = $refMetier;

        return $this;
    }

    /**
     * Remove refMetier
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier $refMetier
     */
    public function removeRefMetier(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier $refMetier)
    {
        $this->RefMetier->removeElement($refMetier);
    }

    /**
     * Get refMetier
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefMetier()
    {
        return $this->RefMetier;
    }
}
