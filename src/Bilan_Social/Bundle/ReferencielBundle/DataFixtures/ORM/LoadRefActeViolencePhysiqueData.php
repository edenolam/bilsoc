<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefActeViolencePhysiqueData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefActeViolencePhysiques = $this->getRefActeViolencePhysiquesList();

        foreach ($RefActeViolencePhysiques as $key => $RefActeViolencePhysique) {

            $RefActeViolencePhysiqueEntity = (new RefActeViolencePhysique())
                    ->setCdActviolphys($RefActeViolencePhysique['CdActviolphys'])
                    ->setBlVali($RefActeViolencePhysique['BlVali'])
                    ->setLbActviolphys($RefActeViolencePhysique['LbActviolphys'])
                    ->setCdUtilcrea($RefActeViolencePhysique['CdUtilcrea']);
            ;

            $manager->persist($RefActeViolencePhysiqueEntity);

            $this->addReference('RefActeViolencePhysique' . $key, $RefActeViolencePhysiqueEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefActeViolencePhysique');
    }

    private function getRefActeViolencePhysiquesList() {
        return array(
            array(
                'CdActviolphys' => '1',
                'BlVali' => '1',
                'LbActviolphys' => 'ActeViolencePhysique 1',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdActviolphys' => '2',
                'BlVali' => '1',
                'LbActviolphys' => 'ActeViolencePhysique 2',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdActviolphys' => '3',
                'BlVali' => '0',
                'LbActviolphys' => 'ActeViolencePhysique 3',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
