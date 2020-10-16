<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifAbsence;
use Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\ApaBundle\Form\RassctMotifAbsenceType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureLesion;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefElementMateriel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSiegeLesion;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMaladieProfessionnelle;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeActivite;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\Mapping\ClassMetadata;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class AbsenceArretAgentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('accidentAvecArret', ChoiceType::class, array(
                    'required'   => false,
                    'label'      => false,
                    'attr'       => array(
                        'class' => 'positiveInteger accidentAvecArret',
                    ),
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
                ->add('RefMotifAbsence', EntityType::class, array(
                    'class' => RefMotifAbsence::class,
                    'choice_label' => 'lbMotiAbse',
                    'choice_value' => 'cdMotiAbse',
                    'required'     => false,
                    'label' => false,
                    'attr' => array(
                      'class' => 'RascctSelect'  
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                                ->setCacheable(true)
                                ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                                ->setCacheRegion('referentiel_entities')
                        ;
                    },
                ))
                ->add('nbJourabse', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloatRounded nbJourAbs',
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
                ->add('nbArre', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveInteger nbArret',
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
                ->add('anneeEvenement', ChoiceType::class, array(
                    'required'   => false,
                    'label'      => false,
                    'attr'       => array(
                        'class' => 'positiveInteger anneeEvenement',
                    ),
                    'choices' => array($options['anneeCamp'] => $options['anneeCamp'], 
                                        $options['anneeCamp'] - 1 => $options['anneeCamp'] - 1), 
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
        ));

        // la valeur dans enquete est true ou false en fonction de l enquete collectivite qui a le handitorial actif ou pas.
        if($options['enquete'] === true){
            
                $builder->add('idNatureLesion', EntityType::class, array(
                    'class'        => RefNatureLesion::class,
                    'choice_label' => 'lbNaturelesi',
                    'required'     => false,
                    'choice_value' => 'cdNaturelesi',
                    'label'        => false,
                    'attr' => array(
                        'disabled' => true,
                        'class'       => 'arretTravail003_004 rassct selectedNatureLesion',
                            'title'       => '',
                        'data-toggle' => 'tooltip'
                        ),
                    'label_attr'   => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('idSiegeLesion', EntityType::class, array(
                    'class'        => RefSiegeLesion::class,
                    'choice_label' => 'lbSiegelesi',
                    'required'     => false,
                    'choice_value' => 'cdSiegelesi',
                    'attr' => array(
                        'disabled' => true,
                        'class'    => 'arretTravail003_004 rassct',
                        ),
                    'label'        => false,
                    'label_attr'   => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('idElementMateriel', EntityType::class, array(
                    'class'        => RefElementMateriel::class,
                    'choice_label' => 'lbElementmat',
                    'required'     => false,
                    'choice_value' => 'cdElementmat',
                    'attr' => array(
                        'disabled' => true,
                        'class'    => 'arretTravail003_004 rassct',
                        ),
                    'label'        => false,
                    'label_attr'   => array(
                        'class' => 'hidden'
                        ),
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                            ;
                        },
                    )
        
                )
                ->add('idMaladieProfessionnelle', EntityType::class, array(
                        'class'        => RefMaladieProfessionnelle::class,
                        'choice_label' => 'lbMaladiepro',
                        'required'     => false,
                        'choice_value' => 'cdMaladiepro',
                        'attr'         => array(
                            'disabled' => true,
                            'class'    => 'rassctMaladiePro rassct',
                        ),
                        'label'        => false,
                        'label_attr'   => array(
                            'class' => 'hidden'
                        ),
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                            ;
                        },
                    )
                )
                ->add('idTypeActiviteMaladiePro', EntityType::class, array(
                        'class'        => RefTypeActivite::class,
                        'choice_label' => 'lbTypeActi',
                        'required'     => false,
                        'choice_value' => 'cdTypeActi',
                        'attr'         => array(
                            'disabled' => true,
                            'class'    => 'rassctMaladiePro rassct',
                        ),
                        'label'        => false,
                        'label_attr'   => array(
                            'class' => 'hidden'
                        ),
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                            ;
                        },
                    )
            )
                    ->add('idTypeActiviteArretTravail', EntityType::class, array(
                        'class'        => RefTypeActivite::class,
                        'choice_label' => 'lbTypeActi',
                        'required'     => false,
                        'choice_value' => 'cdTypeActi',
                        'attr'         => array(
                            'disabled' => true,
                            'class'    => 'arretTravail003_004 rassct',
                        ),
                        'label'        => false,
                        'label_attr'   => array(
                            'class' => 'hidden'
                        ),
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                    ->andWhere('u.blVali = :blVali')
                                    ->setParameter('blVali', '0')
                            ;
                        },
                    )
            );
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent'
        ));
        $resolver->setRequired('enquete');
        $resolver->setRequired('anneeCamp');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'Absence';
    }

    public function getAbsenceArretAgent() {
        return 'AbsenceArretAgent';
    }

}
