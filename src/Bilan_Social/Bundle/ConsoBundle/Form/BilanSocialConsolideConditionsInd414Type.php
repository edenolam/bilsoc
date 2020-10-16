<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class BilanSocialConsolideConditionsInd414Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('q414', ChoiceType::class, array(
                    'label'      => 'Votre collectivité dispose-t-elle d\'un document unique d\'évaluation des risques professionnels ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'En cours' => 2),
                    'label_attr' => array('id' => 'labelq414'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('r4141', PurifiedNumberType::class, array(
                    'label' => false,
                    'required'   => false,
                    'label_attr' => array('id' => 'r4141'),
                    'attr' => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR414(this); changedDetect()',
                    )
                ))
                ->add('r4142', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'label_attr' => array('id' => 'r4142'),
                    'attr'       => array(
                        'class'    => 'ind110 positiveInteger',
                        'onChange' => 'changedR414(this); changedDetect()',
                    )
                ))
                ->add('q415', ChoiceType::class, array(
                    'label' => 'Votre collectivité dispose-t-elle d\'un plan de prévention des risques psychosociaux au 31/12/'. $options['anneeCamp'] .' ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'En cours' => 2),
                    'label_attr' => array('id' => 'labelq415'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q4161', ChoiceType::class, array(
                    'label' => 'Démarche de prévention des troubles musculo-squelettiques (TMS) ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'En cours' => 2),
                    'label_attr' => array('id' => 'labelq4161'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q4162', ChoiceType::class, array(
                    'label' => 'Démarche de prévention des risques cancérogènes, mutagènes, toxiques pour la reproduction (CMR) ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'En cours' => 2),
                    'label_attr' => array('id' => 'labelq4162'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q4163', ChoiceType::class, array(
                    'label' => 'D\'autres démarches de prévention des risques ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'En cours' => 2),
                    'label_attr' => array('id' => 'labelq4163'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q417', ChoiceType::class, array(
                    'label' => 'Votre collectivité dispose-t-elle d\'un registre de santé et de sécurité au travail ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'En cours' => 2),
                    'label_attr' => array('id' => 'labelq417'),
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
         $resolver->setRequired('anneeCamp');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscForm414';
    }

}
