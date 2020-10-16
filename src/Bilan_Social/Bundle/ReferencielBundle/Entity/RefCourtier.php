<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

/**
 * RefCourtier
 */
class RefCourtier extends RefAbstractEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $libelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $collectivites;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->collectivites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return RefCourtier
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return RefCourtier
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     *
     * @return RefCourtier
     */
    public function addCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite)
    {
        $this->collectivites[] = $collectivite;

        return $this;
    }

    /**
     * Remove collectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite
     */
    public function removeCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $collectivite)
    {
        $this->collectivites->removeElement($collectivite);
    }

    /**
     * Get collectivites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCollectivites()
    {
        return $this->collectivites;
    }
}
