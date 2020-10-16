<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind431 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id431;

    protected $bilanSocialConsolide;
    protected $refActeViolencePhysique;

    /**
     * @var integer
     */
    protected $idBilasocicons;

    /**
     * @var integer
     */
    protected $r43111;

    /**
     * @var integer
     */
    protected $r43112;


    /**
     * @var integer
     */
    protected $r43121;

    /**
     * @var integer
     */
    protected $r43122;

    /**
     * @var integer
     */
    protected $r43131;

    /**
     * @var integer
     */
    protected $r43132;


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




    public function getId431()
    {
        return $this->id431;
    }


    public function setIdBilasocicons($idBilasocicons)
    {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    public function getIdBilasocicons()
    {
        return $this->idBilasocicons;
    }

    public function setR43111($r43111)
    {
        $this->r43111 = $r43111;

        return $this;
    }

    public function getR43111(int $ifNull = null)
    {
        return $this->r43111 ?? $ifNull;
    }

    public function setR43112($r43112)
    {
        $this->r43112 = $r43112;

        return $this;
    }

    public function getR43112(int $ifNull = null)
    {
        return $this->r43112 ?? $ifNull;
    }

    public function setR43121($r43121)
    {
        $this->r43121 = $r43121;

        return $this;
    }

    public function getR43121(int $ifNull = null)
    {
        return $this->r43121 ?? $ifNull;
    }

    public function setR43122($r43122)
    {
        $this->r43122 = $r43122;

        return $this;
    }

    public function getR43122(int $ifNull = null)
    {
        return $this->r43122 ?? $ifNull;
    }

    public function setR43131($r43131)
    {
        $this->r43131 = $r43131;

        return $this;
    }

    public function getR43131(int $ifNull = null)
    {
        return $this->r43131 ?? $ifNull;
    }

    public function setR43132($r43132)
    {
        $this->r43132 = $r43132;

        return $this;
    }

    public function getR43132(int $ifNull = null)
    {
        return $this->r43132 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind431
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
     * @return Ind431
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
     * @return Ind431
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
     * @return Ind431
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

    function getRefActeViolencePhysique() {
        return $this->refActeViolencePhysique;
    }

    function setRefActeViolencePhysique($refActeViolencePhysique) {
        $this->refActeViolencePhysique = $refActeViolencePhysique;
    }

}
