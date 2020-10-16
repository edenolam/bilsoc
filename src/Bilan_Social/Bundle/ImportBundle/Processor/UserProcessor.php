<?php

namespace Bilan_Social\Bundle\ImportBundle\Processor;

use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\UserBundle\Manager\UserManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class UserProcessor implements ProcessorInterface {

    /** @var UserManager */
    protected $userManager;

    /* @var UserPasswordEncoder */
    protected $passwordEncoder;

    /**
     *
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager, UserPasswordEncoder $passwordEncoder) {
        $this->userManager = $userManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     *
     * @param array $item
     * @return User
     */
    public function process(array $item) {
        $user = $this->userManager->findByUsername($item['username']);

        if (!is_null($user)) {
            return null;
        }

        $user = new User();
        $user->setUsername($item['username']);
        $user->setRoles([$item['role']]);
        $user->setDepartment($item['department']);

        $encodedPassword = $this->passwordEncoder
                ->encodePassword($user, $item['password']);

        $user->setPassword($encodedPassword);

        return $user;
    }

}
