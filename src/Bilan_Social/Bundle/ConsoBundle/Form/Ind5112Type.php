<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind5112;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFormation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind5112Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r51121', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                ->add('r51122', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                ->add('r51123', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                ->add('r51124', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                ->add('r51125', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                ->add('r51126', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                ->add('r51127', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                ->add('r51128', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange'=> 'changedR5112(this);changedDetect()',
                        )
                    ))
                 ->add('newCateg', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('lastCateg', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('refCategorie',  EntityType::class, array(
                        'required' => true,
                        'class' => RefCategorie::class,
                        'choice_label' => 'lbCate',
                        'label_attr' => array(
                            'class' => 'hidden'
                        ),
                        'attr' => array(
                            'class' => 'selectEntity hidden'
                        )
                    ))
                ->add('refFormation',  EntityType::class, array(
                        'required' => true,
                        'class' => RefFormation::class,
                        'choice_label' => 'lbForm',
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
            'data_class' => Ind5112::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind5112';
    }


}

