<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind344Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BilanSocialConsolideRemunerationInd344Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('ind344sTemp', CollectionType::class, array(
                'label' => false,
                'required' => false,
                'entry_type' => Ind344Type::class
            ))
            ->add('ind344AotmsTemp', CollectionType::class, array(
                'label' => false,
                'required' => false,
                'entry_type' => Ind344Type::class
            ))
            ->add('q344', ChoiceType::class, array(
                'label' => 'Votre collectivité est-elle concernée par les heures supplémentaires en 2017 ?',
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label_attr' => array('id' => 'labelq344'),
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
        return 'bscForm344';
    }

}
