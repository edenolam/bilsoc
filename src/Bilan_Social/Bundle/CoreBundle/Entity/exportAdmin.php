<?php

namespace Bilan_Social\Bundle\CoreBundle\Entity;

/**
 * exportAdmin
 */
class exportAdmin
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $theme;

    /**
     * @var string
     */
    private $action;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $type;

    /**
     * @var boolean
     */
    private $fgStat;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $refs;

    /**
     * @var boolean
     */
    private $blLongTask;

    private $profils;

    /**
     * Constructor
     */
    public function __construct() {
        $this->profils = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return exportAdmin
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return exportAdmin
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return exportAdmin
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return exportAdmin
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return exportAdmin
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set fgStat
     *
     * @param boolean $fgStat
     *
     * @return exportAdmin
     */
    public function setFgStat($fgStat)
    {
        $this->fgStat = $fgStat;

        return $this;
    }

    /**
     * Get fgStat
     *
     * @return boolean
     */
    public function getFgStat()
    {
        return $this->fgStat;
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
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * Set refs
     *
     * @param integer $refs
     *
     * @return exportAdmin
     */
    public function setRefs($refs)
    {
        $this->refs = $refs;

        return $this;
    }

    /**
     * Get refs
     *
     * @return integer
     */
    public function getRefs()
    {
        return $this->refs;
    }

    /**
     * Set blLongTask
     *
     * @param boolean $blLongTask
     *
     * @return exportAdmin
     */
    public function setBlLongTask($blLongTask)
    {
        $this->blLongTask = $blLongTask;

        return $this;
    }
    /**
     * Get blLongTask
     *
     * @return boolean
     */
    public function getBlLongTask()
    {
        return $this->blLongTask;
    }
    public function isLongTask()
    {
        return $this->blLongTask==true;
    }

    public function getProfils(){
        return $this->profils; 
    }
    public function setProfils($profils)
    {
        $this->profils = $profils;
        return $this;
    }

    public function addProfil($profil){
        $this->getProfils()->add($profil);
    }

    public function removeProfil($profil){
        $this->getProfils()->removeElement($profil);
    }

}

