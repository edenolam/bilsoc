<?php

namespace Bilan_Social\Bundle\ImportCarriereBundle\Form;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Bilan_Social\Bundle\FileManagerBundle\Form\Type\FileManagerType;

/**
 * Description of FichierType
 *
 */
class FichierType  extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$new = $options['new'];

        $user = $options['user'];*/
            $builder->add('document', FileManagerType::class, array(
            'mapped' => true,    
            'required'  => false,
            'label' => 'Sélectionner le fichier base carrière que vous souhaitez importer',
            ))
            ->add('typeImport', ChoiceType::class, array(
                'label'    => "Choisissez le type d'import",
                'placeholder' => false,
                'required' => true,
                'expanded' => true,
                'multiple' => false,
                'choices'  => array('Autres bases carrière (Exemple : CIRIL)' => 1, 'AGIRHE' => 2), 
                'attr' => array(
                    'class' => 'radio-inline'
                )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_importcarrierebundle_fichier';
    }
    
    public function getDefaultOptions()
    {
    }
}
