<?php

namespace Bilan_Social\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Bilan_Social\Bundle\UserBundle\Entity\User;

/**
 * IncoherenceLog
 *
 *
 */
class IncoherenceLog {

    /**
     * @var int
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $message;

    /**
     * @var string
     */
    private $form;

    /**
     * @var string
     *
     */
    private $field;

    /**
     *
     * @var User
     */
    private $user;

    private $bilanSocialConsolide;

    private $tableNum;

    private $idToggle1;

    private $idToggle2;

    private $blIncoherence;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return IncoherenceLog
     */
    public function setMessage($message) {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Set form
     *
     * @param string $form
     * @return IncoherenceLog
     */
    public function setForm($form) {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return string
     */
    public function getForm() {
        return $this->form;
    }

    /**
     * Set field
     *
     * @param string $field
     * @return IncoherenceLog
     */
    public function setField($field) {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField() {
        return $this->field;
    }

    /**
     * Get User
     *
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set User
     *
     * @param User $user
     * @return $this
     */
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    function getBilanSocialConsolide() {
        return $this->bilanSocialConsolide;
    }

    function getTableNum() {
        return $this->tableNum;
    }

    function getIdToggle1() {
        return $this->idToggle1;
    }

    function getIdToggle2() {
        return $this->idToggle2;
    }

    function setBilanSocialConsolide($bilanSocialConsolide) {
        $this->bilanSocialConsolide = $bilanSocialConsolide;
    }

    function setTableNum($tableNum) {
        $this->tableNum = $tableNum;
    }

    function setIdToggle1($idToggle1) {
        $this->idToggle1 = $idToggle1;
    }

    function setIdToggle2($idToggle2) {
        $this->idToggle2 = $idToggle2;
    }

    function getBlIncoherence() {
        return (  $this->blIncoherence == false ? 0 : 1);
    }

    function setBlIncoherence($blIncoherence) {
        $this->blIncoherence = $blIncoherence;
    }





}
