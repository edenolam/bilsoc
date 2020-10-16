<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefMetierType extends RefAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('cdMetier', PurifiedTextType::class, array(
                    'label' => 'Code métier',
                    'required' => true,
                ))
                ->add('lbMetier', PurifiedTextType::class, array(
                    'label' => 'Libellé',
                    'required' => true,
                ))
                ->add('lbAutAppColl', PurifiedTextType::class, array(
                    'label' => 'Autre applellation collectivité',
                    'required' => true,
                ))
                ->add('cdN4ds', PurifiedTextType::class, array(
                    'label' => 'Code N4ds',
                    'required' => true,
                ))
                ->add('blMetiPrinc', PurifiedTextType::class, array(
                    'label' => 'Métier principal',
                    'required' => true,
                ))
                ->add('blCons', PurifiedTextType::class, array(
                    'label' => 'Bilan consolidé',
                    'required' => true,
                ))
                ->add('RefFamilleMetier', EntityType::class, array(
                    'class' => RefFamilleMetier::class,
                    'choice_label' => 'lbFamilleMetier',
                    'label' => 'Famille de métier',
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
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_referencielbundle_refmetier';
    }


}
