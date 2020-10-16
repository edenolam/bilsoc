<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind215
{
    /**
     * @var integer
     */
    private $id215;

    private $bilanSocialConsolide;

    private $refCategorie;


    /**
     * @var integer
     */
    private $r2151;

    /**
     * @var integer
     */
    private $r2152;


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
     * Get id215
     *
     * @return integer
     */
    public function getId215()
    {
        return $this->id215;
    }


    /**
     * Set r2151
     *
     * @param integer $r2151
     * @return Ind215
     */
    public function setR2151($r2151)
    {
        $this->r2151 = $r2151;

        return $this;
    }

    /**
     * Get r2151
     *
     * @return integer
     */
    public function getR2151(int $ifNull = null)
    {
        return $this->r2151 ?? $ifNull;
    }

    /**
     * Set r2152
     *
     * @param integer $r2152
     * @return Ind215
     */
    public function setR2152($r2152)
    {
        $this->r2152 = $r2152;

        return $this;
    }

    /**
     * Get r2152
     *
     * @return integer
     */
    public function getR2152(int $ifNull = null)
    {
        return $this->r2152 ?? $ifNull;
    }


    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind215
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
     * @return Ind215
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
     * @return Ind215
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
     * @return Ind215
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
