<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\UserBundle\Entity\User;

class RuleCdgType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('canValidUserAccount', CheckboxType::class, array(
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
        ));
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
        return 'bilan_social_user_cdg_rule';
    }

}
