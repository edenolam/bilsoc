<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefContrainteTravail;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefContrainteTravailData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefContrainteTravails = $this->getRefContrainteTravailsList();

        foreach ($RefContrainteTravails as $key => $RefContrainteTravail) {

            $RefContrainteTravailEntity = (new RefContrainteTravail())
                    ->setCdConttrav($RefContrainteTravail['CdConttrav'])
                    ->setBlVali($RefContrainteTravail['BlVali'])
                    ->setLbConttrav($RefContrainteTravail['LbConttrav'])
                    ->setCdUtilcrea($RefContrainteTravail['CdUtilcrea']);
            ;

            $manager->persist($RefContrainteTravailEntity);

            $this->addReference('RefContrainteTravail' . $key, $RefContrainteTravailEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefContrainteTravail');
    }

    private function getRefContrainteTravailsList() {
        return array(
            array(
                'CdConttrav' => '1',
                'BlVali' => '1',
                'LbConttrav' => 'Contrainte 1',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdConttrav' => '2',
                'BlVali' => '1',
                'LbConttrav' => 'Contrainte 2',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdConttrav' => '3',
                'BlVali' => '0',
                'LbConttrav' => 'Contrainte 3',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
