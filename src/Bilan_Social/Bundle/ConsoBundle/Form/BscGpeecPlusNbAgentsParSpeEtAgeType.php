<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BscGpeecPlusNbAgentsParSpeEtAge;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BscGpeecPlusNbAgentsParSpeEtAgeType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rNb1', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class'    => 'positiveInteger',
                        'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect() ',
                    )
                    ))
                ->add('rNb2', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb3', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb4', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb5', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb6', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb7', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb8', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb9', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('rNb10', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'positiveInteger',
                            'onChange' => 'changedRPlusNbAgentsParSpeEtAge(this); changedDetect()',
                    )
                    ))
                ->add('refSpecialite', EntityType::class, array(
                    'required' => true,
                        'class'        => RefSpecialite::class,
                    'choice_label' => 'lbSpecialite',
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
            'data_class' => BscGpeecPlusNbAgentsParSpeEtAge::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bscGpeecPlusNbAgentsParSpeEtAge';
    }


}

