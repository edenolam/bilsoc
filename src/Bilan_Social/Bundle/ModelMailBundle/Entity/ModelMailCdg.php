<?php

namespace Bilan_Social\Bundle\ModelMailBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * ModelMailCdg
 */
class ModelMailCdg
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idCdg;

    /**
     * @var string
     * @Assert\NotBlank(message = "modelMail.objet.not_blank")
     */
    private $object;

    /**
     * @var string
     * @Assert\NotBlank(message = "modelMail.body.not_blank")
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
     * Set idCdg
     *
     * @param integer $idCdg
     *
     * @return ModelMailCdg
     */
    public function setIdCdg($idCdg)
    {
        $this->idCdg = $idCdg;

        return $this;
    }

    /**
     * Get idCdg
     *
     * @return int
     */
    public function getIdCdg()
    {
        return $this->idCdg;
    }

    /**
     * Set object
     *
     * @param string $object
     *
     * @return ModelMailCdg
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return ModelMailCdg
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

