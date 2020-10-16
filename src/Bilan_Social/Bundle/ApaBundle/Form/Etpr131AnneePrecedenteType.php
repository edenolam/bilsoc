<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class Etpr131AnneePrecedenteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('r13121', PurifiedNumberType::class, array(
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloat",
//                    ),
//                ))
//                ->add('r13122', PurifiedNumberType::class, array(
//                    'label' => false,
//                    'attr' => array(
//                        'class' => "positiveFloat",
//                    ),
//                ))
                ->add('RefEmploiNonPermanent', EntityType::class, array(
                    'class' => RefEmploiNonPermanent::class,
                    'choice_label' => "lbEmplnonperm",
                    'required' => false,
                    'label' => false,
                    'disabled' => true,
                    'attr' => array(
                        'class' => 'selectEntity hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->andWhere('u.blCdg = :blCdg')
                                ->setParameter('blVali', '0')
                                ->setParameter('blCdg', '0')
                        ;
                    },
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\Etpr131AnneePrecedente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_etpr131anneeprecedente';
    }

}
