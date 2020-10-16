<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefSanctionDisciplinaire
 * @UniqueEntity(
 *      fields="cdSancdisc",
 *      errorPath="cdSancdisc",
 *      message="Ce code est déjà existant."
 * )
 */
class RefSanctionDisciplinaire extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdSancdisc;

    /**
     * @var string
     */
    protected $lbSancdisc;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $cdUtilmodi;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $SanctionDisciplinaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $SanctionDisciplinaireStagiaire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $SanctionDisciplinaireContractuel;
    /**
     * @var integer
     */
    protected $idSancdisc;

    protected $bl614G1;
    protected $bl614G2;
    protected $bl614G3;
    protected $bl614G4;
    protected $bl614G5;
    protected $bl614G6;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {
        
         $this->SanctionDisciplinaire = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getCdSancdisc() {
        return $this->cdSancdisc;
    }

    function getLbSancdisc() {
        return $this->lbSancdisc;
    }

    function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function getIdSancdisc() {
        return $this->idSancdisc;
    }

    function setCdSancdisc($cdSancdisc) {
        $this->cdSancdisc = $cdSancdisc;
    }

    function setLbSancdisc($lbSancdisc) {
        $this->lbSancdisc = $lbSancdisc;
    }

    function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    function setIdSancdisc($idSancdisc) {
        $this->idSancdisc = $idSancdisc;
    }

    function getBl614G1() {
        return $this->bl614G1;
    }

    function getBl614G2() {
        return $this->bl614G2;
    }

    function getBl614G3() {
        return $this->bl614G3;
    }

    function getBl614G4() {
        return $this->bl614G4;
    }

    function getBl614G5() {
        return $this->bl614G5;
    }

    function getBl614G6() {
        return $this->bl614G6;
    }

    function setBl614G1($bl614G1) {
        $this->bl614G1 = $bl614G1;
    }

    function setBl614G2($bl614G2) {
        $this->bl614G2 = $bl614G2;
    }

    function setBl614G3($bl614G3) {
        $this->bl614G3 = $bl614G3;
    }

    function setBl614G4($bl614G4) {
        $this->bl614G4 = $bl614G4;
    }

    function setBl614G5($bl614G5) {
        $this->bl614G5 = $bl614G5;
    }

    function setBl614G6($bl614G6) {
        $this->bl614G6 = $bl614G6;
    }


    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }
    
    /**
     * Add SanctionDisciplinaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $SanctionDisciplinaire
     *
     * @return RefSanctionDisciplinaire
     */
    public function addSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $SanctionDisciplinaire) {
        $this->SanctionDisciplinaire[] = $SanctionDisciplinaire;

        return $this;
    }

    /**
     * Remove SanctionDisciplinaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $SanctionDisciplinaire
     */
    public function removeSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaire $SanctionDisciplinaire) {
        $this->SanctionDisciplinaire->removeElement($SanctionDisciplinaire);
    }

    /**
     * Get SanctionDisciplinaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSanctionDisciplinaire() {
        return $this->SanctionDisciplinaire;
    }
}
