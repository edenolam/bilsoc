<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BilanSocialConsolideDroitInd711Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('q7111', ChoiceType::class, array(
                        'label' => 'Subventions versées au comité d\'œuvres sociales local ou autres organismes propres à la collectivité',
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelq7111'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('q7112', ChoiceType::class, array(
                        'label' => 'Cotisations et subventions à un comité intercollectivités (ou à un autre organisme intercollectivités)',
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelq7112'),
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
        return 'bscForm';
    }

}
