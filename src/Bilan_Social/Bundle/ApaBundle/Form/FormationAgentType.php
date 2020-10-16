<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFormation;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefOrganismeFormation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class FormationAgentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('refFormation', EntityType::class, array(
                    'class' => RefFormation::class,
                    'choice_label' => 'lbform',
                    'required' => false,
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('refOrganismeFormation', EntityType::class, array(
                    'class' => RefOrganismeFormation::class,
                    'choice_label' => 'lbOrgaform',
                    'required' => false,
                    'label' => false,
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
                ->add('nbjourForm', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloatRounded',
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                )) 
                ->add('blCpf', ChoiceType::class, array(
                    'choices' => array('Oui' => 1, 'Non' => 0), 
                    'label' => false,
                    'expanded' => false,
                    'multiple' => false,
                    'placeholder' => false,
                    'required' => false,
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\FormationAgent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'formationagent';
    }

    public function getFormationAgents() {
        return 'FormationAgent';
    }

}
