<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind132Bis;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind132BisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('r13221', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange'=> 'changedR132(this);changedDetect()',
                )
            ))
            ->add('r13222', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange'=> 'changedR132(this);changedDetect()',
                )
            ))
            ->add('r13223', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange'=> 'changedR132(this);changedDetect()',
                )
            ))
            ->add('r13224', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange'=> 'changedR132(this);changedDetect()',
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
            'data_class' => Ind132Bis::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind132Bis';
    }


}

