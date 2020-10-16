<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Entity;

class MessagePasswordByAdmin {

    /**
     * @var int
     */
    private $idMessPass;

    /**
     * @var string
     */
    private $cmMessPass;

    /*
     * @var User
     */
    private $admin;

    /**
     * Get idMessPass
     *
     * @return int
     */
    public function getIdMessPass() {
        return $this->idMessPass;
    }

    /**
     * Set cmMessPass
     *
     * @param string $cmMessPass
     *
     * @return MessagePasswordByAdmin
     */
    public function setCmMessPass($cmMessPass) {
        $this->cmMessPass = $cmMessPass;

        return $this;
    }

    /**
     * Get cmMessPass
     *
     * @return string
     */
    public function getCmMessPass() {
        return $this->cmMessPass;
    }

    /**
     * Set admin
     *
     * @param User $admin
     *
     * @return admin
     */
    public function setAdmin($admin) {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return User
     */
    public function getAdmin() {
        return $this->admin;
    }

}
