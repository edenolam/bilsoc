<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind124Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BilanSocialConsolideEffectifInd124Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ind124sTemp', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind124Type::class
                ))

                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();
                $filtered_data = array();
                foreach ($data->getInd124sTemp() as $key => $ind124) {
                    if ($ind124->getRefFiliere()->getCdFili() != "AN" || $ind124->getRefCategorie()->getCdCate() != "A") {
                        $filtered_data[] = $ind124;
                    }
                }
                $event->getForm()->get('ind124sTemp')->setData($filtered_data);
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
        return 'bscForm124';
    }

}
