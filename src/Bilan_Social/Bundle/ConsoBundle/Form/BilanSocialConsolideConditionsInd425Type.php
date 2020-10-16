<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind425Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideConditionsInd425Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('q425', ChoiceType::class, array(
                    'label' => 'Avez-vous adhéré à un contrat d\'assurance statutaire pour la gestion du risque maladie ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'label_attr' => array('id' => 'labelq425'),
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
        return 'bscForm425';
    }

}
