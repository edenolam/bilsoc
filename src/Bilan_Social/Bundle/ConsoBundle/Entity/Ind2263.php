<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind2263 {

    /**
     * @var integer
     */
    private $id2263;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $r22631;

    /**
     * @var integer
     */
    private $r22632;

    /**
     * @var integer
     */
    private $r22633;

    /**
     * @var integer
     */
    private $r22634;

    /**
     * @var integer
     */
    private $r22635;

    /**
     * @var integer
     */
    private $r22636;

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
     * Get id2263
     *
     * @return integer
     */
    public function getId2263() {
        return $this->id2263;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind2263
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
     * Set r22631
     *
     * @param integer $r22631
     * @return Ind2263
     */
    public function setR22631($r22631) {
        $this->r22631 = $r22631;

        return $this;
    }

    /**
     * Get r22631
     *
     * @return integer
     */
    public function getR22631(int $ifNull = null) {
        return $this->r22631 ?? $ifNull;
    }

    /**
     * Set r22632
     *
     * @param integer $r22632
     * @return Ind2263
     */
    public function setR22632($r22632) {
        $this->r22632 = $r22632;

        return $this;
    }

    /**
     * Get r22632
     *
     * @return integer
     */
    public function getR22632(int $ifNull = null) {
        return $this->r22632 ?? $ifNull;
    }

    /**
     * Set r22633
     *
     * @param integer $r22633
     * @return Ind2263
     */
    public function setR22633($r22633) {
        $this->r22633 = $r22633;

        return $this;
    }

    /**
     * Get r22633
     *
     * @return integer
     */
    public function getR22633(int $ifNull = null) {
        return $this->r22633 ?? $ifNull;
    }

    /**
     * Set r22634
     *
     * @param integer $r22634
     * @return Ind2263
     */
    public function setR22634($r22634) {
        $this->r22634 = $r22634;

        return $this;
    }

    /**
     * Get r22634
     *
     * @return integer
     */
    public function getR22634(int $ifNull = null) {
        return $this->r22634 ?? $ifNull;
    }

    /**
     * Set r22635
     *
     * @param integer $r22635
     * @return Ind2263
     */
    public function setR22635($r22635) {
        $this->r22635 = $r22635;

        return $this;
    }

    /**
     * Get r22635
     *
     * @return integer
     */
    public function getR22635(int $ifNull = null) {
        return $this->r22635 ?? $ifNull;
    }

    /**
     * Set r22636
     *
     * @param integer $r22636
     * @return Ind2263
     */
    public function setR22636($r22636) {
        $this->r22636 = $r22636;

        return $this;
    }

    /**
     * Get r22636
     *
     * @return integer
     */
    public function getR22636(int $ifNull = null) {
        return $this->r22636 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind2263
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
     * @return Ind2263
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
     * @return Ind2263
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
     * @return Ind2263
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
     * @return Ind2263
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
     * @return Ind2263
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
