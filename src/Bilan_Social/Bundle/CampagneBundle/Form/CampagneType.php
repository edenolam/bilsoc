<?php

namespace Bilan_Social\Bundle\CampagneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class CampagneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lbCamp', PurifiedTextType::class, array(
                    'label' => 'Libellé de la campagne',
                ))
                ->add('nmAnne', NumberType::class, array(
                    'label' => 'Année',
                ))
                ->add('dtDebu', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de début',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date',
                    )
                ))
                ->add('dtClot', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de clôture',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'disabled' => true,
                        'class' => 'input-date',
                   ),
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CampagneBundle\Entity\Campagne'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_campagnebundle_campagne';
    }


}
