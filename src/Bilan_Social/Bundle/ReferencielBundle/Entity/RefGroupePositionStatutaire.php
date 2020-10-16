<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * RefGroupePositionStatutaire
 * @UniqueEntity(
 *      fields="cdGrouPosistat",
 *      errorPath="cdGrouPosistat",
 *      message="Ce code est déjà existant."
 * )
 */
class RefGroupePositionStatutaire extends RefAbstractEntity{


    /**
     * @var string
     */
    protected $cdGrouPosistat;

    /**
     * @var string
     */
    protected $lbGrouPosistat;

    /**
     * @var string
     */
    protected $lbGrouCompl;

    /**
     * @var string
     */
    protected $lbGrouComm;

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
    protected $idGrouPosistat;





    function getCdGrouPosistat() {
        return $this->cdGrouPosistat;
    }

    function getLbGrouPosistat() {
        return $this->lbGrouPosistat;
    }

    function getLbGrouCompl() {
        return $this->lbGrouCompl;
    }

    function getLbGrouComm() {
        return $this->lbGrouComm;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

 

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function getIdGrouPosistat() {
        return $this->idGrouPosistat;
    }

    function setCdGrouPosistat($cdGrouPosistat) {
        $this->cdGrouPosistat = $cdGrouPosistat;
    }

    function setLbGrouPosistat($lbGrouPosistat) {
        $this->lbGrouPosistat = $lbGrouPosistat;
    }

    function setLbGrouCompl($lbGrouCompl) {
        $this->lbGrouCompl = $lbGrouCompl;
    }

    function setLbGrouComm($lbGrouComm) {
        $this->lbGrouComm = $lbGrouComm;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }



    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    function setIdGrouPosistat($idGrouPosistat) {
        $this->idGrouPosistat = $idGrouPosistat;
    }

    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefGrade
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefGrade
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

}
