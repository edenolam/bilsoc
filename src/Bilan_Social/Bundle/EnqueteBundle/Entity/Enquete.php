<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Enquete
 */
class Enquete {

    /**
     * @var integer
     */
    private $idCdg;

    /**
     * @var integer
     */
    private $idCamp;

    /**
     * @var Campagne
     */
    private $campagne;
    /**
     * @var string
     */
    private $lbEnqu;

    /**
     * @var string
     */
    private $cmDesc;

    /**
     * @var integer
     */
    private $nmAnne;

    /**
     * @var string
     */
    private $fgStat;

    /**
     * @var \DateTime
     * @Assert\Range(
     *      min = "first day of January",
     *      max = "first day of January next year"
     * )
     */
    private $dtDebu;

    /**
     * @var \DateTime
     */
    private $dtClot;

    /**
     * @var boolean
     */
    private $blRela;

    /**
     * @var \DateTime
     */
    private $dtRela;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
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
    
    private $blReinitPassword;

    /**
     * @var integer
     */
    private $idEnqu;
    private $blImport;
    private $blModi;
    private $reinitMdp;
    private $colonnes;
    private $filtres;
    private $parametres;
    private $conditions;
    private $blCloture;
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     */
    private $cdgDepartements;
    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     */
    private $departements;
    
//    public $state;
    public $marking;
    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg
     */
    //private $cdg;

    /**
     * Constructor
     */
    public function __construct() {
        $this->cdgDepartements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->departements = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context) {
        if($this->idEnqu == null){
            if ($this->departements->count()==0) {
                $context->buildViolation('Vous devez sélectionner au moins un département.')
                ->atPath('departements')
                ->addViolation();
            }
        }
     
    }
    
    public function getBlImport() {
        return $this->blImport;
    }

    public function setBlImport($blImport) {
        $this->blImport = $blImport;
        return $this;
    }

    public function getBlModi() {
        return $this->blImport;
    }

    public function setBlModi($blModi) {
        $this->blModi = $blModi;
        return $this;
    }

    public function getReinitMdp() {
        return $this->reinitMdp;
    }

    public function setReinitMdp($reinitMdp) {
        $this->reinitMdp = $reinitMdp;
        return $this;
    }

    public function getColonnes() {
        return $this->colonnes;
    }

    public function setColonnes($colonnes) {
        $this->colonnes = $colonnes;
        return $this;
    }

    public function getFiltres() {
        return $this->filtres;
    }

    public function setFiltres($filtres) {
        $this->filtres = $filtres;
        return $this;
    }

    public function getParametres() {
        return $this->parametres;
    }

    public function setParametres($parametres) {
        $this->parametres = $parametres;
        return $this;
    }

    public function getConditions() {
        return $this->conditions;
    }

    public function setConditions($conditions) {
        $this->conditions = $conditions;
        return $this;
    }

    /**
     * Set idCdg
     *
     * @param integer $idCdg
     *
     * @return Enquete
     */
    public function setIdCdg($idCdg) {
        $this->idCdg = $idCdg;

        return $this;
    }

    /**
     * Get idCdg
     *
     * @return integer
     */
    public function getIdCdg() {
        return $this->idCdg;
    }

    /**
     * Set idCamp
     *
     * @param integer $idCamp
     *
     * @return Enquete
     */
    public function setIdCamp($idCamp) {
        $this->idCamp = $idCamp;

        return $this;
    }

    /**
     * Get idCamp
     *
     * @return integer
     */
    public function getIdCamp() {
        return $this->idCamp;
    }

    /**
     * Set campagne
     *
     * @param Campagne $idCamp
     *
     * @return Enquete
     */
    public function setcampagne($campagne) {
        $this->campagne = $campagne;

        return $this;
    }

    /**
     * Get campagne
     *
     * @return campagne
     */
    public function getCampagne() {
        return $this->campagne;
    }

    /**
     * Set lbEnqu
     *
     * @param string $lbEnqu
     *
     * @return Enquete
     */
    public function setLbEnqu($lbEnqu) {
        $this->lbEnqu = $lbEnqu;

        return $this;
    }

    /**
     * Get lbEnqu
     *
     * @return string
     */
    public function getLbEnqu() {
        return $this->lbEnqu;
    }

    /**
     * Set cmDesc
     *
     * @param string $cmDesc
     *
     * @return Enquete
     */
    public function setCmDesc($cmDesc) {
        $this->cmDesc = $cmDesc;

        return $this;
    }

    /**
     * Get cmDesc
     *
     * @return string
     */
    public function getCmDesc() {
        return $this->cmDesc;
    }

    /**
     * Set nmAnne
     *
     * @param integer $nmAnne
     *
     * @return Enquete
     */
    public function setNmAnne($nmAnne) {
        $this->nmAnne = $nmAnne;

        return $this;
    }

    /**
     * Get nmAnne
     *
     * @return integer
     */
    public function getNmAnne() {
        return $this->nmAnne;
    }

    /**
     * Set fgStat
     *
     * @param string $fgStat
     *
     * @return Enquete
     */
    public function setFgStat($fgStat) {
        $this->fgStat = $fgStat;

        return $this;
    }

    /**
     * Get fgStat
     *
     * @return string
     */
    public function getFgStat() {
        return $this->fgStat;
    }

    /**
     * Set dtDebu
     *
     * @param \DateTime $dtDebu
     *
     * @return Enquete
     */
    public function setDtDebu($dtDebu) {
        $this->dtDebu = $dtDebu;

        return $this;
    }

    /**
     * Get dtDebu
     *
     * @return \DateTime
     */
    public function getDtDebu() {
        return $this->dtDebu;
    }

    /**
     * Set dtClot
     *
     * @param \DateTime $dtClot
     *
     * @return Enquete
     */
    public function setDtClot($dtClot) {
        $this->dtClot = $dtClot;

        return $this;
    }

    /**
     * Get dtClot
     *
     * @return \DateTime
     */
    public function getDtClot() {
        return $this->dtClot;
    }

    /**
     * Set blRela
     *
     * @param boolean $blRela
     *
     * @return Enquete
     */
    public function setBlRela($blRela) {
        $this->blRela = $blRela;

        return $this;
    }

    /**
     * Get blRela
     *
     * @return boolean
     */
    public function getBlRela() {
        return $this->blRela;
    }

    /**
     * Set dtRela
     *
     * @param \DateTime $dtRela
     *
     * @return Enquete
     */
    public function setDtRela($dtRela) {
        $this->dtRela = $dtRela;

        return $this;
    }

    /**
     * Get dtRela
     *
     * @return \DateTime
     */
    public function getDtRela() {
        return $this->dtRela;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     *
     * @return Enquete
     */
    public function setDtCrea($dtCrea) {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea() {
        return $this->dtCrea;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return Enquete
     */
    public function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    /**
     * Set dtModi
     *
     * @param \DateTime $dtModi
     *
     * @return Enquete
     */
    public function setDtModi($dtModi) {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi() {
        return $this->dtModi;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return Enquete
     */
    public function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    /**
     * Get idEnqu
     *
     * @return integer
     */
    public function getIdEnqu() {
        return $this->idEnqu;
    }

    /**
     * @var boolean
     */
    private $blBlCdgColl;
    
    /**
     * @var boolean
     */
    private $cdg_is_authorized_by_collectivity;

    /**
     * @var boolean
     */
    private $blIdTypeColl;

    /**
     * @var boolean
     */
    private $blIdDepa;

    /**
     * @var boolean
     */
    private $blLbColl;

    /**
     * @var boolean
     */
    private $blCdPost;

    /**
     * @var boolean
     */
    private $blLbVill;

    /**
     * @var boolean
     */
    private $blCdInse;

    /**
     * @var boolean
     */
    private $blNmSire;

    /**
     * @var boolean
     */
    private $blNmPopuInse;

    /**
     * @var boolean
     */
    private $blBlSurclasDemo;

    /**
     * @var boolean
     */
    private $blNmStratColl;

    /**
     * @var boolean
     */
    private $blBlAffiColl;

    /**
     * @var boolean
     */
    private $blBlCtCdg;

    /**
     * @var boolean
     */
    private $blChsct;

    /**
     * @var boolean
     */
    private $blBlCollDgcl;

    /**
     * Set blBlCdgColl
     *
     * @param boolean $blBlCdgColl
     *
     * @return Enquete
     */
    public function setBlBlCdgColl($blBlCdgColl) {
        $this->blBlCdgColl = $blBlCdgColl;

        return $this;
    }

    /**
     * Get blBlCdgColl
     *
     * @return boolean
     */
    public function getBlBlCdgColl() {
        return $this->blBlCdgColl;
    }

    /**
     * Set blIdTypeColl
     *
     * @param boolean $blIdTypeColl
     *
     * @return Enquete
     */
    public function setBlIdTypeColl($blIdTypeColl) {
        $this->blIdTypeColl = $blIdTypeColl;

        return $this;
    }

    /**
     * Get blIdTypeColl
     *
     * @return boolean
     */
    public function getBlIdTypeColl() {
        return $this->blIdTypeColl;
    }

    /**
     * Set blIdDepa
     *
     * @param boolean $blIdDepa
     *
     * @return Enquete
     */
    public function setBlIdDepa($blIdDepa) {
        $this->blIdDepa = $blIdDepa;

        return $this;
    }

    /**
     * Get blIdDepa
     *
     * @return boolean
     */
    public function getBlIdDepa() {
        return $this->blIdDepa;
    }

    /**
     * Set blLbColl
     *
     * @param boolean $blLbColl
     *
     * @return Enquete
     */
    public function setBlLbColl($blLbColl) {
        $this->blLbColl = $blLbColl;

        return $this;
    }

    /**
     * Get blLbColl
     *
     * @return boolean
     */
    public function getBlLbColl() {
        return $this->blLbColl;
    }

    /**
     * Set blCdPost
     *
     * @param boolean $blCdPost
     *
     * @return Enquete
     */
    public function setBlCdPost($blCdPost) {
        $this->blCdPost = $blCdPost;

        return $this;
    }

    /**
     * Get blCdPost
     *
     * @return boolean
     */
    public function getBlCdPost() {
        return $this->blCdPost;
    }

    /**
     * Set blLbVill
     *
     * @param boolean $blLbVill
     *
     * @return Enquete
     */
    public function setBlLbVill($blLbVill) {
        $this->blLbVill = $blLbVill;

        return $this;
    }

    /**
     * Get blLbVill
     *
     * @return boolean
     */
    public function getBlLbVill() {
        return $this->blLbVill;
    }

    /**
     * Set blCdInse
     *
     * @param boolean $blCdInse
     *
     * @return Enquete
     */
    public function setBlCdInse($blCdInse) {
        $this->blCdInse = $blCdInse;

        return $this;
    }

    /**
     * Get blCdInse
     *
     * @return boolean
     */
    public function getBlCdInse() {
        return $this->blCdInse;
    }

    /**
     * Set blNmSire
     *
     * @param boolean $blNmSire
     *
     * @return Enquete
     */
    public function setBlNmSire($blNmSire) {
        $this->blNmSire = $blNmSire;

        return $this;
    }

    /**
     * Get blNmSire
     *
     * @return boolean
     */
    public function getBlNmSire() {
        return $this->blNmSire;
    }

    /**
     * Set blNmPopuInse
     *
     * @param boolean $blNmPopuInse
     *
     * @return Enquete
     */
    public function setBlNmPopuInse($blNmPopuInse) {
        $this->blNmPopuInse = $blNmPopuInse;

        return $this;
    }

    /**
     * Get blNmPopuInse
     *
     * @return boolean
     */
    public function getBlNmPopuInse() {
        return $this->blNmPopuInse;
    }

    /**
     * Set blBlSurclasDemo
     *
     * @param boolean $blBlSurclasDemo
     *
     * @return Enquete
     */
    public function setBlBlSurclasDemo($blBlSurclasDemo) {
        $this->blBlSurclasDemo = $blBlSurclasDemo;

        return $this;
    }

    /**
     * Get blBlSurclasDemo
     *
     * @return boolean
     */
    public function getBlBlSurclasDemo() {
        return $this->blBlSurclasDemo;
    }

    /**
     * Set blNmStratColl
     *
     * @param boolean $blNmStratColl
     *
     * @return Enquete
     */
    public function setBlNmStratColl($blNmStratColl) {
        $this->blNmStratColl = $blNmStratColl;

        return $this;
    }

    /**
     * Get blNmStratColl
     *
     * @return boolean
     */
    public function getBlNmStratColl() {
        return $this->blNmStratColl;
    }

    /**
     * Set blBlAffiColl
     *
     * @param boolean $blBlAffiColl
     *
     * @return Enquete
     */
    public function setBlBlAffiColl($blBlAffiColl) {
        $this->blBlAffiColl = $blBlAffiColl;

        return $this;
    }

    /**
     * Get blBlAffiColl
     *
     * @return boolean
     */
    public function getBlBlAffiColl() {
        return $this->blBlAffiColl;
    }

    /**
     * Set blBlCtCdg
     *
     * @param boolean $blBlCtCdg
     *
     * @return Enquete
     */
    public function setBlBlCtCdg($blBlCtCdg) {
        $this->blBlCtCdg = $blBlCtCdg;

        return $this;
    }

    /**
     * Get blBlCtCdg
     *
     * @return boolean
     */
    public function getBlBlCtCdg() {
        return $this->blBlCtCdg;
    }

    /**
     * Set blChsct
     *
     * @param boolean $blChsct
     *
     * @return Enquete
     */
    public function setBlChsct($blChsct) {
        $this->blChsct = $blChsct;

        return $this;
    }

    /**
     * Get blChsct
     *
     * @return boolean
     */
    public function getBlChsct() {
        return $this->blChsct;
    }

    /**
     * Set blBlCollDgcl
     *
     * @param boolean $blBlCollDgcl
     *
     * @return Enquete
     */
    public function setBlBlCollDgcl($blBlCollDgcl) {
        $this->blBlCollDgcl = $blBlCollDgcl;

        return $this;
    }

    /**
     * Get blBlCollDgcl
     *
     * @return boolean
     */
    public function getBlBlCollDgcl() {
        return $this->blBlCollDgcl;
    }
    
    /**
     * Set cdg
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg
     *
     * @return RefGrade
     */
//    public function setCdg(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg) {
//        $this->cdg = $cdg;
//
//        return $this;
//    }

    /**
     * Get cdg
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg
     */
//    public function getCdg() {
//        return $this->cdg;
//    }
    
    /**
     * Add cdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     *
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
    public function removeCdgDepartement(\Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete $cdgDepartement) {
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
    
    function getBlReinitPassword() {
        return $this->blReinitPassword;
    }

    function setBlReinitPassword($blReinitPassword) {
        $this->blReinitPassword = $blReinitPassword;
    }
    function getCdgIsAuthorizedByCollectivity() {
        return $this->cdg_is_authorized_by_collectivity;
    }

    function setCdgIsAuthorizedByCollectivity($cdg_is_authorized_by_collectivity) {
        $this->cdg_is_authorized_by_collectivity = $cdg_is_authorized_by_collectivity;
    }
    /**
     * Add departement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement $departement
     *
     */
    public function addDepartement(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement $departement) {
        $this->departements[] = $departement;

        return $this;
    }

    /**
     * Remove departement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement $departement
     */
    public function removeDepartement(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement $departement) {
        $this->departements->removeElement($departement);
    }

    /**
     * Get departements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartements() {
        return $this->departements;
    }
    
    function getState() {
        
//        $fgstat = $this->getFgStat();
//        dump($fgstat);
//        switch ($fgstat) {
//        case 0:
//            $this->state = 'edit';
//            break;
//        case 1:
//            $this->state = 'edit';
//            break;
//        default:
//            $this->state = 'new';
//        }
        if($this->getIdEnqu()===null){
            $this->state="new";
        }
        return $this->state;
    }

    function setState($state) {
        $this->state = $state;
    }

    function getMarking() {
        return $this->marking;
    }

    function setMarking($marking) {
        $this->marking = $marking;
    }

    /**
     * @return mixed
     */
    public function getBlCloture()
    {
        return $this->blCloture;
    }

    /**
     * @param mixed $blCloture
     */
    public function setBlCloture($blCloture)
    {
        $this->blCloture = $blCloture;
    }




    
}
