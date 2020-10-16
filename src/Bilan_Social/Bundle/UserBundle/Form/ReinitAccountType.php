<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

use Bilan_Social\Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ReinitAccountType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email', EmailType::class, array(
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control',
                        'autocomplete' => 'off'
                    ),
                ))
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Vérification du mot de passe'),
                    'required' => true,
                    'invalid_message' => 'Les deux mots de passe ne correspondent pas.',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $defaults = array(
            'data_class' => User::class,
        );

        $resolver->setDefaults($defaults);
    }

}
