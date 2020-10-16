<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\UserBundle\Entity;

/**
 * Description of UtilisateurCdg
 *
 * @author djoncour
 */
class UtilisateurCdg {
    
    /**
     * @var Integer
     */
    private $idUtilisateurCdg;
    
    /**
     * @var \Bilan_Social\Bundle\UserBundle\Entity\User
     */
    private $utilisateur;
    
    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg
     */
    private $cdg;
    
    /**
     * Get idUtilisateurCdg
     *
     * @return Integer idUtilisateurCdg
     */
    function getIdUtilisateurCdg() {
        return $this->idUtilisateurCdg;
    }
    /**
     * Get utilisateur
     *
     * @return \Bilan_Social\Bundle\UserBundle\Entity\User utilisateur
     */
    function getUtilisateur() {
        return $this->utilisateur;
    }

    /**
     * Set utilisateur
     *
     * @param \Bilan_Social\Bundle\UserBundle\Entity\User
     *
     * @return Collectivite
     */
    function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }
    
    /**
     * Get cdg
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg cdg
     */
    function getCdg() {
        return $this->cdg;
    }

    /**
     * Set cdg
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg
     *
     * @return UtilisateurCdg
     */
    function setCdg($cdg) {
        $this->cdg = $cdg;
    }
}
