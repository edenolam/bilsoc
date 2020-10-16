<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

/**
 * Description of ChangePasswordType
 *
 * @author mbusson
 */

use Bilan_Social\Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ChangePasswordType extends AbstractType{
     
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('oldPassword', PasswordType::class, array(
                    'label' => 'Mot de passe actuel',
                ))
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'first_options' => array('label' => 'Nouveau mot de passe'),
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

        $resolver->setDefaults(array(
            'data_class' => User::class,
            
        ));
    }
     public function getDefaultOptions()
    {   
        return array(
            'validation_groups' => array('equal'),
        );
    }
}
