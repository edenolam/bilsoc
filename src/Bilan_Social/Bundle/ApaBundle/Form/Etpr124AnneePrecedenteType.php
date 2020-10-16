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

class Etpr124AnneePrecedenteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('r1241', PurifiedNumberType::class, array(
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloat",
//                    ),
//                ))
//                ->add('r1242', PurifiedNumberType::class, array(
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloat",
//                    ),
//                ))
                ->add('RefFiliere', EntityType::class, array(
                    'class' => RefFiliere::class,
                    'choice_label' => 'lbFili',
                    'required' => false,
                    'label' => false,
                    'disabled' => true,
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
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\Etpr124AnneePrecedente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_etpr124anneeprecedente';
    }

}
