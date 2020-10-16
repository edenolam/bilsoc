<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Bilan_Social\Bundle\ReferencielBundle\Entity\RefFiliere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCategorie;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefStatut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedTextType;
use Bilan_Social\Bundle\CoreBundle\Form\PurifiedNumberType;

class RemunerationGlobaleAgentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('refStatut', EntityType::class, array(
            'class' => RefStatut::class,
            'choice_label' => 'lbStat',
            'label' => false,
            'required' => false,
            'attr' => array(
                'class' => 'refStatutRemuneration',
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
                    'class' => 'SelectFiliere'
                ),
                'label_attr' => array(
                    'class' => 'hidden'
                ),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('emp')
                        ->where('emp.blVali = 0');
                },
            ))
            ->add('refCategorie', EntityType::class, array(
                'class' => RefCategorie::class,
                'choice_label' => 'lbCate',
                'label' => false,
                'required' => false,
                'attr' => array(
                    'class' => 'SelectCategorie'
                ),
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->andWhere('u.blVali = :blVali')
                        ->setParameter('blVali', '0');
                },
            ))
            ->add('mtTotalHeurePayees', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloat'
                )
            ))
            ->add('mtTotalRemunerationBrute', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp'
                )
            ))
            ->add('mtRemunerationArticle111', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp'
                )
            ))
            ->add('mtRemunerationArticle88', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp'
                )
            ))
            ->add('mtTotalRemunerationAnnuelleBruteHeuresSupp', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp'
                )
            ))
            ->add('mtTotalRemunerationAnnuelleBruteNBI', PurifiedNumberType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'class' => 'positiveFloatRoundedIntegerUp NBI'
                )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\RemunerationGlobaleAgent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_apabundle_remunerationglobaleagent';
    }


}
