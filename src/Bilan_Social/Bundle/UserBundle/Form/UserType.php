<?php

namespace Bilan_Social\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\UserBundle\Entity\User;
use Bilan_Social\Bundle\UserBundle\Entity\Profil;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Cdg;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;
use Proxies\__CG__\Bilan_Social\Bundle\CampagneBundle\Entity\Campagne;

class UserType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('profil', ChoiceType::class, array(
                    'choices'  => array('Centre de gestion' => 'cdg',
                                        'Infocentre' => 'infocentre'
//                        'Administrateur' => 'admin',
                    ),
                    'label' => 'Rôle'
                ))
                ->add('cdgs', EntityType::class, array(
                    'class' => Cdg::class,
                    'choice_label' => 'nmCdg',
                    'choice_value' => 'nmCdg',
                    'label' => 'Numéro officiel du centre de gestion',
                    'placeholder' => 'Veuillez sélectionner un centre de gestion',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false,
                ))
                ->add('profils',EntityType::class, array(
                    'class' => Profil::class,
                    'choice_label' => 'nomProfil',
                    'choice_value' => 'nomProfil',
                    'label' => "Profil infocentre",
                    'placeholder' => 'Veuillez sélectionner un profil infocentre',
                    'expanded' => false,
                    'multiple' => false,
                    'required' => false,
                ))
                ->add('username', PurifiedTextType::class, array(
                    'label' => 'Identifiant : ',
                    'attr' => array(
                        'class'        => 'form-control',
                        'autocomplete' => 'off'
                    )
                ))
                ->add('email', EmailType::class, array(
                    'label' => 'Adresse Email : ',
                    'required' => false,
                    'attr' => array(
                        'class'        => 'form-control',
                        'autocomplete' => 'off'
                    )
                ))
                ->add('password', RepeatedType::class, array(
                    'type'              => PasswordType::class,
                    'first_options'     => array('label' => 'Mot de passe', 'attr' => array("autocomplete" => "off")),
                    'second_options'    => array('label' => 'Vérification du mot de passe', 'attr' => array("autocomplete" => "off")),
                    'required'          => true,
                    'invalid_message'   => 'Les deux mots de passe ne correspondent pas.',
                    'attr'              => array(
                                               'class' => 'form-control',
                                               'autocomplete' => 'off'
                                            ),
                ))
                ->add('droitMails', CheckboxType::class, array(
                    'label'     => false,    
                    'required'  => false,
                    'attr'      => array(
                                    'class' => 'toggle-bs',
                                    ),
                ))
                ->add('blGpeec', CheckboxType::class, array(
                    'label'     => false,    
                    'required'  => false,
                    'attr'      => array(
                                    'class' => 'toggle-bs',
                                    ),
                ))
                ;
                
                if ($options['hasRoleInfocentre'] == true) {
                    $builder->add('departements', EntityType::class, array(
                        'class'         => Departement::class,
                        'choice_label'  => 'lbDepa',
                        'choice_value'  => 'idDepa',
                        'expanded'      => true, 
                        'multiple'      => true,
                        'label'         => true,
                        'required'      => false,
                        'disabled'      => true
                    ))
                    ->add('campagnes', EntityType::class, array(
                        'class'         => Campagne::class,
                        'choice_label'  => 'nmAnne',
                        'choice_value'  => 'idCamp',
                        'expanded'      => true,
                        'multiple'      => true,
                        'required'      => false,
                        'label'         => 'Veuillez sélectionner les années de campagne',
                        'disabled'      => true
                    ));
                } else {
                    $builder->add('departements', EntityType::class, array(
                        'class'         => Departement::class,
                        'choice_label'  => 'lbDepa',
                        'choice_value'  => 'idDepa',
                        'expanded'      => true, 
                        'multiple'      => true,
                        'label'         => true,
                        'required'      => false,
                    ))
                    ->add('campagnes', EntityType::class, array(
                        'class'         => Campagne::class,
                        'choice_label'  => 'nmAnne',
                        'choice_value'  => 'idCamp',
                        'expanded'      => true,
                        'multiple'      => true,
                        'required'      => false,
                        'label'         => 'Veuillez sélectionner les années de campagne'
                    ));
                }
        ;    
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class
        ));

        $resolver->setRequired('hasRoleInfocentre');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_user';
    }

}
