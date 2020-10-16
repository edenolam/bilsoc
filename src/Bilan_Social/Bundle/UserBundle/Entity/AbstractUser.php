<?php

namespace Bilan_Social\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Abstract class User
 */
abstract class AbstractUser {

    const ROLE_DEFAULT = 'ROLE_USER';
    const ROLE_CDG = 'ROLE_CDG';
    const ROLE_COLLECTIVITY = 'ROLE_COLLECTIVITY';
    const ROLE_DGCL = 'ROLE_DGCL';
    const ROLE_INFOCENTRE = 'ROLE_INFOCENTRE';

    /**
     */
    protected $email;

    /**
     */
    protected $postalCode;

    /*
     */
    protected $department;

    /**
     * Get postal code
     */
    public function getPostalCode() {
        return $this->postalCode;
    }

    /**
     * Set postal code
     */
    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * Get department
     */
    public function getDepartment() {
        return $this->department;
    }

    /**
     * Set department
     */
    public function setDepartment($department) {
        $this->department = $department;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

}
