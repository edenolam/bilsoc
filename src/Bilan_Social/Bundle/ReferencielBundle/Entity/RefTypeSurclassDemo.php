<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Entity;

class RefTypeSurclassDemo extends RefAbstractEntity{

    protected $idTypeSurclassDemo;
    protected $lbTypeSurclassDemo;
    protected $cdTypeSurclassDemo;
    protected $cdUtilcrea;
    protected $createdAt;
    protected $cdUtilmodi;
    protected $updatedAt;
    protected $collectivite;
    protected $stratSurclassDemo;

    
    function getLbTypeSurclassDemo() {
        return $this->lbTypeSurclassDemo;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function getCreatedAt() {
        return $this->createdAt;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function getCollectivite() {
        return $this->collectivite;
    }

    function setLbTypeSurclassDemo($lbTypeSurclassDemo) {
        $this->lbTypeSurclassDemo = $lbTypeSurclassDemo;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }

    function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }
    
    public function setUpdateDateValue() {
        $this->setUpdatedAt(new \Datetime());
    }

    public function setCreatedAtValue() {
        $this->setCreatedAt(new \DateTime());
    }
    function getCdTypeSurclassDemo() {
        return $this->cdTypeSurclassDemo;
    }

    function setCdTypeSurclassDemo($cdTypeSurclassDemo) {
        $this->cdTypeSurclassDemo = $cdTypeSurclassDemo;
    }
    function getStratSurclassDemo() {
        return $this->stratSurclassDemo;
    }

    function setStratSurclassDemo($stratSurclassDemo) {
        $this->stratSurclassDemo = $stratSurclassDemo;
    }
    function getIdTypeSurclassDemo() {
        return $this->idTypeSurclassDemo;
    }

    function setIdTypeSurclassDemo($idTypeSurclassDemo) {
        $this->idTypeSurclassDemo = $idTypeSurclassDemo;
    }







}
