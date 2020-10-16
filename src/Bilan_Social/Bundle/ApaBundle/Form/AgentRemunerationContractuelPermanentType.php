<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class AgentRemunerationContractuelPermanentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('r321h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r321h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r321f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r321f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3211h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3211h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3211f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3211f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3114h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3214h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3114f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3214f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('refCategorie', EntityType::class, array(
                    'class' => RefCategorie::class,
                    'choice_label' => 'lbCate',
                    'label' => false,
                    'disabled' => true,
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
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelPermanent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_agentremucontperm';
    }

}
