<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1511Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1512Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1513Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BilanSocialConsolideEffectifInd151Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind1511s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind1511Type::class
                ))
                ->add('ind1512s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind1512Type::class
                ))
                ->add('ind1513s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind1513Type::class
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
        return 'bscForm151';
    }

}
