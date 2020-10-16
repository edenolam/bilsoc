<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1531;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind1531Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r15311', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1531(this);changedDetect()',
                        )
                    ))
                ->add('r15312', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1531(this);changedDetect()',
                        )
                    ))
                ->add('r15313', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1531(this);changedDetect()',
                        )
                    ))
                ->add('r15314', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1531(this);changedDetect()',
                        )
                    ))
                ->add('refMotifArrivee',  EntityType::class, array(
                        'required' => true,
                        'class' => RefMotifArrivee::class,
                        'choice_label' => 'lbMotiarri',
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
            'data_class' => Ind1531::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind1531';
    }


}

