<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;

class EnqueteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lbEnqu', PurifiedTextType::class, array(
                    'label' => 'Libellé de l\'enquête',
                ))
                ->add('cmDesc', PurifiedTextareaType::class, array(
                    'label' => 'Commentaire',
                    'required' => false,
                ))
                ->add('nmAnne', NumberType::class, array(
                    'label' => 'Année',
                ))
                ->add('dtDebu', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de début',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date-enquete',
                    )
                ))
                ->add('dtClot', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de clôture',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date-enquete',
                    )
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\EnqueteBundle\Entity\Enquete'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_enquetebundle_enquete';
    }
}
