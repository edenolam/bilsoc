<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DemandeAnalyse
 */
class Analyse
{
    /**
     * @var string
     */
    private $lbNomAnalyse;

    /**
     * @var string
     */
    private $lbAnalyse;

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
    private $idAnalyse;

    private $cdg;


    /**
     * Set lbNomAnalyse
     *
     * @param string $lbNomAnalyse
     * @return DemandeAnalyse
     */
    public function setLbNomAnalyse($lbNomAnalyse)
    {
        $this->lbNomAnalyse = $lbNomAnalyse;

        return $this;
    }

    /**
     * Get lbNomAnalyse
     *
     * @return string 
     */
    public function getLbNomAnalyse()
    {
        return $this->lbNomAnalyse;
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
     * Get idAnalyse
     *
     * @return integer 
     */
    public function getIdAnalyse()
    {
        return $this->idAnalyse;
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

}
