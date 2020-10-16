<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

class MessagePassword{
    /**
     * @var int
     */
    private $idMessPass;

    /**
     * @var string
     */
    private $cmMessPass;

    /*
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg
     */

    private $cdg;
    
    /**
     * Get idMessPass
     *
     * @return int
     */
    public function getIdMessPass()
    {
        return $this->idMessPass;
    }
    
    /**
     * Set cmMessPass
     *
     * @param string $cmMessPass
     *
     * @return MessagePassword
     */
    public function setCmMessPass($cmMessPass)
    {
        $this->cmMessPass = $cmMessPass;

        return $this;
    }

    /**
     * Get cmMessPass
     *
     * @return string
     */
    public function getCmMessPass()
    {
        return $this->cmMessPass;
    }
    
    /**
     * Set cdg
     *
     * @param Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg
     *
     * @return cdg
     */
    public function setCdg(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdg) {
        $this->cdg = $cdg;

        return $this;
    }

    /**
     * Get cdg
     *
     * @return Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg
     */
    public function getCdg() {
        return $this->cdg;
    }
}