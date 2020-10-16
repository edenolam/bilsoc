<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefEmploiFonctionnelData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $RefEmploiFonctionnels = $this->getRefEmploiFonctionnelList();

        foreach ($RefEmploiFonctionnels as $key => $RefEmploiFonctionnel) {

            $RefEmploiFonctionnelEntity = (new RefEmploiFonctionnel())
                    ->setCdEmplfonc($RefEmploiFonctionnel['CdEmplfonc'])
                    ->setBlVali($RefEmploiFonctionnel['BlVali'])
                    ->setLbEmplfonc($RefEmploiFonctionnel['LbEmplfonc'])
                    ->setCdUtilcrea($RefEmploiFonctionnel['CdUtilcrea']);
            ;

            $manager->persist($RefEmploiFonctionnelEntity);

            $this->addReference('RefEmploiFonctionnel' . $key, $RefEmploiFonctionnelEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefEmploiFonctionnel');
    }

    private function getRefEmploiFonctionnelList() {
        return array(
            array(
                'CdEmplfonc' => '1',
                'BlVali' => '1',
                'LbEmplfonc' => 'Directeur général des services ou directeur',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdEmplfonc' => '2',
                'BlVali' => '1',
                'LbEmplfonc' => 'Directeur général adjoint des services ou directeur adjoint',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdEmplfonc' => '3',
                'BlVali' => '1',
                'LbEmplfonc' => 'Directeur général des services techniques',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdEmplfonc' => '4',
                'BlVali' => '1',
                'LbEmplfonc' => 'Directeur des services techniques',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),

        );
    }

}
