<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * CdgContact
 */
class CdgContact
{

    /**
     * @var string
     */
    private $lbNom;

    /**
     * @var string
     */
    private $lbPren;

    /**
     * @var string
     */
    private $lbTele;
    
    /**
     * @var string
     */
    private $lbPort;

    /**
     * @var string
     */
    private $lbFonc;

    /**
     * @var string
     */
    private $lbMail;

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
    private $idCdgContact;

    /**
     * @var integer
     */
    private $cdg;
    /**
     * @var string
     */
    private $blContactPrincipal;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $enquetes;

    /**
     * Constructor
     */
    public function __construct() {
        $this->enquetes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lbNom
     *
     * @param string $lbNom
     *
     * @return CdgContact
     */
    public function setLbNom($lbNom)
    {
        $this->lbNom = $lbNom;

        return $this;
    }

    /**
     * Get lbNom
     *
     * @return string
     */
    public function getLbNom()
    {
        return $this->lbNom;
    }

    /**
     * Set lbPren
     *
     * @param string $lbPren
     *
     * @return CdgContact
     */
    public function setLbPren($lbPren)
    {
        $this->lbPren = $lbPren;

        return $this;
    }

    /**
     * Get lbPren
     *
     * @return string
     */
    public function getLbPren()
    {
        return $this->lbPren;
    }

    /**
     * Set lbTele
     *
     * @param string $lbTele
     *
     * @return CdgContact
     */
    public function setLbTele($lbTele)
    {
        $this->lbTele = $lbTele;

        return $this;
    }

    /**
     * Get lbTele
     *
     * @return string
     */
    public function getLbTele()
    {
        return $this->lbTele;
    }

    /**
     * Set lbPort
     *
     * @param string $lbPort
     *
     * @return CdgContact
     */
    public function setLbPort($lbPort)
    {
        $this->lbPort = $lbPort;

        return $this;
    }

    /**
     * Get lbPort
     *
     * @return string
     */
    public function getLbPort()
    {
        return $this->lbPort;
    }

    /**
     * Set lbFonc
     *
     * @param string $lbFonc
     *
     * @return CdgContact
     */
    public function setLbFonc($lbFonc)
    {
        $this->lbFonc = $lbFonc;

        return $this;
    }

    /**
     * Get lbFonc
     *
     * @return string
     */
    public function getLbFonc()
    {
        return $this->lbFonc;
    }

    /**
     * Set lbMail
     *
     * @param string $lbMail
     *
     * @return CdgContact
     */
    public function setLbMail($lbMail)
    {
        $this->lbMail = $lbMail;

        return $this;
    }

    /**
     * Get lbMail
     *
     * @return string
     */
    public function getLbMail()
    {
        return $this->lbMail;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return CdgContact
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
     * @return CdgContact
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
     * @return CdgContact
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
     * @return CdgContact
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
     * Get idCdgContact
     *
     * @return integer
     */
    public function getIdCdgContact()
    {
        return $this->idCdgContact;
    }

    function getCdg() {
        return $this->cdg;
    }

    function setCdg($cdg) {
        $this->cdg = $cdg;
    }

    function getBlContactPrincipal() {
        return $this->blContactPrincipal;
    }

    function setBlContactPrincipal($blContactPrincipal) {
        $this->blContactPrincipal = $blContactPrincipal;
    }

}
