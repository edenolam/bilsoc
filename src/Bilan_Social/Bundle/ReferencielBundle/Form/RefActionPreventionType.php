<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
class RefActionPreventionType extends RefAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder,$options);
        $builder->add('cdActionprev', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))->add('lbActionprev', PurifiedTextType::class, array(
                    'label' => 'Libellé',
                    'required' => true,
                ))->add('blVali', CheckboxType::class, array(
                    'label' => 'Archivé',
                    'required' => true,
                ))->add('blNbjour', PurifiedNumberType::class, array(
                    'label' => 'Nombre de jour',
                    'required' => true,
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefActionPrevention'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_referencielbundle_refactionprevention';
    }


}
