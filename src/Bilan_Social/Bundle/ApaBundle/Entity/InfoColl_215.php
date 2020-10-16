<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * InfoColl_215
 */
class InfoColl_215
{
    /**
     * @var integer
     */
    private $r2151;

    /**
     * @var integer
     */
    private $r2152;

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
    private $idInfoColl_215;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;


    private $refCategorie;

    /**
     * Set r2151
     *
     * @param integer $r2151
     *
     * @return InfoColl_215
     */
    public function setR2151($r2151)
    {
        $this->r2151 = $r2151;

        return $this;
    }

    /**
     * Get r2151
     *
     * @return integer
     */
    public function getR2151()
    {
        return $this->r2151;
    }

    /**
     * Set r2152
     *
     * @param integer $r2152
     *
     * @return InfoColl_215
     */
    public function setR2152($r2152)
    {
        $this->r2152 = $r2152;

        return $this;
    }

    /**
     * Get r2152
     *
     * @return integer
     */
    public function getR2152()
    {
        return $this->r2152;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return InfoColl_215
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
     * @return InfoColl_215
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
     * @return InfoColl_215
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
     * @return InfoColl_215
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
     * Get idInfoColl215
     *
     * @return integer
     */
    public function getIdInfoColl215()
    {
        return $this->idInfoColl_215;
    }

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return InfoColl_215
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

