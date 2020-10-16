<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bilan_Social\Bundle\FileManagerBundle\Entity;

/**
 * Fichier
 */
class Fichier {
    /**
     * @var integer
     */
    private $idFichier;
    
    /**
     * @var string
     */
    private $fileKey;
    
    /**
     * @var string
     */
    private $ownerKey;
    
    /**
     * @var integer
     */
    private $targetYear;
    
    /**
     * @var string
     */
    private $logicalFolder;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cdgDepartements;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $collectivites;
    
    /**
     * Transient fields
     */
    private $libelleError;
    
    private $document;
    
    private $fileName;
    
    private $storageDate;
    
    private $libelleStatut;
    
    private $statut;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->cdgDepartements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->collectivites = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set idFichier
     *
     * @param integer idFichier
     *
     * @return Fichier
     */
    public function setIdFichier($idFichier) {
        $this->idFichier = $idFichier;

        return $this;
    }

    /**
     * Get idFichier
     *
     * @return integer
     */
    public function getIdFichier() {
        return $this->idFichier;
    }
    
    /**
     * Set fileName
     *
     * @param string fileKey
     *
     * @return Fichier
     */
    public function setFileKey($fileKey) {
        $this->fileKey = $fileKey;

        return $this;
    }

    /**
     * Get fileKey
     *
     * @return string
     */
    public function getFileKey() {
        return $this->fileKey;
    }
    
    /**
     * Set fileHash
     *
     * @param integer targetYear
     *
     * @return Fichier
     */
    public function setTargetYear($targetYear) {
        $this->targetYear = $targetYear;

        return $this;
    }

    /**
     * Get targetYear
     *
     * @return integer
     */
    public function getTargetYear() {
        return $this->targetYear;
    }
    
    /**
     * Set ownerKey
     *
     * @param string ownerKey
     *
     * @return Fichier
     */
    public function setOwnerKey($ownerKey) {
        $this->ownerKey = $ownerKey;

        return $this;
    }

    /**
     * Get ownerKey
     *
     * @return integer
     */
    public function getOwnerKey() {
        return $this->ownerKey;
    }
    
    /**
     * Set logicalFolder
     *
     * @param string logicalFolder
     *
     * @return Fichier
     */
    public function setLogicalFolder($logicalFolder) {
        $this->logicalFolder = $logicalFolder;

        return $this;
    }

    /**
     * Get logicalFolder
     *
     * @return string
     */
    public function getLogicalFolder() {
        return $this->logicalFolder;
    }
    
    /**
     * Add CdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     *
     */
    public function addCdgDepartement(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement) {
        $this->cdgDepartements[] = $cdgDepartement;
        return $this;
    }

    /**
     * Remove CdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     */
    public function removeCdgDepartement(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement) {
        $this->cdgDepartements->removeElement($cdgDepartement);
    }

    /**
     * Get CdgDepartement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdgDepartements() {
        return $this->cdgDepartements;
    }
    
    /**
     * Add Collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     */
    public function addCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivites[] = $collectivite;
        return $this;
    }

    /**
     * Remove Collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     */
    public function removeCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivites->removeElement($collectivite);
    }

    /**
     * Get Collectivite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCollectivite() {
        return $this->collectivites;
    }
    
    function getDocument() {
        return $this->document;
    }

    function setDocument($document) {
        $this->document = $document;
    }
    
    function getFileName() {
        return $this->fileName;
    }

    function setFileName($fileName) {
        $this->fileName = $fileName;
    }

    function getLibelleError() {
        return $this->libelleError;
    }

    function setLibelleError($libelleError) {
        $this->libelleError = $libelleError;
    }
    
    function getStorageDate() {
        return $this->storageDate;
    }

    function setStorageDate($storageDate) {
        $this->storageDate = $storageDate;
    }

    function getLibelleStatut() {
        return $this->libelleStatut;
    }

    function setLibelleStatut($libelleStatut) {
        $this->libelleStatut = $libelleStatut;
    }
    
    function getStatut() {
        return $this->statut;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }
}
