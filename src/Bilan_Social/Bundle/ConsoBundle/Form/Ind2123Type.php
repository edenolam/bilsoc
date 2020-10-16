<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind2123;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind2123Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r21231', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21232', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21233', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21234', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21235', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21236', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21237', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21238', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloatRounded',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r21239', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('r212310', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR2123(this);changedDetect()',
                        )
                    ))
                ->add('total2121', HiddenType::class, array(
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
            'data_class' => Ind2123::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind2123';
    }


}

