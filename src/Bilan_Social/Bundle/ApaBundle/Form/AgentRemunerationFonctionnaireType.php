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

class AgentRemunerationFonctionnaireType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('r311h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r311h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r311f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r311f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3111h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3111h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3111f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3111f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3112h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3112h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3112f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3112f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3113h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3113h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3113f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3113f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3114h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3114h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r3114f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r3114f positiveFloatRoundedIntegerUp',
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
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationFonctionnaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_agentremunerationfonctionnaire';
    }

}
