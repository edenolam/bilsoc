<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TypeImportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cdTypeimpo', ChoiceType::class, array(
                    'mapped'   => false,
                    'choices' => array('Oui' => 1),
                    'choice_label' => false,
                    'multiple' => true,
                    'expanded' => true,
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\EnqueteBundle\Entity\TypeImport'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_enquetebundle_typeimport';
    }


}
