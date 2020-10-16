<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class ActionPreventionType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

                ->add('RefActionPreventions', EntityType::class, array(
                    'class' => RefActionPrevention::class,
                    'choice_label' => 'lbActionPrev',
                    'choice_value' => 'cdActionPrev',
                    'required'     => false,
                    'label' => false,
                    'attr' => array(
                      'class' => 'selectEntity hidden'  
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('r5121', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => "positiveFloatRoundedIntegerUp",
                    )
                ))
                ->add('r5122', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => "positiveInteger",
                    )
                ))
                ->add('nbAgent', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => "positiveInteger",
                    )
                ))
//                ->add('r5123', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloatRoundedIntegerUp",
//                    )
//                ))
//                ->add('r5124', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloatRoundedIntegerUp",
//                    )
//                ))
//                ->add('r5125', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloatRoundedIntegerUp",
//                    )
//                ))
//                ->add('r5126', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveInteger",
//                    )
//                ))
//                ->add('r5127', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloatRoundedIntegerUp",
//                    )
//                ))
//                ->add('r5128', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloatRoundedIntegerUp",
//                    )
//                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\ActionPrevention'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_actionprevention';
    }

}
