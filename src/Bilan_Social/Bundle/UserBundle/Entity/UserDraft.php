<?php

namespace Bilan_Social\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserDraft
 */
class UserDraft extends AbstractUser {

    protected $id;
    protected $user;

    /**
     * Get Id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set User
     *
     * @param User $user
     */
    public function setUser(User $user) {
        $this->user = $user;
    }

    /**
     * Get User
     *
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

}
