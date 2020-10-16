<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind1501;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind1501Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r15011', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('r15012', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('r15013', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('r15014', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('r15015', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('r15016', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('r15017', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('r15018', PurifiedNumberType::class, array(
                    'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR1501(this);changedDetect()',
                        )
                    ))
                ->add('nbRowspan', HiddenType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110'
                        )
                    ))
                ->add('refMotifDepart',  EntityType::class, array(
                        'required' => true,
                        'class' => RefMotifDepart::class,
                        'choice_label' => 'lbMotidepa',
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
            'data_class' => Ind1501::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind1501';
    }


}

