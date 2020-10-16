<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2121Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2122Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2123Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideTpsTravInd212Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind2121s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2121Type::class
                ))
                ->add('ind2122s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2122Type::class
                ))
                ->add('ind2123s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2123Type::class
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
        return 'bscForm212';
    }

}
