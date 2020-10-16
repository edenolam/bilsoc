<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Entity;

/**
 * EnqueteCollectivite
 */
class EnqueteCollectivite
{

    private $enquete;


    private $collectivite;

    /**
     * @var boolean
     */
    private $blBilasocivide;

    /**
     * @var boolean
     */
    private $blBilasoci;

    /**
     * @var boolean
     */
    private $blRast;

    /**
     * @var boolean
     */
    private $blHand;

    /**
     * @var boolean
     */
    private $blGepe;

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
    private $blBasecarr;

    /**
     * @var boolean
     */
    private $blDgcl;

    /**
     * @var integer
     */
    private $idEnqucoll;

    /**
     * Set blBilasocivide
     *
     * @param boolean $blBilasocivide
     *
     * @return EnqueteCollectivite
     */
    public function setBlBilasocivide($blBilasocivide)
    {
        $this->blBilasocivide = $blBilasocivide;

        return $this;
    }

    /**
     * Get blBilasocivide
     *
     * @return boolean
     */
    public function getBlBilasocivide()
    {
        return $this->blBilasocivide;
    }

    /**
     * Set blbilasoci
     *
     * @param boolean $blbilasoci
     *
     * @return EnqueteCollectivite
     */
    public function setBlBilasoci($blBilasoci)
    {
        $this->blBilasoci = $blBilasoci;

        return $this;
    }

    /**
     * Get blbilasoci
     *
     * @return boolean
     */
    public function getBlBilasoci()
    {
        return $this->blBilasoci;
    }

    /**
     * Set blRast
     *
     * @param boolean $blRast
     *
     * @return EnqueteCollectivite
     */
    public function setBlRast($blRast)
    {
        $this->blRast = $blRast;

        return $this;
    }

    /**
     * Get blRast
     *
     * @return boolean
     */
    public function getBlRast()
    {
        return $this->blRast;
    }

    /**
     * Set blHand
     *
     * @param boolean $blHand
     *
     * @return EnqueteCollectivite
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
     * Set blGepe
     *
     * @param boolean $blGepe
     *
     * @return EnqueteCollectivite
     */
    public function setBlGepe($blGepe)
    {
        $this->blGepe = $blGepe;

        return $this;
    }

    /**
     * Get blGepe
     *
     * @return boolean
     */
    public function getBlGepe()
    {
        return $this->blGepe;
    }

    public function getBlGpeecPlus() {
        return $this->blGpeecPlus;
    }

    public function setBlGpeecPlus($blGpeecPlus) {
        $this->blGpeecPlus = $blGpeecPlus;
    }

    /**
     * Set blApa
     *
     * @param boolean $blApa
     *
     * @return EnqueteCollectivite
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
     * @return EnqueteCollectivite
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
     * @return EnqueteCollectivite
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
     * Set blBasecarr
     *
     * @param boolean $blBasecarr
     *
     * @return EnqueteCollectivite
     */
    public function setBlBasecarr($blBasecarr)
    {
        $this->blBasecarr = $blBasecarr;

        return $this;
    }

    /**
     * Get blBasecarr
     *
     * @return boolean
     */
    public function getBlBasecarr()
    {
        return $this->blBasecarr;
    }

    /**
     * Set blDgcl
     *
     * @param boolean $blDgcl
     *
     * @return EnqueteCollectivite
     */
    public function setBlDgcl($blDgcl)
    {
        $this->blDgcl = $blDgcl;

        return $this;
    }

    /**
     * Get blDgcl
     *
     * @return boolean
     */
    public function getBlDgcl()
    {
        return $this->blDgcl;
    }

    /**
     * Get idEnqucoll
     *
     * @return integer
     */
    public function getIdEnqucoll()
    {
        return $this->idEnqucoll;
    }


    function getEnquete() {
        return $this->enquete;
    }

    function getCollectivite() {
        return $this->collectivite;
    }

    function setEnquete($enquete) {
        $this->enquete = $enquete;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }

}
