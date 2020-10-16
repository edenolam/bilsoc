<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\CdgDepartement;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;

class InfosEnqueteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $user = $options['user'];
        $status = $options['status'];
        $departements = $options['departements'];
        $builder->add('lbEnqu', PurifiedTextType::class, array(
                    'label' => 'Libellé de l\'enquête',
                    'required' => true,
                    'constraints' => array(
                        new NotBlank(['message'=>'erreur.constraint.notblank'])
                    )
                ))
                ->add('cmDesc', PurifiedTextType::class, array(
                    'label' => 'Description de l\'enquête',
                    'required' => true,
                    'constraints' => array(
                        new NotBlank(['message'=>'erreur.constraint.notblank'])
                    )
                ))
                ->add('dtDebu', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de début',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'class' => 'input-date-enquete',
                    ),
                    'constraints' => array(
                        new NotBlank(['message'=>'erreur.constraint.notblank'])
                    )
                ));
                if($status == 'new'){
                    $builder->add('departements', EntityType::class, array(
                        'class' => Departement::class,
                        'label' => "Liste des départements pour lesquels vous pouvez créer une enquête",
                        'choices' => $departements,
                        'choice_attr' => function($val, $key, $index) {
                            // permet de recuperer le group si present en data attribute pour la selection automatique coté client
                           
                            $departements_groups = $val->getGroups()->getValues();
                            $group_depa = '';
                            foreach($departements_groups as $group){
                                $group_depa = $group->getNmGroup();
                            }
                            return ['data-group' => $group_depa];
                        },
                        'choice_label' => 'lbDepa',
                        'attr' => array(
                            'class' => 'groups.nmGroup'
                        ),
                        'expanded' => true,
                        'multiple' => true,
                        'required' => true

                       ))
                    ->add('reinitMdp', ChoiceType::class, array(
                        'label' => 'Souhaitez-vous réinitialiser les mots de passe ?',
                        'choices' => array('Oui' => true), 
                        'expanded' => true,
                        'multiple' => true,
                    ));
                }else{
                     $builder->add('departements', EntityType::class, array(
                        'class' => Departement::class,
                        'label' => "Liste des départements pour lesquels vous pouvez créer une enquête",
                        'choices' => $departements,
                        'choice_attr' => function($val, $key, $index) {
                            // permet de recuperer le group si present en data attribute pour la selection automatique coté client
                           
                            $departements_groups = $val->getGroups()->getValues();
                            $group_depa = '';
                            foreach($departements_groups as $group){
                                $group_depa = $group->getNmGroup();
                            }
                            return ['data-group' => $group_depa,'disabled' => true];
                        },
                        'choice_label' => 'lbDepa',
                        'attr' => array(
                            'class' => 'groups.nmGroup',
                        ),
                        'expanded' => true,
                        'multiple' => true,
                        'required' => true

                       ))
                    ->add('reinitMdp', ChoiceType::class, array(
                        'label' => 'Souhaitez-vous réinitialiser les mots de passe ?',
                        'choices' => array('Oui' => true), 
                        'expanded' => true,
                        'multiple' => true,
                       'choice_attr' => function($key, $val, $index) {
                            $disabled = true;

                            // set disabled to true based on the value, key or index of the choice...

                            return $disabled ? ['disabled' => 'disabled'] : [];
                        },
                    ));
                }
                
    }

    public function getBlockPrefix() {
            return 'infosEnquete';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('user');
        $resolver->setRequired('status');
        $resolver->setRequired('departements');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {   
        $resolver->setDefaults([
            'attr' => ['id' => 'enquete_gestion_form']
        ]);
    }

}

