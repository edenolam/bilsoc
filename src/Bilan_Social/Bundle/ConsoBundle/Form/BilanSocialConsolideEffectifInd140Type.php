<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind141Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind142Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind143Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind144Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BilanSocialConsolideEffectifInd140Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind141s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind141Type::class
                ))
                ->add('ind142s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind142Type::class
                ))
                ->add('ind143s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind143Type::class
                ))
                ->add('ind144s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind144Type::class
                ))
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))
//                ->add('enregistrer', SubmitType::class)
//                ->add('valider', SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscForm140';
    }

}
