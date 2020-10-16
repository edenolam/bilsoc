<?php

namespace Bilan_Social\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * SocialStep2
 *
 */
class SocialStep2 {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     *
     */
    private $field1;

    /**
     * @var string
     *
     */
    private $field2;

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
     * @return SocialStep2
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
     * @param string $field2
     * @return SocialStep2
     */
    public function setField2($field2) {
        $this->field2 = $field2;

        return $this;
    }

    /**
     * Get field2
     *
     * @return string
     */
    public function getField2() {
        return $this->field2;
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
    public function isEqualField1AndField2(ExecutionContextInterface $context) {
        $field1 = $this->getField1();
        $field2 = $this->getField2();

        if (is_null($field1) || is_null($field2)) {
            return;
        }

        if ($field1 == $field2) {
            $context
                    ->buildViolation('La valeur du champ 2 ne doit pas être égale à la valeur du champ 1')
                    ->atPath('field2')
                    ->addViolation();
        }
    }

}
