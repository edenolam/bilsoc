<?php

namespace Bilan_Social\Bundle\EnqueteBundle\Form;

use Bilan_Social\Bundle\EnqueteBundle\Entity\EnqueteCollectiviteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class ParametrageEnqueteForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('colonnes', ChoiceType::class, array(
                    'label'       => false,
                    'choices'     => array(
                        'Adresse'                                                      => 'blLbAdresse',
                        'Affiliation au CDG'                                           => 'blAffiCdg',
                        'Agent par agent'                                              => 'blApa',
                        'Base carrière'                                                => 'blBaseCarr',
                        'Bilan social'                                                 => 'blBilaSoci',
                        'Bilan social vide'                                            => 'blBilaSociVide',
                        'CDG autorisé à prendre la place'                              => 'cdg_is_authorized_by_collectivity',
                        'CHSCT propre à la collectivité'                               => 'blChsct',
                        'Code INSEE'                                                   => 'blCdInse',
                        'Code postal'                                                  => 'blCdPost',
                        'Consolidé'                                                    => 'blCons',
                        'Département'                                                  => 'blDepa',
                        'Echantillon DGCL'                                             => 'blCollDgcl',
                        'Courtier'                                                    => 'blCourtier',
                        'Etat de saisie'                                               => 'fgStat',
                        'GPEEC'                                                        => 'blGpee',
                        'GPEEC +'                                                      => 'blGpeecPlus',
                        'Handitorial'                                                  => 'blHand',
                        'Libellé'                                                      => 'blLibe',
                        'N4ds'                                                         => 'blN4ds',
                        'Nombre total d\'agents contractuels sur emploi non permanent' => 'blNbAgenContNonPerm',
                        'Nombre total d\'agents contractuels sur emploi permanent'     => 'blNbAgenContPerm',
                        'Nombre total d\'agents sur emploi permanent'                  => 'blNbAgenPerm',
                        'Nombre total d\'agents titulaires'                            => 'blNbAgenTitu',
                        'Population totale INSEE'                                      => 'blNmPopuInse',
                        'RASSCT'                                                       => 'blRass',
                        'Rattachement au comité technique'                             => 'blCtCdg',
                        'SIRET'                                                        => 'blSire',
                        'Strate de sur-classement'                                     => 'blNmStratColl',
                        'Sur-classement démographique'                                 => 'blSurclasDemo',
                        'Type de collectivité'                                         => 'blTypeColl',
                        'Ville'                                                        => 'blLbVill',
                        'Téléphone contact'                                            => 'blTele',
                        'Nom du contact'                                               => 'blNom'
                    ), 
                    'expanded' => false,
                    'multiple' => false,
                    'attr' => array('size' => '5'),
                    'required' => false,
                    'placeholder' => false,
                ))
                ->add('filtres', ChoiceType::class, array(
                    'label'       => false,
                    'choices'     => array(
                        'Adresse'                                                      => 'lbAdre-30',
                        'Affiliation au CDG'                                           => 'blAffiCdg-10',
                        'Agent par agent'                                              => 'blApa-19',
                        'Base carrière'                                                => 'blBaseCarr-22',
                        'Bilan Social'                                                 => 'blBilaSoci-15',
                        'Bilan social vide'                                            => 'blBilaSociVide-23',
                        'CDG autorisé à prendre la place'                              => 'cdg_is_authorized_by_collectivity-14',
                        'CHSCT propre à la collectivité'                               => 'blChsct-12',
                        'Code INSEE'                                                   => 'blCdInse-5',
                        'Code postal'                                                  => 'blCdPost-3',
                        'Consolidé'                                                    => 'blCons-20',
                        'Département'                                                  => 'blDepa-1',
                        'Echantillon DGCL'                                             => 'blCollDgcl-13',
                        'Courtier'                                                     => 'blCourtier-33',
                        'Etat de saisie'                                               => 'fgStat-28',
                        'GPEEC'                                                        => 'blGpee-18',
                        'GPEEC +'                                                      => 'blGpeecPlus-29',
                        'Handitorial'                                                  => 'blHand-17',
                        'Libellé'                                                      => 'blLibe-2',
                        'N4DS'                                                         => 'blN4ds-21',
                        'Nombre total d\'agents contractuels sur emploi non permanent' => 'blNbAgenContNonPerm-27',
                        'Nombre total d\'agents contractuels sur emploi permanent'     => 'blNbAgenContPerm-26',
                        'Nombre total d\'agents sur emploi permanent'                  => 'blNbAgenPerm-24',
                        'Nombre total d\'agents titulaires'                            => 'blNbAgenTitu-25',
                        'Population totale INSEE'                                      => 'blNmPopuInse-7',
                        'RASSCT'                                                       => 'blRass-16',
                        'Rattachement au comité technique'                             => 'blCtCdg-11',
                        'SIRET'                                                        => 'blSire-6',
                        'Strate de sur-classement'                                     => 'blNmStratColl-9',
                        'Sur-classement démographique'                                 => 'blSurclasDemo-8',
                        'Type de collectivité'                                         => 'blTypeColl-0',
                        'Ville'                                                        => 'blLbVill-4',
                        'Téléphone contact'                                            => 'blTele-31',
                        'Nom du contact'                                               => 'blNom-32'
                    ),
                    'expanded'    => false,
                    'multiple' => false,
                    'attr' => array('size' => '5'),
                    'required' => false,
                    'placeholder' => false,
                ))
//                ->add('conditions', ChoiceType::class, array(
//                    'label'       => false,
//                    'choices' => array('égal à' => '==',
//                        'différent de' => '!=',
//                        'contient' => 'in',
//                        'commence par' => '^=',
//                        'est supérieur à' => '>',
//                        'est inférieur à' => '<',
//                        'est supérieur ou égale à' => '>=',
//                        'est inférieur ou égale à' => '<='
//                    ), 
//                    'expanded' => false,
//                    'multiple' => false,
//                    'attr' => array('size' => '5'),
//                    'required' => false,
//                    'placeholder' => false,
//                ))
                ->add('blIdTypeColl', HiddenType::class, array(
                    'empty_data' => '1',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blIdDepa', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blLbColl', HiddenType::class, array(
                    'empty_data' => '1',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blCdPost', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blLbVill', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blCdInse', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blNmSire', HiddenType::class, array(
                    'empty_data' => '1',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blNmPopuInse', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blBlSurclasDemo', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blNmStratColl', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blBlAffiColl', HiddenType::class, array(
                    'empty_data' => '1',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blBlCtCdg', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blChsct', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blBlCollDgcl', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('blCourtier', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ))
                ->add('cdg_is_authorized_by_collectivity', HiddenType::class, array(
                    'empty_data' => '0',
                    'attr' => array('class' => 'hidden'),
                ));
    }

    public function getBlockPrefix() {
            return 'parametrageEnquete';
    }

}

