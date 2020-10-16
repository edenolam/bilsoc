<?php

namespace Bilan_Social\Bundle\UserBundle\Entity;

/**
 * HistoriqueConnexion
 */
class HistoriqueConnexion {

    /**
     * @var string
     */
    private $idUtil;

    /**
     * @var \DateTime
     */
    private $dtConn;

    /**
     * @var integer
     */
    private $idHistConn;

    public function __construct() {

    }

    /**
     * Set idUtil
     *
     * @param string $idUtil
     *
     * @return HistoriqueConnexion
     */
    public function setIdUtil($idUtil) {
        $this->idUtil = $idUtil;

        return $this;
    }

    /**
     * Get idUtil
     *
     * @return string
     */
    public function getIdUtil() {
        return $this->idUtil;
    }

    /**
     * Set dtConn
     *
     * @param \DateTime $dtConn
     *
     * @return HistoriqueConnexion
     */
    public function setDtConn($dtConn) {
        $this->dtConn = $dtConn;

        return $this;
    }

    /**
     * Get dtConn
     *
     * @return \DateTime
     */
    public function getDtConn() {
        return $this->dtConn;
    }

    /**
     * Get idHistConn
     *
     * @return integer
     */
    public function getIdHistConn() {
        return $this->idHistConn;
    }

}
