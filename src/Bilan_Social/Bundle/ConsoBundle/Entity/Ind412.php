<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind412 extends IndBaseEntity
{

    /**
     * @var integer
     */
    protected $id412;
    protected $bilanSocialConsolide;
    protected $refActionPrevention;
    protected $idBilasocicons;

    /**
     * @var integer
     */
    protected $r4121;

    /**
     * @var integer
     */
    protected $r4122;

    /**
     * @var integer
     */
    protected $r4123;


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

    public function getId412() {
        return $this->id412;
    }

    public function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    public function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    public function setR4121($r4121) {
        $this->r4121 = $r4121;
        return $this;
    }

    public function getR4121(int $ifNull = null) {
        return $this->r4121 ?? $ifNull;
    }

    public function setR4122($r4122) {
        $this->r4122 = $r4122;
        return $this;
    }

    public function getR4122(int $ifNull = null) {
        return $this->r4122 ?? $ifNull;
    }

    public function setR4123($r4123) {
        $this->r4123 = $r4123;
        return $this;
    }

    public function getR4123(int $ifNull = null) {
        return $this->r4123 ?? $ifNull;
    }


 
    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind412
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
     * @return Ind412
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
     * @return Ind412
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
     * @return Ind412
     */
    public function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;

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

    function getRefActionPrevention() {
        return $this->refActionPrevention;
    }

    function setRefActionPrevention($refActionPrevention) {
        $this->refActionPrevention = $refActionPrevention;
    }

}
