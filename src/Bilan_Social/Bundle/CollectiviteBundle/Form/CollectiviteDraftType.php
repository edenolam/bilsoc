<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCollectivite;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;
use Bilan_Social\Bundle\CollectiviteBundle\Form\CdgType;
use Bilan_Social\Bundle\ReferencielBundle\Form\RefCategorieType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;

class CollectiviteDraftType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('categorie', EntityType::class,array(
                    'class' => RefCategorie::class,
                    'choice_label' => 'lbCate',
                    'label' => 'Catégorie juridique',
                    'required' => true,
                ))
                ->add('lbColl', PurifiedTextType::class, array(
                    'label' => 'Nom de la collectivité (Raison sociale)',
                    'required' => true,
                ))
                ->add('lbAdre', PurifiedTextType::class, array(
                    'label' => 'Adresse',
                    'required' => true,
                ))
                ->add('cdPost', PurifiedTextType::class, array(
                    'required' => true,
                    'label' => "Code postal",
                    'attr' => array(
                        'maxlength' => 5,
                    )
                ))
                ->add('lbVill', PurifiedTextType::class, array(
                    'label' => 'Ville',
                    'required' => true,
                ))
                ->add('cdInse', PurifiedTextType::class, array(
                    'label' => 'Code INSEE',
                    'required' => true,
                    'attr' => array(
                        'readonly' => true
                    ),
                ))
                ->add('nmSire', PurifiedTextType::class, array(
                    'label' => 'SIRET',
                    'required' => true,
                    'attr' => array(
                        'readonly' => true
                    ),
                ))
                ->add('nmSireRata', PurifiedTextType::class, array(
                    'label' => 'SIRET de rattachement',
                    'required' => false,
                    'attr' => array(
                        'readonly' => true
                    ),
                ))
                ->add('lbTele', PurifiedTextType::class, array(
                    'required' => false,
                    'label' => "Téléphone",
                    'attr' => array(
                        'maxlength' => 10,
                    )
                ))
                ->add('lbMail', PurifiedTextType::class, array(
                    'label' => 'Email',
                    'required' => false,
                ))
                ->add('nmPopuInse', NumberType::class, array(
                    'required' => false,
                    'label' => "Population totale INSEE",
                    'attr' => array(
                        'readonly' => true
                    ),
                ))
                ->add('dtPopuInse', DateType::class, array(
                    'widget' => 'single_text',
                    'label' => 'Date de population totale INSEE',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array(
                        'readonly' => true,
                        'class' => 'input-date',
                    )
                ))
                ->add('lbContColl', PurifiedTextType::class, array(
                    'label' => 'Nom, prénom et fonction',
                    'required' => false,
                ))
                ->add('blSurclasDemo', ChoiceType::class, array(
                    'label' => 'Sur-classement démographique',
                    'choices' => array('Oui' => true, 'Non' => false), 
                    'expanded' => true,
                    'multiple' => false,
                ))
//                ->add('nmSurclasDemo', NumberType::class, array(
//                    'required' => false,
//                    'label' => "Nombre sur-classement démographique",
//                ))
//                ->add('nmStratColl') // plus tard ?
//                ->add('blCdgColl') // ?
                ->add('blAffiColl', ChoiceType::class, array(
                    'label' => 'La collectivité est-elle affiliée au CDG ?',
                    'choices' => array('Oui' => true, 'Non' => false), 
                    'expanded' => true,
                    'multiple' => false,
                    'disabled' => true,
                    'required' => false,
                ))
                ->add('blCtCdg', ChoiceType::class, array(
                    'label' => 'La collectivité est-elle rattachée au comité technique (CT) du CDG ?',
                    'choices' => array('Oui' => true, 'Non' => false), 
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->add('blChsct', ChoiceType::class, array(
                    'label' => 'La collectivité a-t-elle son propre CHSCT ?',
                    'choices' => array('Oui' => true, 'Non' => false), 
                    'expanded' => true,
                    'multiple' => false,
                ))
                ->add('blCollDgcl', ChoiceType::class, array(
                    'label' => 'La collectivité fait-elle partie de l’échantillon de la DGCL ?',
                    'choices' => array('Oui' => true, 'Non' => false), 
                    'expanded' => true,
                    'multiple' => false,
                    'disabled' => true,
                ))
                ->add('lbZoneEmplColl', PurifiedTextType::class, array(
                    'label' => 'Zone d’emploi de la collectivité',
                    'required' => false,
                    'attr' => array(
                        'readonly' => true
                    ),
                ))
                ->add('nmLogeOphlmOdhlm', NumberType::class, array(
                    'required' => false,
                    'label' => "Nombre de logements gérés pour les OPHLM et les ODHLM",
                ))
                ->add('refTypeCollectivite', EntityType::class, array(
                    'class' => RefTypeCollectivite::class,
                    'choice_label' => 'lbTypecoll',
                    'label' => 'Type de collectivité',
                    'required' => true,
                ))
                ->add('cdg', CdgType::class,array(
                    'label' => false,
                ))
                ->add('departement', EntityType::class, array(
                    'class' => Departement::class,
                    'choice_label' => 'lbDepa',
                    'label' => 'Département',
                    'required' => false,
                    'attr' => array(
                        'readonly' => true
                    ),
                    'disabled' => true,
                ))
                ->add('modifier', SubmitType::class, array(
                    'attr' => array(
                        'class' => 'btn button-tableau'
                    )
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\CollectiviteDraft'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_collectivitebundle_collectivite';
    }


}
