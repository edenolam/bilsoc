<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * HistoriqueCollectivite
 */
class HistoriqueCollectivite
{
    /*
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */

    private $collectivite;

    /**
     * @var string
     */
    private $lbTypeArch;

    /**
     * @var string
     */
    private $nmAnciSire;

    /**
     * @var string
     */
    private $nmNouvSire;

    /**
     * @var string
     */
    private $nmSireAbso;

    /**
     * @var \DateTime
     */
    private $dtArch;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /*
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement
     */
    private $departement;

    /**
     * @var integer
     */
    private $idHistcoll;

    /*
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureMAJ
     */
    private $refNatureMAJ;


    /**
     * Set lbTypeArch
     *
     * @param string $lbTypeArch
     *
     * @return HistoriqueCollectivite
     */
    public function setLbTypeArch($lbTypeArch)
    {
        $this->lbTypeArch = $lbTypeArch;

        return $this;
    }

    /**
     * Get lbTypeArch
     *
     * @return string
     */
    public function getLbTypeArch()
    {
        return $this->lbTypeArch;
    }

    /**
     * Set nmAnciSire
     *
     * @param string $nmAnciSire
     *
     * @return HistoriqueCollectivite
     */
    public function setNmAnciSire($nmAnciSire)
    {
        $this->nmAnciSire = $nmAnciSire;

        return $this;
    }

    /**
     * Get nmAnciSire
     *
     * @return string
     */
    public function getNmAnciSire()
    {
        return $this->nmAnciSire;
    }

    /**
     * Set nmNouvSire
     *
     * @param string $nmNouvSire
     *
     * @return HistoriqueCollectivite
     */
    public function setNmNouvSire($nmNouvSire)
    {
        $this->nmNouvSire = $nmNouvSire;

        return $this;
    }

    /**
     * Get nmNouvSire
     *
     * @return string
     */
    public function getNmNouvSire()
    {
        return $this->nmNouvSire;
    }

    /**
     * Set nmSireAbso
     *
     * @param string $nmSireAbso
     *
     * @return HistoriqueCollectivite
     */
    public function setNmSireAbso($nmSireAbso)
    {
        $this->nmSireAbso = $nmSireAbso;

        return $this;
    }

    /**
     * Get nmSireAbso
     *
     * @return string
     */
    public function getNmSireAbso()
    {
        return $this->nmSireAbso;
    }

    /**
     * Set dtArch
     *
     * @param \DateTime $dtArch
     *
     * @return HistoriqueCollectivite
     */
    public function setDtArch($dtArch)
    {
        $this->dtArch = $dtArch;

        return $this;
    }

    /**
     * Get dtArch
     *
     * @return \DateTime
     */
    public function getDtArch()
    {
        return $this->dtArch;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return HistoriqueCollectivite
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
     *
     * @return HistoriqueCollectivite
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
     * Get idHistcoll
     *
     * @return integer
     */
    public function getIdHistcoll()
    {
        return $this->idHistcoll;
    }
    
    /**
     * Set collectivite
     *
     * @param Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return collectivite
     */
    public function setCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    public function getCollectivite() {
        return $this->collectivite;
    }

    /**
     * Set RefNatureMAJ
     *
     * @param Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureMAJ $refNatureMAJ
     *
     * @return refNatureMAJ
     */
    public function setRefNatureMAJ(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureMAJ $refNatureMAJ) {
        $this->refNatureMAJ = $refNatureMAJ;

        return $this;
    }

    /**
     * Get RefNatureMAJ
     *
     * @return Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureMAJ
     */
    public function getRefNatureMAJ() {
        return $this->refNatureMAJ;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @param mixed $departement
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;
    }


}
