<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2262 {

    /**
     * @var integer
     */
    private $id2262;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $r22621;

    /**
     * @var integer
     */
    private $r22622;

    /**
     * @var integer
     */
    private $r22623;

    /**
     * @var integer
     */
    private $r22624;

    /**
     * @var integer
     */
    private $r22625;

    /**
     * @var integer
     */
    private $r22626;

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
    private $cdJourCarence;

    /**
     * @var int
     */
    private $order;


    /**
     * Get id2262
     *
     * @return integer
     */
    public function getId2262() {
        return $this->id2262;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind2262
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
     * Set r22621
     *
     * @param integer $r22621
     * @return Ind2262
     */
    public function setR22621($r22621) {
        $this->r22621 = $r22621;

        return $this;
    }

    /**
     * Get r22621
     *
     * @return integer
     */
    public function getR22621(int $ifNull = null) {
        return $this->r22621 ?? $ifNull;
    }

    /**
     * Set r22622
     *
     * @param integer $r22622
     * @return Ind2262
     */
    public function setR22622($r22622) {
        $this->r22622 = $r22622;

        return $this;
    }

    /**
     * Get r22622
     *
     * @return integer
     */
    public function getR22622(int $ifNull = null) {
        return $this->r22622 ?? $ifNull;
    }

    /**
     * Set r22623
     *
     * @param integer $r22623
     * @return Ind2262
     */
    public function setR22623($r22623) {
        $this->r22623 = $r22623;

        return $this;
    }

    /**
     * Get r22623
     *
     * @return integer
     */
    public function getR22623(int $ifNull = null) {
        return $this->r22623 ?? $ifNull;
    }

    /**
     * Set r22624
     *
     * @param integer $r22624
     * @return Ind2262
     */
    public function setR22624($r22624) {
        $this->r22624 = $r22624;

        return $this;
    }

    /**
     * Get r22624
     *
     * @return integer
     */
    public function getR22624(int $ifNull = null) {
        return $this->r22624 ?? $ifNull;
    }

    /**
     * Set r22625
     *
     * @param integer $r22625
     * @return Ind2262
     */
    public function setR22625($r22625) {
        $this->r22625 = $r22625;

        return $this;
    }

    /**
     * Get r22625
     *
     * @return integer
     */
    public function getR22625(int $ifNull = null) {
        return $this->r22625 ?? $ifNull;
    }

    /**
     * Set r22626
     *
     * @param integer $r22626
     * @return Ind2262
     */
    public function setR22626($r22626) {
        $this->r22626 = $r22626;

        return $this;
    }

    /**
     * Get r22626
     *
     * @return integer
     */
    public function getR22626(int $ifNull = null) {
        return $this->r22626 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind2262
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
     * @return Ind2262
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
     * @return Ind2262
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
     * @return Ind2262
     */
    public function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdJourCarence
     *
     * @return string
     */
    public function getCdJourCarence() {
        return $this->cdJourCarence;
    }

    /**
     * Set cdJourCarence
     *
     * @param string $cdJourCarence
     * @return Ind2262
     */
    public function setCdJourCarence($cdJourCarence) {
        $this->cdJourCarence = $cdJourCarence;

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
     * @return Ind2262
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
