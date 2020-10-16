<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind421;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind421Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r4211', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4212', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4213', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4214', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4215', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4216', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4217', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4218', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r4219', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r42110', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r42111', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
                        )
                    ))
                ->add('r42112', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveFloat',
                            'onChange'=> 'changedR421(this);changedDetect()',
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
            'data_class' => Ind421::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind421';
    }


}

