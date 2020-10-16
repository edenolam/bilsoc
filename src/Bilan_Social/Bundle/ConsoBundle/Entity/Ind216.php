<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind216
{
    /**
     * @var integer
     */
    private $id216;

    private $bilanSocialConsolide;

    private $refCategorie;


    /**
     * @var integer
     */
    private $r2161;

    /**
     * @var integer
     */
    private $r2162;


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
     * Get id216
     *
     * @return integer
     */
    public function getId216()
    {
        return $this->id216;
    }


    /**
     * Set r2161
     *
     * @param integer $r2161
     * @return Ind216
     */
    public function setR2161($r2161)
    {
        $this->r2161 = $r2161;

        return $this;
    }

    /**
     * Get r2161
     *
     * @return integer
     */
    public function getR2161(int $ifNull = null)
    {
        return $this->r2161 ?? $ifNull;
    }

    /**
     * Set r2162
     *
     * @param integer $r2162
     * @return Ind216
     */
    public function setR2162($r2162)
    {
        $this->r2162 = $r2162;

        return $this;
    }

    /**
     * Get r2162
     *
     * @return integer
     */
    public function getR2162(int $ifNull = null)
    {
        return $this->r2162 ?? $ifNull;
    }


    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind216
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
     * @return Ind216
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
     * @return Ind216
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
     * @return Ind216
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
