<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideTpsTravInd217Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder ->add('r2171', ChoiceType::class, array(
            'label' => false,
            'required' => true,
            'expanded' => true,
            'multiple' => false,
            'choices' => array('Oui' => 1, 'Non' => 0),
            'label_attr' => array('id' => 'r2103'),
            'attr' => array(
                'onChange' => 'changedR224(this);changedDetect()',
            )
        ))
            ->add('r2172', ChoiceType::class, array(
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'r2103'),
                'attr' => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('r2173', ChoiceType::class, array(
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'r2103'),
                'attr' => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('r2174', ChoiceType::class, array(
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'r2103'),
                'attr' => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('r2175', ChoiceType::class, array(
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'r2103'),
                'attr' => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('r2176', ChoiceType::class, array(
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'r2103'),
                'attr' => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('r2177', ChoiceType::class, array(
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'r2103'),
                'attr' => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('r2178', ChoiceType::class, array(
                'label' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'r2103'),
                'attr' => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            ->add('valide', HiddenType::class, array(
                'mapped' => false
            ))

        ;

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscForm217';
    }

}
