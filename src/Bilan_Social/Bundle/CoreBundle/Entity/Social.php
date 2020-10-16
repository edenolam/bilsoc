<?php

namespace Bilan_Social\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Social
 */
class Social {

    /**
     * @var int
     *
     */
    private $id;

    /**
     * @var string
     *
     */
    private $field1;

    /**
     * @var int
     *
     */
    private $field2;

    /**
     * @var int
     *
     */
    private $field3;

    /**
     * @var User
     *
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set field1
     *
     * @param string $field1
     * @return Social
     */
    public function setField1($field1) {
        $this->field1 = $field1;

        return $this;
    }

    /**
     * Get field1
     *
     * @return string
     */
    public function getField1() {
        return $this->field1;
    }

    /**
     * Set field2
     *
     * @param integer $field2
     * @return Social
     */
    public function setField2($field2) {
        $this->field2 = $field2;

        return $this;
    }

    /**
     * Get field2
     *
     * @return integer
     */
    public function getField2() {
        return $this->field2;
    }

    /**
     * Set field3
     *
     * @param integer $field3
     * @return Social
     */
    public function setField3($field3) {
        $this->field3 = $field3;

        return $this;
    }

    /**
     * Get field3
     *
     * @return integer
     */
    public function getField3() {
        return $this->field3;
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

    /**
     * @Assert\Callback
     */
    public function isValidField1(ExecutionContextInterface $context) {
        $field1 = (int) $this->getField1();
        $field2 = $this->getField2();
        $field3 = $this->getField3();

        if (is_null($field1) || is_null($field2) || is_null($field3)) {
            return;
        }

        if ($field1 != $field2 + $field3) {
            $context
                    ->buildViolation('La valeur du champ 1 doit être égale à la somme des champs 2 et 3')
                    ->atPath('field1')
                    ->addViolation();
        }
    }

}
