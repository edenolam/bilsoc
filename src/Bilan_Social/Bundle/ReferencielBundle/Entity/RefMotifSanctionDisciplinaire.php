<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMotifSanctionDisciplinaire
 * @UniqueEntity(
 *      fields="cdMotiSancdisc",
 *      errorPath="cdMotiSancdisc",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMotifSanctionDisciplinaire extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdMotiSancdisc;

    /**
     * @var string
     */
    protected $lbMotiSancdisc;

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
    protected $MotifSanctionDisciplinaire;
    
    /**
     * @var integer
     */
    protected $idMotiSancdisc;

    protected $cdDGCL;


    /**
     * Constructor
     */
    public function __construct() {
         $this->MotifSanctionDisciplinaire = new \Doctrine\Common\Collections\ArrayCollection();
    }


    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    function getCdMotiSancdisc() {
        return $this->cdMotiSancdisc;
    }

    function getLbMotiSancdisc() {
        return $this->lbMotiSancdisc;
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

    function getIdMotiSancdisc() {
        return $this->idMotiSancdisc;
    }

    function setCdMotiSancdisc($cdMotiSancdisc) {
        $this->cdMotiSancdisc = $cdMotiSancdisc;
    }

    function setLbMotiSancdisc($lbMotiSancdisc) {
        $this->lbMotiSancdisc = $lbMotiSancdisc;
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

    function setIdMotiSancdisc($idMotiSancdisc) {
        $this->idMotiSancdisc = $idMotiSancdisc;
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }
     /**
     * Add MotifSanctionDisciplinaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $MotifSanctionDisciplinaire
     *
     * @return RefMotifSanctionDisciplinaire
     */
    public function addMotifSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $MotifSanctionDisciplinaire) {
        $this->MotifSanctionDisciplinaire[] = $MotifSanctionDisciplinaire;

        return $this;
    }

    /**
     * Remove MotifSanctionDisciplinaire
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $MotifSanctionDisciplinaire
     */
    public function removeMotifSanctionDisciplinaire(\Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire $MotifSanctionDisciplinaire) {
        $this->MotifSanctionDisciplinaire->removeElement($MotifSanctionDisciplinaire);
    }

    /**
     * Get MotifSanctionDisciplinaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifSanctionDisciplinaire() {
        return $this->MotifSanctionDisciplinaire;
    }



}
