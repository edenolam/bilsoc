<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFonctionPublique;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefFonctionPubliqueData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $RefFonctionPubliques = $this->getRefFonctionPubliqueList();

        foreach ($RefFonctionPubliques as $key => $RefFonctionPublique) {

            $RefFonctionPubliqueEntity = (new RefFonctionPublique())
                    ->setCdFoncpubl($RefFonctionPublique['cdFoncpubl'])
                    ->setBlVali($RefFonctionPublique['BlVali'])
                    ->setLbFoncpubl($RefFonctionPublique['lbFoncpubl'])
                    ->setCdUtilcrea($RefFonctionPublique['CdUtilcrea']);
            ;

            $manager->persist($RefFonctionPubliqueEntity);

            $this->addReference('RefFonctionPublique' . $key, $RefFonctionPubliqueEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefFonctionPublique');
    }

    private function getRefFonctionPubliqueList() {
        return array(
            array(
                'cdFoncpubl' => '1',
                'BlVali' => '1',
                'lbFoncpubl' => "fonction publique hospitalière",
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdFoncpubl' => '2',
                'BlVali' => '1',
                'lbFoncpubl' => "fonction publique d'État",
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'cdFoncpubl' => '3',
                'BlVali' => '1',
                'lbFoncpubl' => "fonction publique territoriale",
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
