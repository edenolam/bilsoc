<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMetier
 * @UniqueEntity(
 *      fields="cdMetier",
 *      errorPath="cdMetier",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMetier extends RefAbstractEntity{

    /**
     * @var integer
     */
    protected $idFamilleMetier;

    /**
     * @var string
     */
    protected $cdMetier;

    /**
     * @var string
     */
    protected $lbMetier;

    /**
     * @var string
     */
    protected $lbAutAppColl;

    /**
     * @var string
     */
    protected $cdN4ds;

    /**
     * @var boolean
     */
    protected $blMetiPrinc;

    /**
     * @var boolean
     */
    protected $blCons;

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
     * @var integer
     */
    protected $idMetier;
    /**
     * @var integer
     */
    protected $gpeec_metier;
    /**
     * @var integer
     */
    protected $idMetierSauvegarde;

    /**
     * Set idFamilleMetier
     *
     * @param integer $idFamilleMetier
     *
     * @return RefMetier
     */
    public function setIdFamilleMetier($idFamilleMetier)
    {
        $this->idFamilleMetier = $idFamilleMetier;

        return $this;
    }

    /**
     * Get idFamilleMetier
     *
     * @return integer
     */
    public function getIdFamilleMetier()
    {
        return $this->idFamilleMetier;
    }

    /**
     * Set cdMetier
     *
     * @param string $cdMetier
     *
     * @return RefMetier
     */
    public function setCdMetier($cdMetier)
    {
        $this->cdMetier = $cdMetier;

        return $this;
    }

    /**
     * Get cdMetier
     *
     * @return string
     */
    public function getCdMetier()
    {
        return $this->cdMetier;
    }

    /**
     * Set lbMetier
     *
     * @param string $lbMetier
     *
     * @return RefMetier
     */
    public function setLbMetier($lbMetier)
    {
        $this->lbMetier = $lbMetier;

        return $this;
    }

    /**
     * Get lbMetier
     *
     * @return string
     */
    public function getLbMetier()
    {
        return $this->lbMetier;
    }

    /**
     * Set lbAutAppColl
     *
     * @param string $lbAutAppColl
     *
     * @return RefMetier
     */
    public function setLbAutAppColl($lbAutAppColl)
    {
        $this->lbAutAppColl = $lbAutAppColl;

        return $this;
    }

    /**
     * Get lbAutAppColl
     *
     * @return string
     */
    public function getLbAutAppColl()
    {
        return $this->lbAutAppColl;
    }

    /**
     * Set cdN4ds
     *
     * @param string $cdN4ds
     *
     * @return RefMetier
     */
    public function setCdN4ds($cdN4ds)
    {
        $this->cdN4ds = $cdN4ds;

        return $this;
    }

    /**
     * Get cdN4ds
     *
     * @return string
     */
    public function getCdN4ds()
    {
        return $this->cdN4ds;
    }

    /**
     * Set blMetiPrinc
     *
     * @param boolean $blMetiPrinc
     *
     * @return RefMetier
     */
    public function setBlMetiPrinc($blMetiPrinc)
    {
        $this->blMetiPrinc = $blMetiPrinc;

        return $this;
    }

    /**
     * Get blMetiPrinc
     *
     * @return boolean
     */
    public function getBlMetiPrinc()
    {
        return $this->blMetiPrinc;
    }

    /**
     * Set blCons
     *
     * @param boolean $blCons
     *
     * @return RefMetier
     */
    public function setBlCons($blCons)
    {
        $this->blCons = $blCons;

        return $this;
    }

    /**
     * Get blCons
     *
     * @return boolean
     */
    public function getBlCons()
    {
        return $this->blCons;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMetier
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefMetier
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefMetier
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefMetier
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
     * Get idMetier
     *
     * @return integer
     */
    public function getIdMetier()
    {
        return $this->idMetier;
    }
    /**
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier
     */
    protected $RefFamilleMetier;


    /**
     * Set refFamilleMetier
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier $refFamilleMetier
     *
     * @return RefMetier
     */
    public function setRefFamilleMetier(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier $refFamilleMetier = null)
    {
        $this->RefFamilleMetier = $refFamilleMetier;

        return $this;
    }

    /**
     * Get refFamilleMetier
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier
     */
    public function getRefFamilleMetier()
    {
        return $this->RefFamilleMetier;
    }

    function getGpeec_metier() {
        return $this->gpeec_metier;
    }

    function setGpeec_metier($gpeec_metier) {
        $this->gpeec_metier = $gpeec_metier;
    }

    function getIdMetierSauvegarde() {
        return $this->idMetierSauvegarde;
    }

    function setIdMetierSauvegarde($idMetierSauvegarde) {
        $this->idMetierSauvegarde = $idMetierSauvegarde;
    }

}
