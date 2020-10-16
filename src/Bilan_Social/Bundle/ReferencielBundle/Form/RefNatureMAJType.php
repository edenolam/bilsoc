<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefNatureMAJType extends RefAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('cdStat', PurifiedTextType::class, array(
            'label' => 'Code',
            'required' => true,
        ))
            ->add('lbNatureMAJ', PurifiedTextType::class, array(
                'label' => 'Libellé',
                'required' => true,
            ))
            ->add('blVali', CheckboxType::class, array(
                'label' => 'Archiver',
                'required' => false,
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureMAJ'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_referencielbundle_refnaturemaj';
    }


}
