<?php

namespace Bilan_Social\Bundle\ModelVuesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelVuesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('blTypeColl', CheckboxType::class, array(
                    'label' => 'Type de collectivité',
                    'required' => false,
                ))
                ->add('blLibe', CheckboxType::class, array(
                    'label' => 'Libellé',
                    'required' => false,
                ))
                ->add('blSire', CheckboxType::class, array(
                    'label' => 'SIRET',
                    'required' => false,
                ))
                ->add('blLbAdresse', CheckboxType::class, array(
                    'label' => 'Adresse',
                    'required' => false,
                ))
//                ->add('blLbAdresse', CheckboxType::class, array(
//                    'label' => 'Adresse',
//                    'required' => false,
//                ))
                ->add('blAffiCdg', CheckboxType::class, array(
                    'label' => 'Affiliation au Centre de gestion',
                    'required' => false,
                ))
                ->add('blDepa', CheckboxType::class, array(
                    'label' => 'Departement',
                    'required' => false,
                ))
                ->add('blCdPost', CheckboxType::class, array(
                    'label' => 'Code postal',
                    'required' => false,
                ))
                ->add('blLbVill', CheckboxType::class, array(
                    'label' => 'Ville',
                    'required' => false,
                ))
                ->add('blCdInse', CheckboxType::class, array(
                    'label' => 'Code INSEE',
                    'required' => false,
                ))
                ->add('blNmPopuInse', CheckboxType::class, array(
                    'label' => 'Population totale INSEE',
                    'required' => false,
                ))
                ->add('blSurclasDemo', CheckboxType::class, array(
                    'label' => 'Sur-classement démographique',
                    'required' => false,
                ))
                ->add('blNmStratColl', CheckboxType::class, array(
                    'label' => 'Strate de sur-classement',
                    'required' => false,
                ))
                ->add('blCtCdg', CheckboxType::class, array(
                    'label' => 'Rattachement au comité technique',
                    'required' => false,
                ))
                ->add('blChsct', CheckboxType::class, array(
                    'label' => 'CHSCT propre à la collectivité',
                    'required' => false,
                ))
                ->add('blCollDgcl', CheckboxType::class, array(
                    'label' => 'Echantillon DGCL',
                    'required' => false,
                ))
                ->add('cdg_is_authorized_by_collectivity', CheckboxType::class, array(
                    'label' => 'CDG autorisé à prendre la place',
                    'required' => false,
                ))
                ->add('fgStat', CheckboxType::class, array(
                    'label'    => 'Etat de saisie',
                    'required' => false,
                ))
                ->add('blBilaSoci', CheckboxType::class, array(
                    'label' => 'Bilan social',
                    'required' => false,
                ))
                ->add('blRass', CheckboxType::class, array(
                    'label' => 'RASSCT',
                    'required' => false,
                ))
                ->add('blHand', CheckboxType::class, array(
                    'label' => 'Handitorial',
                    'required' => false,
                ))
                ->add('blGpee', CheckboxType::class, array(
                    'label' => 'GPEEC',
                    'required' => false,
                ))
                ->add('blGpeecPlus', CheckboxType::class, array(
                    'label'    => 'GPEEC +',
                    'required' => false,
                ))
                ->add('blApa', CheckboxType::class, array(
                    'label' => 'Agent par agent',
                    'required' => false,
                ))
                ->add('blCons', CheckboxType::class, array(
                    'label' => 'Consolidé',
                    'required' => false,
                ))
                ->add('blN4ds', CheckboxType::class, array(
                    'label' => 'N4DS',
                    'required' => false,
                ))
                ->add('blBaseCarr', CheckboxType::class, array(
                    'label' => 'Base carrière',
                    'required' => false,
                ))
                ->add('blNom', CheckboxType::class, array(
                    'label' => 'Nom du contact de la collectivité',
                    'required' => false,
                ))
                ->add('blTele', CheckboxType::class, array(
                    'label' => 'Téléphone du contact de la collectivité',
                    'required' => false,
                ))
                ->add('blBilaSociVide', CheckboxType::class, array(
                    'label' => 'Bilan social vide',
                    'required' => false,
                ))
                ->add('blCourtier', CheckboxType::class, array(
                    'label' => 'Courtier',
                    'required' => false,
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ModelVuesBundle\Entity\ModelVues'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_modelvuesbundle_modelvues';
    }


}
