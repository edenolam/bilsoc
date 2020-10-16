<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind344 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id344;

    protected $bilanSocialConsolide;
    protected $totalParFiliere;
    protected $refCadreEmploi;


    /**
     * @var integer
     */

    protected $r3441;

    /**
     * @var integer
     */
    protected $r3442;

    /**
     * @var integer
     */
    protected $r3443;

    /**
     * @var integer
     */
    protected $r3444;

    /**
     * @var integer
     */
    protected $r3445;

    /**
     * @var integer
     */
    protected $r3446;

    /**
     * @var integer
     */
    protected $r3447;

    /**
     * @var integer
     */
    protected $r3448;

    /**
     * @var integer
     */
    protected $r3449;

    /**
     * @var integer
     */
    protected $r34410;

    /**
     * @var integer
     */
    protected $r34411;

    /**
     * @var integer
     */
    protected $r34412;



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
            $this->r3441 = 0;
            $this->r3442 = 0;
            $this->r3443 = 0;
            $this->r3444 = 0;
            $this->r3445 = 0;
            $this->r3446 = 0;
            $this->r3447 = 0;
            $this->r3448 = 0;
            $this->r3449 = 0;
            $this->r34410 = 0;
            $this->r34411 = 0;
            $this->r34412 = 0;
        }
    }

    public function cumulR344x($r344xField) {
        $this->r3441 += $r344xField->getR3441(0);
        $this->r3442 += $r344xField->getR3442(0);
        $this->r3443 += $r344xField->getR3443(0);
        $this->r3444 += $r344xField->getR3444(0);
        $this->r3445 += $r344xField->getR3445(0);
        $this->r3446 += $r344xField->getR3446(0);
        $this->r3447 += $r344xField->getR3447(0);
        $this->r3448 += $r344xField->getR3448(0);
        $this->r3449 += $r344xField->getR3449(0);
        $this->r34410 += $r344xField->getR34410(0);
        $this->r34411 += $r344xField->getR34411(0);
        $this->r34412 += $r344xField->getR34412(0);
        return $this;
    }

    public function initR344xToNull() {
        $this->r3441 = null;
        $this->r3442 = null;
        $this->r3443 = null;
        $this->r3444 = null;
        $this->r3445 = null;
        $this->r3446 = null;
        $this->r3447 = null;
        $this->r3448 = null;
        $this->r3449 = null;
        $this->r34410 = null;
        $this->r34411 = null;
        $this->r34412 = null;
    }

    public function initR344x($r344xField) {
        $this->r3441 = $r344xField->getR3441();
        $this->r3442 = $r344xField->getR3442();
        $this->r3443 = $r344xField->getR3443();
        $this->r3444 = $r344xField->getR3444();
        $this->r3445 = $r344xField->getR3445();
        $this->r3446 = $r344xField->getR3446();
        $this->r3447 = $r344xField->getR3447();
        $this->r3448 = $r344xField->getR3448();
        $this->r3449 = $r344xField->getR3449();
        $this->r34410 = $r344xField->getR34410();
        $this->r34411 = $r344xField->getR34411();
        $this->r34412 = $r344xField->getR34412();
    }

    public function initR344xCheckId($r344xField) {
        if ($this->id344 == $r344xField->getId344()) {
            $this->initR344x($r344xField);
        }
    }

    function getId344() {
        return $this->id344;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefCadreEmploi() {
        return $this->refCadreEmploi;
    }

    function getR3441(int $ifNull = null) {
        return $this->r3441 ?? $ifNull;
    }

    function getR3442(int $ifNull = null) {
        return $this->r3442 ?? $ifNull;
    }

    function getR3443(int $ifNull = null) {
        return $this->r3443 ?? $ifNull;
    }

    function getR3444(int $ifNull = null) {
        return $this->r3444 ?? $ifNull;
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

    function setId344($id344) {
        $this->id344 = $id344;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefCadreEmploi($refCadreEmploi) {
        $this->refCadreEmploi = $refCadreEmploi;
    }

    function setR3441($r3441) {
        $this->r3441 = $r3441;
    }

    function setR3442($r3442) {
        $this->r3442 = $r3442;
    }

    function setR3443($r3443) {
        $this->r3443 = $r3443;
    }

    function setR3444($r3444) {
        $this->r3444 = $r3444;
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

    function getTotalParFiliere() {
        return $this->totalParFiliere + $this->r3441 + $this->r3442 + $this->r3443 + $this->r3444  + $this->r3445  + $this->r3446  + $this->r3447  + $this->r3448  +
            $this->r3449  + $this->r34410  + $this->r34411  + $this->r34412 ;
    }

    function setTotalParFiliere($totalParFiliere) {
        $this->totalParFiliere = $totalParFiliere;
    }

    public function getR3445(int $ifNull = null)
    {
        return $this->r3445 ?? $ifNull;
    }

    public function setR3445(int $r3445)
    {
        $this->r3445 = $r3445;
    }

    public function getR3446(int $ifNull = null)
    {
        return $this->r3446 ?? $ifNull;
    }

    public function setR3446(int $r3446)
    {
        $this->r3446 = $r3446;
    }

    public function getR3447(int $ifNull = null)
    {
        return $this->r3447 ?? $ifNull;
    }

    public function setR3447(int $r3447)
    {
        $this->r3447 = $r3447;
    }

    public function getR3448(int $ifNull = null)
    {
        return $this->r3448 ?? $ifNull;
    }

    public function setR3448(int $r3448)
    {
        $this->r3448 = $r3448;
    }

    public function getR3449(int $ifNull = null)
    {
        return $this->r3449 ?? $ifNull;
    }

    public function setR3449(int $r3449)
    {
        $this->r3449 = $r3449;
    }

    public function getR34410(int $ifNull = null)
    {
        return $this->r34410 ?? $ifNull;
    }

    public function setR34410(int $r34410)
    {
        $this->r34410 = $r34410;
    }

    public function getR34411(int $ifNull = null)
    {
        return $this->r34411 ?? $ifNull;
    }

    public function setR34411(int $r34411)
    {
        $this->r34411 = $r34411;
    }

    public function getR34412(int $ifNull = null)
    {
        return $this->r34412 ?? $ifNull;
    }

    public function setR34412(int $r34412)
    {
        $this->r34412 = $r34412;
    }

}
