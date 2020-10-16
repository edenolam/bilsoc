<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BilanSocialConsolideDroitInd713Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('q7131', ChoiceType::class, array(
                        'label' => 'Places réservées en crèche',
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelq7131'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('q7132', ChoiceType::class, array(
                        'label' => 'Aides financières pour la garde d\'enfants ou les activités péri-scolaires',
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelq7132'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('q7133', ChoiceType::class, array(
                        'label' => 'Autres',
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'labelq7133'),
                        'attr' => array(
                            'onchange' => 'changedDetect()',
                        )
                    ))
                ->add('r7133', PurifiedTextareaType::class, array(
                    'label' => 'Description : ',
                    'required' => false,
                    'attr' => array(
                        'maxlength' => 50,
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
