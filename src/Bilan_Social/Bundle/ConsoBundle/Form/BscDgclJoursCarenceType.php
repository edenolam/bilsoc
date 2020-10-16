<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind411Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind412Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class BscDgclJoursCarenceType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('bscDgclJoursCarenceTitulaires', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscDgclJoursCarenceTitulaireType::class
                ))
                ->add('bscDgclJoursCarenceContractuels', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type' => BscDgclJoursCarenceContractuelType::class
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        /*$resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));*/
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'dgcljourscarence';
    }

}