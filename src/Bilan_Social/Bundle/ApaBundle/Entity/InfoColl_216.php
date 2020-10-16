<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * InfoColl_216
 */
class InfoColl_216
{
    /**
     * @var integer
     */
    private $r2161;

    /**
     * @var integer
     */
    private $r2162;

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
    private $idInfoColl_216;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;


    private $refCategorie;

    /**
     * Set r2161
     *
     * @param integer $r2161
     *
     * @return InfoColl_216
     */
    public function setR2161($r2161)
    {
        $this->r2161 = $r2161;

        return $this;
    }

    /**
     * Get r2161
     *
     * @return integer
     */
    public function getR2161()
    {
        return $this->r2161;
    }

    /**
     * Set r2162
     *
     * @param integer $r2162
     *
     * @return InfoColl_216
     */
    public function setR2162($r2162)
    {
        $this->r2162 = $r2162;

        return $this;
    }

    /**
     * Get r2162
     *
     * @return integer
     */
    public function getR2162()
    {
        return $this->r2162;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return InfoColl_216
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
     * @return InfoColl_216
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
     * @return InfoColl_216
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
     * @return InfoColl_216
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
     * Get idInfoColl216
     *
     * @return integer
     */
    public function getIdInfoColl216()
    {
        return $this->idInfoColl_216;
    }

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return InfoColl_216
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

