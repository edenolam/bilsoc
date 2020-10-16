<?php

namespace Bilan_Social\Bundle\BilanSocialBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InitBilanSocialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('blDeclAgen', ChoiceType::class, array(
//                    'label' => false,
//                    'choices'  => array(
//                        true => 'Oui',
//                        false => 'Non',
//                    ),
//                    'expanded' => true,
//                    'multiple' => false,
//                ))
//                ->add('blBsExis', ChoiceType::class, array(
//                    'label' => false,
//                    'choices'  => array(
//                        true => 'Oui',
//                        false => 'Non',
//                    ),
//                    'expanded' => true,
//                    'multiple' => false,
//                ))
//                ->add('blApa', ChoiceType::class, array(
//                    'label' => false,
//                    'choices'  => array(
//                        true => 'Oui',
//                        false => 'Non',
//                    ),
//                    'expanded' => true,
//                    'multiple' => false,
//                ))
//                ->add('blCons', ChoiceType::class, array(
//                    'label' => false,
//                    'choices'  => array(
//                        true => 'Oui',
//                        false => 'Non',
//                    ),
//                    'expanded' => true,
//                    'multiple' => false,
//                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\BilanSocialBundle\Entity\InitBilanSocial'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_bilansocialbundle_initbilansocial';
    }


}
