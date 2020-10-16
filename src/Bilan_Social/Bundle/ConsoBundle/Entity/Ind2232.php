<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2232
{
    /**
     * @var integer
     */
    private $id2232;

    private $bilanSocialConsolide;

    private $refCategorie;

    /**
     * @var integer
     */
    private $idCate;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $r22321;

    /**
     * @var integer
     */
    private $r22322;

    /**
     * @var integer
     */
    private $r22323;

    /**
     * @var integer
     */
    private $r22324;


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
     * Get id2232
     *
     * @return integer
     */
    public function getId2232()
    {
        return $this->id2232;
    }

    /**
     * Set idCate
     *
     * @param integer $idCate
     * @return Ind2232
     */
    public function setIdCate($idCate)
    {
        $this->idCate = $idCate;

        return $this;
    }

    /**
     * Get idCate
     *
     * @return integer
     */
    public function getIdCate()
    {
        return $this->idCate;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind2232
     */
    public function setIdBilasocicons($idBilasocicons)
    {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    /**
     * Get idBilasocicons
     *
     * @return integer
     */
    public function getIdBilasocicons()
    {
        return $this->idBilasocicons;
    }

    /**
     * Set r22321
     *
     * @param integer $r22321
     * @return Ind2232
     */
    public function setR22321($r22321)
    {
        $this->r22321 = $r22321;

        return $this;
    }

    /**
     * Get r22321
     *
     * @return integer
     */
    public function getR22321(int $ifNull = null)
    {
        return $this->r22321 ?? $ifNull;
    }

    /**
     * Set r22322
     *
     * @param integer $r22322
     * @return Ind2232
     */
    public function setR22322($r22322)
    {
        $this->r22322 = $r22322;

        return $this;
    }

    /**
     * Get r22322
     *
     * @return integer
     */
    public function getR22322(int $ifNull = null)
    {
        return $this->r22322 ?? $ifNull;
    }

    /**
     * Set r22323
     *
     * @param integer $r22323
     * @return Ind2232
     */
    public function setR22323($r22323)
    {
        $this->r22323 = $r22323;

        return $this;
    }

    /**
     * Get r22323
     *
     * @return integer
     */
    public function getR22323(int $ifNull = null)
    {
        return $this->r22323 ?? $ifNull;
    }

    /**
     * Set r22324
     *
     * @param integer $r22324
     * @return Ind2232
     */
    public function setR22324($r22324)
    {
        $this->r22324 = $r22324;

        return $this;
    }

    /**
     * Get r22324
     *
     * @return integer
     */
    public function getR22324(int $ifNull = null)
    {
        return $this->r22324 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind2232
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
     * @return Ind2232
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
     * @return Ind2232
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
     * @return Ind2232
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
