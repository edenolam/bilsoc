<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefAvancementPromotionConcoursData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $RefAvancementPromotionsConcours = $this->getRefAvancementPromotionConcoursList();

        foreach ($RefAvancementPromotionsConcours as $key => $RefAvancementPromotionConcours) {

            $RefAvancementPromotionConcoursEntity = (new RefAvancementPromotionConcours())
                    ->setCdAvanpromconc($RefAvancementPromotionConcours['CdAvanpromconc'])
                    ->setBlVali($RefAvancementPromotionConcours['BlVali'])
                    ->setLbAvanpromconc($RefAvancementPromotionConcours['LbAvanpromconc'])
                    ->setCdUtilcrea($RefAvancementPromotionConcours['CdUtilcrea']);
            ;

            $manager->persist($RefAvancementPromotionConcoursEntity);

            $this->addReference('RefAvancementPromotionConcours' . $key, $RefAvancementPromotionConcoursEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefAvancementPromotionConcours');
    }

    private function getRefAvancementPromotionConcoursList() {
        return array(
            array(
                'CdAvanpromconc' => '1',
                'BlVali' => '1',
                'LbAvanpromconc' => 'AvancementPromotionConcours 1',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdAvanpromconc' => '2',
                'BlVali' => '1',
                'LbAvanpromconc' => 'AvancementPromotionConcours 2',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdAvanpromconc' => '3',
                'BlVali' => '0',
                'LbAvanpromconc' => 'AvancementPromotionConcours 3',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
