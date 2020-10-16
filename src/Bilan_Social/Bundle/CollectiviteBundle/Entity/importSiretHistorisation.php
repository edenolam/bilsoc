<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * importSiretHistorisation
 */
class importSiretHistorisation
{
    /**
     * @var string
     */
    private $nmSire;

    /**
     * @var string
     */
    private $ancienSiret;

    /**
     * @var string
     */
    private $lbColl;

    /**
     * @var string
     */
    private $lbAdre;

    /**
     * @var integer
     */
    private $cdPost;

    /**
     * @var string
     */
    private $lbVill;

    /**
     * @var string
     */
    private $cdInse;

    /**
     * @var string
     */
    private $nmPopuInse;

    /**
     * @var string
     */
    private $lbZoneEmplColl;

    /**
     * @var string
     */
    private $idColl;

    /**
     * @var string
     */
    private $idTypeColl;

    /**
     * @var string
     */
    private $idCdgDepartement;

    /**
     * @var string
     */
    private $idDepa;

    /**
     * @var string
     */
    private $nmSireRata;

    /**
     * @var string
     */
    private $dtPopuInse;

    /**
     * @var boolean
     */
    private $blArchi;

    /**
     * @var string
     */
    private $dateMajSiret;

    /**
     * @var string
     */
    private $majSiret;

    /**
     * @var string
     */
    private $motif;

    /**
     * @var boolean
     */
    private $blPresent;

    /**
     * @var boolean
     */
    private $blConfirmed;

    /**
     * @var integer
     */
    private $id;


    private $blErreur;

    private $lbErreur;

    /**
     * Set nmSire
     *
     * @param string $nmSire
     *
     * @return importSiretHistorisation
     */
    public function setNmSire($nmSire)
    {
        $this->nmSire = $nmSire;

        return $this;
    }

    /**
     * Get nmSire
     *
     * @return string
     */
    public function getNmSire()
    {
        return $this->nmSire;
    }

    /**
     * Set ancienSiret
     *
     * @param string $ancienSiret
     *
     * @return importSiretHistorisation
     */
    public function setAncienSiret($ancienSiret)
    {
        $this->ancienSiret = $ancienSiret;

        return $this;
    }

    /**
     * Get ancienSiret
     *
     * @return string
     */
    public function getAncienSiret()
    {
        return $this->ancienSiret;
    }

    /**
     * Set lbColl
     *
     * @param string $lbColl
     *
     * @return importSiretHistorisation
     */
    public function setLbColl($lbColl)
    {
        $this->lbColl = $lbColl;

        return $this;
    }

    /**
     * Get lbColl
     *
     * @return string
     */
    public function getLbColl()
    {
        return $this->lbColl;
    }

    /**
     * Set lbAdre
     *
     * @param string $lbAdre
     *
     * @return importSiretHistorisation
     */
    public function setLbAdre($lbAdre)
    {
        $this->lbAdre = $lbAdre;

        return $this;
    }

    /**
     * Get lbAdre
     *
     * @return string
     */
    public function getLbAdre()
    {
        return $this->lbAdre;
    }

    /**
     * Set cdPost
     *
     * @param integer $cdPost
     *
     * @return importSiretHistorisation
     */
    public function setCdPost($cdPost)
    {
        $this->cdPost = $cdPost;

        return $this;
    }

    /**
     * Get cdPost
     *
     * @return integer
     */
    public function getCdPost()
    {
        return $this->cdPost;
    }

    /**
     * Set lbVill
     *
     * @param string $lbVill
     *
     * @return importSiretHistorisation
     */
    public function setLbVill($lbVill)
    {
        $this->lbVill = $lbVill;

        return $this;
    }

    /**
     * Get lbVill
     *
     * @return string
     */
    public function getLbVill()
    {
        return $this->lbVill;
    }

    /**
     * Set cdInse
     *
     * @param string $cdInse
     *
     * @return importSiretHistorisation
     */
    public function setCdInse($cdInse)
    {
        $this->cdInse = $cdInse;

        return $this;
    }

    /**
     * Get cdInse
     *
     * @return string
     */
    public function getCdInse()
    {
        return $this->cdInse;
    }

    /**
     * Set nmPopuInse
     *
     * @param string $nmPopuInse
     *
     * @return importSiretHistorisation
     */
    public function setNmPopuInse($nmPopuInse)
    {
        $this->nmPopuInse = $nmPopuInse;

        return $this;
    }

    /**
     * Get nmPopuInse
     *
     * @return string
     */
    public function getNmPopuInse()
    {
        return $this->nmPopuInse;
    }

    /**
     * Set lbZoneEmplColl
     *
     * @param string $lbZoneEmplColl
     *
     * @return importSiretHistorisation
     */
    public function setLbZoneEmplColl($lbZoneEmplColl)
    {
        $this->lbZoneEmplColl = $lbZoneEmplColl;

        return $this;
    }

    /**
     * Get lbZoneEmplColl
     *
     * @return string
     */
    public function getLbZoneEmplColl()
    {
        return $this->lbZoneEmplColl;
    }

    /**
     * Set idColl
     *
     * @param string $idColl
     *
     * @return importSiretHistorisation
     */
    public function setIdColl($idColl)
    {
        $this->idColl = $idColl;

        return $this;
    }

    /**
     * Get idColl
     *
     * @return string
     */
    public function getIdColl()
    {
        return $this->idColl;
    }

    /**
     * Set idTypeColl
     *
     * @param string $idTypeColl
     *
     * @return importSiretHistorisation
     */
    public function setIdTypeColl($idTypeColl)
    {
        $this->idTypeColl = $idTypeColl;

        return $this;
    }

    /**
     * Get idTypeColl
     *
     * @return string
     */
    public function getIdTypeColl()
    {
        return $this->idTypeColl;
    }

    /**
     * Set idCdgDepartement
     *
     * @param string $idCdgDepartement
     *
     * @return importSiretHistorisation
     */
    public function setIdCdgDepartement($idCdgDepartement)
    {
        $this->idCdgDepartement = $idCdgDepartement;

        return $this;
    }

    /**
     * Get idCdgDepartement
     *
     * @return string
     */
    public function getIdCdgDepartement()
    {
        return $this->idCdgDepartement;
    }

    /**
     * Set idDepa
     *
     * @param string $idDepa
     *
     * @return importSiretHistorisation
     */
    public function setIdDepa($idDepa)
    {
        $this->idDepa = $idDepa;

        return $this;
    }

    /**
     * Get idDepa
     *
     * @return string
     */
    public function getIdDepa()
    {
        return $this->idDepa;
    }

    /**
     * Set nmSireRata
     *
     * @param string $nmSireRata
     *
     * @return importSiretHistorisation
     */
    public function setNmSireRata($nmSireRata)
    {
        $this->nmSireRata = $nmSireRata;

        return $this;
    }

    /**
     * Get nmSireRata
     *
     * @return string
     */
    public function getNmSireRata()
    {
        return $this->nmSireRata;
    }

    /**
     * Set dtPopuInse
     *
     * @param string $dtPopuInse
     *
     * @return importSiretHistorisation
     */
    public function setDtPopuInse($dtPopuInse)
    {
        $this->dtPopuInse = $dtPopuInse;

        return $this;
    }

    /**
     * Get dtPopuInse
     *
     * @return string
     */
    public function getDtPopuInse()
    {
        return $this->dtPopuInse;
    }

    /**
     * Set blArchi
     *
     * @param boolean $blArchi
     *
     * @return importSiretHistorisation
     */
    public function setBlArchi($blArchi)
    {
        $this->blArchi = $blArchi;

        return $this;
    }

    /**
     * Get blArchi
     *
     * @return boolean
     */
    public function getBlArchi()
    {
        return $this->blArchi;
    }

    /**
     * Set dateMajSiret
     *
     * @param string $dateMajSiret
     *
     * @return importSiretHistorisation
     */
    public function setDateMajSiret($dateMajSiret)
    {
        $this->dateMajSiret = $dateMajSiret;

        return $this;
    }

    /**
     * Get dateMajSiret
     *
     * @return string
     */
    public function getDateMajSiret()
    {
        return $this->dateMajSiret;
    }

    /**
     * Set majSiret
     *
     * @param string $majSiret
     *
     * @return importSiretHistorisation
     */
    public function setMajSiret($majSiret)
    {
        $this->majSiret = $majSiret;

        return $this;
    }

    /**
     * Get majSiret
     *
     * @return string
     */
    public function getMajSiret()
    {
        return $this->majSiret;
    }

    /**
     * Set motif
     *
     * @param string $motif
     *
     * @return importSiretHistorisation
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif
     *
     * @return string
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * Set blPresent
     *
     * @param boolean $blPresent
     *
     * @return importSiretHistorisation
     */
    public function setBlPresent($blPresent)
    {
        $this->blPresent = $blPresent;

        return $this;
    }

    /**
     * Get blPresent
     *
     * @return boolean
     */
    public function getBlPresent()
    {
        return $this->blPresent;
    }

    /**
     * Set blConfirmed
     *
     * @param boolean $blConfirmed
     *
     * @return importSiretHistorisation
     */
    public function setBlConfirmed($blConfirmed)
    {
        $this->blConfirmed = $blConfirmed;

        return $this;
    }

    /**
     * Get blConfirmed
     *
     * @return boolean
     */
    public function getBlConfirmed()
    {
        return $this->blConfirmed;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getBlErreur()
    {
        return $this->blErreur;
    }

    public function getLbErreur()
    {
        return $this->lbErreur;
    }

    public function setBlErreur($blErreur)
    {
        $this->blErreur = $blErreur;
        return $this;
    }

    public function setLbErreur($lbErreur)
    {
        $this->lbErreur = $lbErreur;
        return $this;
    }

}

