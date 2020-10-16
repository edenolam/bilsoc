<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class RefMotifAbsenceType extends RefAbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('cdMotiabse', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))
                ->add('lbMotiabse', PurifiedTextType::class, array(
                    'label' => 'libellé',
                    'required' => true,
                ))
                ->add('cdMotiN4ds', PurifiedTextType::class, array(
                    'label' => 'Code N4DS (séparé par des - )',
                    'required' => false,
                ))
                ->add('blAbsecomp', CheckboxType::class, array(
                    'label' => 'Absence compensatoire',
                    'required' => false,
                ))
                ->add('blAbsemedi', CheckboxType::class, array(
                    'label' => 'Absence médicale',
                    'required' => false,
                ))
                ->add('blAbseautrrais', CheckboxType::class, array(
                    'label' => "Autre raison d'absence",
                    'required' => false,
                ))
                ->add('blVali', CheckboxType::class, array(
                    'label' => 'Archiver',
                    'required' => false,
        ));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_referencielbundle_refmotifabsence';
    }

}
