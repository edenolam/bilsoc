<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * Description of MotifSanctionDisciplinaire
 *
 * @author mbusson
 */
class MotifSanctionDisciplinaire {
    
    
    /**
     * @var integer
     */
    private $idMotifSanctionDisciplinaireAgent;

    /**
     * @var integer
     */
    private $nbAgentsH;

    /**
     * @var integer
     */
    private $nbAgentsF;

    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifSanctionDisciplinaire
     */
    private $RefMotifSanctionDisciplinaire;

    /**
     * @var \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent
     */
    private $idInfocollagen;
    
    function getIdMotifSanctionDisciplinaireAgent() {
        return $this->idMotifSanctionDisciplinaireAgent;
    }

    function getRefMotifSanctionDisciplinaire(): \Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifSanctionDisciplinaire {
        return $this->RefMotifSanctionDisciplinaire;
    }

    function getIdInfocollagen(): \Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent {
        return $this->idInfocollagen;
    }

    function setidMotifSanctionDisciplinaireAgent($idMotifSanctionDisciplinaireAgent) {
        $this->idMotifSanctionDisciplinaireAgent = $idMotifSanctionDisciplinaireAgent;
    }

    function setRefMotifSanctionDisciplinaire(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifSanctionDisciplinaire $RefMotifSanctionDisciplinaire) {
        $this->RefMotifSanctionDisciplinaire = $RefMotifSanctionDisciplinaire;
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
