<?php

namespace Bilan_Social\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateurDroits
 */
class UtilisateurDroits
{

    /**
     * @var integer
     */
    private $fgDroits;
    
    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement
     */
    private $cdgDepartement;
    
    /**
     * @var \Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg
     */
    private $utilisateurCdg;

    /**
     * @var integer
     */
    private $idUtildroit;

    /**
     * Set utilisateurCdg
     *
     * @param \Bilan_Social\Bundle\UserBundle\Entity\UtilisateurCdg $utilisateurCdg
     */
    public function setUtilisateurCdg($utilisateurCdg)
    {
        $this->utilisateurCdg = $utilisateurCdg;

        return $this;
    }

    /**
     * Get utilisateurCdg
     *
     * @return integer 
     */
    public function getUtilisateurCdg()
    {
        return $this->utilisateurCdg;
    }

    /**
     * Set cdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     */
    public function setCdgDepartement($cdgDepartement)
    {
        $this->cdgDepartement = $cdgDepartement;

        return $this;
    }

    /**
     * Get cdgDepartement
     *
     * @return cdgDepartement 
     */
    public function getCdgDepartement()
    {
        return $this->cdgDepartement;
    }

    /**
     * Set fgDroits
     *
     * @param integer $fgDroits
     */
    public function setFgDroits($fgDroits)
    {
        $this->fgDroits = $fgDroits;

        return $this;
    }

    /**
     * Get fgDroits
     *
     * @return integer 
     */
    public function getFgDroits()
    {
        return $this->fgDroits;
    }

    /**
     * Get idUtildroit
     *
     * @return integer 
     */
    public function getIdUtildroit()
    {
        return $this->idUtildroit;
    }
}
