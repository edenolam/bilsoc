<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind161 extends  IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id161;

    protected $bilanSocialConsolide;
    protected $refCategorie;

    /**
     * @var integer
     */
    protected $idCate;

    /**
     * @var integer
     */
    protected $idBilasocicons;

    /**
     * @var integer
     */
    protected $r1611;

    /**
     * @var integer
     */
    protected $r1612;

    /**
     * @var integer
     */
    protected $r1613;

    /**
     * @var integer
     */
    protected $r1614;



    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $dtModi;

    /**
     * @var string
     */
    protected $cdUtilmodi;




    public function getId161()
    {
        return $this->id161;
    }

    public function setIdCate($idCate)
    {
        $this->idCate = $idCate;

        return $this;
    }

    public function getIdCate()
    {
        return $this->idCate;
    }

    public function setIdBilasocicons($idBilasocicons)
    {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    public function getIdBilasocicons()
    {
        return $this->idBilasocicons;
    }

    public function setR1611($r1611)
    {
        $this->r1611 = $r1611;

        return $this;
    }

    public function getR1611(int $ifNull = null)
    {
        return $this->r1611 ?? $ifNull;
    }

    public function setR1612($r1612)
    {
        $this->r1612 = $r1612;

        return $this;
    }

    public function getR1612(int $ifNull = null)
    {
        return $this->r1612 ?? $ifNull;
    }

    public function setR1613($r1613)
    {
        $this->r1613 = $r1613;

        return $this;
    }

    public function getR1613(int $ifNull = null)
    {
        return $this->r1613 ?? $ifNull;
    }

    public function setR1614($r1614)
    {
        $this->r1614 = $r1614;

        return $this;
    }

    public function getR1614(int $ifNull = null)
    {
        return $this->r1614 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind161
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
     * @return Ind161
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
     * @return Ind161
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
     * @return Ind161
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

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function getRefCategorie() {
        return $this->refCategorie;
    }

    function setRefCategorie($refCategorie) {
        $this->refCategorie = $refCategorie;
    }

}
