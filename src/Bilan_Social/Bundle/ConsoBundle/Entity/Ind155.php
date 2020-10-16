<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;


class Ind155
{
    /**
     * @var integer
     */
    private $id155;

    private $bilanSocialConsolide;

    private $refAvancementPromotionConcours;

    /**
     * @var integer
     */
    private $r1551;

    /**
     * @var integer
     */
    private $r1552;



    /**
     * @var \DateTime
     */
    private $dtCrea;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $dtModi;

    /**
     * @var string
     */
    private $cdUtilmodi;


    function getId155() {
        return $this->id155;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getRefAvancementPromotionConcours() {
        return $this->refAvancementPromotionConcours;
    }

    function getR1551(int $ifNull = null) {
        return $this->r1551 ?? $ifNull;
    }

    function getR1552(int $ifNull = null) {
        return $this->r1552 ?? $ifNull;
    }



    function getDtCrea(): \DateTime {
        return $this->dtCrea;
    }

    function getCdUtilcrea() {
        return $this->cdUtilcrea;
    }

    function getDtModi(): \DateTime {
        return $this->dtModi;
    }

    function getCdUtilmodi() {
        return $this->cdUtilmodi;
    }

    function setId155($id155) {
        $this->id155 = $id155;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setRefAvancementPromotionConcours($refAvancementPromotionConcours) {
        $this->refAvancementPromotionConcours = $refAvancementPromotionConcours;
    }

    function setR1551($r1551) {
        $this->r1551 = $r1551;
    }

    function setR1552($r1552) {
        $this->r1552 = $r1552;
    }

  

    function setDtCrea(\DateTime $dtCrea) {
        $this->dtCrea = $dtCrea;
    }

    function setCdUtilcrea($cdUtilcrea) {
        $this->cdUtilcrea = $cdUtilcrea;
    }

    function setDtModi(\DateTime $dtModi) {
        $this->dtModi = $dtModi;
    }

    function setCdUtilmodi($cdUtilmodi) {
        $this->cdUtilmodi = $cdUtilmodi;
    }


}


