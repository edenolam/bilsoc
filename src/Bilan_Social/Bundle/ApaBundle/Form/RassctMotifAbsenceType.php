<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefNatureLesion;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefElementMateriel;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefSiegeLesion;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RassctMotifAbsenceType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('idNatureLesion', EntityType::class, array(
                    'class'        => RefNatureLesion::class,
                    'label'        => false,
                    'choice_label' => 'lbNaturelesi',
                    'required'     => false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('idElementMateriel', EntityType::class, array(
                    'class'        => RefElementMateriel::class,
                    'label'        => false,
                    'choice_label' => 'lbElementmat',
                    'required'     => false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('idSiegeLesion', EntityType::class, array(
                    'class'        => RefSiegeLesion::class,
                    'label'        => false,
                    'choice_label' => 'lbSiegelesi',
                    'required'     => false,
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
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\Rassct'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_rassct';
    }

}
