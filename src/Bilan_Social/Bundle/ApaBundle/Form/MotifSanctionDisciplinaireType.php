<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifSanctionDisciplinaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class MotifSanctionDisciplinaireType extends AbstractType {

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
                ->add('RefMotifSanctionDisciplinaire', EntityType::class, array(
                    'class' => RefMotifSanctionDisciplinaire::class,
                    'choice_label' => 'lbMotiSancdisc',
                    'required' => false,
                    'disabled' => true,
                    'label' => false,
                    'attr' => array(
                        'class' => 'selectEntity hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\MotifSanctionDisciplinaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_motifSanctionDisciplinaire';
    }

}
