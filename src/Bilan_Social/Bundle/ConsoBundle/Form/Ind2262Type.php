<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind2262;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind2262Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r22621', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR2262(this);changedDetect()',
                        )
                    ))
                ->add('r22622', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR2262(this);changedDetect()',
                        )
                    ))
                ->add('r22623', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR2262(this);changedDetect()',
                        )
                    ))
                ->add('r22624', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
                            'onChange'=> 'changedR2262(this);changedDetect()',
                        )
                    ))
                ->add('r22625', PurifiedNumberType::class, array(
                            'required' => false,
                            'attr' => array(
                                'class' => 'ind110 positiveInteger',
                                'onChange'=> 'changedR2262(this);changedDetect()',
                            )
                        ))
                ->add('r22626', PurifiedNumberType::class, array(
                                'required' => false,
                                'attr' => array(
                                    'class' => 'ind110 positiveInteger',
                                    'onChange'=> 'changedR2262(this);changedDetect()',
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
            'data_class' => Ind2262::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind2262';
    }


}

