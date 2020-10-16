<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind431Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideConditionsInd431Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind431s', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind431Type::class
                ))
                ->add('q4311', ChoiceType::class, array(
                    'label' => 'Est-ce que certains agents de votre collectivité ont été victimes d\'actes de violence physique (y compris violences sexuelles) en ' . $options['anneeCamp'] . ', de la part d\'usagers ou d\'autres agents ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelq431'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q4312', ChoiceType::class, array(
                    'label' => 'Est-ce que certains agents de votre collectivité ont été victimes de harcèlement moral en '. $options['anneeCamp'] . ', de la part d\'usagers ou d\'autres agents ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelq4312'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('q4313', ChoiceType::class, array(
                    'label' => 'Est-ce que certains agents de votre collectivité ont été victimes de harcèlement sexuel ou agissements sexistes en '. $options['anneeCamp'] . ', de la part d\'usagers ou d\'autres agents ?',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelq4313'),
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
        return 'bscForm431';
    }

}
