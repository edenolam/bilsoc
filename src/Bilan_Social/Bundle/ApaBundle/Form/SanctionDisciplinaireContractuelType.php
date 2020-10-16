<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSanctionDisciplinaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class SanctionDisciplinaireContractuelType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nbAgentsH', PurifiedNumberType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => "positiveInteger",
                ),
                'label_attr' => array(
                    'class' => 'hidden'
                ),
            ))
            ->add('nbAgentsF', PurifiedNumberType::class, array(
                'label' => false,
                'attr' => array(
                    'class' => "positiveInteger",
                ),
                'label_attr' => array(
                    'class' => 'hidden'
                ),
            ))
            ->add('RefSanctionDisciplinaire', EntityType::class, array(
                'class' => RefSanctionDisciplinaire::class,
                'choice_label' => 'lbSancdisc',
                'required' => false,
                'disabled' => true,
                'label' => false,
                'attr' => array(
                    'class' => 'selectEntity hidden'
                ),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->andWhere('u.bl614G6 = :bl614G6')
                        ->setParameter('blVali', '0')
                        ->setParameter('bl614G6', '1')
                        ;
                },
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\SanctionDisciplinaireContractuel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_sanctionDisciplinaireContractuel';
    }

}
