<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind1103
{
    /**
     * @var integer
     */
    private $id1103;

    private $bilanSocialConsolide;

    private $refEmploiFonctionnel;

    /**
     * @var integer
     */
    private $r1101;

    /**
     * @var integer
     */
    private $r1102;
    
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


    /**
     * Get id1103
     *
     * @return integer
     */
    public function getId1103()
    {
        return $this->id1103;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind1103
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
     * Set r1101
     *
     * @param integer $r1101
     * @return Ind1101
     */
    public function setR1101($r1101)
    {
        $this->r1101 = $r1101;

        return $this;
    }

    /**
     * Get r1101
     *
     * @return integer
     */
    public function getR1101(int $ifNull = null)
    {
        return $this->r1101 ?? $ifNull;
    }

    /**
     * Set r1102
     *
     * @param integer $r1102
     * @return Ind1101
     */
    public function setR1102($r1102)
    {
        $this->r1102 = $r1102;

        return $this;
    }

    /**
     * Get r1102
     *
     * @return integer
     */
    public function getR1102(int $ifNull = null)
    {
        return $this->r1102 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind1101
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
     * @return Ind1101
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
     * @return Ind1101
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
     * @return Ind1101
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


    function getRefEmploiFonctionnel() {
        return $this->refEmploiFonctionnel;
    }

    function setRefEmploiFonctionnel($refEmploiFonctionnel) {
        $this->refEmploiFonctionnel = $refEmploiFonctionnel;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }




}
