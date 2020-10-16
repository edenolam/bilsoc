<?php

namespace Bilan_Social\Bundle\InfoCentreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;

class DepartementsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('departements', EntityType::class, array(
                    'class' => Departement::class,
                    'choice_label' => 'lbDepa',
                    'label' => 'Département',
                    'expanded' => false,
                    'multiple' => true,
                ));
                
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_infocentre_departement';
    }


}
