<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Symfony\Component\Validator\Constraints\Regex;

class CdgContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lbNom', PurifiedTextType::class, array(
                    'attr' => array(
                        'class' => 'text',
                    )
                ))
                ->add('lbPren', PurifiedTextType::class, array(
                    'attr' => array(
                        'class' => 'text',
                    )
                ))
                ->add('lbTele', PurifiedTextType::class, array(
                    'attr' => array(
                        'maxlength' => 20,
                        'class' => 'positiveInteger tel',
                        
                    ),
                    'constraints' => array(new Regex(array(
                        'pattern'   => '/^(?:0|\+33|0033)(?:[1-9][0-9]{8})$/',
                        'match'     => true,
                        'message'   => 'Mauvais format de téléphone fixe',
                    ))),
                    'error_bubbling' => true,
                ))
                ->add('lbPort', PurifiedTextType::class, array(
                     'attr' => array(
                        'maxlength' => 20,
                        'class' => 'positiveInteger tel',
                    ),
                    'constraints' => array(new Regex(array(
                        'pattern'   => '/^(?:0|\+33|0033)(?:[1-9][0-9]{8})$/',
                        'match'     => true,
                        'message'   => 'Mauvais format de téléphone portable'
                    ))),
                     'error_bubbling' => true,
                ))
                ->add('lbFonc', PurifiedTextType::class, array(
                    'attr' => array(
                        'class' => 'text',
                    )
                ))
                ->add('lbMail', EmailType::class)
                ->add('blContactPrincipal', ChoiceType::class, array(
                    'choices'  => array(' ' => 1),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                    'attr' => array(
                        'readonly' => true,
                        'class' => 'referent-cdg',
                    ),
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgContact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_collectivitebundle_cdgcontact';
    }
}
