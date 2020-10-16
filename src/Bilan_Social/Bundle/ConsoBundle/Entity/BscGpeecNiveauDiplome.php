<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

/**
 * BscGpeecNiveauDiplome
 */
class BscGpeecNiveauDiplome
{
    /**
     * @var int
     */
    private $bscGpeecNiveauDiplome;
    
    
    private $bilanSocialConsolide;
    
    private $refDomaineDiplome;

    /**
     * @var int
     */
    private $nbHommes;

    /**
     * @var int
     */
    private $nbFemmes;
    
     /**
     * @var string
     */
    private $fgStat;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
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
     * Get bscGpeecNiveauDiplome
     *
     * @return int
     */
    public function getBscGpeecNiveauDiplome()
    {
        return $this->bscGpeecNiveauDiplome;
    }

    /**
     * Set nbHommes
     *
     * @param integer $nbHommes
     *
     * @return BscGpeecNiveauDiplome
     */
    public function setNbHommes($nbHommes)
    {
        $this->nbHommes = $nbHommes;

        return $this;
    }

    /**
     * Get nbHommes
     *
     * @return int
     */
    public function getNbHommes()
    {
        return $this->nbHommes;
    }

    /**
     * Set nbFemmes
     *
     * @param integer $nbFemmes
     *
     * @return BscGpeecNiveauDiplome
     */
    public function setNbFemmes($nbFemmes)
    {
        $this->nbFemmes = $nbFemmes;

        return $this;
    }

    /**
     * Get nbFemmes
     *
     * @return int
     */
    public function getNbFemmes()
    {
        return $this->nbFemmes;
    }
    function getFgStat() {
        return $this->fgStat;
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

    function setFgStat($fgStat) {
        $this->fgStat = $fgStat;
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
    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }
    
    function getRefDomaineDiplome() {
        return $this->refDomaineDiplome;
    }

    function setRefDomaineDiplome($refDomaineDiplome) {
        $this->refDomaineDiplome = $refDomaineDiplome;
    }





}

