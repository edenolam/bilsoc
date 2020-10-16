<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class ActeViolencePhysiqueType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('RefActeViolencePhysique', EntityType::class, array(
                    'class' => RefActeViolencePhysique::class,
                    'choice_label' => 'lbActviolphys',
                    'required' => false,
                    'label' => false,
                    'disabled' => true,
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'selectEntity hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('r5311', PurifiedNumberType::class, array(
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r5311'
                    )
                ))
                ->add('r5312', PurifiedNumberType::class, array(
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r5312'
                    )
                ))
                ->add('r4313', PurifiedNumberType::class, array(
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r4313'
                    )
                ))
                ->add('r4314', PurifiedNumberType::class, array(
                        'label' => false,
                        'label_attr' => array(
                            'class' => 'hidden'
                        ),
                        'attr' => array(
                            'class' => 'positiveInteger calculTot',
                            'data-name' => 'r4314'
                        )
                    ))
                ->add('r4315', PurifiedNumberType::class, array(
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r4315'
                    )
                ))->add('r4316', PurifiedNumberType::class, array(
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'positiveInteger calculTot',
                        'data-name' => 'r4316'
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\ActeViolencePhysique'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_acteviolencephysique';
    }

}
