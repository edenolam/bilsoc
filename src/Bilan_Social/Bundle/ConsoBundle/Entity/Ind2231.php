<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2231
{
    /**
     * @var integer
     */
    private $id2231;

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
    private $r22311;

    /**
     * @var integer
     */
    private $r22312;

    /**
     * @var integer
     */
    private $r22313;

    /**
     * @var integer
     */
    private $r22314;


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
     * Get id2231
     *
     * @return integer
     */
    public function getId2231()
    {
        return $this->id2231;
    }

    /**
     * Set idCate
     *
     * @param integer $idCate
     * @return Ind2231
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
     * @return Ind2231
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
     * Set r22311
     *
     * @param integer $r22311
     * @return Ind2231
     */
    public function setR22311($r22311)
    {
        $this->r22311 = $r22311;

        return $this;
    }

    /**
     * Get r22311
     *
     * @return integer
     */
    public function getR22311(int $ifNull = null)
    {
        return $this->r22311 ?? $ifNull;
    }

    /**
     * Set r22312
     *
     * @param integer $r22312
     * @return Ind2231
     */
    public function setR22312($r22312)
    {
        $this->r22312 = $r22312;

        return $this;
    }

    /**
     * Get r22312
     *
     * @return integer
     */
    public function getR22312(int $ifNull = null)
    {
        return $this->r22312 ?? $ifNull;
    }

    /**
     * Set r22313
     *
     * @param integer $r22313
     * @return Ind2231
     */
    public function setR22313($r22313)
    {
        $this->r22313 = $r22313;

        return $this;
    }

    /**
     * Get r22313
     *
     * @return integer
     */
    public function getR22313(int $ifNull = null)
    {
        return $this->r22313 ?? $ifNull;
    }

    /**
     * Set r22314
     *
     * @param integer $r22314
     * @return Ind2231
     */
    public function setR22314($r22314)
    {
        $this->r22314 = $r22314;

        return $this;
    }

    /**
     * Get r22314
     *
     * @return integer
     */
    public function getR22314(int $ifNull = null)
    {
        return $this->r22314 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind2231
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
     * @return Ind2231
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
     * @return Ind2231
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
     * @return Ind2231
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
