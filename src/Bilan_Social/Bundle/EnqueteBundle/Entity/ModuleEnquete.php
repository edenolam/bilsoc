<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Entity;

/**
 * ModuleEnquete
 */
class ModuleEnquete
{
    /**
     * @var string
     */
    private $cdModuenqu;

    /**
     * @var string
     */
    private $lbModuenqu;

    /**
     * @var integer
     */
    private $idModuenqu;


    /**
     * Set cdModuenqu
     *
     * @param string $cdModuenqu
     *
     * @return ModuleEnquete
     */
    public function setCdModuenqu($cdModuenqu)
    {
        $this->cdModuenqu = $cdModuenqu;

        return $this;
    }

    /**
     * Get cdModuenqu
     *
     * @return string
     */
    public function getCdModuenqu()
    {
        return $this->cdModuenqu;
    }

    /**
     * Set lbModuenqu
     *
     * @param string $lbModuenqu
     *
     * @return ModuleEnquete
     */
    public function setLbModuenqu($lbModuenqu)
    {
        $this->lbModuenqu = $lbModuenqu;

        return $this;
    }

    /**
     * Get lbModuenqu
     *
     * @return string
     */
    public function getLbModuenqu()
    {
        return $this->lbModuenqu;
    }

    /**
     * Get idModuenqu
     *
     * @return integer
     */
    public function getIdModuenqu()
    {
        return $this->idModuenqu;
    }
}
