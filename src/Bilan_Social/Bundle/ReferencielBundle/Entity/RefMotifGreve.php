<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefMotifGreve
 * @UniqueEntity(
 *      fields="cdMotigrev",
 *      errorPath="cdMotigrev",
 *      message="Ce code est déjà existant."
 * )
 */
class RefMotifGreve extends RefAbstractEntity{

    /**
     * @var string
     */
    protected $cdMotigrev;

    /**
     * @var string
     */
    protected $lbMotigrev;

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
    protected $idMotigrev;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $MotifGreve;

    protected $cdDGCL;

    /**
     * Constructor
     */
    public function __construct() {

        $this->MotifGreve = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cdMotigrev
     *
     * @param string $cdMotigrev
     *
     * @return RefMotifGreve
     */
    public function setCdMotigrev($cdMotigrev) {
        $this->cdMotigrev = $cdMotigrev;

        return $this;
    }

    /**
     * Get cdMotigrev
     *
     * @return string
     */
    public function getCdMotigrev() {
        return $this->cdMotigrev;
    }

    /**
     * Set lbMotigrev
     *
     * @param string $lbMotigrev
     *
     * @return RefMotifGreve
     */
    public function setLbMotigrev($lbMotigrev) {
        $this->lbMotigrev = $lbMotigrev;

        return $this;
    }

    /**
     * Get lbMotigrev
     *
     * @return string
     */
    public function getLbMotigrev() {
        return $this->lbMotigrev;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefMotifGreve
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefMotifGreve
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefMotifGreve
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefMotifGreve
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
     * Get idMotigrev
     *
     * @return integer
     */
    public function getIdMotigrev() {
        return $this->idMotigrev;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Add MotifGreve
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $MotifGreve
     *
     * @return MotifGreve
     */
    public function addMotifGreve(\Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $MotifGreve) {
        $this->MotifGreve[] = $MotifGreve;

        return $this;
    }

    /**
     * Remove MotifGreve
     *
     * @param \Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $MotifGreve
     */
    public function removeMotifGreve(\Bilan_Social\Bundle\ApaBundle\Entity\ConflitTravail $MotifGreve) {
        $this->MotifGreve->removeElement($MotifGreve);
    }

    /**
     * Get MotifGreve
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMotifGreve() {
        return $this->MotifGreve;
    }

    function getCdDGCL() {
        return $this->cdDGCL;
    }

    function setCdDGCL($cdDGCL) {
        $this->cdDGCL = $cdDGCL;
    }



}
