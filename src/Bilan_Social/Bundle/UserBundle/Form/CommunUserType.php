<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class CommunUserType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', PurifiedTextType::class, array(
                    'label' => 'Identifiant : ',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('email', EmailType::class, array(
                    'label' => 'Adresse Email : ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ))
                ->add('password', RepeatedType::class, array(
                    'entry_type' => PasswordType::class,
                    'first_options' => array('label' => 'Mot de passe'),
                    'second_options' => array('label' => 'Vérification du mot de passe'),
                    'required' => true,
                    'invalid_message' => 'Les deux mots de passe ne correspondent pas.',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {

        $collectionConstraint = new Collection(array(
            'password' => array(
                new Assert\RegExp(array(
                    "pattern"=>"/^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w])\S{8,}$/",
                    "match"=>true,
                    "message"=>"erreur.constraint.weakPassword")
                )
            )
        ));
        $resolver->setDefaults(array(
            'inherit_data' => true,
            'constraints' => $collectionConstraint
        ));
    }

}
