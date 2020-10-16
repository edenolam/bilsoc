<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * CollectiviteContact
 */
class CollectiviteContact
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
     * @Assert\Regex(
     *     pattern="/(0|\\+33|0033)[1-9][0-9]{8}/",
     *     message="Your name cannot contain a number"
     * )
     */
    private $lbTele;

    /**
     * @Assert\Regex(
     *     pattern="(0|\\+33|0033)[1-9][0-9]{8}",
     *     message="Your name cannot contain a number"
     * )
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
    private $idCollCont;

    /**
     * @var integer
     */
    private $collectivite;
    /**
     * @var string
     */
    private $blContactPrincipal;
    
    private $blContactGpeec;

    /**
     * Set lbNom
     *
     * @param string $lbNom
     *
     * @return CollectiviteContact
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
     * @return CollectiviteContact
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
     * @param integer $lbTele
     *
     * @return CollectiviteContact
     */
    public function setLbTele($lbTele)
    {
        $this->lbTele = $lbTele;

        return $this;
    }

    /**
     * Get lbTele
     *
     * @return integer
     */
    public function getLbTele()
    {
        return $this->lbTele;
    }

    /**
     * Set lbFonc
     *
     * @param string $lbFonc
     *
     * @return CollectiviteContact
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
     * @return CollectiviteContact
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
     * @return CollectiviteContact
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
     * @return CollectiviteContact
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
     * @return CollectiviteContact
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
     * @return CollectiviteContact
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
     * Get idCollCont
     *
     * @return integer
     */
    public function getIdCollCont()
    {
        return $this->idCollCont;
    }

    function getCollectivite() {
        return $this->collectivite;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }
    function getBlContactPrincipal() {
        return $this->blContactPrincipal;
    }

    function setBlContactPrincipal($blContactPrincipal) {
        $this->blContactPrincipal = $blContactPrincipal;
    }

    function getBlContactGpeec() {
        return $this->blContactGpeec;
    }

    function setBlContactGpeec($blContactGpeec) {
        $this->blContactGpeec = $blContactGpeec;
    }
}
