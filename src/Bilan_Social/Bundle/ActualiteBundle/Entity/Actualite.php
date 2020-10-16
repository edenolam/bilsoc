<?php

namespace Bilan_Social\Bundle\ActualiteBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Actualite
 */
class Actualite
{
    /**
     * @var int
     */
    private $id;

    private $image;
    private $fileKeyImg;
    private $imagePublicUrl;

    /**
     * @return mixed
     */
    public function getImagePublicUrl()
    {
        return $this->imagePublicUrl;
    }

    /**
     * @param mixed $imagePublicUrl
     */
    public function setImagePublicUrl($imagePublicUrl)
    {
        $this->imagePublicUrl = $imagePublicUrl;
    }

    private $fileKeyDoc;

    private $document;
  
//    private $pathImg;
//
//  
//    private $nameImg;

//    /**
//     * @var string
//     */
//    private $nameDocument ;
//
//    /**
//     * @var string
//     */
//    private $pathDocument ;

    /**
     * @var string
     */
    private $titreActu;

    /**
     * @var string
     * @Assert\NotNull(
     *  message="actualite.corp.notnull"
     * )
     */
    private $texteActu;

    /**
     * @var \DateTime
     */
    private $DtDebut;

    /**
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getDtDebut() <= this.getDtFin()",
     *     message="actualite.dateFin.expression",groups={"dateNoNull"}
     * )
     */
    private $DtFin;

    /*
     * @var boolean
     */
    private $blPublish;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Assert\Count(
     *  min = 1,
     *  minMessage = "actualite.departement.minimum",groups={"liste2"}
     * )
     */
    private $cdgDepartements;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * @Assert\Count(
     *  min = 1,
     *  minMessage = "actualite.cdg.minimum",groups={"liste1"}
     * )
     */
    private $cdgs;

/**
     * Constructor
     */
    public function __construct() {

        $this->cdgDepartements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cdgs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->DtDebut = new \DateTime;
    }
    function getImage() {
        return $this->image;
    }

    function getDocument() {
        return $this->document;
    }

    function setImage($image) {
        $this->image = $image;
    }

    function setDocument($document) {
        $this->document = $document;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titreActu
     *
     * @param string $titreActu
     *
     * @return Actualite
     */
    public function setTitreActu($titreActu)
    {
        $this->titreActu = $titreActu;

        return $this;
    }

    /**
     * Get titreActu
     *
     * @return string
     */
    public function getTitreActu()
    {
        return $this->titreActu;
    }

    /**
     * Set texteActu
     *
     * @param string $texteActu
     *
     * @return Actualite
     */
    public function setTexteActu($texteActu)
    {
        $this->texteActu = $texteActu;

        return $this;
    }

    /**
     * Get texteActu
     *
     * @return string
     */
    public function getTexteActu()
    {
        return $this->texteActu;
    }

   /**
     * Add CdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     *
     */
    public function addCdgDepartements(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement) {
//        $this->cdgDepartements[] = $cdgDepartement;
         if (true === $this->cdgDepartements->contains($cdgDepartement)) {
            return;
        }
        $this->cdgDepartements->add($cdgDepartement);
        $cdgDepartement->addCategory($this);

        return $this;
    }

    /**
     * Remove CdgDepartement
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement
     */
    public function removeCdgDepartements(\Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement $cdgDepartement) {
//        $this->cdgDepartements->removeElement($cdgDepartement);

         if (false === $this->cdgDepartements->contains($cdgDepartement)) {
            return;
        }
        $this->cdgDepartements->removeElement($cdgDepartement);
        $cdgDepartement->removeActualite($this);
    }

    /**
     * Get CdgDepartement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdgDepartements() {
        return $this->cdgDepartements;
    }

   /**
     * Add Cdg
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdgs
     *
     */
    public function addCdgs(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdgs) {
         if (true === $this->cdgs->contains($cdgs)) {
            return;
        }
        $this->cdgs->add($cdgs);
        $cdgs->addCategory($this);

        return $this;
    }

    /**
     * Remove Cdg
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdgs
     */
    public function removeCdgs(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg $cdgs) {

         if (false === $this->cdgs->contains($cdgs)) {
            return;
        }
        $this->cdgs->removeElement($cdgs);
        $cdgs->removeActualite($this);
    }

    /**
     * Get Cdgs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCdgs() {
        return $this->cdgs;
    }
    function getDtDebut(): \DateTime {
        return $this->DtDebut;
    }

    function getDtFin(){
        if($this->DtFin == null){
            return null;
        }
        return $this->DtFin;
    }

    function getBlPublish() {
        return $this->blPublish;
    }

    function setDtDebut(\DateTime $DtDebut) {
        $this->DtDebut = $DtDebut;
    }

    function setDtFin(\DateTime $DtFin = null) {
        $this->DtFin = $DtFin;
    }

    function setBlPublish($blPublish) {
        $this->blPublish = $blPublish;
    }
    function getFileKeyImg() {
        return $this->fileKeyImg;
    }

    function getFileKeyDoc() {
        return $this->fileKeyDoc;
    }

    function setFileKeyImg($fileKeyImg) {
        $this->fileKeyImg = $fileKeyImg;
    }

    function setFileKeyDoc($fileKeyDoc) {
        $this->fileKeyDoc = $fileKeyDoc;
    }


}

