<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

class HistoriqueEchange{
    /**
     * @var int
     */
    private $idHistEcha;

    /**
     * @var string
     */
    private $lbIntiEcha;

    /**
     * @var string
     */
    private $lbTypeEcha;

    /**
     * @var string
     */
    private $cmEcha;

    /**
     * @var \Date
     */
    private $dtEcha;

    /*
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */

    private $collectivite;

    

    /**
     * Get idHistEcha
     *
     * @return int
     */
    public function getIdHistEcha()
    {
        return $this->idHistEcha;
    }
    
    /**
     * Set lbIntiEcha
     *
     * @param string $lbIntiEcha
     *
     * @return HistoriqueEchange
     */
    public function setLbIntiEcha($lbIntiEcha)
    {
        $this->lbIntiEcha = $lbIntiEcha;

        return $this;
    }

    /**
     * Get lbIntiEcha
     *
     * @return string
     */
    public function getLbIntiEcha()
    {
        return $this->lbIntiEcha;
    }
    
    /**
     * Set lbTypeEcha
     *
     * @param string $lbTypeEcha
     *
     * @return HistoriqueEchange
     */
    public function setLbTypeEcha($lbTypeEcha)
    {
        $this->lbTypeEcha = $lbTypeEcha;

        return $this;
    }

    /**
     * Get lbTypeEcha
     *
     * @return string
     */
    public function getLbTypeEcha()
    {
        return $this->lbTypeEcha;
    }
    
    /**
     * Set cmEcha
     *
     * @param string $cmEcha
     *
     * @return HistoriqueEchange
     */
    public function setCmEcha($cmEcha)
    {
        $this->cmEcha = $cmEcha;

        return $this;
    }

    /**
     * Get cmEcha
     *
     * @return string
     */
    public function getCmEcha()
    {
        return $this->cmEcha;
    }
    
    /**
     * Set dtEcha
     *
     * @param \Date $dtEcha
     *
     * @return HistoriqueEchange
     */
    public function setDtEcha($dtEcha) {
        $this->dtEcha = $dtEcha;

        return $this;
    }

    /**
     * Get dtEcha
     *
     * @return \Date
     */
    public function getDtEcha() {
        return $this->dtEcha;
    }
    
    /**
     * Set collectivite
     *
     * @param Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return collectivite
     */
    public function setCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite) {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * Get collectivite
     *
     * @return Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    public function getCollectivite() {
        return $this->collectivite;
    }
}
