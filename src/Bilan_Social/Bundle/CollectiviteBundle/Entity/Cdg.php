<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * Cdg
 */
class Cdg
{
    /**
     * @var string
     */
    private $lbCdg;
    /**
     * @var string
     */
    private $nmCdg;
    /**
     * @var string
     */
    private $lbUrlmap;
    /**
     * @var boolean
     */
    private $blAffiespaanal;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var integer
     */
    private $idCdg;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $enquetes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contacts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cdgUtilisateurs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cdgDepartements;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cdgModelMails ;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cdgModelMailInterneApplis;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $actualites;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $modeleAnalyse;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $demandeAnalyse;

    /*
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\MessagePassword
     */

    private $messagePassword;
    
    private $pathLogo;
    
    private $fileKey;
    
    private $nameLogo;

    /**
     * Constructor
     */
    public function __construct() {
        $this->enquetes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdgUtilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdgDepartements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdgModelMails  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdgModelMailInterneApplis = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actualites = new \Doctrine\Common\Collections\ArrayCollection();
        
        $this->nameLogo = 'image_par_defaut.jpg';
        $this->pathLogo = 'chemin_par_defaut';
    }


    /**
     * Set lbCdg
     *
     * @param string $lbCdg
     *
     * @return Cdg
     */
    public function setLbCdg($lbCdg)
    {
        $this->lbCdg = $lbCdg;

        return $this;
    }

    /**
     * Get lbCdg
     *
     * @return string
     */
    public function getLbCdg()
    {
        return $this->lbCdg;
    }


    /**
     * Set nmCdg
     *
     * @param string $nmCdg
     *
     * @return Cdg
     */
    public function setNmCdg($nmCdg)
    {
        $this->nmCdg = $nmCdg;

        return $this;
    }

    /**
     * Get nmCdg
     *
     * @return string
     */
    public function getNmCdg()
    {
        return $this->nmCdg;
    }

    /**
     * Set blAffiespaanal
     *
     * @param boolean $blAffiespaanal
     *
     * @return Cdg
     */
    public function setBlAffiespaanal($blAffiespaanal)
    {
        $this->blAffiespaanal = $blAffiespaanal;

        return $this;
    }

    /**
     * Get blAffiespaanal
     *
     * @return boolean
     */
    public function getBlAffiespaanal()
    {
        return $this->blAffiespaanal;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return Cdg
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
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return Cdg
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
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return Cdg
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi()
    {
        return $this->cdUtilmodi;
    }

    /**
     * Set dtModi
     *
     * @param \DateTime $dtModi
     *
     * @return Cdg
     */
    public function setDtModi($dtModi)
    {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi()
    {
        return $this->dtModi;
    }

    /**
     * Get idCdg
     *
     * @return integer
     */
    public function getIdCdg()
    {
        return $this->idCdg;
    }

    /**
     * Add enquete
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent $enquete
     *
     * @return Retourne la liste des enquêtes d'un CDG
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
     * Add cdgUtilisateur
     *
     * @param Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg $cdgUtilisateur
     *
     * @return Retourne la liste des utilisateurs associés à un CDG
     */
    public function addCdgUtilisateur(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg $cdgUtilisateur) {
        $this->cdgUtilisateurs[] = $cdgUtilisateur;
        return $this;
    }
    /**
     * Add contact
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgContact $contact
     *
     * @return Retourne la liste des contacts d'un CDG
     */
    public function addContact(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgContact $contact) {
        $this->contacts[] = $contact;
        return $this;
    }

    /**
     * Remove cdgUtilisateur
     *
     * @param Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg $cdgUtilisateur
     */
    public function removeCdgUtilisateur(\Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg $cdgUtilisateur) {
        $this->cdgUtilisateurs->removeElement($cdgUtilisateur);
    }

    /**
     * Get cdgUtilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdgUtilisateurs() {
        return $this->cdgUtilisateurs;
    }

    /**
     * Add cdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     *
     * Méthode permettant d'ajouter un cdgDepartement à la liste des cdgdepartements d'un cdg
     */
    public function addCdgDepartement(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement) {
        $this->cdgDepartements[] = $cdgDepartement;
        return $this;
    }

    /**
     * Remove cdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     */
    public function removeCdgDepartement(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement) {
        $this->cdgDepartements->removeElement($cdgDepartement);
    }

    /**
     * Get cdgDepartements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdgDepartements() {
        return $this->cdgDepartements;
    }
    /**
     * Add cdgModelMails
     *
     * @param \Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg $cdgModelMails
     *
     */
    public function addCdgModelMail(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgModelMails ) {
        $this->cdgModelMails[] = $cdgModelMails;
        return $this;
    }

    /**
     * Remove cdgModelMails
     *
     * @param \Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg $cdgModelMails
     */
    public function removeCdgModelMail(\Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg $cdgModelMails) {
        $this->cdgModelMails->removeElement($cdgModelMails);
    }

    /**
     * Get cdgModelMails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdgModelMails() {
        return $this->cdgModelMails;
    }

    /**
     * Add cdgModelMailInterneApplis
     *
     * @param \Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg $cdgModelMailInterneApplis
     *
     */
    public function addCdgModelMailInterneApplis(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgModelMailInterneApplis) {
        $this->cdgModelMailInterneApplis[] = $cdgModelMailInterneApplis;
        return $this;
    }

    /**
     * Remove cdgModelMailInterneApplis
     *
     * @param \Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailCdg $cdgModelMailInterneApplis
     */
    public function removeCdgModelMailInterneApplis(\Bilan_Social\Bundle\ModelMailBundle\Entity\ModelMailInterneAppli $cdgModelMailInterneApplis) {
        $this->cdgModelMailInterneApplis->removeElement($cdgModelMailInterneApplis);
    }

    /**
     * Get cdgModelMailInterneApplis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getcdgModelMailInterneApplis() {
        return $this->cdgModelMailInterneApplis;
    }

    /*
     * Remove contact
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgContact $contact
     */
    public function removeContact(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgContact $contact) {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get enquetes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts() {
        return $this->contacts;

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
    
    function getMessagePassword() {
        return $this->messagePassword;
    }

    function setMessagePassword($messagePassword) {
        $this->messagePassword = $messagePassword;
    }
    function getPathLogo() {
        return $this->pathLogo;
    }

    function getNameLogo() {
        return $this->nameLogo;
    }

    function setPathLogo($pathLogo) {
        
        $this->pathLogo = $pathLogo;
    }

    function setNameLogo($nameLogo) {
        $this->nameLogo = $nameLogo;
    }

    function getModeleAnalyse() {
        return $this->modeleAnalyse;
    }

    function setModeleAnalyse($modeleAnalyse) {
        
        $this->modeleAnalyse = $modeleAnalyse;
    }

    function getDemandeAnalyse() {
        return $this->demandeAnalyse;
    }

    function setDemandeAnalyse($demandeAnalyse) {
        
        $this->demandeAnalyse = $demandeAnalyse;
    }
    function getFileKey() {
        return $this->fileKey;
    }

    function setFileKey($fileKey) {
        $this->fileKey = $fileKey;
    }




}
