<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgents;
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
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifArrivee;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMotifDepart;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPositionStatutaire;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefPourcentageTempaPartiel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStageTitularisation;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStructureOrigine;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsNonComplet;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTempsPartiel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeMissionPrevention;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class BilanSocialAgentType extends AbstractType {
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                // [Q0]
                ->add('lbNom', PurifiedTextType::class, array(
                    'label' => 'Q0 - Nom ',
                    'required' => false,
                ))
                ->add('lbPren', PurifiedTextType::class, array(
                    'label' => 'Q0 - Prénom',
                    'required' => false,
                ))
                ->add('lbDatenais', PurifiedTextType::class, array(
                    'label' => 'Q0 - Date de naissance ( mois / année )',
                    'required' => false,
                ))
                //manque date de naissance ici
                //
                // [ Q1 ]
                ->add('cdSexe', ChoiceType::class, array(
                    'choices' => array('Homme' => 1, 'Femme' => 0),
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
                    'label' => 'Q2 - Quel est son dernier statut connu au plus tard au 31/12 ?',
                    'required' => false,
                ))
                // [ Q2.8.1 ]
                ->add('RefCadreEmploi', EntityType::class, array(
                    'class' => RefCadreEmploi::class,
                    'choice_label' => 'lbCadrempl',
                    'label' => 'Q2.8 - Quel est votre cadre d\'emploi d\'origine ?',
                    'required' => false,
                ))
                // [ Q2.0 ]
                ->add('blAcqustatanne', ChoiceType::class, array(
                    'label' => 'Q2.0 – L’agent a t’il acquit ce statut au cours de l\'année ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))

//Q2.1 - L\'agent est-il en CDI ?
//Q2.2 - Quel est le type de CDD ?
//Q2.3 - L\'agent est-il fonctionnaire ou stagiaire ? / plus utilisé
//Q2.4 - L\'agent est-il contractuel permanent ? / plus utilisé
//Q2.5 - Si oui en Q2.3 Est-il titulaire ou stagiaire ?
//
//
                // [Q2.6]
                ->add('refEmploiNonPermanent', EntityType::class, array(
                    'class' => RefEmploiNonPermanent::class,
                    'label' => 'Question 2.6 - Quel est le type de contrat non permanent ?',
                    'choice_label' => 'lbEmplnonperm',
                    'required' => false,
                ))
                // [ Q2.7.0 ]
                ->add('blPosiacti', ChoiceType::class, array(
                    'label' => 'Q2.7.0 - Quelle est votre position statutaire au 31/12 ?',
                    'choices' => array('Activité' => 0, 'Particulière' => 1),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q2.7 ]
                ->add('refPositionStatutaire', EntityType::class, array(
                    'label' => "Quelle est votre position particulière ?",
                    'class' => RefPositionStatutaire::class,
                    'choice_label' => 'lbPositionStatutaireComplet',
                    'group_by' => 'lbGroupePositionStatutaire',
                    'required' => false
                ))
                // [ Q3 ]
                ->add('refCategorie', EntityType::class, array(
                    'class' => RefCategorie::class,
                    'choice_label' => 'lbCate',
                    'required' => false,
                ))
                ->add('refFiliere', EntityType::class, array(
                    'class' => RefFiliere::class,
                    'choice_label' => 'lbFili',
                    'required' => false,
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
                ))
//                ->add('idCate', IntegerType::class, array(
//                    'label' => 'Q3 - Quel est le grade de l\'agent ?',
//                    'required' => false,
//                ))
                // [ Q4.1 ]
                ->add('blAgenremu3112', ChoiceType::class, array(
                    'label' => 'Q4.1 - Agent rémunéré au 31/12 ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q4.2 ]
                ->add('blAgenremuanne', ChoiceType::class, array(
                    'label' => 'Q4.2 - Agent rémunéré au moins une fois dans l\'année?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q5.1 ]
                ->add('blAgenarriannecoll', ChoiceType::class, array(
                    'label' => 'Q5.1 - L\'agent est-il arrivé dans l\'année du BS dans la collectivité ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q5.2 ]
                ->add('lbDatedepacoll', PurifiedTextType::class, array(
                    'label' => 'Q5.2 - Quelle est la date de départ de l\'agent de la collectivité ?',
                    'required' => false,
                ))
                // [ Q5.3 ]
                ->add('blMouvinteanne', ChoiceType::class, array(
                    'label' => 'Q5.3 - Est-ce que l\'agent a bénéficié d\'un mouvement interne au cours de l\'année ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q5.4 ]
                ->add('refMotifArrivee', EntityType::class, array(
                    'class' => RefMotifArrivee::class,
                    'choice_label' => 'lbMotiarri',
                    'label' => 'Q5.4 - Quel est le motif d\'arrivée ?',
                    'required' => false,
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
                //[ Q8.1A si oui Q8.1 afficher ce champ]
//                ->add('idGraddeta', IntegerType::class, array(
//                    'required' => false,
//                ))
                ->add('idGraddeta', EntityType::class, array(
                    'required' => false,
                    'class' => RefGrade::class,
                    'choice_label' => 'lbGrad',
                    'placeholder' => "",
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->where('u.blDeta = :blDeta')
                                ->setParameter('blDeta', '1')
                        ;
                    },
                ))
                // VOIR Q8.2 - De quelle fonction publique est-il détaché ?
                //[ Q8.2.1 ]
                ->add('idCadrempldeta', IntegerType::class, array(
                    'label' => 'Q2.1 - L\'agent est-il en CDI ?',
                    'required' => false,
                ))
                // [ Q8.3 ]
                ->add('refEmploiFonctionnel', EntityType::class, array(
                    'class' => RefEmploiFonctionnel::class,
                    'choice_label' => 'lbEmplfonc',
                    'label' => 'Q8.3 - Sur quel emploi fonctionnel est-il détaché ?',
                    'required' => false,
                ))
                // [ Q8.4 ]
                ->add('dtDetaemplfonc', DateType::class, array(
                    'label' => 'Q8.4 - A quelle date a t\'il été détaché sur cet emploi fonctionnel ?',
                    'required' => false,
                ))
                // [ Q11.1 ]
                ->add('blTempcomp', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'label' => 'Q11.1 - (Excepté Non Permanent) L\'agent est-il à temps complet ?',
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q11.2 ]
                ->add('refTempsNonComplet', EntityType::class, array(
                    'class' => RefTempsNonComplet::class,
                    'choice_label' => 'lbTempnoncomp',
                    'label' => 'Q11.2 - Quel est le temps hebdomadaire ?',
                    'required' => false,
                ))
                // [ Q12.1 ]
                ->add('blTempplein', ChoiceType::class, array(
                    'label' => 'Q12.1 - L\'agent est-il à temps plein (Excepté Cont Non Permanent) ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q12.2 ]
                ->add('refTempsPartiel', EntityType::class, array(
                    'class' => RefTempsPartiel::class,
                    'choice_label' => 'lbEmplfonc',
                    'label' => 'Q2.2 - Quel est le type de CDD ?',
                    'required' => false,
                ))
                // [ Q12.3 ]
                ->add('refPourcentageTempaPartiel', EntityType::class, array(
                    'class' => RefPourcentageTempaPartiel::class,
                    'choice_label' => 'lbPourtemppart',
                    'label' => 'Q12.3 - Quel est le pourcentage de temps partiel ?',
                    'required' => false,
                ))
                // [ Q13 ]
                ->add('nmHeurremuanne', NumberType::class, array(
                    'label' => 'Q13 - Quel est le nombre d\'heures rémunérées dans l\'année ?',
                    'required' => false,
                ))
                // [ Q20.3]
                ->add('nbAllotempinac', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q20.4]
                ->add('nbAllotempinva', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q21]
                ->add('blCongpateaccuenfa', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q21.1]
                ->add('nbJourcongpateaccuenfa', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q22]
                ->add('blEntrdepacong', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q22.1]
                ->add('idMotientrdepacong', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q23]
                ->add('blEntrretocong', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q23.1]
                ->add('idMotientrretocong', IntegerType::class, array(
                    'required' => false,
                ))
                ->add('blCet', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q26.2]
                ->add('nbJourcumu3112', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q26.3]
                ->add('nbJourvers3112', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q26.4]
                ->add('nbJourdepe3112', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q26.5]
                ->add('nbJourinde3112', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q26.6]
                ->add('nbJourprisrafp3112', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q27]
                ->add('blTeletrav', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q31.1]
                ->add('blAgenprev', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q31.2]
                ->add('refTypeMissionPrevention', EntityType::class, array(
                    'class' => RefTypeMissionPrevention::class,
                    'choice_label' => 'lbTypemissprev',
                    'required' => false,
                ))
                // [Q32.1]
                ->add('blDemainap', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [R31.1]
                ->add('idInapdema', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q32.2]
                ->add('blDeciinap', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [R32.2]
                ->add('idInapdeci', IntegerType::class, array(
                    'required' => false,
                ))
                ->add('blFormsuiv', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q34.1]
                ->add('blVae', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q34.2]
                ->add('idEbcf', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q35.1]
                ->add('blBilacomp', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q35.2]
                ->add('nbBilacomp', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q36.1]
                ->add('blCongform', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'required' => false,
                    'placeholder' => false,
                ))

                // [ Q29.1 ]
                ->add('mtRemuannubrut', IntegerType::class, array(
                    'label' => 'Q29.1 (Si RIC - 1 est à OUI) - Montant total des rémunérations annuelles brutes ?',
                    'required' => false,
                ))
                // [ Q29.2 ]
                ->add('mtTotaremuprimindem', IntegerType::class, array(
                    'required' => false,
                ))
                // [ Q29.3 ]
                ->add('mtTotaremubrutnbi', IntegerType::class, array(
                    'required' => false,
                ))
                // [ Q29.4 ]
                ->add('mtTotaremubrutheursupp', NumberType::class, array(
                    'required' => false,
                ))
                // [ Q30.1 ]
                ->add('nbHeursupp', NumberType::class, array(
                    'label' => 'Q30.1 - Nombre d\'heures supplémentaires réalisées et rémunérées',
                    'required' => false,
                ))
                // [ Q30.2 ]
                ->add('nbHeurcomprealremu', NumberType::class, array(
                    'required' => false,
                ))

                // [ Q19 ]
                ->add('blBoeth', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'label' => 'Q19 - (Si QIC " à OUI) L\'agent est-il BOETH ?',
                    'placeholder' => false,
                    'required' => false,
                ))
                //[ Q9.2 ]
                ->add('refFonctionPublique', EntityType::class, array(
                    'class' => RefFonctionPublique::class,
                    'choice_label' => 'lbFoncpubl',
                    'required' => false,
                ))



                // [ R2.7.B.B ]
                ->add('idStruorigposistat', ChoiceType::class, array(
                    'choices' => array('Agent originaire de la collectivité' => true,
                        'Originaire d\'une autre structure' => false,
                    ),
                    'expanded' => true,
                    'multiple' => false,

                    'required' => false,
                    'placeholder' => false,
                ))



                // [ Q17 ]
                ->add('blAgentitustaganne', ChoiceType::class, array(
                    'label' => 'Q17 L\'agent a-t-il été titularisé ou mise en stage au cours de l\'année ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
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
                ))

                // [ Q2.0.1 ]
                ->add('blTituloisauvaanne', ChoiceType::class, array(
                    'label' => 'Q2.0.1 - L\'agent a t-il été titularisé par la loi Sauvadet au cours de l\'année ?',
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))

                // [ Q2.0.2 ]
                ->add('blRecrsansconcseleprof', ChoiceType::class, array(
                    'label' => 'Q2.0.2 - Est-ce que c\'est un recrutement réservé sans concours ou sélection professionnelle ?',
                    'choices' => array('Recrutement réservé sans concours' => 1, 'Sélection professionelle' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))

                // [  Q16  ]
                ->add('idMotidepa', EntityType::class, array(
                    'class' => RefMotifDepart::class,
                    'choice_label' => 'lbMotidepa',
                    'required' => false,
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

                // [ Q18 ]
                ->add('blPromavanstaganne', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'label' => 'Q18 - (Tit et Stagiaire uniquement) L\'agent a-t-il eu une promotion, un avancement ou une mise en stage suite à un concours au cours de l\'année ?',
                    'placeholder' => false,
                    'required' => false,
                ))
                // [ Q18.1 ]
                ->add('refAvancementPromotionConcours', EntityType::class, array(
                    'class' => RefAvancementPromotionConcours::class,
                    'choice_label' => 'lbAvanpromconc',
                    'required' => false,
                ))

                // [ Q25 ]
                ->add('refContrainteTravail', EntityType::class, array(
                    'class' => RefContrainteTravail::class,
                    'choice_label' => 'lbConttrav',
                    'expanded' => true, // todo a voir ce qui est le mieu
                    'multiple' => true,
                ))
                // [ Q28.1 ]
                ->add('nbDemapart', IntegerType::class, array(
                    'label' => 'Q28.1 - (Excepté Cont Non Permanent) Combien de demandes de temps partiel l\'agent a-t-il présenté ?',
                    'required' => false,
                ))
                // [ Q28.2 ]
                ->add('nbDemapartacce', IntegerType::class, array(
                    'required' => false,
                ))
                // [ Q28.3 ]
                ->add('nbPremdemasati', IntegerType::class, array(
                    'required' => false,
                ))
                // [ Q28.4 ]
                ->add('nbModiemplpermtempcomp', IntegerType::class, array(
                    'required' => false,
                ))
                // [ Q28.5 ]
                ->add('nbAgenempltempcompnonrenou', IntegerType::class, array(
                    'required' => false,
                ))
                // [ Q24 ]
                ->add('refCycleTravail', EntityType::class, array(
                    'class' => RefCycleTravail::class,
                    'choice_label' => 'lbCycltrav',
                    'label' => 'Q24 - ((Excepté non permanent) et (si QIC2 est à OUI)) Quel est le cycle de travail ? (Référentiel)',
                    'required' => false,
                ))
                // [ Q13 ]
                ->add('nmHeurremuanne', NumberType::class, array(
                    'label' => 'Q13 - Quel est le nombre d\'heures rémunérées dans l\'année ?',
                    'required' => false,
                ))

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
                ->add('AbsenceArretAgents', AbsenceArretAgentType::class, array(
                ))
//                ->add('AbsenceArretAgent', AbsenceArretAgentType::class, array(
//                    'required' => false,
//                ))
                // [ Q20.3]
                ->add('nbAllotempinac', IntegerType::class, array(
                    'label' => 'Q20.3 - Combien de fois a til eu droit à une allocation temporaire d\'inactivité suite à un AT ou MP ?',
                    'required' => false,
                ))
                // [Q20.4]
                ->add('nbAllotempinva', IntegerType::class, array(
                    'label' => 'Q20.4 -  Combien de fois a til eu droit à une allocation temporaire d\'invalidité ?',
                    'required' => false,
                ))
                // [Q21]
                ->add('blCongpateaccuenfa', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q21.1]
                ->add('nbJourcongpateaccuenfa', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q22]
                ->add('blEntrdepacong', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                ->add('idTypeCdd', PurifiedTextType::class, array(
                    'label' => 'idTypeCdd ',
                    'required' => false,
                ))
                // [Q22.1]
                ->add('idMotientrdepacong', IntegerType::class, array(
                    'required' => false,
                ))
                // [Q23]
                ->add('blEntrretocong', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded' => true,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ))
                // [Q23.1]
                ->add('idMotientrretocong', IntegerType::class, array(
                    'required' => false,
                ))

                // [Q15.1]
                ->add('refStructureOrigine', EntityType::class, array(
                    'label' => 'Quelle est la structure d\'origine de l\'agent?',
                    'class' => RefStructureOrigine::class,
                    'choice_label' => 'lbStruorig',
                    'required' => false,
                ))
                ->add('valider', SubmitType::class)
                ->add('enregistrer', SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\BilanSocialAgent',
            'entityManager' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_apabundle_bilansocialagent';
    }

}
