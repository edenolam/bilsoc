<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class BilanSocialConsolideTpsTravInd210Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('r2101', PurifiedTextType::class, array(
//                    'label'      => false,
//                    'required'   => true,
//                    'label_attr' => array('id' => 'r2101'),
//                    'attr'       => array(
//                        'class'    => 'ind110 positiveFloat025Rounded',
//                        'onchange' => 'changedDetect()',
//                    )
//                ))
                ->add('r2102', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required'   => true,
                    'label_attr' => array('id' => 'r2102'),
                    'attr'       => array(
                        'class'    => 'ind110 positiveFloat025Rounded',
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('r2103', ChoiceType::class, array(
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
                ->add('r2104', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required'   => true,
                    'label_attr' => array('id' => 'r2104'),
                    'attr'       => array(
                        'class'    => 'ind110 positiveFloat025Rounded',
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
        return 'bscForm210';
    }

}
