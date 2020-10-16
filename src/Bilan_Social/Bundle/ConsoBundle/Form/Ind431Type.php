<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind431;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefActeViolencePhysique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind431Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r43111', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR431(this);changedDetect()',
                        )
                    ))
                ->add('r43112', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR431(this);changedDetect()',
                        )
                    ))
                ->add('r43121', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR431(this);changedDetect()',
                        )
                    ))
                ->add('r43122', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveInteger',
                        'onChange'=> 'changedR431(this);changedDetect()',
                    )
                ))
                ->add('r43131', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveInteger',
                        'onChange'=> 'changedR431(this);changedDetect()',
                    )
                ))
                ->add('r43132', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveInteger',
                        'onChange'=> 'changedR431(this);changedDetect()',
                    )
                ))                                                       
                ->add('refActeViolencePhysique',  EntityType::class, array(
                        'required' => true,
                        'class' => RefActeViolencePhysique::class,
                        'choice_label' => 'lbActviolphys',
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
            'data_class' => Ind431::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind431';
    }


}

