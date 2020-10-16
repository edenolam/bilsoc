<?php

namespace Bilan_Social\Bundle\CollectiviteBundle\Form;

use Bilan_Social\Bundle\CollectiviteBundle\Entity\Departement;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeCollectivite;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefTypeSurclassDemo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class CollectiviteType extends AbstractType
{
    private $request;
    public function __construct(){
        $this->request = Request::createFromGlobals();
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lbColl', PurifiedTextType::class, array(
            'label' => 'Nom de la collectivité (Raison sociale) *',
            'required' => false,
        ))
        ->add('cdPost', PurifiedTextType::class, array(
            'label' => "Code postal *",
            'required' => false,
            'attr' => array(
                'maxlentgh' => 5,
                'class' => 'positiveInteger',
            )
        ))
        ->add('lbVill', PurifiedTextType::class, array(
            'label' => 'Ville *',
            'required' => false,
        ));
       

        if ($options['nmSire'] == false ){
             $builder->add('nmSire', PurifiedTextType::class, array(
                   'label' => 'SIRET *',
                   'required' => false,
                   'attr' => array(
                       'maxlength' => 14,
                       'class' => 'positiveInteger',
                   )
               ));
        }else{
            $builder->add('nmSire', PurifiedTextType::class, array(
                   'label' => 'SIRET *',
                   'required' => false,
                   'attr' => array(
                       'readonly' => true,
                       'maxlength' => 14,
                       'class' => 'positiveInteger',
                   )
               ));
        }
       
        $builder->add('refTypeCollectivite', EntityType::class, array(
            'class' => RefTypeCollectivite::class,
            'choice_label' => 'lbTypecoll',
            'label' => 'Type de collectivité *',
            'required' => false,
        ))
        ->add('refTypeSurclassDemo', EntityType::class, array(
            'class' => RefTypeSurclassDemo::class,
            'choice_label' => 'stratSurclassDemo',
            'label' => false,
            'required' => false,
        ))
        ->add('departement', EntityType::class, array(
            'class' => Departement::class,
            'choice_label' => 'lbDepa',
            'label' => 'Département *',
            'required' => false,
        ))
        ->add('lbAdre', PurifiedTextType::class, array(
            'label' => 'Adresse',
            'required' => false,
        ))
        ->add('cdInse', PurifiedTextType::class, array(
            'label' => 'Code INSEE',
            'required' => false,
            'attr' => array(
                'readonly' => true
            ),
        ))
        ->add('blSurclasDemo', CheckboxType::class, array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'toggle-bs',
            ),
        ))
        ->add('nmSireRata', PurifiedTextType::class, array(
            'label' => 'SIRET de rattachement',
            'required' => false,
            'attr' => array(
                'readonly' => true,
                'maxlentgh' => 14,
                'class' => 'positiveInteger',
            ),
        ))
        ->add('nmPopuInse', PurifiedNumberType::class, array(
            'required' => false,
            'label' => "Population totale INSEE",
            'attr' => array(
                'readonly' => true,
                'pattern' => '^[1-9]\d*$',
                'title' => 'Ce champ n\'accepte que des caractères numériques.',
            ),
        ))
        ->add('dtPopuInse', DateType::class, array(
            'widget' => 'single_text',
            'label' => 'Date de population totale INSEE',
            'required' => false,
            'format' => 'dd/MM/yyyy',
            'attr' => array(
                'readonly' => true
            )
        ))
//        ->add('nmSurclasDemo', PurifiedNumberType::class, array(
//            'label' => 'Sur-classement démographique',
//            'required' => false,
//        ))
        ->add('blAffiColl', CheckboxType::class, array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'toggle-bs toggle-disable',
            ),
        ))
        ->add('blCtCdg', CheckboxType::class, array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'toggle-bs toggle-disable'
            ),
        ))
        ->add('blChsct', CheckboxType::class, array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'toggle-bs toggle-disable',
            ),
        ))
        ->add('blCollDgcl', CheckboxType::class, array(
            'label' => false,
            'disabled' => false,
            'required' => false,
            'attr' => array(
                'class' => 'toggle-bs toggle-disable',
            ),
        ))
        ->add('lbZoneEmplColl', PurifiedTextType::class, array(
            'label' => 'Zone d’emploi de la collectivité',
            'required' => false,
            'attr' => array(
                'readonly' => true
            ),
        ))
        ->add('nmLogeOphlmOdhlm', PurifiedNumberType::class, array(
            'required' => false,
            'label' => "Nombre de logements gérés pour les OPHLM et les ODHLM",
            'attr' => array(
                'class' => 'positiveInteger',
            ),
        ))
        ->add('cdg_is_authorized_by_collectivity', CheckboxType::class, array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'toggle-bs',
            ),
        ))
        ->add('cdgGpeec', CheckboxType::class, array(
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'toggle-bs',
            ),
        ))
//        ->add('blAnalyseGpeec', CheckboxType::class, array(
//            'label' => false,
//            'required' => false,
//            'attr' => array(
//                'class' => 'toggle-bs',
//            ),
//        ))
//        ->add('cartoGpeec', CheckboxType::class, array(
//            'label' => false,
//            'required' => false,
//            'attr' => array(
//                'class' => 'toggle-bs',
//            ),
//        ))
//        ->add('convention', CheckboxType::class, array(
//            'label' => false,
//            'required' => false,
//            'attr' => array(
//                'class' => 'toggle-bs',
//            ),
//        ))
        ->add('modifier', SubmitType::class, array(
            'attr' => array('class' => 'modifier btn button-tableau'),
        ))
        ->add('creer', SubmitType::class, array(
            'attr' => array('class' => 'modifier btn button-tableau'),
        ))
        ->add('soumettreValidation', SubmitType::class, array(
            'attr' => array('class' => 'soumettreValidation btn button-tableau pull-right'),
        ))
        ->add('contacts', CollectionType::class, array('entry_type' => CollectiviteContactType::class, 'allow_add' => true, 'allow_delete' => true, 'by_reference' => false, 'prototype' => true));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite',
            'cascade_validation' => true,
        ));
        $resolver->setRequired('nmSire');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_collectivitebundle_collectivite';
    }
    
}
