<?php

namespace Bilan_Social\Bundle\UserBundle\Entity;

use Bilan_Social\Bundle\CoreBundle\Entity\AbstractEntity;

class Profil extends AbstractEntity
{
    /**
     * @var int
     */
    private $idProfil;

    /**
     * @var string
     */
    private $nomProfil;


    private $exportsAdmin;

    private $utilisateurs;


    /**
     * Constructor
     */
    public function __construct() {
        $this->nomProfil = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exportsAdmin = new \Doctrine\Common\Collections\ArrayCollection();
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
    }

  
    /**
     * Get idProfil
     *
     * @return int
     */
    public function getIdProfil()
    {
        return $this->idProfil;
    }

    /**
     * Set nomProfil
     *
     * @param string $nomProfil
     *
     * @return Profil
     */
    public function setNomProfil($nomProfil)
    {
        $this->nomProfil = $nomProfil;

        return $this;
    }

    /**
     * Get nomProfil
     *
     * @return string
     */
    public function getNomProfil()
    {
        return $this->nomProfil;
    }

    public function setExportsAdmin($exportsAdmin)
    {
        $this->exportsAdmin = $exportsAdmin;

        return $this;
    }

    public function getExportsAdmin(){
        return $this->exportsAdmin; 
    }
    
    public function addExportsAdmin($exportsAdmin){
        $this->getExportsAdmin()->add($exportsAdmin);
    }

    public function removeExportsAdmin($exportsAdmin){
        $this->getExportsAdmin()->removeElement($exportsAdmin);
    }

    /**
     * Add utilisateur
     *
     * @param Bilan_Social\Bundle\UserBundle\Entity\Profil $utilisateur
     *
     * @return Retourne la liste des utilisateurs associés à un Profil
     */
    public function addUtilisateur(\Bilan_Social\Bundle\UserBundle\Entity\Profil $utilisateur) {
        $this->utilisateurs[] = $utilisateur;
        return $this;
    }

    /**
     * Remove utilisateur
     *
     * @param Bilan_Social\Bundle\UserBundle\Entity\Profil $utilisateur
     */
    public function removeUtilisateur(\Bilan_Social\Bundle\UserBundle\Entity\Profil $utilisateur) {
        $this->utilisateurs->removeElement($utilisateur);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurs() {
        return $this->utilisateurs;
    }  

    public function __toString() {
        return (string) $this->nomProfil;
    }


}

