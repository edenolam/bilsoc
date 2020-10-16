<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

/**
 * BscHanditorialInaptitudeEtReclassement
 */
class BscHanditorialInaptitudeEtReclassement {
    /**
     * @var integer
     */
    private $idBscHanditorialInaptitudeEtReclassement;
    private $bilanSocialConsolide;

    /**
     * @var integer
     */
    private $qA511;

    /**
     * @var integer
     */
    private $qA512;

    /**
     * @var integer
     */
    private $qA513;

    /**
     * @var integer
     */
    private $rA9;

    /**
     * @var integer
     */
    private $rA91;

    /**
     * @var integer
     */
    private $qA521;

    /**
     * @var integer
     */
    private $rA101;

    /**
     * @var integer
     */
    private $qA522;

    /**
     * @var integer
     */
    private $qA523;

    /**
     * @var integer
     */
    private $qA62;

    /**
     * @var integer
     */
    private $qA72;

    /**
     * @var bool
     */
    private $qA8;

    /**
     * @var integer
     */
    private $qA82;

    /**
     * @var integereger
     */
    private $idBilasocicons;

    /**
     * @var string
     */
    private $fgStat;

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


    /**
     * Get id
     *
     * @return integer
     */
    public function getIdBscHanditorialInaptitudeEtReclassement()
    {
        return $this->idBscHanditorialInaptitudeEtReclassement;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getIdBilasocicons() {
        return $this->idBilasocicons;
    }

    function getFgStat() {
        return $this->fgStat;
    }

    function getDtCrea(): \DateTime {
        return $this->dtCrea;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function getDtModi(): \DateTime {
        return $this->dtModi;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }
    function setIdBscHanditorialInaptitudeEtReclassement($idBscHanditorialInaptitudeEtReclassement) {
        $this->idBscHanditorialInaptitudeEtReclassement = $idBscHanditorialInaptitudeEtReclassement;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setIdBilasocicons($idBilasocicons) {
        $this->idBilasocicons = $idBilasocicons;
    }

    function setFgStat($fgStat) {
        $this->fgStat = $fgStat;
    }

    function setDtCrea(\DateTime $dtCrea) {
        $this->dtCrea = $dtCrea;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function setDtModi(\DateTime $dtModi) {
        $this->dtModi = $dtModi;
    }

    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    /**
     * Set qA511
     *
     * @param integereger $qA511
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA511($qA511)
    {
        $this->qA511 = $qA511;

        return $this;
    }

    /**
     * Get qA511
     *
     * @return integer
     */
    public function getQA511()
    {
        return $this->qA511;
    }

    /**
     * Set qA512
     *
     * @param integereger $qA512
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA512($qA512)
    {
        $this->qA512 = $qA512;

        return $this;
    }

    /**
     * Get qA512
     *
     * @return integer
     */
    public function getQA512()
    {
        return $this->qA512;
    }

    /**
     * Set qA513
     *
     * @param integereger $qA513
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA513($qA513)
    {
        $this->qA513 = $qA513;

        return $this;
    }

    /**
     * Get qA513
     *
     * @return integer
     */
    public function getQA513()
    {
        return $this->qA513;
    }

    /**
     * Set rA9
     *
     * @param integereger $rA9
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setRA9($rA9)
    {
        $this->rA9 = $rA9;

        return $this;
    }

    /**
     * Get rA9
     *
     * @return integer
     */
    public function getRA9()
    {
        return $this->rA9;
    }

    /**
     * Set rA91
     *
     * @param integereger $rA91
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setRA91($rA91)
    {
        $this->rA91 = $rA91;

        return $this;
    }

    /**
     * Get rA91
     *
     * @return integer
     */
    public function getRA91()
    {
        return $this->rA91;
    }

    /**
     * Set qA521
     *
     * @param integereger $qA521
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA521($qA521)
    {
        $this->qA521 = $qA521;

        return $this;
    }

    /**
     * Get qA521
     *
     * @return integer
     */
    public function getQA521()
    {
        return $this->qA521;
    }

    /**
     * Set rA101
     *
     * @param integereger $rA101
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setRA101($rA101)
    {
        $this->rA101 = $rA101;

        return $this;
    }

    /**
     * Get rA101
     *
     * @return integer
     */
    public function getRA101()
    {
        return $this->rA101;
    }

    /**
     * Set qA522
     *
     * @param integereger $qA522
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA522($qA522)
    {
        $this->qA522 = $qA522;

        return $this;
    }

    /**
     * Get qA522
     *
     * @return integer
     */
    public function getQA522()
    {
        return $this->qA522;
    }

    /**
     * Set qA523
     *
     * @param integereger $qA523
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA523($qA523)
    {
        $this->qA523 = $qA523;

        return $this;
    }

    /**
     * Get qA523
     *
     * @return integer
     */
    public function getQA523()
    {
        return $this->qA523;
    }

    /**
     * Set qA62
     *
     * @param integereger $qA62
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA62($qA62)
    {
        $this->qA62 = $qA62;

        return $this;
    }

    /**
     * Get qA62
     *
     * @return integer
     */
    public function getQA62()
    {
        return $this->qA62;
    }

    /**
     * Set qA72
     *
     * @param integereger $qA72
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA72($qA72)
    {
        $this->qA72 = $qA72;

        return $this;
    }

    /**
     * Get qA72
     *
     * @return integer
     */
    public function getQA72()
    {
        return $this->qA72;
    }

    /**
     * Set qA8
     *
     * @param boolean $qA8
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA8($qA8)
    {
        $this->qA8 = $qA8;

        return $this;
    }

    /**
     * Get qA8
     *
     * @return bool
     */
    public function getQA8()
    {
        return $this->qA8;
    }

    /**
     * Set qA82
     *
     * @param integereger $qA82
     *
     * @return BscHanditorialInaptitudeEtReclassement
     */
    public function setQA82($qA82)
    {
        $this->qA82 = $qA82;

        return $this;
    }

    /**
     * Get qA82
     *
     * @return integer
     */
    public function getQA82()
    {
        return $this->qA82;
    }


}

