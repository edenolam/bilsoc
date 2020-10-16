<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind231 {

    /**
     * @var integer
     */
    private $id231;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $r2311;

    /**
     * @var integer
     */
    private $r2312;


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
     * @var string
     */
    private $cdDema;

    /**
     * @var int
     */
    private $order;


    /**
     * Get id231
     *
     * @return integer
     */
    public function getId231() {
        return $this->id231;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind231
     */
    public function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    /**
     * Get idBilasocicons
     *
     * @return integer
     */
    public function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    /**
     * Set r2311
     *
     * @param integer $r2311
     * @return Ind231
     */
    public function setR2311($r2311) {
        $this->r2311 = $r2311;

        return $this;
    }

    /**
     * Get r2311
     *
     * @return integer
     */
    public function getR2311(int $ifNull = null) {
        return $this->r2311 ?? $ifNull;
    }

    /**
     * Set r2312
     *
     * @param integer $r2312
     * @return Ind231
     */
    public function setR2312($r2312) {
        $this->r2312 = $r2312;

        return $this;
    }

    /**
     * Get r2312
     *
     * @return integer
     */
    public function getR2312(int $ifNull = null) {
        return $this->r2312 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind231
     */
    public function setDtCrea($dtCrea) {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea() {
        return $this->dtCrea;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     * @return Ind231
     */
    public function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    /**
     * Set dtModi
     *
     * @param \DateTime $dtModi
     * @return Ind231
     */
    public function setDtModi($dtModi) {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi() {
        return $this->dtModi;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     * @return Ind231
     */
    public function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdDema
     *
     * @return string
     */
    public function getCdDema() {
        return $this->cdDema;
    }

    /**
     * Set cdDema
     *
     * @param string $cdDema
     * @return Ind231
     */
    public function setCdDema($cdDema) {
        $this->cdDema = $cdDema;

        return $this;
    }

    /**
     * Get order
     *
     * @return int
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * Set order
     *
     * @param int $order
     * @return Ind231
     */
    public function setOrder($order) {
        $this->order = $order;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

}
