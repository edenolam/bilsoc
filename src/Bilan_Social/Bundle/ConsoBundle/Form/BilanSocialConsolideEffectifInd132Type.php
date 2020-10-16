<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind132Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind132BisType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideEffectifInd132Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind132s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind132Type::class
                ))
                ->add('ind132Biss', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind132BisType::class
                ))
                ->add('q132', ChoiceType::class, array(
                    'label'      => 'Avez-vous eu recours à du personnel temporaire provenant d\'une entreprise privée ou bien un CDG ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelq132'),
                    'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
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
        return 'bscForm132';
    }

}
