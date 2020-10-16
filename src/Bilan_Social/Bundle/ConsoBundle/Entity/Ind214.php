<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind214 extends  IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id214;

    protected $bilanSocialConsolide;

    protected $refCategorie;


    /**
     * @var integer
     */
    protected $r2141;

    /**
     * @var integer
     */
    protected $r2142;



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

    /**
     * Get id214
     *
     * @return integer
     */
    public function getId214()
    {
        return $this->id214;
    }


    /**
     * Set r2141
     *
     * @param integer $r2141
     * @return Ind214
     */
    public function setR2141($r2141)
    {
        $this->r2141 = $r2141;

        return $this;
    }

    /**
     * Get r2141
     *
     * @return integer
     */
    public function getR2141(int $ifNull = null)
    {
        return $this->r2141 ?? $ifNull;
    }

    /**
     * Set r2142
     *
     * @param integer $r2142
     * @return Ind214
     */
    public function setR2142($r2142)
    {
        $this->r2142 = $r2142;

        return $this;
    }

    /**
     * Get r2142
     *
     * @return integer
     */
    public function getR2142(int $ifNull = null)
    {
        return $this->r2142 ?? $ifNull;
    }


    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind214
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
     * @return Ind214
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
     * @return Ind214
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
     * @return Ind214
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
