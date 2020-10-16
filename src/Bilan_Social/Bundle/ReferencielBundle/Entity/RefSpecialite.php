<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

use JsonSerializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefSpecialite
 * @UniqueEntity(
 *      fields="cdSpecialite",
 *      errorPath="cdSpecialite",
 *      message="Ce code est déjà existant."
 * )
 */
class RefSpecialite extends RefAbstractEntity{

    /**
     * @var integer
     */
    protected $idSpecialite;
    
    /**
     * @var string
     */
    protected $cdSpecialite;

    /**
     * @var string
     */
    protected $lbSpecialite;

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
     * @var \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineSpecialite
     */
    protected $refDomaineSpecialite;

    /**
     * @var integer
     */
    protected $idSpecialiteSauvegarde;

    function getIdSpecialite() {
        return $this->idSpecialite;
    }

    function getCdSpecialite() {
        return $this->cdSpecialite;
    }

    function getLbSpecialite() {
        return $this->lbSpecialite;
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

    /**
     * @var integer
     */
    protected $gpeec_specialite;

    /**
     * Set refDomaineSpecialite
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineSpecialite $refDomaineSpecialite
     *
     * @return RefSpecialite
     */
    public function setRefDomaineSpecialite(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineSpecialite $refDomaineSpecialite)
    {
        $this->refDomaineSpecialite = $refDomaineSpecialite;

        return $this;
    }

    /**
     * Get refDomaineSpecialite
     *
     * @return \Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineSpecialite
     */
    public function getRefDomaineSpecialite()
    {
        return $this->refDomaineSpecialite;
    }
    
    
    function setIdSpecialite($idSpecialite) {
        $this->idSpecialite = $idSpecialite;
    }

    function setCdSpecialite($cdSpecialite) {
        $this->cdSpecialite = $cdSpecialite;
    }

    function setLbSpecialite($lbSpecialite) {
        $this->lbSpecialite = $lbSpecialite;
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
    
    public function setCreatedAtValue()
    {
        $this->setCreatedAt(new \DateTime());
    }
    
    public function setUpdateDateValue()
    {
        $this->setUpdatedAt(new \Datetime());
    }

    function getGpeec_specialite() {
        return $this->gpeec_specialite;
    }

    function setGpeec_specialite($gpeec_specialite) {
        $this->gpeec_specialite = $gpeec_specialite;
    }

    function getIdSpecialiteSauvegarde() {
        return $this->idSpecialiteSauvegarde;
    }

    function setIdSpecialiteSauvegarde($idSpecialiteSauvegarde) {
        $this->idSpecialiteSauvegarde = $idSpecialiteSauvegarde;
    }

}
