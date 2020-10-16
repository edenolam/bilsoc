<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\BscGpeecNbAgentsTituEmpPermaParFoncEtAgeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BilanSocialConsolideGpeecBscGpeecNbAgentsTituEmpPermaParFoncEtAgeType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('bscGpeecNbAgentsTituEmpPermaParFoncEtAgesTemp', CollectionType::class, array(
                    'label'      => false,
                    'required'   => false,
                    'entry_type'   => BscGpeecNbAgentsTituEmpPermaParFoncEtAgeType::class,
                    'by_reference' => false,
                ))
                ->add('valide', HiddenType::class, array(
                    'mapped' => false
                ))

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscFormGpeecNbAgentsTituEmpPermaParFoncEtAge';
    }

}
