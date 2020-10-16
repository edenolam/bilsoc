<?php

namespace Bilan_Social\Bundle\UserBundle\Manager;

use Bilan_Social\Bundle\UserBundle\Entity\UserDraft;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserManager {

    /** @var EntityManager */
    protected $em;

    /** @var string */
    protected $class;

    /**
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, $class) {
        $this->em = $em;
        $this->class = $class;
    }

    /**
     * @return ObjectRepository
     */
    protected function getRepository() {
        return $this->em->getRepository($this->getClass());
    }

    /**
     * Accept change request
     *
     * @param UserDraft $userDraft
     */
    public function acceptChange(UserDraft $userDraft) {

        $user = $userDraft->getUser();

        $methods = array('postalCode', 'email', 'department');

        foreach ($methods as $method) {
            if ($newValue = $userDraft->{'get' . ucfirst($method)}()) {
                $user->{'set' . ucfirst($method)}($newValue);
            }
        }

        $user->setChangeRequest(false);
        $this->em->remove($userDraft);
        $this->em->flush();
    }

    /**
     * Reject change request
     *
     * @param UserDraft $userDraft
     */
    public function rejectChange(UserDraft $userDraft) {

        $user = $userDraft->getUser();
        $user->setChangeRequest(false);
        $this->em->remove($userDraft);
        $this->em->flush();
    }

    /**
     * Returns a collection with all user instances
     *
     * @return array
     */
    public function findUsers() {
        return $this->getRepository()->findAll();
    }

    /**
     * Return a collection with all CDG user instances
     *
     * @return array
     */
    public function findCDGUsers() {

        return $this->getRepository()->findByRoles('ROLE_CDG');
    }

    /**
     * Delete user
     *
     * @param User $user
     */
    public function deleteUser(User $user) {

        $this->em->remove($user);
        $this->em->flush();
    }

    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass() {
        if (false !== strpos($this->class, ':')) {
            $metadata = $this->objectManager->getClassMetadata($this->class);
            $this->class = $metadata->getName();
        }
        return $this->class;
    }

    public function findByUsername($username) {
        return $this->getRepository()->findOneBy(array('username' => $username));
    }

}
