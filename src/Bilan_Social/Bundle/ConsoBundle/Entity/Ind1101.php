<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

class Ind1101 extends IndBaseEntity
{
    /**
     * @var integer
     */
    protected $id1101;

    protected $bilanSocialConsolide;

    protected $refEmploiFonctionnel;

    /**
     * @var integer
     */
    protected $r1101;

    /**
     * @var integer
     */
    protected $r1102;

    /**
     * @var integer
     */
    protected $r1103;

    /**
     * @var integer
     */
    protected $r1104;

    /**
     * @var integer
     */
    protected $r1105;

    /**
     * @var integer
     */
    protected $r1106;

    /**
     * @var integer
     */
    protected $r1107;

    /**
     * @var integer
     */
    protected $r1108;

    /**
     * @var integer
     */
    protected $r1109;

    /**
     * @var integer
     */
    protected $r1110;

    /**
     * @var \DateTime
     */
    protected $dtCrea;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $dtModi;

    /**
     * @var string
     */
    protected $cdUtilmodi;


    /**
     * Get id1101
     *
     * @return integer
     */
    public function getId1101()
    {
        return $this->id1101;
    }

    /**
     * Set idBilasocicons
     *
     * @param integer $idBilasocicons
     * @return Ind1101
     */
    public function setIdBilasocicons($idBilasocicons)
    {
        $this->idBilasocicons = $idBilasocicons;

        return $this;
    }

    /**
     * Get idBilasocicons
     *
     * @return integer
     */
    public function getIdBilasocicons()
    {
        return $this->idBilasocicons;
    }



    /**
     * Set r1101
     *
     * @param integer $r1101
     * @return Ind1101
     */
    public function setR1101($r1101)
    {
        $this->r1101 = $r1101;

        return $this;
    }

    /**
     * Get r1101
     *
     * @return integer
     */
    public function getR1101(int $ifNull = null)
    {
        return $this->r1101 ?? $ifNull;
    }

    /**
     * Set r1102
     *
     * @param integer $r1102
     * @return Ind1101
     */
    public function setR1102($r1102)
    {
        $this->r1102 = $r1102;

        return $this;
    }

    /**
     * Get r1102
     *
     * @return integer
     */
    public function getR1102(int $ifNull = null)
    {
        return $this->r1102 ?? $ifNull;
    }

    /**
     * Set r1103
     *
     * @param integer $r1103
     * @return Ind1101
     */
    public function setR1103($r1103)
    {
        $this->r1103 = $r1103;

        return $this;
    }

    /**
     * Get r1103
     *
     * @return integer
     */
    public function getR1103(int $ifNull = null)
    {
        return $this->r1103 ?? $ifNull;
    }

    /**
     * Set r1104
     *
     * @param integer $r1104
     * @return Ind1101
     */
    public function setR1104($r1104)
    {
        $this->r1104 = $r1104;

        return $this;
    }

    /**
     * Get r1104
     *
     * @return integer
     */
    public function getR1104(int $ifNull = null)
    {
        return $this->r1104 ?? $ifNull;
    }

    /**
     * Set r1105
     *
     * @param integer $r1105
     * @return Ind1101
     */
    public function setR1105($r1105)
    {
        $this->r1105 = $r1105;

        return $this;
    }

    /**
     * Get r1105
     *
     * @return integer
     */
    public function getR1105(int $ifNull = null)
    {
        return $this->r1105 ?? $ifNull;
    }

    /**
     * Set r1106
     *
     * @param integer $r1106
     * @return Ind1101
     */
    public function setR1106($r1106)
    {
        $this->r1106 = $r1106;

        return $this;
    }

    /**
     * Get r1106
     *
     * @return integer
     */
    public function getR1106(int $ifNull = null)
    {
        return $this->r1106 ?? $ifNull;
    }

    /**
     * Set r1107
     *
     * @param integer $r1107
     * @return Ind1101
     */
    public function setR1107($r1107)
    {
        $this->r1107 = $r1107;

        return $this;
    }

    /**
     * Get r1107
     *
     * @return integer
     */
    public function getR1107(int $ifNull = null)
    {
        return $this->r1107 ?? $ifNull;
    }

    /**
     * Set r1108
     *
     * @param integer $r1108
     * @return Ind1101
     */
    public function setR1108($r1108)
    {
        $this->r1108 = $r1108;

        return $this;
    }

    /**
     * Get r1108
     *
     * @return integer
     */
    public function getR1108(int $ifNull = null)
    {
        return $this->r1108 ?? $ifNull;
    }

    /**
     * Set r1109
     *
     * @param integer $r1109
     * @return Ind1101
     */
    public function setR1109($r1109)
    {
        $this->r1109 = $r1109;
        return $this;
    }

    /**
     * Get r1109
     *
     * @return integer
     */
    public function getR1109(int $ifNull = null)
    {
        return $this->r1109 ?? $ifNull;
    }

    /**
     * Set r1110
     *
     * @param integer $r1110
     * @return Ind1101
     */
    public function setR1110($r1110)
    {
        $this->r1110 = $r1110;
        return $this;
    }

    /**
     * Get r1110
     *
     * @return integer
     */
    public function getR1110(int $ifNull = null)
    {
        return $this->r1110 ?? $ifNull;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return Ind1101
     */
    public function setDtCrea($dtCrea)
    {
        $this->dtCrea = $dtCrea;

        return $this;
    }

    /**
     * Get dtCrea
     *
     * @return \DateTime
     */
    public function getDtCrea()
    {
        return $this->dtCrea;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     * @return Ind1101
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
     * Set dtModi
     *
     * @param \DateTime $dtModi
     * @return Ind1101
     */
    public function setDtModi($dtModi)
    {
        $this->dtModi = $dtModi;

        return $this;
    }

    /**
     * Get dtModi
     *
     * @return \DateTime
     */
    public function getDtModi()
    {
        return $this->dtModi;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     * @return Ind1101
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


    function getRefEmploiFonctionnel() {
        return $this->refEmploiFonctionnel;
    }

    function setRefEmploiFonctionnel($refEmploiFonctionnel) {
        $this->refEmploiFonctionnel = $refEmploiFonctionnel;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function getLbRefEmploiFonctionnel() {
        return $this->refEmploiFonctionnel->getLbEmplfonc();
    }

}
