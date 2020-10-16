<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefPositionStatutaireData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefPositionStatutaires = $this->getRefPositionStatutaireList();

        foreach ($RefPositionStatutaires as $key => $RefPositionStatutaire) {

            $RefPositionStatutaireEntity = (new RefPositionStatutaire())
                    ->setCdPosistat($RefPositionStatutaire['cdPosistat'])
                    ->setBlVali($RefPositionStatutaire['BlVali'])
                    ->setLbPosistat($RefPositionStatutaire['lbPosistat'])
                    ->setCdUtilcrea($RefPositionStatutaire['CdUtilcrea']);
            ;

            $manager->persist($RefPositionStatutaireEntity);

            $this->addReference('RefPositionStatutaire' . $key, $RefPositionStatutaireEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefPositionStatutaire');
    }

    private function getRefPositionStatutaireList() {
        return array(
            array(
                'cdPosistat' => '1',
                'BlVali' => '1',
                'lbPosistat' => 'activité',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdPosistat' => '2',
                'BlVali' => '1',
                'lbPosistat' => 'particulière',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
