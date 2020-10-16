<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefCadreEmploiData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $RefCadresEmploi = $this->getRefCadresEmploiList();

        foreach ($RefCadresEmploi as $key => $RefCadreEmploi) {

            $RefCadreEmploiEntity = (new RefCadreEmploi())
                    ->setCdCadrempl($RefCadreEmploi['CdCadrempl'])
                    ->setBlVali($RefCadreEmploi['BlVali'])
                    ->setLbCadrempl($RefCadreEmploi['LbCadrempl'])
                    ->setCdUtilcrea($RefCadreEmploi['CdUtilcrea'])
                    ->setRefCategorie($RefCadreEmploi['RefCategorie'])
                    ->setRefFiliere($RefCadreEmploi['RefFiliere'])
            ;

            $manager->persist($RefCadreEmploiEntity);

            $this->addReference('RefCadreEmploi' . $key, $RefCadreEmploiEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefCadreEmploi');
    }

    private function getRefCadresEmploiList() {
        return array(
            array(
                'CdCadrempl' => '1',
                'BlVali' => '1',
                'LbCadrempl' => 'Administrateur',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie0'),
                'RefFiliere' => $this->getReference('RefFiliere0'),
            ),
            array(
                'CdCadrempl' => '2',
                'BlVali' => '1',
                'LbCadrempl' => 'Attaché',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie0'),
                'RefFiliere' => $this->getReference('RefFiliere0'),
            ),
            array(
                'CdCadrempl' => '3',
                'BlVali' => '1',
                'LbCadrempl' => 'Secretaires de mairie',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie0'),
                'RefFiliere' => $this->getReference('RefFiliere0'),
            ),
            array(
                'CdCadrempl' => '4',
                'BlVali' => '1',
                'LbCadrempl' => 'Ingénieur',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie0'),
                'RefFiliere' => $this->getReference('RefFiliere1'),
            ),
            array(
                'CdCadrempl' => '5',
                'BlVali' => '0',
                'LbCadrempl' => 'Technicien',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie1'),
                'RefFiliere' => $this->getReference('RefFiliere1'),
            ),
            array(
                'CdCadrempl' => '6',
                'BlVali' => '0',
                'LbCadrempl' => 'Redacteur',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie1'),
                'RefFiliere' => $this->getReference('RefFiliere1'),
            ),
            array(
                'CdCadrempl' => '7',
                'BlVali' => '0',
                'LbCadrempl' => 'Adjoint Administratifs',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie2'),
                'RefFiliere' => $this->getReference('RefFiliere1'),
            ),
            array(
                'CdCadrempl' => '8',
                'BlVali' => '0',
                'LbCadrempl' => 'Agents de maitrise',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie2'),
                'RefFiliere' => $this->getReference('RefFiliere1'),
            ),
            array(
                'CdCadrempl' => '8',
                'BlVali' => '0',
                'LbCadrempl' => 'Adjoints Technique',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie2'),
                'RefFiliere' => $this->getReference('RefFiliere1'),
            ),
            array(
                'CdCadrempl' => '8',
                'BlVali' => '0',
                'LbCadrempl' => 'Adjoints Techniques des Etablissements d\'Enseignement',
                'CdUtilcrea' => $this->getReference('utilisateur0'),
                'RefCategorie' => $this->getReference('RefCategorie2'),
                'RefFiliere' => $this->getReference('RefFiliere1'),
            ),
        );
    }

}
