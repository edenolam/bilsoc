<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind216;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind216Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r2161', PurifiedNumberType::class, array(
            'required' => false,
            'attr' => array(
                'class' => 'ind110 positiveInteger',
                'onChange'=> 'changedR216(this);changedDetect()',
            )
        ))
            ->add('r2162', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'ind110 positiveInteger',
                    'onChange'=> 'changedR216(this);changedDetect()',
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
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ind216::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind216';
    }


}

