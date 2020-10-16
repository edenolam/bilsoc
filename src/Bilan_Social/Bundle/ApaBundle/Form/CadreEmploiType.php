<?php

namespace Bilan_Social\Bundle\ApaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Bilan_Social\Bundle\ReferencielBundle\Entity\RefCadreEmploi;
use Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Doctrine\ORM\EntityRepository;

class CadreEmploiType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('RefCadreEmploi', EntityType::class, array(
                    'class' => RefCadreEmploi::class,
                    'choice_label' => 'lbCadrempl',
                    'required' => false,
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
            'data_class' => 'Bilan_Social\Bundle\ApaBundle\Entity\AbsenceArretAgent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bilan_social_bundle_apabundle_absencearretagent';
    }

    public function getAbsenceArretAgent() {
        return 'AbsenceArretAgent';
    }

}
