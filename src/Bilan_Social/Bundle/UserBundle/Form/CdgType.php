<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CdgType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('commun', CommunUserType::class, array(
                    'data_class' => User::class,
                ))
                ->add('canValidUserAccount', CheckboxType::class, array(
                    'label' => 'Valider des comptes utilisateur',
                    'required' => false,
                ))
                ->add('canView', CheckboxType::class, array(
                    'label' => 'Lecture',
                    'required' => false,
                ))
                ->add('canEdit', CheckboxType::class, array(
                    'label' => 'Saisie',
                    'required' => false,
                ))
                ->add('password', RepeatedType::class, array(
                    'entry_type' => PasswordType::class,
                    'first_options' => array('label' => 'Password',
                        'attr' => array(
                            'class' => 'form-control'
                        ),
                    ),
                    'second_options' => array('label' => 'Repeat Password',
                        'attr' => array(
                            'class' => 'form-control'
                        ),
                    ),
        ));

        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {

            $data = $event->getData();
            $data->setRoles([User::ROLE_CDG]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_user_cdg';
    }

}
