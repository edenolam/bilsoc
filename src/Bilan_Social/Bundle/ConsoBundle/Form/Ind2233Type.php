<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\Ind2233;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Ind2233Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('r22331', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat010Rounded',
                            'onChange'=> 'changedR2233(this);changedDetect()',
                        )
                    ))
                ->add('r22332', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat010Rounded',
                            'onChange'=> 'changedR2233(this);changedDetect()',
                        )
                    ))
                ->add('r22333', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat010Rounded',
                            'onChange'=> 'changedR2233(this);changedDetect()',
                        )
                    ))
                ->add('r22334', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat010Rounded',
                            'onChange'=> 'changedR2233(this);changedDetect()',
                        )
                    ))
                ->add('r22335', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat010Rounded',
                            'onChange'=> 'changedR2233(this);changedDetect()',
                        )
                    ))
                ->add('r22336', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveFloat010Rounded',
                            'onChange'=> 'changedR2233(this);changedDetect()',
                        )
                    ))
                ->add('r22337', PurifiedNumberType::class, array(
                            'required' => false,
                            'attr' => array(
                                'class' => 'ind110 positiveFloat010Rounded',
                                'onChange'=> 'changedR2233(this);changedDetect()',
                            )
                        ))
                ->add('r22338', PurifiedNumberType::class, array(
                                'required' => false,
                                'attr' => array(
                                    'class' => 'ind110 positiveFloat010Rounded',
                                    'onChange'=> 'changedR2233(this);changedDetect()',
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
            'data_class' => Ind2233::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ind2233';
    }


}

