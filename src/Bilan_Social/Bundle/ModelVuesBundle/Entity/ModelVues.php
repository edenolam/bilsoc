<?php

namespace Bilan_Social\Bundle\ModelVuesBundle\Entity;

class ModelVues{
    /**
     * @var int
     */
    private $idModelVues;

    /**
     * @var string
     */
    private $cdModelVues;
    
    private $blNom;
    
    private $blTele;
    /**
     * @var bool
     */
    private $blTypeColl;
    
    /**
     * @var bool
     */
    private $blLbAdresse;

    /**
     * @var bool
     */
    private $blLibe;

    /**
     * @var bool
     */
    private $blSire;

    /**
     * @var bool
     */
    private $blAffiCdg;

    /**
     * @var boolean
     */
    private $blDepa;
    /**
     * @var boolean
     */
    private $blCdPost;
    /**
     * @var boolean
     */
    private $blLbVill;
    /**
     * @var boolean
     */
    private $blCdInse;
    /**
     * @var boolean
     */
    private $blNmPopuInse;
    /**
     * @var boolean
     */
    private $blSurclasDemo;
    /**
     * @var boolean
     */
    private $blNmStratColl;
    /**
     * @var boolean
     */
    private $blCtCdg;
    /**
     * @var boolean
     */
    private $blChsct;
    /**
     * @var boolean
     */
    private $blCollDgcl;
    /**
     * @var boolean
     */
    private $cdg_is_authorized_by_collectivity ;
    /**
     * @var boolean
     */
    private $blBilaSoci;
    /**
     * @var boolean
     */
    private $fgStat;

    /**
     * @var boolean
     */
    private $blRass;
    /**
     * @var boolean
     */
    private $blHand;
    /**
     * @var boolean
     */
    private $blGpee;
    /**
     * @var boolean
     */
    private $blGpeecPlus;

    /**
     * @var boolean
     */
    private $blApa;
    /**
     * @var boolean
     */
    private $blCons;
    /**
     * @var boolean
     */
    private $blN4ds;
    /**
     * @var boolean
     */
    private $blBaseCarr;
    /**
     * @var boolean
     */
    private $blBilaSociVide;
    /**
     * @var boolean
     */
    private $blCourtier;

    /**
     * @return bool
     */
    public function getBlCourtier()
    {
        return $this->blCourtier;
    }

    /**
     * @param bool $blCourtier
     */
    public function setBlCourtier($blCourtier)
    {
        $this->blCourtier = $blCourtier;
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getIdModelVues()
    {
        return $this->idModelVues;
    }
    
    /**
     * Set cdModelVues
     *
     * @param string $cdModelVues
     *
     * @return ModelVues
     */
    public function setCdModelVues($cdModelVues)
    {
        $this->cdModelVues = $cdModelVues;

        return $this;
    }

    /**
     * Get cdModelVues
     *
     * @return string
     */
    public function getCdModelVues()
    {
        return $this->cdModelVues;
    }
    
    /**
     * Set blTypeColl
     *
     * @param boolean $blTypeColl
     *
     * @return ModelVues
     */
    public function setBlTypeColl($blTypeColl)
    {
        $this->blTypeColl = $blTypeColl;

        return $this;
    }

    /**
     * Get blDepa
     *
     * @return boolean
     */
    public function getBlTypeColl()
    {
        return $this->blTypeColl;
    }
    
    /**
     * Set blLibe
     *
     * @param boolean $blLibe
     *
     * @return ModelVues
     */
    public function setBlLibe($blLibe)
    {
        $this->blLibe = $blLibe;

        return $this;
    }

    /**
     * Get blLibe
     *
     * @return boolean
     */
    public function getBlLibe()
    {
        return $this->blLibe;
    }
    
    /**
     * Set blSire
     *
     * @param boolean $blSire
     *
     * @return ModelVues
     */
    public function setBlSire($blSire)
    {
        $this->blSire = $blSire;

        return $this;
    }

    /**
     * Get blSire
     *
     * @return boolean
     */
    public function getBlSire()
    {
        return $this->blSire;
    }
    
    /**
     * Set blAffiCdg
     *
     * @param boolean $blAffiCdg
     *
     * @return ModelVues
     */
    public function setBlAffiCdg($blAffiCdg)
    {
        $this->blAffiCdg = $blAffiCdg;

        return $this;
    }

    /**
     * Get blAffiCdg
     *
     * @return boolean
     */
    public function getBlAffiCdg()
    {
        return $this->blAffiCdg;
    }
    
    /**
     * Set blDepa
     *
     * @param boolean $blDepa
     *
     * @return ModelVues
     */
    public function setBlDepa($blDepa)
    {
        $this->blDepa = $blDepa;

        return $this;
    }

    /**
     * Get blDepa
     *
     * @return boolean
     */
    public function getBlDepa()
    {
        return $this->blDepa;
    }
    
    /**
     * Set blCdPost
     *
     * @param boolean $blCdPost
     *
     * @return ModelVues
     */
    public function setBlCdPost($blCdPost)
    {
        $this->blCdPost = $blCdPost;

        return $this;
    }

    /**
     * Get blCdPost
     *
     * @return boolean
     */
    public function getBlCdPost()
    {
        return $this->blCdPost;
    }
    
    /**
     * Set blLbVill
     *
     * @param boolean $blLbVill
     *
     * @return ModelVues
     */
    public function setBlLbVill($blLbVill)
    {
        $this->blLbVill = $blLbVill;

        return $this;
    }

    /**
     * Get blLbVill
     *
     * @return boolean
     */
    public function getBlLbVill()
    {
        return $this->blLbVill;
    }
    
    /**
     * Set blCdInse
     *
     * @param boolean $blCdInse
     *
     * @return ModelVues
     */
    public function setBlCdInse($blCdInse)
    {
        $this->blCdInse = $blCdInse;

        return $this;
    }

    /**
     * Get blCdInse
     *
     * @return boolean
     */
    public function getBlCdInse()
    {
        return $this->blCdInse;
    }
    
    /**
     * Set blNmPopuInse
     *
     * @param boolean $blNmPopuInse
     *
     * @return ModelVues
     */
    public function setBlNmPopuInse($blNmPopuInse)
    {
        $this->blNmPopuInse = $blNmPopuInse;

        return $this;
    }

    /**
     * Get blNmPopuInse
     *
     * @return boolean
     */
    public function getBlNmPopuInse()
    {
        return $this->blNmPopuInse;
    }
    
    /**
     * Set blSurclasDemo
     *
     * @param boolean $blSurclasDemo
     *
     * @return ModelVues
     */
    public function setBlSurclasDemo($blSurclasDemo)
    {
        $this->blSurclasDemo = $blSurclasDemo;

        return $this;
    }

    /**
     * Get blSurclasDemo
     *
     * @return boolean
     */
    public function getBlSurclasDemo()
    {
        return $this->blSurclasDemo;
    }
    
    /**
     * Set blNmStratColl
     *
     * @param boolean $blNmStratColl
     *
     * @return ModelVues
     */
    public function setBlNmStratColl($blNmStratColl)
    {
        $this->blNmStratColl = $blNmStratColl;

        return $this;
    }

    /**
     * Get blNmStratColl
     *
     * @return boolean
     */
    public function getBlNmStratColl()
    {
        return $this->blNmStratColl;
    }
    
    /**
     * Set blCtCdg
     *
     * @param boolean $blCtCdg
     *
     * @return ModelVues
     */
    public function setBlCtCdg($blCtCdg)
    {
        $this->blCtCdg = $blCtCdg;

        return $this;
    }

    /**
     * Get blCtCdg
     *
     * @return boolean
     */
    public function getBlCtCdg()
    {
        return $this->blCtCdg;
    }
    
    /**
     * Set blChsct
     *
     * @param boolean $blChsct
     *
     * @return ModelVues
     */
    public function setBlChsct($blChsct)
    {
        $this->blChsct = $blChsct;

        return $this;
    }

    /**
     * Get blChsct
     *
     * @return boolean
     */
    public function getBlChsct()
    {
        return $this->blChsct;
    }
    
    /**
     * Set blCollDgcl
     *
     * @param boolean $blCollDgcl
     *
     * @return ModelVues
     */
    public function setBlCollDgcl($blCollDgcl)
    {
        $this->blCollDgcl = $blCollDgcl;

        return $this;
    }

    /**
     * Get blCollDgcl
     *
     * @return boolean
     */
    public function getBlCollDgcl()
    {
        return $this->blCollDgcl;
    }
    
    function getCdgIsAuthorizedByCollectivity() {
        return $this->cdg_is_authorized_by_collectivity;
    }

    function setCdgIsAuthorizedByCollectivity($cdg_is_authorized_by_collectivity) {
        $this->cdg_is_authorized_by_collectivity = $cdg_is_authorized_by_collectivity;
    }

        
    /**
     * Set blBilaSoci
     *
     * @param boolean $blBilaSoci
     *
     * @return ModelVues
     */
    public function setBlBilaSoci($blBilaSoci)
    {
        $this->blBilaSoci = $blBilaSoci;

        return $this;
    }

    /**
     * Get blBilaSoci
     *
     * @return boolean
     */
    public function getBlBilaSoci()
    {
        return $this->blBilaSoci;
    }
    
    /**
     * Set blRass
     *
     * @param boolean $blRass
     *
     * @return ModelVues
     */
    public function setBlRass($blRass)
    {
        $this->blRass = $blRass;

        return $this;
    }

    /**
     * Get blRass
     *
     * @return boolean
     */
    public function getBlRass()
    {
        return $this->blRass;
    }
    
    /**
     * Set blHand
     *
     * @param boolean $blHand
     *
     * @return ModelVues
     */
    public function setBlHand($blHand)
    {
        $this->blHand = $blHand;

        return $this;
    }

    /**
     * Get blHand
     *
     * @return boolean
     */
    public function getBlHand()
    {
        return $this->blHand;
    }
    
    /**
     * Set blGpee
     *
     * @param boolean $blGpee
     *
     * @return ModelVues
     */
    public function setBlGpee($blGpee)
    {
        $this->blGpee = $blGpee;

        return $this;
    }

    /**
     * Get blGpee
     *
     * @return boolean
     */
    public function getBlGpee()
    {
        return $this->blGpee;
    }
    
    /**
     * Get blGpeecPlus
     *
     * @return boolean
     */
    public function getBlGpeecPlus() {
        return $this->blGpeecPlus;
    }

    /**
     * Set blGpeecPlus
     *
     * @param boolean $blGpeecPlus
     *
     * @return ModelVues
     */
    public function setBlGpeecPlus($blGpeecPlus) {
        $this->blGpeecPlus = $blGpeecPlus;

        return $this;
    }

    /**
     * Set blApa
     *
     * @param boolean $blApa
     *
     * @return ModelVues
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
     * @return ModelVues
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
     * Set blN4ds
     *
     * @param boolean $blN4ds
     *
     * @return ModelVues
     */
    public function setBlN4ds($blN4ds)
    {
        $this->blN4ds = $blN4ds;

        return $this;
    }

    /**
     * Get blN4ds
     *
     * @return boolean
     */
    public function getBlN4ds()
    {
        return $this->blN4ds;
    }
    
    /**
     * Set blBaseCarr
     *
     * @param boolean $blBaseCarr
     *
     * @return ModelVues
     */
    public function setBlBaseCarr($blBaseCarr)
    {
        $this->blBaseCarr = $blBaseCarr;

        return $this;
    }

    /**
     * Get blBaseCarr
     *
     * @return boolean
     */
    public function getBlBaseCarr()
    {
        return $this->blBaseCarr;
    }
    
    /**
     * Set blBilaSociVide
     *
     * @param boolean $blBilaSociVide
     *
     * @return ModelVues
     */
    public function setBlBilaSociVide($blBilaSociVide)
    {
        $this->blBilaSociVide = $blBilaSociVide;

        return $this;
    }

    /**
     * Get blBilaSociVide
     *
     * @return boolean
     */
    public function getBlBilaSociVide()
    {
        return $this->blBilaSociVide;
    }
    
    function getBlLbAdresse() {
        return $this->blLbAdresse;
    }

    function setBlLbAdresse($blLbAdresse) {
        $this->blLbAdresse = $blLbAdresse;
    }
    
    function getFgStat() {
        return $this->fgStat;
    }

    function setFgStat($fgStat) {
        $this->fgStat = $fgStat;
    }
    function getBlNom() {
        return $this->blNom;
    }

    function getBlTele() {
        return $this->blTele;
    }

    function setBlNom($blNom) {
        $this->blNom = $blNom;
    }

    function setBlTele($blTele) {
        $this->blTele = $blTele;
    }



}
