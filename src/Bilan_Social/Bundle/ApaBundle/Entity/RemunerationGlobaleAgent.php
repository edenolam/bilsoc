<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RemunerationGlobaleAgent
 */
class RemunerationGlobaleAgent
{
    /**
     * @var integer
     */
    private $mtTotalHeurePayees;

    /**
     * @var integer
     */
    private $mtTotalRemunerationBrute;

    /**
     * @var integer
     */
    private $mtRemunerationArticle111;

    /**
     * @var integer
     */
    private $mtRemunerationArticle88;

    /**
     * @var integer
     */
    private $mtTotalRemunerationAnnuelleBruteHeuresSupp;

    /**
     * @var integer
     */
    private $mtTotalRemunerationAnnuelleBruteNBI;

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
    private $idRemunerationGlobaleAgent;

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
     * Set mtTotalHeurePayees
     *
     * @param integer $mtTotalHeurePayees
     * @return RemunerationGlobaleAgent
     */
    public function setMtTotalHeurePayees($mtTotalHeurePayees)
    {
        $this->mtTotalHeurePayees = $mtTotalHeurePayees;

        return $this;
    }

    /**
     * Get mtTotalHeurePayees
     *
     * @return integer 
     */
    public function getMtTotalHeurePayees()
    {
        return $this->mtTotalHeurePayees;
    }

    /**
     * Set mtTotalRemunerationBrute
     *
     * @param integer $mtTotalRemunerationBrute
     * @return RemunerationGlobaleAgent
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
     * Set mtRemunerationArticle111
     *
     * @param integer $mtRemunerationArticle111
     * @return RemunerationGlobaleAgent
     */
    public function setMtRemunerationArticle111($mtRemunerationArticle111)
    {
        $this->mtRemunerationArticle111 = $mtRemunerationArticle111;

        return $this;
    }

    /**
     * Get mtRemunerationArticle111
     *
     * @return integer 
     */
    public function getMtRemunerationArticle111()
    {
        return $this->mtRemunerationArticle111;
    }

    /**
     * Set mtRemunerationArticle88
     *
     * @param integer $mtRemunerationArticle88
     * @return RemunerationGlobaleAgent
     */
    public function setMtRemunerationArticle88($mtRemunerationArticle88)
    {
        $this->mtRemunerationArticle88 = $mtRemunerationArticle88;

        return $this;
    }

    /**
     * Get mtRemunerationArticle88
     *
     * @return integer 
     */
    public function getMtRemunerationArticle88()
    {
        return $this->mtRemunerationArticle88;
    }

    /**
     * Set mtTotalRemunerationAnnuelleBruteHeuresSupp
     *
     * @param integer $mtTotalRemunerationAnnuelleBruteHeuresSupp
     * @return RemunerationGlobaleAgent
     */
    public function setMtTotalRemunerationAnnuelleBruteHeuresSupp($mtTotalRemunerationAnnuelleBruteHeuresSupp)
    {
        $this->mtTotalRemunerationAnnuelleBruteHeuresSupp = $mtTotalRemunerationAnnuelleBruteHeuresSupp;

        return $this;
    }

    /**
     * Get mtTotalRemunerationAnnuelleBruteHeuresSupp
     *
     * @return integer 
     */
    public function getMtTotalRemunerationAnnuelleBruteHeuresSupp()
    {
        return $this->mtTotalRemunerationAnnuelleBruteHeuresSupp;
    }

    /**
     * Set mtTotalRemunerationAnnuelleBruteNBI
     *
     * @param integer $mtTotalRemunerationAnnuelleBruteNBI
     * @return RemunerationGlobaleAgent
     */
    public function setMtTotalRemunerationAnnuelleBruteNBI($mtTotalRemunerationAnnuelleBruteNBI)
    {
        $this->mtTotalRemunerationAnnuelleBruteNBI = $mtTotalRemunerationAnnuelleBruteNBI;

        return $this;
    }

    /**
     * Get mtTotalRemunerationAnnuelleBruteNBI
     *
     * @return integer 
     */
    public function getMtTotalRemunerationAnnuelleBruteNBI()
    {
        return $this->mtTotalRemunerationAnnuelleBruteNBI;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return RemunerationGlobaleAgent
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
     * @return RemunerationGlobaleAgent
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
     * @return RemunerationGlobaleAgent
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
     * @return RemunerationGlobaleAgent
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
     * Get idRemunerationGlobaleAgent
     *
     * @return integer 
     */
    public function getIdRemunerationGlobaleAgent()
    {
        return $this->idRemunerationGlobaleAgent;
    }

    /**
     * Set BilanSocialAgent
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent
     * @return RemunerationGlobaleAgent
     */
    public function setBilanSocialAgent(\Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $bilanSocialAgent = null)
    {
        $this->BilanSocialAgent = $bilanSocialAgent;

        return $this;
    }

    /**
     * Get BilanSocialAgent
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
     * @return RemunerationGlobaleAgent
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
     * Set refCategorie
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie $refCategorie
     * @return RemunerationGlobaleAgent
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

    /**
     * Set refFiliere
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
     *
     * @return EtprAgent
     */
    public function setRefFiliere(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere = null) {
        $this->refFiliere = $refFiliere;

        return $this;
    }

    /**
     * Get refFiliere
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
     */
    public function getRefFiliere() {
        return $this->refFiliere;
    }
}
