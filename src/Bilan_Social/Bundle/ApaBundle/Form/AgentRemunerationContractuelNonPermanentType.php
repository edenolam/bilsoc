<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class AgentRemunerationContractuelNonPermanentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('r331h', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r331h positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('r331f', PurifiedNumberType::class, array(
                    'label' => false,
                    'required' => false,
                    'attr' => array(
                        'class' => 'r331f positiveFloatRoundedIntegerUp',
                    )
                ))
                ->add('refEmploiNonPermanent', EntityType::class, array(
                    'class' => RefEmploiNonPermanent::class,
                    'choice_label' => 'lbEmplnonperm',
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
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\AgentRemunerationContractuelNonPermanent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_agentremucontnonperm';
    }

}
