<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind311Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideRemunerationInd311Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('q3110', ChoiceType::class, array(
                    'label'       => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false
                ))
                ->add('q3111', ChoiceType::class, array(
                    'label'       => false,
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false
                ))
                ->add('ind311sTemp', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind311Type::class
                ))
                ->add('ind311AotmsTemp', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind311Type::class
                ))
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                $filtered_data = array();
                foreach ($data->getInd311sTemp() as $key => $ind311) {
                    if ($ind311->getRefFiliere()->getCdFili() != "AN" || $ind311->getRefCategorie()->getCdCate() != "A") {
                        $filtered_data[] = $ind311;
                    }
                }
                $event->getForm()->get('ind311sTemp')->setData($filtered_data);
            });

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
        return 'bscForm311';
    }

}
