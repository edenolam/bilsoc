<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind171Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideEffectifInd171Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind171s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind171Type::class
                ))
                ->add('ind171sTemp', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind171TempType::class
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
        return 'bscForm171';
    }

}
