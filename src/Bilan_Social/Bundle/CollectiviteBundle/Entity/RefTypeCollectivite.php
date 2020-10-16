<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * RefTypeCollectivite
 */
class RefTypeCollectivite
{
    /**
     * @var string
     */
    private $cdTypecoll;

    /**
     * @var string
     */
    private $lbTypeColl;

    /**
     * @var boolean
     */
    private $blVali;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var integer
     */
    private $idTypeColl;


    /**
     * Set cdTypecoll
     *
     * @param string $cdTypecoll
     *
     * @return RefTypeCollectivite
     */
    public function setCdTypecoll($cdTypecoll)
    {
        $this->cdTypecoll = $cdTypecoll;

        return $this;
    }

    /**
     * Get cdTypecoll
     *
     * @return string
     */
    public function getCdTypecoll()
    {
        return $this->cdTypecoll;
    }

    /**
     * Set lbTypeColl
     *
     * @param string $lbTypeColl
     *
     * @return RefTypeCollectivite
     */
    public function setLbTypeColl($lbTypeColl)
    {
        $this->lbTypeColl = $lbTypeColl;

        return $this;
    }

    /**
     * Get lbTypeColl
     *
     * @return string
     */
    public function getLbTypeColl()
    {
        return $this->lbTypeColl;
    }

    /**
     * Set blVali
     *
     * @param boolean $blVali
     *
     * @return RefTypeCollectivite
     */
    public function setBlVali($blVali)
    {
        $this->blVali = $blVali;

        return $this;
    }

    /**
     * Get blVali
     *
     * @return boolean
     */
    public function getBlVali()
    {
        return $this->blVali;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefTypeCollectivite
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
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return RefTypeCollectivite
     */
    public function setDtCrea($dtCrea)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea()
    {
        return $this->dtCrea;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefTypeCollectivite
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
     * Set dtModi
     *
     * @param \DateTime $dtModi
     *
     * @return RefTypeCollectivite
     */
    public function setDtModi($dtModi)
    {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi()
    {
        return $this->dtModi;
    }

    /**
     * Get idTypeColl
     *
     * @return integer
     */
    public function getIdTypeColl()
    {
        return $this->idTypeColl;
    }
}

