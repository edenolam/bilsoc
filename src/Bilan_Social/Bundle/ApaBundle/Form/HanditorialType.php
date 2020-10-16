<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorieBoeth;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefInaptitudeBoeth;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMesureBoeth;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureHandicapBoeth;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HanditorialType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idCategorieHanditorialBoeth', EntityType::class, array(
                    'class'        => RefCategorieBoeth::class,
                    'label'        => 'B2-1a - A quelle catégorie de B.O.E.T.H. appartient cet agent ?',
                    'choice_label' => 'lbCategorieboeth',
                    'required'     => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('idNatureHandicapBoeth', EntityType::class, array(
                    'class'        => RefNatureHandicapBoeth::class,
                    'label'         => false,
                    'choice_label' => 'lbNathandiboeth',
                    'required'     => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('blAvisInaptitudeEnCours', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                    'label'       => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                ))
                ->add('idInaptitudeEnCoursAnnee', EntityType::class, array(
                    'class'        => RefInaptitudeBoeth::class,
                    'label'         => false,
                    'choice_label' => 'lbInaptitudeboeth',
                    'required'     => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('idMesureInaptitudeEnCoursAnnee', EntityType::class, array(
                    'class'        => RefMesureBoeth::class,
                    'label'         => false,
                    'choice_label' => 'lbMesureboeth',
                    'required'     => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('blAvisInaptitudeAvant', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0),
                    'expanded'    => true,
                    'multiple'    => false,
                    'placeholder' => false,
                    'required'    => false,
                    'label'       => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                ))
                ->add('idInaptitudeAvantAnnee', EntityType::class, array(
                    'class'        => RefInaptitudeBoeth::class,
                    'label'         => false,
                    'choice_label' => 'lbInaptitudeboeth',
                    'required'     => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('idMesureInaptitudeAvantAnnee', EntityType::class, array(
                    'class'        => RefMesureBoeth::class,
                    'label'         => false,
                    'choice_label' => 'lbMesureboeth',
                    'required'     => false,
                    'attr' => array(
                        'class' => 'hand',
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\Handitorial'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_apabundle_handitorial';
    }


}
