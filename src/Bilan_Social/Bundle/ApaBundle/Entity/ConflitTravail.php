<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * ConflitTravail
 */
class ConflitTravail
{
    /**
     * @var integer
     */
    private $r7131;

    /**
     * @var integer
     */
    private $r7132;

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
    private $idConftrav;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $collectivite;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifGreve
     */
    private $RefMotifGreve;


    /**
     * Set r7131
     *
     * @param integer $r7131
     *
     * @return ConflitTravail
     */
    public function setR7131($r7131)
    {
        $this->r7131 = $r7131;

        return $this;
    }

    /**
     * Get r7131
     *
     * @return integer
     */
    public function getR7131()
    {
        return $this->r7131;
    }

    /**
     * Set r7132
     *
     * @param integer $r7132
     *
     * @return ConflitTravail
     */
    public function setR7132($r7132)
    {
        $this->r7132 = $r7132;

        return $this;
    }

    /**
     * Get r7132
     *
     * @return integer
     */
    public function getR7132()
    {
        return $this->r7132;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ConflitTravail
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
     * @return ConflitTravail
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
     * @return ConflitTravail
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
     * @return ConflitTravail
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
     * Get idConftrav
     *
     * @return integer
     */
    public function getIdConftrav()
    {
        return $this->idConftrav;
    }

    /**
     * Set collectivite
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $collectivite
     *
     * @return ConflitTravail
     */
    public function setCollectivite(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $collectivite = null)
    {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    public function getCollectivite()
    {
        return $this->collectivite;
    }

    /**
     * Set refMotifGreve
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifGreve $refMotifGreve
     *
     * @return ConflitTravail
     */
    public function setRefMotifGreve(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifGreve $refMotifGreve = null)
    {
        $this->RefMotifGreve = $refMotifGreve;

        return $this;
    }

    /**
     * Get refMotifGreve
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifGreve
     */
    public function getRefMotifGreve()
    {
        return $this->RefMotifGreve;
    }
}
