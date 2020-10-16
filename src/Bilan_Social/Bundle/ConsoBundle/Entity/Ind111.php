<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind111 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id111;
    protected $totalParFiliere;
    protected $bilanSocialConsolide;

    protected $refGrade;
    protected $refCadreEmploi;

    protected $idCadrempl;
    protected $lbCadrempl;
    protected $idFili;
    protected $cdFili;
    protected $lbFili;
    protected $newFiliere;
    protected $newCadreEmploi;
    protected $lastFiliere;
    protected $lastCadreEmploi;

    /**
     * @var integer
     */
    protected $r1111;

    /**
     * @var integer
     */
    protected $r1112;

    /**
     * @var integer
     */
    protected $r1113;

    /**
     * @var integer
     */
    protected $r1114;

    /**
     * @var integer
     */
    protected $r1115;

    /**
     * @var integer
     */
    protected $r1116;

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

    public function __construct(bool $isCumulator = false) {
        if ($isCumulator) {
            $this->r1111 = 0;
            $this->r1112 = 0;
            $this->r1113 = 0;
            $this->r1114 = 0;
            $this->r1115 = 0;
            $this->r1116 = 0;
        }
    }

    public function cumulR111x($r111xField) {
        $this->r1111 += $r111xField->getR1111(0);
        $this->r1112 += $r111xField->getR1112(0);
        $this->r1113 += $r111xField->getR1113(0);
        $this->r1114 += $r111xField->getR1114(0);
        $this->r1115 += $r111xField->getR1115(0);
        $this->r1116 += $r111xField->getR1116(0);
        return $this;
    }

    /**
     * Get id111
     *
     * @return integer
     */
    public function getId111()
    {
        return $this->id111;
    }

    /**
     * Set r1111
     *
     * @param integer $r1111
     * @return Ind111
     */
    public function setR1111($r1111)
    {
        $this->r1111 = $r1111;
        return $this;
    }

    /**
     * Get r1111
     *
     * @return integer
     */
    public function getR1111(int $ifNull = null) {
        return $this->r1111 ?? $ifNull;
    }

    /**
     * Set r1112
     *
     * @param integer $r1112
     * @return Ind111
     */
    public function setR1112($r1112)
    {
        $this->r1112 = $r1112;
        return $this;
    }

    /**
     * Get r1112
     *
     * @return integer
     */
    public function getR1112(int $ifNull = null) {
        return $this->r1112 ?? $ifNull;
    }

    /**
     * Set r1113
     *
     * @param integer $r1113
     * @return Ind111
     */
    public function setR1113($r1113)
    {
        $this->r1113 = $r1113;
        return $this;
    }

    /**
     * Get r1113
     *
     * @return integer
     */
    public function getR1113(int $ifNull = null) {
        return $this->r1113 ?? $ifNull;
    }

    /**
     * Set r1114
     *
     * @param integer $r1114
     * @return Ind111
     */
    public function setR1114($r1114)
    {
        $this->r1114 = $r1114;
        return $this;
    }

    /**
     * Get r1114
     *
     * @return integer
     */
    public function getR1114(int $ifNull = null) {
        return $this->r1114 ?? $ifNull;
    }

    /**
     * Set r1115
     *
     * @param integer $r1115
     * @return Ind111
     */
    public function setR1115($r1115)
    {
        $this->r1115 = $r1115;
        return $this;
    }

    /**
     * Get r1115
     *
     * @return integer
     */
    public function getR1115(int $ifNull = null) {
        return $this->r1115 ?? $ifNull;
    }

    /**
     * Set r1116
     *
     * @param integer $r1116
     * @return Ind111
     */
    public function setR1116($r1116)
    {
        $this->r1116 = $r1116;
        return $this;
    }

    /**
     * Get r1116
     *
     * @return integer
     */
    public function getR1116(int $ifNull = null) {
        return $this->r1116 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind111
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
     * @return Ind111
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
     * @return Ind111
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
     * @return Ind111
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }


    function getCdFili() {
        return $this->cdFili;
    }

    function setCdFili($cdFili) {
        $this->cdFili = $cdFili;
    }


    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefGrade() {
        return $this->refGrade;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefGrade($refGrade) {
        $this->refGrade = $refGrade;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }




    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function getIdCadrempl() {
        return $this->idCadrempl;
    }

    function getIdFili() {
        return $this->idFili;
    }

    function setIdCadrempl($idCadrempl) {
        $this->idCadrempl = $idCadrempl;
    }

    function setIdFili($idFili) {
        $this->idFili = $idFili;
    }
    function getLbCadrempl() {
        return $this->lbCadrempl;
    }

    function getLbFili() {
        return $this->lbFili;
    }

    function getNewFiliere() {
        return $this->newFiliere;
    }

    function getNewCadreEmploi() {
        return $this->newCadreEmploi;
    }

    function setLbCadrempl($lbCadrempl) {
        $this->lbCadrempl = $lbCadrempl;
    }

    function setLbFili($lbFili) {
        $this->lbFili = $lbFili;
    }

    function setNewFiliere($newFiliere) {
        $this->newFiliere = $newFiliere;
    }

    function setNewCadreEmploi($newCadreEmploi) {
        $this->newCadreEmploi = $newCadreEmploi;
    }

    function getLastFiliere() {
        return $this->lastFiliere;
    }

    function getLastCadreEmploi() {
        return $this->lastCadreEmploi;
    }

    function setLastFiliere($lastFiliere) {
        $this->lastFiliere = $lastFiliere;
    }

    function setLastCadreEmploi($lastCadreEmploi) {
        $this->lastCadreEmploi = $lastCadreEmploi;
    }

    function getTotalParFiliere() {
        return $this->totalParFiliere + $this->r1115 + $this->r1116;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
