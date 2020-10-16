<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind411
{
    /**
     * @var integer
     */
    private $id411;

    private $bilanSocialConsolide;
    private $refTypeMissionPrevention;
    private $idBilasocicons;

    /**
     * @var integer
     */
    private $r4111;



    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var string
     */
    private $cdUtilmodi;




    public function getId411()
    {
        return $this->id411;
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

    public function setR4111($r4111)
    {
        $this->r4111 = $r4111;

        return $this;
    }

    public function getR4111(int $ifNull = null)
    {
        return $this->r4111 ?? $ifNull;
    }

 
    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind411
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
     * @return Ind411
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
     * @return Ind411
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
     * @return Ind411
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

    function getRefTypeMissionPrevention() {
        return $this->refTypeMissionPrevention;
    }

    function setRefTypeMissionPrevention($refTypeMissionPrevention) {
        $this->refTypeMissionPrevention = $refTypeMissionPrevention;
    }

}
