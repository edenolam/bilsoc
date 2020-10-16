<?php

namespace Bilan_Social\Bundle\ReferencielBundle\DataFixtures\ORM;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadRefGradeData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $RefGrades = $this->getRefGradeList();

        foreach ($RefGrades as $key => $RefGrade) {

            $RefGradeEntity = (new RefGrade())
                    ->setCdGrad($RefGrade['CdGrad'])
                    ->setBlVali($RefGrade['BlVali'])
                    ->setLbGrad($RefGrade['LbGrad'])
                    ->setRefCadreEmploi($RefGrade['refCadreEmploi'])
                    ->setCdUtilcrea($RefGrade['CdUtilcrea']);
            ;

            $manager->persist($RefGradeEntity);

            $this->addReference('RefGrade' . $key, $RefGradeEntity);
        }
        $manager->flush();
    }

    public function getOrder() {
        return $this->container->getParameter('fixture.order.RefGrade');
    }

    private function getRefGradeList() {
        return array(
            array(
                'CdGrad' => '1',
                'BlVali' => '1',
                'LbGrad' => 'Administrateur Général',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi0'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '2',
                'BlVali' => '1',
                'LbGrad' => 'Attaché principal',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi1'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '3',
                'BlVali' => '1',
                'LbGrad' => 'Attaché',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi1'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '4',
                'BlVali' => '1',
                'LbGrad' => 'Directeur territorial',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi1'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '5',
                'BlVali' => '1',
                'LbGrad' => 'Administrateur hors classe',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi0'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '6',
                'BlVali' => '1',
                'LbGrad' => 'Administrateur ',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi0'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '7',
                'BlVali' => '1',
                'LbGrad' => 'Administrateur stagiaire',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi0'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '8',
                'BlVali' => '1',
                'LbGrad' => 'Attaché stagiaire',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi1'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '9',
                'BlVali' => '1',
                'LbGrad' => 'Secrétaire de mairie',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi2'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '10',
                'BlVali' => '1',
                'LbGrad' => 'Ingénieur',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi3'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
            array(
                'CdGrad' => '11',
                'BlVali' => '1',
                'LbGrad' => 'Ingénieur stagiaire',
                'refCadreEmploi' => $this->getReference('RefCadreEmploi3'),
                'CdUtilcrea' => $this->getReference('utilisateur0'),
            ),
        );
    }

}
