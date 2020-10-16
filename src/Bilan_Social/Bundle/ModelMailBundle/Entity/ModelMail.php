<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Entity;

/**
 * ModelMail
 */
class ModelMail
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $objet;

    /**
     * @var string
     */
    private $body;

    /**
     * @var bool
     */
    private $blVali;



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
     * Set objet
     *
     * @param string $objet
     *
     * @return ModelMail
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return ModelMail
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set blVali
     *
     * @param boolean $blVali
     *
     * @return ModelMail
     */
    public function setBlVali($blVali)
    {
        $this->blVali = $blVali;

        return $this;
    }

    /**
     * Get blVali
     *
     * @return bool
     */
    public function getBlVali()
    {
        return $this->blVali;
    }

}

