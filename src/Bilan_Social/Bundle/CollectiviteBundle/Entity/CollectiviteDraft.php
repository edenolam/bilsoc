<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

use Bilan_Social\Bundle\CollectiviteBundle\Repository\CollectiviteRepository;

/**
 * CollectiviteDraft
 */
class CollectiviteDraft
{
    /**
     * @var integer
     */
    private $refTypeCollectivite;

    /**
     * @var string
     */
    private $lbColl;

    /**
     * @var string
     */
    private $cdPost;

    /**
     * @var string
     */
    private $lbVill;

    /**
     * @var integer
     */
    private $departement;
    
    /**
     * @var string
     */
    private $nmSire;
    
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
    private $idCollDraft;
    private $collectivite;

    /**
     * @var boolean
     */
    private $cdg_is_authorized_by_collectivity;


    function getRefTypeCollectivite() {
        return $this->refTypeCollectivite;
    }

    function setRefTypeCollectivite($refTypeCollectivite) {
        $this->refTypeCollectivite = $refTypeCollectivite;
    }

    function getCollectivite() {
        return $this->collectivite;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }

    /**
     * Set lbColl
     *
     * @param string $lbColl
     *
     * @return CollectiviteDraft
     */
    public function setLbColl($lbColl)
    {
        $this->lbColl = $lbColl;

        return $this;
    }

    /**
     * Get lbColl
     *
     * @return string
     */
    public function getLbColl()
    {
        return $this->lbColl;
    }

    /**
     * Set cdPost
     *
     * @param string $cdPost
     *
     * @return CollectiviteDraft
     */
    public function setCdPost($cdPost)
    {
        $this->cdPost = $cdPost;

        return $this;
    }

    /**
     * Get cdPost
     *
     * @return string
     */
    public function getCdPost()
    {
        return $this->cdPost;
    }
    
    /**
     * Set lbVill
     *
     * @param string $lbVill
     *
     * @return CollectiviteDraft
     */
    public function setLbVill($lbVill)
    {
        $this->lbVill = $lbVill;

        return $this;
    }

    /**
     * Get lbVill
     *
     * @return string
     */
    public function getLbVill()
    {
        return $this->lbVill;
    }

    /**
     * Set nmSire
     *
     * @param string $nmSire
     *
     * @return CollectiviteDraft
     */
    public function setNmSire($nmSire)
    {
        $this->nmSire = $nmSire;

        return $this;
    }

    /**
     * Get nmSire
     *
     * @return string
     */
    public function getNmSire()
    {
        return $this->nmSire;
    }
    
    function getDepartement() {
        return $this->departement;
    }

    function setDepartement($departement) {
        $this->departement = $departement;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return CollectiviteDraft
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
     * @return CollectiviteDraft
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
     * @return CollectiviteDraft
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
     * @return CollectiviteDraft
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
     * Get idCollDraft
     *
     * @return integer
     */
    public function getIdCollDraft()
    {
        return $this->idCollDraft;
    }
}
