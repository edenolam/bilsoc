<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

/**
 * RefNatureMAJ
 */
class RefNatureMAJ extends RefAbstractEntity
{
    /**
     * @var string
     */
    protected $lbNatureMAJ;

    /**
     * @var string
     */
    protected $cdStat;



    /**
     * @var integer
     *
     * blCrea = 0 => utilisé dans le deuxieme onglet des sirets n-1 dans non presentes dans l'année N
     * blCrea = 1 => utilisé dans le premier onglet des nouveaux SIRETS dans l'année N ( Non present dans l'année N-1 )
     * blCrea = 2 => utilisé par defaut pour les collectivités n'ayant pas bougée d'une année a l'autre
     *
     */
    protected $blCrea;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $cdUtilcrea;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var string
     */
    protected $cdUtilmodi;

    /**
     * @var integer
     */
    protected $idNatureMAJ;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $historiqueCollectivite;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historiqueCollectivite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set lbNatureMAJ
     *
     * @param string $lbNatureMAJ
     *
     * @return RefNatureMAJ
     */
    public function setLbNatureMAJ($lbNatureMAJ)
    {
        $this->lbNatureMAJ = $lbNatureMAJ;

        return $this;
    }

    /**
     * Get lbNatureMAJ
     *
     * @return string
     */
    public function getLbNatureMAJ()
    {
        return $this->lbNatureMAJ;
    }

    /**
     * Set cdStat
     *
     * @param string $cdStat
     *
     * @return RefNatureMAJ
     */
    public function setCdStat($cdStat)
    {
        $this->cdStat = $cdStat;

        return $this;
    }

    /**
     * Get cdStat
     *
     * @return string
     */
    public function getCdStat()
    {
        return $this->cdStat;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RefNatureMAJ
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set cdUtilcrea
     *
     * @param string $cdUtilcrea
     *
     * @return RefNatureMAJ
     */
    public function setCdUtilcrea($cdUtilcrea)
    {
        $this->cdUtilcrea = $cdUtilcrea;

        return $this;
    }

    /**
     * Get cdUtilcrea
     *
     * @return string
     */
    public function getCdUtilcrea()
    {
        return $this->cdUtilcrea;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return RefNatureMAJ
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set cdUtilmodi
     *
     * @param string $cdUtilmodi
     *
     * @return RefNatureMAJ
     */
    public function setCdUtilmodi($cdUtilmodi)
    {
        $this->cdUtilmodi = $cdUtilmodi;

        return $this;
    }

    /**
     * Get cdUtilmodi
     *
     * @return string
     */
    public function getCdUtilmodi()
    {
        return $this->cdUtilmodi;
    }

    /**
     * Get idNatureMAJ
     *
     * @return integer
     */
    public function getIdNatureMAJ()
    {
        return $this->idNatureMAJ;
    }

    /**
     * Add HistoriqueCollectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite
     *
     * @return RefNatureMAJ
     */
    public function addHistoriqueCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite)
    {
        $this->HistoriqueCollectivite[] = $historiqueCollectivite;

        return $this;
    }

    /**
     * Remove HistoriqueCollectivite
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite
     */
    public function removeHistoriqueCollectivite(\Bilan_Social\Bundle\CollectiviteBundle\Entity\HistoriqueCollectivite $historiqueCollectivite)
    {
        $this->HistoriqueCollectivite->removeElement($historiqueCollectivite);
    }

    /**
     * Get HistoriqueCollectivite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoriqueCollectivite()
    {
        return $this->Historisation_siret;
    }

    public function setCreatedAtValue()
    {
        // Add your code here
    }

    public function setUpdateDateValue()
    {
        // Add your code here
    }




    /**
     * Set blCrea
     *
     * @param integer $blCrea
     *
     * @return RefNatureMAJ
     */
    public function setBlCrea($blCrea)
    {
        $this->blCrea = $blCrea;

        return $this;
    }

    /**
     * Get blCrea
     *
     * @return integer
     */
    public function getBlCrea()
    {
        return $this->blCrea;
    }
}
