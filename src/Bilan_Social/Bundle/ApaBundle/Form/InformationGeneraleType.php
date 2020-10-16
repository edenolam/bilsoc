<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class InformationGeneraleType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//        ->add('idEnqu')
//                ->add('idColl')
//                ->add('q1', ChoiceType::class, array(
//                    'label' => 'Souhaitez-vous saisir la rémunération agent par agent ?',
//                    'choices' => array('Oui' => 1, 'Non' => 0), 
//                    'expanded' => true,
//                    'multiple' => false,
//                    'placeholder' => false,
//                ))
                ->add('q2', ChoiceType::class, array(
                    'label' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                ))
                ->add('q3', ChoiceType::class, array(
                    'label'       => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                ))
//                ->add('q4', ChoiceType::class, array(
//                    'label'       => false,
//                    'choices' => array('Oui' => 1, 'Non' => 0),
//                    'expanded' => true,
//                    'multiple' => false,
//                    'placeholder' => false,
//                ))
//                ->add('q5', ChoiceType::class, array(
//                    'label'       => 'Existe-t-il un dispositif d’entretiens spécifiques pour congés de 6 mois et plus au retour de congés ?',
//                    'choices' => array('Oui' => 1, 'Non' => 0),
//                    'expanded' => true,
//                    'multiple' => false,
//                    'placeholder' => false,
//                ))
                ->add('q6', ChoiceType::class, array(
                    'label'       => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                ))
                ->add('q7', ChoiceType::class, array(
                    'label'       => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                ))
//                ->add('agentremufonctionnaire', CollectionType::class, array(
//                    'entry_type' => AgentRemunerationFonctionnaireType::class,
//                    'allow_add' => true,
//                    'required' => false,
//                    'label_attr' => array(
//                        'class' => 'hidden'
//                    ),
//                    'constraints' => new Valid(),
//                ))
//                ->add('agentremucontnonperm', CollectionType::class, array(
//                    'entry_type' => AgentRemunerationContractuelNonPermanentType::class,
//                    'allow_add' => true,
//                    'required' => false,
//                    'label_attr' => array(
//                        'class' => 'hidden'
//                    ),
//                ))
//                ->add('agentremucontperm', CollectionType::class, array(
//                    'entry_type' => AgentRemunerationContractuelPermanentType::class,
//                    'allow_add' => true,
//                    'required' => false,
//                    'label_attr' => array(
//                        'class' => 'hidden'
//                    ),
//                ))
                ->add('blHeursupp', ChoiceType::class, array(
                    'label' => 'Votre collectivité est elle concernée par les heures supplémentaires ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blHeurcomp', ChoiceType::class, array(
                    'label' => 'Votre collectivité est elle concernée par les heures complémentaires ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('Enregistrer', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
                    'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\InformationGenerale',
            'constraints' => new Valid(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_informationgenerale';
    }

}
