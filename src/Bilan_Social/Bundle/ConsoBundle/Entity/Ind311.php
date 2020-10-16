<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind311 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id311;

    protected $bilanSocialConsolide;

    protected $refFiliere;

    protected $refCategorie;


    /**
     * @var integer
     */
    protected $r3111;

    /**
     * @var integer
     */
    protected $r3112;
    /**
     * @var integer
     */
    protected $r3113;
    /**
     * @var integer
     */
    protected $r3114;
    /**
     * @var integer
     */
    protected $r3115;
    /**
     * @var integer
     */
    protected $r3116;
    /**
     * @var integer
     */
    protected $r3117;
    /**
     * @var integer
     */
    protected $r3118;
    /**
     * @var integer
     */
    protected $r3119;
    /**
     * @var integer
     */
    protected $r31110;

    /**
     * @var integer
     */
    protected $r31111;

    /**
     * @var integer
     */
    protected $r31112;


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
     * Get id311
     *
     * @return integer
     */
    public function getId311()
    {
        return $this->id311;
    }

    function getRefFiliere() {
        return $this->refFiliere;
    }


    /**
     * Set r3111
     *
     * @param integer $r3111
     * @return Ind311
     */
    public function setR3111($r3111)
    {
        $this->r3111 = $r3111;

        return $this;
    }

    /**
     * Get r3111
     *
     * @return integer
     */
    public function getR3111(int $ifNull = null)
    {
        return $this->r3111 ?? $ifNull;
    }

    /**
     * Set r3112
     *
     * @param integer $r3112
     * @return Ind311
     */
    public function setR3112($r3112)
    {
        $this->r3112 = $r3112;

        return $this;
    }

    /**
     * Get r3112
     *
     * @return integer
     */
    public function getR3112(int $ifNull = null)
    {
        return $this->r3112 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind311
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
     * @return Ind311
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
     * @return Ind311
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
     * @return Ind311
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

    function setRefFiliere($refFiliere) {
        $this->refFiliere = $refFiliere;
    }

    function getR3113(int $ifNull = null) {
        return $this->r3113 ?? $ifNull;
    }

    function getR3114(int $ifNull = null) {
        return $this->r3114 ?? $ifNull;
    }

    function getR3115(int $ifNull = null) {
        return $this->r3115 ?? $ifNull;
    }

    function getR3116(int $ifNull = null) {
        return $this->r3116 ?? $ifNull;
    }

    function getR3117(int $ifNull = null) {
        return $this->r3117 ?? $ifNull;
    }

    function getR3118(int $ifNull = null) {
        return $this->r3118 ?? $ifNull;
    }

    function getR3119(int $ifNull = null) {
        return $this->r3119 ?? $ifNull;
    }

    function getR31110(int $ifNull = null) {
        return $this->r31110 ?? $ifNull;
    }

    function getR31111(int $ifNull = null) {
        return $this->r31111 ?? $ifNull;
    }

    function getR31112(int $ifNull = null) {
        return $this->r31112 ?? $ifNull;
    }

    function setR3113($r3113) {
        $this->r3113 = $r3113;
    }

    function setR3114($r3114) {
        $this->r3114 = $r3114;
    }

    function setR3115($r3115) {
        $this->r3115 = $r3115;
    }

    function setR3116($r3116) {
        $this->r3116 = $r3116;
    }

    function setR3117($r3117) {
        $this->r3117 = $r3117;
    }

    function setR3118($r3118) {
        $this->r3118 = $r3118;
    }

    function setR3119($r3119) {
        $this->r3119 = $r3119;
    }

    function setR31110($r31110) {
        $this->r31110 = $r31110;
    }

    function setR31111($r31111) {
        $this->r31111 = $r31111;
    }

    function setR31112($r31112) {
        $this->r31112 = $r31112;
    }





}
