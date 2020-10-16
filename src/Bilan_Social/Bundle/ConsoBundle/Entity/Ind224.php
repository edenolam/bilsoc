<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind224 extends  IndBaseEntity
 {

    /**
     * @var integer
     */
    protected $id224;

    protected $bilanSocialConsolide;

    /**
     * @var integer
     */
    protected $idBilasocicons;

    /**
     * @var integer
     */
    protected $r2241;

    /**
     * @var integer
     */
    protected $r2242;

    /**
     * @var integer
     */
    protected $r2243;

    /**
     * @var integer
     */
    protected $r2244;

    /**
     * @var integer
     */
    protected $r2245;

    /**
     * @var integer
     */
    protected $r2246;

    /**
     * @var integer
     */
    protected $r2247;

    /**
     * @var integer
     */
    protected $r2248;
    /**
     * @var integer
     */
    protected $r2249;
    /**
     * @var integer
     */
    protected $r22410;
    /**
     * @var integer
     */
    protected $r22411;
    /**
     * @var integer
     */
    protected $r22412;
    /**
     * @var integer
     */
    protected $r22413;
    /**
     * @var integer
     */
    protected $r22414;
    /**
     * @var integer
     */
    protected $r22415;
    /**
     * @var integer
     */
    protected $r22416;


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
     * Set idCate
     *
     * @param integer $idCate
     * @return Ind2231
     */
    public function setIdCate($idCate)
    {
        $this->idCate = $idCate;

        return $this;
    }

    /**
     * Get idCate
     *
     * @return integer
     */
    public function getIdCate()
    {
        return $this->idCate;
    }

    /**
     * Get id224
     *
     * @return integer
     */
    public function getId224()
    {
        return $this->id224;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind224
     */
    public function setIdBilasocicons($idBilasocicons)
    {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    /**
     * Get idBilasocicons
     *
     * @return integer
     */
    public function getIdBilasocicons()
    {
        return $this->idBilasocicons;
    }

    /**
     * Set r2241
     *
     * @param integer $r2241
     * @return Ind224
     */
    public function setR2241($r2241)
    {
        $this->r2241 = $r2241;

        return $this;
    }

    /**
     * Get r2241
     *
     * @return integer
     */
    public function getR2241(int $ifNull = null)
    {
        return $this->r2241 ?? $ifNull;
    }

    /**
     * Set r2242
     *
     * @param integer $r2242
     * @return Ind224
     */
    public function setR2242($r2242)
    {
        $this->r2242 = $r2242;

        return $this;
    }

    /**
     * Get r2242
     *
     * @return integer
     */
    public function getR2242(int $ifNull = null)
    {
        return $this->r2242 ?? $ifNull;
    }

    /**
     * Set r2243
     *
     * @param integer $r2243
     * @return Ind224
     */
    public function setR2243($r2243)
    {
        $this->r2243 = $r2243;

        return $this;
    }

    /**
     * Get r2243
     *
     * @return integer
     */
    public function getR2243(int $ifNull = null)
    {
        return $this->r2243 ?? $ifNull;
    }

    /**
     * Set r2244
     *
     * @param integer $r2244
     * @return Ind224
     */
    public function setR2244($r2244)
    {
        $this->r2244 = $r2244;

        return $this;
    }

    /**
     * Get r2244
     *
     * @return integer
     */
    public function getR2244(int $ifNull = null)
    {
        return $this->r2244 ?? $ifNull;
    }

    /**
     * Set r2245
     *
     * @param integer $r2245
     * @return Ind224
     */
    public function setR2245($r2245)
    {
        $this->r2245 = $r2245;

        return $this;
    }

    /**
     * Get r2245
     *
     * @return integer
     */
    public function getR2245(int $ifNull = null)
    {
        return $this->r2245 ?? $ifNull;
    }

    /**
     * Set r2246
     *
     * @param integer $r2246
     * @return Ind224
     */
    public function setR2246($r2246)
    {
        $this->r2246 = $r2246;

        return $this;
    }

    /**
     * Get r2246
     *
     * @return integer
     */
    public function getR2246(int $ifNull = null)
    {
        return $this->r2246 ?? $ifNull;
    }

 

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind224
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
     * @return Ind224
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
     * @return Ind224
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
     * @return Ind224
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

    function getR2247() {
        return $this->r2247;
    }

    function getR2248() {
        return $this->r2248;
    }

    function setR2247($r2247) {
        $this->r2247 = $r2247;
    }

    function setR2248($r2248) {
        $this->r2248 = $r2248;
    }

    function getR2249() {
        return $this->r2249;
    }

    function setR2249($r2249) {
        $this->r2249 = $r2249;
    }

    function getR22410() {
        return $this->r22410;
    }

    function setR22410($r22410) {
        $this->r22410 = $r22410;
    }

    function getR22411() {
        return $this->r22411;
    }

    function setR22411($r22411) {
        $this->r22411 = $r22411;
    }

    function getR22412() {
        return $this->r22412;
    }

    function setR22412($r22412) {
        $this->r22412 = $r22412;
    }

    function getR22413() {
        return $this->r22413;
    }

    function setR22413($r22413) {
        $this->r22413 = $r22413;
    }

    function getR22414() {
        return $this->r22414;
    }

    function setR22414($r22414) {
        $this->r22414 = $r22414;
    }

    function getR22415() {
        return $this->r22415;
    }

    function setR22415($r22415) {
        $this->r22415 = $r22415;
    }

    function getR22416() {
        return $this->r22416;
    }

    function setR22416($r22416) {
        $this->r22416 = $r22416;
    }

}
