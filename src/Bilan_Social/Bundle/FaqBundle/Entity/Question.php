<?php

namespace Bilan_Social\Bundle\FaqBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Question
 */
class Question
{
    /**
     * @var string
     * @Assert\NotBlank(message = "faq.sujet.not_blank")
     */
    private $sujet;

    /**
     * @var string
     * @Assert\NotBlank(message = "faq.question.not_blank")
     */
    private $question;

    /**
     * @var string
     * 
     */
    private $reponse;

    /**
     * @var boolean
     */
    private $blCloturer;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    private $IdColl;

    /**
     * @var boolean
     */
    private $questionRead;


    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return Question
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Question
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set blCloturer
     *
     * @param boolean $blCloturer
     *
     * @return Question
     */
    public function setBlCloturer($blCloturer)
    {
        $this->blCloturer = $blCloturer;

        return $this;
    }

    /**
     * Get blCloturer
     *
     * @return boolean
     */
    public function getBlCloturer()
    {
        return $this->blCloturer;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Question
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Question
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idColl
     *
     * @param \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $idColl
     *
     * @return Question
     */
    public function setIdColl(\Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite $idColl = null)
    {
        $this->IdColl = $idColl;

        return $this;
    }

    /**
     * Get idColl
     *
     * @return \Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite
     */
    public function getIdColl()
    {
        return $this->IdColl;
    }


    /**
     * Set questionRead
     *
     * @param boolean $questionRead
     *
     * @return Question
     */
    public function setQuestionRead($questionRead)
    {
        $this->questionRead = $questionRead;

        return $this;
    }

    /**
     * Get questionRead
     *
     * @return boolean
     */
    public function getQuestionRead()
    {
        return $this->questionRead;
    }
}

