<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class Ind227Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('r2271', ChoiceType::class, array(
                    'label' => false,
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'label_attr' => array('id' => 'r2271'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('r2272', ChoiceType::class, array(
                        'label' => false,
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'label_attr' => array('id' => 'r2272'),
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
        return 'bscForm227';
    }

}
