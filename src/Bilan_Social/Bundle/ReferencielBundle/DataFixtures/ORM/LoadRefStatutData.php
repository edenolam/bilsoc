<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefStatutData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefStatuts = $this->getRefStatutList();

        foreach ($RefStatuts as $key => $RefStatut) {

            $RefStatutEntity = (new RefStatut())
                    ->setCdStat($RefStatut['cdStat'])
                    ->setBlVali($RefStatut['BlVali'])
                    ->setLbStat($RefStatut['lbStat'])
                    ->setCdUtilcrea($RefStatut['CdUtilcrea']);
            ;

            $manager->persist($RefStatutEntity);

            $this->addReference('RefStatut' . $key, $RefStatutEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefStatut');
    }

    private function getRefStatutList() {
        return array(
            array(
                'cdStat' => '1',
                'BlVali' => '1',
                'lbStat' => 'Stagiaire',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdStat' => '2',
                'BlVali' => '1',
                'lbStat' => 'Titulaires',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdStat' => '3',
                'BlVali' => '1',
                'lbStat' => 'Contractuel Permanent',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdStat' => '4',
                'BlVali' => '1',
                'lbStat' => 'Contractuel Non Permanent',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
