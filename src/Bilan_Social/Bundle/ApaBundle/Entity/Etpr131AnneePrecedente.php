<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Etpr131AnneePrecedente
 */
class Etpr131AnneePrecedente
{
//    /**
//     * @var integer
//     */
//    private $r13121;
//
//    /**
//     * @var integer
//     */
//    private $r13122;

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
    private $id1312;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    private $RefEmploiNonPermanent;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;


//    /**
//     * Set r13121
//     *
//     * @param integer $r13121
//     *
//     * @return Etpr131AnneePrecedente
//     */
//    public function setR13121($r13121)
//    {
//        $this->r13121 = $r13121;
//
//        return $this;
//    }
//
//    /**
//     * Get r13121
//     *
//     * @return integer
//     */
//    public function getR13121()
//    {
//        return $this->r13121;
//    }
//
//    /**
//     * Set r13122
//     *
//     * @param integer $r13122
//     *
//     * @return Etpr131AnneePrecedente
//     */
//    public function setR13122($r13122)
//    {
//        $this->r13122 = $r13122;
//
//        return $this;
//    }
//
//    /**
//     * Get r13122
//     *
//     * @return integer
//     */
//    public function getR13122()
//    {
//        return $this->r13122;
//    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Etpr131AnneePrecedente
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
     * @return Etpr131AnneePrecedente
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
     * @return Etpr131AnneePrecedente
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
     * @return Etpr131AnneePrecedente
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
     * Get id1312
     *
     * @return integer
     */
    public function getId1312()
    {
        return $this->id1312;
    }

    /**
     * Set refEmploiNonPermanent
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent
     *
     * @return Etpr131AnneePrecedente
     */
    public function setRefEmploiNonPermanent(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent $refEmploiNonPermanent = null)
    {
        $this->RefEmploiNonPermanent = $refEmploiNonPermanent;

        return $this;
    }

    /**
     * Get refEmploiNonPermanent
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent
     */
    public function getRefEmploiNonPermanent()
    {
        return $this->RefEmploiNonPermanent;
    }

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return Etpr131AnneePrecedente
     */
    public function setIdInfocollagen(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen = null)
    {
        $this->idInfocollagen = $idInfocollagen;

        return $this;
    }

    /**
     * Get idInfocollagen
     *
     * @return \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    public function getIdInfocollagen()
    {
        return $this->idInfocollagen;
    }
}
