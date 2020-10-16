<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefMetier;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefDomaineDiplome;
use Doctrine\ORM\EntityRepository;

class GpeecType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              
                ->add('refMetier', EntityType::class, array(
                    'class'        => RefMetier::class,
                    'label'        => 'Quelle est la fonction occupée par l\'agent au 31/12/'.date("Y").' (métier répertoire CNFPT) ?' ,
                    'choice_label' => 'lbMetier',
                    'placeholder'  => '0',
                    'required'     => false
                ))
                ->add('idDomaineDiplomeGpeec', EntityType::class, array(
                    'class'        => RefDomaineDiplome::class,
                    'label'        => 'Quel est le diplôme le plus élevé obtenu par l\'agent ?',
                    'choice_label' => 'lbDomaineDiplome',
                    'required'     => false,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->andWhere('u.blVali = :blVali')
                                ->setParameter('blVali', '0')
                        ;
                    },
                ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\Gpeec'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bilan_social_bundle_apabundle_gpeec';
    }


}
