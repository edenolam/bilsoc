<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefMotifDepartData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefMotifDeparts = $this->getRefMotifDepartList();

        foreach ($RefMotifDeparts as $key => $RefMotifDepart) {

            $RefMotifDepartEntity = (new RefMotifDepart())
                    ->setCdMotidepa($RefMotifDepart['cdMotidepa'])
                    ->setBlVali($RefMotifDepart['BlVali'])
                    ->setLbMotidepa($RefMotifDepart['lbMotidepa'])
                    ->setCdUtilcrea($RefMotifDepart['CdUtilcrea']);
            ;

            $manager->persist($RefMotifDepartEntity);

            $this->addReference('RefMotifDepart' . $key, $RefMotifDepartEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefMotifDepart');
    }

    private function getRefMotifDepartList() {
        return array(
            array(
                'cdMotidepa' => '1',
                'BlVali' => '1',
                'lbMotidepa' => 'Décès',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdMotidepa' => '2',
                'BlVali' => '1',
                'lbMotidepa' => 'Motif départ x',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdMotidepa' => '3',
                'BlVali' => '0',
                'lbMotidepa' => 'Motif départ y',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
