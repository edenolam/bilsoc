<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2261 {

    /**
     * @var integer
     */
    private $id2261;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $r22611;

    /**
     * @var integer
     */
    private $r22612;
    
    /**
     * @var integer
     */
    private $r22613;
    
    /**
     * @var integer
     */
    private $r22614;

    /**
     * @var integer
     */
    private $r22615;

    /**
     * @var integer
     */
    private $r22616;

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
     * Get id2261
     *
     * @return integer
     */
    public function getId2261() {
        return $this->id2261;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind2261
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
     * Set r22611
     *
     * @param integer $r22611
     * @return Ind2261
     */
    public function setR22611($r22611) {
        $this->r22611 = $r22611;

        return $this;
    }

    /**
     * Get r22611
     *
     * @return integer
     */
    public function getR22611(int $ifNull = null) {
        return $this->r22611 ?? $ifNull;
    }

    /**
     * Set r22612
     *
     * @param integer $r22612
     * @return Ind2261
     */
    public function setR22612($r22612) {
        $this->r22612 = $r22612;

        return $this;
    }

    /**
     * Get r22612
     *
     * @return integer
     */
    public function getR22612(int $ifNull = null) {
        return $this->r22612 ?? $ifNull;
    }

    /**
     * Set r22613
     *
     * @param integer $r22613
     * @return Ind2261
     */
    public function setR22613($r22613) {
        $this->r22613 = $r22613;

        return $this;
    }

    /**
     * Get r22613
     *
     * @return integer
     */
    public function getR22613(int $ifNull = null) {
        return $this->r22613 ?? $ifNull;
    }

    /**
     * Set r22614
     *
     * @param integer $r22614
     * @return Ind2261
     */
    public function setR22614($r22614) {
        $this->r22614 = $r22614;

        return $this;
    }

    /**
     * Get r22614
     *
     * @return integer
     */
    public function getR22614(int $ifNull = null) {
        return $this->r22614 ?? $ifNull;
    }

    /**
     * Set r22615
     *
     * @param integer $r22615
     * @return Ind2261
     */
    public function setR22615($r22615) {
        $this->r22615 = $r22615;

        return $this;
    }

    /**
     * Get r22615
     *
     * @return integer
     */
    public function getR22615(int $ifNull = null) {
        return $this->r22615 ?? $ifNull;
    }

    /**
     * Set r22616
     *
     * @param integer $r22616
     * @return Ind2261
     */
    public function setR22616($r22616) {
        $this->r22616 = $r22616;

        return $this;
    }

    /**
     * Get r22616
     *
     * @return integer
     */
    public function getR22616(int $ifNull = null) {
        return $this->r22616 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind2261
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
     * @return Ind2261
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
     * @return Ind2261
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
     * @return Ind2261
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
     * @return Ind2261
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
     * @return Ind2261
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
