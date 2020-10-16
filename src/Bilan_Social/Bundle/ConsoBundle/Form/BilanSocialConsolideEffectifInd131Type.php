<?php

namespace Bilan_Social\Bundle\ConsoBundle\Form;

use Bilan_Social\Bundle\ConsoBundle\Entity\BilanSocialConsolide;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1311Type;
use Bilan_Social\Bundle\ConsoBundle\Form\Ind1312Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BilanSocialConsolideEffectifInd131Type extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $q5 = $options['questionnaire']->getQ5();
        $q6 = $options['questionnaire']->getQ6();
        
            $builder->add('ind1311sTemp', CollectionType::class, array(
                    'label' => false,
                    'required' => false,
                    'entry_type' => Ind1311Type::class,
                    'entry_options' => array('questionnaire'=>$options['questionnaire'])
                ));
            $builder->add('ind1312sTemp', CollectionType::class, array(
                'label' => false,
                'required' => false,
                'entry_type' => Ind1312Type::class,
                'entry_options' => array('questionnaire'=>$options['questionnaire'])
            ));
       
        $builder->add('valide', HiddenType::class, array(
            'mapped' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => BilanSocialConsolide::class,
        ));
        $resolver->setRequired('questionnaire');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'bscForm131';
    }

}
