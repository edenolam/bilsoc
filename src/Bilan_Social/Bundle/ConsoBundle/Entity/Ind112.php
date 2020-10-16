<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind112 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id112;
    protected $totalParFiliere;
    protected $bilanSocialConsolide;

    protected $refCadreEmploi;

    protected $idFili;
    protected $cdFili;
    protected $lbFili;
    protected $newFiliere;
    protected $lastFiliere;
    protected $idCate;

    /**
     * @var integer
     */

    protected $r1121;

    /**
     * @var integer
     */
    protected $r1122;

    /**
     * @var integer
     */
    protected $r1123;

    /**
     * @var integer
     */
    protected $r1124;

    /**
     * @var integer
     */
    protected $r1125;

    /**
     * @var integer
     */
    protected $r1126;

    /**
     * @var integer
     */
    protected $r1127;

    /**
     * @var integer
     */
    protected $r1128;


    protected $totalCeInd111;

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
            $this->r1121 = 0;
            $this->r1122 = 0;
            $this->r1123 = 0;
            $this->r1124 = 0;
            $this->r1125 = 0;
            $this->r1126 = 0;
            $this->r1127 = 0;
            $this->r1128 = 0;
        }
    }

    public function cumulR112x($r112xField) {
        $this->r1121 += $r112xField->getR1121(0);
        $this->r1122 += $r112xField->getR1122(0);
        $this->r1123 += $r112xField->getR1123(0);
        $this->r1124 += $r112xField->getR1124(0);
        $this->r1125 += $r112xField->getR1125(0);
        $this->r1126 += $r112xField->getR1126(0);
        $this->r1127 += $r112xField->getR1127(0);
        $this->r1128 += $r112xField->getR1128(0);
        return $this;
    }

    function getId112() {
        return $this->id112;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdFili() {
        return $this->idFili;
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

    public function getR1121(int $ifNull = null) {
        return $this->r1121 ?? $ifNull;
    }

    function getR1122(int $ifNull = null) {
        return $this->r1122 ?? $ifNull;
    }

    function getR1123(int $ifNull = null) {
        return $this->r1123 ?? $ifNull;
    }

    function getR1124(int $ifNull = null) {
        return $this->r1124 ?? $ifNull;
    }

    function getR1125(int $ifNull = null) {
        return $this->r1125 ?? $ifNull;
    }

    function getR1126(int $ifNull = null) {
        return $this->r1126 ?? $ifNull;
    }

    function getR1127(int $ifNull = null) {
        return $this->r1127 ?? $ifNull;
    }

    function getR1128(int $ifNull = null) {
        return $this->r1128 ?? $ifNull;
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

    function setId112($id112) {
        $this->id112 = $id112;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdCadrempl($idCadrempl) {
        $this->idCadrempl = $idCadrempl;
    }

    function setLbCadrempl($lbCadrempl) {
        $this->lbCadrempl = $lbCadrempl;
    }

    function setIdFili($idFili) {
        $this->idFili = $idFili;
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

    function setR1121($r1121) {
        $this->r1121 = $r1121;
    }

    function setR1122($r1122) {
        $this->r1122 = $r1122;
    }

    function setR1123($r1123) {
        $this->r1123 = $r1123;
    }

    function setR1124($r1124) {
        $this->r1124 = $r1124;
    }

    function setR1125($r1125) {
        $this->r1125 = $r1125;
    }

    function setR1126($r1126) {
        $this->r1126 = $r1126;
    }

    function setR1127($r1127) {
        $this->r1127 = $r1127;
    }

    function setR1128($r1128) {
        $this->r1128 = $r1128;
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

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function getCdFili() {
        return $this->cdFili;
    }

    function setCdFili($cdFili) {
        $this->cdFili = $cdFili;
    }

    function getIdCate() {
        return $this->idCate;
    }

    function setIdCate($idCate) {
        $this->idCate = $idCate;
    }




    function getTotalCeInd111() {
        return $this->totalCeInd111;
    }

    function setTotalCeInd111($totalCeInd111) {
        $this->totalCeInd111 = $totalCeInd111;
    }

    function getTotalParFiliere() {
        return $this->totalParFiliere + $this->r1121 + $this->r1122 + $this->r1123 + $this->r1124 + $this->r1125 + $this->r1126 + $this->r1127 + $this->r1128;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
