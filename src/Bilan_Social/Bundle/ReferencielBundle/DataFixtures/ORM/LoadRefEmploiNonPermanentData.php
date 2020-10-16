<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefEmploiNonPermanentData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefEmploiNonPermanents = $this->getRefEmploiNonPermanentList();

        foreach ($RefEmploiNonPermanents as $key => $RefEmploiNonPermanent) {

            $RefEmploiNonPermanentEntity = (new RefEmploiNonPermanent())
                    ->setCdEmplnonperm($RefEmploiNonPermanent['cdEmplnonperm'])
                    ->setBlVali($RefEmploiNonPermanent['BlVali'])
                    ->setLbEmplnonperm($RefEmploiNonPermanent['lbEmplnonperm'])
                    ->setCdUtilcrea($RefEmploiNonPermanent['CdUtilcrea']);
            ;

            $manager->persist($RefEmploiNonPermanentEntity);

            $this->addReference('RefEmploiNonPermanent' . $key, $RefEmploiNonPermanentEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefEmploiNonPermanent');
    }

    private function getRefEmploiNonPermanentList() {
        return array(
            array(
                'cdEmplnonperm' => '1',
                'BlVali' => '1',
                'lbEmplnonperm' => 'emploi de cabinet',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdEmplnonperm' => '2',
                'BlVali' => '1',
                'lbEmplnonperm' => 'RefEmploiNonPermanent 1',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdEmplnonperm' => '3',
                'BlVali' => '1',
                'lbEmplnonperm' => 'RefEmploiNonPermanent 2',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdEmplnonperm' => '4',
                'BlVali' => '1',
                'lbEmplnonperm' => 'RefEmploiNonPermanent 3',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
