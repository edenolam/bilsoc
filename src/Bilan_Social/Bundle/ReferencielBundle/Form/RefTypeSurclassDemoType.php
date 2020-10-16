<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefTypeSurclassDemoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cdTypeSurclassDemo')->add('lbTypeSurclassDemo')->add('stratSurclassDemo')->add('blVali')->add('cdUtilcrea')->add('createdAt')->add('cdUtilmodi')->add('updatedAt');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeSurclassDemo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_referencielbundle_reftypesurclassdemo';
    }


}
