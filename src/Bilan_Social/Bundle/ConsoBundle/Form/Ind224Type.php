<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Entity\Ind224;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind224Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r2241', PurifiedNumberType::class, array(
            'required' => false,
            'label' => false,
            'attr' => array(
                'class' => 'ind110 positiveInteger',
                'onChange' => 'changedR224(this);changedDetect()',
                'min' => 0,
            )
        ))
            ->add('r2242', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r2243', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r2244', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r2245', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r2246', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r2247', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r2248', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r2249', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r22410', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r22411', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r22412', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r22413', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r22414', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r22415', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ))
            ->add('r22416', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange' => 'changedR224(this);changedDetect()',
                    'min' => 0,
                )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ind224::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind224';
    }


}

