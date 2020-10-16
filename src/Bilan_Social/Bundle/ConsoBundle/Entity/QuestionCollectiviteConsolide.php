<?php

namespace Bilan_Social\Bundle\ConsoBundle\Entity;

/**
 * QuestionCollectiviteConsolide
 */
class QuestionCollectiviteConsolide
{
    private $enquete;

    private $collectivite;

    /**
     * @var boolean
     */
    private $q1;

    /**
     * @var boolean
     */
    private $q2;

    /**
     * @var boolean
     */
    private $q3;

    /**
     * @var boolean
     */
    private $q4;

    /**
     * @var boolean
     */
    private $q5;

    /**
     * @var boolean
     */
    private $q6;

    /**
     * @var boolean
     */
    private $q7;

    /**
     * @var boolean
     */
    private $q8;

    /**
     * @var boolean
     */
    private $q9;

    /**
     * @var boolean
     */
    private $q10;

    /**
     * @var boolean
     */
    private $q11;

    /**
     * @var boolean
     */
    private $q12;

    /**
     * @var boolean
     */
    private $q13;

    /**
     * @var boolean
     */
    private $q14;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $cdUtilcrea;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $cdUtilmodi;

    /**
     * @var integer
     */
    private $idQuescollcons;


    /**
     * Set q1
     *
     * @param boolean $q1
     * @return QuestionCollectiviteConsolide
     */
    public function setQ1($q1)
    {
//        $this->q1 = $q1;
          $this->q1 = true;

        return $this;
    }

    /**
     * Get q1
     *
     * @return boolean
     */
    public function getQ1()
    {
//        return $this->q1;
          return true;
    }

    /**
     * Set q2
     *
     * @param boolean $q2
     * @return QuestionCollectiviteConsolide
     */
    public function setQ2($q2)
    {
//        $this->q2 = $q2;
          $this->q2 = true;

        return $this;
    }

    /**
     * Get q2
     *
     * @return boolean
     */
    public function getQ2()
    {
//        return $this->q2;
          return true;
    }

    /**
     * Set q3
     *
     * @param boolean $q3
     * @return QuestionCollectiviteConsolide
     */
    public function setQ3($q3)
    {
//        $this->q3 = $q3;
          $this->q3 = true;

        return $this;
    }

    /**
     * Get q3
     *
     * @return boolean
     */
    public function getQ3()
    {
//        return $this->q3;
          return true;
    }

    /**
     * Set q4
     *
     * @param boolean $q4
     * @return QuestionCollectiviteConsolide
     */
    public function setQ4($q4)
    {
//        $this->q4 = $q4;
          $this->q4 = true;
          
        return $this;
    }

    /**
     * Get q4
     *
     * @return boolean
     */
    public function getQ4()
    {
//        return $this->q4;
        return true;
    }

    /**
     * Set q5
     *
     * @param boolean $q5
     * @return QuestionCollectiviteConsolide
     */
    public function setQ5($q5)
    {
//        $this->q5 = $q5;
        $this->q5 = true;
        
        return $this;
    }

    /**
     * Get q5
     *
     * @return boolean
     */
    public function getQ5()
    {
//        return $this->q5;
          return true;
    }

    /**
     * Set q6
     *
     * @param boolean $q6
     * @return QuestionCollectiviteConsolide
     */
    public function setQ6($q6)
    {
//        $this->q6 = $q6;
          $this->q6 = true;

        return $this;
    }

    /**
     * Get q6
     *
     * @return boolean
     */
    public function getQ6()
    {
//        return $this->q6;
        return true;
    }

    /**
     * Set q7
     *
     * @param boolean $q7
     * @return QuestionCollectiviteConsolide
     */
    public function setQ7($q7)
    {
//        $this->q7 = $q7;
          $this->q7 = true;
          
        return $this;
    }

    /**
     * Get q7
     *
     * @return boolean
     */
    public function getQ7()
    {
          return true;
//        return $this->q7;
    }

    /**
     * Set q8
     *
     * @param boolean $q8
     * @return QuestionCollectiviteConsolide
     */
    public function setQ8($q8)
    {
//        $this->q8 = $q8;
          $this->q8 = true;

        return $this;
    }

    /**
     * Get q8
     *
     * @return boolean
     */
    public function getQ8()
    {
//        return $this->q8;
          return true;
    }

    /**
     * Set q9
     *
     * @param boolean $q9
     * @return QuestionCollectiviteConsolide
     */
    public function setQ9($q9)
    {
//        $this->q9 = $q9;
          $this->q9 = true;

        return $this;
    }

    /**
     * Get q9
     *
     * @return boolean
     */
    public function getQ9()
    {
//        return $this->q9;
        return true;
    }

    /**
     * Set q10
     *
     * @param boolean $q10
     * @return QuestionCollectiviteConsolide
     */
    public function setQ10($q10)
    {
//        $this->q10 = $q10;
          $this->q10 = true;

        return $this;
    }

    /**
     * Get q10
     *
     * @return boolean
     */
    public function getQ10()
    {
//        return $this->q10;
        return true;
    }

    /**
     * Set q11
     *
     * @param boolean $q11
     * @return QuestionCollectiviteConsolide
     */
    public function setQ11($q11)
    {
//        $this->q11 = $q11;
           $this->q11 = true;

        return $this;
    }

    /**
     * Get q11
     *
     * @return boolean
     */
    public function getQ11()
    {
//        return $this->q11;
        return true;
    }

    /**
     * Set q12
     *
     * @param boolean $q12
     * @return QuestionCollectiviteConsolide
     */
    public function setQ12($q12)
    {
//        $this->q12 = $q12;
            $this->q12 = true;

        return $this;
    }

    /**
     * Get q12
     *
     * @return boolean
     */
    public function getQ12()
    {
//        return $this->q12;
          return true;
    }

    /**
     * Set q13
     *
     * @param boolean $q13
     * @return QuestionCollectiviteConsolide
     */
    public function setQ13($q13)
    {
//        $this->q13 = $q13;
          $this->q13 = true;

        return $this;
    }

    /**
     * Get q13
     *
     * @return boolean
     */
    public function getQ13()
    {
//        return $this->q13;
        return true;
    }

    /**
     * Set q14
     *
     * @param boolean $q14
     * @return QuestionCollectiviteConsolide
     */
    public function setQ14($q14)
    {
//        $this->q14 = $q14;
          $this->q14 = true;

        return $this;
    }

    /**
     * Get q14
     *
     * @return boolean
     */
    public function getQ14()
    {
//        return $this->q14;
        return true;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QuestionCollectiviteConsolide
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
     * @return QuestionCollectiviteConsolide
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
     * @return QuestionCollectiviteConsolide
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
     * @return QuestionCollectiviteConsolide
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
     * Get idQuescollcons
     *
     * @return integer
     */
    public function getIdQuescollcons()
    {
        return $this->idQuescollcons;
    }


    function getEnquete() {
        return $this->enquete;
    }

    function getCollectivite() {
        return $this->collectivite;
    }

    function setEnquete($enquete) {
        $this->enquete = $enquete;
    }

    function setCollectivite($collectivite) {
        $this->collectivite = $collectivite;
    }



}
