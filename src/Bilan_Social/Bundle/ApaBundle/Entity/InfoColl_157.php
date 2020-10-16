<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * InfoColl_157
 */
class InfoColl_157
{
    /**
     * @var integer
     */
    private $r1571;

    /**
     * @var integer
     */
    private $r1572;

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
    private $idInfoColl_157;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;


    private $refCategorie;

    /**
     * Set r1571
     *
     * @param integer $r1571
     *
     * @return InfoColl_157
     */
    public function setR1571($r1571)
    {
        $this->r1571 = $r1571;

        return $this;
    }

    /**
     * Get r1571
     *
     * @return integer
     */
    public function getR1571()
    {
        return $this->r1571;
    }

    /**
     * Set r1572
     *
     * @param integer $r1572
     *
     * @return InfoColl_157
     */
    public function setR1572($r1572)
    {
        $this->r1572 = $r1572;

        return $this;
    }

    /**
     * Get r1572
     *
     * @return integer
     */
    public function getR1572()
    {
        return $this->r1572;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return InfoColl_157
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
     * @return InfoColl_157
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
     * @return InfoColl_157
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
     * @return InfoColl_157
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
     * Get idInfoColl157
     *
     * @return integer
     */
    public function getIdInfoColl157()
    {
        return $this->idInfoColl_157;
    }

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return InfoColl_157
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

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

}

