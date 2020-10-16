<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeAnalyseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cmDetail', PurifiedTextareaType::class, array(
                    'label' => 'Détails de la demande',
                ))
                ->add('lbTypeAnalyse', PurifiedTextType::class, array(
                    'label' => 'Type de l\'analyse',
                ))
                ->add('lbAnalyse', PurifiedTextType::class, array(
                    'label' => 'Nom de l\'analyse',
                ))
                ->add('envoyer', SubmitType::class, array(
                    'attr' => array('class' => 'modifier btn button-tableau'),
                ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\AnalyseBundle\Entity\DemandeAnalyse'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_analysebundle_demandeanalyse';
    }


}
