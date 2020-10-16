<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Entity;

/**
 * ModelMailInterneAppli
 */
class ModelMailInterneAppli
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $codeApp;

    /**
     * @var string
     */
    private $objet;

    /**
     * @var string
     */
    private $body;


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
     * Set codeApp
     *
     * @param string $codeApp
     *
     * @return ModelMailInterneAppli
     */
    public function setCodeApp($codeApp)
    {
        $this->codeApp = $codeApp;

        return $this;
    }

    /**
     * Get codeApp
     *
     * @return string
     */
    public function getCodeApp()
    {
        return $this->codeApp;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return ModelMailInterneAppli
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
     * @return ModelMailInterneAppli
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
}

