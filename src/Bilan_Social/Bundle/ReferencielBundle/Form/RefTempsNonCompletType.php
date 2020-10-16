<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class RefTempsNonCompletType extends RefAbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('cdTempnoncomp', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))
                ->add('lbTempnoncomp', PurifiedTextType::class, array(
                    'label' => 'libellé',
                    'required' => true,
                ))
                ->add('nbMinuteBorneMin', PurifiedTextType::class, array(
                    'label' => 'Nombre minutes borne min',
                    'required' => true,
                ))
                ->add('nbMinuteBorneMax', PurifiedTextType::class, array(
                    'label' => 'Nombre minutes borne max',
                    'required' => true,
                ))
                ->add('blVali', CheckboxType::class, array(
                    'label' => 'Archiver',
                    'required' => false,
                ))

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_referencielbundle_reftempsnoncomplet';
    }

}
