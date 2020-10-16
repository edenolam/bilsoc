<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefEmploiNonPermanent;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class RemunerationAgentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateIn', PurifiedTextType::class, array(
                'attr' => array(
                    'class' => 'date-picker-q13',
                    'readonly' => true,
                    'style' => 'width:auto'
                ),
            ))
            ->add('dateOut', PurifiedTextType::class, array(
                'attr' => array(
                    'class' => 'date-picker-q13',
                    'readonly' => true,
                    'style' => 'width:auto'
                ),
            ))
            ->add('refStatut', EntityType::class, array(
                'class' => RefStatut::class,
                'choice_label' => 'lbStat',
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'refStatutRemuneration',
                    'style' => 'width:auto'
                ),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0');
                },
            ))
            ->add('refEmploiNonPermanent', EntityType::class, array(
                'class' => RefEmploiNonPermanent::class,
                'choice_label' => 'lbEmplnonperm',
                'choice_value' => 'cdEmplnonperm',
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'SelectEmploiNonPermanent',
                    'style' => 'width:auto'
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
            ->add('blTempcomp', ChoiceType::class, array(
                'choices' => array( ''=> 2, 'Temps complet' => 1, 'Temps non complet' => 0),
                'label' => false,
                'expanded' => false,
                'multiple' => false,
                'placeholder' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'SelectBlTempsComp',
                    'style' => 'width:auto'
                ),
            ))
            ->add('refCategorie', EntityType::class, array(
                'class' => RefCategorie::class,
                'choice_label' => 'lbCate',
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'SelectCategorie',
                    'style' => 'width:auto'
                ),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0');
                },
            ))
            ->add('refFiliere', EntityType::class, array(
                'class' => RefFiliere::class,
                'choice_label' => 'lbfili',
                'choice_value' => 'cdFili',
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'SelectFiliere',
                    'style' => 'width:auto'
                ),
                'label_attr' => array(
                    'class' => 'hidden'
                ),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('emp')
                        ->where('emp.blVali = 0');
                },
            ))
            ->add('mtTotalRemunerationBrute', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp'
                )
            ))
            ->add('mtPrime', PurifiedNumberType::class, array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'class' => 'positiveFloatRoundedIntegerUp Prime'
                    )
             ))
            ->add('mtNBI', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp NBI'
                )
            ))
            ->add('mtHcHs', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp HcHs'
                )
            ))
            ->add('mtSFT', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp SFT'
                )
            ))
            ->add('mtIR', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp IR'
                )
            ))
            ->add('nbHeureSupp', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp HeureSupp'
                )
            ))
            ->add('nbHeureCompl', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp HeureCompl'
                )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\RemunerationAgent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_apabundle_RemunerationAgent';
    }


}
