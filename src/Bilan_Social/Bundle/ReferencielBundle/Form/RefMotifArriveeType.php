<?php

namespace Bilan_Social\Bundle\ReferencielBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class RefMotifArriveeType extends RefAbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->add('cdMotiarri', PurifiedTextType::class, array(
                    'label' => 'Code',
                    'required' => true,
                ))
                ->add('lbMotiarri', PurifiedTextType::class, array(
                    'label' => 'libellé',
                    'required' => true,
                ))
                ->add('StatutMotifArrivees', EntityType::class, array(
                    'class' => RefStatut::class,
                    'label' => "Liste des statuts auquels appliquer ce motif d'arrivee",
                    'choice_label' => 'lbStat',
                    'expanded' => true, // todo a voir ce qui est le mieu
                    'multiple' => true,
                ))
                ->add('cdMotiN4ds', PurifiedTextType::class, array(
                    'label' => 'Code N4DS',
                    'required' => true,
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
            'data_class' => 'Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_referencielbundle_refmotifarrivee';
    }

}
