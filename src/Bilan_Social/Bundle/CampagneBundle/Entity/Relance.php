<?php

namespace Bilan_Social\Bundle\CampagneBundle\Entity;

/**
 * Relance
 */
class Relance
{
    /**
     * @var integer
     */
    private $idRela;
            
    private $campagne;
    
    private $cdg;
            
    private $enquete;
    
    private $collectivite;
    
    private $lbMessrela;
    
    /**
     * @var \DateTime
     */
    private $dtDernrela;
    
    function getCampagne() {
        return $this->campagne;
    }

    function setCampagne($campagne) {
        $this->campagne = $campagne;
    }

    function getCdg($cdg) {
        return $this->cdg = $cdg;
    }

    function setCdg($cdg) {
        $this->cdg = $cdg;
    }
    
    function getEnquete() {
        return $this->enquete;
    }

    function setEnquete($enquete) {
        $this->enquete = $enquete;
    }

    function getCollectivite($collectivite) {
        return $this->collectivite = $collectivite;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }
    
    function getLbMessrela(){
        return $this->lbMessrela;
    }
    
    function setLbMessrela($lbMessrela){
        $this->lbMessrela = $lbMessrela;
    }

    /**
     * Set dtDernrela
     *
     * @param \DateTime $dtDernrela
     *
     * @return Relance
     */
    public function setDtDernrela($dtDernrela) {
        $this->dtDernrela = $dtDernrela;

        return $this;
    }

    /**
     * Get dtDernrela
     *
     * @return \DateTime
     */
    public function getDtDernrela() {
        return $this->dtDernrela;
    }
    
    /**
     * Get idRela
     *
     * @return integer
     */
    public function getIdRela()
    {
        return $this->idRela;
    }
    
    
}
