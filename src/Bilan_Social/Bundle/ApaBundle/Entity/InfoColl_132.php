<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * InfoColl_132
 */
class InfoColl_132
{
    /**
     * @var integer
     */
    private $r1321;

    /**
     * @var integer
     */
    private $r1322;

    /**
     * @var integer
     */
    private $r1323;

    /**
     * @var integer
     */
    private $r1324;

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
    private $idInfoColl_132;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;

    private $refFiliere;

    /**
     * Set r1321
     *
     * @param integer $r1321
     *
     * @return InfoColl_132
     */
    public function setR1321($r1321)
    {
        $this->r1321 = $r1321;

        return $this;
    }

    /**
     * Get r1321
     *
     * @return integer
     */
    public function getR1321()
    {
        return $this->r1321;
    }

    /**
     * Set r1322
     *
     * @param integer $r1322
     *
     * @return InfoColl_132
     */
    public function setR1322($r1322)
    {
        $this->r1322 = $r1322;

        return $this;
    }

    /**
     * Get r1322
     *
     * @return integer
     */
    public function getR1322()
    {
        return $this->r1322;
    }

    /**
     * Set r1323
     *
     * @param integer $r1323
     *
     * @return InfoColl_132
     */
    public function setR1323($r1323)
    {
        $this->r1323 = $r1323;

        return $this;
    }

    /**
     * Get r1323
     *
     * @return integer
     */
    public function getR1323()
    {
        return $this->r1323;
    }

    /**
     * Set r1324
     *
     * @param integer $r1324
     *
     * @return InfoColl_132
     */
    public function setR1324($r1324)
    {
        $this->r1324 = $r1324;

        return $this;
    }

    /**
     * Get r1324
     *
     * @return integer
     */
    public function getR1324()
    {
        return $this->r1324;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return InfoColl_132
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
     * @return InfoColl_132
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
     * @return InfoColl_132
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
     * @return InfoColl_132
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
     * Get idInfoColl132
     *
     * @return integer
     */
    public function getIdInfoColl132()
    {
        return $this->idInfoColl_132;
    }

    /**
     * Set idInfocollagen
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen
     *
     * @return InfoColl_132
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

    /**
     * @return mixed
     */
    public function getRefFiliere()
    {
        return $this->refFiliere;
    }

    /**
     * @param mixed $refFiliere
     */
    public function setRefFiliere($refFiliere)
    {
        $this->refFiliere = $refFiliere;
    }

}

