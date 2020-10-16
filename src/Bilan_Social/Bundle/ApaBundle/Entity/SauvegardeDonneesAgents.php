<?php

namespace Bilan_Social\Bundle\ApaBundle\Entity;

/**
 * SauvegardeDonneesAgents
 */
class SauvegardeDonneesAgents {

    private $id;
    private $lbNom;
    private $lbPrenom;
    private $dateNaissance;
    private $idMetier;
    private $idDomaineDiplomeGpeec;
    private $blBoeth;
    private $idMesureInaptitudeEnCoursAnnee;
    private $idMesureInaptitudeAvantAnnee;
    private $idInaptitudeEnCoursAnnee;
    private $idInaptitudeAvantAnnee;
    private $idNatureHandicapBoeth;
    private $idCategorieBoeth;
    private $blAvisInaptitudeEnCours;
    private $blAvisInaptitudeAvant;
    private $idEnquete;
    private $idCollectivite;
    private $idSpecialite;

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getLbNom() {
        return $this->lbNom;
    }

    function getLbPrenom() {
        return $this->lbPrenom;
    }

    function getDateNaissance() {
        return $this->dateNaissance;
    }

    function getIdMetier() {
        return $this->idMetier;
    }

    function getIdDomaineDiplomeGpeec() {
        return $this->idDomaineDiplomeGpeec;
    }

    function getIdMesureInaptitudeEnCoursAnnee() {
        return $this->idMesureInaptitudeEnCoursAnnee;
    }

    function getIdMesureInaptitudeAvantAnnee() {
        return $this->idMesureInaptitudeAvantAnnee;
    }

    function getIdInaptitudeEnCoursAnnee() {
        return $this->idInaptitudeEnCoursAnnee;
    }

    function getIdInaptitudeAvantAnnee() {
        return $this->idInaptitudeAvantAnnee;
    }

    function getIdNatureHandicapBoeth() {
        return $this->idNatureHandicapBoeth;
    }

    function getIdCategorieBoeth() {
        return $this->idCategorieBoeth;
    }

    function getBlAvisInaptitudeEnCours() {
        return $this->blAvisInaptitudeEnCours;
    }

    function getBlAvisInaptitudeAvant() {
        return $this->blAvisInaptitudeAvant;
    }

    function setLbNom($lbNom) {
        $this->lbNom = $lbNom;
    }

    function setLbPrenom($lbPrenom) {
        $this->lbPrenom = $lbPrenom;
    }

    function setDateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    function setIdMetier($idMetier) {
        $this->idMetier = $idMetier;
    }

    function setIdDomaineDiplomeGpeec($idDomaineDiplomeGpeec) {
        $this->idDomaineDiplomeGpeec = $idDomaineDiplomeGpeec;
    }

    function setIdMesureInaptitudeEnCoursAnnee($idMesureInaptitudeEnCoursAnnee) {
        $this->idMesureInaptitudeEnCoursAnnee = $idMesureInaptitudeEnCoursAnnee;
    }

    function setIdMesureInaptitudeAvantAnnee($idMesureInaptitudeAvantAnnee) {
        $this->idMesureInaptitudeAvantAnnee = $idMesureInaptitudeAvantAnnee;
    }

    function setIdInaptitudeEnCoursAnnee($idInaptitudeEnCoursAnnee) {
        $this->idInaptitudeEnCoursAnnee = $idInaptitudeEnCoursAnnee;
    }

    function setIdInaptitudeAvantAnnee($idInaptitudeAvantAnnee) {
        $this->idInaptitudeAvantAnnee = $idInaptitudeAvantAnnee;
    }

    function setIdNatureHandicapBoeth($idNatureHandicapBoeth) {
        $this->idNatureHandicapBoeth = $idNatureHandicapBoeth;
    }

    function setIdCategorieBoeth($idCategorieBoeth) {
        $this->idCategorieBoeth = $idCategorieBoeth;
    }

    function setBlAvisInaptitudeEnCours($blAvisInaptitudeEnCours) {
        $this->blAvisInaptitudeEnCours = $blAvisInaptitudeEnCours;
    }

    function setBlAvisInaptitudeAvant($blAvisInaptitudeAvant) {
        $this->blAvisInaptitudeAvant = $blAvisInaptitudeAvant;
    }
    
    function getIdEnquete() {
        return $this->idEnquete;
    }

    function getIdCollectivite() {
        return $this->idCollectivite;
    }

    function setIdEnquete($idEnquete) {
        $this->idEnquete = $idEnquete;
    }

    function setIdCollectivite($idCollectivite) {
        $this->idCollectivite = $idCollectivite;
    }

    function getIdSpecialite() {
        return $this->idSpecialite;
    }

    function setIdSpecialite($idSpecialite) {
        $this->idSpecialite = $idSpecialite;
    }

    function getBlBoeth() {
        return $this->blBoeth;
    }

    function setBlBoeth($blBoeth) {
        $this->blBoeth = $blBoeth;
    }

}