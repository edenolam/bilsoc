<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2231Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2232Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind2233Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideTpsTravInd223Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind2231s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2231Type::class
                ))
                ->add('ind2232s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2232Type::class
                ))
                ->add('ind2233s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind2233Type::class
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
        return 'bscForm223';
    }

}
