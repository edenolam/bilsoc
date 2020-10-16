<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

/**
 * ParametrageAffichageCollectivite
 */
class ParametrageAffichageCollectivite{
    /**
     * @var \Bilan_Social\Bundle\UserBundle\Entity\User
     */
    private $utilisateur;
    /**
     * @var boolean
     */
    private $blTypeColl;

    /**
     * @var boolean
     */
    private $blLibe;

    /**
     * @var boolean
     */
    private $blSire;

    /**
     * @var boolean
     */
    private $blAffiCdg;
    /**
     * @var boolean
     */
    private $blDepa;
    /**
     * @var boolean
     */
    private $blCdPost;
    /**
     * @var boolean
     */
    private $blLbVill;
    /**
     * @var boolean
     */
    private $blCdInse;
    /**
     * @var boolean
     */
    private $blNmPopuInse;
    /**
     * @var boolean
     */
    private $blSurclasDemo;
    /**
     * @var boolean
     */
    private $blNmStratColl;
    /**
     * @var boolean
     */
    private $blCtCdg;
    /**
     * @var boolean
     */
    private $blChsct;
    /**
     * @var boolean
     */
    private $blCollDgcl;
    /**
     * @var boolean
     */
    private $blCdgColl;
    /**
     * @var boolean
     */
    private $blNbAgenPerm;
    /**
     * @var boolean
     */
    private $blNbAgenTitu;
    /**
     * @var boolean
     */
    private $blNbAgenContPerm;
    /**
     * @var boolean
     */
    private $blNbAgenContNonPerm;
    /**
     * @var string
     */
    private $lbPara;
    /**
     * @var array
     */
    private $filtres;
    /**
     * @var integer
     */
    private $idParaAffiColl;
    
    /**
     * Set blTypeColl
     *
     * @param boolean $blTypeColl
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlTypeColl($blTypeColl)
    {
        $this->blTypeColl = $blTypeColl;

        return $this;
    }

    /**
     * Get blDepa
     *
     * @return boolean
     */
    public function getBlTypeColl()
    {
        return $this->blTypeColl;
    }
    
    /**
     * Set blLibe
     *
     * @param boolean $blLibe
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlLibe($blLibe)
    {
        $this->blLibe = $blLibe;

        return $this;
    }

    /**
     * Get blLibe
     *
     * @return boolean
     */
    public function getBlLibe()
    {
        return $this->blLibe;
    }
    
    /**
     * Set blSire
     *
     * @param boolean $blSire
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlSire($blSire)
    {
        $this->blSire = $blSire;

        return $this;
    }

    /**
     * Get blSire
     *
     * @return boolean
     */
    public function getBlSire()
    {
        return $this->blSire;
    }
    
    /**
     * Set blAffiCdg
     *
     * @param boolean $blAffiCdg
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlAffiCdg($blAffiCdg)
    {
        $this->blAffiCdg = $blAffiCdg;

        return $this;
    }

    /**
     * Get blAffiCdg
     *
     * @return boolean
     */
    public function getBlAffiCdg()
    {
        return $this->blAffiCdg;
    }
    
    /**
     * Set blDepa
     *
     * @param boolean $blDepa
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlDepa($blDepa)
    {
        $this->blDepa = $blDepa;

        return $this;
    }

    /**
     * Get blDepa
     *
     * @return boolean
     */
    public function getBlDepa()
    {
        return $this->blDepa;
    }
    
    /**
     * Set blCdPost
     *
     * @param boolean $blCdPost
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlCdPost($blCdPost)
    {
        $this->blCdPost = $blCdPost;

        return $this;
    }

    /**
     * Get blCdPost
     *
     * @return boolean
     */
    public function getBlCdPost()
    {
        return $this->blCdPost;
    }
    
    /**
     * Set blLbVill
     *
     * @param boolean $blLbVill
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlLbVill($blLbVill)
    {
        $this->blLbVill = $blLbVill;

        return $this;
    }

    /**
     * Get blLbVill
     *
     * @return boolean
     */
    public function getBlLbVill()
    {
        return $this->blLbVill;
    }
    
    /**
     * Set blCdInse
     *
     * @param boolean $blCdInse
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlCdInse($blCdInse)
    {
        $this->blCdInse = $blCdInse;

        return $this;
    }

    /**
     * Get blCdInse
     *
     * @return boolean
     */
    public function getCdInse()
    {
        return $this->blCdInse;
    }
    
    /**
     * Set blNmPopuInse
     *
     * @param boolean $blNmPopuInse
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlNmPopuInse($blNmPopuInse)
    {
        $this->blNmPopuInse = $blNmPopuInse;

        return $this;
    }

    /**
     * Get blNmPopuInse
     *
     * @return boolean
     */
    public function getBlNmPopuInse()
    {
        return $this->blNmPopuInse;
    }
    
    /**
     * Set blSurclasDemo
     *
     * @param boolean $blSurclasDemo
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlSurclasDemo($blSurclasDemo)
    {
        $this->blSurclasDemo = $blSurclasDemo;

        return $this;
    }

    /**
     * Get blSurclasDemo
     *
     * @return boolean
     */
    public function getBlSurclasDemo()
    {
        return $this->blSurclasDemo;
    }
    
    /**
     * Set blNmStratColl
     *
     * @param boolean $blNmStratColl
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlNmStratColl($blNmStratColl)
    {
        $this->blNmStratColl = $blNmStratColl;

        return $this;
    }

    /**
     * Get $blNmStratColl
     *
     * @return boolean
     */
    public function getBlNmStratColl()
    {
        return $this->blNmStratColl;
    }
    
    /**
     * Set blCtCdg
     *
     * @param boolean $blCtCdg
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlCtCdg($blCtCdg)
    {
        $this->blCtCdg = $blCtCdg;

        return $this;
    }

    /**
     * Get blCtCdg
     *
     * @return boolean
     */
    public function getBlCtCdg()
    {
        return $this->blCtCdg;
    }
    
    /**
     * Set blChsct
     *
     * @param boolean $blChsct
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlChsct($blChsct)
    {
        $this->blChsct = $blChsct;

        return $this;
    }

    /**
     * Get blChsct
     *
     * @return boolean
     */
    public function getBlChsct()
    {
        return $this->blChsct;
    }
    
    /**
     * Set blCollDgcl
     *
     * @param boolean $blCollDgcl
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlCollDgcl($blCollDgcl)
    {
        $this->blCollDgcl = $blCollDgcl;

        return $this;
    }

    /**
     * Get blCollDgcl
     *
     * @return boolean
     */
    public function getBlCollDgcl()
    {
        return $this->blCollDgcl;
    }
    
    /**
     * Set blCdgColl
     *
     * @param boolean $blCdgColl
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlCdgColl($blCdgColl)
    {
        $this->blCdgColl = $blCdgColl;

        return $this;
    }

    /**
     * Get blCdgColl
     *
     * @return boolean
     */
    public function getBlCdgColl()
    {
        return $this->blCdgColl;
    }
    
    /**
     * Set blNbAgenPerm
     *
     * @param boolean $blNbAgenPerm
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlNbAgenPerm($blNbAgenPerm)
    {
        $this->blNbAgenPerm = $blNbAgenPerm;

        return $this;
    }

    /**
     * Get blNbAgenPerm
     *
     * @return boolean
     */
    public function getBlNbAgenPerm()
    {
        return $this->blNbAgenPerm;
    }
    
    /**
     * Set blNbAgenTitu
     *
     * @param boolean $blNbAgenTitu
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlNbAgenTitu($blNbAgenTitu)
    {
        $this->blNbAgenTitu = $blNbAgenTitu;

        return $this;
    }

    /**
     * Get blNbAgenTitu
     *
     * @return boolean
     */
    public function getBlNbAgenTitu()
    {
        return $this->blNbAgenTitu;
    }
    
    /**
     * Set blNbAgenContPerm
     *
     * @param boolean $blNbAgenContPerm
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlNbAgenContPerm($blNbAgenContPerm)
    {
        $this->blNbAgenContPerm = $blNbAgenContPerm;

        return $this;
    }

    /**
     * Get blNbAgenContPerm
     *
     * @return boolean
     */
    public function getBlNbAgenContPerm()
    {
        return $this->blNbAgenContPerm;
    }
    
    /**
     * Set blNbAgenContNonPerm
     *
     * @param boolean $blNbAgenContNonPerm
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setBlNbAgenContNonPerm($blNbAgenContNonPerm)
    {
        $this->blNbAgenContNonPerm = $blNbAgenContNonPerm;

        return $this;
    }

    /**
     * Get blNbAgenContNonPerm
     *
     * @return boolean
     */
    public function getBlNbAgenContNonPerm()
    {
        return $this->blNbAgenContNonPerm;
    }
    

    /**
     * Set lbPara
     *
     * @param string $lbPara
     *
     * @return ParametrageAffichageCollectivite
     */
    public function setLbPara($lbPara)
    {
        $this->lbPara = $lbPara;

        return $this;
    }

    /**
     * Get lbPara
     *
     * @return string
     */
    public function getLbPara()
    {
        return $this->lbPara;
    }

    public function getFiltres() {
        return $this->filtres;
    }

    public function setFiltres(array $filtres) {
        $this->filtres = array();
        foreach ($filtres as $filtre) {
            $this->addFiltre($filtre);
        }
        return $this;
    }

    public function addFiltre($filtre) {
        if (!in_array($filtre, $this->filtres, true)) {
            $this->filtres[] = $filtre;
        }
        return $this;
    }

    public function removeFiltre($filtre) {
        if (false !== $key = array_search(strtoupper($filtre), $this->filtre, true)) {
            unset($this->filtre[$key]);
            $this->filtres = array_values($this->filtres);
        }
        return $this;
    }

    public function hasFiltre($filtre) {
        return in_array(strtoupper($filtre), $this->getFiltres(), true);
    }
    
    /**
     * Set utilisateur
     *
     * @param \Bilan_Social\Bundle\UserBundle\Entity\User $utilisateur
     *
     * @return utilisateur
     */
    public function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Bilan_Social\Bundle\UserBundle\Entity\User
     */
    public function getUtilisateur() {
        return $this->utilisateur;
    }

    /**
     * Get idParaAffiColl
     *
     * @return integer
     */
    public function getIdParaAffiColl()
    {
        return $this->idParaAffiColl;
    }
    
}
