<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Description of SanctionDisciplinaire
 *
 * @author mbusson
 */
class SanctionDisciplinaire {
    
    
    /**
     * @var integer
     */
    private $idSanctionDisciplinaireAgent;
    
    /**
     * @var integer
     */
    private $nbAgentsH;

    /**
     * @var integer
     */
    private $nbAgentsF;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSanctionDisciplinaire
     */
    private $RefSanctionDisciplinaire;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;
    
    function getIdSanctionDisciplinaireAgent() {
        return $this->idSanctionDisciplinaireAgent;
    }

    function getRefSanctionDisciplinaire(): \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSanctionDisciplinaire {
        return $this->RefSanctionDisciplinaire;
    }

    function getIdInfocollagen(): \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent {
        return $this->idInfocollagen;
    }

    function setIdSanctionDisciplinaireAgent($idSanctionDisciplinaireAgent) {
        $this->idSanctionDisciplinaireAgent = $idSanctionDisciplinaireAgent;
    }

    function setRefSanctionDisciplinaire(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefSanctionDisciplinaire $RefSanctionDisciplinaire) {
        $this->RefSanctionDisciplinaire = $RefSanctionDisciplinaire;
    }

    function setIdInfocollagen(\Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent $idInfocollagen) {
        $this->idInfocollagen = $idInfocollagen;
    }

    /**
     * @return int
     */
    public function getNbAgentsH()
    {
        return $this->nbAgentsH;
    }

    /**
     * @param int $nbAgentsH
     */
    public function setNbAgentsH($nbAgentsH)
    {
        $this->nbAgentsH = $nbAgentsH;
    }

    /**
     * @return int
     */
    public function getNbAgentsF()
    {
        return $this->nbAgentsF;
    }

    /**
     * @param int $nbAgentsF
     */
    public function setNbAgentsF($nbAgentsF)
    {
        $this->nbAgentsF = $nbAgentsF;
    }



}
