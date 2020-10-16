<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefCategorieData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $RefCategories = $this->getRefCategorieList();

        foreach ($RefCategories as $key => $RefCategorie) {

            $RefCategorieEntity = (new RefCategorie())
                    ->setCdCate($RefCategorie['CdCate'])
                    ->setBlVali($RefCategorie['BlVali'])
                    ->setLbCate($RefCategorie['LbCate'])
                    ->setCdUtilcrea($RefCategorie['CdUtilcrea']);
            ;

            $manager->persist($RefCategorieEntity);

            $this->addReference('RefCategorie' . $key, $RefCategorieEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefCategorie');
    }

    private function getRefCategorieList() {
        return array(
            array(
                'CdCate' => '1',
                'BlVali' => '1',
                'LbCate' => 'Categorie A',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdCate' => '2',
                'BlVali' => '1',
                'LbCate' => 'Categorie B',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdCate' => '3',
                'BlVali' => '1',
                'LbCate' => 'Categorie C',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
