<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind424 extends IndBaseEntity
{

    /**
     * @var integer
     */
    protected $id424;
    protected $bilanSocialConsolide;

    /**
     * @var integer
     */
    protected $idBilasocicons;

    /**
     * @var integer
     */
    protected $rTS4241;

    /**
     * @var integer
     */
    protected $rTS4242;

    /**
     * @var integer
     */
    protected $rTS4243;

    /**
     * @var integer
     */
    protected $rTS4244;

    /**
     * @var integer
     */
    protected $rTS4245;

    /**
     * @var integer
     */
    protected $rTS4246;

    /**
     * @var integer
     */
    protected $rEMP4241;

    /**
     * @var integer
     */
    protected $rEMP4242;

    /**
     * @var integer
     */
    protected $rEMP4243;

    /**
     * @var integer
     */
    protected $rEMP4244;

    /**
     * @var integer
     */
    protected $rEMP4245;

    /**
     * @var integer
     */
    protected $rEMP4246;


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

    public function getId424() {
        return $this->id424;
    }

    public function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    public function getIdBilasocicons() {
        return $this->idBilasocicons;
    }



    function getRTS4241(int $ifNull = null) {
        return $this->rTS4241 ?? $ifNull;
    }

    function getRTS4242(int $ifNull = null) {
        return $this->rTS4242 ?? $ifNull;
    }

    function getRTS4243(int $ifNull = null) {
        return $this->rTS4243 ?? $ifNull;
    }

    function getRTS4244(int $ifNull = null) {
        return $this->rTS4244 ?? $ifNull;
    }

    function getRTS4245(int $ifNull = null) {
        return $this->rTS4245 ?? $ifNull;
    }

    function getRTS4246(int $ifNull = null) {
        return $this->rTS4246 ?? $ifNull;
    }

    function getREMP4241(int $ifNull = null) {
        return $this->rEMP4241 ?? $ifNull;
    }

    function getREMP4242(int $ifNull = null) {
        return $this->rEMP4242 ?? $ifNull;
    }

    function getREMP4243(int $ifNull = null) {
        return $this->rEMP4243 ?? $ifNull;
    }

    function getREMP4244(int $ifNull = null) {
        return $this->rEMP4244 ?? $ifNull;
    }

    function getREMP4245(int $ifNull = null) {
        return $this->rEMP4245 ?? $ifNull;
    }

    function getREMP4246(int $ifNull = null) {
        return $this->rEMP4246 ?? $ifNull;
    }

    function setRTS4241($rTS4241) {
        $this->rTS4241 = $rTS4241;
    }

    function setRTS4242($rTS4242) {
        $this->rTS4242 = $rTS4242;
    }

    function setRTS4243($rTS4243) {
        $this->rTS4243 = $rTS4243;
    }

    function setRTS4244($rTS4244) {
        $this->rTS4244 = $rTS4244;
    }

    function setRTS4245($rTS4245) {
        $this->rTS4245 = $rTS4245;
    }

    function setRTS4246($rTS4246) {
        $this->rTS4246 = $rTS4246;
    }

    function setREMP4241($rEMP4241) {
        $this->rEMP4241 = $rEMP4241;
    }

    function setREMP4242($rEMP4242) {
        $this->rEMP4242 = $rEMP4242;
    }

    function setREMP4243($rEMP4243) {
        $this->rEMP4243 = $rEMP4243;
    }

    function setREMP4244($rEMP4244) {
        $this->rEMP4244 = $rEMP4244;
    }

    function setREMP4245($rEMP4245) {
        $this->rEMP4245 = $rEMP4245;
    }

    function setREMP4246($rEMP4246) {
        $this->rEMP4246 = $rEMP4246;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind424
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
     * @return Ind424
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
     * @return Ind424
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
     * @return Ind424
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


}
