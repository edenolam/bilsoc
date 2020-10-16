<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind122 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id122;

    protected $bilanSocialConsolide;
    protected $totalParFiliere;
    protected $refCadreEmploi;
    protected $idCate;
    protected $idFili;
    protected $cdFili;
    protected $lbFili;
    protected $newFiliere;
    protected $lastFiliere;

    protected $totalInd121;

    /**
     * @var integer
     */

    protected $r1221;

    /**
     * @var integer
     */
    protected $r1222;

    /**
     * @var integer
     */
    protected $r1223;

    /**
     * @var integer
     */
    protected $r1224;

    /**
     * @var integer
     */
    protected $r1225;

    /**
     * @var integer
     */
    protected $r1226;

    /**
     * @var integer
     */
    protected $r1227;

    /**
     * @var integer
     */
    protected $r1228;



    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
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
            $this->r1221 = 0;
            $this->r1222 = 0;
            $this->r1223 = 0;
            $this->r1224 = 0;
            $this->r1225 = 0;
            $this->r1226 = 0;
            $this->r1227 = 0;
            $this->r1228 = 0;
        }
    }

    public function cumulR122x($r122xField) {
        $this->r1221 += $r122xField->getR1221(0);
        $this->r1222 += $r122xField->getR1222(0);
        $this->r1223 += $r122xField->getR1223(0);
        $this->r1224 += $r122xField->getR1224(0);
        $this->r1225 += $r122xField->getR1225(0);
        $this->r1226 += $r122xField->getR1226(0);
        $this->r1227 += $r122xField->getR1227(0);
        $this->r1228 += $r122xField->getR1228(0);
        return $this;
    }


    function getId122() {
        return $this->id122;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getIdFili() {
        return $this->idFili;
    }

    function getCdFili() {
        return $this->cdFili;
    }

    function getLbFili() {
        return $this->lbFili;
    }

    function getNewFiliere() {
        return $this->newFiliere;
    }

    function getLastFiliere() {
        return $this->lastFiliere;
    }

    function getR1221(int $ifNull = null) {
        return $this->r1221 ?? $ifNull;
    }

    function getR1222(int $ifNull = null) {
        return $this->r1222 ?? $ifNull;
    }

    function getR1223(int $ifNull = null) {
        return $this->r1223 ?? $ifNull;
    }

    function getR1224(int $ifNull = null) {
        return $this->r1224 ?? $ifNull;
    }

    function getR1225(int $ifNull = null) {
        return $this->r1225 ?? $ifNull;
    }

    function getR1226(int $ifNull = null) {
        return $this->r1226 ?? $ifNull;
    }

    function getR1227(int $ifNull = null) {
        return $this->r1227 ?? $ifNull;
    }

    function getR1228(int $ifNull = null) {
        return $this->r1228 ?? $ifNull;
    }


    function getDtCrea(): \DateTime {
        return $this->dtCrea;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function getDtModi(): \DateTime {
        return $this->dtModi;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function setId122($id122) {
        $this->id122 = $id122;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setIdFili($idFili) {
        $this->idFili = $idFili;
    }

    function setCdFili($cdFili) {
        $this->cdFili = $cdFili;
    }

    function setLbFili($lbFili) {
        $this->lbFili = $lbFili;
    }

    function setNewFiliere($newFiliere) {
        $this->newFiliere = $newFiliere;
    }

    function setLastFiliere($lastFiliere) {
        $this->lastFiliere = $lastFiliere;
    }

    function setR1221($r1221) {
        $this->r1221 = $r1221;
    }

    function setR1222($r1222) {
        $this->r1222 = $r1222;
    }

    function setR1223($r1223) {
        $this->r1223 = $r1223;
    }

    function setR1224($r1224) {
        $this->r1224 = $r1224;
    }

    function setR1225($r1225) {
        $this->r1225 = $r1225;
    }

    function setR1226($r1226) {
        $this->r1226 = $r1226;
    }

    function setR1227($r1227) {
        $this->r1227 = $r1227;
    }

    function setR1228($r1228) {
        $this->r1228 = $r1228;
    }

    function setDtCrea(\DateTime $dtCrea) {
        $this->dtCrea = $dtCrea;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function setDtModi(\DateTime $dtModi) {
        $this->dtModi = $dtModi;
    }

    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    function getIdCate() {
        return $this->idCate;
    }

    function setIdCate($idCate) {
        $this->idCate = $idCate;
    }

    function getTotalInd121() {
        return $this->totalInd121;
    }

    function setTotalInd121($totalInd121) {
        $this->totalInd121 = $totalInd121;
    }

    function getTotalParFiliere() {
        return $this->totalParFiliere + $this->r1221 + $this->r1222 + $this->r1223 + $this->r1224 + $this->r1225 + $this->r1226 + $this->r1227 + $this->r1228;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
