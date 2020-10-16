<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefDomaineSpecialite
 * @UniqueEntity(
 *      fields="cdDomaineSpecialite",
 *      errorPath="cdDomaineSpecialite",
 *      message="Ce code est déjà existant."
 * )
 */
class RefDomaineSpecialite extends RefAbstractEntity
{
    /**
     * @var integer
     */
    protected $idDomaineSpecialite;

    /**
     * @var string
     */
    protected $cdDomaineSpecialite;

    /**
     * @var string
     */
    protected $lbDomaineSpecialite;

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
    protected $refSpecialites;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->refSpecialites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function getIdDomaineSpecialite() {
        return $this->idDomaineSpecialite;
    }

    function getCdDomaineSpecialite() {
        return $this->cdDomaineSpecialite;
    }

    function getLbDomaineSpecialite() {
        return $this->lbDomaineSpecialite;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    /**
     * Add refSpecialite
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite refSpecialite
     *
     * @return RefDomaineSpecialite
     */
    public function addRefSpecialite(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite $refSpecialite)
    {
        $this->refSpecialites[] = $refSpecialite;

        return $this;
    }

    /**
     * Remove refSpecialite
     *
     * @param \Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite refSpecialite
     */
    public function removeRefSpecialite(\Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite $refSpecialite)
    {
        $this->refSpecialites->removeElement($refSpecialite);
    }

    /**
     * Get refSpecialites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefSpecialites()
    {
        return $this->refSpecialites;
    }

    function setIdDomaineSpecialite($idDomaineSpecialite) {
        $this->idDomaineSpecialite = $idDomaineSpecialite;
    }

    function setCdDomaineSpecialite($cdDomaineSpecialite) {
        $this->cdDomaineSpecialite = $cdDomaineSpecialite;
    }

    function setLbDomaineSpecialite($lbDomaineSpecialite) {
        $this->lbDomaineSpecialite = $lbDomaineSpecialite;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefDomaineSpecialite
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefDomaineSpecialite
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
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

}
