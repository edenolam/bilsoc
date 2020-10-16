<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Bilan_Social\Bundle\ConsoBundle\Entity\QuestionCollectiviteConsolide;

class QuestionCollectiviteConsolideType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('q1', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq1'),
                ))
                ->add('q2', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq2'),
                ))
                ->add('q3', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq3'),
                ))
                ->add('q4', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq4'),
                ))
                ->add('q5', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq5'),
                ))
                ->add('q6', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq6'),
                ))
                ->add('q7', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq7'),
                ))
                ->add('q8', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq8'),
                ))
                ->add('q9', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq9'),
                ))
                ->add('q10', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq10'),
                ))
                ->add('q11', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq11'),
                ))
                ->add('q12', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq12'),
                ))
                ->add('q13', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq13'),
                ))
                ->add('q14', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array('id' => 'labelq14'),
                    'attr' => array(
                        'class' => 'toto',
                    )
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => QuestionCollectiviteConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'qccForm';
    }

}
