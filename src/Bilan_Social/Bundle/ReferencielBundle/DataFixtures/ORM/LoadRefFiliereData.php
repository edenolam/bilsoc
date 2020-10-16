<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefFiliereData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $RefFilieres = $this->getRefFiliereList();

        foreach ($RefFilieres as $key => $RefFiliere) {

            $RefFiliereEntity = (new RefFiliere())
                    ->setCdFili($RefFiliere['CdFili'])
                    ->setBlVali($RefFiliere['BlVali'])
                    ->setLbFili($RefFiliere['LbFili'])
                    ->setCdUtilcrea($RefFiliere['CdUtilcrea']);
            ;

            $manager->persist($RefFiliereEntity);

            $this->addReference('RefFiliere' . $key, $RefFiliereEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefFiliere');
    }

    private function getRefFiliereList() {
        return array(
            array(
                'CdFili' => '1',
                'BlVali' => '1',
                'LbFili' => 'Administrative',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '2',
                'BlVali' => '1',
                'LbFili' => 'Technique',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '3',
                'BlVali' => '1',
                'LbFili' => 'Culturelle',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '4',
                'BlVali' => '1',
                'LbFili' => 'Sportive',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '5',
                'BlVali' => '1',
                'LbFili' => 'Social',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '6',
                'BlVali' => '1',
                'LbFili' => 'Medico Sociale',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '7',
                'BlVali' => '1',
                'LbFili' => 'Medico-technique',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '8',
                'BlVali' => '1',
                'LbFili' => 'securité',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '9',
                'BlVali' => '1',
                'LbFili' => 'incendie secours',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdFili' => '10',
                'BlVali' => '1',
                'LbFili' => 'animation',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
