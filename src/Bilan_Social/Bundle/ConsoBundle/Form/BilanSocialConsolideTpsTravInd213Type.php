<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2131Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2132Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2133Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideTpsTravInd213Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind2131s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2131Type::class
                ))
                ->add('ind2132s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2132Type::class
                ))
                ->add('ind2133s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2133Type::class
                ))
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscForm213';
    }

}
