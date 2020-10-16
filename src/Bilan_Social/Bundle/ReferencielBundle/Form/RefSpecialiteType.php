<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineSpecialite;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefSpecialiteType extends RefAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('cdSpecialite', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))
                ->add('lbSpecialite', PurifiedTextType::class, array(
                    'label' => 'Libellé',
                    'required' => true,
                ))
                ->add('refDomaineSpecialite', EntityType::class, array(
                    'class' => RefDomaineSpecialite::class,
                    'choice_label' => 'lbDomaineSpecialite',
                    'label' => 'Domaine de spécialité',
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
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_referencielbundle_refspecialite';
    }


}
