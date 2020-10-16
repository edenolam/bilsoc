<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSpecialite;
use Doctrine\ORM\EntityRepository;

class GpeecPlusType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              
                ->add('refSpecialite', EntityType::class, array(
                    'class'        => RefSpecialite::class,
                    'label'        => 'Quelle est la spécialité de ce diplôme ?',
                    'choice_label' => 'lbSpecialite',
                    'placeholder'  => '0',
                    'required'     => false
                ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\GpeecPlus'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_apabundle_gpeec_plus';
    }


}
