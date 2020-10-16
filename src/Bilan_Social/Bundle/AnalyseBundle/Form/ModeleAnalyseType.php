<?php

namespace Bilan_Social\Bundle\AnalyseBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CollectiviteBundle\Entity\Collectivite;
use Bilan_Social\Bundle\ReferencielBundle\Enums\DroitsEnum;
use Bilan_Social\Bundle\UserBundle\Entity\UtilisateurDroits;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextareaType;

class ModeleAnalyseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $droit = bindec(DroitsEnum::MASK_READ_COLLECTIVITE);
        $collectivites = $options['collectivites'];
        $idColls = [];
        foreach($collectivites as $k => $v){
            $idColls[] = $v['idColl'];
        }
        $builder->add('cmPresentation', PurifiedTextareaType::class, array(
                    'label' => 'Modèle d\'analyse',
                ))
                /*->add('blAffi', CheckboxType::class,array(
                    'label' => 'Afficher l\'espace d\'analyse pour les collectivités sélectionnées',
                ))*/
                ->add('collectivites', EntityType::class, array(
                    'class' => Collectivite::class,
                    'label' => false,
                    'query_builder' => function (EntityRepository $er) use ($idColls) {
                        return $er->createQueryBuilder('c')
                            ->select('c')
                            ->where('c.idColl IN (:idColls) ')
                            ->setParameter('idColls', $idColls);
                        },
                    'choice_label' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'error_bubbling' => true,
                   
                ))
                ->add('idColl', HiddenType::class,array(
                    'mapped' => false,
                    'attr' => array('data-id' => 'idColl'),
                ))
                ->add('enregistrer', SubmitType::class, array(
                    'attr' => array('class' => 'btn button-tableau'),
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('collectivites');
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\AnalyseBundle\Entity\ModeleAnalyse'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_analysebundle_modeleanalyse';
    }


}
