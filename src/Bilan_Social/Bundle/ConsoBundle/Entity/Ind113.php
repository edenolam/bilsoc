<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind113
{
    /**
     * @var integer
     */
    private $id113;

    private $bilanSocialConsolide;

    private $refCategorie;

    /**
     * @var string
     */
    private $fgGenr;

    /**
     * @var integer
     */
    private $r1131;

    /**
     * @var integer
     */
    private $r1132;

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

    private $totalInd112;

    /**
     * Get id113
     *
     * @return integer
     */
    public function getId113()
    {
        return $this->id113;
    }

        /**
     * Set fgGenr
     *
     * @param string $fgGenr
     * @return Ind113
     */
    public function setFgGenr($fgGenr)
    {
        $this->fgGenr = $fgGenr;

        return $this;
    }

    /**
     * Get fgGenr
     *
     * @return string
     */
    public function getFgGenr()
    {
        return $this->fgGenr;
    }

    /**
     * Set r1131
     *
     * @param integer $r1131
     * @return Ind113
     */
    public function setR1131($r1131)
    {
        $this->r1131 = $r1131;

        return $this;
    }

    /**
     * Get r1131
     *
     * @return integer
     */
    public function getR1131(int $ifNull = null)
    {
        return $this->r1131 ?? $ifNull;
    }

    /**
     * Set r1132
     *
     * @param integer $r1132
     * @return Ind113
     */
    public function setR1132($r1132)
    {
        $this->r1132 = $r1132;

        return $this;
    }

    /**
     * Get r1132
     *
     * @return integer
     */
    public function getR1132(int $ifNull = null)
    {
        return $this->r1132 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind113
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
     * @return Ind113
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
     * @return Ind113
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
     * @return Ind113
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

    function getTotalInd112() {
        return $this->totalInd112;
    }

    function setTotalInd112($totalInd112) {
        $this->totalInd112 = $totalInd112;
    }



}
