<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerLogoType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class CdgType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('lbCdg', PurifiedTextType::class, array(
                    'label' => 'Centre de Gestion',
                    'attr' => array(
                        'readonly' => true
                    ),
                    'required' => true,
                ))
                ->add('image', FileManagerLogoType::class, array(
                 'label_attr' => array(
                     'hidden' => true
                 ),
                'mapped'    => false,
                'required'  => false,

                ))
//                ajouter contact cdg
                ->add('contacts', CollectionType::class, array(
                    'entry_type'   => CdgContactType::class,
                    'prototype'    => true,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Cdg::class,
            'cascade_validation' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_collectivitebundle_cdg';
    }


}
