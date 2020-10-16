<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind121Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideEffectifInd121Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind121sTemp', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind121Type::class
                ))
                ->add('ind121AotmsTemp', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind121Type::class
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
        return 'bscForm121';
    }

}
