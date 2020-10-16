<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\BscHanditorialAncienneteAgents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscHanditorialAncienneteAgentsType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('moinsUnAnH', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'      => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('moinsUnAnF', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'      => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('entreUnEtTroisH', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('entreUnEtTroisF', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('entreQuatreEtSixH', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('entreQuatreEtSixF', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('entreSeptEtDouzeH', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('entreSeptEtDouzeF', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('plusDouzeH', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('plusDouzeF', PurifiedNumberType::class, array(
                    'required' => false,
                    'label'    => false,
                    'attr'     => array(
                        'class' => 'ind110 positiveInteger',
                        'min'   => 0,
                        'onchange' => 'changedDetect()',
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BscHanditorialAncienneteAgents::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscHanditorialAncienneteAgents';
    }

}
