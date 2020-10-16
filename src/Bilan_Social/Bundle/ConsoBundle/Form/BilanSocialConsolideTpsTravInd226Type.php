<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2261Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2262Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2263Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideTpsTravInd226Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind2261s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2261Type::class
                ))
                ->add('ind2262s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2262Type::class
                ))
                ->add('ind2263s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2263Type::class
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
        return 'bscForm226';
    }

}
