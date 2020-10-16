<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind132;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind132Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r13211', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR132(this);changedDetect()',
                        )
                    ))
                ->add('r13212', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR132(this);changedDetect()',
                        )
                    ))
                ->add('r13213', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveInteger',
                        'onChange'=> 'changedR132(this);changedDetect()',
                    )
                ))
                ->add('r13214', PurifiedNumberType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'ind110 positiveInteger',
                        'onChange'=> 'changedR132(this);changedDetect()',
                    )
                ))
                ->add('refFiliere',  EntityType::class, array(
                        'required' => true,
                        'class' => RefFiliere::class,
                        'choice_label' => 'lbFili',
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
            'data_class' => Ind132::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind132';
    }


}

