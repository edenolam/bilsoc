<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind6141Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind6142Type;

class BilanSocialConsolideDroitInd614Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind6141s', CollectionType::class, array(
                        'label' => false,
                        'required' => false,
                        'entry_type' => Ind6141Type::class
                ))
                ->add('ind6143s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind6143Type::class
                ))
                ->add('ind6144s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind6144Type::class
                ))
                ->add('ind6142s', CollectionType::class, array(
                        'label' => false,
                        'required' => false,
                        'entry_type' => Ind6142Type::class
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
        return 'bscForm';
    }

}
