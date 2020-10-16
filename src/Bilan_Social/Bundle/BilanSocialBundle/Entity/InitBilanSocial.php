<?php

namespace Bilan_Social\Bundle\BilanSocialBundle\Entity;
use Bilan_Social\Bundle\EnqueteBundle\Entity\EnqueteCollectivite;

/**
 * InitBilanSocial
 */
class InitBilanSocial
{
    public function __construct(EnqueteCollectivite $pEnquColl = null) {
        if ($pEnquColl != null) {
            // On initialise le S en fonction des options disponile pour la Coll/Enqu
            if (!$pEnquColl->getBlBilasocivide()) {
                $this->blDeclAgen = true;
            }
            if (!$pEnquColl->getBlBilasoci()) {
                $this->blBsExis = false;
            }
            if (!$pEnquColl->getBlCons()) {
                $this->blApa = true;            // Par défaut APA
            }
        }
    }

    private $collectivite;

    private $enquete;
    
    private $blLock;
    /**
     * @var boolean
     */
    private $blDeclAgen;

    /**
     * @var boolean
     */
    private $blBsExis;

    /**
     * @var boolean
     */
    private $blApa;

    /**
     * @var boolean
     */
    private $blCons;

    /**
     * @var string
     */
    private $initSource;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var integer
     */
    private $idInitBs;


    function getEnquete()
    {
        return $this->enquete;
    }

    function getCollectivite()
    {
        return $this->collectivite;
    }

    function setEnquete($enquete)
    {
        $this->enquete = $enquete;
    }

    function setCollectivite($collectivite)
    {
        $this->collectivite = $collectivite;
    }

    /**
     * Set blDeclAgen
     *
     * @param boolean $blDeclAgen
     *
     * @return InitBilanSocial
     */
    public function setBlDeclAgen($blDeclAgen)
    {
        $this->blDeclAgen = $blDeclAgen;

        return $this;
    }

    /**
     * Get blDeclAgen
     *
     * @return boolean
     */
    public function getBlDeclAgen()
    {
        return $this->blDeclAgen;
    }

    /**
     * Set blBsExis
     *
     * @param boolean $blBsExis
     *
     * @return InitBilanSocial
     */
    public function setBlBsExis($blBsExis)
    {
        $this->blBsExis = $blBsExis;

        return $this;
    }

    /**
     * Get blBsExis
     *
     * @return boolean
     */
    public function getBlBsExis()
    {
        return $this->blBsExis;
    }

    /**
     * Set blApa
     *
     * @param boolean $blApa
     *
     * @return InitBilanSocial
     */
    public function setBlApa($blApa)
    {
        $this->blApa = $blApa;

        return $this;
    }

    /**
     * Get blApa
     *
     * @return boolean
     */
    public function getBlApa()
    {
        return $this->blApa;
    }

    /**
     * Set blCons
     *
     * @param boolean $blCons
     *
     * @return InitBilanSocial
     */
    public function setBlCons($blCons)
    {
        $this->blCons = $blCons;

        return $this;
    }

    /**
     * Get blCons
     *
     * @return boolean
     */
    public function getBlCons()
    {
        return $this->blCons;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return InitBilanSocial
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
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return InitBilanSocial
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
     * Set dtModi
     *
     * @param \DateTime $dtModi
     *
     * @return InitBilanSocial
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
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return InitBilanSocial
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
     * Get idInitBs
     *
     * @return integer
     */
    public function getIdInitBs()
    {
        return $this->idInitBs;
    }

    /**
     * @return string
     */
    public function getInitSource()
    {
        return $this->initSource;
    }

    /**
     * @param string $initSource
     */
    public function setInitSource(string $initSource)
    {
        $this->initSource = $initSource;
    }
    function getBlLock() {
        return $this->blLock;
    }

    function setBlLock($blLock) {
        $this->blLock = $blLock;
    }




}

