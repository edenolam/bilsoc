<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class HeuSuppReaRemAgentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('refStatut', EntityType::class, array(
                    'class' => RefStatut::class,
                    'choice_label' => 'lbStat',
                    'required' => false,
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'attr' => array(
                        'class' => 'SelectStatus',
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('refFiliere', EntityType::class, array(
                    'class' => RefFiliere::class,
                    'attr' => array(
                      'class' => 'SelectFiliere',  
                    ),
                    'choice_label' => 'lbfili',
                    'required' => false,
                    'label' => false,
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
                ->add('refCadreEmploi', EntityType::class, array(
                    'class' => RefCadreEmploi::class,
                    'choice_label' => 'lbCadrempl',
                     'attr' => array(
                      'class' => 'SelectCadreEmploi',  
                    ),
                    'choice_value' => 'idCadrempl',
                    'required' => false,
                    'label' => false,
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
                ->add('blTempsComplet', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label' => false,
                    'expanded' => false,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'SelectBlTempsComp',
                    ),
                ))
                ->add('nbHeure', PurifiedNumberType::class, array(
                    'attr' => array(
                        'class' => 'positiveFloatRoundedIntegerUp', 
                    )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\HeuSuppReaRemAgent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_heusupprearemagent';
    }

}
