<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

/**
 * BscRassctInformationCollectivite
 */
class BscRassctInformationCollectivite
{
    /**
     * @var boolean
     */
    private $rassctExistEvalRPS;

    /**
     * @var boolean
     */
    private $rassctMajEvalRPS;

    /**
     * @var boolean
     */
    private $rassctDiagRPS;

    /**
     * @var boolean
     */
    private $rassctExistPrevActionSante;

    /**
     * @var boolean
     */
    private $rassctActiMedecPrev;

    /**
     * @var boolean
     */
    private $rassctDesiACFI;

    /**
     * @var integer
     */
    private $rassctNbVisitACFI;

    /**
     * @var integer
     */
    private $rassctNbCtChsct;

    /**
     * @var boolean
     */
    private $rassctExistPrevEntreExte;

    /**
     * @var boolean
     */
    private $rassctExistDiagPeniAnnex;

    /**
     * @var boolean
     */
    private $rassctNeceFicheSuiviFact;

    /**
     * @var boolean
     */
    private $rassctExistFicheExpoPeni;

    /**
     * @var boolean
     */
    private $rassctNeceFicheAmiante;

    /**
     * @var boolean
     */
    private $rassctExistFicheAmiante;

    /**
     * @var integer
     */
    private $idBscRassctInformationCollectivite;

    /**
     * @var \Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide
     */
    private $bilanSocialConsolide;


    /**
     * Set rassctExistEvalRPS
     *
     * @param boolean $rassctExistEvalRPS
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctExistEvalRPS($rassctExistEvalRPS)
    {
        $this->rassctExistEvalRPS = $rassctExistEvalRPS;

        return $this;
    }

    /**
     * Get rassctExistEvalRPS
     *
     * @return boolean
     */
    public function getRassctExistEvalRPS()
    {
        return $this->rassctExistEvalRPS;
    }

    /**
     * Set rassctMajEvalRPS
     *
     * @param boolean $rassctMajEvalRPS
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctMajEvalRPS($rassctMajEvalRPS)
    {
        $this->rassctMajEvalRPS = $rassctMajEvalRPS;

        return $this;
    }

    /**
     * Get rassctMajEvalRPS
     *
     * @return boolean
     */
    public function getRassctMajEvalRPS()
    {
        return $this->rassctMajEvalRPS;
    }

    /**
     * Set rassctDiagRPS
     *
     * @param boolean $rassctDiagRPS
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctDiagRPS($rassctDiagRPS)
    {
        $this->rassctDiagRPS = $rassctDiagRPS;

        return $this;
    }

    /**
     * Get rassctDiagRPS
     *
     * @return boolean
     */
    public function getRassctDiagRPS()
    {
        return $this->rassctDiagRPS;
    }

    /**
     * Set rassctExistPrevActionSante
     *
     * @param boolean $rassctExistPrevActionSante
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctExistPrevActionSante($rassctExistPrevActionSante)
    {
        $this->rassctExistPrevActionSante = $rassctExistPrevActionSante;

        return $this;
    }

    /**
     * Get rassctExistPrevActionSante
     *
     * @return boolean
     */
    public function getRassctExistPrevActionSante()
    {
        return $this->rassctExistPrevActionSante;
    }

    /**
     * Set rassctActiMedecPrev
     *
     * @param boolean $rassctActiMedecPrev
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctActiMedecPrev($rassctActiMedecPrev)
    {
        $this->rassctActiMedecPrev = $rassctActiMedecPrev;

        return $this;
    }

    /**
     * Get rassctActiMedecPrev
     *
     * @return boolean
     */
    public function getRassctActiMedecPrev()
    {
        return $this->rassctActiMedecPrev;
    }

    /**
     * Set rassctDesiACFI
     *
     * @param boolean $rassctDesiACFI
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctDesiACFI($rassctDesiACFI)
    {
        $this->rassctDesiACFI = $rassctDesiACFI;

        return $this;
    }

    /**
     * Get rassctDesiACFI
     *
     * @return boolean
     */
    public function getRassctDesiACFI()
    {
        return $this->rassctDesiACFI;
    }

    /**
     * Set rassctNbVisitACFI
     *
     * @param integer $rassctNbVisitACFI
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctNbVisitACFI($rassctNbVisitACFI)
    {
        $this->rassctNbVisitACFI = $rassctNbVisitACFI;

        return $this;
    }

    /**
     * Get rassctNbVisitACFI
     *
     * @return integer
     */
    public function getRassctNbVisitACFI()
    {
        return $this->rassctNbVisitACFI;
    }

    /**
     * Set rassctNbCtChsct
     *
     * @param integer $rassctNbCtChsct
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctNbCtChsct($rassctNbCtChsct)
    {
        $this->rassctNbCtChsct = $rassctNbCtChsct;

        return $this;
    }

    /**
     * Get rassctNbCtChsct
     *
     * @return integer
     */
    public function getRassctNbCtChsct()
    {
        return $this->rassctNbCtChsct;
    }

    /**
     * Set rassctExistPrevEntreExte
     *
     * @param boolean $rassctExistPrevEntreExte
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctExistPrevEntreExte($rassctExistPrevEntreExte)
    {
        $this->rassctExistPrevEntreExte = $rassctExistPrevEntreExte;

        return $this;
    }

    /**
     * Get rassctExistPrevEntreExte
     *
     * @return boolean
     */
    public function getRassctExistPrevEntreExte()
    {
        return $this->rassctExistPrevEntreExte;
    }

    /**
     * Set rassctExistDiagPeniAnnex
     *
     * @param boolean $rassctExistDiagPeniAnnex
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctExistDiagPeniAnnex($rassctExistDiagPeniAnnex)
    {
        $this->rassctExistDiagPeniAnnex = $rassctExistDiagPeniAnnex;

        return $this;
    }

    /**
     * Get rassctExistDiagPeniAnnex
     *
     * @return boolean
     */
    public function getRassctExistDiagPeniAnnex()
    {
        return $this->rassctExistDiagPeniAnnex;
    }

    /**
     * Set rassctNeceFicheSuiviFact
     *
     * @param boolean $rassctNeceFicheSuiviFact
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctNeceFicheSuiviFact($rassctNeceFicheSuiviFact)
    {
        $this->rassctNeceFicheSuiviFact = $rassctNeceFicheSuiviFact;

        return $this;
    }

    /**
     * Get rassctNeceFicheSuiviFact
     *
     * @return boolean
     */
    public function getRassctNeceFicheSuiviFact()
    {
        return $this->rassctNeceFicheSuiviFact;
    }

    /**
     * Set rassctExistFicheExpoPeni
     *
     * @param boolean $rassctExistFicheExpoPeni
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctExistFicheExpoPeni($rassctExistFicheExpoPeni)
    {
        $this->rassctExistFicheExpoPeni = $rassctExistFicheExpoPeni;

        return $this;
    }

    /**
     * Get rassctExistFicheExpoPeni
     *
     * @return boolean
     */
    public function getRassctExistFicheExpoPeni()
    {
        return $this->rassctExistFicheExpoPeni;
    }

    /**
     * Set rassctNeceFicheAmiante
     *
     * @param boolean $rassctNeceFicheAmiante
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctNeceFicheAmiante($rassctNeceFicheAmiante)
    {
        $this->rassctNeceFicheAmiante = $rassctNeceFicheAmiante;

        return $this;
    }

    /**
     * Get rassctNeceFicheAmiante
     *
     * @return boolean
     */
    public function getRassctNeceFicheAmiante()
    {
        return $this->rassctNeceFicheAmiante;
    }

    /**
     * Set rassctExistFicheAmiante
     *
     * @param boolean $rassctExistFicheAmiante
     *
     * @return BscRassctInformationCollectivite
     */
    public function setRassctExistFicheAmiante($rassctExistFicheAmiante)
    {
        $this->rassctExistFicheAmiante = $rassctExistFicheAmiante;

        return $this;
    }

    /**
     * Get rassctExistFicheAmiante
     *
     * @return boolean
     */
    public function getRassctExistFicheAmiante()
    {
        return $this->rassctExistFicheAmiante;
    }

    /**
     * Get idBscRassctInformationCollectivite
     *
     * @return integer
     */
    public function getIdBscRassctInformationCollectivite()
    {
        return $this->idBscRassctInformationCollectivite;
    }

    /**
     * Set bilanSocialConsolide
     *
     * @param \Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide $bilanSocialConsolide
     *
     * @return BscRassctInformationCollectivite
     */
    public function setBilanSocialConsolide(\Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide $bilanSocialConsolide)
    {
        $this->bilanSocialConsolide = $bilanSocialConsolide;

        return $this;
    }

    /**
     * Get bilanSocialConsolide
     *
     * @return \Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide
     */
    public function getBilanSocialConsolide()
    {
        return $this->bilanSocialConsolide;
    }
}

