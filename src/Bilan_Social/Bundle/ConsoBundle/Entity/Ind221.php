<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind221 extends  IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id221;

    protected $bilanSocialConsolide;

    protected $refCycleTravail;

    protected $newGroupe;

    protected $lastGroupe;

    /**
     * @var integer
     */
    protected $r2211;

    /**
     * @var integer
     */
    protected $r2212;


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



    public function getId221()
    {
        return $this->id221;
    }

    public function setR2211($r2211)
    {
        $this->r2211 = $r2211;

        return $this;
    }

    public function getR2211(int $ifNull = null)
    {
        return $this->r2211 ?? $ifNull;
    }

    public function setR2212($r2212)
    {
        $this->r2212 = $r2212;

        return $this;
    }

    public function getR2212(int $ifNull = null)
    {
        return $this->r2212 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind221
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
     * @return Ind221
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
     * @return Ind221
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
     * @return Ind221
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


    function getRefCycleTravail() {
        return $this->refCycleTravail;
    }

    function setRefCycleTravail($refCycleTravail) {
        $this->refCycleTravail = $refCycleTravail;
    }

    function getNewGroupe() {
        return $this->newGroupe;
    }

    function getLastGroupe() {
        return $this->lastGroupe;
    }

    function setNewGroupe($newGroupe) {
        $this->newGroupe = $newGroupe;
    }

    function setLastGroupe($lastGroupe) {
        $this->lastGroupe = $lastGroupe;
    }




}
