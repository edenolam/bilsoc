<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Bilan_Social\Bundle\ApaBundle\Entity\EtprAgent;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class EtprAgentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('dateIn', PurifiedTextType::class, array(
                    'attr' => array(
                        'class' => 'date-picker-q13',
                        'readonly' => true,
                    ),
                ))
                ->add('dateOut', PurifiedTextType::class, array(
                    'attr' => array(
                        'class' => 'date-picker-q13',
                        'readonly' => true,
                    ),
                ))
                ->add('refStatut', EntityType::class, array(
                        'class' => RefStatut::class,
                        'choice_label' => 'lbStat',
                        'choice_value' => 'cdStat',
                        'required' => false,
                        'label' => false,
                        'label_attr' => array(
                            'class' => 'hidden'
                        ),
                        'attr' => array(
                            'class' => 'refStatutEtpr'
                        ),
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('emp')
                                    ->where('emp.blVali = 0')
                            ;
                        },
                    )
                )
                 ->add('refEmploiNonPermanent', EntityType::class, array(
                    'class' => RefEmploiNonPermanent::class,
                    'choice_label' => 'lbEmplnonperm',
                    'choice_value' => 'cdEmplnonperm',
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                      'class' => 'SelectEmploiNonPermanent'
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                     'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->andWhere('u.blCdg = :blCdg')
                                ->setParameter('blVali', '0')
                                ->setParameter('blCdg', '0')
                        ;
                        },
                ))
                ->add('refFiliere', EntityType::class, array(
                    'class' => RefFiliere::class,
                    'choice_label' => 'lbfili',
                    'choice_value' => 'cdFili',
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                      'class' => 'SelectFiliere'
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('emp')
                                    ->where('emp.blVali = 0')
                            ;
                        },
                ))
                ->add('refCadreEmploi', EntityType::class, array(
                    'class' => refCadreEmploi::class,
                    'choice_label' => 'lbCadrEmpl',
                    'choice_value' => 'cdCadrEmpl',
                    'required' => false,
                    'label' => false,
                     'attr' => array(
                      'class' => 'SelectCadreEmploi'  
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                    'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('emp')
                                    ->where('emp.blVali = 0')
                            ;
                        },
                ))
                ->add('nbHeure', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloat etprCalcule',
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
              
                ->add('nbHeureEtpr', PurifiedNumberType::class, array(
                    'required' => false,
                    'mapped' => true,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloat etprInput',
                        'readonly' => true,
                    ),
                    'label_attr' => array(
                        'class' => 'hidden'
                    ),
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => EtprAgent::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'etpragent';
    }

}
