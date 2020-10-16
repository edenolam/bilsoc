<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefStageTitularisationData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefStageTitularisations = $this->getRefActeViolencePhysiquesList();

        foreach ($RefStageTitularisations as $key => $RefStageTitularisation) {

            $RefStageTitularisationEntity = (new RefStageTitularisation())
                    ->setCdStagtitu($RefStageTitularisation['cdStagtitu'])
                    ->setBlVali($RefStageTitularisation['BlVali'])
                    ->setLbStagtitu($RefStageTitularisation['lbStagtitu'])
                    ->setCdUtilcrea($RefStageTitularisation['CdUtilcrea']);
            ;

            $manager->persist($RefStageTitularisationEntity);

            $this->addReference('RefStageTitularisation' . $key, $RefStageTitularisationEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefStageTitularisation');
    }

    private function getRefActeViolencePhysiquesList() {
        return array(
            array(
                'cdStagtitu' => '1',
                'BlVali' => '1',
                'lbStagtitu' => 'loi Sauvadet',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdStagtitu' => '2',
                'BlVali' => '1',
                'lbStagtitu' => 'Motif 1',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdStagtitu' => '3',
                'BlVali' => '0',
                'lbStagtitu' => 'Autre motif',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
