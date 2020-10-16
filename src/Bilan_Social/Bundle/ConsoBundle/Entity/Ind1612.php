<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind1612 extends  IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1612;

    protected $bilanSocialConsolide;

    /**
     * @var integer
     */
    protected $idBilasocicons;

    /**
     * @var integer
     */
    protected $r16121;

    /**
     * @var integer
     */
    protected $r16122;

    /**
     * @var integer
     */
    protected $r16123;

    /**
     * @var integer
     */
    protected $r16124;



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




    public function getId1612()
    {
        return $this->id1612;
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

    public function setR16121($r16121)
    {
        $this->r16121 = $r16121;

        return $this;
    }

    public function getR16121(int $ifNull = null)
    {
        return $this->r16121 ?? $ifNull;
    }

    public function setR16122($r16122)
    {
        $this->r16122 = $r16122;

        return $this;
    }

    public function getR16122(int $ifNull = null)
    {
        return $this->r16122 ?? $ifNull;
    }

    public function setR16123($r16123)
    {
        $this->r16123 = $r16123;

        return $this;
    }

    public function getR16123(int $ifNull = null)
    {
        return $this->r16123 ?? $ifNull;
    }

    public function setR16124($r16124)
    {
        $this->r16124 = $r16124;

        return $this;
    }

    public function getR16124(int $ifNull = null)
    {
        return $this->r16124 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind1612
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
     * @return Ind1612
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
     * @return Ind1612
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
     * @return Ind1612
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
