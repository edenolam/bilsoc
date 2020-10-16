<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2111Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2112Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2113Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideTpsTravInd211Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind2111s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2111Type::class
                ))
                ->add('ind2112s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2112Type::class
                ))
                ->add('ind2113s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2113Type::class
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
        return 'bscForm211';
    }

}
