<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Entity;

/**
 * TypeImport
 */
class TypeImport
{
    /**
     * @var string
     */
    private $cdTypeimpo;

    /**
     * @var string
     */
    private $lbTypeimpo;

    /**
     * @var integer
     */
    private $idTypeimpo;


    /**
     * Set cdTypeimpo
     *
     * @param string $cdTypeimpo
     *
     * @return TypeImport
     */
    public function setCdTypeimpo($cdTypeimpo)
    {
        $this->cdTypeimpo = $cdTypeimpo;

        return $this;
    }

    /**
     * Get cdTypeimpo
     *
     * @return string
     */
    public function getCdTypeimpo()
    {
        return $this->cdTypeimpo;
    }

    /**
     * Set lbTypeimpo
     *
     * @param string $lbTypeimpo
     *
     * @return TypeImport
     */
    public function setLbTypeimpo($lbTypeimpo)
    {
        $this->lbTypeimpo = $lbTypeimpo;

        return $this;
    }

    /**
     * Get lbTypeimpo
     *
     * @return string
     */
    public function getLbTypeimpo()
    {
        return $this->lbTypeimpo;
    }

    /**
     * Get idTypeimpo
     *
     * @return integer
     */
    public function getIdTypeimpo()
    {
        return $this->idTypeimpo;
    }
}
