<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifGreve;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefMotifGreveData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefMotifGreves = $this->getRefMotifGreveList();

        foreach ($RefMotifGreves as $key => $RefMotifGreve) {

            $RefMotifGreveEntity = (new RefMotifGreve())
                    ->setCdMotigrev($RefMotifGreve['cdMotigrev'])
                    ->setBlVali($RefMotifGreve['BlVali'])
                    ->setLbMotigrev($RefMotifGreve['lbMotigrev'])
                    ->setCdUtilcrea($RefMotifGreve['CdUtilcrea']);
            ;

            $manager->persist($RefMotifGreveEntity);

            $this->addReference('RefMotifGreve' . $key, $RefMotifGreveEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefMotifGreve');
    }

    private function getRefMotifGreveList() {
        return array(
            array(
                'cdMotigrev' => '1',
                'BlVali' => '1',
                'lbMotigrev' => "sur mot d'ordre national",
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdMotigrev' => '2',
                'BlVali' => '1',
                'lbMotigrev' => "sur mot d'ordre uniquement local",
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdMotigrev' => '3',
                'BlVali' => '1',
                'lbMotigrev' => "non précisé, autres",
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
