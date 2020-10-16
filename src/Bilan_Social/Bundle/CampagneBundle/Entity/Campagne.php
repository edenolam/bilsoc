<?php

namespace Bilan_Social\Bundle\CampagneBundle\Entity;

/**
 * Campagne
 */
class Campagne
{
    private $lbCamp;

    private $nmAnne;

    private $dtDebu;

    private $dtClot;

    private $fgStat;

    private $dtCrea;

    private $cdUtilcrea;

    private $dtModi;

    private $cdUtilmodi;

    private $idCamp;
    
    private $blImport;

    private $modeleAnalyse;
  
    private $enquetes;

    private $users;

    public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getBlImport(){
        return $this->blImport;
    }
    
    public function setBlImport($blImport){
        $this->blImport = $blImport;
        return $this;
    }


    /**
     * Set lbCamp
     *
     * @param string $lbCamp
     *
     * @return Campagne
     */
    public function setLbCamp($lbCamp)
    {
        $this->lbCamp = $lbCamp;

        return $this;
    }

    /**
     * Get lbCamp
     *
     * @return string
     */
    public function getLbCamp()
    {
        return $this->lbCamp;
    }

    /**
     * Set nmAnne
     *
     * @param integer $nmAnne
     *
     * @return Campagne
     */
    public function setNmAnne($nmAnne)
    {
        $this->nmAnne = $nmAnne;

        return $this;
    }

    /**
     * Get nmAnne
     *
     * @return integer
     */
    public function getNmAnne()
    {
        return $this->nmAnne;
    }

    /**
     * Set dtDebu
     *
     * @param \DateTime $dtDebu
     *
     * @return Campagne
     */
    public function setDtDebu($dtDebu)
    {
        $this->dtDebu = $dtDebu;

        return $this;
    }

    /**
     * Get dtDebu
     *
     * @return \DateTime
     */
    public function getDtDebu()
    {
        return $this->dtDebu;
    }

    /**
     * Set dtClot
     *
     * @param \DateTime $dtClot
     *
     * @return Campagne
     */
    public function setDtClot($dtClot)
    {
        $this->dtClot = $dtClot;

        return $this;
    }

    /**
     * Get dtClot
     *
     * @return \DateTime
     */
    public function getDtClot()
    {
        return $this->dtClot;
    }

    /**
     * Set fgStat
     *
     * @param string $fgStat
     *
     * @return Campagne
     */
    public function setFgStat($fgStat)
    {
        $this->fgStat = $fgStat;

        return $this;
    }

    /**
     * Get fgStat
     *
     * @return string
     */
    public function getFgStat()
    {
        return $this->fgStat;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return Campagne
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
     * @return Campagne
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
     * @return Campagne
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
     * @return Campagne
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
     * Get idCamp
     *
     * @return integer
     */
    public function getIdCamp()
    {
        return $this->idCamp;
    }

    function getModeleAnalyse() {
        return $this->modeleAnalyse;
    }

    function setModeleAnalyse($modeleAnalyse) {
        
        $this->modeleAnalyse = $modeleAnalyse;
    }

    function getEnquetes() {
        return $this->enquetes;
    }

    function setEnquetes($enquetes) {
        
        $this->enquetes = $enquetes;
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function setUsers($users)
    {
        $this->users = $users;

        return $this;
    }
}

