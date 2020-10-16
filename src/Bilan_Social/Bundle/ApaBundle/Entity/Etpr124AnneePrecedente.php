<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Etpr124AnneePrecedente
 */
class Etpr124AnneePrecedente
{
//    /**
//     * @var integer
//     */
//    private $r1241;
//
//    /**
//     * @var integer
//     */
//    private $r1242;

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
    private $id124;

//    /**
//     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere
//     */
//    private $RefFiliere;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;


//    /**
//     * Set r1241
//     *
//     * @param integer $r1241
//     *
//     * @return Etpr124AnneePrecedente
//     */
//    public function setR1241($r1241)
//    {
//        $this->r1241 = $r1241;
//
//        return $this;
//    }
//
//    /**
//     * Get r1241
//     *
//     * @return integer
//     */
//    public function getR1241()
//    {
//        return $this->r1241;
//    }
//
//    /**
//     * Set r1242
//     *
//     * @param integer $r1242
//     *
//     * @return Etpr124AnneePrecedente
//     */
//    public function setR1242($r1242)
//    {
//        $this->r1242 = $r1242;
//
//        return $this;
//    }
//
//    /**
//     * Get r1242
//     *
//     * @return integer
//     */
//    public function getR1242()
//    {
//        return $this->r1242;
//    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Etpr124AnneePrecedente
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
     * @return Etpr124AnneePrecedente
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
     * @return Etpr124AnneePrecedente
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
     * @return Etpr124AnneePrecedente
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
     * Get id124
     *
     * @return integer
     */
    public function getId124()
    {
        return $this->id124;
    }

//    /**
//     * Set refFiliere
//     *
//     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere $refFiliere
//     *
//     * @return Etpr124AnneePrecedente
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

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return Etpr124AnneePrecedente
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
