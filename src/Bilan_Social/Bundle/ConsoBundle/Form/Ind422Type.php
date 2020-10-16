<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind422;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind422Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r4221', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
                        )
                    ))
                ->add('r4222', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
                        )
                    ))
                ->add('r4223', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
                        )
                    ))
                ->add('r4224', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
                        )
                    ))
                ->add('r4225', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
                        )
                    ))
                ->add('r4226', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
                        )
                    ))
                ->add('r4227', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
                        )
                    ))
                ->add('r4228', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR422(this);changedDetect()',
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
            'data_class' => Ind422::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind422';
    }


}

