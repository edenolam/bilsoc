<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

use Symfony\Component\Validator\Constraint as Assert;

/**
 * Cdg
 */
class CdgDepartement
{
    /**
     * @var integer
     */
    private $idCdgDepartement;
    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg
     */
    private $cdg;

    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement
     */
    private $departement;

    /**
     * @var \DateTime
     */
    private $dateDebut;

    /**
     * @var \DateTime
     */
    private $dateFin;

    /**
     * @var String
     */
    private $fgType;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $utilisateurDroits;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $enquetes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $collectivites;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $actualites;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $fichiers;

    /**
     * Constructor
     */
    public function __construct() {
        $this->dateDebut = new \DateTime('1970-01-01');
        $this->dateFin = new \DateTime('2099-12-31');
        $this->fgType = "0";
        $this->utilisateurDroits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enquetes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->collectivites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fichiers = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set cdg
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg
     *
     */
    public function setCdg($cdg)
    {
        $this->cdg = $cdg;

        return $this;
    }

    /**
     * Get cdg
     *
     * @return Cdg
     */
    public function getCdg()
    {
        return $this->cdg;
    }

    /**
     * Set departement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement $departement
     *
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return Departement
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set dateFin
     *
     * @param Date $dateFin
     *
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return Date
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set dateDebut
     *
     * @param Date $dateDebut
     *
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return Date
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set fgType
     *
     * @param String $fgType
     *
     * Cette méthode permet de renseigner le type de la données CdgDepartement afin de savoir s'il s'agit d'un contact ou d'une liaison avec les utiliusateurs
     */
    public function setFgType($fgType)
    {
        $this->fgType = $fgType;

        return $this;
    }

    /**
     * Get fgType
     *
     * @return String
     */
    public function getFgType()
    {
        return $this->fgType;
    }

    /**
     * Add utilisateurDroit
     *
     * @param \Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits $utilisateurDroit
     *
     */
    public function addUtilisateurDroit(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits $utilisateurDroit) {
        $this->utilisateurDroits[] = $utilisateurDroit;

        return $this;
    }

    /**
     * Remove utilisateurDroit
     *
     * @param \Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits $utilisateurDroit
     */
    public function removeUtilisateurDroit(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits $utilisateurDroit) {
        $this->utilisateurDroits->removeElement($utilisateurDroit);
    }

    /**
     * Get collectivites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurDroits() {
        return $this->utilisateurDroits;
    }

    /**
     * Set idCdgDepartement
     *
     * @param Date $idCdgDepartement
     *
     */
    public function setIdCdgDepartement($idCdgDepartement)
    {
        $this->idCdgDepartement = $idCdgDepartement;

        return $this;
    }

    /**
     * Get idCdgDepartement
     *
     * @return integer
     */
    public function getIdCdgDepartement()
    {
        return $this->idCdgDepartement;
    }

    /**
     * Add enquete
     *
     * @param \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete
     *
     */
    public function addEnquete(\Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete) {
        $this->enquetes[] = $enquete;

        return $this;
    }

    /**
     * Remove enquete
     *
     * @param \Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete
     */
    public function removeEnquete(\Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $enquete) {
        $this->enquetes->removeElement($enquete);
    }

    /**
     * Get enquetes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnquetes() {
        return $this->enquetes;
    }

    /**
     * Add actualite
     *
     * @param \Bilan_Social\Bundle\ActualiteBundle\Entity\Actualite $actualites
     *
     */
    public function addActualite(\Bilan_Social\Bundle\ActualiteBundle\Entity\Actualite $actualites) {
        $this->actualites[] = $actualites;

        return $this;
    }

    /**
     * Remove actualite
     *
     * @param \Bilan_Social\Bundle\ActualiteBundle\Entity\Actualite $actualites
     */
    public function removeActualite(\Bilan_Social\Bundle\ActualiteBundle\Entity\Actualite $actualites) {
        $this->actualites->removeElement($actualites);
    }

    /**
     * Get actualites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActualites() {
        return $this->actualites;
    }

    function setActualites(\Doctrine\Common\Collections\Collection $actualites) {
        $this->actualites = $actualites;
    }

    
    /**
     * Get collectivites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCollectivites() {
        return $this->collectivites;
    }
    
    

    /**
     * Add fichier
     *
     * param \Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers
     *
     */
    public function addFichier(\Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers) {
        $this->fichiers[] = $fichiers;

        return $this;
    }

    /**
     * Remove fichier
     *
     * @param \Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers
     */
    public function removeFichier(\Bilan_Social\Bundle\FileManagerBundle\Entity\Fichier $fichiers) {
        $this->fichiers->removeElement($fichiers);
    }

    /**
     * Get fichiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFichiers() {
        return $this->fichiers;
    }

}
