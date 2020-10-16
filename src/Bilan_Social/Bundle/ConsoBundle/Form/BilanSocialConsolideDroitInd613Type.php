<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind613Type;

class BilanSocialConsolideDroitInd613Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('q613', ChoiceType::class, array(
                        'label' => 'Votre collectivité est-elle concernée par les grèves en ' . $options['anneeCamp'] . ' ?',
                        'required' => true,
                        'expanded' => true,
                        'multiple' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0), 
                        'label_attr' => array('id' => 'labelq613'),
                        'attr' => array(
                           'onchange' => 'changedDetect()',
                       )
                    ))
                ->add('ind613s', CollectionType::class, array(
                        'label' => false,
                        'required' => false,
                        'entry_type' => Ind613Type::class
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
        return 'bscForm';
    }

}
