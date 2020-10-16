<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeAnalyse
 */
class DemandeAnalyse
{
    /**
     * @var string
     */
    private $cmDetail;

    /**
     * @var string
     */
    private $lbTypeAnalyse;

    /**
     * @var string
     */
    private $lbAnalyse;

    /**
     * @var string
     */
    private $fgStat;

    /**
     * @var string
     */
    private $cdUtilCrea;

    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var integer
     */
    private $idDemandeAnalyse;

    private $collectivite;

    private $cdg;

    /**
     * @var boolean
     */
    private $analyseRead;

    /**
     * Set cmDetail
     *
     * @param string $cmDetail
     * @return DemandeAnalyse
     */
    public function setCmDetail($cmDetail)
    {
        $this->cmDetail = $cmDetail;

        return $this;
    }

    /**
     * Get cmDetail
     *
     * @return string 
     */
    public function getCmDetail()
    {
        return $this->cmDetail;
    }

    /**
     * Set lbTypeAnalyse
     *
     * @param string $lbTypeAnalyse
     * @return DemandeAnalyse
     */
    public function setLbTypeAnalyse($lbTypeAnalyse)
    {
        $this->lbTypeAnalyse = $lbTypeAnalyse;

        return $this;
    }

    /**
     * Get lbTypeAnalyse
     *
     * @return string 
     */
    public function getLbTypeAnalyse()
    {
        return $this->lbTypeAnalyse;
    }

    /**
     * Set lbAnalyse
     *
     * @param string $lbAnalyse
     * @return DemandeAnalyse
     */
    public function setLbAnalyse($lbAnalyse)
    {
        $this->lbAnalyse = $lbAnalyse;

        return $this;
    }

    /**
     * Get lbAnalyse
     *
     * @return string 
     */
    public function getLbAnalyse()
    {
        return $this->lbAnalyse;
    }

    /**
     * Set fgStat
     *
     * @param string $fgStat
     *
     * @return DemandeAnalyse
     */
    public function setFgStat($fgStat) {
        $this->fgStat = $fgStat;

        return $this;
    }

    /**
     * Get fgStat
     *
     * @return string
     */
    public function getFgStat() {
        return $this->fgStat;
    }

    /**
     * Set cdUtilCrea
     *
     * @param string $cdUtilCrea
     * @return DemandeAnalyse
     */
    public function setCdUtilCrea($cdUtilCrea)
    {
        $this->cdUtilCrea = $cdUtilCrea;

        return $this;
    }

    /**
     * Get cdUtilCrea
     *
     * @return string 
     */
    public function getCdUtilCrea()
    {
        return $this->cdUtilCrea;
    }

    /**
     * Set dtCrea
     *
     * @param \DateTime $dtCrea
     * @return DemandeAnalyse
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
     * Get idDemandeAnalyse
     *
     * @return integer 
     */
    public function getIdDemandeAnalyse()
    {
        return $this->idDemandeAnalyse;
    }
    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */

    /**
     * Set collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     * @return DemandeAnalyse
     */
    public function setCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite)
    {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get cdg
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg 
     */
    public function getCdg()
    {
        return $this->cdg;
    }

    /**
     * Set cdg
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg
     * @return DemandeAnalyse
     */
    public function setCdg(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg)
    {
        $this->cdg = $cdg;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite 
     */
    public function getCollectivite()
    {
        return $this->collectivite;
    }

    /**
     * Set analyseRead
     *
     * @param boolean $analyseRead
     *
     * @return Analyse
     */
    public function setAnalyseRead($analyseRead)
    {
        $this->analyseRead = $analyseRead;

        return $this;
    }

    /**
     * Get analyseRead
     *
     * @return boolean
     */
    public function getAnalyseRead()
    {
        return $this->analyseRead;
    }
}
