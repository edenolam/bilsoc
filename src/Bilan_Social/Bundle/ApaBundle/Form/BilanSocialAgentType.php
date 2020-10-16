<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefAvancementPromotionConcours;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefContrainteTravail;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCycleTravail;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiFonctionnel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFonctionPublique;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefGrade;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitude;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifEntretien;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMouvinteanne;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPartiTemp;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPourcentageTempaPartiel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsPartiel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCdd;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

//use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BilanSocialAgentType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // [Q0]
        // @Assert\NotBlank(message = "agent.lbnom.not_blank", groups={"collectivite"})
        //@Assert\NotBlank(message = "agent.lbpren.not_blank", groups={"collectivite"})
//         @Assert\Regex(
//     *     pattern     = "/^\d+\/\d+$/",
//     *     htmlPattern = "^\d+\/\d+$",
//     *     message = "agent.datenais.bad_format",
//     *     groups={"collectivite"}
//     * )
//     * @Assert\NotBlank(message = "agent.lbdtnais.not_blank", groups={"collectivite"})
        // if (in_array('ROLE_PREVIOUS_ADMIN', $options['role'])) {
        if (in_array('ROLE_CDG', $options['role'])) {

            $builder->add('lbNom', PurifiedTextType::class, array(
                'label' => 'Nom ',
                'required' => false,
                'attr' => array(
                    'class' => 'text',
                    'disabled' => true,
                ),
                'mapped' => false,
            ))
                ->add('lbPren', PurifiedTextType::class, array(
                    'label' => 'Prénom',
                    'required' => false,
                    'attr' => array(
                        'class' => 'text',
                        'disabled' => true,
                    ),
                    'mapped' => false,
                ))
                ->add('commAgent', PurifiedTextType::class, array(
                    'label' => 'Commentaire',
                    'required' => false,
                    'attr' => array(
                        'class' => 'text',
                        'disabled' => true,
                        'placeholder' => 'Etablissement EHPAD...',
                    ),
                    'mapped' => false,
                ))
                ->add('lbDatenais', PurifiedTextType::class, array(
                    'label' => 'Q0 - Date de naissance ( mois / année )',
                    'required' => false,
                    'attr' => array(
                        'readonly' => true,
                        'disabled' => true,
                    ),
                    'mapped' => false,
                ));
        } else {
            $builder->add('lbNom', PurifiedTextType::class, array(
                'label' => 'Nom ',
                'required' => false,
                'attr' => array(
                    'class' => 'text'
                ),
                'constraints' => array(new NotBlank(array('message' => "agent.lbnom.not_blank")))

            ))
                ->add('lbPren', PurifiedTextType::class, array(
                    'label' => 'Prénom',
                    'required' => false,
                    'attr' => array(
                        'class' => 'text'
                    ),
                    'constraints' => array(new NotBlank(array('message' => "agent.lbpren.not_blank")))
                ))
                ->add('commAgent', PurifiedTextType::class, array(
                    'label' => 'Commentaire',
                    'required' => false,
                    'attr' => array(
                        'class' => 'text',
                        'placeholder' => 'Etablissement EHPAD...',
                    )
                ))
                ->add('lbDatenais', PurifiedTextType::class, array(
                    'label' => 'Q0 - Date de naissance ( mois / année )',
                    'required' => false,
                    'attr' => array(
                        'class' => 'date-picker',
                        'readonly' => true,
                    ),
                    'constraints' => array(
                        new NotBlank(array('message' => "agent.lbpren.not_blank")),
                        new Regex(array(
                            'pattern' => "/^\d+\/\d+$/",
                            'htmlPattern' => "^\d+\/\d+$",
                            'message' => "agent.datenais.bad_format",))
                    )
                ));
        }

        //manque date de naissance ici
        //
        // [ Q1 ]
        $builder->add('cdSexe', ChoiceType::class, array(
            'choices' => array('Homme' => 1, 'Femme' => 2),
            'label' => 'Q1 - Genre (H/F)',
            'expanded' => true,
            'multiple' => false,
            'placeholder' => false,
            'required' => false,
        ))

            // [ Q2 ]
            ->add('refStatut', EntityType::class, array(
                'class' => RefStatut::class,
                'choice_label' => 'lbStat',
                'placeholder' => 'Veuillez sélectionner un statut',
                'label' => 'Q2 - Quel est son dernier statut connu au plus tard au 31/12 ?',
                'required' => true,
            ))
            // [ Q2.8.1 ]
            ->add('RefCadreEmploi', EntityType::class, array(
                'class' => RefCadreEmploi::class,
                'label' => "Q2.8 - Quel est son cadre d'emploi?",
                'choice_label' => 'lbCadrempl',
                'choice_value' => 'cdCadrempl',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            ->add('refCadreEmploiOrigin', EntityType::class, array(
                'class' => RefCadreEmploi::class,
                'choice_label' => 'lbCadrempl',
                'label' => 'Q8.2.1 - Quel est son cadre d\'emploi d\'origine ?',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q2.0 ]
            ->add('blAcqustatanne', ChoiceType::class, array(
                'label' => 'Q2.0 – L’agent a-t-il acquis ce statut au cours de l\'année ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))


//Q2.2 - Quel est le type de CDD ?
//Q2.3 - L\'agent est-il fonctionnaire ou stagiaire ? / plus utilisé
//Q2.4 - L\'agent est-il contractuel permanent ? / plus utilisé
//Q2.5 - Si oui en Q2.3 Est-il titulaire ou stagiaire ?
//
            ->add('lbAlerteNonPermanentN4ds', HiddenType::class, array(
                'label' => false,
                'required' => false,
            ))

            // [Q2.6]
            ->add('refEmploiNonPermanent', EntityType::class, array(
                'class' => RefEmploiNonPermanent::class,
                'label' => false,
                'choice_label' => 'lbEmplnonperm',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->andWhere('u.blCdg = :blCdg')
                        ->andWhere('u.blApa = :blApa')
                        ->setParameter('blVali', '0')
                        ->setParameter('blCdg', '0')
                        ->setParameter('blApa', '1')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },

            ))
            // [ Q2.7.0 ]
            ->add('blPosiacti', ChoiceType::class, array(
                'label' => 'Q2.7.0- Quelle est sa position statutaire au plus tard au 31/12 ?',
                'choices' => array('Activité' => 1, 'Particulière' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            // [ Q2.7 ]
            ->add('refPositionStatutaire', EntityType::class, array(
                'label' => false,
                'class' => RefPositionStatutaire::class,
                'choice_label' => 'lbPositionStatutaireComplet',
                'group_by' => 'lbGroupePositionStatutaire',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))

            // [ Q2.7.0 ]
            ->add('blPosiactinonremu', ChoiceType::class, array(
                'label' => 'Q2.7.0- Quelle est sa position statutaire au plus tard au 31/12 ?',
                'choices' => array('Activité' => 1, 'Particulière' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            // [ Q2.7 ]
            ->add('refPositionStatutairenonremu', EntityType::class, array(
                'label' => false,
                'class' => RefPositionStatutaire::class,
                'choice_label' => 'lbPositionStatutaireComplet',
                'group_by' => 'lbGroupePositionStatutaire',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q3 ]
            ->add('refCategorie', EntityType::class, array(
                'class' => RefCategorie::class,
                'label' => "Quelle est la catégorie de l’agent au plus tard au 31/12 ?",
                'choice_label' => 'lbCate',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            ->add('refFiliere', EntityType::class, array(
                'class' => RefFiliere::class,
                'label' => "Quelle est la filière de l'agent? ",
                'choice_label' => 'lbFili',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            ->add('FiliereInaptitude', EntityType::class, array(
                'class' => RefFiliere::class,
                'label' => "Quelle est la filière de l'agent? ",
                'choice_label' => 'lbFili',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            ->add('FiliereEmpFonc', EntityType::class, array(
                'class' => RefFiliere::class,
                'label' => "Filière :",
                'choice_label' => 'lbFili',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->where('f.blEmpFonc = :blEmpFonc')
                        ->andWhere('f.blVali = :blVali')
                        ->orderBy('f.blEmpFonc', 'ASC')
                        ->setParameter('blEmpFonc', '1')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
//                ->add('idCadrempl', EntityType::class, array(
//                    'class' => RefCadreEmploi::class,
//                    'choice_label' => 'lbCadrempl',
//                    'required' => false,
//                ))
            // [Q3]
            ->add('refGrade', EntityType::class, array(
                'class' => RefGrade::class,
                'choice_label' => 'lbGrad',
                'label' => 'Q3 - Quel est le grade de l\'agent ?',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ));
//                ->add('idCate', TextType::class, array(
//                    'label' => 'Q3 - Quel est le grade de l\'agent ?',
//                    'required' => false,
//                ))
        // [ Q4.1 ]

        if ($options['enquete']->getBlBilasoci() == true || ($options['enquete']->getBlBilasoci() == false && ($options['enquete']->getBlRast() == true || $options['enquete']->getBlGepe() == true))) {
            $builder->add('blAgenremu3112', ChoiceType::class, array(
                'label' => 'Q4.1 - Agent rémunéré au 31/12 ?',
                'choices' => array('Oui' => 1, 'Non' => 0, 'Oui mais parti « temporairement » de la collectivité' => 2),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank(array('message' => 'Cette réponse est obligatoire'))
                ],
            ));
        } elseif ($options['enquete']->getBlBilasoci() == false && ($options['enquete']->getBlHand() == true && $options['enquete']->getBlRast() == false && $options['enquete']->getBlGepe() == false) || $options['enquete']->getBlDgcl() == true) {
            $builder->add('blAgenremu3112', ChoiceType::class, array(
                'label' => 'Q4.1 - Agent rémunéré au 31/12 ?',
                'choices' => array('Oui' => 1, 'Non' => 0, 'Oui mais parti « temporairement » de la collectivité' => 2),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ));
        }

//                ->add('refPartiTemp', EntityType::class, array(
//                    'class' => RefPartiTemp::class,
//                    'choice_label' => 'lbPartiTemp',
//                    'label' => 'Oui mais parti « temporairement » de la collectivité',
//                    'required' => false,
//                ))
        // [ Q4.2 ]
        $builder->add('blAgenremuanne', ChoiceType::class, array(
            'label' => 'Q4.2 - Agent rémunéré au moins une fois dans l\'année?',
            'choices' => array('Oui' => 1, 'Non' => 0),
            'expanded' => true,
            'multiple' => false,
            'placeholder' => false,
            'required' => false,
        ))
            // [ Q5.1 ]
            ->add('blAgenarriannecoll', ChoiceType::class, array(
                'label' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            // [ Q5.2 ]
            ->add('lbDatedepacoll', DateType::class, array(
                'label' => 'Q5.2 - Quelle est la date de départ de l\'agent de la collectivité ?',
                'widget' => 'single_text',
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'class' => 'input-date'
                )
            ))
            // [ Q5.3 ]
            ->add('RefMouvinteanne', EntityType::class, array(
                'label' => "Q5.3 - Est-ce que l'agent a bénéficié d'un mouvement interne au cours de l'année : Retour de l’agent au sein de la collectivité suite à congés non rémunérés ou rémunérés pendant la période d’absence ?",
                'class' => RefMouvinteanne::class,
                'choice_label' => 'lbMouvinteanne',
                'placeholder' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q5.4 ]
            ->add('refMotifArrivee', EntityType::class, array(
                'class' => RefMotifArrivee::class,
                'choice_label' => 'lbMotiarri',
                'label' => 'Q5.4 - Quel est le motif d\'arrivée ?',
                'required' => false,
                'placeholder' => "Selectionner un motif d'arrivée",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))

            //Voir Q7 - Temps de travail spécifique
            // [ Q8.1 ]
            ->add('blEmplfonc', ChoiceType::class, array(
                'label' => 'Q8.1 - A t\'il occupé un emploi fonctionnel ? Si oui de quoi est-il détaché ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            //  Q2.1 -
            ->add('blCdi', ChoiceType::class, array(
                'label' => "L'agent est-il en CDI ?",
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            //[ Q8.1A si oui Q8.1 afficher ce champ]
//                ->add('idGraddeta', TextType::class, array(
//                    'required' => false,
//                ))
//                ->add('refGradeDeta', EntityType::class, array(
//                    'label' => "De quel grade est-il détaché?",
//                    'required' => false,
//                    'class' => RefGrade::class,
//                    'choice_label' => 'lbGrad',
//                    'placeholder' => "",
//                    'query_builder' => function (EntityRepository $er) {
//                        return $er->createQueryBuilder('u')
//                                ->where('u.blDeta = :blDeta')
//                                ->orderBy('u.refCadreEmploi', 'ASC')
//                                ->addOrderBy('u.lbGrad', 'ASC')
//                                ->setParameter('blDeta', '1')
//
//                        ;
//                    },
//                ))
            ->add('RefCadreEmploiDeta', EntityType::class, array(
                'class' => RefCadreEmploi::class,
                'label' => "De quel cadre d’emplois est-il détaché ?",
                'choice_label' => 'lbCadrempl',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))

            // [ Q8.3 ]
            ->add('refEmploiFonctionnel', EntityType::class, array(
                'class' => RefEmploiFonctionnel::class,
                'choice_label' => 'lbEmplfonc',
                'label' => 'Q8.3 - Sur quel emploi fonctionnel est-il détaché ?',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q8.4 ]
            ->add('dtDetaemplfonc', DateType::class, array(
                'label' => 'Q8.4 - A quelle date a-t-il été détaché sur cet emploi fonctionnel ?',
                'required' => false,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'input-date'
                ),
                'format' => 'dd/MM/yyyy',
            ))
            ->add('dtArriStat', DateType::class, array(
                'label' => "Quelle est la date d’arrivée sur ce contrat ?",
                'required' => false,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'input-date',
                ),
                'format' => 'dd/MM/yyyy',
            ))
            // [ Q11.1 ]
            ->add('blTempcomp', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'label' => 'Q11.1 - L\'agent est-il à temps complet ?',
                'placeholder' => false,
                'required' => false,
            ))
            // [ Q11.2 ]
            ->add('refTempsNonComplet', EntityType::class, array(
                'class' => RefTempsNonComplet::class,
                'choice_label' => 'lbTempnoncomp',
                'label' => 'Q11.2 - Quelle est la durée hebdomadaire ?',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q12.1 ]
            ->add('blTempplein', ChoiceType::class, array(
                'label' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            // [ Q12.2 ]
            ->add('refTempsPartiel', EntityType::class, array(
                'class' => RefTempsPartiel::class,
                'choice_label' => 'lbTemppart',
                'label' => false,
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q12.3 ]
            ->add('refPourcentageTempaPartiel', EntityType::class, array(
                'class' => RefPourcentageTempaPartiel::class,
                'choice_label' => 'lbPourtemppart',
                'label' => 'Q12.3 - Quel est le pourcentage de temps partiel ?',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q13 ]
//                ->add('nmHeurremuanne', NumberType::class, array(
//                    'label' => 'Q13 - Quel est le nombre d\'heures rémunérées dans l\'année ?',
//                    'required' => false,
//                ))
//
//
//                // [ Q20.3]
//                ->add('nbAllotempinac', TextType::class, array(
//                    'required' => false,
//                ))
//                // [Q20.4]
//                ->add('nbAllotempinva', TextType::class, array(
//                    'required' => false,
//                ))
            // [Q21]
            //->add('blCongpateaccuenfa', ChoiceType::class, array(
            //    'choices' => array('Oui' => 1, 'Non' => 0),
            //    'expanded' => true,
            //    'multiple' => false,
            //    'placeholder' => false,
            //    'required' => false,
            //    'label' => "Q21 - L'agent a-t-il bénéficié d'un congé paternité ou un congé d'accueil d'un enfant au cours de l'année ?",
            //))
            // [Q21.1]
            //->add('nbJourcongpateaccuenfa', TextType::class, array(
            //    'required' => false,
            //    'label' => "Q21.1 - Le nombre total de jours au titre de ses congés au cours de l'année ?",
            //))
            // [Q22]
            ->add('blEntrdepacong', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q22 - L'agent a-t-il bénéficié d'un entretien spécifique avant un congé au cours de l'année ? (départ)",
            ))
            // [Q22.1]
            ->add('refMotifEntretienDepart', EntityType::class, array(
                'class' => RefMotifEntretien::class,
                'choice_label' => 'lbMotientr',
                'required' => false,
                'label' => "Q22.1 - Pour quel type de congés a-t-il bénéficié de cet entretien ?",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [Q23]
            ->add('blEntrretocong', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q23 - L'agent a-t-il bénéficié d'un entretien spécifique avant un congé au cours de l'année ? (retour)",
            ))
            // [Q23.1]
            ->add('refMotifEntretienRetour', EntityType::class, array(
                'class' => RefMotifEntretien::class,
                'choice_label' => 'lbMotientr',
                'required' => false,
                'label' => "Q23.1 - Pour quel type de congés a-t-il bénéficié de cet entretien ?",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            ->add('blCet', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => false,
            ))
            ->add('blCetOuvert', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q26.1 -  L'agent a-t-il ouvert son CET cette année ?",
            ))
            // [Q26.2]
            ->add('nbJourcumu3112', PurifiedNumberType::class, array(
                'required' => false,
                'label' => "Nombre de jours cumulés au 31/12 de l'année ?",
                'attr' => array(
                    'class' => 'positiveFloat010Rounded',
                ),
            ))
            // [Q26.3]
            ->add('nbJourvers3112', PurifiedNumberType::class, array(
                'label' => "Nombre de jours versés au 31/12 de l'année ?",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveFloat010Rounded',
                ),
            ))
            // [Q26.4]
            ->add('nbJourdepe3112', PurifiedNumberType::class, array(
                'label' => "Nombre de jours dépensés au 31/12 de l'année ?",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveFloat010Rounded',
                ),
            ))
            // [Q26.5]
            ->add('nbJourinde3112', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'positiveFloat010Rounded',
                ),
                'label' => "Nombre de jours indemnisés au 31/12 de l'année ?",
            ))
            // [Q26.6]
            ->add('nbJourprisrafp3112', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'positiveFloat010Rounded',
                ),
                'label' => "Nombre de jour pris en compte au titre de la RAFP au 31/12 de l'année ?",
            ))
            // [Q26.7]
            ->add('nbJourdonneBenef', PurifiedNumberType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'positiveFloat010Rounded',
                ),
                'label' => "Nombre de jours donnés au bénéfice de proches ?",
            ))
            // [Q27]
            ->add('blTeletrav', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q27 - L'agent est-il concerné par le télé-travail ?",
                'attr'       => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            // [Q27.1]
            ->add('blTeletravBenef', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q27.1 - L'agent a-t-il demandé à en bénéficier ?",
                'attr'       => array(
                    'onchange' => 'changedDetect()',
                )
            ))
            // [Q31.1]
            ->add('blAgenprev', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q31.1 - Est-ce que l'agent est affecté à la prévention ?",
            ))
            // [Q31.2]
            ->add('refTypeMissionPrevention', EntityType::class, array(
                'class' => RefTypeMissionPrevention::class,
                'choice_label' => 'lbTypemissprev',
                'required' => false,
                'label' => "Q31.2 - Quel type d'affectation ?",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [Q32.1]
            ->add('blDemainap', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q32.1 - Est-ce que l'agent a fait une demande de reclassement au cours de l'année ?",
            ))
            // [R31.1]
            ->add('refInapDema', EntityType::class, array(
                'class' => RefInaptitude::class,
                'choice_label' => 'lbInap',
                'label' => "Cause d'inaptitude",
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.blDema = :blDema')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blDema', '1')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [Q32.2]
            ->add('blDeciinap', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q32.2 -Est-ce qu'il y a une décision d'inaptitude ?",
            ))

            // [R32.2]
            ->add('refInapdeci', EntityType::class, array(
                'class' => RefInaptitude::class,
                'choice_label' => 'lbInap',
                'label' => "Liste des décisions d'inaptitude",
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.blDeci = :blDeci')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blDeci', '1')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            ->add('blFormsuiv', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q33 - Est-ce que l'agent a suivi une formation au cours de l'année ?",
            ))

            // [Q34.1]
            ->add('blVae', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => false,
            ))
            // [Q34.2]
            ->add('idEbcf', ChoiceType::class, array(
                'choices' => array("Dossiers déposés durant l'année." => 0,
                    "Dossiers en cours." => 1,
                    "Dossiers ayant débouchés dans l'année sur une validation" => 2,
                ),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q34.2 -  A quel stade se situe le dossier de l'agent ?",
            ))
            // [Q35.1]
            ->add('blBilacomp', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => false,
            ))
            // [Q35.2]
            ->add('nbBilacomp', TextType::class, array(
                'required' => false,
                'label' => "Q35.2 - Saisir le nombre de bilans",
                'attr' => array(
                    'class' => 'positiveInteger'
                )
            ))
            // [Q36.1]
            ->add('blCongform', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'required' => false,
                'placeholder' => false,
                'label' => "Q36.1 - L'agent a-t-il bénéficié d'un congé de formation ?",
            ))

            // [ Q29.1 ]
//                ->add('mtRemuannubrut', TextType::class, array(
//                    'label' => 'Q29.1 (Si RIC - 1 est à OUI) - Montant total des rémunérations annuelles brutes ?',
//                    'required' => false,
//                ))
            // [ Q29.2 ]
//                ->add('mtTotaremuprimindem', TextType::class, array(
//                    'label' => ' Q29.2- Montant total des rémunérations annuelles brutes des primes et indemnités (Article 88 et article 111) ?',
//                    'required' => false,
//                ))
////        [Q29.3]
//                ->add('mtTotaremubrutnbi', TextType::class, array(
//                    'required' => false,
//                    'label' => " Q29.3 -  Montant total des rémunérations annuelles brutes liées à une NBI : ",
//                    'attr' => array(
//                        'class' => 'positiveFloat',
//                    )
//                ))
            // [ Q29.4 ]
//                ->add('mtTotaremubrutheursupp', NumberType::class, array(
//                    'required' => false,
//                    'label' => " Q29.4 - Montant total des rémunérations annuelles brutes des heures supplémentaires ?",
//                ))
            // [ Q30.1 ]
//                ->add('nbHeursupp', NumberType::class, array(
//                    'label' => '- Q30.1 - Nombre d\'heures supplémentaires réalisées et rémunérées',
//                    'required' => false,
//                ))
//                // [ Q30.2 ]
//                ->add('nbHeurcomprealremu', NumberType::class, array(
//                    'required' => false,
//                    'label' => "- Q30.2 - Nombre d'heures complémentaires réalisées et rémunérées",
//                ))
            // [ Q19 ]
            ->add('blBoeth', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'label' => false,
                'placeholder' => false,
                'required' => false,
            ))
            //[ Q9.2 ]
            ->add('refFonctionPublique', EntityType::class, array(
                'label' => false,
                'class' => RefFonctionPublique::class,
                'choice_label' => 'lbFoncpubl',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))



            // [ R2.7.B.B ]
            ->add('blStruorigposistat', ChoiceType::class, array(
                'choices' => array('Agent originaire de la collectivité' => 0,
                    'Originaire d\'une autre structure' => 1,
                ),
                'expanded' => true,
                'multiple' => false,
                'label' => "De quelle structure est-il originaire ?",
                'required' => false,
                'placeholder' => false,
            ))
            // [ Q17 ]
            ->add('blAgentitustaganne', ChoiceType::class, array(
                'label' => 'Q17 L\'agent a-t-il été titularisé ou mis en stage au cours de l\'année ?',
                'choices' => array('Oui' => 1, 'Non' => 0, "Refus de titularisation" => 2),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            // [ Q17.1 ]
            ->add('refStageTitularisation', EntityType::class, array(
                'label' => 'Q17.1 Quel est le motif de titularisation ou de stage ?',
                'class' => RefStageTitularisation::class,
                'choice_label' => 'lbStagtitu',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // Supprimé suite a demande client
//                ->add('dtChanstat', DateType::class, array(
//                    'widget' => 'single_text',
//                    'label' => "Quel est la date du changement de statut ?",
//                    'required' => false,
//                    'attr' => array(
//                        'class' => 'input-date'
//                    ),
//                    'format' => 'd/m/yyyy',
//                ))
            // [  Q16  ]
            ->add('refMotifDepart', EntityType::class, array(
                'label' => "- Q16 - Quel est le motif de départ ?",
                'class' => RefMotifDepart::class,
                'choice_label' => function ($motif_depart) use ($options) {
                    $anneeCamp = isset($options['anneeCamp']) ? $options['anneeCamp'] : "";
                    $libelle = $motif_depart->getLbMotidepa();
                    if (strpos($libelle, "__CURRENT_ANNEE__")) $libelle = str_replace('__CURRENT_ANNEE__', $anneeCamp, $libelle);
                    return $libelle;
                },
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q16.1 ]
            ->add('cdMotidece', ChoiceType::class, array(
                'label' => 'Q16.1 - Quel est le motif du décès?',
                'choices' => array('Accident de service' => 0, 'Accident de trajet' => 1, 'Autre' => 2),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            ->add('blHeureSuppComp', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'label' => false,
                'placeholder' => false,
                'required' => false,
            ))
            // [ Q18 ]
            ->add('blPromavanstaganne', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0,
                    "Réussite à un concours n'ayant pas entrainé 'une nomination stagiaire'" => 2,
                    "Réussite à un examen professionnel de promotion interne n'ayant pas entrainé 'une nomination stagiaire'" => 3),
                'expanded' => true,
                'multiple' => false,
                'label' => 'Q18 -  L\'agent a-t-il eu une promotion, un avancement ou une mise en stage suite à un concours au cours de l\'année ?',
                'placeholder' => false,
                'required' => false,
            ));
        // [ Q18.1 ]

        /*
         * règle particulière, non affichage des ref APC006 et APC007 sauf si données saisies (#4592)
         */
        $cdAvanpromconcInBs = array();
        foreach ($builder->getData()->getRefAvancementPromotionConcours() as $refData) {
            $cdAvanpromconcInBs[] = $refData->getCdAvanpromconc();
        }
        $refToExclude = array("APC006", "APC007");
        $to_hide = array();
        foreach ($refToExclude as $cdAvanpromconcToHide) {
            if (!in_array($cdAvanpromconcToHide, $cdAvanpromconcInBs)) {
                $to_hide[] = $cdAvanpromconcToHide;
            }
        }
        $builder->add('refAvancementPromotionConcours', EntityType::class, array(
            'label' => "Liste promotions, avancement et mise en stage : ",
            'class' => RefAvancementPromotionConcours::class,
            'choice_label' => 'lbAvanpromconc',
            'required' => false,
            'expanded' => true, // todo a voir ce qui est le mieu
            'multiple' => true,
            'query_builder' => function (EntityRepository $er) use ($to_hide) {
                $qb = $er->createQueryBuilder('u')
                    ->andWhere('u.blVali = :blVali')
                    ->setParameter('blVali', '0')
                    ->setCacheable(true)
                    ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                    ->setCacheRegion('referentiel_entities');
                if (!empty($to_hide)) {
                    $qb->andWhere('u.cdAvanpromconc NOT IN (:refToExclude)')
                        ->setParameter('refToExclude', $to_hide);
                }
                return $qb;;
            },
        ))

            // [ Q25 ]
            ->add('refContrainteTravail', EntityType::class, array(
                'class' => RefContrainteTravail::class,
                'label' => "L'agent a-t-il des contraintes particulières sur son temps de travail ?",
                'choice_label' => 'lbConttrav',
                'expanded' => true, // todo a voir ce qui est le mieu
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [ Q28.1 ]
            ->add('blDemapart', ChoiceType::class, array(
                'label' => false,
//                    'label' => "Q28 - L'agent a-t il fait une demande de temps partiel dans l'année N ?",
                'required' => false,
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
            ))
            // [ Q28.1 ]
            ->add('nbDemapart', PurifiedNumberType::class, array(
//                    'label' => "Q28.1 - Nombre de demandes présentées par l'agent : ",
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger',
                )
            ))
            // [ Q28.2 ]
            ->add('nbDemapartacce', PurifiedNumberType::class, array(
//                    'label' => "Q28.2 - Nombre de demandes acceptées pour l'agent : ",
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger',
                )
            ))
            // [ Q28.3 ]
            ->add('nbPremdemasati', PurifiedNumberType::class, array(
//                    'label' => "Q28.3 - Nombre de premières demandes satisfaites pour l'agent : ",
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger',
                )
            ))
            // [ Q28.4 ]
            ->add('nbModiemplpermtempcomp', PurifiedNumberType::class, array(
                'label' => false,
//                    'label' => "Q28.4 - Nombre de modifications de quotités pour l'agent : ",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger',
                )
            ))
            // [ Q28.5 ]
            ->add('nbAgenempltempcompnonrenou', PurifiedNumberType::class, array(
                'label' => false,
//                    'label' => "Q28.5 - Nombre de retours au temps plein pour l'agent : ",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger',
                )
            ))
            // [ Q24 ]
            ->add('refCycleTravail', EntityType::class, array(
                'class' => RefCycleTravail::class,
                'choice_label' => 'lbCycltrav',
                'label' => 'Q24 - Quel est le cycle de travail ?',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [Q24.1]
            ->add('blCyclTrav', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => false,
            ))
            // [ Q13 ]
//                ->add('nmHeurremuanne', NumberType::class, array(
//                    'label' => 'Q13 - Quel est le nombre d\'heures rémunérées dans l\'année ?',
//                    'required' => false,
//                ))
            // [ Q20.1 ]
            ->add('blAgenabse', ChoiceType::class, array(
                'label' => 'Q20.1 - L\'agent a-t-il été absent au moins une fois au cours de l\'année ?',
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
//                // [Q20.2]
            // [ Q20.3]
            ->add('nbAllotempinvtrav', PurifiedNumberType::class, array(
                'label' => "Q20.3 Nombre d'allocations temporaires d'invalidité (ATI) attribuées à l’agent suite à un accident de travail",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger'
                )
            ))
            // [Q20.4]
            ->add('nbAllotempinvapro', PurifiedNumberType::class, array(
                'label' => "Q20.4  Nombre d'allocations temporaires d'invalidité (ATI) attribuées à l’agent suite à  une maladie professionnelle ou à caractère professionnel ou contractée pendant le service",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger'
                )
            ))
            ->add('nbAllotempinvaautrecas', PurifiedNumberType::class, array(
                'label' => "Q20.5 Nombre d'allocations temporaires d'invalidité (ATI) attribuées à l’agent suite à  autres cas",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger'
                )
            ))
            // [Q21]
            /*->add('blCongpateaccuenfa', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'label' => "Q21 - L'agent a-t-il bénéficié d'un congé paternité ou un congé d'accueil d'un enfant au cours de l'année ?",
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
            ))
            // [Q21.1]
            ->add('nbJourcongpateaccuenfa', PurifiedNumberType::class, array(
                'label' => "Q21.1 - Le nombre total de jours au titre de ses congés au cours de l'année ?",
                'required' => false,
                'attr' => array(
                    'class' => 'positiveInteger'
                )
            ))*/
            // [Q22]
            ->add('blEntrdepacong', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q22 - L'agent a-t-il bénéficié d'un entretien spécifique avant un congé au cours de l'année ? (départ)",
            ))
            ->add('refTypeCdd', EntityType::class, array(
                'label' => false,
                'class' => RefTypeCdd::class,
                'choice_label' => 'lbTypeCdd',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ))
            // [Q22.1]
//                ->add('RefMotifEntretienDepart', EntityType::class, array(
//                    'required' => false,
//                    'label' => "Q22.1 - Pour quel type de congés a-t-il bénéfichié de cet entretien ?",
//                ))
            // [Q23]
            ->add('blEntrretocong', ChoiceType::class, array(
                'choices' => array('Oui' => 1, 'Non' => 0),
                'expanded' => true,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'label' => "Q23 - L'agent a-t-il bénéficié d'un entretien spécifique avant un congé au cours de l'année ? (retour)",
            ))
            // [Q23.1]
//                ->add('RefMotifEntretienRetour', EntityType::class, array(
//                    'required' => false,
//                    'label' => "Q23.1 - Pour quel type de congés a-t-il bénéfichié de cet entretien ?",
//                ))
            // [Q15.1]
            ->add('refStructureOrigine', EntityType::class, array(
                'label' => 'Quelle est la structure d\'origine de l\'agent?',
                'class' => RefStructureOrigine::class,
                'choice_label' => 'lbStruorig',
                'required' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0')
                        ->setCacheable(true)
                        ->setCacheMode(ClassMetadata::CACHE_USAGE_NONSTRICT_READ_WRITE)
                        ->setCacheRegion('referentiel_entities');
                },
            ));
//                ->add('valider', SubmitType::class, array(
//                    'attr' => array(
//                        'class' => 'btn btn-primary'
//                    )
//                ));
        if ($options['action'] === "new") {
            $builder->add('enregistrer_new', SubmitType::class, array(
                'label' => 'Valider',
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ));
        } else if ($options['action'] === "edit") {
            $builder->add('enregistrer', SubmitType::class, array(
                'label' => 'Valider',
                'attr' => array(
                    'class' => 'btn btn-primary'
                )
            ));
        }

        $builder->add('AbsenceArretAgents', CollectionType::class, array('entry_type' => AbsenceArretAgentType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true, 'entry_options' => array('enquete' => $options['enquete']->getBlRast(), 'anneeCamp' => $options['anneeCamp'])))
            ->add('etpragent', CollectionType::class, array('entry_type' => EtprAgentType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true))
            ->add('HeuSuppReaRemAgent', CollectionType::class, array('entry_type' => HeuSuppReaRemAgentType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true))
            ->add('HeuCompReaRemAgent', CollectionType::class, array('entry_type' => HeuCompReaRemAgentType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true))
            ->add('RemunerationGlobaleAgent', CollectionType::class, array('entry_type' => RemunerationGlobaleAgentType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true))
            ->add('RemunerationAgent', CollectionType::class, array('entry_type' => RemunerationAgentType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true))
            ->add('FormationAgents', CollectionType::class, array('entry_type' => FormationAgentType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true));

        if ($options['enquete']->getBlHand() !== false) {
            $builder->add('Handitorials', HanditorialType::class);
        }

        if ($options['enquete']->getBlGepe() !== false) {
            $builder->add('cdProfessionCategSocio', HiddenType::class);
            $builder->add('Gpeec', GpeecType::class, array());
        }

        if ($options['enquete']->getBlGpeecPlus() !== false && $options['enquete']->getBlGpeecPlus() !== null) {
            $builder->add('GpeecPlus', GpeecPlusType::class, array());
        }

        /*if ($options['collectivite']->getBlCollDgcl() !== false) {
            $builder->add('Dgcl', DgclType::class, array());
        }*/

        $builder->add('Dgcl', DgclType::class, array());

        $builder->add('pcFillAgent', HiddenType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent',
            'entityManager' => null,
            'allow_extra_fields' => true,
        ));
        $resolver->setRequired('enquete');
        $resolver->setRequired('action');
        $resolver->setRequired('role');
        $resolver->setRequired('anneeCamp');
        $resolver->setRequired('collectivite');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_apabundle_bilansocialagent';
    }

    public function getAbsenceArretAgent()
    {
        return 'BilanSocialAgent';
    }

    protected function buildChoicesPositionStatutaires($em)
    {
        $choices = array();
        $entityManager = $em;
        $positionStatutaireRepository = $entityManager->getRepository('ReferencielBundle:RefPositionStatutaire');
        $positionsStatutaires = $positionStatutaireRepository->findByAllWithOrder();

        foreach ($positionsStatutaires as $key => $positionsStatutaire) {
            $groupe = $positionsStatutaire->getRefGroupePositionStatutaire();
            if (isset($groupe) && !empty($groupe)) {
                $lbGroupe = $groupe->getLbGrouPosistat() . ' ' . $groupe->getLbGrouCompl();
                $choices[$lbGroupe] = array($positionsStatutaire->getIdPosistat() => $positionsStatutaire->getLbPosistat() . ' ' . $positionsStatutaire->getLbCompl());
            } else {
                $choices[] = $positionsStatutaire->getLbPosistat() . ' ' . $positionsStatutaire->getLbCompl();
            }
        }
        /* foreach ($table2Objects as $table2Obj) {
          $choices[$table2Obj->getId()] = $table2Obj->getNumero() . ' - ' . $table2Obj->getName();
          } */

        return $choices;
    }

}
