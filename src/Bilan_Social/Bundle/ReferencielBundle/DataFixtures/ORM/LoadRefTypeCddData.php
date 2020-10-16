<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCdd;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefTypeCddData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefTypeCdds = $this->getRefTypeCddList();

        foreach ($RefTypeCdds as $key => $RefTypeCdd) {

            $RefTypeCddEntity = (new RefTypeCdd())
                    ->setCdTypecdd($RefTypeCdd['cdTypeCdd'])
                    ->setBlVali($RefTypeCdd['BlVali'])
                    ->setLbTypeCdd($RefTypeCdd['lbTypeCdd'])
                    ->setCdUtilcrea($RefTypeCdd['CdUtilcrea']);
            ;

            $manager->persist($RefTypeCddEntity);

            $this->addReference('RefTypeCdd' . $key, $RefTypeCddEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefTypeCdd');
    }

    private function getRefTypeCddList() {
        return array(
            array(
                'cdTypeCdd' => '1',
                'BlVali' => '1',
                'lbTypeCdd' => 'CDD 1',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdTypeCdd' => '2',
                'BlVali' => '1',
                'lbTypeCdd' => 'CDD 2',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdTypeCdd' => '3',
                'BlVali' => '1',
                'lbTypeCdd' => 'CDD 3',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdTypeCdd' => '4',
                'BlVali' => '1',
                'lbTypeCdd' => 'CDD 4',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdTypeCdd' => '5',
                'BlVali' => '1',
                'lbTypeCdd' => 'CDD 5',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
