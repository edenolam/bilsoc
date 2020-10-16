<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * ActionPrevention
 */
class ActionPrevention
{
    /**
     * @var integer
     */
//    private $idForm;
    
    /**
     * @var string
     */
    private $nbAgent;
    /**
     * @var string
     */
    private $r5121;

    /**
     * @var integer
     */
    private $r5122;

    /**
     * @var string
     */
    private $r5123;

    /**
     * @var integer
     */
    private $r5124;

    /**
     * @var string
     */
    private $r5125;

    /**
     * @var integer
     */
    private $r5126;

    /**
     * @var string
     */
    private $r5127;

    /**
     * @var string
     */
    private $r5128;

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
    private $idActiprev;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $collectivite;
     /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention
     */
    private $refActionPreventions;


    /**
     * Set idForm
     *
     * @param integer $idForm
     *
     * @return ActionPrevention
     */
    public function setIdForm($idForm)
    {
        $this->idForm = $idForm;

        return $this;
    }

    /**
     * Get idForm
     *
     * @return integer
     */
    public function getIdForm()
    {
        return $this->idForm;
    }

    /**
     * Set r5121
     *
     * @param string $r5121
     *
     * @return ActionPrevention
     */
    public function setR5121($r5121)
    {
        $this->r5121 = $r5121;

        return $this;
    }

    /**
     * Get r5121
     *
     * @return string
     */
    public function getR5121()
    {
        return $this->r5121;
    }

    /**
     * Set r5122
     *
     * @param integer $r5122
     *
     * @return ActionPrevention
     */
    public function setR5122($r5122)
    {
        $this->r5122 = $r5122;

        return $this;
    }

    /**
     * Get r5122
     *
     * @return integer
     */
    public function getR5122()
    {
        return $this->r5122;
    }

    /**
     * Set r5123
     *
     * @param string $r5123
     *
     * @return ActionPrevention
     */
    public function setR5123($r5123)
    {
        $this->r5123 = $r5123;

        return $this;
    }

    /**
     * Get r5123
     *
     * @return string
     */
    public function getR5123()
    {
        return $this->r5123;
    }

    /**
     * Set r5124
     *
     * @param integer $r5124
     *
     * @return ActionPrevention
     */
    public function setR5124($r5124)
    {
        $this->r5124 = $r5124;

        return $this;
    }

    /**
     * Get r5124
     *
     * @return integer
     */
    public function getR5124()
    {
        return $this->r5124;
    }

    /**
     * Set r5125
     *
     * @param string $r5125
     *
     * @return ActionPrevention
     */
    public function setR5125($r5125)
    {
        $this->r5125 = $r5125;

        return $this;
    }

    /**
     * Get r5125
     *
     * @return string
     */
    public function getR5125()
    {
        return $this->r5125;
    }

    /**
     * Set r5126
     *
     * @param integer $r5126
     *
     * @return ActionPrevention
     */
    public function setR5126($r5126)
    {
        $this->r5126 = $r5126;

        return $this;
    }

    /**
     * Get r5126
     *
     * @return integer
     */
    public function getR5126()
    {
        return $this->r5126;
    }

    /**
     * Set r5127
     *
     * @param string $r5127
     *
     * @return ActionPrevention
     */
    public function setR5127($r5127)
    {
        $this->r5127 = $r5127;

        return $this;
    }

    /**
     * Get r5127
     *
     * @return string
     */
    public function getR5127()
    {
        return $this->r5127;
    }

    /**
     * Set r5128
     *
     * @param string $r5128
     *
     * @return ActionPrevention
     */
    public function setR5128($r5128)
    {
        $this->r5128 = $r5128;

        return $this;
    }

    /**
     * Get r5128
     *
     * @return string
     */
    public function getR5128()
    {
        return $this->r5128;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ActionPrevention
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
     * @return ActionPrevention
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
     * @return ActionPrevention
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
     * @return ActionPrevention
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
     * Get idActiprev
     *
     * @return integer
     */
    public function getIdActiprev()
    {
        return $this->idActiprev;
    }

    /**
     * Set collectivite
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $collectivite
     *
     * @return ActionPrevention
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
    
    
    function getRefActionPreventions() {
        return $this->refActionPreventions;
    }

    function setRefActionPreventions(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention $refActionPreventions = null) {
        $this->refActionPreventions = $refActionPreventions;
    }
    function getNbAgent() {
        return $this->nbAgent;
    }

    function setNbAgent($nbAgent) {
        $this->nbAgent = $nbAgent;
    }




}
