<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMouvinteanne
 * @UniqueEntity(
 *      fields="cdMouvInteAnne",
 *      errorPath="cdMouvInteAnne",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMouvinteanne extends RefAbstractEntity
{
    /**
     * @var string
     */
    protected $cdMouvInteAnne;

    /**
     * @var string
     */
    protected $lbMouvInteAnne;

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
    protected $idMouvInteAnne;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $bilanSocialAgents;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $statutMouvInteAnne;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bilanSocialAgents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->statutMouvInteAnne = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdMouvInteAnne
     *
     * @param string $cdMouvInteAnne
     * @return RefMouvinteanne
     */
    public function setCdMouvInteAnne($cdMouvInteAnne)
    {
        $this->cdMouvInteAnne = $cdMouvInteAnne;

        return $this;
    }

    /**
     * Get cdMouvInteAnne
     *
     * @return string 
     */
    public function getCdMouvInteAnne()
    {
        return $this->cdMouvInteAnne;
    }

    /**
     * Set lbMouvInteAnne
     *
     * @param string $lbMouvInteAnne
     * @return RefMouvinteanne
     */
    public function setLbMouvInteAnne($lbMouvInteAnne)
    {
        $this->lbMouvInteAnne = $lbMouvInteAnne;

        return $this;
    }

    /**
     * Get lbMouvInteAnne
     *
     * @return string 
     */
    public function getLbMouvInteAnne()
    {
        return $this->lbMouvInteAnne;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return RefMouvinteanne
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
     * @return RefMouvinteanne
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
     * @return RefMouvinteanne
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
     * @return RefMouvinteanne
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
     * Get idMouvInteAnne
     *
     * @return integer 
     */
    public function getIdMouvInteAnne()
    {
        return $this->idMouvInteAnne;
    }

    /**
     * Add bilanSocialAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents
     * @return RefMouvinteanne
     */
    public function addBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents)
    {
        $this->bilanSocialAgents[] = $bilanSocialAgents;

        return $this;
    }

    /**
     * Remove bilanSocialAgents
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents
     */
    public function removeBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgents)
    {
        $this->bilanSocialAgents->removeElement($bilanSocialAgents);
    }

    /**
     * Get bilanSocialAgents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBilanSocialAgents()
    {
        return $this->bilanSocialAgents;
    }

    /**
     * Add statutMouvInteAnne
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMouvInteAnne
     * @return RefMouvinteanne
     */
    public function addStatutMouvInteAnne(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMouvInteAnne)
    {
        $this->statutMouvInteAnne[] = $statutMouvInteAnne;

        return $this;
    }

    /**
     * Remove statutMouvInteAnne
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMouvInteAnne
     */
    public function removeStatutMouvInteAnne(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $statutMouvInteAnne)
    {
        $this->statutMouvInteAnne->removeElement($statutMouvInteAnne);
    }

    /**
     * Get statutMouvInteAnne
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStatutMouvInteAnne()
    {
        return $this->statutMouvInteAnne;
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
