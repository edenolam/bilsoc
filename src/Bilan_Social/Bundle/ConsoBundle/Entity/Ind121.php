<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind121 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id121;
    protected $totalParFiliere;
    protected $bilanSocialConsolide;

    protected $refCadreEmploi;

    protected $idFili;
    protected $cdFili;
    protected $lbFili;
    protected $newFiliere;
    protected $lastFiliere;


    /**
     * @var integer
     */

    protected $r1211;

    /**
     * @var integer
     */
    protected $r1212;

    /**
     * @var integer
     */
    protected $r1213;

    /**
     * @var integer
     */
    protected $r1214;

    /**
     * @var integer
     */
    protected $r1215;

    /**
     * @var integer
     */
    protected $r1216;

    /**
     * @var integer
     */
    protected $r1217;

    /**
     * @var integer
     */
    protected $r1218;

    /**
     * @var integer
     */
    protected $r1219;

    /**
     * @var integer
     */
    protected $r12110;

    /**
     * @var integer
     */
    protected $r12111;

    /**
     * @var integer
     */
    protected $r12112;

    /**
     * @var integer
     */
    protected $r12113;

    /**
     * @var integer
     */
    protected $r12114;

    /**
     * @var integer
     */
    protected $r12115;

    /**
     * @var integer
     */
    protected $r12116;

    /**
     * @var integer
     */
    protected $r12117;

    /**
     * @var integer
     */
    protected $r12118;



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
            $this->r1211 = 0;
            $this->r1212 = 0;
            $this->r1213 = 0;
            $this->r1214 = 0;
            $this->r1215 = 0;
            $this->r1216 = 0;
            $this->r1217 = 0;
            $this->r1218 = 0;
            $this->r1219 = 0;
            $this->r12110 = 0;
            $this->r12111 = 0;
            $this->r12112 = 0;
            $this->r12113 = 0;
            $this->r12114 = 0;
            $this->r12115 = 0;
            $this->r12116 = 0;
            $this->r12117 = 0;
            $this->r12118 = 0;
        }
    }

    public function cumulR121x($r121xField) {
        $this->r1211 += $r121xField->getR1211(0);
        $this->r1212 += $r121xField->getR1212(0);
        $this->r1213 += $r121xField->getR1213(0);
        $this->r1214 += $r121xField->getR1214(0);
        $this->r1215 += $r121xField->getR1215(0);
        $this->r1216 += $r121xField->getR1216(0);
        $this->r1217 += $r121xField->getR1217(0);
        $this->r1218 += $r121xField->getR1218(0);
        $this->r1219 += $r121xField->getR1219(0);
        $this->r12110 += $r121xField->getR12110(0);
        $this->r12111 += $r121xField->getR12111(0);
        $this->r12112 += $r121xField->getR12112(0);
        $this->r12113 += $r121xField->getR12113(0);
        $this->r12114 += $r121xField->getR12114(0);
        $this->r12115 += $r121xField->getR12115(0);
        $this->r12116 += $r121xField->getR12116(0);
        $this->r12117 += $r121xField->getR12117(0);
        $this->r12118 += $r121xField->getR12118(0);
        return $this;
    }

    function getId121() {
        return $this->id121;
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

    function getR1211(int $ifNull = null) {
        return $this->r1211 ?? $ifNull;
    }

    function getR1212(int $ifNull = null) {
        return $this->r1212 ?? $ifNull;
    }

    function getR1213(int $ifNull = null) {
        return $this->r1213 ?? $ifNull;
    }

    function getR1214(int $ifNull = null) {
        return $this->r1214 ?? $ifNull;
    }

    function getR1215(int $ifNull = null) {
        return $this->r1215 ?? $ifNull;
    }

    function getR1216(int $ifNull = null) {
        return $this->r1216 ?? $ifNull;
    }

    function getR1217(int $ifNull = null) {
        return $this->r1217 ?? $ifNull;
    }

    function getR1218(int $ifNull = null) {
        return $this->r1218 ?? $ifNull;
    }

    function getR1219(int $ifNull = null) {
        return $this->r1219 ?? $ifNull;
    }

    function getR12110(int $ifNull = null) {
        return $this->r12110 ?? $ifNull;
    }

    function getR12111(int $ifNull = null) {
        return $this->r12111 ?? $ifNull;
    }

    function getR12112(int $ifNull = null) {
        return $this->r12112 ?? $ifNull;
    }

    function getR12113(int $ifNull = null) {
        return $this->r12113 ?? $ifNull;
    }

    function getR12114(int $ifNull = null) {
        return $this->r12114 ?? $ifNull;
    }

    function getR12115(int $ifNull = null) {
        return $this->r12115 ?? $ifNull;
    }

    function getR12116(int $ifNull = null) {
        return $this->r12116 ?? $ifNull;
    }

    function getR12117(int $ifNull = null) {
        return $this->r12117 ?? $ifNull;
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

    function setId121($id121) {
        $this->id121 = $id121;
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

    function setR1211($r1211) {
        $this->r1211 = $r1211;
    }

    function setR1212($r1212) {
        $this->r1212 = $r1212;
    }

    function setR1213($r1213) {
        $this->r1213 = $r1213;
    }

    function setR1214($r1214) {
        $this->r1214 = $r1214;
    }

    function setR1215($r1215) {
        $this->r1215 = $r1215;
    }

    function setR1216($r1216) {
        $this->r1216 = $r1216;
    }

    function setR1217($r1217) {
        $this->r1217 = $r1217;
    }

    function setR1218($r1218) {
        $this->r1218 = $r1218;
    }

    function setR1219($r1219) {
        $this->r1219 = $r1219;
    }

    function setR12110($r12110) {
        $this->r12110 = $r12110;
    }

    function setR12111($r12111) {
        $this->r12111 = $r12111;
    }

    function setR12112($r12112) {
        $this->r12112 = $r12112;
    }

    function setR12113($r12113) {
        $this->r12113 = $r12113;
    }

    function setR12114($r12114) {
        $this->r12114 = $r12114;
    }

    function setR12115($r12115) {
        $this->r12115 = $r12115;
    }

    function setR12116($r12116) {
        $this->r12116 = $r12116;
    }

    function setR12117($r12117) {
        $this->r12117 = $r12117;
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

    function getR12118(int $ifNull = null) {
        return $this->r12118 ?? $ifNull;
    }

    function setR12118($r12118) {
        $this->r12118 = $r12118;
    }

    function getTotalParFiliere() {
        return $this->totalParFiliere + $this->r1211 + $this->r1212 + $this->r1213 + $this->r1214 + $this->r1215 + $this->r1216 + $this->r1217 + $this->r1218
                 + $this->r12118;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

}
