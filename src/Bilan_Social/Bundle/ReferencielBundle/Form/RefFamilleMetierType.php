<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineProfessionnel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefFamilleMetierType extends RefAbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('cdFamilleMetier', PurifiedTextType::class, array(
            'label' => 'Code',
            'required' => true,
        ))
            ->add('lbFamilleMetier', PurifiedTextType::class, array(
                'label' => 'Libellé',
                'required' => true,
            ))
            ->add('refDomaineProfessionnel', EntityType::class, array(
                'class' => RefDomaineProfessionnel::class,
                'choice_label' => 'lbDomaineProfessionnel',
                'label' => 'Domaine professionnel',
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
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefFamilleMetier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_referencielbundle_reffamillemetier';
    }


}
