<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind2113;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind2113Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r21131', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21132', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21133', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21134', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21135', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21136', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21137', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21138', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r21139', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('r211310', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2113(this);changedDetect()',
                        )
                    ))
                ->add('total2111', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('nbRowspan', HiddenType::class, array(
                        'required' => false
                    ))
                ->add('refMotifAbsence',  EntityType::class, array(
                        'required' => true,
                        'class' => RefMotifAbsence::class,
                        'choice_label' => 'lbMotiabse',
                        'label_attr' => array(
                            'class' => 'hidden'
                        ),
                        'attr' => array(
                            'class' => 'selectEntity hidden'
                        )
                    ))
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ind2113::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind2113';
    }


}

