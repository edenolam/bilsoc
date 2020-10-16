<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind222 extends  IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id222;

    protected $bilanSocialConsolide;

    protected $refContrainteTravail;

    /**
     * @var integer
     */
    protected $idConttrav;

    /**
     * @var integer
     */
    protected $idBilasocicons;

    /**
     * @var integer
     */
    protected $r2221;

    /**
     * @var integer
     */
    protected $r2222;


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



    public function getId222()
    {
        return $this->id222;
    }

    public function setIdConttrav($idConttrav)
    {
        $this->idConttrav = $idConttrav;

        return $this;
    }

    public function getIdConttrav()
    {
        return $this->idConttrav;
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

    public function setR2221($r2221)
    {
        $this->r2221 = $r2221;

        return $this;
    }

    public function getR2221(int $ifNull = null)
    {
        return $this->r2221 ?? $ifNull;
    }

    public function setR2222($r2222)
    {
        $this->r2222 = $r2222;

        return $this;
    }

    public function getR2222(int $ifNull = null)
    {
        return $this->r2222 ?? $ifNull;
    }



    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind222
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
     * @return Ind222
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
     * @return Ind222
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
     * @return Ind222
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    function getRefContrainteTravail() {
        return $this->refContrainteTravail;
    }

    function setRefContrainteTravail($refContrainteTravail) {
        $this->refContrainteTravail = $refContrainteTravail;
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
}
