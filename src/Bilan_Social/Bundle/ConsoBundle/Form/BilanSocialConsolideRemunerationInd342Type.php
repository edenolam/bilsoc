<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideRemunerationInd342Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('q3421', ChoiceType::class, array(
                    'label' => 'êtes-vous en auto-assurance sans convention de gestion avec Pôle Emploi?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'label_attr' => array('id' => 'labelq3421'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q3422', ChoiceType::class, array(
                    'label' => 'êtes-vous en auto-assurance avec convention de gestion avec Pôle Emploi?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'label_attr' => array('id' => 'labelq3422'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q3423', ChoiceType::class, array(
                    'label' => 'avez-vous adhéré au Régime d\'assurance chômage?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'label_attr' => array('id' => 'labelq3423'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('r342', PurifiedNumberType::class, array(
                        'required' => false,
                        'attr' => array(
                            'class' => 'ind110 positiveInteger',
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
        return 'bscForm342';
    }

}
