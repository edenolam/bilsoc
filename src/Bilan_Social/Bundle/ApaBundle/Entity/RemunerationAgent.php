<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RemunerationAgent
 */
class RemunerationAgent
{

    /**
     * @var string
     */
    private $dateIn;

    /**
     * @var string
     */
    private $dateOut;

    /**
     * @var integer
     */
    private $mtTotalRemunerationBrute;

    /**
     * @var integer
     */
    private $mtPrime;

    /**
     * @var integer
     */
    private $mtNBI;

    /**
     * @var integer
     */
    private $mtHcHs;

    /**
     * @var integer
     */
    private $mtSFT;

    /**
     * @var integer
     */
    private $mtIR;

    /**
     * @var integer
     */
    private $nbHeureSupp;

    /**
     * @var integer
     */
    private $nbHeureCompl;

    /**
     * @var boolean
     */
    private $blTempcomp;


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
    private $idRemunerationAgent;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent
     */
    private $BilanSocialAgent;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    private $refStatut;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    private $refCategorie;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    private $refFiliere;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    private $refEmploiNonPermanent;



    /**
     * Set dateIn
     *
     * @param string $dateIn
     *
     * @return RemunerationAgent
     */
    public function setDateIn($dateIn)
    {
        $this->dateIn = $dateIn;

        return $this;
    }

    /**
     * Get dateIn
     *
     * @return string
     */
    public function getDateIn()
    {
        return $this->dateIn;
    }

    /**
     * Set dateOut
     *
     * @param string $dateOut
     *
     * @return RemunerationAgent
     */
    public function setDateOut($dateOut)
    {
        $this->dateOut = $dateOut;

        return $this;
    }

    /**
     * Get dateOut
     *
     * @return string
     */
    public function getDateOut()
    {
        return $this->dateOut;
    }

    /**
     * Set blTempcomp
     *
     * @param integer $blTempcomp
     *
     * @return RemunerationAgent
     */
    public function setBlTempcomp($blTempcomp)
    {
        $this->blTempcomp = $blTempcomp;

        return $this;
    }

    /**
     * Get blTempcomp
     *
     * @return integer
     */
    public function getBlTempcomp()
    {
        return $this->blTempcomp;
    }

    /**
     * Set mtTotalRemunerationBrute
     *
     * @param integer $mtTotalRemunerationBrute
     *
     * @return RemunerationAgent
     */
    public function setMtTotalRemunerationBrute($mtTotalRemunerationBrute)
    {
        $this->mtTotalRemunerationBrute = $mtTotalRemunerationBrute;

        return $this;
    }

    /**
     * Get mtTotalRemunerationBrute
     *
     * @return integer
     */
    public function getMtTotalRemunerationBrute()
    {
        return $this->mtTotalRemunerationBrute;
    }

    /**
     * Set mtPrime
     *
     * @param integer $mtPrime
     *
     * @return RemunerationAgent
     */
    public function setMtPrime($mtPrime)
    {
        $this->mtPrime = $mtPrime;

        return $this;
    }

    /**
     * Get mtPrime
     *
     * @return integer
     */
    public function getMtPrime()
    {
        return $this->mtPrime;
    }

    /**
     * Set mtNBI
     *
     * @param integer $mtNBI
     *
     * @return RemunerationAgent
     */
    public function setMtNBI($mtNBI)
    {
        $this->mtNBI = $mtNBI;

        return $this;
    }

    /**
     * Get mtNBI
     *
     * @return integer
     */
    public function getMtNBI()
    {
        return $this->mtNBI;
    }

    /**
     * Set mtHcHs
     *
     * @param integer $mtHcHs
     *
     * @return RemunerationAgent
     */
    public function setMtHcHs($mtHcHs)
    {
        $this->mtHcHs = $mtHcHs;

        return $this;
    }

    /**
     * Get mtHcHs
     *
     * @return integer
     */
    public function getMtHcHs()
    {
        return $this->mtHcHs;
    }

    /**
     * Set mtSFT
     *
     * @param integer $mtSFT
     *
     * @return RemunerationAgent
     */
    public function setMtSFT($mtSFT)
    {
        $this->mtSFT = $mtSFT;

        return $this;
    }

    /**
     * Get mtSFT
     *
     * @return integer
     */
    public function getMtSFT()
    {
        return $this->mtSFT;
    }

    /**
     * Set mtIR
     *
     * @param integer $mtIR
     *
     * @return RemunerationAgent
     */
    public function setMtIR($mtIR)
    {
        $this->mtIR = $mtIR;

        return $this;
    }

    /**
     * Get mtIR
     *
     * @return integer
     */
    public function getMtIR()
    {
        return $this->mtIR;
    }

    /**
     * Set nbHeureSupp
     *
     * @param integer $nbHeureSupp
     *
     * @return RemunerationAgent
     */
    public function setNbHeureSupp($nbHeureSupp)
    {
        $this->nbHeureSupp = $nbHeureSupp;

        return $this;
    }

    /**
     * Get nbHeureSupp
     *
     * @return integer
     */
    public function getNbHeureSupp()
    {
        return $this->nbHeureSupp;
    }

    /**
     * Set nbHeureCompl
     *
     * @param integer $nbHeureCompl
     *
     * @return RemunerationAgent
     */
    public function setNbHeureCompl($nbHeureCompl)
    {
        $this->nbHeureCompl = $nbHeureCompl;

        return $this;
    }

    /**
     * Get nbHeureCompl
     *
     * @return integer
     */
    public function getNbHeureCompl()
    {
        return $this->nbHeureCompl;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RemunerationAgent
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
     * @return RemunerationAgent
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
     * @return RemunerationAgent
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
     * @return RemunerationAgent
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
     * Get idRemunerationAgent
     *
     * @return integer
     */
    public function getIdRemunerationAgent()
    {
        return $this->idRemunerationAgent;
    }

    /**
     * Set bilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     *
     * @return RemunerationAgent
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
     * Set refStatut
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $refStatut
     *
     * @return RemunerationAgent
     */
    public function setRefStatut(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut $refStatut = null)
    {
        $this->refStatut = $refStatut;

        return $this;
    }

    /**
     * Get refStatut
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut
     */
    public function getRefStatut()
    {
        return $this->refStatut;
    }

    /**
     * Set refEmploiNonPermanent
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent
     *
     * @return RemunerationAgent
     */
    public function setRefEmploiNonPermanent(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent = null)
    {
        $this->refEmploiNonPermanent = $refEmploiNonPermanent;

        return $this;
    }

    /**
     * Get refEmploiNonPermanent
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    public function getRefEmploiNonPermanent()
    {
        return $this->refEmploiNonPermanent;
    }

    /**
     * Set refCategorie
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie
     *
     * @return RemunerationAgent
     */
    public function setRefCategorie(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie = null)
    {
        $this->refCategorie = $refCategorie;

        return $this;
    }

    /**
     * Get refCategorie
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie
     */
    public function getRefCategorie()
    {
        return $this->refCategorie;
    }

    /**
     * Set refFiliere
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
     *
     * @return RemunerationAgent
     */
    public function setRefFiliere(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere = null)
    {
        $this->refFiliere = $refFiliere;

        return $this;
    }

    /**
     * Get refFiliere
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getRefFiliere()
    {
        return $this->refFiliere;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdateDateValue()
    {
        // Add your code here
    }
}
