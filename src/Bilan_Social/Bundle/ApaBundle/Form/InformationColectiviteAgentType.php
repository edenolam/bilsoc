<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ApaBundle\Entity\InformationColectiviteAgent;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class InformationColectiviteAgentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
//                ->add('r2101', PurifiedNumberType::class, array(
//                        'label'    => false,
//                        'required' => false,
//                        'attr'     => array(
//                            'class' => 'positiveInteger',
//                        ),
//                    ))
                ->add('r2102', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                ->add('r2103', ChoiceType::class, array(
                    'label' => false,
                    'required' => false,
                    'placeholder' => false,
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'label_attr' => array('id' => 'r2103'),
                ))
                ->add('r2104', PurifiedNumberType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'label_attr' => array('id' => 'r2104'),
                ))
                ->add('titu341', PurifiedNumberType::class, array(
                        'label'    => false,
                    'required' => false,
                    'attr'     => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('stag341', PurifiedNumberType::class, array(
                        'label'    => false,
                    'required' => false,
                    'attr'     => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('contractuel342', PurifiedNumberType::class, array(
                        'label'    => false,
                    'required' => false,
                    'attr'     => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('blChartemp', ChoiceType::class, array(
                    'label' => "Votre collectivité dispose-t-elle d'une charte du temps au 31/12",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('r2271', ChoiceType::class, array(
                    'label' => "Avez-vous mis en place des procédures administratives de contrôle des arrêts maladies ?",
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('r2272', ChoiceType::class, array(
                        'label' => "Avez-vous mis en place des procédures médicales de contrôle des arrêts maladies ?",
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'expanded' => true,
                        'multiple' => false,
                        'placeholder' => false,
                        'required' => false,
                    ))
                ->add('blAutoassusansconvtitu', ChoiceType::class, array(
                    'label' => 'En auto-assurance sans convention de gestion avec Pôle Emploi (titulaire)',
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blAutoassuavecconvtitu', ChoiceType::class, array(
                    'label' => 'En auto-assurance avec convention de gestion avec Pôle Emploi (titulaire)',
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blAutoassuavecconvcont', ChoiceType::class, array(
                    'label' => 'êtes-vous en auto-assurance avec convention de gestion avec Pôle Emploi (contractuel)',
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blAutoassusansconvcont', ChoiceType::class, array(
                    'label' => 'êtes-vous en auto-assurance sans convention de gestion avec Pôle Emploi (contractuel)',
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blRegiassuchom', ChoiceType::class, array(
                    'label' => "Avez-vous adhéré au Régime d'assurance chômage (contractuel)",
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
//                ->add('blHeursupp', ChoiceType::class, array(
//                    'label' => 'Votre collectivité est elle concernée par les heures supplémentaires ?',
//                    'choices' => array('Oui' => 1, 'Non' => 0),
//                    'expanded' => true,
//                    'multiple' => false,
//                    'placeholder' => false,
//                    'required' => false,
//                ))
//                ->add('blHeurcomp', ChoiceType::class, array(
//                    'label' => 'Votre collectivité est elle concernée par les heures complémentaires ?',
//                    'choices' => array('Oui' => 1, 'Non' => 0),
//                    'expanded' => true,
//                    'multiple' => false,
//                    'placeholder' => false,
//                    'required' => false,
//                ))
                ->add('mtDepefonccoll', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => "positiveFloatRoundedIntegerUp",
                    )
                ))
                ->add('mtCharpers', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => "positiveFloatRoundedIntegerUp",
                    )

                ))
                ->add('lbRati', PurifiedNumberType::class, array(
                    'label' => 'Ratio charge de personnel ( en pourcentage )',
                    'required' => false,
                    'attr' => array(
                        'readonly' => true
                    ),
                ))
                ->add('blAgenaffeprev', ChoiceType::class, array(
                    'label' => '',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'hidden'
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    )
                ))
                ->add('nbVisimedisponprevH', PurifiedNumberType::class, array(
                    //'label' => '4.1.3 - Nombre de visites médicales spontanées chez le médecin de prévention',
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbVisimedisponprevF', PurifiedNumberType::class, array(
                    //'label' => '4.1.3 - Nombre de visites médicales spontanées chez le médecin de prévention',
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('blDocurisqpro', ChoiceType::class, array(
                    'label' => "4.1.4 - Votre collectivité dispose-t-elle d'un document unique d'évaluation des risques professionnels ?",
                    'choices' => array('En cours' => 2, 'Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('nmAnnecrea', PurifiedNumberType::class, array(
                    'label' => "4.1.4.1 - Année de création du document",
                    'required' => false,
                    'attr' => array(
                        'maxlength' => 4,
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nmAnnedernmaj', PurifiedNumberType::class, array(
                    'label'    => "4.1.4.2 - Année de la dernière mise à jour",
                    'required' => false,
                    'attr' => array(
                        'maxlength' => 4,
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('blPlanprevrisqpsysoci', ChoiceType::class, array(
                    'label' => "4.1.5 - Votre collectivité dispose-t-elle d'un plan de prévention des risques psychosociaux au 31/12/". $options['anneeCamp'] ."?",
                    'choices' => array('En cours' => 2, 'Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                //5.1.6.1 -
                ->add('blDemaprevtroumuscu', ChoiceType::class, array(
                    'label' => "Démarche de prévention des troubles musculo-squelettiques (TMS) ?",
                    'choices' => array('En cours' => 2, 'Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                //5.1.6.2 -
                ->add('blDemaprevrisqcanc', ChoiceType::class, array(
                    'label' => "Démarche de prévention des risques cancérogènes, mutagènes, toxiques pour la reproduction (CMR) ?",
                    'choices' => array('En cours' => 2, 'Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                //5.1.6.3 -
                ->add('blAutrdemaprev', ChoiceType::class, array(
                    'label' => "D'autres démarches de prévention des risques ?",
                    'choices' => array('En cours' => 2, 'Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blRegisantsecutrav', ChoiceType::class, array(
                    'label' => "4.1.7 - Votre collectivité dispose-t-elle d'un registre de santé et de sécurité au travail ?",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blActeviolphys', ChoiceType::class, array(
                    'label' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('q432', ChoiceType::class, array(
                        'label' => false,
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded' => true,
                        'multiple' => false,
                        'placeholder' => false,
                        'required' => false,
                    ))
                ->add('q433', ChoiceType::class, array(
                            'label' => false,
                            'choices' => array('Oui' => 1, 'Non' => 0),
                            'expanded' => true,
                            'multiple' => false,
                            'placeholder' => false,
                            'required' => false,
                        ))
                ->add('mtCnfptcotiobl', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloat',
                    )
                ))
                ->add('mtCnfptsupcotiobl', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloat',
                    )
                ))
                ->add('mtAutrorga', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloat',
                    )
                ))
                ->add('mtFraidepla', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloat',
                    )
                ))
                ->add('nbReunct', PurifiedNumberType::class, array(
                    "label" => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbReuncommiadmi', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbReuncommiconsu', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbReunchsct', PurifiedNumberType::class, array(
                    'label' => "Nombre de réunions du CHSCT",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('blCtsiegmissdevo', ChoiceType::class, array(
                    'label' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('nbReunctmissdevo', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                     'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbJourActRep', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                        'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbJourActSec', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbJourautospeacco', PurifiedNumberType::class, array(
                    'label' => "Nombre de journées d'autorisations spéciales d'absence accordées en application de l'article 16 du décret du 3 avril 1985",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbJourabse', PurifiedNumberType::class, array(
                    'label' => "Nombre de journées d'absence pour formation syndicale accordées aux fonctionnaires",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbHeurglob', PurifiedNumberType::class, array(
                    'label' => "Volume du contingent global d'heures d'autorisations spéciales d'absence calculé en application de l'article 14 du décret du 3 avril 1985",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )

                ))
                ->add('nbHeurdroisynd', PurifiedNumberType::class, array(
                    'label' => "Heures de décharges d'activité de service auxquelles ont droit les organisations syndicales",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbHeurutil', PurifiedNumberType::class, array(
                    'label' => "Heures de décharges d'activité de service effectivement utilisées",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('nbProtacco', PurifiedNumberType::class, array(
                    'label' => "Nombre de protocoles d'accords (avec seuil complémentaire)",
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('blGrev', ChoiceType::class, array(
                    'label' => false,
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blSubvverscomi', ChoiceType::class, array(
                    'label' => "Subventions versées au comité d'œuvres sociales local ou autres organismes propres à la collectivité",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blCotisubvcomiinter', ChoiceType::class, array(
                    'label' => "Cotisations et subventions à un comité intercollectivités (ou à un autre organisme intercollectivités)",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blRecPersTemp', ChoiceType::class, array(
                    'label' => "Avez-vous eu recours à du personnel temporaire provenant d'une  entreprise privée ou bien un CDG ? ",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
               /* ->add('blPresservcoll', ChoiceType::class, array(
                    'label' => "Prestations servies directement  par la collectivité territoriale (*)",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))*/
                ->add('blPresservcomsoc', ChoiceType::class, array(
                    'label' => "Prestations servies via un comité d'euvre sociales (*)",
                    'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blPlacresecrec', ChoiceType::class, array(
                    'label' => "Places réservées en crèche",
                    'choices' => array('Oui' => 1, 'Non' => 0,'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blAidefinagardenfa', ChoiceType::class, array(
                    'label' => "Aides financières pour la garde d'enfants ou les activités péri-scolaires",
                    'choices' => array('Oui' => 1, 'Non' => 0,'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blAutrgardenfa', ChoiceType::class, array(
                    'label' => "Autres",
                    'choices' => array('Oui' => 1, 'Non' => 0,'Ne sait pas' => 2),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blAutrgardenfaDescription', PurifiedTextareaType::class, array(
                    'label' => 'Description : ',
                    'required' => false,
                    'attr' => array(
                        'maxlength' => 50,
                    )
                ))
                ->add('blSantconvparti', ChoiceType::class, array(
                    'label' => "via une convention de participation pour la santé",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blSantcontregl', ChoiceType::class, array(
                    'label' => "via un contrat ou un réglement labellisé pour la santé",
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blPrevoconvparti', ChoiceType::class, array(
                    'label' => 'Protection sociale complémentaire via une convention de participation pour la prévoyance',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('blPrevocontregl', ChoiceType::class, array(
                    'label' => 'Proctection sociale complémentaire via un contrat ou un règlement labellisé pour la prévoyance',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('mtDepetota', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => "positiveFloatRoundedIntegerUp",
                    )
                ))
                ->add('mtDepeinsepershand', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => "positiveFloatRoundedIntegerUp",
                    )
                ))
                ->add('mtRealemplpershand', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => "positiveFloatRoundedIntegerUp",
                    )
                ))
                ->add('mtDepeamentrav', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => "positiveFloatRoundedIntegerUp",
                    )
                ))
                /* Plus utilisé pour le moment, en agent par agent */
//                ->add('nbTravhandemplperm', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                ))
//                ->add('txEmpldiretravhand', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                ))
//                ->add('txEmpllegatravhand', TextType::class, array(
//                    'required' => false,
//                    'label' => false,
//                ))
                ->add('Sante', CollectionType::class, array(
                    'entry_type' => SanteType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
                ->add('acteviolencephysique', CollectionType::class, array(
                    'entry_type' => ActeViolencePhysiqueType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
                ->add('Prevoyance', CollectionType::class, array(
                    'entry_type' => PrevoyanceType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
//                ->add('Etpr114AnneePrecedente', CollectionType::class, array(
//                    'entry_type' => Etpr114AnneePrecedenteType::class,
//                    'allow_add' => true,
//                    'required' => false,
//                    'label' => false,
//                    'label_attr' => array(
//                        'class' => ''
//                    ),
//                ))
//                ->add('Etpr131AnneePrecedente', CollectionType::class, array(
//                    'entry_type' => Etpr131AnneePrecedenteType::class,
//                    'block_name' => 'test',
//                    'allow_add' => true,
//                    'required' => false,
//                    'label' => false,
//                ))
//                ->add('Etpr124AnneePrecedente', CollectionType::class, array(
//                    'entry_type' => Etpr124AnneePrecedenteType::class,
//                    'allow_add' => true,
//                    'required' => false,
//                    'label' => false,
//                ))
                ->add('AgentSanctionDisciplinaire', CollectionType::class, array(
                    'entry_type' => SanctionDisciplinaireType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                ))
                ->add('AgentSanctionDisciplinaireStagiaire', CollectionType::class, array(
                    'entry_type' => SanctionDisciplinaireStagiaireType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                ))
                ->add('AgentSanctionDisciplinaireContractuel', CollectionType::class, array(
                    'entry_type' => SanctionDisciplinaireContractuelType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                )) ->add('AgentSanctionDisciplinaireContractuel', CollectionType::class, array(
                    'entry_type' => SanctionDisciplinaireContractuelType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                ))
                ->add('AgentMotifSanctionDisciplinaire', CollectionType::class, array(
                    'entry_type' => MotifSanctionDisciplinaireType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                ))
                ->add('ConflitTravail', CollectionType::class, array(
                    'entry_type' => ConflitTravailType::class,
                    'allow_add' => true,
                    'required' => false,
                    'label' => false,
                ))
                ->add('actionPrevention', CollectionType::class, array('entry_type' => ActionPreventionType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'label' => false,)
                )
                ->add('infocoll132', CollectionType::class, array('entry_type' => InfoColl_132Type::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'label' => false,)
                )
                ->add('infocoll157', CollectionType::class, array('entry_type' => InfoColl_157Type::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'label' => false,)
                )
                ->add('infocoll215', CollectionType::class, array('entry_type' => InfoColl_215Type::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'label' => false,)
                    )
                ->add('infocoll216', CollectionType::class, array('entry_type' => InfoColl_216Type::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'label' => false,)
                    )
                ;

        // RASSCT
        if ($options['enqueteCollectivite']->getBlRast() !== false) {
            $builder->add('ongletRassct', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
               'label' => "Enregistrer",
               'attr' => array(
                           'class' => 'pull-right btn btn-primary',
                       )
            ));
            $builder->add('rassctExistEvalRPS', ChoiceType::class, array(
                    'label'       => 'Au sein de votre collectivité, existe-t-il une évaluation des risques psychosociaux par service ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctMajEvalRPS', ChoiceType::class, array(
                    'label'       => 'Si oui, est ce que cette évaluation a été mise à jour dans l\'année ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctDiagRPS', ChoiceType::class, array(
                    'label'       => 'Votre collectivité dispose-t-elle d\'un diagnostic RPS ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctExistPrevActionSante', ChoiceType::class, array(
                    'label'       => 'Au sein de votre collectivité, existe-t-il un programme annuel de prévention ou un un plan d\'action santé sécurité ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctActiMedecPrev', ChoiceType::class, array(
                    'label'       => 'Disposez-vous du rapport d\'activités de la médecine préventive ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctDesiACFI', ChoiceType::class, array(
                    'label'       => 'Votre collectivité a-t-elle désignée un Agent Chargé de la Fonction d\'Inspection (ACFI) ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctNbVisitACFI', PurifiedNumberType::class, array(
                    'label'    => "Si oui, quel est le nombre de visite(s) de l'ACFI dans l'année ?",
                        'required' => false,
                    'attr'     => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('rassctNbCtChsct', PurifiedNumberType::class, array(
                    'label'    => "Quel est le nombre de saisines du CT/CHSCT pour l'exercie du droit d'alerte et de retrait dans l'année ?",
                        'required' => false,
                    'attr'     => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('rassctExistPrevEntreExte', ChoiceType::class, array(
                    'label'       => "Au sein de votre collectivité, existe-t-il un plan de prévention des entreprises extérieures établis dans l'année ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctExistDiagPeniAnnex', ChoiceType::class, array(
                    'label'       => 'Au sein de votre collectivité, existe-t-il un diagnostic de pénibilité annexé au document unique ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctNeceFicheSuiviFact', ChoiceType::class, array(
                    'label'       => 'Avez-vous établi des fiches individuelles de suivi des facteurs de pénibilité ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctExistFicheExpoPeni', ChoiceType::class, array(
                    'label'       => 'Au sein de votre collectivité, avez-vous mis en place des fiches d\'exposition à la pénibilité au cours de l\'année ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctNeceFicheAmiante', ChoiceType::class, array(
                    'label'       => 'Avez-vous établi des fiches d\'exposition à l\'amiante ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctExistFicheAmiante', ChoiceType::class, array(
                    'label'       => 'Au sein de votre collectivité, avez-vous mis en place des fiches d\'exposition à l\'amiante au cours de l\'année ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ))
                ->add('rassctExistFicheAmiante', ChoiceType::class, array(
                    'label'       => 'Au sein de votre collectivité, avez-vous mis en place des fiches d\'exposition à l\'amiante au cours de l\'année ?',
                        'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                ));
        }

        if ($options['enqueteCollectivite']->getBlHand() !== false) {
            $builder->add('ongletHand', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
               'label' => "Enregistrer",
               'attr' => array(
                           'class' => 'pull-right btn btn-primary',
                       )
            ));
            $builder->add('handMailCorres', EmailType::class, array(
                        'label'    => "A1-7 - Mail du correspondant Handicap",
                        'required' => false,
                    ))
                    ->add('handObliEmplTrav', ChoiceType::class, array(
                        'label'       => false,
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                    ))
                    ->add('handNbAvisInapTempo', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbAvisInapDef', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbAvisInapDefToutesFonctions', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbRecla', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbRetraiteInval', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbLicencInapPhysi', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handMesureAmenaPosteCondTrav', ChoiceType::class, array(
                        'label'       => false,
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                    ))
                    ->add('handNbMesureAmenaPosteCondTrav', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbMesureAmenaPosteCondTravBoeth', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handMesureChangAffec', ChoiceType::class, array(
                        'label'       => false,
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                    ))
                    ->add('handNbMesureChangAffec', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbMesureChangAffecBoeth', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handDispoOffice', ChoiceType::class, array(
                        'label'       => false,
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                    ))
                    /* DEBUT 2.1.7 - */
                    ->add('q2171', ChoiceType::class, array(
                        'label'       => "Y a-t-il eu des hommes qui sont partis en congé de 6 mois ou plus au cours de l'année dans votre
                                    collectivité ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'class' => 'ind217',
                            'data-name' => 'q2171',
                            'onChange' => 'init217()'
                        )
                    ))
                    ->add('r2171', ChoiceType::class, array(
                        'label'       => "Si oui, y a-t-il eu un départ en congé sans entretien ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'class' => 'hidden q2171'
                        ),
                        'label_attr' => array(
                            'class' => 'hidden q2171'
                        )
                    ))
                    ->add('q2172', ChoiceType::class, array(
                        'label'       => "Y a-t-il eu des femmes qui sont parties en congé de 6 mois ou plus au cours de l'année dans
                                            votre collectivité ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'data-name' => 'q2172',
                            'class' => 'ind217',
                            'onChange' => 'init217()'
                        )
                    ))
                    ->add('r2172', ChoiceType::class, array(
                        'label'       => "Si oui, y a-t-il eu un départ en congé sans entretien ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'class' => 'hidden q2172'
                        ),
                        'label_attr' => array(
                            'class' => 'hidden q2172'
                        )
                    ))
                    ->add('q2173', ChoiceType::class, array(
                        'label'       => "Y a-t-il eu des hommes qui sont revenus au cours de l'année d'un congé de 6 mois ou plus dans
                                            votre collectivité ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'data-name' => 'q2173',
                            'class' => 'ind217',
                            'onChange' => 'init217()'
                        )
                    ))
                    ->add('r2173', ChoiceType::class, array(
                        'label'       => "Si oui, y a-t-il eu un retour de congé sans entretien ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'class' => 'hidden q2173'
                        ),
                        'label_attr' => array(
                            'class' => 'hidden q2173'
                        )
                    ))
                    ->add('q2174', ChoiceType::class, array(
                        'label'       => "Y a-t-il eu des femmes qui sont revenues au cours de l'année d'un congé de 6 mois ou plus dans
                                            votre collectivité ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'data-name' => 'q2174',
                            'class' => 'ind217',
                            'onChange' => 'init217()'
                        )
                    ))
                    ->add('r2174', ChoiceType::class, array(
                        'label'       => "Si oui, y a-t-il eu un retour de congé sans entretien ?",
                        'choices' => array('Oui' => 1, 'Non' => 0),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                        'attr' => array(
                            'class' => 'hidden q2174'
                        ),
                        'label_attr' => array(
                            'class' => 'hidden q2174'
                        )
                    ))
                    /* FIN 2.1.7 */
                    ->add('q425', ChoiceType::class, array(
                        'label'       => "Avez-vous adhéré à un contrat d'assurance statutaire pour la gestion du risque maladie ?",
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                    ))
                    ->add('q3110', ChoiceType::class, array(
                        'label'       => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false
                    ))
                    ->add('rifseepContractuel', ChoiceType::class, array(
                        'label'       => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false
                    ))
                    ->add('mpccm', ChoiceType::class, array(
                        'label'       => "Avez-vous prévu le maintien des primes en cas de congé maladie ?",
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false
                    ))
                    ->add('q3111', ChoiceType::class, array(
                        'label'       => false,
                        'choices' => array('Oui' => 1, 'Non' => 0, 'Ne sait pas' => 2),
                        'expanded'    => true,
                        'multiple'    => false,
                        'placeholder' => false,
                        'required'    => false,
                    ))
                    ->add('handNbDispoOffice', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbDispoOfficeBoeth', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbReclaDemande', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbDemReclaInapAcciTravMaladiePro', PurifiedNumberType::class, array(
                        'label'    => "A5-2-0-1 - Combien faisaient suite à une inaptitude liée à un accident du travail ou une maladie professionnelle ?",
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbReclaReal', PurifiedNumberType::class, array(
                        'label'    => false,
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
                    ))
                    ->add('handNbReaReclaInapAcciTravMaladiePro', PurifiedNumberType::class, array(
                        'label'    => "A5-2-1-1 - Combien faisaient suite à une inaptitude liée à un accident du travail ou une maladie professionnelle ?",
                        'required' => false,
                        'attr'     => array(
                            'class' => 'positiveInteger',
                        )
            ))
                ->add('r13221', PurifiedNumberType::class, array(
                    'label'    => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('r13222', PurifiedNumberType::class, array(
                    'label'    => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger',
                    )
                ))
                ->add('r13223', PurifiedNumberType::class, array(
                    'label'    => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ))
                ->add('r13224', PurifiedNumberType::class, array(
                    'label'    => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'positiveInteger'
                    )
                ));
        }

//        $builder->add('Enregistrer', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
//            'label' => "Enregistrer",
//            'attr' => array(
//                        'class' => 'pull-right btn btn-primary',
//                    )
//        ));
//        $builder->add('onglet114', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
//            'label' => "Enregistrer",
//            'attr' => array(
//                        'class' => 'pull-right btn btn-primary',
//                    )
//        ));
        $builder->add('onglet217', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet311', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet321', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                'class' => 'pull-right btn btn-primary',
            )
        ));
//        $builder->add('onglet124', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
//            'label' => "Enregistrer",
//            'attr' => array(
//                        'class' => 'pull-right btn btn-primary',
//                    )
//        ));
//        $builder->add('onglet131', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
//            'label' => "Enregistrer",
//            'attr' => array(
//                        'class' => 'pull-right btn btn-primary',
//                    )
//        ));
        $builder->add('onglet132', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet157', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                'class' => 'pull-right btn btn-primary',
            )
        ));
        $builder->add('onglet215', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                'class' => 'pull-right btn btn-primary',
            )
        ));
        $builder->add('onglet216', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                'class' => 'pull-right btn btn-primary',
            )
        ));
        $builder->add('onglet162', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet21', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet225', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet227', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet341', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet342', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet343', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
//        $builder->add('onglet344', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
//            'label' => "Enregistrer",
//            'attr' => array(
//                        'class' => 'pull-right btn btn-primary',
//                    )
//        ));
        $builder->add('onglet345', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet412', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet413', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet414', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet417', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('ongletq425', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                'class' => 'pull-right btn btn-primary',
            )
        ));
        $builder->add('onglet43', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet514', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet611', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet612', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet613', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet614', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
        $builder->add('onglet71', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array(
            'label' => "Enregistrer",
            'attr' => array(
                        'class' => 'pull-right btn btn-primary',
                    )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => InformationColectiviteAgent::class,
        ));
        $resolver->setRequired('enqueteCollectivite');
        $resolver->setRequired('anneeCamp');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_informationcolectiviteagent';
    }

}
