<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Entity;

/**
 * ModeSaisieEnquete
 */
class ModeSaisieEnquete
{
    /**
     * @var string
     */
    private $cdModecamp;

    /**
     * @var string
     */
    private $lbModecamp;

    /**
     * @var integer
     */
    private $idModecamp;


    /**
     * Set cdModecamp
     *
     * @param string $cdModecamp
     *
     * @return ModeSaisieEnquete
     */
    public function setCdModecamp($cdModecamp)
    {
        $this->cdModecamp = $cdModecamp;

        return $this;
    }

    /**
     * Get cdModecamp
     *
     * @return string
     */
    public function getCdModecamp()
    {
        return $this->cdModecamp;
    }

    /**
     * Set lbModecamp
     *
     * @param string $lbModecamp
     *
     * @return ModeSaisieEnquete
     */
    public function setLbModecamp($lbModecamp)
    {
        $this->lbModecamp = $lbModecamp;

        return $this;
    }

    /**
     * Get lbModecamp
     *
     * @return string
     */
    public function getLbModecamp()
    {
        return $this->lbModecamp;
    }

    /**
     * Get idModecamp
     *
     * @return integer
     */
    public function getIdModecamp()
    {
        return $this->idModecamp;
    }
}
