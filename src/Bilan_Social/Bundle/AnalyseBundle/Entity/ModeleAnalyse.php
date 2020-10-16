<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ModeleAnalyse
 */
class ModeleAnalyse
{
    /**
     * @var string
     */
    private $cmPresentation;

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
    private $idModeleAnalyse;

    private $cdg;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $collectivites;
    
    private $campagne;

    /**
     * @var boolean
     */
    private $blAffi;

    /**
     * Constructor
     */
    public function __construct() {

        $this->collectivites = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set cmPresentation
     *
     * @param string $cmPresentation
     * @return ModeleAnalyse
     */
    public function setCmPresentation($cmPresentation)
    {
        $this->cmPresentation = $cmPresentation;

        return $this;
    }

    /**
     * Get cmPresentation
     *
     * @return string 
     */
    public function getCmPresentation()
    {
        return $this->cmPresentation;
    }
    
    /**
     * Set cdUtilCrea
     *
     * @param string $cdUtilCrea
     * @return ModeleAnalyse
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
     * @return ModeleAnalyse
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
     * Get idModeleAnalyse
     *
     * @return integer 
     */
    public function getIdModeleAnalyse()
    {
        return $this->idModeleAnalyse;
    }

    /**
     * Set cdg
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg
     * @return ModeleAnalyse
     */
    public function setCdg(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg)
    {
        $this->cdg = $cdg;

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
     * Add Collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     */
    public function addCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivites[] = $collectivite;
        return $this;
    }

    /**
     * Remove Collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     */
    public function removeCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivites->removeElement($collectivite);
    }

    /**
     * Remove All Collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     */
    public function removeAllCollectivite() {
        $this->collectivites->clear();
    }

    /**
     * Get Collectivite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCollectivites() {
        return $this->collectivites;
    }
    
    /**
     * Set campagne
     *
     * @param \Bilan_Social\Bundle\CampagneBundle\Entity\Campagne $campagne
     * @return ModeleAnalyse
     */
    public function setCampagne(\Bilan_Social\Bundle\CampagneBundle\Entity\Campagne $campagne)
    {
        $this->campagne = $campagne;

        return $this;
    }

    /**
     * Get campagne
     *
     * @return \Bilan_Social\Bundle\CampagneBundle\Entity\Campagne
     */
    public function getCampagne()
    {
        return $this->campagne;
    }
    
    public function getBlAffi()
    {
        return $this->blAffi;
    }
    
    public function setBlAffi($blAffi)
    {
        $this->blAffi = $blAffi;

        return $this;
    }
}
