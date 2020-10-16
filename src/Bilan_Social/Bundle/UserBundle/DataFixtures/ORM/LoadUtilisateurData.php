<?php

namespace Bilan_Social\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class LoadUtilisateurData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $users = $this->getUsersList();

        foreach ($users as $key => $user) {
            $encoder = new BCryptPasswordEncoder(13);

            $userEntity = (new User())
                    ->setUsername($user['username'])
                    ->setPassword($encoder->encodePassword($user['password'], null))
                    ->setEmail($user['email'])
                    ->setIsActive($user['is_active'])
                    ->setDepartment($user['departement'])
                    ->setCdgIsAuthorizedByCollectivity($user['CdgIsAuthorizedByCollectivity'])
                    ->setCanValidUserAccount($user['CanValidUserAccount'])
                    ->setIdColl($user['idcoll'])
                    ->setRoles($user['roles'])
            ;

            $manager->persist($userEntity);

            $this->addReference('utilisateur' . $key, $userEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.Utilisateur');
    }

    private function getUsersList() {
        return array(
            array(
                'username' => 'djoncour',
                'password' => 'iorga',
                'email' => 'djoncour@iorga.com',
                'is_active' => true,
                'roles' => array('ROLE_ADMIN'),
                'departement' => null,
                'CanValidUserAccount' => null,
                'CdgIsAuthorizedByCollectivity' => null,
                'idcoll' => null
            ),
            array(
                'username' => '73282932000074',
                'password' => 'siret',
                'email' => 'collectivity1@iorga.com',
                'is_active' => true,
                'roles' => array('ROLE_COLLECTIVITY'),
                'departement' => '59',
                'CdgIsAuthorizedByCollectivity' => true,
                'CanValidUserAccount' => null,
                'idcoll' => '1'
            ),
            array(
                'username' => '73282932000073',
                'password' => 'siret',
                'email' => 'collectivity2@iorga.com',
                'is_active' => true,
                'roles' => array('ROLE_COLLECTIVITY'),
                'departement' => '59',
                'CdgIsAuthorizedByCollectivity' => true,
                'CanValidUserAccount' => null,
                'idcoll' => '2'
            ),
            array(
                'username' => 'cdg59',
                'password' => 'cdg59',
                'email' => 'cdg59@iorga.com',
                'is_active' => true,
                'roles' => array('ROLE_CDG'),
                'departement' => '59',
                'CanValidUserAccount' => true,
                'CdgIsAuthorizedByCollectivity' => null,
                'idcoll' => null
            ),
            array(
                'username' => 'cdg75',
                'password' => 'cdg75',
                'email' => 'cdg75@iorga.com',
                'is_active' => true,
                'roles' => array('ROLE_CDG'),
                'departement' => '75',
                'CanValidUserAccount' => false,
                'CdgIsAuthorizedByCollectivity' => null,
                'idcoll' => null
            )
        );
    }

}
