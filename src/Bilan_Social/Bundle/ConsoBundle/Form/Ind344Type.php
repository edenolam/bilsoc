<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind344;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind344Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r3441', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat',
                            'onChange'=> 'changedR344(this);changedDetect()',
                        )
                    ))
                ->add('r3442', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat',
                            'onChange'=> 'changedR344(this);changedDetect()',
                        )
                    ))
                ->add('r3443', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat',
                            'onChange'=> 'changedR344(this);changedDetect()',
                        )
                    ))
                ->add('r3444', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat',
                            'onChange'=> 'changedR344(this);changedDetect()',
                        )
                    ))
                ->add('r3445', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('r3446', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('r3447', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('r3448', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('r3449', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('r34410', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('r34411', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('r34412', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveFloat',
                        'onChange'=> 'changedR344(this);changedDetect()',
                    )
                ))
                ->add('refCadreEmploi',  EntityType::class, array(
                        'required' => true,
                        'class' => RefCadreEmploi::class,
                        'choice_label' => 'lbCadrempl',
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
            'data_class' => Ind344::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind344';
    }


}

