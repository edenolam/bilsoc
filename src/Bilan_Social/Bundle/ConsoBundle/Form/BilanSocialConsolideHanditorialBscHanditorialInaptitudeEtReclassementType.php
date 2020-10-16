<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Symfony\Component\Form\AbstractType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialInaptitudeEtReclassementType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialAvisInaptitudesType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialMesureInaptitudesType;
use Bilan_Social\Bundle\ConsoBundle\Form\BscHanditorialAncienneteAgentsType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BilanSocialConsolideHanditorialBscHanditorialInaptitudeEtReclassementType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('bscHanditorialInaptitudeEtReclassement', BscHanditorialInaptitudeEtReclassementType::class, array(
                    'label' => false,
                    'required'   => false
                ))
                ->add('qHandiB22', ChoiceType::class, array(
                    'label'      => false,
                    'required'    => false,
                    'placeholder' => false,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelqHandiB22'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('bscHanditorialAvisInaptitudes', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialAvisInaptitudesType::class
                ))
                ->add('bscHanditorialMesureInaptitudes', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialMesureInaptitudesType::class
                ))
                ->add('qHandiB23', ChoiceType::class, array(
                    'label'      => false,
                    'required'    => false,
                    'placeholder' => false,
                    'expanded'   => true,
                    'multiple'   => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'labelqHandiB23'),
                    'attr' => array(
                        'onchange' => 'changedDetect()',
                    )
                ))
                ->add('bscHanditorialAvisInaptitudesAvant', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialAvisInaptitudesAvantType::class
                ))
                ->add('bscHanditorialMesureInaptitudesAvant', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialMesureInaptitudesAvantType::class
                ))
                ->add('bscHanditorialAncienneteAgents', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscHanditorialAncienneteAgentsType::class
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
        return 'bscFormHanditorialInaptitudeEtReclassement';
    }

}
