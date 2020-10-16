<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Etpr114AnneePrecedente
 */
class Etpr114AnneePrecedente
{
    /**
     * @var Infocollagen
     */
    private $idInfocollagen;

//    /**
//     * @var string
//     */
//    private $r1141;
//
//    /**
//     * @var string
//     */
//    private $r1142;

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
    private $idEtpr114;

//    /**
//     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
//     */
//    private $RefFiliere;


//    /**
//     * Set idInfocollagen
//     *
//     * @param integer $idInfocollagen
//     *
//     * @return Etpr114AnneePrecedente
//     */
//    public function setIdInfocollagen($idInfocollagen)
//    {
//        $this->idInfocollagen = $idInfocollagen;
//
//        return $this;
//    }
//
//    /**
//     * Get idInfocollagen
//     *
//     * @return integer
//     */
//    public function getIdInfocollagen()
//    {
//        return $this->idInfocollagen;
//    }

//    /**
//     * Set r1141
//     *
//     * @param string $r1141
//     *
//     * @return Etpr114AnneePrecedente
//     */
//    public function setR1141($r1141)
//    {
//        $this->r1141 = $r1141;
//
//        return $this;
//    }
//
//    /**
//     * Get r1141
//     *
//     * @return string
//     */
//    public function getR1141()
//    {
//        return $this->r1141;
//    }
//
//    /**
//     * Set r1142
//     *
//     * @param string $r1142
//     *
//     * @return Etpr114AnneePrecedente
//     */
//    public function setR1142($r1142)
//    {
//        $this->r1142 = $r1142;
//
//        return $this;
//    }
//
//    /**
//     * Get r1142
//     *
//     * @return string
//     */
//    public function getR1142()
//    {
//        return $this->r1142;
//    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Etpr114AnneePrecedente
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
     * @return Etpr114AnneePrecedente
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
     * @return Etpr114AnneePrecedente
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

//    /**
//     * Set cdUtilmodi
//     *
//     * @param string $cdUtilmodi
//     *
//     * @return Etpr114AnneePrecedente
//     */
//    public function setCdUtilmodi($cdUtilmodi)
//    {
//        $this->cdUtilmodi = $cdUtilmodi;
//
//        return $this;
//    }
//
//    /**
//     * Get cdUtilmodi
//     *
//     * @return string
//     */
//    public function getCdUtilmodi()
//    {
//        return $this->cdUtilmodi;
//    }

    /**
     * Get idEtpr114
     *
     * @return integer
     */
    public function getIdEtpr114()
    {
        return $this->idEtpr114;
    }

//    /**
//     * Set refFiliere
//     *
//     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
//     *
//     * @return Etpr114AnneePrecedente
//     */
//    public function setRefFiliere(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere = null)
//    {
//        $this->RefFiliere = $refFiliere;
//
//        return $this;
//    }
//
//    /**
//     * Get refFiliere
//     *
//     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
//     */
//    public function getRefFiliere()
//    {
//        return $this->RefFiliere;
//    }
}
