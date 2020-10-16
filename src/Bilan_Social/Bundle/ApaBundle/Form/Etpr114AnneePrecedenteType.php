<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Etpr114AnneePrecedenteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('r1141', PurifiedNumberType::class, array(
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloat",
//                    ),
//                    'label_attr' => array(
//                        'class' => 'hidden'
//                    ),
//                ))
//                ->add('r1142', PurifiedNumberType::class, array(
//                    'label' => false,
//                    'label_attr' => array(
//                        'class' => 'hidden'
//                    ),
//                    'attr' => array(
//                        'class' => "positiveFloat",
//                    ),
//                ))
                ->add('RefFiliere', EntityType::class, array(
                    'class' => RefFiliere::class,
                    'choice_label' => 'lbFili',
                    'required' => false,
                    'disabled' => true,
                    'label' => false,
                    'attr' => array(
                        'class' => 'selectEntity hidden'
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
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\Etpr114AnneePrecedente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_etpr114anneeprecedente';
    }

}
